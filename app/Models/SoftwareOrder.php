<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoftwareOrder extends Model
{
    protected $fillable = [
        'user_id',
        'total',
        'status',
        'preference_id',
        'payment_id',
        'payment_method',
        'payment_type',
        'metadata',
    ];

    protected $casts = [
        'metadata' => 'array',
        'total' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(SoftwareOrderItem::class);
    }

    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }
}