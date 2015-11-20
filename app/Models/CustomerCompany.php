<?php
namespace App\Models;

use Eloquent;
use App\Models\Customer;

class CustomerCompany extends Eloquent
{
    protected $table = 'module_customer_company';
    protected $fillable = ['name', 'trading_name', 'cnpj'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
