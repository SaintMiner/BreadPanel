<?php
    Route::get('/{any}', 'AppController@index')->where('any', ".*");
    Route::post('login', [
        'as' => 'login',
        'uses' => 'Auth\LoginController@login'
    ]);
    Route::post('logout', [
        'as' => 'logout',
        'uses' => 'Auth\LoginController@logout'
    ]);
    Route::post('register', [
        'as' => 'register',
        'uses' => 'Auth\RegisterController@register'
    ]);