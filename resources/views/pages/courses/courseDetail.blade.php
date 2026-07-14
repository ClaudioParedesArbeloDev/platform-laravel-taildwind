@extends('components.layout.layout')

@section('title', 'Code & Lens - Info Curso')

@section('content')

    <div class="text-text-900 flex flex-col font-five p-4 lg:flex-row lg:w-full lg:p-20 lg:justify-center">
        
        <div class="lg:w-1/3 px-10">
            <h3 class="py-2">{{$course->category}}</h3>
            <h1 class="py-2 font-bold text-xl lg:text-2xl">{{$course->name}}</h1>
            <div class="lg:text-justify">{!!$course->description!!}</div>
            <p class="py-2">Duración: {{$course->duration}}</p>
            
           
            <p class="py-2">Días: 
                @if (empty($course->days2))
                    
                    <span>{{$course->days1}}</span>
                @else
                    
                    <select name="days" id="days" class="w-[230px] bg-accent2-700 text-text-100 rounded-md px-3 py-2">
                        <option class="bg-accent2-700 text-text-100" value="" disabled selected>Seleccione horario</option>
                        @if($course->enroll_day_1 > 0)
                            <option class="bg-accent2-700 text-text-100" value="1">
                                {{ $course->days1 }} - Quedan {{ $course->enroll_day_1}} lugares disponibles
                            </option>
                        @else
                            <option class="bg-gray-500 text-gray-300" value="1" disabled>
                                {{ $course->days1 }} - Sin cupos
                            </option>
                        @endif
                        
                        @if($course->enroll_day_2 > 0)
                            <option class="bg-accent2-700 text-text-100" value="2">
                                {{ $course->days2 }} - Quedan {{ $course->enroll_day_2}} lugares disponibles
                            </option>
                        @else
                            <option class="bg-gray-500 text-gray-300" value="2" disabled>
                                {{ $course->days2 }} - Sin cupos
                            </option>
                        @endif
                    </select>
                    
                    @if($course->enroll_day_1 == 0 && $course->enroll_day_2 == 0)
                        <span class="text-red-600 text-sm block mt-2">⚠️ No hay cupos disponibles</span>
                    @endif
                @endif
            </p>
            
           
            <p class="py-2 text-lg font-semibold">
                {{ __('Price') }}: 
                @if($course->price == 0)
                    <span class="text-green-600">GRATIS</span>
                @else
                    <span class="text-accent-600">${{ number_format($course->price, 2, ',', '.') }}</span>
                @endif
            </p>

           
            @if (Auth::check())
                @php
                    $isEnrolled = Auth::user()->courses()->where('course_id', $course->id)->exists();
                    $hasAvailableSlots = empty($course->days2) || ($course->enroll_day_1 > 0 || $course->enroll_day_2 > 0);
                @endphp
                
                @if($isEnrolled)
                   
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-md my-4">
                        ✓ Ya estás inscrito en este curso
                    </div>
                    <a href="{{route('dashboard')}}" class="bg-accent-500 hover:bg-accent-600 text-white font-semibold p-3 rounded-md inline-block my-2 transition duration-200">
                        Ir al Dashboard
                    </a>


                    
                @elseif(!$hasAvailableSlots)
                    
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-md my-4">
                        ⚠️ No hay cupos disponibles
                    </div>
                    
                @else
                    
                    @if($course->price > 0)
                       
                        <div class="my-4">
                            @if(!empty($course->days2))
                               
                                <form id="checkoutForm" action="{{route('checkout.show', $course->id)}}" method="GET">
                                    <input type="hidden" id="hidden_enroll_day_checkout" name="enroll_day">
                                    <button type="submit" 
                                            class="bg-accent-500 hover:bg-accent-600 text-white font-semibold p-3 rounded-md cursor-pointer transition duration-200 w-full lg:w-auto"
                                            id="checkoutBtn">
                                        💳 Proceder al pago
                                    </button>
                                </form>
                            @else
                                
                                <a href="{{route('checkout.show', $course->id)}}" 
                                   class="bg-accent-500 hover:bg-accent-600 text-white font-semibold p-3 rounded-md inline-block cursor-pointer transition duration-200">
                                    💳 Proceder al pago
                                </a>
                            @endif
                        </div>
                        
                    @else
                        
                        <form action="{{route('courses.enroll')}}" method="POST" id="enrollForm">
                            @csrf
                            <input type="hidden" name="user_id" value="{{auth()->user()->id}}">
                            <input type="hidden" name="course_id" value="{{$course->id}}">
                            <input type="hidden" id="hidden_enroll_day" name="enroll_day">
                            <button type="submit" 
                                    class="bg-green-500 hover:bg-green-600 text-white font-semibold p-3 rounded-md my-4 cursor-pointer transition duration-200"
                                    id="enrollBtn">
                                ✓ Inscribirme Gratis
                            </button>
                        </form>
                    @endif
                @endif
                
            @else
               
                <div class="my-4">
                    <a href="{{ route('login') }}?redirect={{ urlencode(url()->current()) }}" 
                       class="bg-accent-500 hover:bg-accent-600 text-white font-semibold p-3 rounded-md inline-block transition duration-200" 
                       id="loginBtn">
                        {{__('Login to Enroll')}}
                    </a>
                    <p class="py-4">
                        {{__('Don\'t have an account?')}}  
                        <a href="{{route('users.create')}}?redirect={{ urlencode(url()->current()) }}" 
                           class="text-accent-600 hover:underline font-semibold">
                            {{__('Sign up here!!!')}}
                        </a>
                    </p>
                </div>
            @endif 
        </div>
        
        
        <img src="{{asset('storage/courses/'.$course->image)}}" 
             alt="{{$course->name}}" 
             class="lg:w-160 lg:h-160 lg:object-cover lg:self-center rounded-lg shadow-lg">

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
    
    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: '¡Éxito!',
                text: '{{ session('success') }}',
                confirmButtonText: 'Aceptar'
            });
        </script>
    @endif
   
    @vite('resources/js/enroll.js')
@endsection