@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Usuario')

@section('content')

<div class="flex flex-col text-text-900 justify-center h-full items-center">

    <a class="absolute top-8 right-8"  href="/users/"><i class="fa-solid fa-arrow-rotate-left"></i></a>

    <h2 class="font-bold">{{__('User')}}: {{$user->lastname}}, {{$user->name}}</h2>
    <div class="">
        @if ($user->avatar && $user->avatar->avatar)
            <img src="{{ asset('storage/' . $user->avatar->avatar) }}" alt="avatar" class="avatarUser">
        @else
            <img src="{{asset('images/avatars/avatar.png')}}" alt="avatar" class="avatarUser">
        @endif
        <dt>{{__('Name')}}</dt> 
        <p class="answer">{{$user->name}}</p>
        
        <dt>{{__('Lastname')}}</dt> 
        <p class="answer">{{$user->lastname}}</p>
        
        <dt>{{__('Address')}}</dt> 
        <p class="answer">{{$user->address}}</p>
        
        <dt>{{__('Phone')}}</dt> 
        <p class="answer">{{$user->phone}}</p>
        
        <dt>{{__('Email')}}</dt> 
        <p class="answer">{{$user->email}}</p>
        
        <dt>DNI:</dt> 
        <p class="answer">{{$user->dni}}</p>
        
        <dt>{{__('Date of Birth')}}:</dt> 
        <p class="answer">{{$user->date_birth}}</p>
        
        <dt>{{__('Username')}}:</dt> 
        <p class="answer">{{$user->username}}</p>
        
        <dt>{{__('Rol')}}:</dt>
        @foreach($user->roles as $role)
            <p class="answer">{{$role->name}}</p>
        @endforeach
        <dt>{{__('Courses')}}:</dt>
        @foreach($user->courses as $course)
                <p class="answer">{{$course->name}}</p> 
                <p class="status">{{$course->pivot->status}}</p>
        @endforeach
        

        <a href="/users/{{$user->id}}/edit" class = 'btnEdit'>{{__('Edit User')}}</a>

        <form action="/users/{{$user->id}}" method="POST" id="deleteUserForm" >

            @csrf

            @method('DELETE')

            <button type="submit" class="deleteUser">{{__('Delete User')}}</button>
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