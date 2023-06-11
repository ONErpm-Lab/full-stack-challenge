<?php

namespace Tests\Feature;

use App\Adapters\SpotifyAPIAdatpter;
use App\Repositories\TrackRepository;
use App\Services\TrackService;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrackServiceTest extends TestCase
{
    use DatabaseMigrations;

    private TrackService $service;

    protected function setUp(): void
    {
        parent::setUp();
        $this->service = new TrackService(app(TrackRepository::class), app(SpotifyAPIAdatpter::class));
    }

    public function test_it_can_get_track_from_streaming_service()
    {
        $isrc = 'BRC310600002';
        $trackData = $this->service->getFromSpotify($isrc);
        $this->assertNotEmpty($trackData);
    }

    public function test_it_can_store_track()
    {
        $isrc = 'BRC310600002';
        $trackData = $this->service->getFromSpotify($isrc);

        $track = $this->service->store($trackData);

        $this->assertNotNull($track->id());
        $this->assertEquals($trackData['isrc'], $track->isrc);
    }

}
