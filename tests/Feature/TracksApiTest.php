<?php

use App\Models\{Album, Artist, Track};

describe('Tracks API Integration Tests', function () {
    describe('GET /api/tracks', function () {
        it('returns paginated tracks list', function () {
            $album = Album::factory()->create();

            $artist = Artist::factory()->create();

            $track = Track::factory()->create(['album_id' => $album->id]);

            $track->artists()->attach($artist);

            $response = $this->getJson('/api/tracks');

            $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        '*' => [
                            'id',
                            'isrc',
                            'spotify_id',
                            'name',
                            'duration',
                            'duration_ms',
                            'preview_url',
                            'spotify_url',
                            'thumb_url',
                            'available_in_brazil',
                            'created_at',
                            'updated_at',
                            'album',
                            'artists',
                        ],
                    ],
                    'links',
                    'meta',
                ]);
        });

        it('filters tracks by search parameter', function () {
            $album = Album::factory()->create();

            Track::factory()->create([
                'name'     => 'Bohemian Rhapsody',
                'album_id' => $album->id,
            ]);

            Track::factory()->create([
                'name'     => 'Stairway to Heaven',
                'album_id' => $album->id,
            ]);

            $response = $this->getJson('/api/tracks?search=Bohemian');

            $response->assertStatus(200)
                ->assertJsonCount(1, 'data')
                ->assertJsonPath('data.0.name', 'Bohemian Rhapsody');
        });

        it('filters tracks by ISRC', function () {
            $album = Album::factory()->create();

            Track::factory()->create([
                'isrc'     => 'GBUM71505078',
                'album_id' => $album->id,
            ]);

            Track::factory()->create([
                'isrc'     => 'USRC17607839',
                'album_id' => $album->id,
            ]);

            $response = $this->getJson('/api/tracks?search=GBUM');

            $response->assertStatus(200)
                ->assertJsonCount(1, 'data')
                ->assertJsonPath('data.0.isrc', 'GBUM71505078');
        });

        it('filters tracks by availability in Brazil', function () {
            $album = Album::factory()->create();

            Track::factory()->create([
                'available_in_br' => true,
                'album_id'        => $album->id,
            ]);

            Track::factory()->create([
                'available_in_br' => false,
                'album_id'        => $album->id,
            ]);

            $response = $this->getJson('/api/tracks?available_in_brazil=1');

            $response->assertStatus(200)
                ->assertJsonCount(1, 'data')
                ->assertJsonPath('data.0.available_in_brazil', true);
        });

        it('filters tracks by artist name', function () {
            $album = Album::factory()->create();

            $artist1 = Artist::factory()->create(['name' => 'Queen']);

            $artist2 = Artist::factory()->create(['name' => 'Pink Floyd']);

            $track1 = Track::factory()->create(['album_id' => $album->id]);

            $track2 = Track::factory()->create(['album_id' => $album->id]);

            $track1->artists()->attach($artist1);
            $track2->artists()->attach($artist2);

            $response = $this->getJson('/api/tracks?artist=Queen');

            $response->assertStatus(200)
                ->assertJsonCount(1, 'data')
                ->assertJsonPath('data.0.artists.0.name', 'Queen');
        });

        it('applies multiple filters', function () {
            $album = Album::factory()->create();

            $artist = Artist::factory()->create(['name' => 'Queen']);

            $track1 = Track::factory()->create([
                'name'            => 'Bohemian Rhapsody',
                'available_in_br' => true,
                'album_id'        => $album->id,
            ]);

            $track2 = Track::factory()->create([
                'name'            => 'Another One Bites the Dust',
                'available_in_br' => false,
                'album_id'        => $album->id,
            ]);

            $track1->artists()->attach($artist);
            $track2->artists()->attach($artist);

            $response = $this->getJson('/api/tracks?search=Bohemian&available_in_brazil=1&artist=Queen');

            $response->assertStatus(200)
                ->assertJsonCount(1, 'data')
                ->assertJsonPath('data.0.name', 'Bohemian Rhapsody')
                ->assertJsonPath('data.0.available_in_brazil', true)
                ->assertJsonPath('data.0.artists.0.name', 'Queen');
        });

        it('respects pagination parameters', function () {
            $album = Album::factory()->create();

            Track::factory()->count(25)->create(['album_id' => $album->id]);

            $response = $this->getJson('/api/tracks?per_page=5&page=2');

            $response->assertStatus(200)
                ->assertJsonCount(5, 'data')
                ->assertJsonPath('meta.current_page', 2)
                ->assertJsonPath('meta.per_page', 5);
        });

        it('respects sorting parameters', function () {
            $album = Album::factory()->create();

            Track::factory()->create([
                'name'     => 'A Song',
                'album_id' => $album->id,
            ]);

            Track::factory()->create([
                'name'     => 'Z Song',
                'album_id' => $album->id,
            ]);

            $response = $this->getJson('/api/tracks?sort=name&direction=desc');

            $response->assertStatus(200)
                ->assertJsonPath('data.0.name', 'Z Song')
                ->assertJsonPath('data.1.name', 'A Song');
        });

        it('returns validation errors for invalid parameters', function () {
            $response = $this->getJson('/api/tracks?per_page=150&sort=invalid_field&direction=invalid');

            $response->assertStatus(422)
                ->assertJsonValidationErrors(['per_page', 'sort', 'direction']);
        });

        it('returns empty result when no tracks match filters', function () {
            $album = Album::factory()->create();

            Track::factory()->create([
                'name'     => 'Existing Song',
                'album_id' => $album->id,
            ]);

            $response = $this->getJson('/api/tracks?search=NonExistentSong');

            $response->assertStatus(200)
                ->assertJsonCount(0, 'data');
        });

        it('includes album and artists relationships', function () {
            $album   = Album::factory()->create(['name' => 'Test Album']);
            $artist1 = Artist::factory()->create(['name' => 'Artist 1']);
            $artist2 = Artist::factory()->create(['name' => 'Artist 2']);

            $track = Track::factory()->create(['album_id' => $album->id]);
            $track->artists()->attach([$artist1->id, $artist2->id]);

            $response = $this->getJson('/api/tracks');

            $response->assertStatus(200)
                ->assertJsonPath('data.0.album.name', 'Test Album')
                ->assertJsonCount(2, 'data.0.artists')
                ->assertJsonPath('data.0.artists.0.name', 'Artist 1')
                ->assertJsonPath('data.0.artists.1.name', 'Artist 2');
        });
    });

    describe('GET /api/tracks/{track}', function () {
        it('returns a single track', function () {
            $album = Album::factory()->create();

            $artist = Artist::factory()->create();

            $track = Track::factory()->create([
                'name'     => 'Test Track',
                'isrc'     => 'TEST123456789',
                'album_id' => $album->id,
            ]);

            $track->artists()->attach($artist);

            $response = $this->getJson("/api/tracks/{$track->id}");

            $response->assertStatus(200)
                ->assertJsonStructure([
                    'data' => [
                        'id',
                        'isrc',
                        'spotify_id',
                        'name',
                        'duration',
                        'duration_ms',
                        'preview_url',
                        'spotify_url',
                        'thumb_url',
                        'available_in_brazil',
                        'created_at',
                        'updated_at',
                        'album',
                        'artists',
                    ],
                ])
                ->assertJsonPath('data.name', 'Test Track')
                ->assertJsonPath('data.isrc', 'TEST123456789');
        });

        it('includes album and artists relationships', function () {
            $album = Album::factory()->create(['name' => 'Test Album']);

            $artist1 = Artist::factory()->create(['name' => 'Artist 1']);

            $artist2 = Artist::factory()->create(['name' => 'Artist 2']);

            $track = Track::factory()->create(['album_id' => $album->id]);

            $track->artists()->attach([$artist1->id, $artist2->id]);

            $response = $this->getJson("/api/tracks/{$track->id}");

            $response->assertStatus(200)
                ->assertJsonPath('data.album.name', 'Test Album')
                ->assertJsonCount(2, 'data.artists')
                ->assertJsonPath('data.artists.0.name', 'Artist 1')
                ->assertJsonPath('data.artists.1.name', 'Artist 2');
        });

        it('returns 404 for non-existent track', function () {
            $response = $this->getJson('/api/tracks/999999');

            $response->assertStatus(404);
        });

        it('returns correct duration format', function () {
            $album = Album::factory()->create();

            $track = Track::factory()->create([
                'duration_ms' => 180000, // 3 minutes
                'album_id'    => $album->id,
            ]);

            $response = $this->getJson("/api/tracks/{$track->id}");

            $response->assertStatus(200)
                ->assertJsonPath('data.duration', '03:00')
                ->assertJsonPath('data.duration_ms', 180000);
        });
    });

    describe('API Response Format', function () {
        it('returns correct JSON structure for track resource', function () {
            $album = Album::factory()->create();

            $artist = Artist::factory()->create();

            $track = Track::factory()->create([
                'isrc'            => 'TEST123456789',
                'spotify_id'      => 'spotify123',
                'name'            => 'Test Track',
                'duration_ms'     => 240000,
                'preview_url'     => 'https://example.com/preview.mp3',
                'spotify_url'     => 'https://open.spotify.com/track/123',
                'thumb_url'       => 'https://example.com/thumb.jpg',
                'available_in_br' => true,
                'album_id'        => $album->id,
            ]);

            $track->artists()->attach($artist);

            $response = $this->getJson("/api/tracks/{$track->id}");

            $response->assertStatus(200)
                ->assertJsonPath('data.id', $track->id)
                ->assertJsonPath('data.isrc', 'TEST123456789')
                ->assertJsonPath('data.spotify_id', 'spotify123')
                ->assertJsonPath('data.name', 'Test Track')
                ->assertJsonPath('data.duration', '04:00')
                ->assertJsonPath('data.duration_ms', 240000)
                ->assertJsonPath('data.preview_url', 'https://example.com/preview.mp3')
                ->assertJsonPath('data.spotify_url', 'https://open.spotify.com/track/123')
                ->assertJsonPath('data.thumb_url', 'https://example.com/thumb.jpg')
                ->assertJsonPath('data.available_in_brazil', true)
                ->assertJson([
                    'data' => [
                        'created_at' => $track->created_at->toISOString(),
                        'updated_at' => $track->updated_at->toISOString(),
                    ],
                ]);
        });
    });
});
