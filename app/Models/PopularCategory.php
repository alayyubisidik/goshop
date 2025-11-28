<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PopularCategory extends Model
{
    protected $fillable = [
        'categories'
    ];
    protected $casts = [
        "categories" => "array"
    ];
}
