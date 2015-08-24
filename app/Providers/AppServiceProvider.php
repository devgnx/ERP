<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
