<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FlashSale extends Model
{
    protected $fillable = [
        'sale_start',
        'sale_end',
        'products',
        'is_active',
    ];

    protected $casts = [
        'products' => 'array',
    ];
}
