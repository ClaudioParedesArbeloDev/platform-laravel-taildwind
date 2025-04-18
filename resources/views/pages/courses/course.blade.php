@extends('layouts.dashLayouts')

@section('title', 'Code & Lens - Course')
    
@section('content')

<link rel="stylesheet" href="{{ asset('sass/courses/course/course.css') }}">

<div class="courseContainer">
    <h2>{{ __('course') }}:</h2>
    <a class="btnBack" href="{{route('admin')}}"><i class="fa-solid fa-arrow-rotate-left"></i></a>
    <h3>{{__('Title')}}: {{ $course->name }}</h3>
    <p>{{__('Teacher')}}: {{ $course->user->name }}</p>
    <p>{{__('Description')}}: {{ $course->description }}</p>
    <p>{{ __('Price') }}: {{ $course->price == 0.00 ? 'Free' : '$' . number_format($course->price, 2) }}</p>
    
    @if (($course->days1 != null) || ($course->days1 != ''))
        <p>{{__('Days')}}: {{ $course->days1 }}</p>
    @endif
    @if (($course->schedule != null) || ($course->days2 != ''))
        <p>{{__('Days')}}: {{ $course->days2 }}</p>
        
    @endif
    @if (($course->duration != null) || ($course->duration != ''))
        <p>{{__('Duration')}}: {{ $course->duration }}</p>
    @endif
    @if (($course->capacity != null) || ($course->capacity != ''))
        <p>{{__('Capacity')}}: {{ $course->capacity }}</p>
    @endif
    @if (($course->category != null) || ($course->category != ''))
        <p>{{__('Category')}}: {{ $course->category }}</p>
    @endif
    @if (($course->active != null) || ($course->active != ''))
        <p>{{__('Active')}}: {{ $course->active ? __('Active') : __('Inactive') }}</p>
    @endif    
    @if ($course->image != null)
        <img src="{{ asset('storage/courses/'.$course->image) }}" alt="courseImage">    
    @endif
    <div class="btnEditCourses">
        <a href="/courses/{{$course->id}}/edit" class = 'btnEdit'>{{__('Edit Course')}}</a>
        <form action="/courses/{{$course->id}}" method="POST" id="deleteUserForm" >

            @csrf

            @method('DELETE')

            <button type="submit" class="deleteUser">{{__('Delete Course')}}</button>
        </form>
    </div>
</div>
    
@endsection