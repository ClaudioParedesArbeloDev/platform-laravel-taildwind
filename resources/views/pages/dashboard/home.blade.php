@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Dashboard')

@section('content')

<div class="bg-background-300 text-text-900 w-full h-full">
        
    <p class="font-one text-center pt-10 font-bold lg:text-2xl">{{__('Hello')}} {{ Auth::user()->name }}</p>
    <h3 class="p-4 text-center lg:text-2xl">{{__('Your courses')}}</h3>
    <div class="coursesContainer">@foreach (Auth::user()->courses as $course)
        <div class="coursesWrapper">
            <div class="courseText">
                <p>{{ $course->category}}</p>
                <h2>{{ $course->name }}</h2>
            </div>
            <a href="{{route('cursos.class', $course->id)}}" class="btnCourse">{{__('Access the course')}}</a>
        </div>
        
        

        
        @endforeach
    </div>
    
</div>

@endsection