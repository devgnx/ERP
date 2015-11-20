<?php
namespace App\Models;

use Eloquent;
use App\Models\Customer;

class CustomerPerson extends Eloquent
{
    protected $table = 'module_customer_person';
    protected $fillable = ['name', 'cpf'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
