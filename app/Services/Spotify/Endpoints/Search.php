<?php

namespace App\Services\Spotify\Endpoints;

use App\Services\Spotify\SpotifyClient;

class Search
{
    protected string $path = '/search';

    public function __construct(
        protected SpotifyClient $client
    ) {
    }

    public function searchTracksByIsrc(string $query, array $options = []): array
    {
        return $this->client->request()
            ->get($this->path, [
                'q'    => "isrc:{$query}",
                'type' => 'track',
                ...$options,
            ])
            ->throw()
            ->json('tracks.items');
    }
}
