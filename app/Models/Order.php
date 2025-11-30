<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'orderCode',
        'customerInfo',
        'items',
        'totalPrice',
        'status',
        'deliveryType',
        'eta',
    ];

    protected $casts = [
        'customerInfo' => 'array',
        'items' => 'array',
    ];

    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
