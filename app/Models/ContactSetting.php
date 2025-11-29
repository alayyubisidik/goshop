<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSetting extends Model
{
    protected $fillable = [
        'map_url',

        'box_title_one',
        'description_one',

        'box_title_two',
        'description_two',

        'box_title_three',
        'description_three',
    ];
}
