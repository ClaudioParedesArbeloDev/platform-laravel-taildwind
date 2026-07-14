@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Más Cursos')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-6xl mx-auto px-4 lg:px-8 py-8">

       
        <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
            {{ __('Dashboard') }}
        </p>
        <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500 mb-8">
            {{ __('More courses') }}
        </h1>

        @if ($coursesByCategory->isEmpty())
            <div class="flex flex-col items-center text-center bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-10">
                <i class="fa-solid fa-graduation-cap text-3xl text-variant-100 mb-4"></i>
                <p class="text-text-500">{{ __('No courses available right now.') }}</p>
            </div>
        @else
         
            @if ($coursesByCategory->count() > 1)
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach ($coursesByCategory as $category => $courses)
                        <a href="#cat-{{ \Illuminate\Support\Str::slug($category ?: 'general') }}"
                           class="font-five text-xs uppercase tracking-wide px-4 py-2 rounded-full border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                            {{ $category ?: __('General') }}
                        </a>
                    @endforeach
                </div>
            @endif

           
            @foreach ($coursesByCategory as $category => $courses)
                <section id="cat-{{ \Illuminate\Support\Str::slug($category ?: 'general') }}" class="mb-12 scroll-mt-24">
                    <h2 class="font-three font-bold text-lg text-text-500 uppercase mb-5 pb-2 border-b border-variant-100">
                        {{ $category ?: __('General') }}
                    </h2>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        @foreach ($courses as $course)
                            @php
                                $isEnrolled = $enrolledCourseIds->contains($course->id);
                            @endphp
                            <div class="relative flex flex-col bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5 hover:-translate-y-1 transition-transform duration-300">
                                @if ($isEnrolled)
                                    <span class="absolute top-3 right-3 bg-green-600 text-white text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full">
                                        {{ __('Enrolled') }}
                                    </span>
                                @endif

                                <h3 class="text-base font-bold text-text-900 mb-3 line-clamp-2 pr-16">
                                    {{ $course->name }}
                                </h3>

                                <div class="flex justify-between items-center text-sm text-text-500 mb-4">
                                    @if ($course->duration)
                                        <span>{{ __('Duration') }}: {{ $course->duration }}</span>
                                    @endif
                                    <span class="font-semibold text-text-900">
                                        {{ $course->price == 0.00 ? __('Free') : '$' . number_format($course->price, 2, ',', '.') }}
                                    </span>
                                </div>

                                @if ($isEnrolled)
                                    <a href="{{ route('cursos.class', $course->id) }}"
                                       class="mt-auto py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                                        {{ __('Access the course') }}
                                    </a>
                                @else
                                    <a href="{{ route('cursos.detail', $course->id) }}"
                                       class="mt-auto py-2 px-3 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white focus:outline-hidden transition-colors duration-300">
                                        {{ __('More Info') }}
                                    </a>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </section>
            @endforeach
        @endif

    </div>
</div>
@endsection
