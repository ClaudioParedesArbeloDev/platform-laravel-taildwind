@extends('components.layout.layout')

@section('title', 'Code & Lens - Cursos')

@section('content')

<div class="flex justify-center items-center">
    @foreach ($coursesByCategory as $category => $courses)
        <div>
            @foreach ($courses as $course)
                <div class="flex flex-col w-60 lg:w-80 mb-4 bg-accent2-500 border border-accent2-500 shadow-2xs rounded-xl  ">
                    <div class="p-4 md:p-5">
                        <p class="text-text-900">Categoria: {{$course->category}}</p>
                        <h3 class="text-lg font-bold text-text-900 ">
                            {{$course->name}}
                        </h3>
                        <p class="mt-1 text-text-900">
                            {{ __('Price') }}: {{ $course->price == 0.00 ? 'Free' : 'u$s' . number_format($course->price, 2) }}
                        </p>
                        <p class="mt-1 text-text-900">
                            Duración: {{$course->duration}}
                        </p>
                        <a class="mt-2 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-accent-700 text-white hover:bg-accent-900 focus:outline-hidden focus:bg-accent-900 disabled:opacity-50 disabled:pointer-events-none" href="{{route('cursos.detail', $course->id)}}">
                            <span>{{__('More Info')}}</span>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>

@endsection