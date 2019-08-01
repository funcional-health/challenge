<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'industry',
        'price',
        'quantity',
    ];
    public $timestamps = false;
}
