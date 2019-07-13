<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Industry extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
    ];

    protected $hidden = [
        'deleted_at', 'created_at', 'updated_at',
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
