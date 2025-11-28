<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class StoreWithdrawMethod extends Model
{
    protected $fillable = [
        'withdraw_method_id',
        'store_id',
        'description'
    ];

    public function withdrawMethod(): BelongsTo
    {
        return $this->belongsTo(WithdrawMethod::class);
    }
}
