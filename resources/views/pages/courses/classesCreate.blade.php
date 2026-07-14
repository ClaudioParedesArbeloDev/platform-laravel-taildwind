@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Crear Clase')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-2xl mx-auto px-4 lg:px-8 py-8">

        
        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('Dashboard') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ __('Create Class') }}
                </h1>
            </div>
            <a href="{{ request('course_id') ? route('cursos.classes', request('course_id')) : route('admin') }}" class="text-sm text-variant-100 hover:underline flex items-center gap-x-2">
                <i class="fa-solid fa-arrow-left"></i>
                {{ __('Back') }}
            </a>
        </div>

        <form action="{{ route('classes.store') }}" method="POST" class="font-three text-text-900">
            @csrf

            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 lg:p-8 mb-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4">

                    <div class="sm:col-span-2">
                        <label for="course_id" class="text-sm font-medium block mb-1">{{ __('Course') }} *</label>
                        <select id="course_id" name="course_id"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('course_id') border-red-500 @enderror">
                            <option value="">{{ __('Select a course') }}</option>
                            @php $preselected = old('course_id', request('course_id')); @endphp
                            @foreach ($courses as $course)
                                <option value="{{ $course->id }}" {{ (string) $preselected === (string) $course->id ? 'selected' : '' }}>{{ $course->name }}</option>
                            @endforeach
                        </select>
                        @error('course_id')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="title" class="text-sm font-medium block mb-1">{{ __('Title') }} *</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('title') border-red-500 @enderror">
                        @error('title')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="date" class="text-sm font-medium block mb-1">{{ __('Date') }}</label>
                        <input type="date" id="date" name="date" value="{{ old('date') }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('date') border-red-500 @enderror">
                        @error('date')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="start_time" class="text-sm font-medium block mb-1">{{ __('Start Time') }}</label>
                        <input type="time" id="start_time" name="start_time" value="{{ old('start_time') }}"
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('start_time') border-red-500 @enderror">
                        @error('start_time')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="pdf" class="text-sm font-medium block mb-1">{{ __('PDF') }}</label>
                        <input type="url" id="pdf" name="pdf" value="{{ old('pdf') }}" placeholder="https://..."
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('pdf') border-red-500 @enderror">
                        @error('pdf')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="powerpoint" class="text-sm font-medium block mb-1">{{ __('Powerpoint') }}</label>
                        <input type="url" id="powerpoint" name="powerpoint" value="{{ old('powerpoint') }}" placeholder="https://..."
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('powerpoint') border-red-500 @enderror">
                        @error('powerpoint')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="video" class="text-sm font-medium block mb-1">{{ __('Video') }}</label>
                        <input type="url" id="video" name="video" value="{{ old('video') }}" placeholder="https://..."
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('video') border-red-500 @enderror">
                        @error('video')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="sm:col-span-2">
                        <label for="meet_link" class="text-sm font-medium block mb-1">{{ __('Meet Link') }}</label>
                        <input type="url" id="meet_link" name="meet_link" value="{{ old('meet_link') }}" placeholder="https://..."
                            class="w-full bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('meet_link') border-red-500 @enderror">
                        @error('meet_link')
                            <p class="text-xs text-red-500 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                <div class="mt-6 pt-6 border-t border-variant-100">
                    <label class="flex items-center gap-x-2 text-sm cursor-pointer">
                        <input type="checkbox" name="work" value="1" {{ old('work') ? 'checked' : '' }}
                            class="w-4 h-4 rounded border-variant-100 text-accent-900 focus:ring-accent-900">
                        {{ __('Homework') }}
                    </label>
                </div>
            </div>

            <div class="flex justify-end">
                <button type="submit"
                    class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>{{ __('create') }}</span>
                </button>
            </div>
        </form>

    </div>
</div>
@endsection
