@extends('components.layout.dashLayout')

@section('title', 'Code & Lens - Dashboard')

@section('content')

    <div class="container">
        <h2>{{$course->name}}</h2>
        
        <table>
            <thead>
                <tr>
                    <th>{{__('Date')}}</th>
                    <th>{{__('Start Time')}}</th>
                    <th>{{__('Title')}}</th>
                    <th>{{__('PDF')}}</th>
                    <th>{{__('PPT')}}</th>
                    <th>{{__('Video')}}</th>
                    <th>{{__('Meet')}}</th>
                    <th>{{__('Homework')}}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($course->classes as $class)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($class->date)->translatedFormat('j \d\e F') }}</td>
                    <td>{{ \Carbon\Carbon::parse($class->start_time)->format('H:i')}}</td>
                    <td>{{$class->title}}</td>
                    @if ($class->pdf != null)
                    <td><a href="{{$class->pdf}}"  target="_blank">PDF</a></td>
                    @else
                    <td>Empty</td>  
                    @endif
                    @if ($class->powerpoint != null)
                    <td><a href="{{$class->powerpoint}}"  target="_blank">PPT</a></td>
                    @else
                        <td>Empty</td>
                    @endif
                    @if ($class->video != null)
                    <td><a href="{{$class->video}}"  target="_blank">Video</a></td>
                    @else
                    <td>Empty</td>
                    @endif
                    
                    <td><a href="{{$class->meet_link}}" target="_blank">Meet</a></td>
                    <td>
                        @if ($class->work==1)
                        <form action="{{route('cursos.homework')}}" method="POST">
                            @csrf
                            <input type="hidden" name='user' value="{{Auth::user()->lastname}}.{{Auth::user()->name}}">
                            <input type="hidden" name="course_id" value="{{$course->name}}">
                            <input type="text" name="homework">
                            <button type="submit">{{__('Send')}}</button>
                        </form>
                        @endif
                        @if (session('message'))
                             <script>
                                Swal.fire({
                                    title: "{{__('Homework send successfully')}}",
                                    text: "{{__('Thank you for your message')}}",
                                    icon: "success",
                                    confirmButtonText: "{{__('Ok')}}",
                                });

                            </script>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection