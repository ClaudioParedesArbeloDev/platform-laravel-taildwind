@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Usuario')

@section('content')

<div class="flex flex-col font-three text-text-900 justify-center h-full items-center ">

    <a class="absolute top-8 right-8"  href="/users/"><i class="fa-solid fa-arrow-rotate-left"></i></a>

    <h2 class="font-bold lg:text-2xl py-4">{{__('User')}}: {{$user->lastname}}, {{$user->name}}</h2>
    <div>
        @if ($user->avatar && $user->avatar->avatar)
        <img src="{{asset('storage/avatars/'.Auth::user()->avatar->avatar)}}" alt="avatar" class="w-30 h-30 rounded-full object-cover">
        @else
            <img src="{{asset('images/avatar.png')}}" alt="avatar" class="w-30 h-30 mx-auto rounded-full lg:w-50 lg:h-50">
        @endif

        <div class="flex text-xs py-2 lg:text-xl">
            <dt class="pr-4">{{__('Name')}}:</dt> 
            <p>{{$user->name}}</p>
        </div>
        
        <div class="flex  text-xs py-2 lg:text-xl">
            <dt class="pr-4">{{__('Lastname')}}:</dt> 
            <p>{{$user->lastname}}</p>
        </div>
        
        <div class="flex  text-xs py-2 lg:text-xl">
            <dt class="pr-4">{{__('Address')}}</dt> 
            <p>{{$user->address}}</p>
        </div>

        <div class="flex  text-xs py-2 lg:text-xl">
            <dt class="pr-4">{{__('Phone')}}</dt> 
            <p>{{$user->phone}}</p>
        </div>

        <div class="flex  text-xs py-2 lg:text-xl">
            <dt class="pr-4">{{__('Email')}}</dt> 
            <p>{{$user->email}}</p>
        </div>

        <div class="flex  text-xs py-2 lg:text-xl">
            <dt class="pr-4">DNI:</dt> 
            <p>{{$user->dni}}</p>
        </div>

        <div class="flex  text-xs py-2 lg:text-xl">
            <dt class="pr-4">{{__('Date of Birth')}}:</dt> 
            <p>{{$user->date_birth}}</p>
        </div>

        <div class="flex  text-xs py-2 lg:text-xl">
            <dt class="pr-4">{{__('Username')}}:</dt> 
            <p>{{$user->username}}</p>
        </div>

        <div class="flex  text-xs py-2 lg:text-xl">
            <dt class="pr-4">{{__('Rol')}}:</dt>
            @foreach($user->roles as $role)
                <p class="px-4">{{$role->name}}</p>
            @endforeach
        </div>

        <div class="flex  text-xs py-2 mb-4 lg:text-xl">
            <dt class="pr-4">{{__('Courses')}}:</dt>
            @foreach($user->courses as $course)
                <p class="px-4">{{$course->name}}</p>
                <p class="px-4">{{$course->pivot->status}}</p>
            @endforeach
        </div>

        <a href="/users/{{$user->id}}/edit" class="text-xs bg-accent2-500 p-2 rounded-md lg:text-xl">{{__('Edit User')}}</a>

        <form action="/users/{{$user->id}}" method="POST" id="deleteUserForm"  >

            @csrf

            @method('DELETE')

            <button type="submit" class="deleteUser text-xs bg-red-500 p-2 rounded-md mt-8 lg:text-xl">{{__('Delete User')}}</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const deleteUserButton = document.querySelector('.deleteUser');
        const deleteUserForm = document.getElementById('deleteUserForm');
        deleteUserButton.addEventListener('click', function(event) {
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!"
        }).then((result) => {
            if (result.isConfirmed) {
                deleteUserForm.submit();
                Swal.fire({
                title: "Deleted!",
                text: "Your file has been deleted.",
                icon: "success"
                });
            }
        });
    });
    </script>
</div>

@endsection