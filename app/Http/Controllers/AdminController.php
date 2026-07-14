<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Course;
use App\Models\Software;
use App\Models\SoftwareOrder;
use App\Models\Blog;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'users' => User::count(),
            'courses' => Course::count(),
            'software' => Software::count(),
            'blogs' => Blog::count(),
            'pendingOrders' => SoftwareOrder::pending()->count(),
        ];

        return view('pages.dashboard.admin', compact('stats'));
    }
}
