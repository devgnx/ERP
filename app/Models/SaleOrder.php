<?php

namespace App\Models;

use Eloquent;

class SaleOrder extends Eloquent
{
    protected $table = 'module_sale_order';

    public function seller()
    {
        $this->belongsTo('App\Models\Seller');
    }

    public function items()
    {
        $this->hasMany('App\Models\SaleOrderItems');
    }

    public function getTable()
    {
        return $this->table;
    }
}
