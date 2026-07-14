<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyPathController extends Controller
{
    public function index()
    {
        $courses = Auth::user()->courses;

        
        $completedCourses = $courses->filter(fn ($course) => $course->pivot->status === 'completed');
        $inProgressCourses = $courses->filter(fn ($course) => $course->pivot->status !== 'completed');

        return view('pages.dashboard.mypath', compact('inProgressCourses', 'completedCourses'));
    }
}
