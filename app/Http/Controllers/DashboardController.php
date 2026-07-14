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

        
        $courses = $user->courses()
            ->with(['classes' => function ($query) {
                $query->where('date', '<=', now()->toDateString())
                      ->select('id', 'course_id'); 
            }])
            ->get()
            ->map(function ($course) use ($user) {
                $totalClasses = $course->classes->count();

                if ($totalClasses === 0) {
                    $course->attendance_percentage = 0;
                    return $course;
                }

        
                $presentCount = Attendance::where('user_id', $user->id)
                    ->whereIn('class_id', $course->classes->pluck('id'))
                    ->where('present', true)
                    ->count();

                $course->attendance_percentage = round(($presentCount / $totalClasses) * 100, 1);

                return $course;
            });

        
        $activeCoursesCount = $courses->count();

        $softwareOwnedCount = $user->software()
            ->wherePivotIn('status', ['active', 'pending_delivery'])
            ->count();

        return view('pages.dashboard.home', compact(
            'courses',
            'activeCoursesCount',
            'softwareOwnedCount'
        ));
    }
}