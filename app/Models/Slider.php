<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'title',
        'sub_title',
        'small_title',
        'small_sub_title',
        'image',
        'link_name',
        'link',
        'order',
        'is_active',
        'gradient',
    ];
}
