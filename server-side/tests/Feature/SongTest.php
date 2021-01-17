<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Song;
use Mockery;
use Mockery\MockInterface;

class SongTest extends TestCase
{
  use RefreshDatabase;

  public function test_song_integration()
  {
    // TODO: Here we should create a mock for SpotifyWebAPI::search. For now,
    //       let's just rely on the Spotify API being available while testing
    //

    // Verify that the song DB table is initially empty.
    $this->assertDatabaseCount('songs', 0);

    // Get the list of songs and make sure they are correct
    $response = $this->get('/');
    //$response->dump();
    $response->assertStatus(200);

    $data = $response->original;
    $this->assertEquals(9, count($data));
    $this->assertEquals("Facada", $data[0]->title);
    $this->assertEquals("DJ Malibu, MC Pack, MC Gui Andrade", $data[6]->artists);

    // Make sure the song details were inserted in the database. Fetch the
    // songs again and assert correct fields.
    $this->assertDatabaseCount('songs', 9);

    $response = $this->get('/');
    $response->assertStatus(200);
    
    $data = $response->original;
    $this->assertEquals(9, count($data));
    $this->assertEquals("Facada", $data[0]->title);
    $this->assertEquals("DJ Malibu, MC Pack, MC Gui Andrade", $data[6]->artists);
  }
}
