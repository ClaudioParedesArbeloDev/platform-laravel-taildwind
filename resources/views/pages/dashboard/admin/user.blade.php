@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Usuario')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-2xl mx-auto px-4 lg:px-8 py-8">

        
        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('Dashboard') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ __('User') }}
                </h1>
            </div>
            <a href="{{ route('users.index') }}" class="text-sm text-variant-100 hover:underline flex items-center gap-x-2">
                <i class="fa-solid fa-arrow-left"></i>
                {{ __('Back') }}
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 text-sm rounded-lg p-4 mb-6">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-700 text-sm rounded-lg p-4 mb-6">{{ session('error') }}</div>
        @endif

        <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 lg:p-8">

            <div class="flex flex-col items-center mb-6">
                @if ($user->avatar && $user->avatar->avatar)
                    <img src="{{ asset('storage/avatars/' . $user->avatar->avatar) }}" alt="{{ $user->name }}" class="w-24 h-24 object-cover rounded-full border-2 border-variant-100">
                @else
                    <img src="{{ asset('images/avatar.png') }}" alt="{{ $user->name }}" class="w-24 h-24 object-cover rounded-full border-2 border-variant-100">
                @endif
                <h2 class="font-three font-bold text-lg text-text-900 mt-4">{{ $user->name }} {{ $user->lastname }}</h2>
                <div class="flex flex-wrap justify-center gap-1.5 mt-2">
                    @forelse ($user->roles as $role)
                        <span class="text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full bg-accent-900 text-white">
                            {{ $role->name }}
                        </span>
                    @empty
                        <span class="text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full bg-background-300 text-text-500">
                            {{ __('No role assigned') }}
                        </span>
                    @endforelse
                </div>
            </div>

            <dl class="grid grid-cols-1 sm:grid-cols-2 gap-x-6 gap-y-4 text-sm mb-6">
                <div>
                    <dt class="text-xs uppercase tracking-wide text-variant-100 mb-0.5">{{ __('Email') }}</dt>
                    <dd class="text-text-900">{{ $user->email }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-variant-100 mb-0.5">{{ __('Username') }}</dt>
                    <dd class="text-text-900">{{ $user->username ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-variant-100 mb-0.5">{{ __('Phone') }}</dt>
                    <dd class="text-text-900">{{ $user->phone ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-variant-100 mb-0.5">DNI</dt>
                    <dd class="text-text-900">{{ $user->dni ?? '—' }}</dd>
                </div>
                <div class="sm:col-span-2">
                    <dt class="text-xs uppercase tracking-wide text-variant-100 mb-0.5">{{ __('Address') }}</dt>
                    <dd class="text-text-900">{{ $user->address ?? '—' }}</dd>
                </div>
                <div>
                    <dt class="text-xs uppercase tracking-wide text-variant-100 mb-0.5">{{ __('Date of Birth') }}</dt>
                    <dd class="text-text-900">{{ $user->date_birth ?? '—' }}</dd>
                </div>
            </dl>

            @if ($user->courses->isNotEmpty())
                <div class="mb-6">
                    <p class="text-xs uppercase tracking-wide text-variant-100 mb-2">{{ __('Courses') }}</p>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach ($user->courses as $course)
                            <span class="text-xs px-2.5 py-1 rounded-full border border-variant-100 text-text-500">
                                {{ $course->name }}
                            </span>
                        @endforeach
                    </div>
                </div>
            @endif

            <div class="flex gap-x-3 pt-4 border-t border-variant-100">
                <a href="{{ route('users.edit', $user->id) }}"
                   class="flex-1 py-2.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                    <i class="fa-solid fa-pen"></i>
                    <span>{{ __('Edit User') }}</span>
                </a>

                @if ($user->id !== auth()->id())
                    <form action="{{ route('users.destroy', $user->id) }}" method="POST" id="deleteUserForm">
                        @csrf
                        @method('DELETE')
                        <button type="button" id="deleteUserBtn"
                            class="py-2.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-600 hover:bg-red-600 hover:text-white focus:outline-hidden transition-colors duration-300">
                            <i class="fa-solid fa-trash"></i>
                            <span>{{ __('Delete User') }}</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
    const deleteBtn = document.getElementById('deleteUserBtn');
    if (deleteBtn) {
        deleteBtn.addEventListener('click', function () {
            Swal.fire({
                title: "{{ __('Are you sure?') }}",
                text: "{{ __('This will permanently delete the user account.') }}",
                icon: "warning",
                showCancelButton: true,
                confirmButtonText: "{{ __('Yes, delete it!') }}",
                cancelButtonText: "{{ __('Cancel') }}",
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('deleteUserForm').submit();
                }
            });
        });
    }
</script>
@endsection
