<?php

namespace App\Http\Controllers;

use App\Models\Software;
use App\Models\SoftwareAddon;
use App\Models\SoftwareOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;

class SoftwareCheckoutController extends Controller
{
    public function __construct()
    {
        MercadoPagoConfig::setAccessToken(config('services.mercadopago.access_token'));
    }

    
    public function show(Request $request, $softwareId)
    {
        $software = Software::findOrFail($softwareId);

        if (!$software->isPurchasableOnline()) {
            return redirect()->route('software.show', $softwareId)
                ->with('error', __('Este producto no está disponible para compra online. Contactanos para cotizarlo.'));
        }

        $addonIds = collect($request->input('addons', []))->map(fn ($id) => (int) $id);

        $availableAddons = SoftwareAddon::where('software_id', $software->id)
            ->where('active', true)
            ->get();

        $addons = $availableAddons->whereIn('id', $addonIds->all());

        $total = (float) $software->price + $addons->sum('price');

        return view('pages.software.checkout', compact('software', 'availableAddons', 'addonIds', 'total'));
    }

   
    public function process(Request $request)
    {
        $request->validate([
            'software_id' => 'required|exists:softwares,id',
            'addons' => 'nullable|array',
            'addons.*' => 'integer|exists:software_addons,id',
        ]);

        $software = Software::findOrFail($request->software_id);
        $user = Auth::user();

        if (!$software->isPurchasableOnline()) {
            return response()->json([
                'success' => false,
                'message' => 'Este producto no está disponible para compra online',
            ], 400);
        }

        $addons = SoftwareAddon::where('software_id', $software->id)
            ->where('active', true)
            ->whereIn('id', $request->input('addons', []))
            ->get();

        $total = (float) $software->price + $addons->sum('price');

        try {
           
            $order = SoftwareOrder::create([
                'user_id' => $user->id,
                'total' => $total,
                'status' => 'pending',
            ]);

            $order->items()->create([
                'software_id' => $software->id,
                'software_addon_id' => null,
                'name' => $software->name,
                'price' => $software->price,
                'quantity' => 1,
            ]);

            foreach ($addons as $addon) {
                $order->items()->create([
                    'software_id' => $software->id,
                    'software_addon_id' => $addon->id,
                    'name' => $addon->name,
                    'price' => $addon->price,
                    'quantity' => 1,
                ]);
            }

           
            $mpItems = [
                [
                    'title' => $software->name,
                    'description' => $software->short_description ?? $software->name,
                    'quantity' => 1,
                    'unit_price' => (float) $software->price,
                    'currency_id' => 'ARS',
                ],
            ];

            foreach ($addons as $addon) {
                $mpItems[] = [
                    'title' => $addon->name,
                    'description' => 'Complemento de ' . $software->name,
                    'quantity' => 1,
                    'unit_price' => (float) $addon->price,
                    'currency_id' => 'ARS',
                ];
            }

            $client = new PreferenceClient();

            $backUrls = [
                'success' => route('software.checkout.success'),
                'failure' => route('software.checkout.failure'),
                'pending' => route('software.checkout.pending'),
            ];

            $preferenceData = [
                'items' => $mpItems,
                'payer' => [
                    'name' => $user->name,
                    'surname' => $user->lastname ?? '',
                    'email' => $user->email,
                ],
                'back_urls' => $backUrls,
                'notification_url' => route('checkout.webhook'),
                'external_reference' => 'SWORDER-' . $order->id,
                'statement_descriptor' => 'Code & Lens',
            ];

            
            if (str_starts_with($backUrls['success'], 'https://')) {
                $preferenceData['auto_return'] = 'approved';
            }

            Log::info('Creando preferencia de software en Mercado Pago', [
                'order_id' => $order->id,
                'software_id' => $software->id,
                'total' => $total,
            ]);

            $preference = $client->create($preferenceData);

            $order->update([
                'preference_id' => $preference->id,
                'metadata' => ['init_point' => $preference->init_point],
            ]);

            return response()->json([
                'success' => true,
                'preference_id' => $preference->id,
            ]);

        } catch (MPApiException $e) {
            $apiResponse = $e->getApiResponse();
            $errorContent = $apiResponse->getContent();

            Log::error('Error de API de Mercado Pago (software)', [
                'status' => $apiResponse->getStatusCode(),
                'error' => $errorContent,
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error al crear la preferencia: ' . ($errorContent['message'] ?? $e->getMessage()),
            ], 500);

        } catch (\Exception $e) {
            Log::error('Error al crear preferencia de software', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Error interno: ' . $e->getMessage(),
            ], 500);
        }
    }

    public function success(Request $request)
    {
        Log::info('Software checkout: redirigido a success', $request->all());
        return view('pages.software.checkoutSuccess');
    }

    public function failure(Request $request)
    {
        Log::info('Software checkout: redirigido a failure', $request->all());
        return view('pages.software.checkoutFailure');
    }

    public function pending(Request $request)
    {
        Log::info('Software checkout: redirigido a pending', $request->all());
        return view('pages.software.checkoutPending');
    }
}