@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Edit Blog')

@section('content')
<div class="formWrapper mx-auto max-w-2xl px-4 sm:px-6 lg:px-8 py-6 text-text-900">
    <div class="flex justify-between items-center mb-6">
        <h2 class="titleCreate text-2xl font-bold sm:text-3xl">{{ __('Edit Blog') }}</h2>
        <a class="btnBack flex items-center text-blue-600 hover:text-blue-800 transition-colors" href="{{ route('blogs.show', $blog) }}">
            <i class="fa-solid fa-arrow-rotate-left mr-2"></i> {{ __('Back') }}
        </a>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-100 border border-red-400 text-red-700 rounded-md text-sm">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('blogs.update', $blog) }}" method="POST" class="formCreate space-y-6">
        @csrf
        @method('PUT')

        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium lg:pr-2" for="title">{{ __('Title') }}:</label>
            <input class="formInput mt-1 block w-full lg:w-200 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" id="title" name="title" value="{{ old('title', $blog->title) }}" required>
        </div>

        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium lg:pr-2" for="author">{{ __('Author') }}:</label>
            <input class="formInput mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="text" id="author" name="author" value="{{ old('author', $blog->author) }}" required>
        </div>

        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium lg:pr-2" for="category">{{ __('Category') }}:</label>
            <select name="category" id="category" class="formInput mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" required>
                <option value="programacion" {{ old('category', $blog->category) == 'programacion' ? 'selected' : '' }}>{{ __('Programming') }}</option>
                <option value="fotografia" {{ old('category', $blog->category) == 'fotografia' ? 'selected' : '' }}>{{ __('Photography') }}</option>
                <option value="filmmaking" {{ old('category', $blog->category) == 'filmmaking' ? 'selected' : '' }}>{{ __('Filmmaking') }}</option>
            </select>
        </div>

        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium lg:pr-2" for="anticipated">{{ __('Advance') }}:</label>
            <textarea class="formInput mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="anticipated" name="anticipated" rows="3" required>{{ old('anticipated', $blog->anticipated) }}</textarea>
        </div>

        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium lg:pr-2" for="image">{{ __('Image') }}:</label>
            <input class="formInput mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" type="url" id="image" name="image" value="{{ old('image', $blog->image) }}" placeholder="https://" required>
        </div>

        @if ($blog->image)
            <div class="lg:flex lg:items-center">
                <span class="formLabel block text-sm font-medium lg:pr-2">{{ __('Current Image') }}:</span>
                <img src="{{ $blog->image }}" alt="{{ $blog->title }}" class="w-32 h-20 object-cover rounded-md border border-gray-300">
            </div>
        @endif

        <div class="lg:flex lg:items-center">
            <label class="formLabel block text-sm font-medium lg:pr-2" for="body">{{ __('Body') }}:</label>
            <textarea class="formInput mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm" id="body" name="body" rows="10" required>{{ old('body', $blog->body) }}</textarea>
        </div>

        <div class="flex justify-end gap-3">
            <a href="{{ route('blogs.show', $blog) }}" class="px-6 py-2 bg-gray-300 text-text-900 font-semibold rounded-md hover:bg-gray-400 transition-colors">{{ __('Cancel') }}</a>
            <button class="formButton px-6 py-2 bg-blue-600 text-white font-semibold rounded-md hover:bg-blue-700 transition-colors" type="submit">{{ __('Update') }}</button>
        </div>
    </form>
</div>
@endsection
