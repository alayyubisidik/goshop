<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreWallet extends Model
{
    protected $fillable = [
        'store_id',
        'balance'
    ];
}
