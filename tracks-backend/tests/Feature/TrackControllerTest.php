<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrackControllerTest extends TestCase
{
   use RefreshDatabase;

    public function testStoreTrack()
    {
        $bodyData = 
        [
            'album_thumb' => 'https://example.com/album_thumb.jpg',
            'release_date' => '2023-07-01',
            'track_title' => 'Sample Track',
            'artists' => 'Artist 1, Artist 2',
            'duration' => '03:45',
            'audio_preview_url' => 'https://example.com/audio_preview.mp3',
            'spotify_track_url' => 'https://open.spotify.com/track/xyz123',
            'is_available_in_br' => true,
        ];

        $response = $this->postJson('http://127.0.0.1:8000/api/tracks', $bodyData);

        $response->assertStatus(201);

    }

    public function testFetchAllTracks()
    {
        \App\Models\Track::create([
            'album_thumb' => 'album_thumb',
            'release_date' => 'release_date',
            'track_title' => 'track_title',
            'artists' => ['artist1', 'artist2'],
            'duration' => 'duration',
            'audio_preview_url' => 'audio_preview_url',
            'spotify_track_url' => 'spotify_track_url',
            'is_available_in_br' => true,
        ]);

        $response = $this->getJson('http://127.0.0.1:8000/api/tracks');

        $response->assertStatus(200)
            ->assertJsonStructure([
                    [
                        "id",
                        "album_thumb",
                        "release_date",
                        "track_title",
                        "artists",
                        "duration",
                        "audio_preview_url",
                        "spotify_track_url",
                        "is_available_in_br"
                    ]
                
            ]);
    }


}
