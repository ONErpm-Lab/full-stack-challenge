<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class SpotifyService
{
    private $token;

    public function __construct()
    {
        $this->authenticate();
    }

    private function authenticate()
    {
        $response = Http::withHeaders([
            'Authorization' => 'Basic ' . base64_encode(
                env('SPOTIFY_CLIENT_ID') . ':' . env('SPOTIFY_CLIENT_SECRET')
            ),
        ])->asForm()->post('https://accounts.spotify.com/api/token', [
            'grant_type' => 'client_credentials',
        ]);

        $this->token = $response->json()['access_token'];
    }

    public function searchByISRC($isrc)
    {
        $response = Http::withToken($this->token)
            ->get('https://api.spotify.com/v1/search', [
                'q' => 'isrc:' . $isrc,
                'type' => 'track',
                'limit' => 1
            ]);

        return $response->json();
    }
}
