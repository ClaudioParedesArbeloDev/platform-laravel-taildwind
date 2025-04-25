@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Create Course')

@section('content')
<div class="formWrapper mx-auto max-w-2xl px-4 sm:px-6 lg:px-8 py-6 text-text-900">
    <div class="flex justify-between items-center mb-6">
        <h2 class="titleCreate text-2xl font-bold sm:text-3xl">{{ __('Create Course') }}</h2>
        <a class="btnBack flex items-center text-blue-600 hover:text-blue-800 transition-colors" href="{{ route('admin') }}">
            <i class="fa-solid fa-arrow-rotate-left mr-2"></i> {{ __('Back') }}
        </a>
    </div>

    <form action="{{ route('courses.index') }}" method="POST" class="formCreate space-y-6" enctype="multipart/form-data">
        @csrf
        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium lg:pr-2" for="name">{{ __('Title') }}:</label>
            <input class="formInput mt-1 block w-full lg:w-200 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" id="name" name="name" required>
        </div>

        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium lg:pr-2" for="description">{{ __('Description') }}:</label>
            <textarea class="formInput mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="description" name="description" rows="4"></textarea>
        </div>

        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium lg:pr-2" for="price">{{ __('Price') }}:</label>
            <input class="formInput mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="number" step="0.01" id="price" name="price">
        </div>

        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium lg:pr-2" for="days1">{{ __('Days1') }}:</label>
            <input class="formInput mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" id="days1" name="days1">
        </div>

        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium lg:pr-2" for="days2">{{ __('Days2') }}:</label>
            <input class="formInput mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" id="days2" name="days2">
        </div>

        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium lg:pr-2" for="duration">{{ __('Duration') }}:</label>
            <input class="formInput mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" id="duration" name="duration">
        </div>

        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium lg:pr-2" for="category">{{ __('Category') }}:</label>
            <select name="category" id="category" class="formInput mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                <option value="programacion">{{ __('Programming') }}</option>
                <option value="fotografia">{{ __('Photography') }}</option>
                <option value="filmmaking">{{ __('Filmmaking') }}</option>
            </select>
        </div>

        <div class="lg:flex lg:items-center">
            <label class="formLabel flex items-center text-sm font-medium" for="active">
                <input type="checkbox" id="active" name="active" value="1" checked class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mr-2">
                {{ __('Active') }}
            </label>
        </div>

        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium" for="user_id">{{ __('Instructor') }}:</label>
            <select class="formInput mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="user_id" name="user_id" required>
                <option value="">{{ __('Select an instructor') }}</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium lg:pr-2" for="image">{{ __('Image') }}:</label>
            <input class="formInput mt-1 block w-full text-sm p-2 border border-gray-300 rounded-md cursor-pointer focus:outline-none" type="file" id="image" name="image" accept="image/*">
        </div>

        <div class="flex justify-end">
            <button class="formButton px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition-colors" type="submit">{{ __('Create') }}</button>
        </div>
    </form>
</div>
@endsection