<?php

Route::get('produtos', [
    'as'   => 'product.index',
    'uses' => 'ProductController@index'
]);

Route::group(['prefix' => 'produto'], function() {

    Route::bind('product', function($slug) {
        return App\Models\Product::whereSlug($slug)->first();
    });

    Route::get('criar', [
        'as'   => 'product.create',
        'uses' => 'ProductController@create'
    ]);

    Route::post('criar', [
        'as'   => 'product.store',
        'uses' => 'ProductController@store'
    ]);

    Route::get('{product}/editar', [
        'as'   => 'product.edit',
        'uses' => 'ProductController@edit'
    ]);

    Route::post('{product}/editar', [
        'as'   => 'product.update',
        'uses' => 'ProductController@update'
    ]);

    Route::post('{product}/editar/preco', [
        'as' => 'product.edit.price',
        'uses' => 'ProductController@updatePrice'
    ]);

    Route::get('{product}', [
        'as'   => 'product.show',
        'uses' => 'ProductController@show'
    ]);
});
