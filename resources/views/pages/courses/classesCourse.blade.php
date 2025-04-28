@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Classes')

@section('content')
<div class="min-h-screen bg-background-300 text-text-900 flex flex-col items-center justify-center p-4">
    <div class="w-full bg-background-100 shadow-lg rounded-lg overflow-hidden">
        <div class="p-6">
            <h2 class="text-2xl font-bold  mb-6">Clases del Curso</h2>
            <div class="overflow-x-auto">
                <table class="w-full border-collapse">
                    <thead>
                        <tr class="bg-text-500 text-background-500 uppercase text-sm">
                            <th class="py-3 px-4 text-left">{{ __('Title') }}</th>
                            <th class="py-3 px-4 text-left">{{ __('Date') }}</th>
                            <th class="py-3 px-4 text-left">{{ __('Start Time') }}</th>
                            <th class="py-3 px-4 text-left">{{ __('PDF') }}</th>
                            <th class="py-3 px-4 text-left">{{ __('PPT') }}</th>
                            <th class="py-3 px-4 text-left">{{ __('Video') }}</th>
                            <th class="py-3 px-4 text-left">{{ __('Meet') }}</th>
                            <th class="py-3 px-4 text-left">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($classes as $class)
                            <tr class="border-b hover:bg-gray-50">
                                <form action="{{ route('classes.update', $class->id) }}" method="POST" class="w-full">
                                    @csrf
                                    @method('PUT')
                                    <td class="py-3 px-4">
                                        <input type="text" name="title" value="{{ old('title', $class->title) }}"
                                            class="w-full border rounded-lg px-3 py-2  focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        @error('title')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="py-3 px-4">
                                        <input type="date" name="date" value="{{ old('date', $class->date) }}"
                                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        @error('date')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="py-3 px-4">
                                        <input type="time" name="start_time" value="{{ old('start_time', $class->start_time) }}"
                                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        @error('start_time')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="py-3 px-4">
                                        <input type="text" name="pdf" value="{{ old('pdf', $class->pdf) }}"
                                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        @error('pdf')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="py-3 px-4">
                                        <input type="text" name="powerpoint" value="{{ old('powerpoint', $class->powerpoint) }}"
                                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        @error('ppt')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="py-3 px-4">
                                        <input type="text" name="video" value="{{ old('video', $class->video) }}"
                                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        @error('video')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="py-3 px-4">
                                        <input type="text" name="meet_link" value="{{ old('meet_link', $class->meet_link) }}"
                                            class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                        @error('meet')
                                            <span class="text-red-500 text-sm">{{ $message }}</span>
                                        @enderror
                                    </td>
                                    <td class="py-3 px-4">
                                        <button type="submit"
                                            class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition duration-200">
                                            {{ __('Update') }}
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="py-4 px-4 text-center text-gray-500">
                                    {{ __('No classes found.') }}
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            <div class="mt-6 flex justify-center">
                {{ $classes->links() }}
            </div>
        </div>
    </div>
</div>
@endsection