@extends('components.layout.layout')
@section('title', 'Code & Lens - Courses')
@section('content')

<div class="flex flex-col items-center w-full">

    
    <section class="w-full flex flex-col items-center text-center px-4 py-10 lg:py-14">
        <p class="font-five uppercase tracking-[6px] text-xs lg:text-sm text-variant-100 mb-3">
            {{ __('Platform') }}
        </p>
        <h1 class="font-three font-bold text-xl leading-tight lg:text-4xl text-text-500">
            {{ __('Courses') }} {{ __('Availables') }}
        </h1>
    </section>

    @if ($coursesByCategory->isEmpty())
        <div class="flex flex-col items-center text-center px-4 py-16">
            <i class="fa-solid fa-graduation-cap text-4xl text-variant-100 mb-4"></i>
            <p class="font-three text-text-500">{{ __('No courses available right now.') }}</p>
        </div>
    @else
       
        @if ($coursesByCategory->count() > 1)
            <div class="w-full max-w-7xl px-4 lg:px-16 mb-6 flex flex-wrap justify-center gap-2">
                @foreach ($coursesByCategory as $category => $courses)
                    <a href="#cat-{{ \Illuminate\Support\Str::slug($category ?: 'general') }}"
                       class="font-five text-xs uppercase tracking-wide px-4 py-2 rounded-full border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                        {{ $category ?: __('General') }}
                    </a>
                @endforeach
            </div>
        @endif

      
        <div class="w-full max-w-7xl px-4 lg:px-16 pb-12">
            @foreach ($coursesByCategory as $category => $courses)
                <section id="cat-{{ \Illuminate\Support\Str::slug($category ?: 'general') }}" class="mb-12 scroll-mt-24">
                    <h2 class="font-three font-bold text-lg lg:text-xl text-text-500 uppercase mb-5 pb-2 border-b border-variant-100">
                        {{ $category ?: __('General') }}
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
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
                                    <h3 class="text-base font-bold text-text-900 line-clamp-2">{{ $course->name }}</h3>

                                    <div class="flex justify-between items-center mt-2 text-sm text-text-500">
                                        @if ($course->duration)
                                            <span>{{ __('Duration') }}: {{ $course->duration }}</span>
                                        @endif
                                        <span class="font-semibold text-text-900">
                                            {{ $course->price == 0.00 ? __('Free') : '$' . number_format($course->price, 2, ',', '.') }}
                                        </span>
                                    </div>

                                    @if ($course->user)
                                        <p class="text-xs text-text-500 mt-1">{{ __('Teacher') }}: {{ $course->user->name }}</p>
                                    @endif

                                    <a class="mt-4 py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white focus:outline-hidden transition-colors duration-300"
                                       href="{{ route('cursos.detail', $course->id) }}">
                                        <span>{{ __('More Info') }}</span>
                                    </a>
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