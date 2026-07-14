@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Cursos')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-6xl mx-auto px-4 lg:px-8 py-8">

       
        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('Dashboard') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ __('Courses') }}
                </h1>
            </div>
            <a href="{{ route('courses.create') }}"
               class="py-2.5 px-5 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                <i class="fa-solid fa-plus"></i>
                <span>{{ __('create') }}</span>
            </a>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 text-sm rounded-lg p-4 mb-6">{{ session('success') }}</div>
        @endif

        @if ($courses->isEmpty())
            <div class="flex flex-col items-center text-center bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-10">
                <i class="fa-solid fa-graduation-cap text-3xl text-variant-100 mb-4"></i>
                <p class="text-text-500">{{ __('No courses found.') }}</p>
            </div>
        @else
            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl overflow-hidden overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-variant-100 text-left">
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Title') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium hidden lg:table-cell">{{ __('Category') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium hidden lg:table-cell">{{ __('Instructor') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Status') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium text-right">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($courses as $course)
                            <tr class="border-b border-variant-100 last:border-b-0">
                                <td class="p-4">
                                    <p class="font-bold text-text-900">{{ $course->name }}</p>
                                    <p class="text-xs text-text-500 lg:hidden">{{ $course->category }}</p>
                                </td>
                                <td class="p-4 text-text-500 hidden lg:table-cell">{{ $course->category ?? '—' }}</td>
                                <td class="p-4 text-text-500 hidden lg:table-cell">{{ $course->user->name ?? '—' }}</td>
                                <td class="p-4">
                                    <span class="text-[10px] font-bold uppercase tracking-wide px-2 py-1 rounded-full {{ $course->active ? 'bg-green-100 text-green-700' : 'bg-background-300 text-text-500' }}">
                                        {{ $course->active ? __('Active') : __('Inactive') }}
                                    </span>
                                </td>
                                <td class="p-4">
                                    <div class="flex justify-end gap-x-2">
                                        <a href="{{ route('courses.show', $course->id) }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-lg border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('courses.edit', $course->id) }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-lg border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <a href="{{ route('cursos.students', $course->id) }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-lg border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                                            <i class="fa-solid fa-users"></i>
                                        </a>
                                        <a href="{{ route('cursos.classes', $course->id) }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-lg border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                                            <i class="fa-solid fa-chalkboard"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $courses->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
