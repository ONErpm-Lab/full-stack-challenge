<?php

namespace App\Http\Integrations\Spotify;

use App\DTOs\Track\CreateTrackDTO;
use App\Contracts\MusicPlatformAdapterContract;
use App\Http\Integrations\Spotify\Requests\GetSearchTrackRequest;
use App\Http\Integrations\Spotify\Requests\GetAccessTokenRequest;
use App\Http\Integrations\Spotify\DTOs\TrackDTO;

class SpotifyAdapter implements MusicPlatformAdapterContract
{
    public function fetchTrackByIsrc(string $isrc): ?CreateTrackDTO
    {
        $getToken = new GetAccessTokenRequest()->send();
        $token = $getToken->json(key: 'access_token');
        $spotifyConnector = new SpotifyConnector($token);

        $request = new GetSearchTrackRequest();
        $request->query()->add(key: 'q', value: 'isrc:' . $isrc);
        $request->query()->add(key: 'limit', value: 1);

        $response = $spotifyConnector->send($request);
        /** @var TrackDTO|null $item */
        $item = collect($response->dto())->first();
        return $item?->toTrack($isrc);
    }
}
