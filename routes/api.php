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



///////////////
// NO OAuth2 //
///////////////
Route::get('/hello',    'HomeController@hello');



////////////////////////////////
// OAuth2: Client credentials //
////////////////////////////////
Route::post('/oauth/token',    'HomeController@generateToken');

Route::post('/users',              'UserController@create');
Route::get ('/films',              'FilmController@index');
Route::get ('/films/{filmId}',     'FilmController@get');
Route::get ('/actors',             'ActorController@index');
Route::get ('/actors/{filmId}',    'ActorController@get');


//////////////////////
// OAuth2: Password //
//////////////////////
Route::get ('/me',           'PrivateAreaController@get');
Route::get ('/me/films',     'PrivateAreaController@indexFilms');
Route::post('/me/films',     'PrivateAreaController@voteFilm');
Route::get ('/me/actors',    'PrivateAreaController@indexActors');
Route::post('/me/actors',    'PrivateAreaController@voteActor');