<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $courses = Course::orderBy('category', 'asc')
            ->withCount('students')
            ->paginate(10);

        return view('pages.dashboard.admin.asistencia', compact('courses'));
    }


    public function edit(Course $course)
    {

        $students = $course->students()
            ->orderBy('lastname', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10); 

        
        $classes = $course->classes()
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->take(10)
            ->get();

        
        $attendances = Attendance::whereIn('class_id', $classes->pluck('id'))
            ->whereIn('user_id', $students->pluck('id'))
            ->get()
            ->keyBy(fn($attendance) => $attendance->user_id . '-' . $attendance->class_id);

        return view('pages.dashboard.admin.asistenciaCurso', compact(
            'course',
            'students',
            'classes',
            'attendances'
        ));
    }

    
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'attendance' => 'array',
            'attendance.*.*' => 'in:0,1',
        ]);

        
        foreach ($request->input('attendance', []) as $userId => $classesData) {
            foreach ($classesData as $classId => $present) {
                Attendance::updateOrCreate(
                    [
                        'user_id'  => $userId,
                        'class_id' => $classId,
                    ],
                    [
                        'present'  => (bool) $present,
                    ]
                );
            }
        }

        return redirect()->back()
            ->with('success', 'Asistencia guardada correctamente');
    }
}