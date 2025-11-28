<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StoreWithdrawRequest extends Model
{

    protected $fillable = [
        'store_id',
        'amount',
        'status',
        'payment_method',
        'payment_details',
    ];


    function store(): BelongsTo
    {
        return $this->belongsTo(Store::class, 'store_id');
    }
}
