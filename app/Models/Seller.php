<?php

namespace App\Models;

use Eloquent;
use App\Models\Sale;
use App\Models\User;
use App\Models\SaleItem;

class Seller extends Eloquent
{
    protected $table = 'module_seller';

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }

    public function saleItems()
    {
        return $this->hasManyThrough(SaleItem::class, Sale::class);
    }
}
