@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Dashboard')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-6xl mx-auto px-4 lg:px-8 py-8">

     
        <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
            {{ __('Dashboard') }}
        </p>
        <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
            {{ __('Hello') }}, {{ Auth::user()->name }} 👋
        </h1>
        <p class="font-three text-sm text-text-500 mt-2 mb-8">
            {{ __("Here's a quick look at your courses and software.") }}
        </p>

   
        @if ($activeCoursesCount > 0 || $softwareOwnedCount > 0)
            <div class="flex flex-wrap gap-4 mb-10">

                @if ($activeCoursesCount > 0)
                    <div class="flex items-center gap-x-4 bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5 w-full sm:w-64">
                        <div class="w-12 h-12 shrink-0 rounded-full bg-accent1-300 flex items-center justify-center">
                            <i class="fa-solid fa-graduation-cap text-xl text-accent1-900"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-text-900">{{ $activeCoursesCount }}</p>
                            <p class="text-xs uppercase tracking-wide text-variant-100">{{ __('Active courses') }}</p>
                        </div>
                    </div>
                @endif

                @if ($softwareOwnedCount > 0)
                    <a href="{{ route('software.my') }}" class="flex items-center gap-x-4 bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5 w-full sm:w-64 hover:-translate-y-1 transition-transform duration-300">
                        <div class="w-12 h-12 shrink-0 rounded-full bg-accent2-300 flex items-center justify-center">
                            <i class="fa-solid fa-layer-group text-xl text-accent2-900"></i>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-text-900">{{ $softwareOwnedCount }}</p>
                            <p class="text-xs uppercase tracking-wide text-variant-100">{{ __('Software owned') }}</p>
                        </div>
                    </a>
                @endif

            </div>
        @endif

      
        <div class="flex justify-between items-end mb-6">
            <h2 class="font-three font-bold text-lg lg:text-xl text-text-500">{{ __('Your courses') }}</h2>
            <a href="{{ route('dashboard.cursos') }}" class="font-five text-xs lg:text-sm text-variant-100 hover:underline whitespace-nowrap">
                {{ __('more courses') }} &rarr;
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
            @forelse ($courses as $course)
                @php
                    $perc = $course->attendance_percentage ?? 0;

                    [$textColor, $barFrom, $barTo, $motivMessage] = match (true) {
                        $perc >= 80 => ['text-green-600', '#10b981', '#059669', __('Excellent! Keep it up')],
                        $perc >= 60 => ['text-yellow-600', '#f59e0b', '#d97706', __('Good, almost there')],
                        default     => ['text-red-600', '#ef4444', '#dc2626', __('Attendance needs work')],
                    };
                @endphp

                <div class="flex flex-col bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5 hover:-translate-y-1 transition-transform duration-300">
                    <p class="text-xs uppercase tracking-wide text-variant-100">
                        {{ $course->category ?? '—' }}
                    </p>
                    <h3 class="text-base font-bold text-text-900 mt-1 mb-4 line-clamp-2">
                        {{ $course->name }}
                    </h3>

                    <div class="mb-4">
                        <div class="flex items-center justify-between mb-1.5">
                            <span class="text-sm text-text-500">{{ __('Attendance') }}</span>
                            <span class="text-sm font-bold {{ $textColor }}">{{ number_format($perc, 1) }}%</span>
                        </div>
                        <div class="w-full bg-background-300 rounded-full h-2.5 overflow-hidden">
                            <div class="h-full rounded-full transition-all duration-700 ease-out"
                                 style="width: {{ $perc }}%; background: linear-gradient(to right, {{ $barFrom }}, {{ $barTo }});">
                            </div>
                        </div>
                        <p class="text-xs mt-1.5 {{ $textColor }}">{{ $motivMessage }}</p>
                    </div>

                    <a href="{{ route('cursos.class', $course->id) }}"
                       class="mt-auto py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white focus:outline-hidden transition-colors duration-300">
                        {{ __('Access the course') }}
                    </a>
                </div>
            @empty
                <div class="sm:col-span-2 lg:col-span-3 flex flex-col items-center text-center bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-10">
                    <i class="fa-solid fa-graduation-cap text-3xl text-variant-100 mb-4"></i>
                    <p class="text-text-500 mb-6">{{ __("You're not enrolled in any course yet.") }}</p>
                    <a href="{{ route('cursos') }}"
                       class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                        {{ __('See available courses') }}
                    </a>
                </div>
            @endforelse
        </div>

    </div>
</div>
@endsection