<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Services\SpotifyService;

class SpotifyServiceTest extends TestCase
{

    public function test_search_returns_track_data()
    {
        $service = new SpotifyService();
        $result = $service->searchByIsrc('US7QQ1846811'); 

        $this->assertIsArray($result);
        $this->assertArrayHasKey('tracks', $result);
    }

}
