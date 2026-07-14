@extends('components.layout.layout')

@section('title', 'Code & Lens - Register')

@section('content')
<div class="w-full flex flex-col items-center px-4 py-12 lg:py-16">

    <p class="font-five uppercase tracking-[6px] text-xs lg:text-sm text-variant-100 mb-3">
        {{ __('Company') }}
    </p>
    <h1 class="font-three font-bold text-xl lg:text-3xl text-text-500 mb-8">
        {{ __('Create your account') }}
    </h1>

    <div class="w-full max-w-2xl bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 lg:p-10">

        <form action="{{ route('users.store') }}" method="POST" class="font-three text-text-900">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">

                <div>
                    <label for="name" class="text-sm font-medium block mb-1">{{ __('Name') }} *</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required
                        class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="lastname" class="text-sm font-medium block mb-1">{{ __('Lastname') }} *</label>
                    <input type="text" id="lastname" name="lastname" value="{{ old('lastname') }}" required
                        class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('lastname') border-red-500 @enderror">
                    @error('lastname')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="email" class="text-sm font-medium block mb-1">{{ __('Email') }} *</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required
                        class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="phone" class="text-sm font-medium block mb-1">{{ __('Phone') }} *</label>
                    <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" required
                        class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('phone') border-red-500 @enderror">
                    @error('phone')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="dni" class="text-sm font-medium block mb-1">DNI *</label>
                    <input type="text" id="dni" name="dni" value="{{ old('dni') }}" required
                        class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('dni') border-red-500 @enderror">
                    @error('dni')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="sm:col-span-2">
                    <label for="address" class="text-sm font-medium block mb-1">{{ __('Address') }} *</label>
                    <input type="text" id="address" name="address" value="{{ old('address') }}" required
                        class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('address') border-red-500 @enderror">
                    @error('address')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="date_birth" class="text-sm font-medium block mb-1">{{ __('Date of Birth') }} *</label>
                    <input type="date" id="date_birth" name="date_birth" value="{{ old('date_birth') }}" required
                        class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('date_birth') border-red-500 @enderror">
                    @error('date_birth')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="username" class="text-sm font-medium block mb-1">{{ __('Username') }} *</label>
                    <input type="text" id="username" name="username" value="{{ old('username') }}" required
                        class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('username') border-red-500 @enderror">
                    <p id="response" class="text-xs text-red-500 mt-1"></p>
                    @error('username')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password" class="text-sm font-medium block mb-1">{{ __('Password') }} *</label>
                    <input type="password" id="password" name="password" required
                        class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('password') border-red-500 @enderror">
                    @error('password')
                        <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div>
                    <label for="password_confirmation" class="text-sm font-medium block mb-1">{{ __('Repeat Password') }} *</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required
                        class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300">
                </div>

            </div>

            <input type="hidden" name="redirect" value="{{ request()->get('redirect', route('success')) }}">

            <div class="flex justify-center mt-8">
                <button type="submit"
                    class="py-2.5 px-8 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                    {{ __('Register') }}
                </button>
            </div>

            <p class="text-center text-xs text-text-500 mt-6">
                {{ __('Already have an account?') }}
                <a href="{{ route('login') }}" class="text-variant-100 hover:underline">{{ __('Log in') }}</a>
            </p>
        </form>
    </div>
</div>

@vite('resources/js/login.js')
@endsection
