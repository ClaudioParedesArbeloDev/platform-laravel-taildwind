@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Mis Apps')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-6xl mx-auto px-4 lg:px-8 py-8">

       
        <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
            {{ __('Dashboard') }}
        </p>
        <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
            {{ __('My Apps') }}
        </h1>
        <p class="font-three text-sm text-text-500 mt-2 mb-8">
            {{ __('Software you have purchased or requested through Code & Lens Solutions.') }}
        </p>

        @if ($purchases->isEmpty())
            <div class="flex flex-col items-center text-center bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-10">
                <i class="fa-solid fa-layer-group text-3xl text-variant-100 mb-4"></i>
                <p class="text-text-500 mb-6">{{ __("You haven't purchased any software yet.") }}</p>
                <a href="{{ route('software.catalog') }}"
                   class="py-2.5 px-6 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                    {{ __('See our software') }}
                </a>
            </div>
        @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                @foreach ($purchases as $software)
                    @php
                        $status = $software->pivot->status;
                        [$statusLabel, $statusClass] = match ($status) {
                            'active'           => [__('Active'), 'bg-green-100 text-green-700'],
                            'pending_delivery' => [__('Pending delivery'), 'bg-yellow-100 text-yellow-700'],
                            'expired'          => [__('Expired'), 'bg-red-100 text-red-700'],
                            default            => [ucfirst($status), 'bg-background-300 text-text-500'],
                        };
                    @endphp

                    <div class="flex flex-col bg-background-500 border border-variant-100 shadow-2xs rounded-xl overflow-hidden">
                        @if ($software->image != null)
                            <img src="{{ asset('storage/software/'.$software->image) }}" alt="{{ $software->name }}" class="w-full h-32 object-cover">
                        @else
                            <div class="w-full h-32 bg-accent2-300 flex items-center justify-center">
                                <i class="fa-solid fa-layer-group text-2xl text-accent2-900"></i>
                            </div>
                        @endif

                        <div class="p-4 flex flex-col grow">
                            <div class="flex justify-between items-start gap-2 mb-1">
                                <p class="text-xs uppercase tracking-wide text-variant-100">
                                    {{ $software->isGeneric() ? __('Generic Software') : __('Custom Software') }}
                                </p>
                                <span class="text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full {{ $statusClass }}">
                                    {{ $statusLabel }}
                                </span>
                            </div>

                            <h3 class="text-base font-bold text-text-900 mb-2 line-clamp-2">{{ $software->name }}</h3>

                            <div class="text-xs text-text-500 space-y-1 mb-4">
                                @if ($software->pivot->purchased_at)
                                    <p>{{ __('Purchased on') }}: {{ \Illuminate\Support\Carbon::parse($software->pivot->purchased_at)->format('d/m/Y') }}</p>
                                @endif
                                @if ($software->pivot->license_type)
                                    <p>{{ __('License') }}: {{ $software->pivot->license_type === 'anual' ? __('Annual license') : __('One-time payment') }}</p>
                                @endif
                                @if ($software->pivot->expires_at)
                                    <p>{{ __('Expires on') }}: {{ \Illuminate\Support\Carbon::parse($software->pivot->expires_at)->format('d/m/Y') }}</p>
                                @endif
                            </div>

                            <a href="{{ route('software.show', $software->id) }}"
                               class="mt-auto py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white focus:outline-hidden transition-colors duration-300">
                                {{ __('More Info') }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</div>
@endsection
