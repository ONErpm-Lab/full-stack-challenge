<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TrackController;

Route::get('/tracks', [TrackController::class, 'index']);
Route::post('/tracks', [TrackController::class, 'store']);
Route::delete('/tracks/{id}', [TrackController::class, 'destroy']);

Route::get('/spotify-tracks', [TrackController::class, 'getTrackInfoByISRC']);