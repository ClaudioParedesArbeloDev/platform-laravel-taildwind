@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Profile')

@section('content')

<form  class="w-full text-text-900 p-4 lg:grid lg:grid-cols-2 lg:w-3/5 lg:max-h-full lg:self-center lg:items-center" action="{{ route('profile.update') }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="grid grid-cols-3 h-full w-full text-text-900">
        @csrf
        @method('PUT')
        <h2 class="font-two text-xl text-center py-4 lg:col-span-2 lg:my-14">{{__('My Profile')}}</h2>
        <div class="w-full lg:col-start-1 lg:row-span-4">
            @if ($user->avatar && $user->avatar->avatar)
                <img class="w-40 h-40 object-cover mx-auto rounded-full lg:w-60 lg:h-60" src="{{ asset('storage/avatars/' . $user->avatar->avatar) }}" alt="avatar">
            @else
                <img class="w-40 h-40 object-cover mx-auto rounded-full" src="{{ asset('images/avatar.png') }}" alt="avatar">
            @endif

            <div class="flex py-2 justify-end lg:col-start-1 lg:justify-center lg:my-8 lg:mx-auto">
                <label class="p-2">{{ __('Avatar') }}:</label>
                <input class="bg-background-500 p-2 w-50 rounded-md" type="file" name="avatar" accept="image/*">
            </div>
            @error('avatar')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
        
        <div class="flex py-2 justify-end lg:col-start-2">
            <label class="p-2">{{__('Name')}}:</label>
            <input class="bg-background-500 p-2 w-50 rounded-md" type="text" name="name" value="{{ old('name', $user->name) }}">
        </div>
        
        <div class="flex py-2 justify-end lg:col-start-2">
            <label class="p-2">{{__('Lastname')}}:</label>
            <input class="bg-background-500 p-2 w-50 rounded-md" type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}">
        </div>

        <div class="flex py-2 justify-end lg:col-start-2">
            <label class="p-2">{{__('Address')}}:</label>
            <input class="bg-background-500 p-2 w-50 rounded-md" type="text" name="address" value="{{ old('address', $user->address) }}">
        </div>

        <div class="flex py-2 justify-end lg:col-start-2">
            <label class="p-2">{{__('Phone')}}:</label>
            <input class="bg-background-500 p-2 w-50 rounded-md" type="text" name="phone" value="{{ old('phone', $user->phone) }}">
        </div>

        <div class="flex py-2 justify-end lg:col-start-2">
            <label class="p-2">{{__('Username')}}:</label>
            <input class="bg-background-500 p-2 w-50 rounded-md" type="text" name="username" value="{{ old('username', $user->username) }}">
        </div>
        <div class="flex justify-end lg:col-span-2">
            <button class="bg-accent2-500 p-2 rounded-md mt-8" type="submit">Actualizar</button>
        </div>
    </form>


@endsection