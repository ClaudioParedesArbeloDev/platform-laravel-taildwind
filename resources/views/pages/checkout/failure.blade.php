@extends('components.layout.layout')

@section('title', 'Pago Fallido - Code & Lens')

@section('content')

<div class="min-h-screen bg-gradient-to-br from-red-50 to-accent-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-lg p-8 text-center">
            
            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-red-100 mb-6">
                <svg class="h-12 w-12 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </div>

           
            <h1 class="text-3xl font-bold text-text-900 mb-4">Pago No Procesado</h1>
            
           
            <p class="text-lg text-text-600 mb-6">
                Lo sentimos, hubo un problema al procesar tu pago.
            </p>

            @if(request()->query('status'))
                <div class="bg-red-50 rounded-lg p-4 mb-6">
                    <p class="text-sm text-red-900">
                        Estado: <span class="font-semibold capitalize">{{ request()->query('status') }}</span>
                    </p>
                    @if(request()->query('payment_id'))
                        <p class="text-sm text-red-900 mt-2">
                            Referencia: <span class="font-mono">{{ request()->query('payment_id') }}</span>
                        </p>
                    @endif
                </div>
            @endif

            
            <div class="bg-gray-50 rounded-lg p-4 mb-6 text-left">
                <p class="font-semibold text-text-900 mb-3">Razones comunes:</p>
                <ul class="space-y-2 text-text-600">
                    <li class="flex items-start">
                        <span class="text-red-500 mr-2">•</span>
                        <span>Fondos insuficientes</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-red-500 mr-2">•</span>
                        <span>Datos de tarjeta incorrectos</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-red-500 mr-2">•</span>
                        <span>Cancelación durante el proceso</span>
                    </li>
                    <li class="flex items-start">
                        <span class="text-red-500 mr-2">•</span>
                        <span>Límite de compra excedido</span>
                    </li>
                </ul>
            </div>

           
            <div class="bg-accent2-50 border border-accent2-200 rounded-lg p-4 mb-6">
                <div class="flex items-start">
                    <svg class="w-5 h-5 text-accent2-600 mt-0.5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="text-sm text-accent2-800 text-left">
                        No te preocupes, no se realizó ningún cargo. 
                        Puedes intentar nuevamente cuando estés listo.
                    </p>
                </div>
            </div>

           
            <div class="space-y-3">
                @if(request()->query('external_reference'))
                    @php
                        $parts = explode('-', request()->query('external_reference'));
                        $courseId = $parts[1] ?? null;
                    @endphp
                    @if($courseId)
                        <a href="{{ route('cursos.detail', $courseId) }}" 
                           class="inline-block w-full bg-accent-500 hover:bg-accent-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                            Intentar Nuevamente
                        </a>
                    @endif
                @else
                    <a href="{{ route('cursos') }}" 
                       class="inline-block w-full bg-accent-500 hover:bg-accent-600 text-white font-semibold py-3 px-6 rounded-lg transition duration-200">
                        Ver Cursos
                    </a>
                @endif
                
                <a href="{{ route('home') }}" 
                   class="inline-block w-full bg-gray-200 hover:bg-gray-300 text-text-900 font-semibold py-3 px-6 rounded-lg transition duration-200">
                    Volver al Inicio
                </a>
            </div>
        </div>
    </div>
</div>

@endsection