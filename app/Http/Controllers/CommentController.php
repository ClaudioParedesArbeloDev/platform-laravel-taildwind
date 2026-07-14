<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request, Blog $blog)
    {
        $request->validate([
            'content' => 'required|string|max:2000',
        ]);

        $blog->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        return redirect(route('blogs.show', $blog) . '#comments')
            ->with('success', __('Comment posted successfully'));
    }

    public function destroy(Comment $comment)
    {
        $user = Auth::user();

        if ($comment->user_id !== $user->id && !$user->hasRole('admin')) {
            abort(403);
        }

        $blog = $comment->blog;
        $comment->delete();

        return redirect(route('blogs.show', $blog) . '#comments')
            ->with('success', __('Comment deleted successfully'));
    }
}
