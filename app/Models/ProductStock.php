<?php

namespace App\Models;

use Eloquent;

class ProductStock extends Eloquent
{
    protected $table = 'module_product_stock';
    protected $fillable = ['quantity', 'sky'];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo('App\Models\Product');
    }
}