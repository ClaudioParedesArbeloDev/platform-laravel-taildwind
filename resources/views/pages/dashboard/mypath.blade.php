@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - My Path')

@section('content')

    <div class="flex flex-col text-text-900 items-center font-three">
        <h2 class="font-bold text-xl py-4 lg:text-2xl lg:p-8">{{ __('My Learning Path') }}</h2>

        @php
            $inProgressCourses = Auth::user()->courses->where('pivot.status', 'in progress');
            $completedCourses = Auth::user()->courses->where('pivot.status', 'completed');
        @endphp

       
        <h3 class="font-bold text-lg py-4">{{ __('In Progress') }}</h3>
        @if ($inProgressCourses->isNotEmpty())
            <div class="flex flex-wrap">
                @foreach ($inProgressCourses as $course)
                    <div class="border p-4 rounded-xl border-accent-500">
                        <p class="py-2 font-bold lg:text-xl">{{ $course->name }}</p>
                        <a href="{{route('cursos.class', $course->id)}}" class="bg-accent-300 p-2 rounded-xl">{{ __('View Course') }}</a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="py-4">{{ __('No courses in progress.') }}</p>
        @endif

        
        <h3 class="font-bold text-lg py-4">{{ __('Completed') }}</h3>
        @if ($completedCourses->isNotEmpty())
            <div class="flex flex-wrap">
                @foreach ($completedCourses as $course)
                    <div class="border p-4 rounded-xl border-accent-500">
                        <p class="py-2 font-bold lg:text-xl">{{ $course->name }}</p>
                        <a href="{{route('cursos.class', $course->id)}}" class="bg-accent-300 p-2 rounded-xl">{{ __('View Course') }}</a>
                    </div>
                @endforeach
            </div>
        @else
            <p class="py-4">{{ __('No completed courses yet.') }}</p>
        @endif

    </div>

@endsection
