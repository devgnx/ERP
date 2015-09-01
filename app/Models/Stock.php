<?php

namespace App\Models;

use Eloquent;

class Stock extends Eloquent
{
    protected $table = 'ModuleProductStock';

    protected $fillable = ['quantity', 'sky'];

    public function product()
    {
        $this->belongsTo('App\Models\Product');
    }
}