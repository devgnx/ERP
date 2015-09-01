<?php

namespace App\Models;

use Eloquent;

class Seller extends Eloquent
{
    protected $table = 'Seller';

    public function order()
    {
        $this->hasMany('App\Models\SaleOrder');
    }

    public function orderItem()
    {
        $this->hasManyThrough('App\Models\SaleOrderItem', 'App\Models\SaleOrder');
    }
}
