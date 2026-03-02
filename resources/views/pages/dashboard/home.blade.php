@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Dashboard')

@section('content')
    <div class="bg-background-300 text-text-900 w-full min-h-screen flex flex-col items-center px-4 py-8">
        
        <p class="text-center font-five text-2xl lg:text-3xl font-bold mb-4">
            {{ __('Hello') }} {{ Auth::user()->name }}
        </p>

        <h3 class="text-center text-xl lg:text-2xl mb-8">
            {{ __('Your courses') }}
        </h3>

        
        <div class="flex flex-wrap justify-center gap-6 max-w-6xl">
            @forelse ($courses as $course)
                @php
                    $perc = $course->attendance_percentage ?? 0;

                    // Color del texto del porcentaje
                    $textColor = match (true) {
                        $perc >= 80 => 'text-green-600',
                        $perc >= 60 => 'text-yellow-600',
                        default     => 'text-red-600',
                    };

                    // Color del mensaje motivacional
                    $msgColor = match (true) {
                        $perc >= 80 => 'text-green-700',
                        $perc >= 60 => 'text-yellow-700',
                        default     => 'text-red-700',
                    };

                    // Colores para la barra (inicio y fin del gradiente)
                    [$gradientStart, $gradientEnd] = match (true) {
                        $perc >= 80 => ['#10b981', '#059669'],
                        $perc >= 60 => ['#f59e0b', '#d97706'],
                        default     => ['#ef4444', '#dc2626'],
                    };

                    // Mensaje motivacional
                    $motivMessage = match (true) {
                        $perc >= 80 => '¡Excelente! 🎉 Seguí así',
                        $perc >= 60 => 'Muy bien, ¡un poco más! 💪',
                        default     => 'Hay que mejorar la asistencia 📚',
                    };
                @endphp

                <div class="bg-accent2-500 border border-accent-500 rounded-xl shadow-lg p-6 w-full sm:w-80 lg:w-96 hover:shadow-xl transition-all duration-300">
                    
                    <p class="text-lg text-gray-600 font-medium">
                        {{ $course->category ?? '—' }}
                    </p>
                    <h2 class="text-2xl font-bold text-text-900 mt-1 mb-4">
                        {{ $course->name }}
                    </h2>

                    
                    <div class="space-y-3 mb-6">
                        <div class="flex items-center justify-between">
                            <span class="text-base font-medium text-gray-700">
                                {{ __('Asistencia') }}:
                            </span>

                            <span class="text-2xl font-extrabold {{ $textColor }}">
                                {{ number_format($perc, 1) }}%
                            </span>
                        </div>

                        
                        <div class="w-full bg-gray-200 rounded-full h-3.5 overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-1000 ease-out"
                                 style="width: {{ $perc }}%; background: linear-gradient(to right, {{ $gradientStart }}, {{ $gradientEnd }});">
                            </div>
                        </div>

                        
                        <p class="text-sm text-center mt-2 font-medium {{ $msgColor }}">
                            {{ $motivMessage }}
                        </p>
                    </div>

                   
                    <a href="{{ route('cursos.class', $course->id) }}"
                       class="block w-full bg-accent-300 text-white text-center py-3 rounded-xl hover:bg-accent-400 transition font-medium shadow-md">
                        {{ __('Access the course') }}
                    </a>
                </div>
            @empty
                <div class="w-full max-w-lg bg-white rounded-xl shadow-lg p-10 text-center">
                    <p class="text-xl text-gray-700 mb-6">
                        {{ __('Todavía no estás inscripto en ningún curso.') }}
                    </p>
                    <a href="{{ route('cursos') }}"
                       class="inline-block px-8 py-4 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition text-lg font-medium">
                        {{ __('Ver cursos disponibles') }}
                    </a>
                </div>
            @endforelse
        </div>
    </div>
@endsection