@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Clases')

@section('content')
<div class="w-full min-h-screen overflow-y-auto bg-background-300">
    <div class="max-w-5xl mx-auto px-4 lg:px-8 py-8">

        
        <div class="flex justify-between items-center mb-8">
            <div>
                <p class="font-five uppercase tracking-[6px] text-xs text-variant-100 mb-2">
                    {{ __('Dashboard') }}
                </p>
                <h1 class="font-three font-bold text-2xl lg:text-3xl text-text-500">
                    {{ $course->name }}
                </h1>
            </div>
            <div class="flex items-center gap-x-4">
                <a href="{{ route('classes.create') }}?course_id={{ $course->id }}"
                   class="py-2.5 px-5 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg bg-accent-900 text-white hover:opacity-90 focus:outline-hidden transition-opacity duration-300">
                    <i class="fa-solid fa-plus"></i>
                    <span>{{ __('create') }}</span>
                </a>
                <a href="{{ route('courses.show', $course->id) }}" class="text-sm text-variant-100 hover:underline flex items-center gap-x-2">
                    <i class="fa-solid fa-arrow-left"></i>
                    {{ __('Back') }}
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="bg-green-100 text-green-700 text-sm rounded-lg p-4 mb-6">{{ session('success') }}</div>
        @endif

        @if ($classes->isEmpty())
            <div class="flex flex-col items-center text-center bg-background-500 border border-variant-100 shadow-2xs rounded-xl p-10">
                <i class="fa-solid fa-chalkboard text-3xl text-variant-100 mb-4"></i>
                <p class="text-text-500">{{ __('No classes found.') }}</p>
            </div>
        @else
            <div class="bg-background-500 border border-variant-100 shadow-2xs rounded-xl overflow-hidden overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="border-b border-variant-100 text-left">
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Title') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium">{{ __('Date') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium hidden lg:table-cell">{{ __('Start Time') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium hidden lg:table-cell">{{ __('Materials') }}</th>
                            <th class="p-4 text-xs uppercase tracking-wide text-variant-100 font-medium text-right">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($classes as $class)
                            <tr class="border-b border-variant-100 last:border-b-0">
                                <td class="p-4">
                                    <p class="font-bold text-text-900">{{ $class->title }}</p>
                                </td>
                                <td class="p-4 text-text-500">
                                    {{ $class->date ? \Illuminate\Support\Carbon::parse($class->date)->format('d/m/Y') : '—' }}
                                </td>
                                <td class="p-4 text-text-500 hidden lg:table-cell">
                                    {{ $class->start_time ?? '—' }}
                                </td>
                                <td class="p-4 hidden lg:table-cell">
                                    <div class="flex gap-x-3 text-xs">
                                        @if ($class->pdf)
                                            <a href="{{ $class->pdf }}" target="_blank" rel="noopener" class="text-variant-100 hover:underline">PDF</a>
                                        @endif
                                        @if ($class->powerpoint)
                                            <a href="{{ $class->powerpoint }}" target="_blank" rel="noopener" class="text-variant-100 hover:underline">PPT</a>
                                        @endif
                                        @if ($class->video)
                                            <a href="{{ $class->video }}" target="_blank" rel="noopener" class="text-variant-100 hover:underline">Video</a>
                                        @endif
                                        @if ($class->meet_link)
                                            <a href="{{ $class->meet_link }}" target="_blank" rel="noopener" class="text-variant-100 hover:underline">Meet</a>
                                        @endif
                                        @if ($class->work)
                                            <span class="text-text-500">📝 {{ __('Homework') }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="p-4">
                                    <div class="flex justify-end gap-x-2">
                                        <a href="{{ route('classes.edit', $class->id) }}"
                                           class="w-9 h-9 flex items-center justify-center rounded-lg border border-variant-100 text-text-500 hover:bg-accent-900 hover:text-white hover:border-accent-900 transition-colors duration-300">
                                            <i class="fa-solid fa-pen"></i>
                                        </a>
                                        <form action="{{ route('classes.destroy', $class->id) }}" method="POST"
                                              onsubmit="return confirm('{{ __('Are you sure you want to delete this?') }}');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="w-9 h-9 flex items-center justify-center rounded-lg border border-variant-100 text-text-500 hover:bg-red-600 hover:text-white hover:border-red-600 transition-colors duration-300">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="mt-6">
                {{ $classes->links() }}
            </div>
        @endif

    </div>
</div>
@endsection
