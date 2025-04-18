@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - User Edit')
    
@section('content')

    
    <div class="font-three text-text-900 flex flex-col p-2 lg:w-5/6 lg:items-center">
    <h2 class="font-bold text-xl py-2 lg:text-2xl lg:p-8">{{ __('Edit User') }}</h2>
    <form action="/users/{{$user->id}}" method="POST" class="flex flex-col lg:">

        @csrf

        @method('PUT')
        <div class="flex justify-end my-2">
            <label for="name" class="py-2 text-xs lg:text-xl">{{__('Name')}}:</label>
            <input class="py-2 text-xs bg-accent-300 p-2 rounded-md w-50 lg:text-xl lg:w-100" type="text" id="name" name="name" value="{{$user->name}}">
        </div>

        <div class="flex justify-end my-2">
            <label class="py-2 text-xs  lg:text-xl" for="lastname">{{__('Lastname')}}:</label>
            <input class="py-2 text-xs bg-accent-300 p-2 rounded-md w-50 lg:text-xl lg:w-100" type="text"  id="lastname" name="lastname" value="{{$user->lastname}}">
        </div>

        <div class="flex justify-end my-2">
            <label class="py-2 text-xs lg:text-xl" for="address">{{__('Address')}}:</label>
            <input class="py-2 text-xs bg-accent-300 p-2 rounded-md w-50 lg:text-xl lg:w-100" type="text" id="address" name="address" value="{{$user->address}}">
        </div>

        <div class="flex justify-end my-2">
            <label for="phone" class="py-2 text-xs lg:text-xl">{{__('Phone')}}:</label>
            <input class="py-2 text-xs bg-accent-300 p-2 rounded-md w-50 lg:text-xl lg:w-100" type="text" id="phone" name="phone" value="{{$user->phone}}">
        </div>

        <div class="flex justify-end my-2">
            <label class="py-2 text-xs text-end lg:text-xl" for="email">{{__('Email')}}:</label>
            <input class="py-2 text-xs bg-accent-300 p-2 rounded-md w-55 lg:text-xl lg:w-100" type="text" id="email" name="email" value="{{$user->email}}">
        </div>

        <div class="flex justify-end my-2">
            <label class="py-2 text-xs lg:text-xl" for="dni">DNI:</label>
            <input class="py-2 text-xs bg-accent-300 p-2 rounded-md w-50 lg:text-xl lg:w-100" type="text" id="dni" name="dni" value="{{$user->dni}}">
        </div>

        <div class="flex justify-end my-2">
            <label class="py-2 text-xs text-end lg:text-xl" for="date_birth">{{__('Date of Birth')}}:</label>
            <input class="py-2 text-xs bg-accent-300 p-2 rounded-md w-60 lg:text-xl lg:w-100" type="text" id="date_birth" name="date_birth" value="{{$user->date_birth}}">
        </div>

        <div class="flex justify-end my-2">
            <label class="py-2 text-xs text-end lg:text-xl" for="username">{{__('Username')}}:</label>
            <input class="py-2 text-xs bg-accent-300 p-2 rounded-md w-55 lg:text-xl lg:w-100" type="text" id="username" name="username" value="{{$user->username}}">
        </div>
        
        <div class="mb-8 flex justify-end my-2"">
            <label class="py-2 text-xs lg:text-xl" for="role">{{ __('Role') }}:</label>
            <select class="py-2 text-xs bg-accent-300 rounded-xs p-2 lg:text-xl" id="role" name="role">
                @foreach($roles as $role)
                    <option  value="{{ $role->id }}" 
                        {{ $user->roles->pluck('id')->contains($role->id) ? 'selected' : '' }}>
                        {{ $role->name }}
                    </option>
                @endforeach
            </select>
        </div>


        <button class="bg-accent2-500 p-2 rounded-md lg:w-50 lg:self-center" type="submit">{{__('Update')}}</button>

        <a class="bg-accent-300 p-2 mt-4 text-center rounded-md lg:w-50 lg:self-center" href="/users/{{$user->id}}" class="btnCancel">{{__('Cancel')}}</a>


    </form>
    </div>

@endsection
