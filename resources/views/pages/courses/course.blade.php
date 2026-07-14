@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Curso')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-3xl mx-auto px-4 lg:px-8 py-8">

        
        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('Dashboard') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ $course->name }}
                </h1>
            </div>
            <a href="{{ route('courses.index') }}" class="text-sm text-variant-100 hover:underline flex items-center gap-x-2">
                <i class="fa-solid fa-arrow-left"></i>
                {{ __('Back') }}
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 text-sm rounded-lg p-4 mb-6">{{ session('success') }}</div>
        @endif

        <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl overflow-hidden mb-6">
            @if ($course->image)
                <img src="{{ asset('storage/courses/' . $course->image) }}" alt="{{ $course->name }}" class="w-full h-56 object-cover">
            @endif

            <div class="p-6 lg:p-8">
                <div class="flex flex-wrap gap-1.5 mb-4">
                    @if ($course->category)
                        <span class="text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full bg-background-300 text-text-500">
                            {{ $course->category }}
                        </span>
                    @endif
                    <span class="text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full {{ $course->active ? 'bg-green-100 text-green-700' : 'bg-background-300 text-text-500' }}">
                        {{ $course->active ? __('Active') : __('Inactive') }}
                    </span>
                </div>

                <p class="text-sm text-text-500 mb-1">{{ __('Teacher') }}: {{ $course->user->name ?? '—' }}</p>
                <p class="text-sm text-text-900 leading-relaxed mb-6">{!! $course->description !!}</p>

                <dl class="grid grid-cols-2 sm:grid-cols-3 gap-x-6 gap-y-4 text-sm">
                    <div>
                        <dt class="text-xs uppercase tracking-wide text-variant-100 mb-0.5">{{ __('Price') }}</dt>
                        <dd class="text-text-900 font-semibold">{{ $course->price == 0.00 ? __('Free') : '$' . number_format($course->price, 2, ',', '.') }}</dd>
                    </div>
                    @if ($course->duration)
                        <div>
                            <dt class="text-xs uppercase tracking-wide text-variant-100 mb-0.5">{{ __('Duration') }}</dt>
                            <dd class="text-text-900">{{ $course->duration }}</dd>
                        </div>
                    @endif
                    @if ($course->capacity)
                        <div>
                            <dt class="text-xs uppercase tracking-wide text-variant-100 mb-0.5">{{ __('Capacity') }}</dt>
                            <dd class="text-text-900">{{ $course->capacity }}</dd>
                        </div>
                    @endif
                    @if ($course->days1)
                        <div>
                            <dt class="text-xs uppercase tracking-wide text-variant-100 mb-0.5">{{ __('Days') }} 1</dt>
                            <dd class="text-text-900">{{ $course->days1 }}</dd>
                        </div>
                    @endif
                    @if ($course->days2)
                        <div>
                            <dt class="text-xs uppercase tracking-wide text-variant-100 mb-0.5">{{ __('Days') }} 2</dt>
                            <dd class="text-text-900">{{ $course->days2 }}</dd>
                        </div>
                    @endif
                </dl>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-6">
            <a href="{{ route('cursos.students', $course->id) }}"
               class="flex items-center gap-x-3 bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5 hover:-translate-y-1 transition-transform duration-300">
                <i class="fa-solid fa-users text-lg text-variant-100"></i>
                <span class="text-sm font-medium text-text-900">{{ __('Manage students') }}</span>
            </a>
            <a href="{{ route('cursos.classes', $course->id) }}"
               class="flex items-center gap-x-3 bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5 hover:-translate-y-1 transition-transform duration-300">
                <i class="fa-solid fa-chalkboard text-lg text-variant-100"></i>
                <span class="text-sm font-medium text-text-900">{{ __('Manage classes') }}</span>
            </a>
        </div>

        <div class="flex gap-x-3">
            <a href="{{ route('courses.edit', $course->id) }}"
               class="flex-1 py-2.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                <i class="fa-solid fa-pen"></i>
                <span>{{ __('Edit Course') }}</span>
            </a>

            <form action="{{ route('courses.destroy', $course->id) }}" method="POST" id="deleteCourseForm">
                @csrf
                @method('DELETE')
                <button type="button" id="deleteCourseBtn"
                    class="py-2.5 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-red-500 text-red-600 hover:bg-red-600 hover:text-white focus:outline-hidden transition-colors duration-300">
                    <i class="fa-solid fa-trash"></i>
                    <span>{{ __('Delete Course') }}</span>
                </button>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('deleteCourseBtn').addEventListener('click', function () {
        Swal.fire({
            title: "{{ __('Are you sure?') }}",
            text: "{{ __('This will permanently delete the course and its classes.') }}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "{{ __('Yes, delete it!') }}",
            cancelButtonText: "{{ __('Cancel') }}",
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('deleteCourseForm').submit();
            }
        });
    });
</script>
@endsection
