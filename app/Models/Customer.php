<?php
namespace App\Models;

use Eloquent;
use App\Models\Sale;
use App\Models\CustomerType;
use App\Models\CustomerTypeGroup;
use App\Models\CustomerAddress;

class Customer extends Eloquent
{
    protected $table = 'module_customer';

    public function type()
    {
        return $this->belongsTo(CustomerType::class, 'type_id');
    }

    public function group()
    {
        $type = $this->type()->getResults();
        return $type->belongsTo(CustomerTypeGroup::class, 'group_id');
    }

    public function mainAddress()
    {
        return $this->address()->where('main', '=', 1);
    }

    public function address()
    {
        return $this->hasMany(CustomerAddress::class, 'customer_id');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class, 'customer_id');
    }

    public function getMainAddressAttribute()
    {
        return $this->mainAddress()->getResults()->first();
    }

    public function getFullAddressAttribute()
    {
        $address = $this->mainAddress->street;
        $address.= ' ' . $this->mainAddress->street_number;
        $address.= ' ' . $this->mainAddress->state_province;
        $address.= ' ' . $this->mainAddress->country;
        $address.= ' ' . $this->mainAddress->postcode;

        return $address;
    }
}
;
