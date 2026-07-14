<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserSoftware extends Model
{
    protected $table = 'user_software';

    protected $fillable = [
        'user_id',
        'software_id',
        'software_order_id',
        'status',
        'license_type',
        'purchased_at',
        'expires_at',
        'download_token',
    ];

    protected $casts = [
        'purchased_at' => 'datetime',
        'expires_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function software()
    {
        return $this->belongsTo(Software::class);
    }

    public function order()
    {
        return $this->belongsTo(SoftwareOrder::class, 'software_order_id');
    }

    public function isActive(): bool
    {
        if ($this->status !== 'active') {
            return false;
        }

        return !$this->expires_at || $this->expires_at->isFuture();
    }
}