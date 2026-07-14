@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Mi Perfil')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-3xl mx-auto px-4 lg:px-8 py-8">

      
        <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
            {{ __('Dashboard') }}
        </p>
        <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500 mb-8">
            {{ __('My Profile') }}
        </h1>

        <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="font-three text-text-900">
            @csrf
            @method('PUT')

         
            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 lg:p-8 mb-6">

                <div class="flex flex-col items-center mb-8">
                    @if ($user->avatar && $user->avatar->avatar)
                        <img class="w-28 h-28 object-cover rounded-full border-2 border-variant-100" src="{{ asset('storage/avatars/' . $user->avatar->avatar) }}" alt="avatar">
                    @else
                        <img class="w-28 h-28 object-cover rounded-full border-2 border-variant-100" src="{{ asset('images/avatar.png') }}" alt="avatar">
                    @endif

                    <label for="avatar" class="mt-4 text-xs uppercase tracking-wide text-variant-100 cursor-pointer hover:underline">
                        {{ __('Change avatar') }}
                    </label>
                    <input class="hidden" type="file" name="avatar" id="avatar" accept="image/*"
                           onchange="this.closest('form').querySelector('#avatar-filename').textContent = this.files[0]?.name ?? ''">
                    <span id="avatar-filename" class="text-xs text-text-500 mt-1"></span>

                    @error('avatar')
                        <p class="text-xs text-red-500 mt-2">{{ $message }}</p>
                    @enderror
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">

                    <div>
                        <label for="name" class="text-sm font-medium block mb-1">{{ __('Name') }}</label>
                        <input id="name" type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('name') border-red-500 @enderror">
                        @error('name')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="lastname" class="text-sm font-medium block mb-1">{{ __('Lastname') }}</label>
                        <input id="lastname" type="text" name="lastname" value="{{ old('lastname', $user->lastname) }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('lastname') border-red-500 @enderror">
                        @error('lastname')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="email" class="text-sm font-medium block mb-1">{{ __('Email') }}</label>
                        <input id="email" type="email" value="{{ $user->email }}" disabled
                            class="w-full bg-background-300 text-text-500 p-2.5 rounded-lg border border-variant-100 cursor-not-allowed">
                        <p class="text-xs text-text-500 mt-1">{{ __('Contact us to change your email.') }}</p>
                    </div>

                    <div>
                        <label for="username" class="text-sm font-medium block mb-1">{{ __('Username') }}</label>
                        <input id="username" type="text" name="username" value="{{ old('username', $user->username) }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('username') border-red-500 @enderror">
                        @error('username')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="phone" class="text-sm font-medium block mb-1">{{ __('Phone') }}</label>
                        <input id="phone" type="tel" name="phone" value="{{ old('phone', $user->phone) }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('phone') border-red-500 @enderror">
                        @error('phone')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="address" class="text-sm font-medium block mb-1">{{ __('Address') }}</label>
                        <input id="address" type="text" name="address" value="{{ old('address', $user->address) }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('address') border-red-500 @enderror">
                        @error('address')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- ============ CAMBIAR CONTRASEÑA ============ --}}
            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 lg:p-8 mb-6">
                <h2 class="font-three font-bold text-base text-text-900 mb-1">{{ __('Change password') }}</h2>
                <p class="text-xs text-text-500 mb-4">{{ __('Leave these fields blank to keep your current password.') }}</p>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">
                    <div>
                        <label for="password" class="text-sm font-medium block mb-1">{{ __('New password') }}</label>
                        <input id="password" type="password" name="password"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('password') border-red-500 @enderror">
                        @error('password')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password_confirmation" class="text-sm font-medium block mb-1">{{ __('Confirm new password') }}</label>
                        <input id="password_confirmation" type="password" name="password_confirmation"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300">
                    </div>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>{{ __('Update profile') }}</span>
                </button>
            </div>

        </form>

    </div>
</div>

@if (session('success'))
    <script>
        Swal.fire({
            title: "{{ __('Profile updated') }}",
            text: "{{ session('success') }}",
            icon: "success",
            confirmButtonText: "{{ __('Ok') }}",
        });
    </script>
@endif

@endsection
