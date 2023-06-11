<?php

namespace Tests\Feature;

use App\Entities\Track;
use App\Factories\TrackFactory;
use App\Repositories\TrackRepository;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TrackRepositoryTest extends TestCase
{
    use DatabaseMigrations;

    private TrackRepository $repository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->repository = new TrackRepository();
    }

    public function test_it_can_save_a_track()
    {
        $track = TrackFactory::create();
        $savedTrack = $this->repository->save($track);

        $this->assertInstanceOf(Track::class, $track);
        $this->assertNotNull($savedTrack->id());
        $this->assertEquals($track->isrc, $savedTrack->isrc);
    }

    public function test_it_can_list_tracks()
    {
        $totalInserts = 5;
        for ($i=0; $i < $totalInserts; $i++) { 
            $track = TrackFactory::create();
            $track->save();
        }
        $tracks = $this->repository->list();

        $this->assertNotEmpty($tracks);
        $this->assertEquals(count($tracks), $totalInserts);
    }
}
