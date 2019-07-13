<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'industry_id', 'name', 'price', 'stock',
    ];

    protected $hidden = [
        'industry_id', 'deleted_at', 'created_at', 'updated_at',
    ];

    public function getPriceAttribute($value)
    {
        return number_format($value / 100, 2, '.', '');
    }

    public function setPriceAttribute($value)
    {
        $this->attributes['price'] = preg_replace('/[^0-9]/i', '', $value);
    }

    public function setStockAttribute($value)
    {
        $this->attributes['stock'] = preg_replace('/[^0-9]/i', '', $value);
    }

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
}
