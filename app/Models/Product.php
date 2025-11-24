<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

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

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy("order");
    }

    public function primaryImage(): HasOne
    {
        return $this->hasOne(ProductImage::class)->orderBy("order");
    }

    function attributes(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute_values')->withPivot('attribute_value_id');
    }

    function attributeValues(): BelongsToMany
    {
        return $this->belongsToMany(AttributeValue::class, 'product_attribute_values')->withPivot('attribute_id');
    }

    function attributeWithValues(): BelongsToMany
    {
        return $this->belongsToMany(Attribute::class, 'product_attribute_values')
            ->distinct()
            ->orderBy('id', 'asc')
            ->with(['values' => function ($query) {
                $query->whereIn('id', function ($subquery) {
                    $subquery->select('attribute_value_id')
                        ->from('product_attribute_values')
                        ->where('product_id', $this->id)
                        ->orderBy('id', 'asc');
                });
            }]);
    }

    public function variants(): HasMany
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function primaryVariant(): HasOne
    {
        return $this->hasOne(ProductVariant::class)->where("is_default", 1);
    }
}
