<?php

namespace Tests\Unit;

use App\Services\SpotifyService;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SpotifyServiceTest extends TestCase
{
    public function test_get_access_token_returns_token()
    {
        Http::fake([
            'https://accounts.spotify.com/*' => Http::response([
                'access_token' => 'fake-access-token',
                'token_type' => 'Bearer',
                'expires_in' => 3600,
            ], 200)
        ]);

        $service = new SpotifyService();
        $token = $service->getAccessToken();

        $this->assertEquals('fake-access-token', $token);
    }

    public function test_search_track_by_isrc_returns_data()
    {
        Http::fake([
            'https://accounts.spotify.com/*' => Http::response([
                'access_token' => 'fake-access-token',
            ], 200),

            'https://api.spotify.com/v1/search*' => Http::response([
                'tracks' => [
                    'items' => [
                        ['id' => 'track123', 'name' => 'Test Track'],
                    ],
                ],
            ], 200),
        ]);

        $service = new SpotifyService();
        $result = $service->searchTrackByISRC('US7VG1846811');

        $this->assertIsArray($result);
        $this->assertArrayHasKey('tracks', $result);
        $this->assertEquals('track123', $result['tracks']['items'][0]['id']);
    }
}
