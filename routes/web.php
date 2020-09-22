<?php
    Route::get('/{any}', 'AppController@index')->where('any', ".*")->name('app');
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
    Route::get('sanctum/csrf-cookie', 'Laravel\Sanctum\Http\Controllers\CsrfCookieController@show')->name('csrf-cookie');
    