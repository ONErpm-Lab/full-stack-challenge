<?php

use App\Http\Controllers\TrackController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TrackController::class, 'index']);
