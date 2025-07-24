<?php
use App\Http\Controllers\Api;

Route::middleware('api')->group(function () {
    Route::apiResource('tracks', Api\TracksController::class)->only(['index', 'show']);

});
