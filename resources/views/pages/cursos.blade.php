@extends('components.layout.layout')
@section('title', 'Code & Lens - Cursos')
@section('content')
<div class="flex flex-col m-4 justify-center items-center lg:items-baseline lg:px-[100px] w-full ">
    <h1 class="font-three pt-8 pb-8 lg:text-2xl text-text-500">{{__('Courses')}} {{__('Availables')}}</h1>
    @foreach ($coursesByCategory as $category => $courses)
        <h2 class="font-bold text-text-500 text-lg uppercase">{{$category}}</h2>
        <div class="lg:flex-row lg:flex lg:gap-4 lg:w-5/6 lg:justify-start">
            @foreach ($courses as $course)
                @if($course->active)  
                    <div class="flex flex-col w-60 lg:w-80 mb-4 bg-background-500 border border-variant-100 shadow-2xl rounded-xl">
                        <div class="p-4 md:p-5">
                            <p class="text-text-900">Categoria: {{ $course->category }}</p>
                            <h3 class="text-lg font-bold text-text-900">
                                {{ $course->name }}
                            </h3>
                            <p class="mt-1 text-text-900">
                                {{ __('Price') }}: 
                                {{ $course->price == 0.00 ? 'Free' : 'u$s ' . number_format($course->price, 2) }}
                            </p>
                            <p class="mt-1 text-text-900">
                                Duración: {{ $course->duration }}
                            </p>
                            <a class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-accent-700 text-white hover:bg-accent-900 focus:outline-hidden focus:bg-accent-900 disabled:opacity-50 disabled:pointer-events-none"
                               href="{{ route('cursos.detail', $course->id) }}">
                                <span>{{ __('More Info') }}</span>
                            </a>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach
</div>
@endsection