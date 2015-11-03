<?php

Route::get('sellers', [
    'as'   => 'seller.index',
    'uses' => 'SellerController@index'
]);

Route::group(['prefix' => 'seller'], function() {

    Route::bind('seller_slug', function($slug) {
        return App\Models\Seller::whereSlug($slug)->first();
    });

    Route::get('load', [
        'as'   => 'seller.load',
        'uses' => 'SellerController@load'
    ]);

    Route::get('create', [
        'as'   => 'seller.create',
        'uses' => 'SellerController@create'
    ]);

    Route::post('create', [
        'as'   => 'seller.store',
        'uses' => 'SellerController@store'
    ]);

    Route::get('{seller_slug}/edit', [
        'as'   => 'seller.edit',
        'uses' => 'SellerController@edit'
    ]);

    Route::post('{seller_slug}/edit', [
        'as'   => 'seller.update',
        'uses' => 'SellerController@update'
    ]);

    Route::get('{seller_slug}', [
        'as'   => 'seller.show',
        'uses' => 'SellerController@show'
    ]);
});
