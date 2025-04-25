@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Courses')

@section('content')
<div class="coursesContainer mx-auto max-w-7xl px-4 sm:px-6 lg:px-8 py-6 text-text-900">
    <div class="flex justify-between items-center mb-6">
        <h2 class="coursesListTitle text-2xl font-bold  sm:text-3xl">{{ __('Courses') }}</h2>
        <a class="btnBack flex items-center text-text-900 hover:text-accent-500 transition-colors" href="{{ route('admin') }}">
            <i class="fa-solid fa-arrow-rotate-left mr-2"></i> {{ __('Back') }}
        </a>
    </div>

    <!-- Mobile Card Layout (visible on mobile, hidden on lg and above) -->
    <div class="block lg:hidden space-y-4">
        @foreach ($courses as $course)
        <div class="bg-accent-100 shadow-md rounded-lg p-4 border border-text-900">
            <h3 class="text-lg font-semibold">{{ $course->name }}</h3>
            <div class="mt-2 text-sm text-gray-700">
                <p><strong>{{ __('Category') }}:</strong> {{ $course->category }}</p>
                <p><strong>{{ __('Active') }}:</strong>
                    <span class="{{ $course->active ? 'text-green-600' : 'text-red-600' }}">
                        {{ $course->active ? __('Active') : __('Inactive') }}
                    </span>
                </p>
                <p><strong>{{ __('Instructor') }}:</strong> {{ $course->user ? $course->user->name : 'Desconocido' }}</p>
            </div>
            <div class="mt-4 flex flex-col space-y-2">
                <a href="/courses/{{ $course->id }}" class="btnEditCourses inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors text-sm text-center">
                    {{ __('Edit') }}
                </a>
                <a href="{{ route('cursos.students', $course->id) }}" class="btnStudents inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors text-sm text-center">
                    {{ __('Students') }}
                </a>
                <a href="{{ route('cursos.classes', $course->id) }}" class="btnClasses inline-block px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors text-sm text-center">
                    {{ __('Classes') }}
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Desktop Table Layout (hidden on mobile, visible on lg and above) -->
    <div class="hidden lg:block overflow-x-auto shadow-md rounded-lg">
        <table class="min-w-full bg-white border border-gray-200">
            <thead class="bg-gray-100">
                <tr class="coursesTableHeader text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                    <th class="py-3 px-6">{{ __('Title') }}</th>
                    <th class="py-3 px-6">{{ __('Category') }}</th>
                    <th class="py-3 px-6">{{ __('Active') }}</th>
                    <th class="py-3 px-6">{{ __('Instructor') }}</th>
                    <th class="py-3 px-6">{{ __('Edit') }}</th>
                    <th class="py-3 px-6">{{ __('Students') }}</th>
                    <th class="py-3 px-6">{{ __('Classes') }}</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @foreach ($courses as $course)
                <tr class="coursesTableBody hover:bg-gray-50 transition-colors">
                    <td class="py-4 px-6 text-gray-900">{{ $course->name }}</td>
                    <td class="py-4 px-6 text-gray-700">{{ $course->category }}</td>
                    <td class="py-4 px-6">
                        <span class="{{ $course->active ? 'text-green-600' : 'text-red-600' }}">
                            {{ $course->active ? __('Active') : __('Inactive') }}
                        </span>
                    </td>
                    <td class="py-4 px-6 text-gray-700">{{ $course->user ? $course->user->name : 'Desconocido' }}</td>
                    <td class="py-4 px-6">
                        <a href="/courses/{{ $course->id }}" class="btnEditCourses inline-block px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors text-sm">
                            {{ __('Edit') }}
                        </a>
                    </td>
                    <td class="py-4 px-6">
                        <a href="{{ route('cursos.students', $course->id) }}" class="btnStudents inline-block px-4 py-2 bg-green-600 text-white rounded-md hover:bg-green-700 transition-colors text-sm">
                            {{ __('Students') }}
                        </a>
                    </td>
                    <td class="py-4 px-6">
                        <a href="{{ route('cursos.classes', $course->id) }}" class="btnClasses inline-block px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors text-sm">
                            {{ __('Classes') }}
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection