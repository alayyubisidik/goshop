<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WithdrawMethod extends Model
{
    protected $fillable = [
        'name',
        'instruction',
        'minimum_amount',
        'maximum_amount',
        'is_active'
    ];
}
