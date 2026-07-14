<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Attendance;
use App\Mail\HomeworkMailable;
use Illuminate\Support\Facades\Mail;

class ClassesController extends Controller
{
    public function create()
    {
        $courses = Course::orderBy('name', 'asc')->get();
        return view('pages.courses.classesCreate', compact('courses'));
    }

    public function store(Request $request)
    {
        $validated = $this->validateClass($request);

        $classes = new Classes();
        $classes->title = $validated['title'];
        $classes->date = $validated['date'] ?? null;
        $classes->start_time = $validated['start_time'] ?? null;
        $classes->pdf = $validated['pdf'] ?? null;
        $classes->powerpoint = $validated['powerpoint'] ?? null;
        $classes->video = $validated['video'] ?? null;
        $classes->meet_link = $validated['meet_link'] ?? null;
        $classes->work = $request->has('work') ? 1 : 0;
        $classes->course_id = $validated['course_id'];

        $classes->save();

        $course = Course::with('students')->find($classes->course_id);

        foreach ($course->students as $student) {
            Attendance::create([
                'class_id' => $classes->id,
                'user_id' => $student->id,
                'present' => false,
            ]);
        }

        return redirect()
            ->route('cursos.classes', $classes->course_id)
            ->with('success', __('Class created successfully'));
    }

    public function edit($id)
    {
        $classes = Classes::with('course')->findOrFail($id);

        return view('pages.courses.classesEdit', compact('classes'));
    }

    public function update(Request $request, $id)
    {
        $classes = Classes::findOrFail($id);
        $validated = $this->validateClass($request);

        $classes->update([
            'title' => $validated['title'],
            'date' => $validated['date'] ?? null,
            'start_time' => $validated['start_time'] ?? null,
            'pdf' => $validated['pdf'] ?? null,
            'powerpoint' => $validated['powerpoint'] ?? null,
            'video' => $validated['video'] ?? null,
            'meet_link' => $validated['meet_link'] ?? null,
            'work' => $request->has('work') ? 1 : 0,
        ]);

        return redirect()
            ->route('cursos.classes', $classes->course_id)
            ->with('success', __('Class updated successfully'));
    }

    public function destroy($id)
    {
        $classes = Classes::findOrFail($id);
        $courseId = $classes->course_id;

        $classes->delete();

        return redirect()
            ->route('cursos.classes', $courseId)
            ->with('success', __('Class deleted successfully'));
    }

    public function homework(Request $request)
    {
        Mail::to('claudioparedesarbelo@gmail.com')
            ->send(new HomeworkMailable($request->all()));

        return redirect()->back()->with('message', 'Su tarea ha sido enviada');
    }

    private function validateClass(Request $request): array
    {
        return $request->validate([
            'course_id' => 'required|exists:courses,id',
            'title' => 'required|string|max:255',
            'date' => 'nullable|date',
            'start_time' => 'nullable',
            'pdf' => 'nullable|url|max:255',
            'powerpoint' => 'nullable|url|max:255',
            'video' => 'nullable|url|max:255',
            'meet_link' => 'nullable|url|max:255',
        ], [
            'course_id.required' => 'Seleccioná un curso.',
            'course_id.exists' => 'El curso seleccionado no es válido.',
            'title.required' => 'El título es obligatorio.',
            'date.date' => 'La fecha debe ser válida.',
            'pdf.url' => 'El link del PDF debe ser una URL válida.',
            'powerpoint.url' => 'El link del Powerpoint debe ser una URL válida.',
            'video.url' => 'El link del video debe ser una URL válida.',
            'meet_link.url' => 'El link de Meet debe ser una URL válida.',
        ]);
    }
}
