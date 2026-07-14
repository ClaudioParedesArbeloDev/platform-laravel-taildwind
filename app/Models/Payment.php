<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Payment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'course_id',
        'payment_id',
        'preference_id',
        'amount',
        'status',
        'payment_method',
        'payment_type',
        'enroll_day',
        'metadata'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'metadata' => 'array',
        'amount' => 'decimal:2',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    
    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

   
    public function scopeApproved($query)
    {
        return $query->where('status', 'approved');
    }

    
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

   
    public function scopeRejected($query)
    {
        return $query->where('status', 'rejected');
    }

   
    public function isApproved(): bool
    {
        return $this->status === 'approved';
    }

   
    public function isPending(): bool
    {
        return $this->status === 'pending';
    }

    
    public function isRejected(): bool
    {
        return $this->status === 'rejected';
    }
}