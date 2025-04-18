@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - My Path')

@section('content')

    <link rel="stylesheet" href="{{ asset('sass/dashboard/myPath/myPath.css') }}">

    <div class="container">
        <h2>{{ __('My Learning Path') }}</h2>

        @php
            $inProgressCourses = Auth::user()->courses->where('pivot.status', 'in progress');
            $completedCourses = Auth::user()->courses->where('pivot.status', 'completed');
        @endphp

       
        <h3>{{ __('In Progress') }}</h3>
        @if ($inProgressCourses->isNotEmpty())
            <div class="course-list">
                @foreach ($inProgressCourses as $course)
                    <div class="course-item">
                        <p class="course-name">{{ $course->name }}</p>
                        <a href="{{route('cursos.class', $course->id)}}" class="btn">{{ __('View Course') }}</a>
                    </div>
                @endforeach
                </div>
        @else
            <p>{{ __('No courses in progress.') }}</p>
        @endif

        
        <h3>{{ __('Completed') }}</h3>
        @if ($completedCourses->isNotEmpty())
            <div class="course-list completed">
                @foreach ($completedCourses as $course)
                    <div class="course-item">
                        <p class="course-name">{{ $course->name }}</p>
                        <a href="{{route('cursos.class', $course->id)}}" class="btn">{{ __('View Course') }}</a>
                    </div>
                @endforeach
                </div>
        @else
            <p>{{ __('No completed courses yet.') }}</p>
        @endif

    </div>

@endsection
