<?php
namespace App\Models;

use Eloquent;

class Stock extends Eloquent
{
    protected $table = 'module_stock';

    function product()
    {
        $this->belongsTo('App\Products', 'product_code', 'code');
    }
}