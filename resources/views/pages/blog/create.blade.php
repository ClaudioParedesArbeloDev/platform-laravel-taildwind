@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Create Blog')

@section('content')

    <div class="flex flex-col justify-center items-center text-text-900">
        <h2 class="font-two p-4 lg:text-2xl lg:p-8">{{__('Create Blog')}}</h2>
        <a class="absolute right-10 top-5 lg:top-10" href="{{route('admin')}}"><i class="fa-solid fa-arrow-rotate-left"></i></a>
        <form action="{{route('blogs.index')}}" method="POST" class="flex flex-col justify-center items-center gap-2 lg:gap-4">
        @csrf
            <label class="font-one" for="title">{{__('Title')}}:</label>
            
            <input class="bg-background-500 font-one p-2 rounded-md w-xs lg:w-3xl" type="text" id="title" name="title" >
        
            <label class="font-one" for="author">{{__('Author')}}:</label>
        
            <input class="bg-background-500 font-one p-2 rounded-md w-xs lg:w-3xl" type="text" id="author" name="author" >
        
            <label class="font-one" for="anticipated">{{__('Advance')}}:</label>
        
            <input class="bg-background-500 font-one p-2 rounded-md w-xs lg:w-3xl" type="text" id="anticipated" name="anticipated" >
    
            <label class="font-one" for="image">{{__('Image')}}:</label>
        
            <input class="bg-background-500 font-one p-2 rounded-md w-xs lg:w-3xl" type="text" id="image" name="image" >
        
            <label class="font-one" for="body">{{__('Body')}}:</label>
        
            <textarea class="bg-background-500 w-xs h-20 lg:h-40 lg:w-3xl rounded-md" rows="10" type="text-area" id="body" name="body" ></textarea>
    
            <label class="font-one" for="category">{{__('Category')}}:</label>
        
            <select name="category" class="font-one" id="category" class="btnFormSelect">
                <option value="programacion">{{__('Programming')}}</option>
                <option value="fotografia">{{__('Photography')}}</option>
                <option value="filmmaking">{{__('Filmmaking')}}</option>
            </select>
            
            <button class="bg-accent2-500 px-4 py-2 hover:bg-accent-500 rounded-md " type="submit">{{__('Create')}}</button>
        </form>
    </div>

@endsection