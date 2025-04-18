@extends('layouts.dashLayouts')

@section('title', 'Code & Lens - Course Edit')
    
@section('content')
    <link rel="stylesheet" href="{{asset('sass/courses/edit/edit.css')}}">

    <div class="EditWrapper">
        <h2 class="titleCreate">{{__('Edit Course')}}</h2>
        <form action="/courses/{{$course->id}}" method="POST" class="formCreate">
    
            @csrf
    
            @method('PUT')
    
            <label for="name">{{__('Name')}}:</label>
    
            <input type="text" id="name" name="name" value="{{$course->name}}">

            <label for="description">{{__('Description')}}:</label>
    
            <input type="text"  id="description" name="description" value="{{$course->description}}">
    
            <label for="image">{{__('Image')}}:</label>
    
            <input type="text" id="image" name="image" value="{{$course->image}}">
    
            <label for="price">{{__('Price')}}:</label>
    
            <input type="text" id="price" name="price" value="{{$course->price}}">
    
            <label for="days1">{{__('Days')}}:</label>
    
            <input type="text" id="days1" name="days1" value="{{$course->days1}}">
    
            <label for="days2">{{__('Days')}}:</label>
    
            <input type="text" id="days2" name="days2" value="{{$course->days2}}">
        
            <label for="duration">{{__('Duration')}}:</label>
    
            <input type="text" id="duration" name="duration" value="{{$course->duration}}">
    
            <label for="category">{{__('Category')}}:</label>
    
            <input type="text"  id="category" name="category" value="{{$course->category}}">
    
            <label for="active">{{__('Active')}}:</label>
            
            <select name="active" id="active" class="formInput">
                <option value="1" {{ $course->active ? 'selected' : '' }}>{{__('Active')}}</option>
                <option value="0" {{ $course->active ? '' : 'selected' }}>{{__('Inactive')}}</option>
            </select>
    
    
            <label for="instructor">{{ __('Instructor') }}:</label>

            <select class="formInput" id="user_id" name="user_id" required>
            <option value="">{{ __('Select an instructor') }}</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $course->user_id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
             
            <button type="submit">{{__('Update')}}</button>
    
            <a href="/courses/{{$course->id}}" class="btnCancel">{{__('Cancel')}}</a>
    
    
        </form>
        </div>

@endsection