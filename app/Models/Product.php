<?php
namespace App\Models;

use Eloquent;

class Product extends Eloquent
{
    protected $table = 'ModuleProduct';

    protected $fillable = ['code', 'name', 'price'];

    public function stock()
    {
        return $this->hasOne('App\Stock', 'product_code', 'code');
    }
}