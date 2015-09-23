<?php

namespace App\Models;

use Eloquent;

class SaleOrderItem extends Eloquent
{
    protected $table = 'module_sale_order_item';

    public function order()
    {
        return $this->belongsTo('App\Models\SaleOrder');
    }

    public function seller()
    {
        return $this->->order()->belongsTo('App\Models\Seller')
    }
}
