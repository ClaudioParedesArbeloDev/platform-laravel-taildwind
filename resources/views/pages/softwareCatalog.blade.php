@extends('components.layout.layout')
@section('title', 'Code & Lens Solutions - Software')
@section('content')

<div class="flex flex-col items-center w-full">

   
    <section class="w-full flex flex-col items-center text-center px-4 py-10 lg:py-14">
        <p class="font-five uppercase tracking-[6px] text-xs lg:text-sm text-variant-100 mb-3">
            {{ __('Store') }}
        </p>
        <h1 class="font-three font-bold text-xl leading-tight lg:text-4xl text-text-500">
            {{ __('Software') }} {{ __('Availables') }}
        </h1>
        <p class="font-three text-sm lg:text-lg text-text-500 mt-4 max-w-2xl">
            {{ __('Ready-to-use software for your business, plus fully custom systems built to order.') }}
        </p>
    </section>

    @if ($softwaresByCategory->isEmpty())
        <div class="flex flex-col items-center text-center px-4 py-16">
            <i class="fa-solid fa-layer-group text-4xl text-variant-100 mb-4"></i>
            <p class="font-three text-text-500">{{ __('No software available right now.') }}</p>
        </div>
    @else
        
        @if ($softwaresByCategory->count() > 1)
            <div class="w-full max-w-7xl px-4 lg:px-16 mb-6 flex flex-wrap justify-center gap-2">
                @foreach ($softwaresByCategory as $category => $softwares)
                    <a href="#cat-{{ \Illuminate\Support\Str::slug($category ?: 'general') }}"
                       class="font-five text-xs uppercase tracking-wide px-4 py-2 rounded-full border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                        {{ $category ?: __('General') }}
                    </a>
                @endforeach
            </div>
        @endif

        
        <div class="w-full max-w-7xl px-4 lg:px-16 pb-12">
            @foreach ($softwaresByCategory as $category => $softwares)
                <section id="cat-{{ \Illuminate\Support\Str::slug($category ?: 'general') }}" class="mb-12 scroll-mt-24">
                    <h2 class="font-three font-bold text-lg lg:text-xl text-text-500 uppercase mb-5 pb-2 border-b border-variant-100">
                        {{ $category ?: __('General') }}
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                        @foreach ($softwares as $software)
                            <div class="relative flex flex-col bg-background-500 border border-variant-100 shadow-2xs rounded-xl overflow-hidden hover:-translate-y-1 transition-transform duration-300">

                                @if ($software->featured)
                                    <span class="absolute top-2 right-2 bg-accent-900 text-white text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full z-10">
                                        {{ __('Featured') }}
                                    </span>
                                @endif

                                @if ($software->image != null)
                                    <img src="{{ asset('storage/software/'.$software->image) }}" alt="{{ $software->name }}" class="w-full h-40 object-cover">
                                @else
                                    <div class="w-full h-40 bg-accent2-300 flex items-center justify-center">
                                        <i class="fa-solid fa-layer-group text-3xl text-accent2-900"></i>
                                    </div>
                                @endif

                                <div class="p-4 flex flex-col grow">

                                    <div class="flex justify-between items-start gap-2">
                                        <p class="text-xs uppercase tracking-wide text-variant-100">
                                            {{ $software->isGeneric() ? __('Generic Software') : __('Custom Software') }}
                                        </p>
                                        @if ($software->sku)
                                            <span class="font-five text-[10px] text-text-500 whitespace-nowrap">{{ $software->sku }}</span>
                                        @endif
                                    </div>

                                    <h3 class="text-base font-bold text-text-900 mt-1 line-clamp-2">{{ $software->name }}</h3>

                                    @if ($software->short_description)
                                        <p class="text-sm text-text-500 mt-1 line-clamp-2">{{ $software->short_description }}</p>
                                    @endif

                                    
                                    <div class="flex flex-wrap gap-2 mt-3">
                                        @if ($software->platform)
                                            <span class="inline-flex items-center gap-x-1 text-[11px] px-2 py-1 rounded-full border border-variant-100 text-text-500">
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
                                            <span class="inline-flex items-center gap-x-1 text-[11px] px-2 py-1 rounded-full border border-variant-100 text-text-500">
                                                <i class="fa-solid fa-key"></i>
                                                {{ $software->license_type === 'anual' ? __('Annual license') : __('One-time payment') }}
                                            </span>
                                        @endif
                                    </div>

                                    <div class="flex justify-between items-center mt-3 text-sm">
                                        <span class="font-semibold text-text-900">
                                            @if ($software->requires_quote || !$software->price)
                                                {{ __('Quote') }}
                                            @else
                                                ${{ number_format($software->price, 2, ',', '.') }}
                                            @endif
                                        </span>
                                    </div>

                                  
                                    @if ($software->demo_url || $software->manual_url)
                                        <div class="flex gap-x-4 mt-3 text-xs">
                                            @if ($software->demo_url)
                                                <a href="{{ $software->demo_url }}" target="_blank" rel="noopener" class="text-variant-100 hover:underline">
                                                    {{ __('Try demo') }}
                                                </a>
                                            @endif
                                            @if ($software->manual_url)
                                                <a href="{{ $software->manual_url }}" target="_blank" rel="noopener" class="text-variant-100 hover:underline">
                                                    {{ __('Manual') }}
                                                </a>
                                            @endif
                                        </div>
                                    @endif

                                    <div class="flex gap-x-2 mt-4">
                                        <a href="{{ route('software.show', $software->id) }}"
                                           class="flex-1 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white focus:outline-hidden transition-colors duration-300">
                                            <span>{{ __('More Info') }}</span>
                                        </a>

                                        @if ($software->requires_quote)
                                            <a href="{{ route('contact.index') }}"
                                               class="flex-1 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                                                <span>{{ __('Get a quote') }}</span>
                                            </a>
                                        @elseif ($software->purchase_url)
                                            <a href="{{ $software->purchase_url }}" target="_blank" rel="noopener"
                                               class="flex-1 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                                                <span>{{ __('Buy') }}</span>
                                            </a>
                                        @elseif ($software->isPurchasableOnline())
                                            <a href="{{ route('software.checkout.show', $software->id) }}"
                                               class="flex-1 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                                                <span>{{ __('Buy') }}</span>
                                            </a>
                                        @endif
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        </div>
    @endif

</div>
@endsection
