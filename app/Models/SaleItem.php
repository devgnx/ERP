<?php

namespace App\Models;

use Eloquent;
use App\Models\Sale;
use App\Models\Seller;
use App\Models\Product;
use App\Models\Customer;

class SaleItem extends Eloquent
{
    protected $table    = 'module_sale_item';
    protected $fillable = ['product_id', 'sale_id', 'quantity', 'product_price'];
    public $timestamps  = false;

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function customer()
    {
        return $this->sale()->belongsTo(Customer::class);
    }

    public function seller()
    {
        return $this->sale()->belongsTo(Seller::class);
    }
}
