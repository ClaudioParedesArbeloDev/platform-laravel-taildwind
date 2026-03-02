<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Classes;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    // Lista de cursos para elegir asistencia
    public function index()
    {
        $courses = Course::orderBy('category', 'asc')
            ->withCount('students') // muestra cuántos alumnos tiene cada curso (opcional)
            ->paginate(10);

        return view('pages.dashboard.admin.asistencia', compact('courses'));
    }

    // Vista de asistencia para UN curso (alumnos × últimas 10 clases)
    public function edit(Course $course)
    {
        // Alumnos con paginación
        $students = $course->students()
            ->orderBy('lastname', 'asc')
            ->orderBy('name', 'asc')
            ->paginate(10);  // ajusta el número si querés más/menos por página

        // Últimas 10 clases (más reciente primero)
        $classes = $course->classes()
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->take(10)
            ->get();

        // Asistencias existentes (clave compuesta user_id-class_id)
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

    // Guardar asistencia (múltiples alumnos y clases)
    public function update(Request $request, Course $course)
    {
        $request->validate([
            'attendance' => 'array',
            'attendance.*.*' => 'in:0,1', // solo permite 0 o 1
        ]);

        // Procesamos cada alumno y cada clase enviada desde el formulario
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