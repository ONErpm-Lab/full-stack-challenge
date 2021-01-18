<?php

namespace Tests\Feature;

use Artisan;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SongListTest extends TestCase
{
    var $get_songs = '/api/get-songs';
    public function setUp() :void
    {
        parent::setUp();
        Artisan::call('migrate:fresh');
        Artisan::call('db:seed');
    }

    /**
     * tests successful call of the listing of songs
     *
     * @return void
     */
    public function test_successful_call()
    {
        
        $response = $this->get($this->get_songs);

        $response->assertStatus(200);
    }

    /**
     * tests that all songs have the required information
     *
     * @return void
     */
    public function test_songs_have_required_information()
    {
        
        $response = $this->get($this->get_songs);
        $response = json_decode($response->content(), true)['data'];
        foreach  ($response as $song) {
            $this->assertNotNull($song['album_cover']);
            $this->assertNotNull($song['isrc']);
            $this->assertNotNull($song['release_date']);
            $this->assertNotNull($song['title']);
            $this->assertNotNull($song['duration']);
            $this->assertNotNull($song['preview_link']);
            $this->assertNotNull($song['spotify_link']);
            $this->assertNotNull($song['brasil_available']);
            $this->assertNotNull($song['artists']);
            $this->assertTrue(count($song['artists'])>0);
        }
        
    }
}
