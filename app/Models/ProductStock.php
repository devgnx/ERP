<?php

namespace App\Models;

use Eloquent;
use App\Models\Product;

class ProductStock extends Eloquent
{
    protected $table = 'module_product_stock';
    protected $fillable = ['quantity', 'sky'];
    public $timestamps = false;

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}