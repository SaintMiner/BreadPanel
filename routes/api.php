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

        Route::resource('/permission', 'PermissionController');
        Route::resource('/users', 'UserController')->only(['index']);
        
        
        Route::middleware('can:manage users')->group(function() {
            Route::resource('/users', 'UserController')->only(['store', 'update', 'destroy']);
            Route::get('users/{id}/block', 'UserController@block');
        });
        Route::middleware('can:manage roles')->group(function() {
            Route::resource('/role', 'RoleController');
        });
        Route::middleware('can:manage invitations')->group(function() {
            Route::resource('/invitation', 'InvitationController');
            Route::get('/invitation/generate', 'InvitationController@generate');
        });
    });
});

Route::resource('/users', 'UserController')->only(['show']);

Route::get('/crumbtop', 'UserController@crumbTop');

Route::post('/isCodeBusy', 'InvitationController@isCodeBusy');
Route::post('/isUsernameBusy', 'UserController@isUsernameBusy');
Route::post('/setInitialAvatar', 'UserController@setInitialAvatar');
Route::post('/setImageAvatar', 'UserController@setImageAvatar');
Route::post('/assignroles', 'UserController@assignRoles');