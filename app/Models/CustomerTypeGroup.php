<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\CustomerType;

class CustomerTypeGroup extends Model
{
    protected $table = 'module_customer_type_group';
    public $timestamps = false;

    public function types()
    {
        return $this->hasMany(CustomerType::class, 'group_id');
    }

    public function customers()
    {
        return $this->hasManyThrough(Customer::class, CustomerType::class, 'group_id', 'type_id');
    }
}
