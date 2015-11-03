<?php

namespace App\Models;

use App;
use Eloquent;
use App\Models\Product;

class ProductCategory extends Eloquent
{
    protected $table    = 'module_product_category';
    protected $fillable = ['name', 'parent_id'];
    public $timestamps  = false;

    public function products()
    {
        return $this->belongsToMany(Product::class, App::make(Product::class)->getPivotCategoryTable(), 'category_id');
    }
}