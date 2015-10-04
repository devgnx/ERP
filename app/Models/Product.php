<?php

namespace App\Models;

use Eloquent;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Eloquent
{
    use SoftDeletes;
    protected $table = 'module_product';
    protected $fillable = ['code', 'name', 'price'];
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    public function stock()
    {
        return $this->hasOne('App\Models\ProductStock');
    }

    public function categories()
    {
        return $this->belongsToMany(
            'App\Models\ProductCategory',
            'module_product_in_category',
            'product_id',
            'category_id'
        );
    }

    public function suppliers()
    {
        return $this->belongsToMany(
            'App\Models\Supplier',
            'module_product_in_supplier',
            'product_id'
        );
    }

    public function hasCategory( $category_id )
    {
        foreach($this->categories() as $value) {
            if ($value['id'] == $category_id) return true;
        }

        return false;
    }
}