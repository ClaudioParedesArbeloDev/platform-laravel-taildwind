@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Classes')

@section('content')
    <div class="font-four text-text-900 flex flex-col items-center justify-center h-full px-4 lg:px-8">
        <h2 class="font-bold p-4 text-lg lg:text-2xl text-center">{{ $course->name }}</h2>
        
        <div class="w-full overflow-x-auto">
            <table class="text-xs w-full text-center border-collapse bg-background-100 shadow-md rounded-lg lg:text-base">
                <thead class="bg-background-500 text-text-900">
                    <tr>
                        <th class="py-3 px-2 lg:py-4 lg:px-4">{{ __('Date') }}</th>
                        <th class="hidden lg:table-cell py-3 px-2 lg:py-4 lg:px-4">{{ __('Start Time') }}</th>
                        <th class="hidden lg:table-cell py-3 px-2 lg:py-4 lg:px-4">{{ __('Title') }}</th>
                        <th class="hidden lg:table-cell py-3 px-2 lg:py-4 lg:px-4">{{ __('PDF') }}</th>
                        <th class="hidden lg:table-cell py-3 px-2 lg:py-4 lg:px-4">{{ __('PPT') }}</th>
                        <th class="py-3 px-2 lg:py-4 lg:px-4">{{ __('Video') }}</th>
                        <th class="py-3 px-2 lg:py-4 lg:px-4">{{ __('Meet') }}</th>
                        <th class="hidden lg:table-cell py-3 px-2 lg:py-4 lg:px-4">{{ __('Homework') }}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($course->classes as $class)
                    <tr class="border-b hover:bg-background-300 leading-6">
                        <td class="py-2 px-2 lg:py-3 lg:px-4">{{ \Carbon\Carbon::parse($class->date)->translatedFormat('j \d\e F') }}</td>
                        <td class="hidden lg:table-cell py-2 px-2 lg:py-3 lg:px-4">{{ \Carbon\Carbon::parse($class->start_time)->format('H:i') }}</td>
                        <td class="hidden lg:table-cell py-2 px-2 lg:py-3 lg:px-4">{{ $class->title }}</td>
                        <td class="hidden lg:table-cell py-2 px-2 lg:py-3 lg:px-4">
                            @if ($class->pdf != null)
                                <a href="{{ $class->pdf }}" target="_blank" class="text-accent2-500 hover:underline">PDF</a>
                            @else
                                <span class="text-gray-500">Empty</span>
                            @endif
                        </td>
                        <td class="hidden lg:table-cell py-2 px-2 lg:py-3 lg:px-4">
                            @if ($class->powerpoint != null)
                                <a href="{{ $class->powerpoint }}" target="_blank" class="text-accent2-500 hover:underline">PPT</a>
                            @else
                                <span class="text-gray-500">Empty</span>
                            @endif
                        </td>
                        <td class="py-2 px-2 lg:py-3 lg:px-4">
                            @if ($class->video != null)
                                <a href="{{ $class->video }}" target="_blank" class="text-accent2-500 hover:underline">Video</a>
                            @else
                                <span class="text-gray-500">Empty</span>
                            @endif
                        </td>
                        <td class="py-2 px-2 lg:py-3 lg:px-4">
                            @if ($class->meet_link != null)
                                <a href="{{ $class->meet_link }}" target="_blank" class="text-accent2-500 hover:underline">Meet</a>
                            @else
                                <span class="text-gray-500">Empty</span>
                            @endif
                        </td>
                        <td class="hidden lg:table-cell py-2 px-2 lg:py-3 lg:px-4">
                            @if ($class->work == 1)
                                <form action="{{ route('cursos.homework') }}" method="POST" class="flex items-center gap-2">
                                    @csrf
                                    <input type="hidden" name="user" value="{{ Auth::user()->lastname }}.{{ Auth::user()->name }}">
                                    <input type="hidden" name="course_id" value="{{ $course->name }}">
                                    <input type="text" name="homework" class="border rounded px-2 py-1 text-sm" placeholder="Homework">
                                    <button type="submit" class="bg-blue-600 text-white px-3 py-1 rounded hover:bg-blue-700">{{ __('Send') }}</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

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
    </div>
@endsection