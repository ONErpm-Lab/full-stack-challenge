<?php

namespace App\Services\Spotify;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SpotifyClient
{
    protected string $baseUri;

    public function __construct()
    {
        $this->baseUri = config('services.spotify.base_uri');
    }

    public function request(): PendingRequest
    {
        return Http::baseUrl($this->baseUri)
            ->withToken($this->getToken());
    }

    private function getToken(): string
    {
        return Cache::remember('spotify_token', 3600, function () {
            $response = Http::asForm()->post("https://accounts.spotify.com/api/token", [
                'grant_type' => 'client_credentials',
                'client_id' => config('services.spotify.client_id'),
                'client_secret' => config('services.spotify.client_secret'),
            ]);

            return $response->json('access_token');
        });
    }
}
