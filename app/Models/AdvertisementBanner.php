<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdvertisementBanner extends Model
{
    protected $fillable = [
        'banner_id',
        'image',
        'url'
    ];
}
