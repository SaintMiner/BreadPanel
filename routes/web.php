<?php
    Route::get('/{any}', 'AppController@index')->where('any', ".*");
    Auth::routes();