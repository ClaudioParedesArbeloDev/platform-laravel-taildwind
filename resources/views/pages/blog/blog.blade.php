@extends('components.layout.layout')

@section('title', 'Code & Lens - Blog')

@section('content')

<div class="text-text-900 p-4 font-one flex justify-center">
    <div class="lg:w-4/6 lg:py-8 flex flex-col">
        <span class="text-xs"> {{__( $blog->category )}}</span>
        <a class="absolute right-10 top-20 lg:top-50 lg:right-20" href="{{route('blogs.index')}}"><i class="fa-solid fa-arrow-rotate-left"></i></a>
        <h3 class="text-xl font-bold py-4 lg:text-3xl">{{ $blog->title }}</h3>
        <p class="text-xs text-end">{{__('Author')}}: {{ $blog->author }}</p>
        <p class="text-xs text-end"> {{ $blog->created_at->locale('es')->translatedFormat('j F Y') }}</p>
        <img src="{{ $blog->image }}" alt="blogImage" class="w-full h-60 object-contain py-4 lg:w-200  lg:h-120 lg:my-8 lg:mx-auto">
        <div class="text-justify lg:text-xl">
            {!! $blog->body !!}
        </div>
    </div>
   
</div>


@endsection