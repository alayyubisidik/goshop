<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroBanner extends Model
{
    protected $fillable = [
        'banner_one',
        'title_one',
        'btn_url_one',
        'banner_two',
        'title_two',
        'btn_url_two',
    ];
}
