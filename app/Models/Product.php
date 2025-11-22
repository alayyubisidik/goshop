<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    protected $fillable = [
        'store_id',
        'brand_id',
        'product_type',
        'name',
        'slug',
        'price',
        'description',
        'short_description',
        'special_price',
        'special_price_start',
        'special_price_end',
        'sku',
        'manage_stock',
        'qty',
        'in_stock',
        'viewed',
        'status',
        'approved_status',
        'is_featured',
        'is_hot',
        'is_new',
    ];

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class);
    }

    public function store(): BelongsTo
    {
        return $this->belongsTo(Store::class);
    }
}
