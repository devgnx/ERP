<?php

Route::get('suppliers', [
    'as'   => 'supplier.index',
    'uses' => 'SupplierController@index'
]);

Route::group(['prefix' => 'supplier'], function() {

    Route::bind('supplier_slug', function($slug) {
        return App\Models\Supplier::whereSlug($slug)->first();
    });

    Route::get('create', [
        'as'   => 'supplier.create',
        'uses' => 'SupplierController@create'
    ]);

    Route::post('create', [
        'as'   => 'supplier.store',
        'uses' => 'SupplierController@store'
    ]);

    Route::get('{supplier_slug}/edit', [
        'as'   => 'supplier.edit',
        'uses' => 'SupplierController@edit'
    ]);

    Route::post('{supplier_slug}/edit', [
        'as'   => 'supplier.update',
        'uses' => 'SupplierController@update'
    ]);

    Route::get('{supplier_slug}', [
        'as'   => 'supplier.show',
        'uses' => 'SupplierController@show'
    ]);
});
