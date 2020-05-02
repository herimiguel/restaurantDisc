<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    protected $fillable = [
        'restaurantName',
        'address',
        'phone',
        'deal',
        'image',
    
    ];

}
