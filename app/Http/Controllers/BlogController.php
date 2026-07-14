<?php

namespace App\Http\Controllers;

use App\Models\Blog;

use Illuminate\Http\Request;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{

    public function index(Request $request)
    {
        $category = $request->query('category');

        $blogs = Blog::when($category, function ($query) use ($category) {
                $query->where('category', $category);
            })
            ->orderBy('created_at', 'desc')
            ->paginate(9)
            ->withQueryString();

        $categories = Blog::select('category')
            ->distinct()
            ->whereNotNull('category')
            ->orderBy('category')
            ->pluck('category');

        return view('pages.blogs', compact('blogs', 'categories', 'category'));
    }


    public function create()
    {
        return view('pages.blog.create');
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'author' => 'required|string|max:255',
            'anticipated' => 'required|string',
            'body' => 'required|string',
            'image' => 'required|url',
        ]);

        $blog = new Blog();

        $blog->title = $validated['title'];
        $blog->category = $validated['category'];
        $blog->author = $validated['author'];
        $blog->anticipated = $validated['anticipated'];
        $blog->body = $validated['body'];
        $blog->image = $validated['image'];
        $blog->slug = $this->uniqueSlug($validated['title']);

        $blog->save();

        return redirect()->route('blogs.show', $blog)->with('success', __('Blog created successfully'));
    }


    public function show(Blog $blog)
    {
        $blog->load([
            'comments' => fn ($query) => $query->latest()->with(['user.avatar', 'likes']),
        ]);

        $blogLikesCount = $blog->likes()->count();
        $blogLiked = Auth::check() ? $blog->isLikedBy(Auth::user()) : false;

        return view('pages.blog.blog', compact('blog', 'blogLikesCount', 'blogLiked'));
    }


    public function edit(Blog $blog)
    {
        return view('pages.blog.edit', compact('blog'));
    }


    public function update(Request $request, Blog $blog)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|string|max:100',
            'author' => 'required|string|max:255',
            'anticipated' => 'required|string',
            'body' => 'required|string',
            'image' => 'required|url',
        ]);

        $blog->title = $validated['title'];
        $blog->category = $validated['category'];
        $blog->author = $validated['author'];
        $blog->anticipated = $validated['anticipated'];
        $blog->body = $validated['body'];
        $blog->image = $validated['image'];

        $blog->save();

        return redirect()->route('blogs.show', $blog)->with('success', __('Blog updated successfully'));
    }


    public function destroy(Blog $blog)
    {
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', __('Blog deleted successfully'));
    }

    
    private function uniqueSlug(string $title): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (Blog::where('slug', $slug)->exists()) {
            $slug = $base . '-' . (++$i);
        }

        return $slug;
    }
}