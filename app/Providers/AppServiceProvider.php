<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Schema\Blueprint;
use App\Models\Product;
use App\Models\Sale;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->events();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Register any Eloquent application events.
     * @return void
     */
    private function events()
    {
        Product::created(function($product) {
            $product->createNotification();
        });

        Sale::created(function($sale) {
            $sale->createNotification();
        });
    }
}
