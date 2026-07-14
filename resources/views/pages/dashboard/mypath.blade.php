@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Mi Ruta')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-6xl mx-auto px-4 lg:px-8 py-8">

       
        <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
            {{ __('Dashboard') }}
        </p>
        <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500 mb-8">
            {{ __('My Learning Path') }}
        </h1>

      
        <div class="flex items-center gap-x-2 mb-5">
            <i class="fa-solid fa-spinner text-variant-100"></i>
            <h2 class="font-three font-bold text-lg text-text-500">{{ __('In Progress') }}</h2>
        </div>

        @if ($inProgressCourses->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 mb-10">
                @foreach ($inProgressCourses as $course)
                    <div class="flex flex-col bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5 hover:-translate-y-1 transition-transform duration-300">
                        <p class="text-xs uppercase tracking-wide text-variant-100">
                            {{ $course->category ?? '—' }}
                        </p>
                        <h3 class="text-base font-bold text-text-900 mt-1 mb-4 line-clamp-2">
                            {{ $course->name }}
                        </h3>
                        <a href="{{ route('cursos.class', $course->id) }}"
                           class="mt-auto py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white focus:outline-hidden transition-colors duration-300">
                            {{ __('View Course') }}
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 mb-10">
                <p class="text-sm text-text-500">{{ __('No courses in progress.') }}</p>
            </div>
        @endif

       
        <div class="flex items-center gap-x-2 mb-5">
            <i class="fa-solid fa-circle-check text-variant-100"></i>
            <h2 class="font-three font-bold text-lg text-text-500">{{ __('Completed') }}</h2>
        </div>

        @if ($completedCourses->isNotEmpty())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($completedCourses as $course)
                    <div class="flex flex-col bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5 hover:-translate-y-1 transition-transform duration-300">
                        <p class="text-xs uppercase tracking-wide text-variant-100">
                            {{ $course->category ?? '—' }}
                        </p>
                        <h3 class="text-base font-bold text-text-900 mt-1 mb-4 line-clamp-2">
                            {{ $course->name }}
                        </h3>
                        <a href="{{ route('cursos.class', $course->id) }}"
                           class="mt-auto py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white focus:outline-hidden transition-colors duration-300">
                            {{ __('View Course') }}
                        </a>
                    </div>
                @endforeach
            </div>
        @else
            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6">
                <p class="text-sm text-text-500">{{ __('No completed courses yet.') }}</p>
            </div>
        @endif

    </div>
</div>
@endsection
