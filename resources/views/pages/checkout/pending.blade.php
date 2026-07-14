@extends('components.layout.layout')

@section('title', 'Pago Pendiente - Code & Lens')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-yellow-50 to-accent-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
           
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-yellow-100 mb-6">
                <svg class="h-12 w-12 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>

           
            <h1 class="text-3xl font-bold text-text-900 mb-4">Pago en Proceso</h1>
            
          
            <p class="text-lg text-text-600 mb-6">
                Tu pago está siendo procesado y confirmado.
            </p>

            @if(request()->query('payment_id'))
                <div class="bg-yellow-50 rounded-lg p-4 mb-6">
                    <p class="text-sm text-yellow-900 mb-2">Referencia de tu pago</p>
                    <p class="font-mono text-yellow-900">{{ request()->query('payment_id') }}</p>
                    @if(request()->query('payment_type'))
                        <p class="text-sm text-yellow-900 mt-3">
                            Método: <span class="capitalize">{{ str_replace('_', ' ', request()->query('payment_type')) }}</span>
                        </p>
                    @endif
                </div>
            @endif

          
            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-yellow-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <div class="text-left">
                        <p class="font-semibold text-yellow-900 mb-2">¿Qué significa esto?</p>
                        <p class="text-sm text-yellow-800">
                            Algunos métodos de pago requieren tiempo adicional para su confirmación. 
                            Esto es común con transferencias bancarias o pagos en efectivo (Rapipago/Pago Fácil).
                        </p>
                    </div>
                </div>
            </div>

 
            <div class="bg-gray-50 rounded-lg p-4 mb-6 text-left">
                <p class="font-semibold text-text-900 mb-3">Próximos pasos:</p>
                <ol class="space-y-2 text-text-600">
                    <li class="flex items-start">
                        <span class="font-semibold text-accent-600 mr-2">1.</span>
                        <span>Completa el pago según las instrucciones que recibiste por email</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-semibold text-accent-600 mr-2">2.</span>
                        <span>Recibirás un email cuando se confirme tu pago</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-semibold text-accent-600 mr-2">3.</span>
                        <span>Tu inscripción se activará automáticamente</span>
                    </li>
                    <li class="flex items-start">
                        <span class="font-semibold text-accent-600 mr-2">4.</span>
                        <span>Podrás acceder al curso desde tu dashboard</span>
                    </li>
                </ol>
            </div>

           
            <div class="bg-accent2-50 border border-accent2-200 rounded-lg p-4 mb-6">
                <p class="text-sm text-accent2-800">
                    <strong>Nota:</strong> Este proceso puede tomar hasta 48 horas hábiles dependiendo del método de pago. 
                    Guarda tu comprobante de pago.
                </p>
            </div>

            <div class="space-y-3">
                <a href="{{ route('dashboard') }}" 
                   class="inline-block w-full bg-accent-500 hover:bg-accent-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                    Ir al Dashboard
                </a>
                
                <a href="{{ route('cursos') }}" 
                   class="inline-block w-full bg-gray-200 hover:bg-gray-300 text-text-900 font-semibold py-3 px-6 rounded-lg transition duration-200">
                    Ver Más Cursos
                </a>
            </div>
        </div>
    </div>
</div>

@endsection