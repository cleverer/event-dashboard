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
Route::get('/event/{event}', 'WebController@home')->name('event');

Route::post('/events', 'EventController@store');
Route::post('/event/{event}', 'EventController@update');
