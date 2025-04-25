@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Cursos')
    
@section('content')

    <div class="flex flex-wrap text-text-900 justify-center items-center h-full">
        
        @foreach ($coursesByCategory as $category => $courses)
            <div class="coursesWrapper">   
                <div class="flex flex-wrap justify-center items-center h-full">
                    @foreach ($courses as $course)
                        <div class="border p-4 rounded-xl border-accent-500 lg:p-8">
                            <div>
                                <h4 class="font-bold text-xs py-2">{{ $course->category }}</h4>
                            </div>
                            <div class="">
                                <h5 class="font-bold text-lg py-2">{{ $course->name }}</h5>
                                <p>Duración: {{$course->duration}}</p>
                                <p class="py-2">{{ __('Price') }}: {{ $course->price == 0.00 ? 'Free' : 'u$s' . number_format($course->price, 2) }}</p>
                                <a href="{{route('cursos.detail', $course->id)}}" 
                                    class="bg-accent-300 p-2 rounded-xl"
                                    data-tooltip="{{ __('Invest in your future!') }}"
                                    >
                                    <span>{{__('More Info')}}</span>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endforeach
    </div>
@endsection