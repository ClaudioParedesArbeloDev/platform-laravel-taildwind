@extends('layouts.dashLayouts')

@section('title', 'Code & Lens - Courses')
    
@section('content')

<link rel="stylesheet" href="{{ asset('sass/courses/index.css') }}">
<div class="coursesContainer">
    <h2 class="coursesListTitle">{{__('Courses')}}</h2>
    <a class="btnBack" href="{{route('admin')}}"><i class="fa-solid fa-arrow-rotate-left"></i></a>
    <table>
        <thead>
            <tr class="coursesTableHeader">
                <th>{{__('Title')}}</th>
                <th>{{__('Category')}}</th>
                <th>{{__('Active')}}</th>
                <th>{{__('Instructor')}}</th>
                <th>{{__('Edit')}}</th>
                <th>{{__('Students')}}</th>
                <th>{{__('Classes')}}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
            <tr class="coursesTableBody">
                <td>{{ $course->name }}</td>
                <td>{{ $course->category }}</td>
                <td>{{ $course->active ? __('Active') : __('Inactive') }}</td>
                <td>{{ $course->user ? $course->user->name : 'Desconocido' }}</td>
                <td><a href="/courses/{{$course->id}}" class= 'btnEditCourses'>{{__('Edit')}} </a></td>
                <td><a href="{{route('cursos.students', $course->id)}}" class= 'btnStudents'>{{__('Students')}} </a></td>
                <td><a href="{{route('cursos.classes', $course->id)}}" class= 'btnClasses'>{{__('Classes')}} </a></td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>
@endsection