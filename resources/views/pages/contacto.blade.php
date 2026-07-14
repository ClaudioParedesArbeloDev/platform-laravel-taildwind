@extends('components.layout.layout')
@section('title', 'Code & Lens Solutions - Contacto')
@section('content')

<div class="flex flex-col items-center w-full">

    {{-- ============ HEADER ============ --}}
    <section class="w-full flex flex-col items-center text-center px-4 py-10 lg:py-14">
        <p class="font-five uppercase tracking-[6px] text-xs lg:text-sm text-variant-100 mb-3">
            {{ __('Contact') }}
        </p>
        <h1 class="font-three font-bold text-xl leading-tight lg:text-4xl text-text-500">
            {{ __('Do you want to contact us?') }}
        </h1>
        <p class="font-three text-sm lg:text-lg text-text-500 mt-4 max-w-2xl">
            {{ __('Tell us about your course, custom software or web/app project and we\'ll get back to you.') }}
        </p>
    </section>

    {{-- ============ CONTENT ============ --}}
    <section class="w-full px-4 lg:px-16 pb-16">
        <div class="max-w-5xl mx-auto grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- ============ INFO CARD ============ --}}
            <div class="lg:col-span-2 flex flex-col bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 lg:p-8">
                <h2 class="font-three font-bold text-lg text-text-900 mb-4">{{ __('Get in touch') }}</h2>

                <div class="flex items-start gap-x-3 mb-4">
                    <i class="fa-solid fa-envelope text-variant-100 mt-1"></i>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-variant-100">{{ __('Email') }}</p>
                        <a href="mailto:claudioparedesarbelo@gmail.com" class="text-sm text-text-900 hover:text-variant-100 transition-colors duration-300 break-all">
                            claudioparedesarbelo@gmail.com
                        </a>
                    </div>
                </div>

                <div class="flex items-start gap-x-3 mb-6">
                    <i class="fa-solid fa-clock text-variant-100 mt-1"></i>
                    <div>
                        <p class="text-xs uppercase tracking-wide text-variant-100">{{ __('Response time') }}</p>
                        <p class="text-sm text-text-900">{{ __('We usually reply within 1-2 business days.') }}</p>
                    </div>
                </div>

                <p class="text-xs uppercase tracking-wide text-variant-100 mb-3">{{ __('Follow us') }}</p>
                <div class="flex gap-x-2">
                    <a href="https://www.linkedin.com/in/claudioparedesarbelo/" target="_blank" rel="noopener"
                       class="w-9 h-9 flex items-center justify-center rounded-full border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                    <a href="https://github.com/ClaudioParedesArbeloDev" target="_blank" rel="noopener"
                       class="w-9 h-9 flex items-center justify-center rounded-full border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                        <i class="fa-brands fa-github"></i>
                    </a>
                    <a href="https://www.instagram.com/codelenssolutions/" target="_blank" rel="noopener"
                       class="w-9 h-9 flex items-center justify-center rounded-full border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                    <a href="https://x.com/ClaudioPDev" target="_blank" rel="noopener"
                       class="w-9 h-9 flex items-center justify-center rounded-full border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                    <a href="https://www.youtube.com/@ClaudioParedesDeveloper" target="_blank" rel="noopener"
                       class="w-9 h-9 flex items-center justify-center rounded-full border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </div>
            </div>

            {{-- ============ FORM CARD ============ --}}
            <div class="lg:col-span-3 flex flex-col bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 lg:p-8">
                <form id="demo-form" action="{{ route('contact.store') }}" method="POST" class="flex flex-col font-three text-text-900">
                    @csrf

                    <label for="name" class="text-sm font-medium mb-1">{{ __('Name') }}</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}"
                        class="bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 mb-1 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('name') border-red-500 @enderror">
                    @error('name')
                        <p class="text-xs text-red-500 mb-2">{{ $message }}</p>
                    @enderror

                    <label for="email" class="text-sm font-medium mt-3 mb-1">{{ __('Email') }}</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}"
                        class="bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 mb-1 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('email') border-red-500 @enderror">
                    @error('email')
                        <p class="text-xs text-red-500 mb-2">{{ $message }}</p>
                    @enderror

                    <label for="subject" class="text-sm font-medium mt-3 mb-1">{{ __('Subject') }}</label>
                    <input type="text" name="subject" id="subject" value="{{ old('subject') }}"
                        class="bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 mb-1 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 @error('subject') border-red-500 @enderror">
                    @error('subject')
                        <p class="text-xs text-red-500 mb-2">{{ $message }}</p>
                    @enderror

                    <label for="message" class="text-sm font-medium mt-3 mb-1">{{ __('Message') }}</label>
                    <textarea name="message" id="message" rows="6"
                        class="bg-background-300 text-text-900 p-2.5 rounded-lg border border-variant-100 mb-1 focus:outline-hidden focus:border-accent-900 transition-colors duration-300 resize-none @error('message') border-red-500 @enderror">{{ old('message') }}</textarea>
                    @error('message')
                        <p class="text-xs text-red-500 mb-2">{{ $message }}</p>
                    @enderror

                    <button type="submit"
                        class="mt-4 py-2.5 px-6 self-start inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                        <i class="fa-solid fa-paper-plane"></i>
                        <span>{{ __('Send') }}</span>
                    </button>
                </form>
            </div>

        </div>
    </section>

    @if (session('message'))
        <script>
            Swal.fire({
                title: "{{ __('Message send successfully') }}",
                text: "{{ __('Thank you for your message') }}",
                icon: "success",
                confirmButtonText: "{{ __('Ok') }}",
            });
        </script>
    @endif

</div>
@endsection