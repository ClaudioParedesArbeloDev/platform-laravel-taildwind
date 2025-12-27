@extends('components.layout.layout')

@section('title', 'Code & Lens - Blogs')

@section('content')

    <div class="text-text-900">
        <img src="{{ asset('images/blogs.png') }}" alt="blogImage" class="w-full object-cover h-30  lg:h-80">
        <div class="py-4 px-2 flex flex-col lg:grid lg:grid-cols-2fr-1fr lg:p-8 lg:gap-x-12 lg:w-9/12 lg:mx-auto">
            <h2 class="font-two pb-2 text-xl lg:text-2xl lg:col-end-1">{{ __("What's New") }}</h2>
            <select name="options" id="options" class="py-2 w-min bg-accent-500 text-white font-one text-xs rounded-md lg:col-end-1">
                <option value="value1">{{__('All Categories')}}</option>
                <option value="programming">{{__('programming')}}</option>
                <option value="value3">{{__('computing')}}</option>
                <option value="value4">{{__('photography')}}</option>
                <option value="value5">{{__('cinematography')}}</option>
            </select> 
            @foreach ($blogs as $blog)
                <div class="flex flex-col lg:w-5/6 lg:col-end-1 lg:items-center lg:flex-row">
                    <div class="flex w-full justify-center items-center py-4">
                        <img src="{{ $blog->image }}" alt="blogImage" class="w-90 object-scale-down h-50 lg:w-100 lg:h-60 lg:mr-12">
                    </div>
                    <div>
                        <h3 class="font-one text-start font-bold lg:text-2xl">{{ $blog->title }}</h3>
                        <p class="font-one uppercase text-xs text-start py-2">{{ $blog->category }}</p>
                        <p class="font-one text-xs text-end py-2">{{$blog->author}} </p>
                        <p class="font-one text-xs text-end py-2">{{$blog->created_at->format('d/m/Y')}}</p>
                        <p class="font-one py-2">{!! $blog->anticipated !!}</p>
                        <div class="flex justify-end items-center">
                            <a href="{{route('blogs.show', $blog)}}" class="bg-accent2-500 text-xs px-4 py-2 hover:bg-accent-500 rounded-md text-text-100">{{__('Read More')}}</a>
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="hidden lg:flex lg:col-end-2 lg:flex-col">
                <h2>{{__('Popular Articles')}}</h2>
            </div>
            {{ $blogs->links() }}
        </div>
    </div>

@endsection