<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $table = 'module_supplier';
    protected $appends = ['address'];

    public function products()
    {
        return $this->belongsToMany(
            'App\Models\Product',
            'module_product_in_supplier',
            'supplier_id'
        );
    }

    public function getAddressAttribute()
    {
        $address = $this->street;
        $address.= ' ' . $this->street_number;
        $address.= ' ' . $this->state_province;
        $address.= ' ' . $this->country;
        $address.= ' ' . $this->zip_code;

        return $address;
    }
}
