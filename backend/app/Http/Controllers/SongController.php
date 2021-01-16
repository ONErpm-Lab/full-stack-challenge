<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Http\Resources\Song as SongResource;
use Illuminate\Http\JsonResponse;

class SongController extends Controller
{
    /**
    * Gets all song fron song database
    */
    public function getAllSongs(): JsonResponse
    {        
        $songs = Song::get()->sortBy('title');
        return SongResource::collection($songs)->response();
    }
}
