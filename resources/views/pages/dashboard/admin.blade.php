@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Admin')

@section('content')

<div class=" text-text-900 flex items-center lg:w-full justify-center h-full ">
    <div class="grid p-4 rounded-2xl bg-background-500 grid-cols-3 lg:rounded-xl lg:w-3/6 lg:h-4/6 text-center items-center gap-8">
        <h2 class="font-two text-md lg:text-2xl lg:pt-10 col-span-3">{{__('Admin Page')}}</h2>
        <li class="list-none font-bold col-start-1">{{__('users')}}</li>
        <a href="{{route('users.index')}}" class="list-none py-2 border-b-2 border-transparent bg-accent-300 hover:border-accent-500 col-start-2 lg:p-4 lg:rounded-2xl ">{{__('view')}}</a>
        <a href="{{route('users.create')}}" class="list-none py-2 border-b-2 border-transparent bg-accent-300 hover:border-accent-500 col-start-3 lg:p-4 lg:rounded-2xl ">{{__('create')}}</a>
        <li class="list-none font-bold py-2 col-start-1">{{__('courses')}}</li>
        <a href="{{route('courses.index')}}" class="list-none py-2 border-b-2 border-transparent bg-accent-300 hover:border-accent-500 col-start-2 lg:p-4 lg:rounded-2xl ">{{__('view')}}</a>
        <a href="{{route('courses.create')}}" class="list-none py-2 border-b-2 border-transparent bg-accent-300 hover:border-accent-500 col-start-3 lg:p-4 lg:rounded-2xl ">{{__('create')}}</a>
        <li class="list-none font-bold py-2 col-start-1">{{__('classes')}}</li>
        <a href="{{route('classes.create')}}" class="list-none py-2 border-b-2 border-transparent bg-accent-300 hover:border-accent-500 col-start-3 lg:p-4 lg:rounded-2xl ">{{__('create')}}</a>
        <li class="list-none font-bold py-2 col-start-1">{{__('blogs')}}</li>
        <a href="{{route('blogs.index')}}" class="list-none py-2 border-b-2 border-transparent bg-accent-300 hover:border-accent-500 col-start-2 lg:p-4 lg:rounded-2xl ">{{__('view')}}</a>
        <a href="{{route('blogs.create')}}" class="list-none py-2 border-b-2 border-transparent bg-accent-300 hover:border-accent-500 col-start-3 lg:p-4 lg:rounded-2xl ">{{__('create')}}</a>
    </div>
</div>

@endsection