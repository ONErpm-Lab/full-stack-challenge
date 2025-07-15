<?php

namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;

class SpotifyService
{
    public function getAccessToken()
    {
        return Cache::remember('spotify_token', 3500, function () {
            $response = Http::asForm()->withBasicAuth(
                config('services.spotify.client_id'),
                config('services.spotify.client_secret')
            )->post(config('services.spotify.token_url'), [
                'grant_type' => 'client_credentials',
            ]);

            return $response->json()['access_token'];
        });
    }

    public function searchTrackByISRC(string $isrc)
    {
        $token = $this->getAccessToken();

        $response = Http::withToken($token)->throw()->get('https://api.spotify.com/v1/search', [
            'q' => 'isrc:' . $isrc,
            'type' => 'track',
        ]);

        if ($response->failed()) {
            return json_encode([]);
        }

        return $response->json();
    }
}
