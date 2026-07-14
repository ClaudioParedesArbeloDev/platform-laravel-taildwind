<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\User;
use App\Models\Payment;
use App\Models\SoftwareOrder;
use App\Models\UserSoftware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Client\Payment\PaymentClient;
use MercadoPago\Exceptions\MPApiException;

class CheckoutController extends Controller
{
    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
    }


    public function show(Request $request, $courseId)
    {
        $course = Course::findOrFail($courseId);

        if ($course->price == 0) {
            return redirect()->route('cursos.detail', $courseId)
                ->with('error', 'Este curso es gratuito');
        }

        if (Auth::check()) {
            $isEnrolled = Auth::user()->courses()
                ->where('course_id', $courseId)
                ->exists();

            if ($isEnrolled) {
                return redirect()->route('dashboard')
                    ->with('error', 'Ya estás inscrito en este curso');
            }
        }

        $selectedDay = $request->input('enroll_day');

        return view('pages.checkout.show', compact('course', 'selectedDay'));
    }


    public function process(Request $request)
    {
        $request->validate([
            'course_id' => 'required|exists:courses,id',
            'enroll_day' => 'nullable|in:1,2',
        ]);

        $course = Course::findOrFail($request->course_id);
        $user = Auth::user();

        
        if ($course->price == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Este curso es gratuito'
            ], 400);
        }

        $isEnrolled = $user->courses()
            ->where('course_id', $request->course_id)
            ->exists();

        if ($isEnrolled) {
            return response()->json([
                'success' => false,
                'message' => 'Ya estás inscrito en este curso'
            ], 400);
        }

        if (!empty($course->days2) && $request->enroll_day) {
            $columnName = 'enroll_day_' . $request->enroll_day;
            if ($course->{$columnName} == 0) {
                return response()->json([
                    'success' => false,
                    'message' => 'No hay cupos disponibles para este día'
                ], 400);
            }
        }

        try {
            $client = new PreferenceClient();

            $backUrls = [
                "success" => route('checkout.success'),
                "failure" => route('checkout.failure'),
                "pending" => route('checkout.pending')
            ];

            $preferenceData = [
                "items" => [
                    [
                        "title" => $course->name,
                        "description" => "Inscripción al curso: " . $course->name,
                        "quantity" => 1,
                        "unit_price" => (float) $course->price,
                        "currency_id" => "ARS"
                    ]
                ],
                "payer" => [
                    "name" => $user->name,
                    "surname" => $user->lastname ?? '',
                    "email" => $user->email
                ],
                "back_urls" => $backUrls,
                "notification_url" => route('checkout.webhook'),
                "external_reference" => $user->id . '-' . $course->id . '-' . ($request->enroll_day ?? 'null'),
                "statement_descriptor" => "Code & Lens"
            ];

            
            if (str_starts_with($backUrls['success'], 'https://')) {
                $preferenceData['auto_return'] = 'approved';
            }

            Log::info('Creando preferencia en Mercado Pago', [
                'user_id' => $user->id,
                'course_id' => $course->id,
                'amount' => $course->price
            ]);

            $preference = $client->create($preferenceData);

            Log::info('Preferencia creada exitosamente', [
                'preference_id' => $preference->id
            ]);

        
            Payment::create([
                'user_id' => $user->id,
                'course_id' => $course->id,
                'preference_id' => $preference->id,
                'amount' => $course->price,
                'status' => 'pending',
                'enroll_day' => $request->enroll_day,
                'metadata' => [
                    'init_point' => $preference->init_point
                ]
            ]);

            return response()->json([
                'success' => true,
                'preference_id' => $preference->id
            ]);

        } catch (MPApiException $e) {
            $apiResponse = $e->getApiResponse();
            $errorContent = $apiResponse->getContent();

            Log::error('Error de API de Mercado Pago', [
                'status' => $apiResponse->getStatusCode(),
                'error' => $errorContent,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error al crear la preferencia: ' . ($errorContent['message'] ?? $e->getMessage())
            ], 500);

        } catch (\Exception $e) {
            Log::error('Error al crear preferencia', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error interno: ' . $e->getMessage()
            ], 500);
        }
    }


    public function success(Request $request)
    {
        Log::info('Redirigido a success', $request->all());
        return view('pages.checkout.success');
    }

    public function failure(Request $request)
    {
        Log::info('Redirigido a failure', $request->all());
        return view('pages.checkout.failure');
    }

    public function pending(Request $request)
    {
        Log::info('Redirigido a pending', $request->all());
        return view('pages.checkout.pending');
    }


    
    public function webhook(Request $request)
    {
        try {
            Log::info('Webhook recibido', [
                'body' => $request->all(),
                'query' => $request->query()
            ]);

    
            $paymentId = null;

    
            if ($request->input('type') === 'payment') {
                $paymentId = $request->input('data.id');
            }
    
            elseif ($request->query('topic') === 'payment') {
                $paymentId = $request->query('id');
            }

            if (!$paymentId) {
                Log::info('Webhook ignorado: no es notificación de payment');
                return response()->json(['status' => 'ignored'], 200);
            }

    
            $client = new PaymentClient();
            $payment = $client->get($paymentId);

            Log::info('Datos del pago obtenidos', [
                'payment_id' => $payment->id,
                'status' => $payment->status,
                'external_reference' => $payment->external_reference
            ]);

    
            $externalReference = $payment->external_reference;

            
            if (str_starts_with($externalReference, 'SWORDER-')) {
                return $this->handleSoftwareOrderWebhook($payment, $paymentId, $externalReference);
            }

            $parts = explode('-', $externalReference);

            if (count($parts) < 2) {
                Log::error('External reference inválido', ['value' => $externalReference]);
                return response()->json(['status' => 'error'], 400);
            }

            $userId = $parts[0];
            $courseId = $parts[1];
            $enrollDay = isset($parts[2]) && $parts[2] !== 'null' ? $parts[2] : null;

    
            $paymentRecord = Payment::where('payment_id', (string) $paymentId)->first();

            if (!$paymentRecord) {
    
                $paymentRecord = Payment::where('user_id', $userId)
                    ->where('course_id', $courseId)
                    ->whereNull('payment_id')
                    ->first();
            }

    
            if ($paymentRecord) {
                $paymentRecord->update([
                    'payment_id' => (string) $paymentId,
                    'status' => $payment->status,
                    'payment_method' => $payment->payment_method_id ?? null,
                    'payment_type' => $payment->payment_type_id ?? null,
                    'metadata' => array_merge(
                        $paymentRecord->metadata ?? [],
                        [
                            'mp_status_detail' => $payment->status_detail ?? null,
                            'mp_payment_method' => $payment->payment_method_id ?? null,
                        ]
                    )
                ]);
            } else {
                $paymentRecord = Payment::create([
                    'user_id' => $userId,
                    'course_id' => $courseId,
                    'payment_id' => (string) $paymentId,
                    'preference_id' => null,
                    'amount' => $payment->transaction_amount,
                    'status' => $payment->status,
                    'payment_method' => $payment->payment_method_id ?? null,
                    'payment_type' => $payment->payment_type_id ?? null,
                    'enroll_day' => $enrollDay,
                    'metadata' => [
                    'mp_status_detail' => $payment->status_detail ?? null,
                    ]
                ]);
            }

            Log::info('Registro de pago actualizado', [
                'payment_record_id' => $paymentRecord->id,
                'status' => $payment->status
            ]);

            
            if ($payment->status === 'approved') {
                $this->enrollAfterPayment($userId, $courseId, $enrollDay);
            }

            return response()->json(['status' => 'success'], 200);

        } catch (\Exception $e) {
            Log::error('Error en webhook', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine()
            ]);
            return response()->json(['status' => 'error'], 500);
        }
    }


    private function handleSoftwareOrderWebhook($payment, $paymentId, string $externalReference)
    {
        $orderId = str_replace('SWORDER-', '', $externalReference);
        $order = SoftwareOrder::with('items.software')->find($orderId);

        if (!$order) {
            Log::error('Software order no encontrada', ['external_reference' => $externalReference]);
            return response()->json(['status' => 'error'], 400);
        }

        $order->update([
            'payment_id' => (string) $paymentId,
            'status' => $payment->status,
            'payment_method' => $payment->payment_method_id ?? null,
            'payment_type' => $payment->payment_type_id ?? null,
            'metadata' => array_merge(
                $order->metadata ?? [],
                [
                    'mp_status_detail' => $payment->status_detail ?? null,
                    'mp_payment_method' => $payment->payment_method_id ?? null,
                ]
            ),
        ]);

        Log::info('Software order actualizada', [
            'order_id' => $order->id,
            'status' => $payment->status,
        ]);

        if ($payment->status === 'approved') {
            $this->enrollSoftwareAfterPayment($order);
        }

        return response()->json(['status' => 'success'], 200);
    }

    private function enrollSoftwareAfterPayment(SoftwareOrder $order)
    {
        foreach ($order->items as $item) {
            if (!$item->software_id) {
                continue;
            }

            $alreadyGranted = UserSoftware::where('user_id', $order->user_id)
                ->where('software_id', $item->software_id)
                ->where('software_order_id', $order->id)
                ->exists();

            if ($alreadyGranted) {
                continue;
            }

            $software = $item->software;
            $licenseType = $software->license_type ?? null;

            UserSoftware::create([
                'user_id' => $order->user_id,
                'software_id' => $item->software_id,
                'software_order_id' => $order->id,
                'status' => 'active',
                'license_type' => $licenseType,
                'purchased_at' => now(),
                'expires_at' => $licenseType === 'anual' ? now()->addYear() : null,
                'download_token' => Str::random(40),
            ]);

            Log::info('Acceso a software otorgado', [
                'user_id' => $order->user_id,
                'software_id' => $item->software_id,
                'order_id' => $order->id,
            ]);
        }
    }


    private function enrollAfterPayment($userId, $courseId, $enrollDay = null)
    {
        $user = User::find($userId);
        $course = Course::find($courseId);

        if (!$user || !$course) {
            Log::error('Enrollafter: usuario o curso no encontrado', [
                'user_id' => $userId,
                'course_id' => $courseId
            ]);
            return;
        }

        
        $isEnrolled = $user->courses()
            ->where('course_id', $courseId)
            ->exists();

        if ($isEnrolled) {
            Log::info("Usuario ya inscrito", ['user_id' => $userId, 'course_id' => $courseId]);
            return;
        }

        
        if (empty($course->days2)) {
            $user->courses()->attach($course->id, [
                'status' => 'in progress'
            ]);
            Log::info("Inscripción exitosa", ['user_id' => $userId, 'course_id' => $courseId]);
            return;
        }

        
        if (empty($enrollDay)) {
            Log::error("Falta enroll_day para curso con horarios", [
                'course_id' => $courseId
            ]);
            return;
        }

        $columnName = 'enroll_day_' . $enrollDay;
        if ($course->{$columnName} <= 0) {
            Log::error("Sin cupos disponibles", [
                'course_id' => $courseId,
                'enroll_day' => $enrollDay
            ]);
            return;
        }

        $user->courses()->attach($course->id, [
            'enroll_day' => $enrollDay,
            'status' => 'in progress'
        ]);

        $course->decrement($columnName, 1);

        Log::info("Inscripción exitosa con día", [
            'user_id' => $userId,
            'course_id' => $courseId,
            'enroll_day' => $enrollDay
        ]);
    }
}