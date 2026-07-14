@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Asistencia')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-5xl mx-auto px-4 lg:px-8 py-8">

       
        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('Dashboard') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ __('attendance') }}
                </h1>
            </div>
            <a href="{{ route('admin') }}" class="text-sm text-variant-100 hover:underline flex items-center gap-x-2">
                <i class="fa-solid fa-arrow-left"></i>
                {{ __('Back') }}
            </a>
        </div>

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
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Students') }}</th>
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
                                <td class="p-4 text-text-500">{{ $course->students_count }}</td>
                                <td class="p-4">
                                    <div class="flex justify-end">
                                        <a href="{{ route('attendance.edit', $course->id) }}"
                                           class="py-2 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-accent-900 text-text-900 hover:bg-accent-900 hover:text-white transition-colors duration-300">
                                            {{ __('Take attendance') }}
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
