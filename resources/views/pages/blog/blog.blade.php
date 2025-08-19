@extends('components.layout.layout')

@section('title', 'Code & Lens - Blog')

@section('content')

<div class="text-text-900 p-4 font-one flex justify-center">
    
    <div class="lg:w-4/6 lg:py-8 flex flex-col">
        <div class="flex justify-end items-center">
            <a href="{{route('blogs.index')}}" class="bg-accent2-500 text-xs px-4 py-2 hover:bg-accent-500 rounded-md text-text-100">{{__('Back')}}</a>
        </div>
        <span class="text-xs uppercase"> {{__( $blog->category )}}</span>
        <h3 class="text-xl font-bold py-4 lg:text-3xl">{{ $blog->title }}</h3>
        <p class="text-xs text-end">{{__('Author')}}: {{ $blog->author }}</p>
        <p class="text-xs text-end"> {{ $blog->created_at->locale('es')->translatedFormat('j F Y') }}</p>
        <img src="{{ $blog->image }}" alt="blogImage" class="w-full h-60 object-contain py-4 lg:w-200  lg:h-120 lg:my-8 lg:mx-auto">
        <div class="text-justify lg:text-xl">
            {!! $blog->body !!}
        </div>
        <div>
            Comentarios
        </div>
    </div>
   
</div>


@endsection