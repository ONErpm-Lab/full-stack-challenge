<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Track Routes

Route::get('tracks', 'App\Http\Controllers\TrackController@getAllTracks');
Route::get('tracks/{id}', 'App\Http\Controllers\TrackController@getTrack');
Route::post('tracks', 'App\Http\Controllers\TrackController@createTrack');
Route::put('tracks/{id}', 'App\Http\Controllers\TrackController@updateTrack');
Route::delete('tracks/{id}','App\Http\Controllers\TrackController@deleteTrack');

// Artist Routes

Route::get('artists', 'App\Http\Controllers\ArtistController@getAllArtists');
Route::get('artists/{id}', 'App\Http\Controllers\ArtistController@getArtist');
Route::post('artists', 'App\Http\Controllers\ArtistController@createArtist');
Route::put('artists/{id}', 'App\Http\Controllers\ArtistController@updateArtist');
Route::delete('artists/{id}','App\Http\Controllers\ArtistController@deleteArtist');

// Spotify Token

Route::get('spotify/token', 'App\Http\Controllers\SpotifyController@token');
