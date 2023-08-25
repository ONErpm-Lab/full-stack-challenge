<?php

namespace Tests\Unit;

use App\Http\Controllers\TrackController;
use App\Services\TrackInfoService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Client;
use App\Services\TokenService;

class TrackInfoServiceTest extends TestCase
{
    public function testGetByIsrcCode(): void
    {
        $tokenService = $this->createMock(TokenService::class);
        $tokenService->expects($this->once())->method('getAccessToken')->willReturn('test_access_token');

         $spotifyPayload = [
            'tracks' => [
                'items' => [
                    [
                        'album' => [
                            'images' => [
                                ['url' => 'https://example.com/album1.jpg'],
                            ],
                            'release_date' => '2022-01-15',
                        ],
                        'name' => 'Song Title 1',
                        'artists' => [
                            ['name' => 'Artist 1'],
                            ['name' => 'Artist 2']
                        ],
                        'duration_ms' => '225000',
                        'preview_url' => 'https://example.com/preview1.mp3',
                        'external_urls' => [
                            'spotify' => 'https://open.spotify.com/track/abc123',
                        ],
                        'available_markets' => ['BR'],
                    ],
                ],
            ],
        ];

        $isrcCode = 'abc123';

        $mockHandler = new MockHandler([
            new Response(200, [], json_encode($spotifyPayload)),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $trackInfoService = new TrackInfoService($httpClient, $tokenService);

        $expectedResult = [
            'album_thumb' => 'https://example.com/album1.jpg',
            'release_date' => '2022-01-15',
            'track_title' => 'Song Title 1',
            'artists' => 'Artist 1, Artist 2',
            'duration' => '03:45',
            'audio_preview_url' => 'https://example.com/preview1.mp3',
            'spotify_track_url' => 'https://open.spotify.com/track/abc123',
            'is_available_in_br' => true,
        ];

        $formattedTrack = $trackInfoService->getByIsrcCode($isrcCode);

        $this->assertEquals($expectedResult, $formattedTrack);
    }

}