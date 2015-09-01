<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', ['as' => 'home', 'uses' => function () {
    return view('welcome');
}]);

require_once(__DIR__ . '/Routes/ProductRoutes.php');
require_once(__DIR__ . '/Routes/SaleRoutes.php');

Menu::make('nav', function($menu){
    $menu->add('Home', ['route' => 'home']);
    $menu->add('Produtos', ['route' => 'product.index']);
    $menu->add('Vendas', ['route' => 'sale.index']);
});