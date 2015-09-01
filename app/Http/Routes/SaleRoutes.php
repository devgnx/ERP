<?php

Route::get('vendas', [
    'as'   => 'sale.index',
    'uses' => 'SaleController@index'
]);

Route::group(['prefix' => 'venda'], function() {

    Route::get('criar', [
        'as'   => 'sale.create',
        'uses' => 'SaleController@create'
    ]);

    Route::post('criar', [
        'as'   => 'sale.store',
        'uses' => 'SaleController@store'
    ]);

    Route::get('{id}/editar', [
        'as'   => 'sale.edit',
        'uses' => 'SaleController@edit'
    ]);

    Route::post('{id}/editar', [
        'as'   => 'sale.update',
        'uses' => 'SaleController@update'
    ]);

    Route::get('{id}', [
        'as'   => 'sale.show',
        'uses' => 'SaleController@show'
    ]);
});
