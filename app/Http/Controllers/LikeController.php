<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function toggleBlog(Blog $blog)
    {
        return $this->toggle($blog);
    }

    public function toggleComment(Comment $comment)
    {
        return $this->toggle($comment);
    }

   
    private function toggle(Model $likeable)
    {
        $userId = Auth::id();

        $existing = $likeable->likes()->where('user_id', $userId)->first();

        if ($existing) {
            $existing->delete();
            $liked = false;
        } else {
            $likeable->likes()->create(['user_id' => $userId]);
            $liked = true;
        }

        return response()->json([
            'liked' => $liked,
            'count' => $likeable->likes()->count(),
        ]);
    }
}
