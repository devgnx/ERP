<?php

Route::get('customers', [
    'as'   => 'customer.index',
    'uses' => 'SaleController@index'
]);

Route::group(['prefix' => 'customer'], function() {

    Route::get('create', [
        'as'   => 'customer.create',
        'uses' => 'SaleController@create'
    ]);

    Route::post('create', [
        'as'   => 'customer.store',
        'uses' => 'SaleController@store'
    ]);

    Route::get('{id}/edit', [
        'as'   => 'customer.edit',
        'uses' => 'SaleController@edit'
    ]);

    Route::post('{id}/edit', [
        'as'   => 'customer.update',
        'uses' => 'SaleController@update'
    ]);

    Route::get('{id}', [
        'as'   => 'customer.show',
        'uses' => 'SaleController@show'
    ]);
});
