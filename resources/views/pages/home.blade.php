@extends('components.layout.layout')
@section('title', 'Code & Lens')
@section('content')

<div class="flex flex-col items-center w-full">


    <section class="w-full flex flex-col items-center text-center px-4 py-10 lg:py-16">
        <p class="font-five uppercase tracking-[6px] text-xs lg:text-sm text-variant-100 mb-3">
            {{ __('Platform') }}
        </p>
        <h1 class="font-three font-bold text-xl leading-tight lg:text-4xl lg:leading-tight text-text-500 max-w-3xl">
            {{ __('Learn Programming, Photography and Video') }}
        </h1>
        <p class="font-three text-sm lg:text-lg text-text-500 mt-4 max-w-2xl">
            {{ __('Courses to grow your skills, plus ready-to-use software for your business.') }}
        </p>
    </section>

  
    @if ($courses->count() > 0)
        <section class="w-full px-4 lg:px-16 py-8">
            <div class="flex justify-between items-end mb-6 max-w-7xl mx-auto">
                <h2 class="font-three font-bold text-lg lg:text-2xl text-text-500">{{ __('Courses') }}</h2>
                <a href="{{ route('cursos') }}" class="font-five text-xs lg:text-sm text-variant-100 hover:underline whitespace-nowrap">
                    {{ __('See all') }} &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 max-w-7xl mx-auto">
                @foreach ($courses as $course)
                    <div class="flex flex-col bg-background-500 border border-variant-100 shadow-2xs rounded-xl overflow-hidden hover:-translate-y-1 transition-transform duration-300">
                        @if ($course->image != null)
                            <img src="{{ asset('storage/courses/'.$course->image) }}" alt="{{ $course->name }}" class="w-full h-40 object-cover">
                        @else
                            <div class="w-full h-40 bg-accent1-300 flex items-center justify-center">
                                <i class="fa-solid fa-graduation-cap text-3xl text-accent1-900"></i>
                            </div>
                        @endif
                        <div class="p-4 flex flex-col grow">
                            <p class="text-xs uppercase tracking-wide text-variant-100">{{ $course->category }}</p>
                            <h3 class="text-base font-bold text-text-900 mt-1 line-clamp-2">{{ $course->name }}</h3>
                            <div class="flex justify-between items-center mt-2 text-sm text-text-500">
                                <span>{{ $course->duration }}</span>
                                <span class="font-semibold text-text-900">
                                    {{ $course->price == 0.00 ? __('Free') : '$' . number_format($course->price, 2, ',', '.') }}
                                </span>
                            </div>
                            <a class="mt-4 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white focus:outline-hidden transition-colors duration-300"
                               href="{{ route('cursos.detail', $course->id) }}">
                                <span>{{ __('More Info') }}</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

  
    @if ($softwares->count() > 0)
        <section class="w-full px-4 lg:px-16 py-8">
            <div class="flex justify-between items-end mb-6 max-w-7xl mx-auto">
                <h2 class="font-three font-bold text-lg lg:text-2xl text-text-500">{{ __('Software') }}</h2>
                <a href="{{ route('software.catalog') }}" class="font-five text-xs lg:text-sm text-variant-100 hover:underline whitespace-nowrap">
                    {{ __('See all') }} &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5 max-w-7xl mx-auto">
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
                                <i class="fa-solid fa-code text-3xl text-accent2-900"></i>
                            </div>
                        @endif
                        <div class="p-4 flex flex-col grow">
                            @if ($software->category)
                                <p class="text-xs uppercase tracking-wide text-variant-100">{{ $software->category }}</p>
                            @endif
                            <h3 class="text-base font-bold text-text-900 mt-1 line-clamp-2">{{ $software->name }}</h3>
                            @if ($software->short_description)
                                <p class="text-sm text-text-500 mt-1 line-clamp-2">{{ $software->short_description }}</p>
                            @endif
                            <div class="flex justify-between items-center mt-3 text-sm">
                                <span class="font-semibold text-text-900">
                                    @if ($software->requires_quote || !$software->price)
                                        {{ __('Quote') }}
                                    @else
                                        ${{ number_format($software->price, 2, ',', '.') }}
                                    @endif
                                </span>
                            </div>
                            <a class="mt-4 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white focus:outline-hidden transition-colors duration-300"
                               href="{{ route('software.show', $software->id) }}">
                                <span>{{ __('More Info') }}</span>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </section>
    @endif

</div>
@endsection