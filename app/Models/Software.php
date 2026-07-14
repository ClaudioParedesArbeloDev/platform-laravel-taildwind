<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\SoftwareAddon;
use App\Models\SoftwareOrderItem;

class Software extends Model
{
    protected $table = 'softwares';

    protected $casts = [
        'active' => 'boolean',
        'featured' => 'boolean',
        'requires_quote' => 'boolean',
        'price' => 'decimal:2',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addons()
    {
        return $this->hasMany(SoftwareAddon::class);
    }

    public function activeAddons()
    {
        return $this->hasMany(SoftwareAddon::class)->where('active', true);
    }

    public function orderItems()
    {
        return $this->hasMany(SoftwareOrderItem::class);
    }

    
    public function buyers()
    {
        return $this->belongsToMany(User::class, 'user_software')
            ->withPivot('software_order_id', 'status', 'license_type', 'purchased_at', 'expires_at', 'download_token')
            ->withTimestamps();
    }

    public function isGeneric(): bool
    {
        return $this->type === 'generico';
    }

    public function isCustom(): bool
    {
        return $this->type === 'medida';
    }

    
    public function isPurchasableOnline(): bool
    {
        return !$this->requires_quote && !empty($this->price) && empty($this->purchase_url);
    }
}