<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Store extends Model
{

    protected $fillable = [
        'seller_id',
        'logo',
        'banner',
        'name',
        'phone',
        'email',
        'short_description',
        'long_description',
    ];
}
