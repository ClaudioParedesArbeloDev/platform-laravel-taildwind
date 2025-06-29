@extends('components.layout.layout')

@section('title', 'Code & Lens - Login')



@section('content')
    

<div class="py-16">
    <div class="flex bg-background-300 rounded-lg shadow-lg overflow-hidden mx-auto max-w-sm lg:max-w-4xl">
        <div class="hidden lg:block lg:w-1/2 bg-cover"
            style="background-image:url('images/logo1.jpg')">
        </div>
        <div class="w-full p-8 lg:w-1/2">
            <h2 class="text-2xl font-semibold text-text-700 text-center">{{__('Welcome back!')}}</h2>
            <a href="{{route ('auth0-login')}}"  class="flex items-center justify-center mt-4 text-white rounded-lg shadow-md hover:bg-gray-100">
                <div class="px-4 py-3">
                    <svg class="h-6 w-6" viewBox="0 0 40 40">
                        <path
                            d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.045 27.2142 24.3525 30 20 30C14.4775 30 10 25.5225 10 20C10 14.4775 14.4775 9.99999 20 9.99999C22.5492 9.99999 24.8683 10.9617 26.6342 12.5325L31.3483 7.81833C28.3717 5.04416 24.39 3.33333 20 3.33333C10.7958 3.33333 3.33335 10.7958 3.33335 20C3.33335 29.2042 10.7958 36.6667 20 36.6667C29.2042 36.6667 36.6667 29.2042 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z"
                            fill="#FFC107" />
                        <path
                            d="M5.25497 12.2425L10.7308 16.2583C12.2125 12.59 15.8008 9.99999 20 9.99999C22.5491 9.99999 24.8683 10.9617 26.6341 12.5325L31.3483 7.81833C28.3716 5.04416 24.39 3.33333 20 3.33333C13.5983 3.33333 8.04663 6.94749 5.25497 12.2425Z"
                            fill="#FF3D00" />
                        <path
                            d="M20 36.6667C24.305 36.6667 28.2167 35.0192 31.1742 32.34L26.0159 27.975C24.3425 29.2425 22.2625 30 20 30C15.665 30 11.9842 27.2359 10.5975 23.3784L5.16254 27.5659C7.92087 32.9634 13.5225 36.6667 20 36.6667Z"
                            fill="#4CAF50" />
                        <path
                            d="M36.3425 16.7358H35V16.6667H20V23.3333H29.4192C28.7592 25.1975 27.56 26.805 26.0133 27.9758C26.0142 27.975 26.015 27.975 26.0158 27.9742L31.1742 32.3392C30.8092 32.6708 36.6667 28.3333 36.6667 20C36.6667 18.8825 36.5517 17.7917 36.3425 16.7358Z"
                            fill="#1976D2" />
                    </svg>
                </div>
                <h1 class="px-4 py-3 w-5/6 text-center text-text-700 font-bold">{{__('Sign in with Google')}}</h1>
            </a>
            <div class="mt-4 flex items-center justify-between">
                <span class="border-b w-1/5 lg:w-1/4"></span>
                <a href="{{route ('auth0-login')}}" class="text-xs text-center text-text-500 uppercase">{{__('or login with email')}}</a>
                <span class="border-b w-1/5 lg:w-1/4"></span>
            </div>
            <form action="{{route('login')}}" method="POST">
                @csrf
                <div class="mt-4">
                    <label class="block text-text-700 text-sm font-bold mb-2">{{__('Email Address')}}</label>
                    <input class="bg-accent-100 text-text-700 focus:outline-none focus:shadow-outline border border-background-300 rounded py-2 px-4 block w-full appearance-none" 
                    name="email"
                    id="email" 
                    type="email" />
                </div>
                <div class="mt-4">
                    <div class="flex justify-between">
                        <label class="block text-text-700 text-sm font-bold mb-2">{{__('Password')}}</label>
                        <a href="{{route('password.request')}}" class="text-xs text-text-500">{{__('Forget Password?')}}</a>
                    </div>
                    <input class="bg-accent-100 text-text-700 focus:outline-none focus:shadow-outline border border-background-300 rounded py-2 px-4 block w-full appearance-none" 
                    type="password"
                    name="password"
                    id="password" />
                </div>
                <div class="text-center p-4">
                    <input type="checkbox" id="remember" name="remember" class="rememberMe">
                    <label for="remember">{{__('Remember me')}}</label>
                </div>
                <input type="hidden" name="redirect" value="{{ request()->get('redirect', route('dashboard')) }}">
                <div class="mt-4">
                    <button class="bg-background-900 text-text-100 font-bold py-2 px-4 w-full rounded hover:bg-background-500">{{__('Login')}}</button>
                </div>
                <div class="mt-4 flex items-center justify-between">
                    <span class="border-b w-1/5 md:w-1/4"></span>
                    <a href="{{route('users.create')}}" class="text-xs text-text-500 uppercase">{{__('or sign up')}}</a>
                    <span class="border-b w-1/5 md:w-1/4"></span>
                </div>
            </form>
        </div>
    </div>
</div>
        

    </div>

@endsection
