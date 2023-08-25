<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Track;
use GuzzleHttp\Client;
use App\Services\TrackInfoService;
use Illuminate\Routing\Controller as BaseController;

class TrackController extends BaseController
{

    public function __construct(
        private Track $track,
        private TrackInfoService $trackInfoService
    ) {
    }

    public function index()
    {
        return response()->json($this->track->all());
    }

    public function getTrackInfoByISRC(Request $request)
    {
        
        $isrcCode = $request->query('isrc_code');
        
        if (empty($isrcCode)) {
            return response()->json(['error' => 'Invalid ISRC code'], 400);
        }

        $trackInfo = $this->trackInfoService->getByIsrcCode($isrcCode);

        return response()->json($trackInfo);
    }

    public function store(Request $request)
    {
        $artistsArray = explode(',', $request->input('artists'));

        $tracks = new Track([
            'album_thumb' => $request->input('album_thumb'),
            'release_date' => $request->input('release_date'),
            'track_title' => $request->input('track_title'),
            'artists' => $artistsArray,
            'duration' => $request->input('duration'),
            'audio_preview_url' => $request->input('audio_preview_url'),
            'spotify_track_url' => $request->input('spotify_track_url'),
            'is_available_in_br' => $request->input('is_available_in_br'),
        ]);
        $tracks->save();
        return response(status: 201);
    }

    public function show($id)
    {
        return response()->json($this->track->find($id));
    }

    public function update(Request $request, $id)
    {
        $track = $this->track->find($id);
        $track->update($request->all());
        return response(status: 204);
    }

    public function destroy($id)
    {
        $track = $this->track->find($id);
        $track->delete();
        return response(status: 204);
    }
}

