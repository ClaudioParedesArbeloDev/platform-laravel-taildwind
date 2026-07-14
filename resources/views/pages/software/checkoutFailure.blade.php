@extends('components.layout.layout')

@section('title', 'Code & Lens - ' . __('Payment not processed'))

@section('content')

<div class="flex flex-col items-center w-full">
    <div class="w-full max-w-xl px-4 lg:px-0 py-16">
        <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-8 text-center">

            <div class="mx-auto flex items-center justify-center h-20 w-20 rounded-full bg-red-100 mb-6">
                <i class="fa-solid fa-xmark text-3xl text-red-600"></i>
            </div>

            <h1 class="font-three font-bold text-2xl text-text-900 mb-3">{{ __('Payment not processed') }}</h1>

            <p class="text-text-500 mb-6">
                {{ __('Sorry, there was a problem processing your payment.') }}
            </p>

            @if (request()->query('status'))
                <div class="bg-background-300 rounded-lg p-4 mb-6 text-left">
                    <p class="text-sm text-text-900">
                        {{ __('Status') }}: <span class="font-semibold capitalize">{{ request()->query('status') }}</span>
                    </p>
                    @if (request()->query('payment_id'))
                        <p class="text-sm text-text-900 mt-2">
                            {{ __('Reference') }}: <span class="font-mono">{{ request()->query('payment_id') }}</span>
                        </p>
                    @endif
                </div>
            @endif

            <div class="bg-background-300 rounded-lg p-4 mb-6 text-left">
                <p class="font-semibold text-text-900 mb-3">{{ __('Common reasons') }}:</p>
                <ul class="space-y-2 text-text-500 text-sm">
                    <li class="flex items-start gap-x-2"><span class="text-red-500">&bull;</span><span>{{ __('Insufficient funds') }}</span></li>
                    <li class="flex items-start gap-x-2"><span class="text-red-500">&bull;</span><span>{{ __('Incorrect card details') }}</span></li>
                    <li class="flex items-start gap-x-2"><span class="text-red-500">&bull;</span><span>{{ __('Payment cancelled') }}</span></li>
                    <li class="flex items-start gap-x-2"><span class="text-red-500">&bull;</span><span>{{ __('Purchase limit exceeded') }}</span></li>
                </ul>
            </div>

            <div class="bg-accent2-300/30 border border-accent2-300 rounded-lg p-4 mb-6 text-left flex items-start gap-x-3">
                <i class="fa-solid fa-circle-info text-accent2-900 mt-0.5"></i>
                <p class="text-sm text-text-500">
                    {{ __('Don\'t worry, no charge was made. You can try again whenever you\'re ready.') }}
                </p>
            </div>

            <div class="space-y-3">
                <a href="{{ route('software.catalog') }}"
                   class="inline-block w-full py-3 px-6 rounded-lg bg-accent-900 text-white font-semibold hover:opacity-90 transition-opacity duration-300">
                    {{ __('Try again') }}
                </a>
                <a href="{{ route('home') }}"
                   class="inline-block w-full py-3 px-6 rounded-lg border border-variant-100 text-text-500 font-semibold hover:bg-background-300 transition-colors duration-300">
                    {{ __('Back to home') }}
                </a>
            </div>
        </div>
    </div>
</div>

@endsection
