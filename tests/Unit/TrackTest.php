<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Track;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TrackTest extends TestCase
{
    use RefreshDatabase;

    public function it_can_create_a_track()
    {
        $track = Track::create([
            'title' => 'Test Song',
            'isrc' => 'USRC17607839'
        ]);

        $this->assertDatabaseHas('tracks', [
            'title' => 'Test Song',
            'isrc' => 'USRC17607839'
        ]);
    }
}
