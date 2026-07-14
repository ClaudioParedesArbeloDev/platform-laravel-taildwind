@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Alumnos')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-4xl mx-auto px-4 lg:px-8 py-8">


        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('Dashboard') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ __('Students') }} — {{ $course->name }}
                </h1>
            </div>
            <a href="{{ route('courses.show', $course->id) }}" class="text-sm text-variant-100 hover:underline flex items-center gap-x-2">
                <i class="fa-solid fa-arrow-left"></i>
                {{ __('Back') }}
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 text-sm rounded-lg p-4 mb-6">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="bg-red-100 text-red-700 text-sm rounded-lg p-4 mb-6">{{ session('error') }}</div>
        @endif

        @if ($students->isEmpty())
            <div class="flex flex-col items-center text-center bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-10">
                <i class="fa-solid fa-users text-3xl text-variant-100 mb-4"></i>
                <p class="text-text-500">{{ __('No students enrolled in this course yet.') }}</p>
            </div>
        @else
            <div class="flex flex-col gap-4">
                @foreach ($students as $student)
                    <div class="flex flex-col sm:flex-row sm:items-center gap-4 bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-5">

                        <div class="sm:flex-1">
                            <p class="font-bold text-text-900">{{ $student->name }} {{ $student->lastname }}</p>
                            <p class="text-xs text-text-500">{{ $student->email }}</p>
                        </div>

                        <form action="{{ route('courses.updateStatus', [$course->id, $student->id]) }}" method="POST" class="flex items-center gap-x-2">
                            @csrf
                            @method('PUT')
                            <select name="status"
                                class="bg-background-300 text-text-900 text-sm p-2 rounded-lg border border-variant-100 focus:outline-hidden focus:border-accent-900 transition-colors duration-300">
                                <option value="in progress" {{ $student->pivot->status != 'completed' ? 'selected' : '' }}>{{ __('In Progress') }}</option>
                                <option value="completed" {{ $student->pivot->status == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                            </select>
                            <button type="submit"
                                class="py-2 px-3 text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white transition-colors duration-300">
                                {{ __('Update Status') }}
                            </button>
                        </form>

                        <form action="{{ route('courses.students.destroy', [$course->id, $student->id]) }}" method="POST"
                              onsubmit="return confirm('{{ __('This will remove the student from the course. This cannot be undone.') }}');">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="w-9 h-9 flex items-center justify-center rounded-lg border border-red-500 text-red-600 hover:bg-red-600 hover:text-white transition-colors duration-300">
                                <i class="fa-solid fa-user-xmark"></i>
                            </button>
                        </form>

                    </div>
                @endforeach
            </div>

            <div class="mt-6">
                {{ $students->links() }}
            </div>
        @endif

    </div>
</div>
@endsection