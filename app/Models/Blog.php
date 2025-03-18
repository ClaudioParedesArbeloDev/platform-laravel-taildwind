<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

use App\Models\Comment;


class Blog extends Model
{
    use HasFactory;

        public function getRouteKeyName()
        {
            return 'slug';
        }

        public function comments()
        {
            return $this->hasMany(Comment::class);
        }   

        public function likes()
        {
            return $this->morphMany(Like::class, 'likeable');
        }
    
        public function isLikedBy(User $user)
        {
            return $this->likes()->where('user_id', $user->id)->exists();
        }

}
