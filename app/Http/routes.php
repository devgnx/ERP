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
Route::get('/', ['middleware' => 'auth', 'as' => 'home', 'uses' => function () {
    return view('dashboard_controller.index');
}]);

Route::get('/dashboard', ['middleware' => 'auth', 'as' => 'dashboard', 'uses' => function () {
    return view('dashboard_controller.index');
}]);

require_once(__DIR__ . '/Routes/AuthRoutes.php');
require_once(__DIR__ . '/Routes/ProductRoutes.php');
require_once(__DIR__ . '/Routes/SaleRoutes.php');
require_once(__DIR__ . '/Routes/SellerRoutes.php');