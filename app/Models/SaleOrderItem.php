<?php

namespace App\Models;

use Eloquent;

class SaleOrderItem extends Eloquent
{
    protected $table = 'ModuleSaleOrderItem';

    public function order()
    {
        return $this->belongsTo('App\Models\SaleOrder');
    }
}
