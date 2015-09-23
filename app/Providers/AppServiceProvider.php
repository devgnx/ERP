<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\SaleRepository as Sale;

use Illuminate\Database\Schema\Blueprint;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $menu = (object) [
            'home' => url('/'),
            'products' => url('produtos/')
        ];

        $main = (object) [
            'title' => 'Highlander Bros.', //$store->title
            'nav' => (object) ['title' => 'Highlander Bros.' /*$store->name*/],
            'menu' => $menu
        ];

        \View::share('main', $main);

        // Sales
        $sales = \App::make('App\Repositories\SaleRepository');

        if ( \Schema::hasTable($sales->getTable()) ) {
            \View::share('sales', $sales->all());
        } else {
            \View::share('sales', []);
        }
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
}
