@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Crear Curso')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-3xl mx-auto px-4 lg:px-8 py-8">

       
        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('Dashboard') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ __('Create Course') }}
                </h1>
            </div>
            <a href="{{ route('courses.index') }}" class="text-sm text-variant-100 hover:underline flex items-center gap-x-2">
                <i class="fa-solid fa-arrow-left"></i>
                {{ __('Back') }}
            </a>
        </div>

        <form action="{{ route('courses.store') }}" method="POST" enctype="multipart/form-data" class="font-three text-text-900">
            @csrf
            @include('pages.courses.partials.form')

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
