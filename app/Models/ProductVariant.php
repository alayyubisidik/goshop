<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductVariant extends Model
{
    protected $fillable = [
        'product_id',
        'name',
        'price',
        'special_price',
        'sku',
        'manage_stock',
        'qty',
        'in_stock',
        'is_default',
        'is_active',
        'position',
    ];

    function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_variant_attribute_value')->withPivot('attribute_value_id');
    }

    function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'product_variant_attribute_value')->withPivot('attribute_id');
    }
}
