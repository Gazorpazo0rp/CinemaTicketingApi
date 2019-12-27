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
Route::post('login','UserController@login');
Route::post('register','UserController@register');
Route::get('movies','MoviesController@index');
Route::post('addMovie','MoviesController@create');
Route::get('movie/{id}','MoviesController@getMovie');
Route::post('addScreen','MoviesController@addScreen');
Route::get('screens','MoviesController@getAllScreens');
Route::post('addScreening','MoviesController@addScreening');
Route::get('movieScreenings/{id}','MoviesController@getMovieScreenings');
Route::get('screeningData/{screeningId}','MoviesController@getTakenChairs');
Route::post('makeReservation','MoviesController@makeReservation');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
