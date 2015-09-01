<?php

namespace App\Models;

use Eloquent;

class SaleOrder extends Eloquent
{
    protected $table = 'ModuleSaleOrder';

    public function seller()
    {
        $this->belongsTo('App\Models\Seller');
    }

    public function items()
    {
        $this->hasMany('App\Models\SaleOrderItems');
    }
}
