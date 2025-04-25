@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Course Edit')
    
@section('content')


    <div class="flex flex-col text-text-900 justify-center h-full items-center font-three">
        <h2 class="font-bold text-xl ">{{__('Edit Course')}}</h2>
        <form action="/courses/{{$course->id}}" method="POST" class="flex flex-col w-4/6">
    
            @csrf
    
            @method('PUT')
    
            <label class="py-2" for="name">{{__('Name')}}:</label>
    
            <input class="p-2 bg-accent-300" type="text" id="name" name="name" value="{{$course->name}}">

            <label class="py-2" for="description">{{__('Description')}}:</label>
    
            <input class="p-2 bg-accent-300" type="text"  id="description" name="description" value="{{$course->description}}">
    
            <label class="py-2" for="image">{{__('Image')}}:</label>
    
            <input class="p-2 bg-accent-300" type="text" id="image" name="image" value="{{$course->image}}">
    
            <label class="py-2" for="price">{{__('Price')}}:</label>
    
            <input class="p-2 bg-accent-300" type="text" id="price" name="price" value="{{$course->price}}">
    
            <label class="py-2" for="days1">{{__('Days')}}:</label>
    
            <input class="p-2 bg-accent-300" type="text" id="days1" name="days1" value="{{$course->days1}}">
    
            <label class="py-2" for="days2">{{__('Days')}}:</label>
    
            <input class="p-2 bg-accent-300" type="text" id="days2" name="days2" value="{{$course->days2}}">
        
            <label class="py-2" for="duration">{{__('Duration')}}:</label>
    
            <input class="p-2 bg-accent-300" type="text" id="duration" name="duration" value="{{$course->duration}}">
    
            <label class="py-2" for="category">{{__('Category')}}:</label>
    
            <input class="p-2 bg-accent-300" type="text"  id="category" name="category" value="{{$course->category}}">
    
            <label class="py-2" for="active">{{__('Active')}}:</label>
            
            <select class="p-2 bg-accent-300" name="active" id="active" class="formInput">
                <option value="1" {{ $course->active ? 'selected' : '' }}>{{__('Active')}}</option>
                <option value="0" {{ $course->active ? '' : 'selected' }}>{{__('Inactive')}}</option>
            </select>
    
    
            <label class="py-2" for="instructor">{{ __('Instructor') }}:</label>

            <select class="p-2 bg-accent-300" class="formInput" id="user_id" name="user_id" required>
            <option value="">{{ __('Select an instructor') }}</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $course->user_id ? 'selected' : '' }}>
                        {{ $user->name }}
                    </option>
                @endforeach
            </select>
            <div class="flex justify-center p-4">
                <button class="bg-accent1-300 p-2 rounded-xl mx-4 cursor-pointer" type="submit">{{__('Update')}}</button>
    
                <a class="bg-accent2-500 p-2 rounded-xl mx-4 cursor-pointer" href="/courses/{{$course->id}}" class="btnCancel">{{__('Cancel')}}</a>
            </div>
    
        </form>
        </div>

@endsection