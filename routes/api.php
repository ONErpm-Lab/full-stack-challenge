<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\v1\TracksController;

Route::middleware('throttle:60,1')->prefix('v1')->group(function () {
    Route::get('/tracks', [TracksController::class, 'index']);
});
