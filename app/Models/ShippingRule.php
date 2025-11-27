<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShippingRule extends Model
{
    protected $fillable = [
        'name',
        'type',
        'minimum_amount',
        'charge',
        'is_active',
    ];
}
