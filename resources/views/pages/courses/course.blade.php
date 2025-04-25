@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Course')

@section('content')

<div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-text-900 w-11/12 mx-auto font-three max-h-screen">
    <!-- Header and Back Button -->
    <div class="col-span-1 md:col-span-2 flex justify-between items-center py-4">
        <h2 class="text-2xl uppercase">{{ __('course') }}:</h2>
        <a class="text-xl" href="{{route('admin')}}"><i class="fa-solid fa-arrow-rotate-left"></i></a>
    </div>

    <!-- Left Column: Core Course Details -->
    <div class="col-span-1 space-y-3">
        <h3 class="text-lg font-semibold">{{__('Title')}}: {{ $course->name }}</h3>
        <p>{{__('Teacher')}}: {{ $course->user->name }}</p>
        <div class="max-h-140 overflow-y-auto ">
            <p>{{__('Description')}}: {!! $course->description !!}</p>
        </div>
        @if (($course->capacity != null) && ($course->capacity != ''))
            <p>{{__('Capacity')}}: {{ $course->capacity }}</p>
        @endif
        @if (($course->category != null) && ($course->category != ''))
            <p>{{__('Category')}}: {{ $course->category }}</p>
        @endif
        @if (($course->active != null) && ($course->active != ''))
            <p>{{__('Active')}}: {{ $course->active ? __('Active') : __('Inactive') }}</p>
        @endif
    </div>

    <!-- Right Column: Image and Additional Details -->
    <div class="col-span-1 space-y-3">
        @if ($course->image != null)
            <img class="h-80 object-cover rounded" src="{{ asset('storage/courses/'.$course->image) }}" alt="courseImage">
        @endif
        <p>{{ __('Price') }}: {{ $course->price == 0.00 ? 'Free' : '$' . number_format($course->price, 2) }}</p>
        @if (($course->days1 != null) && ($course->days1 != ''))
            <p>{{__('Days')}}: {{ $course->days1 }}</p>
        @endif
        @if (($course->days2 != null) && ($course->days2 != ''))
            <p>{{__('Days')}}: {{ $course->days2 }}</p>
        @endif
        @if (($course->duration != null) && ($course->duration != ''))
            <p>{{__('Duration')}}: {{ $course->duration }}</p>
        @endif
    </div>

    <!-- Edit and Delete Buttons -->
    <div class="col-span-1 md:col-span-2 flex gap-4 mt-4">
        <a href="/courses/{{$course->id}}/edit" class="btnEdit px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">{{__('Edit Course')}}</a>
        <form action="/courses/{{$course->id}}" method="POST" id="deleteUserForm">
            @csrf
            @method('DELETE')
            <button type="submit" class="deleteUser px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">{{__('Delete Course')}}</button>
        </form>
    </div>
</div>

@endsection