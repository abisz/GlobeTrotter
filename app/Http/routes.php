<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

//myTrips:
Route::get('user/{user_id}', ['uses' => 'TripsController@showAllTrips', 'as' => 'myTrips'])->where('user_id', '[0-9]+');

//Trip Detail:
Route::get('trip/{trip_id}', ['uses' => 'TripsController@show', 'as' => 'tripDetail'])->where('trip_id', '[0-9]+');
Route::get('trip/create', ['uses' => 'TripsController@create', 'middleware' => 'auth']);
Route::post('trip/create', 'TripsController@store'); //stores a new Trip
Route::get('trip/{trip_id}/edit', ['uses' => 'TripsController@edit', 'middleware' => 'auth'] )->where('trip_id', '[0-9]+');
Route::patch('trip/update/{trip_id}', ['uses' => 'TripsController@update', 'middleware' => 'auth'] )->where('trip_id', '[0-9]+');
