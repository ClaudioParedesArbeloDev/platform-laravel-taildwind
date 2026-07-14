@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Gestión de Software')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-6xl mx-auto px-4 lg:px-8 py-8">

     
        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('Dashboard') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ __('Software') }}
                </h1>
            </div>
            <a href="{{ route('software.create') }}"
               class="py-2.5 px-5 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                <i class="fa-solid fa-plus"></i>
                <span>{{ __('create') }}</span>
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 text-sm rounded-lg p-4 mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if ($softwares->isEmpty())
            <div class="flex flex-col items-center text-center bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-10">
                <i class="fa-solid fa-layer-group text-3xl text-variant-100 mb-4"></i>
                <p class="text-text-500">{{ __('No software available right now.') }}</p>
            </div>
        @else
            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl overflow-hidden">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-variant-100 text-left">
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Name') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Type') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Price') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Status') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium text-right">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($softwares as $software)
                            <tr class="border-b border-variant-100 last:border-b-0">
                                <td class="p-4">
                                    <p class="font-bold text-text-900">{{ $software->name }}</p>
                                    @if ($software->sku)
                                        <p class="text-xs text-text-500">{{ $software->sku }}</p>
                                    @endif
                                </td>
                                <td class="p-4 text-text-500">
                                    {{ $software->isGeneric() ? __('Generic Software') : __('Custom Software') }}
                                </td>
                                <td class="p-4 text-text-500">
                                    @if ($software->requires_quote || !$software->price)
                                        {{ __('Quote') }}
                                    @else
                                        ${{ number_format($software->price, 2, ',', '.') }}
                                    @endif
                                </td>
                                <td class="p-4">
                                    <div class="flex flex-wrap gap-1.5">
                                        <span class="text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full {{ $software->active ? 'bg-green-100 text-green-700' : 'bg-background-300 text-text-500' }}">
                                            {{ $software->active ? __('Active') : __('Inactive') }}
                                        </span>
                                        @if ($software->featured)
                                            <span class="text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full bg-accent-900 text-white">
                                                {{ __('Featured') }}
                                            </span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex justify-end gap-x-2">
                                        <a href="{{ route('software.edit', $software->id) }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-lg border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('software.destroy', $software->id) }}" method="POST"
                                              onsubmit="return confirm('{{ __('Are you sure you want to delete this?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-9 h-9 flex items-center justify-center rounded-lg border border-variant-100 text-text-500 hover:bg-red-600 hover:text-white hover:border-red-600 transition-colors duration-300">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $softwares->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
