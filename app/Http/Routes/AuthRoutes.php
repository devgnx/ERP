<?php
Route::group(['prefix' => 'auth'], function() {
    Route::get('login', 'Auth\AuthController@getLogin');
    Route::post('login', 'Auth\AuthController@postLogin');
    Route::get('logout', 'Auth\AuthController@getLogout');

    Route::get('register', 'Auth\AuthController@getRegister');
    Route::post('register', 'Auth\AuthController@postRegister');

    Route::group(['prefix' => 'reset'], function() {

        Route::get('remainder', 'Auth\AuthController@getResetStart');
        Route::post('remainder', 'Auth\AuthController@postResetStart');

        Route::get('{id}/{token}', 'Auth\AuthController@getResetEnd');
        Route::post('{id}/{token}', 'Auth\AuthController@postResetEnd');
    });
});