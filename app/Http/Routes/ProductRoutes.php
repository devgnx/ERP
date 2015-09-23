<?php

Route::get('products', [
    'as'   => 'product.index',
    'uses' => 'ProductController@index'
]);

Route::group(['prefix' => 'product'], function() {

    Route::bind('product_slug', function($slug) {
        return App\Models\Product::whereSlug($slug)->first();
    });

    Route::get('create', [
        'as'   => 'product.create',
        'uses' => 'ProductController@create'
    ]);

    Route::post('create', [
        'as'   => 'product.store',
        'uses' => 'ProductController@store'
    ]);

    Route::get('{product_slug}/edit', [
        'as'   => 'product.edit',
        'uses' => 'ProductController@edit'
    ]);

    Route::post('{product_slug}/edit', [
        'as'   => 'product.update',
        'uses' => 'ProductController@update'
    ]);

    Route::post('{product_slug}/edit/price', [
        'as' => 'product.edit.price',
        'uses' => 'ProductController@updatePrice'
    ]);

    Route::get('{product_slug}', [
        'as'   => 'product.show',
        'uses' => 'ProductController@show'
    ]);
});
