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

Route::group(['prefix' => 'auth', 'as' => 'auth.'], function() {
    Route::post('/login', ['as' => 'login', 'uses' => 'AuthController@auth']);
});

Route::group(['middleware' => ['protected']], function() {
    Route::get('/me', ['as' => 'me', 'uses' => 'UserController@me']);

    Route::group(['prefix' => 'users', 'as' => 'users.'], function() {
        Route::get('/', ['middleware' => ['cache'], 'as' => 'list', 'uses' => 'UsersController@list']);
        Route::post('/save', ['as' => 'submit', 'uses' => 'UsersController@save']);
    });
});
