<?php

Route::get('customers', [
    'as'   => 'customer.index',
    'uses' => 'CustomerController@index'
]);

Route::group(['prefix' => 'customer'], function() {

    Route::get('create', [
        'as'   => 'customer.create',
        'uses' => 'CustomerController@create'
    ]);

    Route::post('create', [
        'as'   => 'customer.store',
        'uses' => 'CustomerController@store'
    ]);

    Route::get('{id}/edit', [
        'as'   => 'customer.edit',
        'uses' => 'CustomerController@edit'
    ]);

    Route::post('{id}/edit', [
        'as'   => 'customer.update',
        'uses' => 'CustomerController@update'
    ]);

    Route::get('{id}', [
        'as'   => 'customer.show',
        'uses' => 'SaleController@show'
    ]);
});
