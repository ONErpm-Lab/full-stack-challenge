<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SpotifyService;

class SpotifyController extends Controller
{
    protected $spotify;

    public function __construct(SpotifyService $spotify)
    {
        $this->spotify = $spotify;
    }

    public function searchByIsrc($isrc)
    {
        $track = $this->spotify->searchTrackByIsrc($isrc);

        if (!$track) {
            return response()->json(['message' => 'Track not found'], 404);
        }

        return response()->json($track);
    }
}
