<?php

namespace App\Services;

use GuzzleHttp\Client;

class TrackInfoService
{   

    public function __construct(
        private Client $client,
        private TokenService $tokenService
    ) {
    }

    public function getByIsrcCode(string $isrcCode): array
    {
        $accessToken = $this->tokenService->getAccessToken();

        $response = $this->client->get("https://api.spotify.com/v1/search?type=track&q=isrc:" . $isrcCode, [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
            ],
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new Exception("Error Processing Request");
        } 
        $data = json_decode($response->getBody()->getContents(), true);
        $trackInfo = $this->formatData($data);
        return $trackInfo;
    }

    private function formatData(array $data): array
    {

        if (empty($data['tracks']['items'])) {
            return [];
        }
        $album = $data['tracks']['items'][0]['album'];
        $track = $data['tracks']['items'][0];
        
        $formattedTrackInfo = [
            'album_thumb' => $album['images'][0]['url'],
            'release_date' => $album['release_date'],
            'track_title' => $track['name'],
            'artists' => collect($track['artists'])->pluck('name')->implode(', '),
            'duration' => gmdate('i:s', $track['duration_ms'] / 1000),
            'audio_preview_url' => $track['preview_url'],
            'spotify_track_url' => $track['external_urls']['spotify'],
            'is_available_in_br' => in_array('BR', $track['available_markets']),
        ];

        return $formattedTrackInfo;
    }
}
