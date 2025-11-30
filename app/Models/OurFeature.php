<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OurFeature extends Model
{
    protected $fillable = [
        'icon',
        'title',
        'subtitle',
        'is_active'
    ];
}
