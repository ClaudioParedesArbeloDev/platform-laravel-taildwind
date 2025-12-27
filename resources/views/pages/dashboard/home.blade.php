@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Dashboard')

@section('content')

<div class="bg-background-300 text-text-900 w-full h-full flex flex-col items-center">
        
    <p class="text-center pt-10 font-two lg:text-2xl">{{__('Hello')}} {{ Auth::user()->name }}</p>
    <h3 class="p-4 text-center lg:text-2xl">{{__('Your courses')}}</h3>
    <div class="flex justify-center flex-wrap">@foreach (Auth::user()->courses as $course)
        <div class="border p-4 m-4 w-[250px] rounded-xl border-accent-500 lg:p-8 lg:w-[350px]">
            <div class="py-2">
                <p class="lg:text-xl">{{ $course->category}}</p>
                <h2 class="font-bold lg:text-2xl lg:pb-4">{{ $course->name }}</h2>
            </div>
            <a href="{{route('cursos.class', $course->id)}}" class="bg-accent-300 p-2 rounded-xl">{{__('Access the course')}}</a>
        </div>
        
        

        
        @endforeach
    </div>
    
</div>

@endsection