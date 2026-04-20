<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SpotifyControllerTest extends TestCase
{
    use RefreshDatabase;
    public function test_api_returns_track_data()
    {
        $response = $this->withoutMiddleware()
                        ->getJson('/api/spotify/track/US7QQ1846811');
                        
        $response->assertStatus(200);
        $response->assertJsonStructure(['name', 'artists', 'album']);
    }

}
