<?php

namespace App\Providers;

use App\Models\Store;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['partials.topbar', 'partials.head'], function($view) {
            view()->share('store', Store::first());
        });

        view()->composer('partials.topbar', function($view) {
            $user = \Auth::user();
            view()->share('user', $user);

            if ( !empty($user->seller()->id) ) {
                view()->share('seller', $user->seller());
            } else {
                view()->share('seller', null);
            }


            $sales = \App::make('App\Repositories\SaleRepository');
            if ( \Schema::hasTable($sales->getTable()) ) {
                view()->share('sales', $sales->all());
            } else {
                view()->share('sales', null);
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