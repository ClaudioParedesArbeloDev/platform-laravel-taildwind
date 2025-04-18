@extends('components.layout.layout')

@section('title', 'Code & Lens - Info Curso')

@section('content')

    <div class="text-text-900 flex flex-col font-four p-4 lg:flex-row lg:w-full lg:p-20 lg:justify-center">
        
        <div class="lg:w-1/3 px-10">
            <h3 class="py-2 ">{{$course->category}}</h3>
            <h1 class="py-2 font-bold text-xl lg:text-2xl">{{$course->name}}</h1>
            <div class="lg:text-justify"> {!!$course->description!!}</div>
            <p class="py-2">Duración: {{$course->duration}}</p>
            <p class="py-2">Dias: 
                @if (empty($course->days2))
                    <span>{{$course->days1}}</span>
                @else
                <select name="days" id="days">
                    <option class="bg-accent2-700 text-text-100" value="" disabled selected>Seleccione horario</option>
                    <option class="bg-accent2-700 text-text-100 value="1">{{ $course->days1 }}</option>
                    <option class="bg-accent2-700 text-text-100 value="2">{{ $course->days2 }}</option>
                </select>
                
                @endif
            </p>
            <p class="py-2">{{ __('Price') }}: {{ $course->price == 0.00 ? 'Free' : 'u$s' . number_format($course->price, 2) }}</p>

           
            @if (Auth::check())
                <form action="{{route('courses.enroll')}}" method="POST">
                @csrf
                    <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                    <input type="hidden" name="course_id" value="{{$course->id}}">
                    <input type="hidden" id="hidden_enroll_day" name="enroll_day">
                    <button type="submit" class="bg-accent-500 p-2 rounded-md my-4">{{__('Enroll')}}</button>
                </form>
            @else
                <a href="{{ route('login') }}?redirect={{ urlencode(url()->current()) }}" class="bg-accent-500 p-2 rounded-md" id="loginBtn">{{__('Login to Enroll')}}</a>
                <p class="py-4">{{__('Don\'t have an account?'  )}}  <a href="{{route('users.create')}}?redirect={{ urlencode(url()->current()) }}">{{__('Sign up here!!!')}}</a></p>
            @endif 
        </div>
        <img src="{{asset('storage/courses/'.$course->image)}}" alt="image" class="lg:w-160 lg:h-160 lg:object-cover lg:self-center">

    </div>
    @if (session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: '¡Error!',
                text: '{{ session('error') }}',
                confirmButtonText: 'Cerrar'
            });
        </script>
    @endif
   
    @vite('resources/js/enroll.js')
@endsection