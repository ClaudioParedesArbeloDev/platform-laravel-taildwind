<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoftwareAddon extends Model
{
    protected $casts = [
        'active' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function software()
    {
        return $this->belongsTo(Software::class);
    }
}