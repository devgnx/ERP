<?php
Route::group(['prefix' => 'auth'], function() {
    Route::get('login', [
        'as'  => 'auth.login',
        'uses' => 'Auth\AuthController@getLogin'
    ]);

    Route::post('login', [
        'as'  => 'auth.login',
        'uses' => 'Auth\AuthController@postLogin'
    ]);

    Route::get('logout', [
        'as'  => 'auth.logout',
        'uses' => 'Auth\AuthController@getLogout'
    ]);

    Route::get('register', [
        'as'  => 'auth.register',
        'uses' => 'Auth\AuthController@getRegister'
    ]);

    Route::post('register', [
        'as'  => 'auth.register',
        'uses' => 'Auth\AuthController@postRegister'
    ]);

    Route::group(['prefix' => 'reset'], function() {
        Route::get('', [
            'as'  => 'auth.reset.start',
            'uses' => 'Auth\AuthController@getResetStart'
        ]);

        Route::post('', [
            'as'  => 'auth.reset.start',
            'uses' =>'Auth\AuthController@postResetStart'
        ]);

        Route::get('{id}/{token}', [
            'as'  => 'auth.reset.end',
            'uses' => 'Auth\AuthController@getResetEnd'
        ]);

        Route::post('{id}/{token}', [
            'as'  => 'auth.reset.end',
            'uses' => 'Auth\AuthController@postResetEnd'
        ]);
    });
});