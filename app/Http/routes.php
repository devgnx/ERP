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
Route::get('/', function () {
    return view('welcome');
});

Route::bind('product', function($slug){
    return App\Models\Product::whereSlug($slug)->first();
});

Route::get('produtos', 'ProductsController@index');

Route::get('produto/{product}', 'ProductsController@show');

Route::get('produtos/{product}/editar', 'ProductsController@edit');

