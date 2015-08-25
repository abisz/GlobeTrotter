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

/*
 *
 * TO DO:
 *
 *  google maps
 *      implementation
 *      communication with laravel and forms
 *      saving location in entries
 *  homepage + example trips
 *  breadcrumbs
 *  design
 *
 */

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

//User:
Route::get('user/{user_id}', ['uses' => 'TripsController@showAllTrips', 'as' => 'myTrips'])->where('user_id', '[0-9]+');
Route::get('user/{user_id}/edit', ['uses' => 'UserController@edit', 'middleware' => 'auth'])->where('user_id', '[0-9]+');
Route::patch('user/{user_id}/update', ['uses' => 'UserController@update'])->where('user_id', '[0-9]+');
Route::get('user/{user_id}/delete', ['uses' => 'UserController@destroy', 'middleware' => 'auth'])->where('user_id', '[0-9]+');

//Trips:
Route::get('trip/{trip_id}', ['uses' => 'TripsController@show', 'as' => 'tripDetail'])->where('trip_id', '[0-9]+');
Route::get('trip/create', ['uses' => 'TripsController@create', 'middleware' => 'auth']);
Route::post('trip/create', 'TripsController@store');
Route::get('trip/{trip_id}/edit', ['uses' => 'TripsController@edit', 'middleware' => 'auth'] )->where('trip_id', '[0-9]+');
Route::patch('trip/update/{trip_id}', ['uses' => 'TripsController@update', 'middleware' => 'auth'] )->where('trip_id', '[0-9]+');
Route::get('trip/{trip_id}/delete', ['uses' => 'TripsController@destroy', 'middleware' => 'auth'])->where('trip_id', '[0-9]+');

//Entries:
Route::get('trip/{trip_id}/entry/create', ['uses' => 'TripEntriesController@create', 'middleware' => 'auth'])->where('trip_id', '[0-9]+');
Route::post('trip/{trip_id}/entry/create', ['uses' => 'TripEntriesController@store'])->where('trip_id', '[0-9]+');
Route::get('trip/{trip_id}/entry/{entry_id}', ['uses' => 'TripEntriesController@show'])->where(['trip_id' => '[0-9]+', 'entry_id' => '[0-9]+']);
Route::get('trip/{trip_id}/entry/{entry_id}/edit', ['uses' => 'TripEntriesController@edit', 'middleware' => 'auth'] )->where(['trip_id' => '[0-9]+', 'entry_id' => '[0-9]+']);
Route::patch('trip/{trip_id}/entry/{entry_id}/update', ['uses' => 'TripEntriesController@update', 'middleware' => 'auth'] )->where(['trip_id' => '[0-9]+', 'entry_id' => '[0-9]+']);
Route::get('trip/{trip_id}/entry/{entry_id}/delete', ['uses' => 'TripEntriesController@destroy', 'middleware' => 'auth'])->where(['trip_id' => '[0-9]+', 'entry_id' => '[0-9]+']);

//Pictures:
Route::get('trip/{trip_id}/entry/{entry_id}/picture/create', ['uses' => 'PicturesController@create', 'middleware' => 'auth'])->where(['trip_id' => '[0-9]+', 'entry_id' => '[0-9]+']);
Route::post('trip/{trip_id}/entry/{entry_id}/picture/create', ['uses' => 'PicturesController@store', 'middleware' => 'auth'])->where(['trip_id' => '[0-9]+', 'entry_id' => '[0-9]+']);
Route::get('trip/{trip_id}/entry/{entry_id}/picture/{pic_id}', ['uses' => 'PicturesController@show'])->where(['trip_id' => '[0-9]+', 'entry_id' => '[0-9]+', 'pic_id' => '[0-9]+']);
Route::get('trip/{trip_id}/entry/{entry_id}/picture/{pic_id}/edit', ['uses' => 'PicturesController@edit', 'middleware' => 'auth'])->where(['trip_id' => '[0-9]+', 'entry_id' => '[0-9]+', 'pic_id' => '[0-9]+']);
Route::patch('trip/{trip_id}/entry/{entry_id}/picture/{pic_id}/update', ['uses' => 'PicturesController@update', 'middleware' => 'auth'])->where(['trip_id' => '[0-9]+', 'entry_id' => '[0-9]+', 'pic_id' => '[0-9]+']);
Route::get('trip/{trip_id}/entry/{entry_id}/picture/{pic_id}/delete', ['uses' => 'PicturesController@destroy', 'middleware' => 'auth'])->where(['trip_id' => '[0-9]+', 'entry_id' => '[0-9]+', 'pic_id' => '[0-9]+']);

//homepage
Route::get('', function(){
    return view('app');
});

Route::get('home', function(){
    return view('app');
});