<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;

class Avatar extends Model
{
    use HasFactory;

    protected $table = 'avatars';
    protected $fillable = [
        'user_id',
        'avatar',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
