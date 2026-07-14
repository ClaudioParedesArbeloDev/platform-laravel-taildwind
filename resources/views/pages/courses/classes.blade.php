@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Clases')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-5xl mx-auto px-4 lg:px-8 py-8">

        
        <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
            {{ __('Dashboard') }}
        </p>
        <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500 mb-8">
            {{ $course->name }}
        </h1>

        @if ($classes->isEmpty())
            <div class="flex flex-col items-center text-center bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-10">
                <i class="fa-solid fa-chalkboard text-3xl text-variant-100 mb-4"></i>
                <p class="text-text-500">{{ __('No classes found.') }}</p>
            </div>
        @else
            <div class="flex flex-col gap-4">
                @foreach ($classes as $class)
                    <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5">
                        <div class="flex flex-wrap justify-between items-start gap-2 mb-3">
                            <div>
                                <h3 class="font-three font-bold text-base text-text-900">{{ $class->title }}</h3>
                                <p class="text-xs text-text-500 mt-0.5">
                                    {{ $class->date ? \Illuminate\Support\Carbon::parse($class->date)->translatedFormat('j \d\e F') : '—' }}
                                    @if ($class->start_time)
                                        · {{ \Illuminate\Support\Carbon::parse($class->start_time)->format('H:i') }}
                                    @endif
                                </p>
                            </div>
                        </div>

                        <div class="flex flex-wrap gap-2 mb-4">
                            @if ($class->pdf)
                                <a href="{{ $class->pdf }}" target="_blank" rel="noopener"
                                   class="text-xs px-3 py-1.5 rounded-full border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                                    <i class="fa-solid fa-file-pdf"></i> PDF
                                </a>
                            @endif
                            @if ($class->powerpoint)
                                <a href="{{ $class->powerpoint }}" target="_blank" rel="noopener"
                                   class="text-xs px-3 py-1.5 rounded-full border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                                    <i class="fa-solid fa-file-powerpoint"></i> PPT
                                </a>
                            @endif
                            @if ($class->video)
                                <a href="{{ $class->video }}" target="_blank" rel="noopener"
                                   class="text-xs px-3 py-1.5 rounded-full border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                                    <i class="fa-solid fa-video"></i> {{ __('Video') }}
                                </a>
                            @endif
                            @if ($class->meet_link)
                                <a href="{{ $class->meet_link }}" target="_blank" rel="noopener"
                                   class="text-xs px-3 py-1.5 rounded-full border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                                    <i class="fa-solid fa-video-camera"></i> Meet
                                </a>
                            @endif
                        </div>

                        @if ($class->work == 1)
                            <form action="{{ route('cursos.homework') }}" method="POST" class="homeworkForm flex flex-col sm:flex-row gap-2 pt-3 border-t border-variant-100">
                                @csrf
                                <input type="hidden" name="user" value="{{ Auth::user()->lastname }}.{{ Auth::user()->name }}">
                                <input type="hidden" name="course_id" value="{{ $course->name }}">
                                <input type="text" name="homework" placeholder="{{ __('Homework') }}"
                                    class="flex-1 bg-background-300 text-text-900 p-2 text-sm rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300">
                                <button type="submit"
                                    class="py-2 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                                    {{ __('Send') }}
                                </button>
                            </form>
                        @endif
                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $classes->links() }}
            </div>
        @endif

    </div>
</div>

<script>
    document.querySelectorAll('.homeworkForm').forEach(function (form) {
        form.addEventListener('submit', function () {
            Swal.fire({
                title: "{{ __('Sending...') }}",
                text: "{{ __('Please wait a moment.') }}",
                allowOutsideClick: false,
                didOpen: () => { Swal.showLoading(); }
            });
        });
    });
</script>

@if (session('message'))
    <script>
        Swal.fire({
            title: "{{ __('Homework sent successfully') }}",
            text: "{{ __('Thank you for your message') }}",
            icon: "success",
            confirmButtonText: "{{ __('Ok') }}",
        });
    </script>
@endif
@endsection
