<?php

namespace App\Models;
use App\Models\Course;

use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
