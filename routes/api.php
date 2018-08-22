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

Route::middleware('auth:api')->post('/events', 'EventController@create');
Route::middleware('auth:api')->put('/events/{event}', 'EventController@create');

Route::middleware('auth:api')->post('/login/status', 'LoginController@check');
Route::post('login', 'LoginController@check')->name('login');
