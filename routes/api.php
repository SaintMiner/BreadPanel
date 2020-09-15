<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/me', 'UserController@user');

    Route::middleware('blocked')->group(function () {
        Route::get('/invitation/generate', 'InvitationController@generate');

        Route::get('users/{id}/block', 'UserController@block');

        Route::resource('/invitation', 'InvitationController');
        Route::resource('/role', 'RoleController');
        Route::resource('/permission', 'PermissionController');
        Route::resource('/users', 'UserController');
    });
});

Route::get('/crumbtop', 'UserController@crumbTop');

Route::post('/isCodeBusy', 'InvitationController@isCodeBusy');
Route::post('/isUsernameBusy', 'UserController@isUsernameBusy');