<?php

use App\Console\Commands\ImportIsrcList;
use App\Models\{Album, Artist, Track};
use App\Services\Spotify\Endpoints\Search;
use App\Services\Spotify\Spotify;
use Illuminate\Support\Facades\Log;

beforeEach(function () {
    $this->searchMock  = Mockery::mock(Search::class);
    $this->spotifyMock = Mockery::mock();
    $this->spotifyMock->shouldReceive('search')->andReturn($this->searchMock);

    Spotify::swap($this->spotifyMock);
});

describe('ImportIsrcList Command', function () {
    it('can handle command with default ISRCs successfully', function () {
        $this->searchMock
            ->shouldReceive('searchTracksByIsrc')
            ->times(10)
            ->andReturnUsing(function ($isrc) {
                static $counter = 0;
                $counter++;

                return [[
                    'id'                => "spotify_track_id_{$counter}",
                    'name'              => "Test Track {$counter}",
                    'duration_ms'       => 180000,
                    'preview_url'       => 'https://preview.spotify.url',
                    'external_urls'     => ['spotify' => 'https://spotify.url'],
                    'available_markets' => ['BR', 'US'],
                    'album'             => [
                        'id'                     => "spotify_album_id_{$counter}",
                        'name'                   => "Test Album {$counter}",
                        'release_date'           => '2023-01-01',
                        'release_date_precision' => 'day',
                        'images'                 => [['url' => 'https://album.image.url']],
                        'external_urls'          => ['spotify' => 'https://album.spotify.url'],
                    ],
                    'artists' => [
                        [
                            'id'            => "spotify_artist_id_{$counter}",
                            'name'          => "Test Artist {$counter}",
                            'external_urls' => ['spotify' => 'https://artist.spotify.url'],
                        ],
                    ],
                ]];
            });

        Log::shouldReceive('error')->never();

        $this->artisan('spotify:import-tracks')
            ->expectsOutput('Starting import of 10 ISRC codes...')
            ->expectsOutput('Import completed!')
            ->assertExitCode(0);

        expect(Track::query()->count())->toBe(10)
            ->and(Album::query()->count())->toBe(10)
            ->and(Artist::query()->count())->toBe(10);
    });

    it('can handle command with specific ISRCs', function () {
        $customIsrcs = ['US7VG1846811', 'US7QQ1846811'];

        $mockTrackData = [
            'id'                => 'spotify_track_id_123',
            'name'              => 'Test Track',
            'duration_ms'       => 180000,
            'preview_url'       => 'https://preview.url',
            'external_urls'     => ['spotify' => 'https://spotify.url'],
            'available_markets' => ['BR', 'US'],
            'album'             => [
                'id'                     => 'spotify_album_id_123',
                'name'                   => 'Test Album',
                'release_date'           => '2023-01-01',
                'release_date_precision' => 'day',
                'images'                 => [['url' => 'https://album.image.url']],
                'external_urls'          => ['spotify' => 'https://album.spotify.url'],
            ],
            'artists' => [
                [
                    'id'            => 'spotify_artist_id_123',
                    'name'          => 'Test Artist',
                    'external_urls' => ['spotify' => 'https://artist.spotify.url'],
                ],
            ],
        ];

        $this->searchMock
            ->shouldReceive('searchTracksByIsrc')
            ->twice()
            ->andReturn([$mockTrackData]);

        $this->artisan('spotify:import-tracks', ['--isrc' => $customIsrcs])
            ->expectsOutput('Starting import of 2 ISRC codes...')
            ->expectsOutput('Import completed!')
            ->assertExitCode(0);

        expect(Track::query()->count())->toBe(2);
    });

    it('handles tracks not found on Spotify', function () {
        $this->searchMock
            ->shouldReceive('searchTracksByIsrc')
            ->andReturn([]);

        $this->artisan('spotify:import-tracks', ['--isrc' => ['NOTFOUND123']])
            ->expectsOutput('Starting import of 1 ISRC codes...')
            ->expectsOutput('Import completed!')
            ->assertExitCode(0);

        expect(Track::query()->count())->toBe(0);
    });

    it('handles existing tracks by skipping them', function () {
        Track::factory()->create(['isrc' => 'EXISTING123']);

        $this->searchMock
            ->shouldReceive('searchTracksByIsrc')
            ->never();

        $this->artisan('spotify:import-tracks', ['--isrc' => ['EXISTING123']])
            ->expectsOutput('Starting import of 1 ISRC codes...')
            ->expectsOutput('Import completed!')
            ->assertExitCode(0);

        expect(Track::query()->count())->toBe(1);
    });

    it('handles Spotify API exceptions', function () {
        $this->searchMock
            ->shouldReceive('searchTracksByIsrc')
            ->andThrow(new Exception('Spotify API Error'));

        Log::shouldReceive('error')->never();

        $this->artisan('spotify:import-tracks', ['--isrc' => ['EXCEPTION123']])
            ->expectsOutput('Starting import of 1 ISRC codes...')
            ->expectsOutput('Import completed!')
            ->assertExitCode(0);

        expect(Track::query()->count())->toBe(0);
    });
});

