<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Customer;
use App\Models\CustomerTypeGroup;

class CustomerType extends Model
{
    protected $table = 'module_customer_type';
    public $timestamps = false;

    public function customers()
    {
        return $this->hasMany(Customer::class, 'type_id');
    }

    public function group()
    {
        return $this->type()->belongsTo(CustomerTypeGroup::class, 'group_id');
    }
}
