<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class DeezerAPIService
{
    public function __construct()
    {
    }

    public function search(string $query)
    {
        $response = Http::get(env('DEEZER_SEARCH_URL') . '/' . $query);
        return $this->parseData($response->json());
    }

    private function parseData($data): array
    {
        return array_key_exists('error', $data) ? [] : [
            'isrc' => $data['isrc'],
            'album' => [
                'title' => $data['album']['title'],
                'cover' => $data['album']['cover'],
                'release_date' => $data['album']['release_date'],
                'external_url' => $data['album']['link'],
                'artists' => array_map(fn ($artist) => $artist['name'], $data['contributors']),
            ],
            'title' => $data['title'],
            'artists' => [$data['artist']['name']],
            'duration' => $data['duration'] * 1000,
            'external_url' => $data['link'],
            'br_enabled' => in_array('BR', $data['available_countries']),
            'preview_url' => $data['preview']
        ];
    }
}
