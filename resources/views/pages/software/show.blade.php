@extends('components.layout.layout')
@section('title', 'Code & Lens Solutions - ' . $software->name)
@section('content')

<div class="flex flex-col items-center w-full">

    <div class="w-full max-w-6xl px-4 lg:px-16 py-10">

        {{-- ============ BREADCRUMB ============ --}}
        <div class="flex items-center gap-x-2 text-xs text-variant-100 font-five uppercase tracking-wide mb-8">
            <a href="{{ route('software.catalog') }}" class="hover:underline">{{ __('Software') }}</a>
            <i class="fa-solid fa-chevron-right text-[9px]"></i>
            <span class="text-text-500 normal-case tracking-normal">{{ $software->name }}</span>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-10">

            {{-- ============ IMAGE ============ --}}
            <div class="lg:col-span-2">
                <div class="relative rounded-xl overflow-hidden border border-variant-100 shadow-2xs">
                    @if ($software->featured)
                        <span class="absolute top-3 right-3 bg-accent-900 text-white text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full z-10">
                            {{ __('Featured') }}
                        </span>
                    @endif

                    @if ($software->image != null)
                        <img src="{{ asset('storage/software/'.$software->image) }}" alt="{{ $software->name }}" class="w-full h-64 lg:h-80 object-cover">
                    @else
                        <div class="w-full h-64 lg:h-80 bg-accent2-300 flex items-center justify-center">
                            <i class="fa-solid fa-layer-group text-5xl text-accent2-900"></i>
                        </div>
                    @endif
                </div>

                {{-- Secondary links: demo / manual --}}
                @if ($software->demo_url || $software->manual_url)
                    <div class="flex gap-x-6 mt-4 text-sm">
                        @if ($software->demo_url)
                            <a href="{{ $software->demo_url }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-x-2 text-text-500 hover:text-accent-900 transition-colors duration-300">
                                <i class="fa-solid fa-play"></i>
                                {{ __('Try demo') }}
                            </a>
                        @endif
                        @if ($software->manual_url)
                            <a href="{{ $software->manual_url }}" target="_blank" rel="noopener"
                               class="inline-flex items-center gap-x-2 text-text-500 hover:text-accent-900 transition-colors duration-300">
                                <i class="fa-solid fa-book"></i>
                                {{ __('Manual') }}
                            </a>
                        @endif
                    </div>
                @endif
            </div>

            {{-- ============ DETAILS ============ --}}
            <div class="lg:col-span-3">

                <div class="flex justify-between items-start gap-2">
                    <p class="font-five uppercase tracking-[4px] text-xs text-variant-100">
                        {{ $software->isGeneric() ? __('Generic Software') : __('Custom Software') }}
                    </p>
                    @if ($software->sku)
                        <span class="font-five text-xs text-text-500 whitespace-nowrap">{{ $software->sku }}</span>
                    @endif
                </div>

                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500 mt-1">
                    {{ $software->name }}
                </h1>

                @if ($software->short_description)
                    <p class="font-three text-sm lg:text-base text-text-500 mt-3">
                        {{ $software->short_description }}
                    </p>
                @endif

                {{-- Platform / license / category badges --}}
                <div class="flex flex-wrap gap-2 mt-5">
                    @if ($software->category)
                        <span class="inline-flex items-center gap-x-1 text-xs px-3 py-1.5 rounded-full border border-variant-100 text-text-500">
                            <i class="fa-solid fa-tag"></i>
                            {{ $software->category }}
                        </span>
                    @endif

                    @if ($software->platform)
                        <span class="inline-flex items-center gap-x-1 text-xs px-3 py-1.5 rounded-full border border-variant-100 text-text-500">
                            @switch($software->platform)
                                @case('web')
                                    <i class="fa-solid fa-globe"></i>
                                    @break
                                @case('windows')
                                    <i class="fa-brands fa-windows"></i>
                                    @break
                                @case('mobile')
                                    <i class="fa-solid fa-mobile-screen-button"></i>
                                    @break
                                @case('desktop')
                                    <i class="fa-solid fa-desktop"></i>
                                    @break
                                @default
                                    <i class="fa-solid fa-cube"></i>
                            @endswitch
                            {{ ucfirst($software->platform) }}
                        </span>
                    @endif

                    @if ($software->license_type)
                        <span class="inline-flex items-center gap-x-1 text-xs px-3 py-1.5 rounded-full border border-variant-100 text-text-500">
                            <i class="fa-solid fa-key"></i>
                            {{ $software->license_type === 'anual' ? __('Annual license') : __('One-time payment') }}
                        </span>
                    @endif
                </div>

                {{-- Price --}}
                <div class="mt-6">
                    <span class="font-three font-bold text-2xl text-text-900">
                        @if ($software->requires_quote || !$software->price)
                            {{ __('Quote') }}
                        @else
                            ${{ number_format($software->price, 2, ',', '.') }}
                        @endif
                    </span>
                </div>

                {{-- CTA buttons --}}
                <div class="flex flex-wrap gap-x-3 gap-y-3 mt-6">
                    @if ($software->requires_quote)
                        <a href="{{ route('contact.index') }}"
                           class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                            {{ __('Get a quote') }}
                        </a>
                    @elseif ($software->purchase_url)
                        <a href="{{ $software->purchase_url }}" target="_blank" rel="noopener"
                           class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                            {{ __('Buy') }}
                        </a>
                    @elseif ($software->isPurchasableOnline())
                        <a href="{{ route('software.checkout.show', $software->id) }}"
                           class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                            {{ __('Buy') }}
                        </a>
                    @endif

                    <a href="{{ route('software.catalog') }}"
                       class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-variant-100 text-text-500 hover:bg-background-300 focus:outline-hidden transition-colors duration-300">
                        {{ __('Back to catalog') }}
                    </a>
                </div>

                {{-- ============ DESCRIPTION ============ --}}
                <div class="mt-10 pt-8 border-t border-variant-100">
                    <h2 class="font-three font-bold text-lg text-text-500 mb-3">
                        {{ __('Description') }}
                    </h2>
                    <div class="font-three text-sm lg:text-base text-text-500 whitespace-pre-line leading-relaxed">
                        {{ $software->description }}
                    </div>
                </div>

                {{-- ============ ADDONS ============ --}}
                @if ($software->activeAddons->isNotEmpty())
                    <div class="mt-10 pt-8 border-t border-variant-100">
                        <h2 class="font-three font-bold text-lg text-text-500 mb-4">
                            {{ __('Addons') }}
                        </h2>

                        <div class="flex flex-col gap-3">
                            @foreach ($software->activeAddons as $addon)
                                <div class="flex justify-between items-start gap-4 bg-background-500 border border-variant-100 rounded-lg p-4">
                                    <div>
                                        <p class="font-medium text-text-900">{{ $addon->name }}</p>
                                        @if ($addon->description)
                                            <p class="text-sm text-text-500 mt-1">{{ $addon->description }}</p>
                                        @endif
                                    </div>
                                    <span class="font-semibold text-text-900 whitespace-nowrap">
                                        ${{ number_format($addon->price, 2, ',', '.') }}
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@endsection
