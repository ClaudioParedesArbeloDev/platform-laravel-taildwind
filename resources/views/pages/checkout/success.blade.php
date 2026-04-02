@extends('components.layout.layout')

@section('title', 'Pago Exitoso - Code & Lens')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-green-50 to-accent-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            <!-- Icono de éxito -->
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                <svg class="h-12 w-12 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </div>

            <!-- Título -->
            <h1 class="text-3xl font-bold text-text-900 mb-4">¡Pago Exitoso!</h1>
            
            <!-- Mensaje -->
            <p class="text-lg text-text-600 mb-6">
                Tu pago ha sido procesado correctamente. 
                En unos momentos recibirás la confirmación de tu inscripción.
            </p>

            <!-- Información del pago -->
            <div class="bg-gray-50 rounded-lg p-4 mb-6">
                <p class="text-sm text-text-500 mb-2">ID de Pago</p>
                <p class="font-mono text-text-900">{{ request()->query('payment_id') ?? request()->query('collection_id') ?? 'Procesando...' }}</p>
                
                @if(request()->query('payment_type'))
                    <p class="text-sm text-text-500 mt-4 mb-2">Método de Pago</p>
                    <p class="text-text-900 capitalize">{{ str_replace('_', ' ', request()->query('payment_type')) }}</p>
                @endif
            </div>

            <!-- Mensaje adicional -->
            <div class="bg-accent2-50 border border-accent2-200 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-accent2-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm text-accent2-800 text-left">
                        Tu inscripción será procesada automáticamente. 
                        Recibirás un email de confirmación en los próximos minutos.
                    </p>
                </div>
            </div>

            <!-- Botones -->
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