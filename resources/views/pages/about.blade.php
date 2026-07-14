@extends('components.layout.layout')

@section('title', 'Code & Lens Solutions - Acerca de')

@section('content')

<div class="flex flex-col items-center w-full">

  
    <section class="w-full flex flex-col items-center text-center px-4 py-10 lg:py-16">
        <p class="font-five uppercase tracking-[6px] text-xs lg:text-sm text-variant-100 mb-3">
            {{ __('Company') }}
        </p>
        <h1 class="font-three font-bold text-xl leading-tight lg:text-4xl lg:leading-tight text-text-500 max-w-3xl">
            {{ __('Code & Lens Solutions') }}
        </h1>
        <p class="font-three text-sm lg:text-lg text-text-500 mt-4 max-w-2xl">
            {{ __('We train, we build, we ship. A software studio that teaches what it practices.') }}
        </p>
    </section>

    
    <section class="w-full px-4 lg:px-16 py-8">
        <div class="max-w-7xl mx-auto">
            <h2 class="font-three font-bold text-lg lg:text-2xl text-text-500 text-center mb-2">
                {{ __('What we do') }}
            </h2>
            <p class="font-three text-sm lg:text-base text-text-500 text-center max-w-2xl mx-auto mb-10">
                {{ __('Beyond teaching, we are a full-stack studio that designs, builds and ships digital products for real businesses.') }}
            </p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">

              
                <div class="flex flex-col bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-12 h-12 rounded-full bg-accent1-300 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-graduation-cap text-xl text-accent1-900"></i>
                    </div>
                    <h3 class="font-three font-bold text-base text-text-900 mb-2">{{ __('Courses & Training') }}</h3>
                    <p class="text-sm text-text-500">{{ __('Programming, photography and video courses to grow your skills from scratch or level up your career.') }}</p>
                </div>

                
                <div class="flex flex-col bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-12 h-12 rounded-full bg-accent2-300 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-layer-group text-xl text-accent2-900"></i>
                    </div>
                    <h3 class="font-three font-bold text-base text-text-900 mb-2">{{ __('Custom & Off-the-Shelf Software') }}</h3>
                    <p class="text-sm text-text-500">{{ __('Ready-to-use tools ready to plug into your business, plus fully custom systems built around your workflow.') }}</p>
                </div>

                
                <div class="flex flex-col bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-12 h-12 rounded-full bg-accent-300 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-globe text-xl text-accent-900"></i>
                    </div>
                    <h3 class="font-three font-bold text-base text-text-900 mb-2">{{ __('Web Development') }}</h3>
                    <p class="text-sm text-text-500">{{ __('Fast, modern websites and web apps built with JavaScript and PHP, from landing pages to full platforms.') }}</p>
                </div>

                
                <div class="flex flex-col bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 hover:-translate-y-1 transition-transform duration-300">
                    <div class="w-12 h-12 rounded-full bg-accent1-300 flex items-center justify-center mb-4">
                        <i class="fa-solid fa-mobile-screen-button text-xl text-accent1-900"></i>
                    </div>
                    <h3 class="font-three font-bold text-base text-text-900 mb-2">{{ __('Cross-Platform Apps') }}</h3>
                    <p class="text-sm text-text-500">{{ __('Native and hybrid apps for Android, iOS, Windows and macOS, tailored to how your team actually works.') }}</p>
                </div>

            </div>
        </div>
    </section>

    
    <section class="w-full px-4 lg:px-16 py-8">
        <div class="max-w-7xl mx-auto flex flex-col items-center">
            <h2 class="font-three font-bold text-lg lg:text-2xl text-text-500 mb-6 text-center">
                {{ __('Our stack') }}
            </h2>
            <div class="flex flex-wrap justify-center gap-2 max-w-4xl">
                @foreach (['HTML5','CSS3','JavaScript','React','Angular','Node.js','Express','PHP','Laravel','Spring Boot','Flutter','Kotlin','Swift','MySQL','MongoDB'] as $tech)
                    <span class="font-five text-xs uppercase tracking-wide px-4 py-2 rounded-full border border-variant-100 text-text-500">
                        {{ $tech }}
                    </span>
                @endforeach
            </div>
        </div>
    </section>

    
    <section class="w-full px-4 lg:px-16 py-8">
        <div class="max-w-4xl mx-auto bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-6 lg:p-10">
            <h2 class="font-three font-bold text-lg lg:text-2xl text-text-500 mb-4">
                {{ __('The people behind it') }}
            </h2>
            <p class="text-sm text-text-900 text-justify pb-4 lg:text-base">
                {{ __('Code & Lens Solutions was born from Claudio Paredes\' 24+ years of experience as a teacher, developer, photographer and filmmaker. What started as a place to teach programming, photography and video grew into a studio that also designs and ships the software it teaches.') }}
            </p>
            <p class="text-sm text-text-900 text-justify pb-4 lg:text-base">
                {{ __('We combine hands-on teaching with real production work: every course is backed by projects we actually build and maintain for clients, and every client project benefits from the same care we put into our lessons.') }}
            </p>
            <p class="text-sm text-text-900 text-justify lg:text-base">
                {{ __('Whether you want to learn a new skill or need a partner to build your next product, our goal stays the same: solve real problems with solid, well-crafted solutions.') }}
            </p>
        </div>
    </section>

   
    <section class="w-full px-4 lg:px-16 py-12">
        <div class="max-w-4xl mx-auto flex flex-col items-center text-center gap-6">
            <h2 class="font-three font-bold text-lg lg:text-2xl text-text-500">
                {{ __('Ready to work together?') }}
            </h2>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="{{ route('cursos') }}" class="py-2 px-5 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white focus:outline-hidden transition-colors duration-300">
                    {{ __('Explore courses') }}
                </a>
                <a href="{{ route('software.catalog') }}" class="py-2 px-5 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white focus:outline-hidden transition-colors duration-300">
                    {{ __('See our software') }}
                </a>
                <a href="{{ route('contact.index') }}" class="py-2 px-5 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                    {{ __('Contact us') }}
                </a>
            </div>
        </div>
    </section>

</div>

@endsection