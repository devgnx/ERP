<?php

Route::get('sales', [
    'as'   => 'sale.index',
    'uses' => 'SaleController@index'
]);

Route::group(['prefix' => 'sale'], function() {

    Route::get('create', [
        'as'   => 'sale.create',
        'uses' => 'SaleController@create'
    ]);

    Route::post('create', [
        'as'   => 'sale.store',
        'uses' => 'SaleController@store'
    ]);

    Route::get('{id}/edit', [
        'as'   => 'sale.edit',
        'uses' => 'SaleController@edit'
    ]);

    Route::post('{id}/edit', [
        'as'   => 'sale.update',
        'uses' => 'SaleController@update'
    ]);

    Route::get('{id}', [
        'as'   => 'sale.show',
        'uses' => 'SaleController@show'
    ]);
});
