<?php

namespace App\Models;

use Eloquent;

class Product extends Eloquent
{
    protected $table = 'module_product';

    protected $fillable = ['code', 'name', 'price'];

    public function stock()
    {
        return $this->hasOne('App\Models\ProductStock');
    }

    public function categories()
    {
        return $this->belongsToMany(
            'App\Models\ProductCategory',
            'module_product_in_category',
            'product_id'
        );
    }
}