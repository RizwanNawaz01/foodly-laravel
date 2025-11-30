<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'siteName',
        'logo',
        'favicon',
        'title',
        'description',
        'metaTitle',
        'metaDescription',
        'address',
        'contact',
        'currency',
        'order_outside_time',
        'minOrder',
        'services',
        'openingHours',
        'pickupHours',
        'deliveryHours',
    ];

    protected $casts = [
        'services' => 'array',
        'openingHours' => 'array',
        'pickupHours' => 'array',
        'deliveryHours' => 'array',
    ];
}
