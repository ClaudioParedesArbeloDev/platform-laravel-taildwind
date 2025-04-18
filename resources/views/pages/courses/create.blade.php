@extends('layouts.dashLayouts')

@section('title', 'Code & Lens - Create Course')

@section('content')

<link rel="stylesheet" href="{{asset('sass/courses/create/create.css')}}">
<div class="formWrapper">
<h2 class="titleCreate">{{__('Create Course')}}</h2>
<a class="btnBack" href="{{route('admin')}}"><i class="fa-solid fa-arrow-rotate-left"></i></a>
<form 
    action="{{route('courses.index')}}" 
    method="POST" class="formCreate"
    enctype="multipart/form-data"
    >
    @csrf
    <label class="formLabel" for="name">{{__('Title')}}:</label>
        
    <input class="formInput" type="text" id="name" name="name" >
    
    <label class="formLabel" for="description">{{__('Description')}}:</label>
    
    <input class="formInput" type="text"  id="description" name="description" >

    <label class="formLabel" for="price">{{__('Price')}}:</label>
    
    <input class="formInput" type="text" id="price" name="price" >

    <label class="formLabel" for="days1">{{__('Days1')}}:</label>

    <input class="formInput" type="text" id="days1" name="days1" >

    <label class="formLabel" for="days2">{{__('Days2')}}:</label>

    <input class="formInput" type="text" id="days2" name="days2" >

    <label class="formLabel" for="duration">{{__('Duration')}}:</label>

    <input class="formInput" type="text" id="duration" name="duration" >

    <label class="formLabel" for="category">{{__('Category')}}:</label>

    <select name="category" id="category" class="formInput">
        <option value="programacion">{{__('Programming')}}</option>
        <option value="fotografia">{{__('Photography')}}</option>
        <option value="filmmaking">{{__('Filmmaking')}}</option>

    <label class="formLabel" for="active">{{__('Active')}}:</label>
    
    <input type="checkbox" id="active" name="active" value="1" checked>


    <label class="formLabel" for="instructor">{{__('Instructor')}}:</label>

    <select class="formInput" id="user_id" name="user_id" required>
    <option value="">{{__('Select an instructor')}}</option>
    @foreach($users as $user)
        <option value="{{ $user->id }}">{{ $user->name }}</option>
    @endforeach
    </select>

    <label class="formLabel" for="image">{{__('Image')}}:</label>
    
    <input class="formInput" type="file" id="image" name="image"  accept="image/*">
        
    <button class="formButton" type="submit">{{__('Create')}}</button>
    
</form>
</div>

@endsection