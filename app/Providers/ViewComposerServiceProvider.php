<?php

namespace App\Providers;

use Blade;
use App\Models\Store;
use Illuminate\Support\ServiceProvider;
use App\Models\Sale;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('*', function($view) {

            if (\Auth::user()) {
                view()->share('user', \Auth::user());
                view()->share('seller', \Auth::user()->seller);
            }

            view()->share('store', Store::first());
        });

        view()->composer('partials.topbar', function($view) {
            $sales = \App::make(Sale::class);
            if ( \Schema::hasTable($sales->getTable()) ) {
                view()->share('newSales', $sales->getNewSales( \Auth::user() ));
            } else {
                view()->share('newSales', null);
            }
        });
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