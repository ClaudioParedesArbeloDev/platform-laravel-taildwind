@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Students')

@section('content')


<div class="flex flex-col w-full h-full justify-center items-center text-text-900 font-four">
    <h2 class="font-bold text-xl p-4">{{__('Students')}}</h2>
        <div class="">
            @foreach ($students as $student)
            <div class="grid grid-cols-4 gap-4">
                <p>{{$student->lastname}}</p>
                <p>{{$student->name}}</p>
                <form action="{{ route('courses.updateStatus', [$course->id, $student->id]) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <label class="" for="status_{{ $student->id }}">{{ __('Status') }}</label>
                    <select class="bg-accent-300 p-2 rounded-md my-2" name="status" id="status_{{ $student->id }}">
                        <option value="inprogress" {{ $student->pivot->status == 'inprogress' ? 'selected' : '' }}>{{ __('In Progress') }}</option>
                        <option value="completed" {{ $student->pivot->status == 'completed' ? 'selected' : '' }}>{{ __('Completed') }}</option>
                    </select>
                    <button class="bg-accent-500 text-white p-2 rounded-md" type="submit" class="btnUpdateStatus">{{ __('Update Status') }}</button>
                </form>
            </div>
            @endforeach
        </div> 
        <div class="mt-6 flex justify-center">
            <div class="inline-flex items-center gap-2 rounded-lg bg-background-100 text-text-900 p-2 shadow-md">
                {{ $students->links() }}
            </div>
        </div>
</div>

@endsection
