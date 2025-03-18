<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Classes;
use App\Mail\HomeworkMailable;
use Illuminate\Support\Facades\Mail;

class ClassesController extends Controller
{
    public function index()
{
    $classes = Classes::with('course')
        ->join('courses', 'classes.course_id', '=', 'courses.id')
        ->orderBy('courses.name', 'asc')
        ->select('classes.*')
        ->get();

    
    $course = $classes->isNotEmpty() ? $classes->first()->course : null;

    return view('dashboard.courses.classes', compact('classes', 'course'));
}

    public function create()
    {
        $courses = Course::all();
        return view('dashboard.courses.classesCreate', compact('courses'));
    }

    public function store(Request $request)
    {
        $classes = new Classes();

        $classes->title = $request->title;
        $classes->date = $request->date;
        $classes->start_time = $request->start_time;
        $classes->pdf = $request->pdf;
        $classes->powerpoint = $request->powerpoint;
        $classes->video = $request->video;
        $classes->meet_link = $request->meet_link;
        $classes->work = $request->has('work')? 1 : 0;
        $classes->course_id = $request->input('course_id');

        $classes->save();

        return redirect()->route('classes.index')->with('success', 'Class created successfully!');
    }

    public function show($id)
    {
        $classes = Classes::findOrFail($id);

        return view('dashboard.courses.class', compact('classes'));
    }

    public function edit($id)
    {
        $classes = Classes::findOrFail($id);

        return view('dashboard.courses.editClass', compact('classes'));
    }

    public function update(Request $request, $id)
    {
        $classes = Classes::findOrFail($id);

        $classes->title = $request->title;
        $classes->date = $request->date;
        $classes->start_time = $request->start_time;
        $classes->pdf = $request->pdf;
        $classes->powerpoint = $request->powerpoint;
        $classes->video = $request->video;
        $classes->meet_link = $request->meet_link;

        $classes->save();

        return redirect()->route('cursos.classes', $id);
    }

    public function destroy($id)
    {
        $classes = Classes::findOrFail($id);
        $classes->delete();

        return redirect()->route('dashboard.classes.index');
    }

    public function homework(Request $request)
    {
        Mail::to('claudioparedesarbelo@gmail.com')
            ->send(new HomeworkMailable($request->all()));

        session()->flash('message', 'Su tarea ha sido enviada');

        return back();
    }

   
}
