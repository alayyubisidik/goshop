<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slider extends Model
{
    protected $fillable = [
        'image',
        'title',
        'sub_title',
        'btn_url',
        'is_active',
    ];
}
