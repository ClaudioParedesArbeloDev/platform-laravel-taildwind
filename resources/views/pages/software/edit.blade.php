@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Editar Software')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-3xl mx-auto px-4 lg:px-8 py-8">

        
        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('Dashboard') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ $software->name }}
                </h1>
            </div>
            <a href="{{ route('software.index') }}" class="text-sm text-variant-100 hover:underline flex items-center gap-x-2">
                <i class="fa-solid fa-arrow-left"></i>
                {{ __('Back') }}
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 text-sm rounded-lg p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('software.update', $software->id) }}" method="POST" enctype="multipart/form-data" class="font-three text-text-900">
            @csrf
            @method('PUT')
            @include('pages.software.partials.form')

            <div class="flex justify-end mt-6">
                <button type="submit"
                    class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                    <i class="fa-solid fa-floppy-disk"></i>
                    <span>{{ __('Update') }}</span>
                </button>
            </div>
        </form>

     
        <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 lg:p-8 mt-6">
            <h2 class="font-three font-bold text-base text-text-900 mb-4">{{ __('Addons') }}</h2>

            @if ($software->addons->isNotEmpty())
                <div class="divide-y divide-variant-100 mb-6">
                    @foreach ($software->addons as $addon)
                        <div class="flex justify-between items-center py-3">
                            <div>
                                <p class="text-sm font-medium text-text-900">{{ $addon->name }}</p>
                                @if ($addon->description)
                                    <p class="text-xs text-text-500">{{ $addon->description }}</p>
                                @endif
                            </div>
                            <div class="flex items-center gap-x-3">
                                <span class="text-sm font-semibold text-text-900">${{ number_format($addon->price, 2, ',', '.') }}</span>
                                <form action="{{ route('software.addons.destroy', [$software->id, $addon->id]) }}" method="POST"
                                      onsubmit="return confirm('{{ __('Are you sure you want to delete this?') }}');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-8 h-8 flex items-center justify-center rounded-lg border border-variant-100 text-text-500 hover:bg-red-600 hover:text-white hover:border-red-600 transition-colors duration-300">
                                        <i class="fa-solid fa-trash text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-sm text-text-500 mb-6">{{ __('No addons yet.') }}</p>
            @endif

            <form action="{{ route('software.addons.store', $software->id) }}" method="POST" class="flex flex-wrap items-end gap-3 pt-4 border-t border-variant-100">
                @csrf
                <div class="flex-1 min-w-[160px]">
                    <label class="text-xs font-medium block mb-1">{{ __('Name') }}</label>
                    <input type="text" name="name" required
                        class="w-full bg-background-300 text-text-900 p-2 text-sm rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300">
                </div>
                <div class="flex-1 min-w-[160px]">
                    <label class="text-xs font-medium block mb-1">{{ __('Description') }}</label>
                    <input type="text" name="description"
                        class="w-full bg-background-300 text-text-900 p-2 text-sm rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300">
                </div>
                <div class="w-28">
                    <label class="text-xs font-medium block mb-1">{{ __('Price') }}</label>
                    <input type="number" step="0.01" min="0" name="price" required
                        class="w-full bg-background-300 text-text-900 p-2 text-sm rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300">
                </div>
                <button type="submit"
                    class="py-2 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                    <i class="fa-solid fa-plus"></i>
                    <span>{{ __('Add addon') }}</span>
                </button>
            </form>
        </div>

    </div>
</div>
@endsection
