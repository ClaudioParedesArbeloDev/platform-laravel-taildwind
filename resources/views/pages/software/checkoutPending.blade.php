@extends('components.layout.layout')

@section('title', 'Code & Lens - ' . __('Payment pending'))

@section('content')

<div class="flex flex-col items-center w-full">
    <div class="w-full max-w-xl px-4 lg:px-0 py-16">
        <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-8 text-center">

            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-yellow-100 mb-6">
                <i class="fa-solid fa-clock text-3xl text-yellow-600"></i>
            </div>

            <h1 class="font-three font-bold text-2xl text-text-900 mb-3">{{ __('Payment in progress') }}</h1>

            <p class="text-text-500 mb-6">
                {{ __('Your payment is being processed and confirmed.') }}
            </p>

            @if (request()->query('payment_id'))
                <div class="bg-background-300 rounded-lg p-4 mb-6 text-left">
                    <p class="text-xs uppercase tracking-wide text-variant-100 mb-1">{{ __('Payment reference') }}</p>
                    <p class="font-mono text-text-900 text-sm">{{ request()->query('payment_id') }}</p>
                    @if (request()->query('payment_type'))
                        <p class="text-sm text-text-900 mt-3">
                            {{ __('Method') }}: <span class="capitalize">{{ str_replace('_', ' ', request()->query('payment_type')) }}</span>
                        </p>
                    @endif
                </div>
            @endif

            <div class="bg-background-300 rounded-lg p-4 mb-6 text-left">
                <p class="font-semibold text-text-900 mb-3">{{ __('Next steps') }}:</p>
                <ol class="space-y-2 text-text-500 text-sm list-decimal list-inside">
                    <li>{{ __('Complete the payment following the instructions you received by email') }}</li>
                    <li>{{ __('You will receive an email once your payment is confirmed') }}</li>
                    <li>{{ __('Your purchase will be activated automatically') }}</li>
                    <li>{{ __('You will be able to access it from "My Apps"') }}</li>
                </ol>
            </div>

            <div class="bg-accent2-300/30 border border-accent2-300 rounded-lg p-4 mb-6 text-left">
                <p class="text-sm text-text-500">
                    <strong>{{ __('Note') }}:</strong> {{ __('This process can take up to 48 business hours depending on the payment method. Keep your receipt.') }}
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
