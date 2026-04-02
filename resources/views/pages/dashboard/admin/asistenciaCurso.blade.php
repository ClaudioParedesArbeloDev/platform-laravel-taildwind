@extends('components.layout.dashLayout')

@section('title', 'Asistencia - ' . $course->name)

@section('content')
    <div class="p-4 lg:p-8">
        <h2 class="font-bold text-text-900 uppercase text-xl lg:text-2xl mb-6">
            {{ __('attendance') }} — {{ $course->name }}
        </h2>

        @if (session('success'))
            <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('attendance.update', $course->id) }}">
            @csrf
            @method('PUT')

            <div class="overflow-x-auto border border-gray-200 rounded-lg shadow mb-6">
                <table class="min-w-full divide-y divide-gray-200 bg-background-100">
                    <thead class="bg-background-500 text-text-900 sticky top-0 z-10">
                        <tr>
                            <th class="py-4 px-6 text-left font-semibold uppercase tracking-wider w-64 min-w-[250px]">
                                {{ __('student') }}
                            </th>

                            @foreach ($classes as $class)
                                <th class="py-4 px-4 text-center font-semibold uppercase tracking-wider min-w-[110px]">
                                    {{ \Carbon\Carbon::parse($class->date)->translatedFormat('j \d\e F') }}
                                    <br>
                                    <span class="text-sm font-normal text-gray-600">
                                        {{ $class->start_time }}
                                    </span>
                                </th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody class="divide-y divide-gray-200">
                        @forelse ($students as $student)
                            <tr class="hover:bg-background-300 transition-colors">
                                <td class="py-4 px-6 font-medium text-text-900 whitespace-nowrap">
                                    {{ $student->name }} {{ $student->lastname ?? '' }}
                                </td>

                                @foreach ($classes as $class)
                                    <td class="py-4 px-4 text-center">
                                        @php
                                            $key = $student->id . '-' . $class->id;
                                            $attendance = $attendances[$key] ?? null;
                                            $checked = $attendance && $attendance->present;
                                        @endphp

                                        <input type="hidden"
                                               name="attendance[{{ $student->id }}][{{ $class->id }}]"
                                               value="0">

                                        <input type="checkbox"
                                               name="attendance[{{ $student->id }}][{{ $class->id }}]"
                                               value="1"
                                               {{ $checked ? 'checked' : '' }}
                                               class="h-5 w-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $classes->count() + 1 }}" class="py-12 text-center text-gray-500 text-lg">
                                    {{ __('No hay alumnos inscriptos o visibles en esta página.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Paginación de alumnos -->
            <div class="mt-4 flex justify-center">
                {{ $students->links() }}
            </div>

            <!-- Botones de acción -->
            <div class="mt-8 flex flex-col sm:flex-row justify-end gap-4">
                <a href="{{ route('attendance.index') }}"
                   class="px-6 py-3 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition text-center">
                    {{ __('Volver a cursos') }}
                </a>

                <button type="submit"
                        class="px-8 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition shadow-md">
                    {{ __('Guardar asistencia') }}
                </button>
            </div>
        </form>
    </div>
@endsection