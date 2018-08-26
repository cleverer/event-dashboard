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

Route::group(['middleware' => ['sessionAuth', 'auth:api']], function() {
    Route::post('/events', 'EventController@create');
    Route::put('/events/{event}', 'EventController@create');

    Route::post('/login/status', 'LoginController@check');
});

Route::group(['middleware' => ['sessionAuth']], function() {
    Route::post('login', 'LoginController@login')->name('login');
});
