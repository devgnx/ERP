<?php
namespace App\Models;

use Eloquent;
use App\Models\Sale;
use App\Models\CustomerPerson;
use App\Models\CustomerCompany;
use App\Models\CustomerType;
use App\Models\CustomerTypeGroup;
use App\Models\CustomerAddress;

class Customer extends Eloquent
{
    protected $table = 'module_customer';
    protected $fillable = ['email', 'phone', 'is', 'type_id'];

    public function person()
    {
        return $this->hasOne(CustomerPerson::class, 'customer_id');
    }

    public function company()
    {
        return $this->hasOne(CustomerCompany::class, 'customer_id');
    }

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

    public function getFullAddressAttribute($but_not = ['country'])
    {
        if ($but_not === null) $but_not = ['country'];

        $address = '';
        $attributes = ['street', 'street_number', 'city', 'state_province', 'country', 'postcode'];
        $attributes = array_values( array_diff($attributes, $but_not) );

        foreach ($attributes as $key => $attribute) {
            if ($key == 0) $address = $this->mainAddress->{$attribute};
            else $address.= ' ' . $this->mainAddress->{$attribute};
        }

        return $address;
    }

    public function getDetailAttribute()
    {
        if ($this->is == 'person') {
            return $this->person;
        } elseif ($this->is == 'company') {
            return $this->company;
        }
    }

    public function getNameAttribute()
    {
        if ($this->is == 'person') {
            return $this->person->name;
        } elseif ($this->is == 'company') {
            return $this->company->trading_name;
        }
    }

    public function getTradingNameAttribute()
    {
        if ($this->is == 'company') {
            return $this->company->trading_name;
        } else {
            return 'Pessoa Física';
        }
    }

    public function getCompanyNameAttribute()
    {
        if ($this->is == 'company') {
            return $this->company->name;
        } else {
            return 'Pessoa Física';
        }
    }

    public function getCpfCnpjAttribute()
    {
        if ($this->is == 'person') {
            return $this->person->cpf;
        } elseif ($this->is == 'company') {
            return $this->person->cnpj;
        }
    }

    public function getCpfAttribute()
    {
        if ($this->is == 'person') {
            return $this->person->cpf;
        } else {
            return 'Pessoa jurídica';
        }
    }

    public function getCnpjAttribute()
    {
        if ($this->is == 'company') {
            return $this->company->cnpj;
        } else {
            return 'Pessoa Física';
        }
    }
}
