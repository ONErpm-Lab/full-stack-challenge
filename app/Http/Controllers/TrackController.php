<?php

namespace App\Http\Controllers;

use App\Models\Track;

class TrackController extends Controller
{
    public function index()
    {
        $tracks = Track::with(['artists', 'albums'])
            ->orderBy('title')
            ->get();

        $tracks->transform(function ($track) {
            return [
                'artists' => $track->artists->pluck('name')->join(', '),
                'duration' => gmdate('i:s', $track->duration_ms / 1000),
                'realease_date' => $track->albums->first()->release_date,
                'avaliable_in_brazil' => $track->avaliable_in_brazil,
                'spotify_url' => $track->spotify_url,
                'title' => $track->title,
                'preview_url' => $track->preview_url,
                'thumb_url' => $track->albums->first()->thumb_url,
            ];
        });

        return view('tracks.index', compact('tracks'));
    }
}
