@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Usuarios')

@section('content')

<div class="flex flex-col text-text-900 justify-center h-full items-center">
    <h2 class="font-two lg:text-2xl">{{__('Users List')}}</h2>
    <a class="absolute top-8 right-8" href="{{route('admin')}}"><i class="fa-solid fa-arrow-rotate-left"></i></a>
        <table class="my-8 w-70 font-one lg:w-6/7">
            <thead>
                <tr class="text-left text-xs lg:text-xl">
                    <th>{{__('Name')}}</th>
                    <th>{{__('Lastname')}}</th>
                    <th class="hidden lg:table-cell">{{__('Address')}}</th>
                    <th class="hidden lg:table-cell">{{__('Phone')}}</th>
                    <th class="hidden lg:table-cell">DNI</th>
                    <th class="hidden lg:table-cell">{{__('Email')}}</th>
                    <th class="hidden lg:table-cell">{{__('Date of Birth')}}</th>
                    <th class="hidden lg:table-cell">{{__('Username')}}</th>
                    <th>{{__('Edit')}}</th>

                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr class="text-left text-xs lg:text-sm ">
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->lastname }}</td>
                    <td class="hidden lg:table-cell py-2">{{ $user->address }}</td>
                    <td class="hidden lg:table-cell py-2">{{ $user->phone }}</td>
                    <td class="hidden lg:table-cell py-2">{{ $user->dni }}</td>
                    <td class="hidden lg:table-cell py-2">{{ $user->email }}</td>
                    <td class="hidden lg:table-cell py-2">{{ $user->date_birth }}</td>
                    <td class="hidden lg:table-cell py-2">{{ $user->username }}</td>
                    <td><a href="/users/{{$user->id}}">{{__('Edit')}}</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 flex justify-center">
            <div class="inline-flex items-center gap-2 rounded-lg bg-background-100 text-text-900 p-2 shadow-md">
                {{ $users->links() }}
            </div>
        </div> 

@endsection