describe('ImportIsrcList Private Methods', function () {
    beforeEach(function () {
        $this->command = new ImportIsrcList();
    });

    it('creates new album when not exists', function () {
        $albumData = [
            'id'                     => 'new_album_id',
            'name'                   => 'New Album',
            'release_date'           => '2023-01-01',
            'release_date_precision' => 'day',
            'images'                 => [['url' => 'https://image.url']],
            'external_urls'          => ['spotify' => 'https://spotify.url'],
        ];

        $reflection = new ReflectionClass($this->command);
        $method     = $reflection->getMethod('createOrFindAlbum');
        $method->setAccessible(true);

        $album = $method->invoke($this->command, $albumData);

        expect($album)->toBeInstanceOf(Album::class)
            ->and($album->spotify_id)->toBe('new_album_id')
            ->and($album->name)->toBe('New Album')
            ->and(Album::query()->count())->toBe(1);
    });

    it('finds existing album when already exists', function () {
        $existingAlbum = Album::factory()->create(['spotify_id' => 'existing_album_id']);

        $albumData = [
            'id'                     => 'existing_album_id',
            'name'                   => 'Updated Album Name',
            'release_date'           => '2023-01-01',
            'release_date_precision' => 'day',
            'images'                 => [['url' => 'https://image.url']],
            'external_urls'          => ['spotify' => 'https://spotify.url'],
        ];

        $reflection = new ReflectionClass($this->command);
        $method     = $reflection->getMethod('createOrFindAlbum');
        $method->setAccessible(true);

        $album = $method->invoke($this->command, $albumData);

        expect($album->id)->toBe($existingAlbum->id)
            ->and($album->name)->toBe($existingAlbum->name)
            ->and(Album::query()->count())->toBe(1);
    });

    it('attaches artists to track correctly', function () {
        $track = Track::factory()->create();

        $artistsData = [
            [
                'id'            => 'artist_1',
                'name'          => 'Artist One',
                'external_urls' => ['spotify' => 'https://artist1.url'],
            ],
            [
                'id'            => 'artist_2',
                'name'          => 'Artist Two',
                'external_urls' => ['spotify' => 'https://artist2.url'],
            ],
        ];

        $reflection = new ReflectionClass($this->command);
        $method     = $reflection->getMethod('attachArtists');
        $method->setAccessible(true);

        $method->invoke($this->command, $track, $artistsData);

        expect($track->artists()->count())->toBe(2)
            ->and(Artist::query()->count())->toBe(2);

        $artists = $track->artists;

        expect($artists->pluck('spotify_id')->toArray())->toContain('artist_1', 'artist_2');
    });

    it('reuses existing artists when attaching to track', function () {
        $existingArtist = Artist::factory()->create(['spotify_id' => 'existing_artist']);
        $track          = Track::factory()->create();

        $artistsData = [
            [
                'id'            => 'existing_artist',
                'name'          => 'Updated Artist Name',
                'external_urls' => ['spotify' => 'https://artist.url'],
            ],
        ];

        $reflection = new ReflectionClass($this->command);
        $method     = $reflection->getMethod('attachArtists');
        $method->setAccessible(true);

        $method->invoke($this->command, $track, $artistsData);

        expect($track->artists()->count())->toBe(1)
            ->and(Artist::count())->toBe(1)
            ->and($track->artists->first()->id)->toBe($existingArtist->id)
            ->and($track->artists->first()->name)->toBe($existingArtist->name);
    });

    it('correctly identifies tracks available in Brazil', function () {
        $trackDataWithBrazil = [
            'available_markets' => ['US', 'BR', 'CA'],
        ];

        $trackDataWithoutBrazil = [
            'available_markets' => ['US', 'CA', 'UK'],
        ];

        $trackDataNoMarkets = [
            'available_markets' => null,
        ];

        $reflection = new ReflectionClass($this->command);
        $method     = $reflection->getMethod('isAvailableInBrazil');
        $method->setAccessible(true);

        expect($method->invoke($this->command, $trackDataWithBrazil))->toBeTrue()
            ->and($method->invoke($this->command, $trackDataWithoutBrazil))->toBeFalse()
            ->and($method->invoke($this->command, $trackDataNoMarkets))->toBeFalse();
    });

    it('handles missing optional fields gracefully', function () {
        $albumData = [
            'id'   => 'minimal_album_id',
            'name' => 'Minimal Album',
        ];

        $reflection = new ReflectionClass($this->command);
        $method     = $reflection->getMethod('createOrFindAlbum');
        $method->setAccessible(true);

        $album = $method->invoke($this->command, $albumData);

        expect($album)->toBeInstanceOf(Album::class)
            ->and($album->spotify_id)->toBe('minimal_album_id')
            ->and($album->name)->toBe('Minimal Album')
            ->and($album->release_date)->toBeNull()
            ->and($album->release_date_precision)->toBeNull();
    });
});
