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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/trips', 'TripsController@index');
Route::get('/trips/create', 'TripsController@create')->middleware('auth');
Route::get('/trips/{trip}', 'TripsController@show');
Route::post('/trips', 'TripsController@store');
Route::get('/trips/{trip}/edit', 'TripsController@edit');
Route::put('/trips/{trip}', 'TripsController@update');
Route::delete('/trips/{trip}', 'TripsController@destroy');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
