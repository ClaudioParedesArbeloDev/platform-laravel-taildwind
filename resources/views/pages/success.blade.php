@extends('components.layout.layout')

@section('title', 'Code & Lens - Contact')

@section('content')
    
    <div class="flex flex-col bg-background-100 text-text-900 font-two text-center text-2xl justify-center items-center rounded-lg shadow-lg">
        <img src="{{ asset('images/logo.png') }}" alt="successImage" class="w-60 object-cover h-60 p-4">
        <h2>{{__('Registration successful!')}}</h2>
        <h3>{{__('Welcome to Code & Lens!!!')}}</h3>
    </div>
    <script>
        setTimeout(() => {
            window.location.href = "{{ route('login') }}";
        }, 3000);
    </script>
@endsection