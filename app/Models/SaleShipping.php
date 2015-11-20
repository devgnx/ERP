<?php
namespace App\Models;

use Eloquent;
use App\Models\Sale;
use App\Models\CustomerAddress;

class SaleShipping extends Eloquent
{
    protected $table    = 'module_sale_shipping';
    protected $fillable = ['street', 'street_number', 'city', 'state_province', 'country', 'postcode', 'date', 'price'];
    public $timestamps  = false;

    public function sale()
    {
        return $this->hasOne(Sale::class, 'id', 'shipping_id');
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
