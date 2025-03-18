<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    public function user()
    {
        return $this->belongsToMany(User::class, 'message_user')
            ->withTimestamps();
    }

    public function course()
    {
        return $this->belongsToMany(Course::class, 'message_course')
            ->withTimestamps();
    }
}
