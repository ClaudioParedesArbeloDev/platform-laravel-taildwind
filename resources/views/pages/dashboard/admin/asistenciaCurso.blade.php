@extends('components.layout.dashLayout')

@section('title', 'Asistencia - ' . $course->name)

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-6xl mx-auto px-4 lg:px-8 py-8">

     
        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('attendance') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ $course->name }}
                </h1>
            </div>
            <a href="{{ route('attendance.index') }}" class="text-sm text-variant-100 hover:underline flex items-center gap-x-2">
                <i class="fa-solid fa-arrow-left"></i>
                {{ __('Volver a cursos') }}
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 text-sm rounded-lg p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('attendance.update', $course->id) }}">
            @csrf
            @method('PUT')

            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl overflow-x-auto mb-6">
                <table class="w-full text-sm">
                    <thead class="bg-background-300 sticky top-0 z-10">
                        <tr>
                            <th class="py-4 px-6 text-left text-xs uppercase tracking-wide text-variant-100 font-medium w-64 min-w-[220px]">
                                {{ __('student') }}
                            </th>

                            @foreach ($classes as $class)
                                <th class="py-4 px-4 text-center text-xs uppercase tracking-wide text-variant-100 font-medium min-w-[110px]">
                                    {{ \Illuminate\Support\Carbon::parse($class->date)->translatedFormat('j \d\e F') }}
                                    <br>
                                    <span class="text-[11px] font-normal text-text-500 normal-case tracking-normal">
                                        {{ $class->start_time }}
                                    </span>
                                </th>
                            @endforeach
                        </tr>
                    </thead>

                    <tbody>
                        @forelse ($students as $student)
                            <tr class="border-t border-variant-100 hover:bg-background-300 transition-colors">
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
                                               class="w-5 h-5 rounded border-variant-100 text-accent-900 focus:ring-accent-900">
                                    </td>
                                @endforeach
                            </tr>
                        @empty
                            <tr>
                                <td colspan="{{ $classes->count() + 1 }}" class="py-12 text-center text-text-500">
                                    {{ __('No hay alumnos inscriptos o visibles en esta página.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="flex justify-center mb-6">
                {{ $students->links() }}
            </div>

            <div class="flex flex-col sm:flex-row justify-end gap-3">
                <a href="{{ route('attendance.index') }}"
                   class="py-2.5 px-6 text-center inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-variant-100 text-text-500 hover:bg-background-500 transition-colors duration-300">
                    {{ __('Volver a cursos') }}
                </a>
                <button type="submit"
                    class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>{{ __('Guardar asistencia') }}</span>
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
