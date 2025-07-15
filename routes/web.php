<?php

use App\Services\SpotifyService;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test-spotify', function (SpotifyService $spotify) {
    dd($spotify->searchTrackByISRC('BR1SP1200071'));
});

