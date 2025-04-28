<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    protected $fillable = [
        'title',
        'date',
        'start_time',
        'pdf',
        'powerpoint',
        'video',
        'meet_link',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}