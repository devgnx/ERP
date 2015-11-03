<?php

namespace App\Models;

use Eloquent;
use App\Models\Product;

class Supplier extends Eloquent
{
    protected $table = 'module_supplier';
    protected $appends = ['address'];

    public function products()
    {
        return $this->belongsToMany(
            Product::class,
            App::make(Product::class)->getTable(),
            'supplier_id'
        );
    }

    public function getAddressAttribute()
    {
        $address = $this->street;
        $address.= ' ' . $this->street_number;
        $address.= ' ' . $this->state_province;
        $address.= ' ' . $this->country;
        $address.= ' ' . $this->postcode;

        return $address;
    }
}
