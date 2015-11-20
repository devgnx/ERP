<?php

namespace App\Models;

use Eloquent;
use App\Models\Sale;

class SaleStatus extends Eloquent
{
    protected $table    = 'module_sale_status';
    protected $fillable = ['name', 'code'];
    public $timestamps  = false;

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
