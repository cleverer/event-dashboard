<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'WebController@home')->name('home');
Route::get('/login', 'WebController@login')->name('login');
Route::get('/event/{event}', 'WebController@home')->name('event')->middleware('signed');

Route::post('/login/status', 'LoginController@check');
Route::post('/login', 'LoginController@login');

Route::post('/event/{event}', 'WebController@modifyEvent')->name('modifyEvent')->middleware('signed');

Route::group(['middleware' => ['auth']], function() {
    Route::post('/events', 'EventController@store');
});
