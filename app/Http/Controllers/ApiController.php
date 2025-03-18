<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Blog;

class ApiController extends Controller
{
    public function index()
    {
        $users = User::orderBy('lastname', 'asc')
                ->paginate();

        return response()->json($users);
    }

    public function indexBlogs()
    {
        $blogs = Blog::orderBy('created_at', 'desc')
                ->paginate();

        return response()->json($blogs);
    }
}
