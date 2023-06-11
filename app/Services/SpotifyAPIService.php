<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;

class SpotifyAPIService
{
    private string $clientId;
    private string $clientSecret;

    public function __construct()
    {
        $this->clientId = env('SPOTIFY_CLIENT_ID');
        $this->clientSecret = env('SPOTIFY_CLIENT_SECRET');
    }

    public function search(array $params)
    {
        $query = http_build_query($params);
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->getToken()
        ])->get(env('SPOTIFY_SEARCH_URL') . '?' . $query);
        return $this->parseData($response->json('tracks'));
    }

    private function parseData($data): array
    {
        return isset($data['items']) && !empty($data['items']) ? [
            'isrc' => $data['items'][0]['external_ids']['isrc'],
            'album' => [
                'title' => $data['items'][0]['album']['name'],
                'cover' => $data['items'][0]['album']['images'][0]['url'],
                'release_date' => $data['items'][0]['album']['release_date'],
                'external_url' => $data['items'][0]['album']['external_urls']['spotify'],
                'artists' => array_map(fn ($artist) => $artist['name'], $data['items'][0]['album']['artists']),
            ],
            'title' => $data['items'][0]['name'],
            'artists' => array_map(fn ($artist) => $artist['name'], $data['items'][0]['artists']),
            'duration' => $data['items'][0]['duration_ms'],
            'external_url' => $data['items'][0]['external_urls']['spotify'],
            'br_enabled' => in_array('BR', $data['items'][0]['available_markets']),
            'preview_url' => $data['items'][0]['preview_url']
        ] : [];
    }

    private function getToken()
    {
        return Cache::remember('SPOTIFY_TOKEN', env('SPOTIFY_TOKEN_TIME'), function () {
            $response = Http::asForm()->post(env('SPOTIFY_AUTH_URL'), [
                'grant_type' => 'client_credentials',
                'client_id' => $this->clientId,
                'client_secret' => $this->clientSecret
            ]);
            if ($response->failed()) $response->throw()->json();
            return $response->json('access_token');
        });
    }
}
