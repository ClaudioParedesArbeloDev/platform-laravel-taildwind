<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Course;
use App\Models\Attendance;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Cursos del usuario autenticado + clases pasadas
        $courses = $user->courses()
            ->with(['classes' => function ($query) {
                $query->where('date', '<=', now()->toDateString())
                      ->select('id', 'course_id'); // solo lo necesario
            }])
            ->get()
            ->map(function ($course) use ($user) {
                $totalClasses = $course->classes->count();

                if ($totalClasses === 0) {
                    $course->attendance_percentage = 0;
                    $course->attendance_color = 'gray';
                    return $course;
                }

                // Conteo de presentes (más eficiente que cargar todo)
                $presentCount = Attendance::where('user_id', $user->id)
                    ->whereIn('class_id', $course->classes->pluck('id'))
                    ->where('present', true)
                    ->count();

                $percentage = round(($presentCount / $totalClasses) * 100, 1);

                $course->attendance_percentage = $percentage;

                // Color para la vista
                $course->attendance_color = match (true) {
                    $percentage >= 80 => 'green',
                    $percentage >= 60 => 'yellow',
                    default           => 'red',
                };

                return $course;
            });

        return view('pages.dashboard.home', compact('courses'));
    }
}