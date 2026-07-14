@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Editar Usuario')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-2xl mx-auto px-4 lg:px-8 py-8">

       
        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('Dashboard') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ __('Edit User') }}
                </h1>
            </div>
            <a href="{{ route('users.show', $user->id) }}" class="text-sm text-variant-100 hover:underline flex items-center gap-x-2">
                <i class="fa-solid fa-arrow-left"></i>
                {{ __('Back') }}
            </a>
        </div>

        <form action="{{ route('users.update', $user->id) }}" method="POST" class="font-three text-text-900">
            @csrf
            @method('PUT')

            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 lg:p-8 mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">

                    <div>
                        <label for="name" class="text-sm font-medium block mb-1">{{ __('Name') }} *</label>
                        <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="lastname" class="text-sm font-medium block mb-1">{{ __('Lastname') }}</label>
                        <input type="text" id="lastname" name="lastname" value="{{ old('lastname', $user->lastname) }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('lastname') border-red-500 @enderror">
                        @error('lastname')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="email" class="text-sm font-medium block mb-1">{{ __('Email') }} *</label>
                        <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('email') border-red-500 @enderror">
                        @error('email')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="text-sm font-medium block mb-1">{{ __('Phone') }}</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="dni" class="text-sm font-medium block mb-1">DNI</label>
                        <input type="text" id="dni" name="dni" value="{{ old('dni', $user->dni) }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('dni') border-red-500 @enderror">
                        @error('dni')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="address" class="text-sm font-medium block mb-1">{{ __('Address') }}</label>
                        <input type="text" id="address" name="address" value="{{ old('address', $user->address) }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('address') border-red-500 @enderror">
                        @error('address')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="date_birth" class="text-sm font-medium block mb-1">{{ __('Date of Birth') }}</label>
                        <input type="date" id="date_birth" name="date_birth" value="{{ old('date_birth', $user->date_birth) }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('date_birth') border-red-500 @enderror">
                        @error('date_birth')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="username" class="text-sm font-medium block mb-1">{{ __('Username') }}</label>
                        <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('username') border-red-500 @enderror">
                        @error('username')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="role" class="text-sm font-medium block mb-1">{{ __('Role') }} *</label>
                        <select id="role" name="role"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('role') border-red-500 @enderror">
                            @foreach ($roles as $role)
                                <option value="{{ $role->id }}" {{ $user->roles->pluck('id')->contains($role->id) ? 'selected' : '' }}>
                                    {{ $role->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('role')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="flex gap-x-3">
                <button type="submit"
                    class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>{{ __('Update') }}</span>
                </button>
                <a href="{{ route('users.show', $user->id) }}"
                   class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-variant-100 text-text-500 hover:bg-background-500 transition-colors duration-300">
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>

    </div>
</div>
@endsection
