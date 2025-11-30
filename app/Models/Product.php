<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $casts = [
        'subMenu' => 'array',
    ];

    protected $fillable = [
        'name',
        'description',
        'price_delivery',
        'price_pickup',
        'qty',
        'category_id',
        'isHighlighted',
        'image',
        'subMenu',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
