<?php
namespace App\Models;

use Eloquent;
use App\Models\Customer;
use App\Models\SaleShipping;

class CustomerAddress extends Eloquent
{
    protected $table = 'module_customer_address';

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function salesShippings()
    {
        return $this->hasMany(SaleShipping::class);
    }

    public function scopeMain($query)
    {
        return $query->where('main', '=', 1);
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
