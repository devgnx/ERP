<?php

namespace App\Models;

use Eloquent;

class ProductCategory extends Eloquent
{
    protected $table = 'module_product_category';

    protected $fillable = ['name', 'parent_id'];

    public function products()
    {
        return $this->belongsToMany(
            'App\Models\Product',
            'module_product_in_category',
            'category_id'
        );
    }
}