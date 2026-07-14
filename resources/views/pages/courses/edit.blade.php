@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Editar Curso')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-3xl mx-auto px-4 lg:px-8 py-8">

     
        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('Dashboard') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ $course->name }}
                </h1>
            </div>
            <a href="{{ route('courses.show', $course->id) }}" class="text-sm text-variant-100 hover:underline flex items-center gap-x-2">
                <i class="fa-solid fa-arrow-left"></i>
                {{ __('Back') }}
            </a>
        </div>

        <form action="{{ route('courses.update', $course->id) }}" method="POST" enctype="multipart/form-data" class="font-three text-text-900">
            @csrf
            @method('PUT')
            @include('pages.courses.partials.form')

            <div class="flex gap-x-3">
                <button type="submit"
                    class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>{{ __('Update') }}</span>
                </button>
                <a href="{{ route('courses.show', $course->id) }}"
                   class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-variant-100 text-text-500 hover:bg-background-500 transition-colors duration-300">
                    {{ __('Cancel') }}
                </a>
            </div>
        </form>

    </div>
</div>
@endsection
