<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Classes;

class Course extends Model
{
    protected $casts = [
        'active' => 'boolean',
    ];

    public function classes()
    {
        return $this->hasMany(Classes::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'course_user')
            ->withPivot('enroll_day', 'status')->withTimestamps();;
    }

    public function messages()
    {
        return $this->hasMany(Message::class, 'message_course')
            ->withTimestamps();   
    }
}
