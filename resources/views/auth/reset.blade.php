@extends('components.layout.layout')

@section('title', 'Code & Lens - Restablecer Contraseña')

@section('content')

    <div class="flex flex-col items-center justify-center text-text-900">
        <h2 class="font-two text-xl p-4 lg:text-2xl">{{ __('Restablecer Contraseña') }}</h2>
        <form action="{{ route('password.update') }}" method="POST" class="font-one flex flex-col p-4">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="flex flex-col">
                <label for="email">{{ __('Correo Electrónico') }}</label>
                <input type="email" name="email" id="email" class="my-4 w-80 lg:w-150 p-2 rounded-md bg-accent2-300 text-text-900" value="{{ old('email') }}" required>
                @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="password">{{ __('Nueva Contraseña') }}</label>
                <input type="password" name="password" id="password" class="my-4 w-80 lg:w-150 p-2 rounded-md bg-accent2-300 text-text-900" required>
                @error('password')
                    <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex flex-col">
                <label for="password_confirmation">{{ __('Confirmar Nueva Contraseña') }}</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="my-4 w-80 lg:w-150 p-2 rounded-md bg-accent2-300 text-text-900" required>
            </div>

            <button type="submit" class="bg-accent2-300 p-2 text-text-900 font-bold text-xs w-60 mx-auto m-4 rounded-xl">{{ __('Restablecer Contraseña') }}</button>
        </form>
    </div>
@endsection
