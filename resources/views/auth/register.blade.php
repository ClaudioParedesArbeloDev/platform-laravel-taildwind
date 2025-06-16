@extends('components.layout.layout')

@section('title', 'Code & Lens - Register User')

@section('content')
<div class="py-16">
    <div class="flex flex-col bg-background-300 text-text-700 rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
    
        <h2 class="font-two text-xl lg:text-2xl p-4 mt-3 text-center">{{ __('Register') }}</h2>

        <form action="{{ route('users.index') }}" method="POST" class="formCreate">
            @csrf

            
            <div class="flex flex-col lg:flex-row lg:justify-end">
                <label for="name" class="font-one text-md  p-4 text-center">{{ __('Name') }}:</label>
                <input class="bg-accent2-100 rounded-md p-2 w-full m-2 lg:w-2xl font-three text-text-700" type="text" id="name" name="name" value="{{ old('name') }}" required>
                @error('name')
                    <span class="">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="flex flex-col lg:flex-row lg:justify-end">
                <label for="lastname" class="font-one text-md  p-4 text-center">{{ __('Lastname') }}:</label>
                <input class="bg-accent2-100 rounded-md p-2 w-full m-2 lg:w-2xl font-three text-text-700" type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" required>
                @error('lastname')
                    <span class="">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="flex flex-col lg:flex-row lg:justify-end">
                <label for="address" class="font-one text-md  p-4 text-center">{{ __('Address') }}:</label>
                <input class="bg-accent2-100 rounded-md p-2 w-full m-2 lg:w-2xl font-three text-text-700" type="text" id="address" name="address" value="{{ old('address') }}" required>
                @error('address')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="flex flex-col lg:flex-row lg:justify-end">
                <label for="phone" class="font-one text-md  p-4 text-center">{{ __('Phone') }}:</label>
                <input class="bg-accent2-100 rounded-md p-2 w-full m-2 lg:w-2xl font-three text-text-700" type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
                @error('phone')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="flex flex-col lg:flex-row lg:justify-end">
                <label for="email" class="font-one text-md p-4 text-center">{{ __('Email') }}:</label>
                <input class="bg-accent2-100 rounded-md p-2 w-full m-2 lg:w-2xl font-three text-text-700" type="email" id="email" name="email" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="flex flex-col lg:flex-row lg:justify-end">
                <label for="dni" class="font-one text-md p-4 text-center">DNI:</label>
                <input class="bg-accent2-100 rounded-md p-2 w-full m-2 lg:w-2xl font-three text-text-700" type="text" id="dni" name="dni" value="{{ old('dni') }}" required>
                @error('dni')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="flex flex-col lg:flex-row lg:justify-end">
                <label for="date_birth" class="font-one text-md p-4 text-center">{{ __('Date of Birth') }}:</label>
                <input class="bg-accent2-100 rounded-md p-2 w-full m-2 lg:w-2xl font-three text-text-700" type="date" id="date_birth" name="date_birth" value="{{ old('date_birth') }}" required>
                @error('date_birth')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

           
            <div class="flex flex-col lg:flex-row lg:justify-end">
                <label for="username" class="font-one text-md  p-4 text-center">{{ __('Username') }}:</label>
                <input class="bg-accent2-100 rounded-md p-2 w-full m-2 lg:w-2xl font-three text-text-700" type="text" id="username" name="username" value="{{ old('username') }}" required>
                <span id='response'></span>
                <span id="username-error" class="error-message"></span>
                @error('username')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            
            <div class="flex flex-col lg:flex-row lg:justify-end">
                <label for="password" class="font-one text-md  p-4 text-center">{{ __('Password') }}:</label>
                <input class="bg-accent2-100 rounded-md p-2 w-full m-2 lg:w-2xl font-three text-text-700" type="password" id="password" name="password" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>


            <div class="flex flex-col lg:flex-row lg:justify-end">
                <label for="password_confirmation" class="font-one text-md  p-4 text-center">{{ __('Repeat Password') }}:</label>
                <input class="bg-accent2-100 rounded-md p-2 w-full m-2 lg:w-2xl font-three text-text-700" type="password" id="password_confirmation" name="password_confirmation" required>
                @error('password_confirmation')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <input type="hidden" name="redirect" value="{{ request()->get('redirect', route('success')) }}">
            <div class="flex justify-center m-8">
                <button type="submit" 
                    class="g-recaptcha flex justify-center items-center border-2 p-2 bg-accent-700 text-text-100 rounded-xl"
                     data-sitekey="6LdEC2MrAAAAAMRnpaI1B9OobpvzkV1fDg1Q--Wy" 
                    data-callback='onSubmit' 
                    data-action='submit'>
                    {{ __('Register') }}
                </button>
            </div>
        </form>
        <script src="https://www.google.com/recaptcha/api.js"></script>
        <script>
            function onSubmit(token) {
            document.getElementById("demo-form").submit();
            }
        </script>
    </div>
</div>
    @vite('resources/js/login.js')
@endsection
