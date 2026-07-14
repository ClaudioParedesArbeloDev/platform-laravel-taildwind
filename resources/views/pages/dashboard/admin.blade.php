@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Admin')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-5xl mx-auto px-4 lg:px-8 py-8">

       
        <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
            {{ __('Dashboard') }}
        </p>
        <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500 mb-8">
            {{ __('Admin Page') }}
        </h1>

      
        <div class="flex flex-wrap gap-4 mb-10">

            <div class="flex items-center gap-x-4 bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5 w-full sm:w-56">
                <div class="w-11 h-11 shrink-0 rounded-full bg-accent1-300 flex items-center justify-center">
                    <i class="fa-solid fa-users text-lg text-accent1-900"></i>
                </div>
                <div>
                    <p class="text-xl font-bold text-text-900">{{ $stats['users'] }}</p>
                    <p class="text-xs uppercase tracking-wide text-variant-100">{{ __('users') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-x-4 bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5 w-full sm:w-56">
                <div class="w-11 h-11 shrink-0 rounded-full bg-accent-300 flex items-center justify-center">
                    <i class="fa-solid fa-graduation-cap text-lg text-accent-900"></i>
                </div>
                <div>
                    <p class="text-xl font-bold text-text-900">{{ $stats['courses'] }}</p>
                    <p class="text-xs uppercase tracking-wide text-variant-100">{{ __('courses') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-x-4 bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5 w-full sm:w-56">
                <div class="w-11 h-11 shrink-0 rounded-full bg-accent2-300 flex items-center justify-center">
                    <i class="fa-solid fa-layer-group text-lg text-accent2-900"></i>
                </div>
                <div>
                    <p class="text-xl font-bold text-text-900">{{ $stats['software'] }}</p>
                    <p class="text-xs uppercase tracking-wide text-variant-100">{{ __('software') }}</p>
                </div>
            </div>

            <div class="flex items-center gap-x-4 bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5 w-full sm:w-56">
                <div class="w-11 h-11 shrink-0 rounded-full bg-accent1-300 flex items-center justify-center">
                    <i class="fa-solid fa-newspaper text-lg text-accent1-900"></i>
                </div>
                <div>
                    <p class="text-xl font-bold text-text-900">{{ $stats['blogs'] }}</p>
                    <p class="text-xs uppercase tracking-wide text-variant-100">{{ __('blogs') }}</p>
                </div>
            </div>

            @if ($stats['pendingOrders'] > 0)
                <div class="flex items-center gap-x-4 bg-background-500 border border-yellow-500 shadow-2xs rounded-xl p-5 w-full sm:w-56">
                    <div class="w-11 h-11 shrink-0 rounded-full bg-yellow-100 flex items-center justify-center">
                        <i class="fa-solid fa-clock text-lg text-yellow-700"></i>
                    </div>
                    <div>
                        <p class="text-xl font-bold text-yellow-700">{{ $stats['pendingOrders'] }}</p>
                        <p class="text-xs uppercase tracking-wide text-yellow-700">{{ __('pending orders') }}</p>
                    </div>
                </div>
            @endif

        </div>

        
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6">
                <h2 class="font-three font-bold text-base text-text-900 mb-4">{{ __('sales') }}</h2>
                <div class="flex gap-x-3">
                    <a href="{{ route('sales.index') }}" class="flex-1 py-2 px-3 text-center text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white transition-colors duration-300">{{ __('view') }}</a>
                </div>
            </div>

            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6">
                <h2 class="font-three font-bold text-base text-text-900 mb-4">{{ __('users') }}</h2>
                <div class="flex gap-x-3">
                    <a href="{{ route('users.index') }}" class="flex-1 py-2 px-3 text-center text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white transition-colors duration-300">{{ __('view') }}</a>
                    <a href="{{ route('users.create') }}" class="flex-1 py-2 px-3 text-center text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 transition-opacity duration-300">{{ __('create') }}</a>
                </div>
            </div>

            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6">
                <h2 class="font-three font-bold text-base text-text-900 mb-4">{{ __('courses') }}</h2>
                <div class="flex gap-x-3">
                    <a href="{{ route('courses.index') }}" class="flex-1 py-2 px-3 text-center text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white transition-colors duration-300">{{ __('view') }}</a>
                    <a href="{{ route('courses.create') }}" class="flex-1 py-2 px-3 text-center text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 transition-opacity duration-300">{{ __('create') }}</a>
                </div>
            </div>

            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6">
                <h2 class="font-three font-bold text-base text-text-900 mb-4">{{ __('software') }}</h2>
                <div class="flex gap-x-3">
                    <a href="{{ route('software.index') }}" class="flex-1 py-2 px-3 text-center text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white transition-colors duration-300">{{ __('view') }}</a>
                    <a href="{{ route('software.create') }}" class="flex-1 py-2 px-3 text-center text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 transition-opacity duration-300">{{ __('create') }}</a>
                </div>
            </div>

            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6">
                <h2 class="font-three font-bold text-base text-text-900 mb-4">{{ __('blogs') }}</h2>
                <div class="flex gap-x-3">
                    <a href="{{ route('blogs.index') }}" class="flex-1 py-2 px-3 text-center text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white transition-colors duration-300">{{ __('view') }}</a>
                    <a href="{{ route('blogs.create') }}" class="flex-1 py-2 px-3 text-center text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 transition-opacity duration-300">{{ __('create') }}</a>
                </div>
            </div>

            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6">
                <h2 class="font-three font-bold text-base text-text-900 mb-4">{{ __('classes') }}</h2>
                <div class="flex gap-x-3">
                    <a href="{{ route('classes.create') }}" class="flex-1 py-2 px-3 text-center text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 transition-opacity duration-300">{{ __('create') }}</a>
                </div>
            </div>

            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6">
                <h2 class="font-three font-bold text-base text-text-900 mb-4">{{ __('attendance') }}</h2>
                <div class="flex gap-x-3">
                    <a href="{{ route('attendance.index') }}" class="flex-1 py-2 px-3 text-center text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white transition-colors duration-300">{{ __('choise course') }}</a>
                </div>
            </div>

        </div>

    </div>
</div>
@endsection
