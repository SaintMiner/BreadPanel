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

Route::middleware('auth:sanctum', 'check.route')->group(function () {

    Route::get('/me', 'UserController@user')->name('users.me');

    Route::middleware('blocked')->group(function () {

        Route::resource('/permission', 'PermissionController');
        Route::resource('/users', 'UserController')->only(['index']);
        
        
        Route::middleware('can:manage users')->group(function() {
            Route::resource('/users', 'UserController')->only(['store', 'update', 'destroy']);
            Route::get('users/{id}/block', 'UserController@block')->name('users.block');
        });
        Route::middleware('can:manage roles')->group(function() {
            Route::resource('/role', 'RoleController');
        });
        Route::middleware('can:manage invitations')->group(function() {
            Route::resource('/invitation', 'InvitationController');
            Route::get('/invitation/generate', 'InvitationController@generate')->name('invitation.generate');
        });
    });
});

Route::resource('/users', 'UserController')->only(['show']);

Route::get('/crumbtop', 'UserController@crumbTop')->name('users.crumb_top');

Route::post('/isCodeBusy', 'InvitationController@isCodeBusy')->name('invitation.check');
Route::post('/isUsernameBusy', 'UserController@isUsernameBusy')->name('users.username_check');
Route::post('/setInitialAvatar', 'UserController@setInitialAvatar')->name('users.set_initial_avatar');
Route::post('/setImageAvatar', 'UserController@setImageAvatar')->name('users.set_image_avatar');
Route::post('/assignroles', 'UserController@assignRoles')->name('users->assing_roles');