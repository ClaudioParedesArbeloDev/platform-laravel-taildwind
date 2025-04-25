@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Create Class')

@section('content')
<div class="mx-auto max-w-2xl px-4 sm:px-6 lg:px-8 py-6 text-text-900">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold sm:text-3xl">{{ __('Create Class') }}</h2>
        <a class="flex items-center text-blue-600 hover:text-blue-800 px-12 transition-colors" href="{{ route('admin') }}">
            <i class="fa-solid fa-arrow-rotate-left mr-2"></i> {{ __('Back') }}
        </a>
    </div>

    <form action="{{ route('classes.index') }}" method="POST" class="space-y-6 w-200">
        @csrf
        <div>
            <label class="block text-sm font-medium" for="course_id">{{ __('Course') }}:</label>
            <select class="formInput mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="course_id" name="course_id" required>
                <option class="bg-accent-500" value="">{{ __('Select a course') }}</option>
                @foreach($courses as $course)
                    <option class="bg-accent-500" value="{{ $course->id }}">{{ $course->name }}</option>
                @endforeach
            </select>
        </div>

        <div>
            <label class="block text-sm font-medium" for="title">{{ __('Title') }}:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" id="title" name="title" required>
        </div>

        <div>
            <label class="block text-sm font-medium" for="date">{{ __('Date') }}:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="date" id="date" name="date">
        </div>

        <div>
            <label class="block text-sm font-medium" for="start_time">{{ __('Start Time') }}:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="time" id="start_time" name="start_time">
        </div>

        <div>
            <label class="block text-sm font-medium" for="pdf">{{ __('PDF') }}:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" id="pdf" name="pdf">
        </div>

        <div>
            <label class="block text-sm font-medium" for="powerpoint">{{ __('Powerpoint') }}:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" id="powerpoint" name="powerpoint">
        </div>

        <div>
            <label class="block text-sm font-medium" for="video">{{ __('Video') }}:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" id="video" name="video">
        </div>

        <div>
            <label class="flex items-center text-sm font-medium" for="work">
                <input type="checkbox" id="work" name="work" value="1" class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded mr-2">
                {{ __('Homework') }}
            </label>
        </div>

        <div>
            <label class="block text-sm font-medium" for="meet_link">{{ __('Meet Link') }}:</label>
            <input class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" id="meet_link" name="meet_link">
        </div>

        <div class="flex justify-end">
            <button class="formButton px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition-colors" type="submit">{{ __('Create') }}</button>
        </div>
    </form>
</div>
@endsection