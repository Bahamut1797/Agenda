<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {
    Route::resource('reminders', 'RemindersController', ['except' => ['create', 'edit']]);
    Route::resource('archive_reminders', 'ArchiveRemindersController', ['except' => ['create', 'edit', 'update']]);
    Route::resource('categories', 'CategoriesController', ['except' => ['create', 'edit', 'update']]);
});

Route::group(['prefix' => '/external', 'middleware' => 'auth:api', 'namespace' => 'Api\V1', 'as' => 'api.external.'], function () {
    Route::resource('reminders', 'RemindersController', ['except' => ['create', 'edit']]);
    Route::resource('archive_reminders', 'ArchiveRemindersController', ['except' => ['create', 'edit', 'update']]);
    Route::resource('categories', 'CategoriesController', ['except' => ['create', 'edit', 'update']]);
});

Route::group(['prefix' => '/external', 'namespace' => 'Api'], function () {
    Route::middleware('auth:api')->get('details', 'UserController@details');
    Route::post('login', 'UserController@login');
    Route::post('register', 'UserController@register');
});