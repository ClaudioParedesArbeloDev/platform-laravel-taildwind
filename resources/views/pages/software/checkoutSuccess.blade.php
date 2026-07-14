@extends('components.layout.layout')

@section('title', 'Code & Lens - ' . __('Payment successful'))

@section('content')

<div class="flex flex-col items-center w-full">
    <div class="w-full max-w-xl px-4 lg:px-0 py-16">
        <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-8 text-center">

            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-green-100 mb-6">
                <i class="fa-solid fa-check text-3xl text-green-600"></i>
            </div>

            <h1 class="font-three font-bold text-2xl text-text-900 mb-3">{{ __('Payment successful!') }}</h1>

            <p class="text-text-500 mb-6">
                {{ __('Your payment was processed successfully. Your purchase will be confirmed in your account shortly.') }}
            </p>

            <div class="bg-background-300 rounded-lg p-4 mb-6 text-left">
                <p class="text-xs uppercase tracking-wide text-variant-100 mb-1">{{ __('Payment ID') }}</p>
                <p class="font-mono text-text-900 text-sm">{{ request()->query('payment_id') ?? request()->query('collection_id') ?? __('Processing...') }}</p>

                @if (request()->query('payment_type'))
                    <p class="text-xs uppercase tracking-wide text-variant-100 mt-4 mb-1">{{ __('Payment method') }}</p>
                    <p class="text-text-900 text-sm capitalize">{{ str_replace('_', ' ', request()->query('payment_type')) }}</p>
                @endif
            </div>

            <div class="bg-accent2-300/30 border border-accent2-300 rounded-lg p-4 mb-6 text-left flex items-start gap-x-3">
                <i class="fa-solid fa-circle-info text-accent2-900 mt-0.5"></i>
                <p class="text-sm text-text-500">
                    {{ __('You will receive a confirmation email once your purchase is approved, and it will appear in "My Apps".') }}
                </p>
            </div>

            <div class="space-y-3">
                <a href="{{ route('software.my') }}"
                   class="inline-block w-full py-3 px-6 rounded-lg bg-accent-900 text-white font-semibold hover:opacity-90 transition-opacity duration-300">
                    {{ __('Go to my apps') }}
                </a>
                <a href="{{ route('software.catalog') }}"
                   class="inline-block w-full py-3 px-6 rounded-lg border border-variant-100 text-text-500 font-semibold hover:bg-background-300 transition-colors duration-300">
                    {{ __('View more software') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
