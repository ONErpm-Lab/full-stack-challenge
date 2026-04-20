<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SpotifyController;

Route::get('/spotify/track/{isrc}', [SpotifyController::class, 'searchByIsrc']);
