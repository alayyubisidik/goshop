<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{

    protected $fillable = [
        'user_id',
        'store_id',
        'transaction_id',
        'customer_email',
        'customer_phone',
        'customer_first_name',
        'customer_last_name',
        'billing_info',
        'shipping_info',
        'has_coupon',
        'coupon',
        'discount',
        'shipping_charge',
        'total',
        'payment_method',
        'currency',
        'currency_icon',
        'currency_rate',
        'order_status',
        'payment_status',
    ];


    protected $casts = [
        "billing_info" => "array",
        "shipping_info" => "array",
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }

    public function orderProducts(): HasMany
    {
        return $this->hasMany(OrderProduct::class);
    }

    public function orderHistory(): HasMany
    {
        return $this->hasMany(OrderStatusHistory::class);
    }

}
