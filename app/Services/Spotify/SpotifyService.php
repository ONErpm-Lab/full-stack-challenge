<?php

namespace App\Services\Spotify;

use App\Services\Spotify\Endpoints\Search;

class SpotifyService
{
    protected SpotifyClient $client;

    public function __construct()
    {
        $this->client = new SpotifyClient();
    }

    public function search(): Search
    {
        return new Search($this->client);
    }
}
