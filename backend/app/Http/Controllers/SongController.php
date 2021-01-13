<?php

namespace App\Http\Controllers;

use App\Models\Song;
use App\Http\Resources\Song as SongResource;
use Illuminate\Http\JsonResponse;

class SongController extends Controller
{
    //
    public function getAllSongs(): JsonResponse
    {
        /* get all posts ordered by published date */
        $songs = Song::get();

        /* wrap posts in a resource */
        return SongResource::collection($songs)->response();
    }
}
