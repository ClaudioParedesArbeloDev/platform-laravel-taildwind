<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SoftwareOrderItem extends Model
{
    protected $fillable = [
        'software_order_id',
        'software_id',
        'software_addon_id',
        'name',
        'price',
        'quantity',
    ];

    protected $casts = [
        'price' => 'decimal:2',
    ];

    public function order()
    {
        return $this->belongsTo(SoftwareOrder::class, 'software_order_id');
    }

    public function software()
    {
        return $this->belongsTo(Software::class);
    }

    public function addon()
    {
        return $this->belongsTo(SoftwareAddon::class, 'software_addon_id');
    }
}