@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Usuarios')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-6xl mx-auto px-4 lg:px-8 py-8">

       
        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('Dashboard') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ __('Users List') }}
                </h1>
            </div>
            <a href="{{ route('admin') }}" class="text-sm text-variant-100 hover:underline flex items-center gap-x-2">
                <i class="fa-solid fa-arrow-left"></i>
                {{ __('Back') }}
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 text-sm rounded-lg p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if ($users->isEmpty())
            <div class="flex flex-col items-center text-center bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-10">
                <i class="fa-solid fa-users text-3xl text-variant-100 mb-4"></i>
                <p class="text-text-500">{{ __('No users found.') }}</p>
            </div>
        @else
            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl overflow-hidden overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-variant-100 text-left">
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Name') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium hidden lg:table-cell">{{ __('Email') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium hidden lg:table-cell">{{ __('Username') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Role') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium text-right">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr class="border-b border-variant-100 last:border-b-0">
                                <td class="p-4">
                                    <div class="flex items-center gap-x-3">
                                        @if ($user->avatar && $user->avatar->avatar)
                                            <img src="{{ asset('storage/avatars/' . $user->avatar->avatar) }}" alt="{{ $user->name }}" class="w-9 h-9 rounded-full object-cover">
                                        @else
                                            <img src="{{ asset('images/avatar.png') }}" alt="{{ $user->name }}" class="w-9 h-9 rounded-full object-cover">
                                        @endif
                                        <div>
                                            <p class="font-bold text-text-900">{{ $user->name }} {{ $user->lastname }}</p>
                                            <p class="text-xs text-text-500 lg:hidden">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="p-4 text-text-500 hidden lg:table-cell">{{ $user->email }}</td>
                                <td class="p-4 text-text-500 hidden lg:table-cell">{{ $user->username }}</td>
                                <td class="p-4">
                                    @foreach ($user->roles as $role)
                                        <span class="text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full bg-background-300 text-text-500">
                                            {{ $role->name }}
                                        </span>
                                    @endforeach
                                </td>
                                <td class="p-4">
                                    <div class="flex justify-end gap-x-2">
                                        <a href="{{ route('users.show', $user->id) }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-lg border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('users.edit', $user->id) }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-lg border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $users->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
