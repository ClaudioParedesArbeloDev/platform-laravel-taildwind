<?php

namespace App\Http\Controllers;

use App\Models\Blog;

use Illuminate\Http\Request;

use Illuminate\Support\Str;

class BlogController extends Controller
{   
    
    public function index()
    {
        $blogs= Blog::orderBy('created_at', 'desc')
            ->paginate(10);
        return view ('pages.blogs', compact('blogs'));
    }

    
    public function create()
    {
        return view ('pages.blog.create');
    }

    
    public function store(Request $request)

    {
        $blog = new Blog();

        $blog->title=$request->title;
        $blog->category=$request->category;
        $blog->author=$request->author;
        $blog->anticipated=$request->anticipated;
        $blog->body=$request->body;
        $blog->image=$request->image;
        $blog->slug = Str::slug($request->title);



        $blog->save();

        return redirect('/blogs');
    }

    
    public function show(Blog $blog)
    {
        return view ('pages.blog.blog', compact('blog'));
        
    }

    
    public function edit(Blog $blog)

    {

        return view('blog.editblog', compact('blog'));
    }

   
    public function update(Request $request, Blog $blog)
    {

        $blog->title=$request->title;
        $blog->category=$request->category;
        $blog->author=$request->author;
        $blog->body=$request->body;

        $blog->save();

        return redirect('/blogs/$id');
    }


    
    public function destroy(Blog $blog)
    {

        $blog->delete();

        return redirect('/blogs');
    }
}
