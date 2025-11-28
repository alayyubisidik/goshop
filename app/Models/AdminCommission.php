<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminCommission extends Model
{
    protected $fillable = [
        'order_id',
        "commission_amount"
    ];
}
