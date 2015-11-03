<?php
namespace App\Models;

use Eloquent;
use App\Models\Sale;
use App\Models\CustomerAddress;

class Customer extends Eloquent
{
    protected $table = 'module_customer';

    public function address()
    {
        return $this->hasMany(CustomerAddress::class, 'customer_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }

    public function getFullAddressAttribute()
    {
        $address = $this->address->street;
        $address.= ' ' . $this->address->street_number;
        $address.= ' ' . $this->address->state_province;
        $address.= ' ' . $this->address->country;
        $address.= ' ' . $this->address->postcode;

        return $address;
    }
}