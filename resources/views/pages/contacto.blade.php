@extends('components.layout.layout')

@section('title', 'Code & Lens - Contacto')

@section('content')
    <div class="flex flex-col items-center justify-center text-text-900">
        <h2 class="font-two text-md p-4 lg:text-2xl">{{__('Do you want to contact us?')}}</h2>
        <div>
            <form action="{{route('contact.store')}}" 
                    method="POST" 
                    class="flex flex-col p-4 font-one text-text-900">
                @csrf

                <label for="name" >{{__('Name')}}:</label>
                <input type="text" 
                        name="name" 
                        id="name" value="{{old('name')}}" 
                        class="bg-background-300 text-text-900 p-2 rounded-md my-2 lg:w-3xl
                        @error('name') is-invalid @enderror">
                @error('name')
                    <p class="error">{{$message}}</p>
                @enderror

                <label for="email">{{__('Email')}}:</label>
                <input type="text" 
                        name="email" 
                        id="email" 
                        value="{{old('email')}}" 
                        class="bg-background-300 text-text-900 p-2 rounded-md my-2 lg:w-3xl
                        @error('email') is-invalid @enderror">
                @error('email')
                    <p class="error">{{$message}}</p>
                @enderror

                <label for="subject">{{__('Subject')}}:</label>
                <input type="text" 
                        name="subject" 
                        id="subject" 
                        value="{{old('subject')}}" 
                        class="bg-background-300 text-text-900 p-2 rounded-md my-2 lg:w-3xl
                        @error('subject') is-invalid @enderror">
                @error('subject')
                    <p class="error">{{$message}}</p>
                @enderror

                <label for="message">{{__('Message')}}:</label>
                <textarea name="message" 
                            id="message" 
                            cols="30" rows="10" 
                            value="{{old('message')}}" 
                            class="bg-background-300 text-text-900 p-2 rounded-md my-2 lg:w-3xl
                            @error('message') is-invalid @enderror"></textarea>
                @error('message')
                    <p class="error">{{$message}}</p>
                @enderror

                <button type="submit"
                        class="bg-accent2-700 text-text-100 w-30 h-15 mx-auto my-4 rounded-md cursor-pointer hover:bg-accent2-900">
                        {{__('Send')}}
                </button>
            </form>
            @if (session('message'))
                <script>
                    Swal.fire({
                        title: "{{__('Message send successfully')}}",
                        text: "{{__('Thank you for your message')}}",
                        icon: "success",
                        confirmButtonText: "{{__('Ok')}}",
                    });

                </script>
            @endif
        </div>
    </div>
@endsection
