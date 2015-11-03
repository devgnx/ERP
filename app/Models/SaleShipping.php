<?php
namespace App\Models;

use Eloquent;
use App\Models\Sale;
use App\Models\CustomerAddress;

class SaleShipping extends Eloquent
{
    protected $table    = 'module_sale_shipping';
    protected $fillable = ['street', 'street_number', 'state_province', 'country', 'postcode', 'date', 'price'];
    public $timestamps  = false;

    public function sale()
    {
        return $this->hasOne(Sale::class, 'id', 'shipping_id');
    }

    public function getFullAddressAttribute()
    {
        $address = $this->street;
        $address.= ' ' . $this->street_number;
        $address.= ' ' . $this->state_province;
        $address.= ' ' . $this->country;
        $address.= ' ' . $this->postcode;

        return $address;
    }
}