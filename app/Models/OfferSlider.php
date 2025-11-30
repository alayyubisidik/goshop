<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfferSlider extends Model
{
    protected $fillable = [
        'title',
        'url',
        'is_active'
    ];
}
