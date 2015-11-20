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

    public function getFullAddressAttribute($but_not = ['country'])
    {
        if ($but_not === null) $but_not = ['country'];

        $address = '';
        $attributes = ['street', 'street_number', 'city', 'state_province', 'country', 'postcode'];
        $attributes = array_values( array_diff($attributes, $but_not) );

        foreach ($attributes as $key => $attribute) {
            if ($key == 0) $address = $this->{$attribute};
            else $address.= ' ' . $this->{$attribute};
        }

        return $address;
    }
}
