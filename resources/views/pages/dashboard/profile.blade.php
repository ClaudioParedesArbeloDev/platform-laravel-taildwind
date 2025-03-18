@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Profile')

@section('content')

<form action="{{ route('profile.update') }}" 
            method="POST" 
            enctype="multipart/form-data"
            class="grid grid-cols-3 h-full w-full text-text-900">
        @csrf
        @method('PUT')
        <h2 class="col-span-3 font-two text-xl text-center py-4">{{__('My Profile')}}</h2>
        <div class="col-span-3 w-full">
            @if ($user->avatar && $user->avatar->avatar)
                <img class="w-40 h-40 object-cover mx-auto rounded-full" src="{{ asset('storage/avatars/' . $user->avatar->avatar) }}" alt="avatar">
            @else
                <img class="w-40 h-40 object-cover mx-auto rounded-full" src="{{ asset('images/avatar.png') }}" alt="avatar">
            @endif

            <label class="col-span-3 text-center p-4">{{ __('Avatar') }}:</label>
            <input type="file" name="avatar" accept="image/*">
            
            @error('avatar')
                <span class="error">{{ $message }}</span>
            @enderror
        </div>
    
        <label>{{__('Name')}}:</label>
        <input type="text" name="name" value="{{ old('name', $user->name) }}">
    
        <label>{{__('Lastname')}}:</label>
        <input type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}">
    
        <label>{{__('Address')}}:</label>
        <input type="text" name="address" value="{{ old('address', $user->address) }}">
    
        <label>{{__('Phone')}}:</label>
        <input type="text" name="phone" value="{{ old('phone', $user->phone) }}">
    
        <label>{{__('Username')}}:</label>
        <input type="text" name="username" value="{{ old('username', $user->username) }}">
                
        <button type="submit">Actualizar</button>
    </form>


@endsection