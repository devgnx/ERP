<?php

namespace App\Models;

use Eloquent;

class Seller extends Eloquent
{
    protected $table = 'module_seller';

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function order()
    {
        return $this->hasMany('App\Models\SaleOrder');
    }

    public function orderItem()
    {
        return $this->hasManyThrough('App\Models\SaleOrderItem', 'App\Models\SaleOrder');
    }
}
