<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Middleware\ApiTokenMiddleware;
use App\Models\Track;
use App\Models\Artist;
use App\Models\Image;

class TrackApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_tracks_unauthorized(): void
    {
        $response = $this->getJson('v1/tracks');
        $response->assertStatus(401);
    }

    public function test_get_tracks_ok_empty(): void
    {
        $response = $this
            ->withoutMiddleware(ApiTokenMiddleware::class)
            ->getJson('v1/tracks');

        $response->assertStatus(200);
        $response->assertJsonCount(count: 0, key: 'data');
    }

    public function test_get_tracks_structure(): void
    {
        Track::factory()
            ->has(Artist::factory(), 'artists')
            ->has(Image::factory(), 'images')
            ->create();

        $response = $this
            ->withoutMiddleware(ApiTokenMiddleware::class)
            ->getJson('v1/tracks');

        $response->assertStatus(200);
        $response->assertJsonCount(count: 1, key: 'data');
        $response->assertJsonStructure(
            structure: [
                'total',
                'current_page',
                'last_page',
                'data' => [
                    [
                        'durationFormatted',
                        'name',
                        'releaseDate',
                        'releaseDatePrecision',
                        'durationMs',
                        'externalUrl',
                        'previewUrl',
                        'isPlayable',
                        'artists' => [
                            [
                                'name',
                            ]
                        ],
                        'images' => [
                            [
                                'height',
                                'width',
                                'url',
                            ]
                        ],
                    ],
                ],
            ]
        );
    }

    public function test_get_tracks_sorted_by_name(): void
    {
        /** @var Collection<int,Track> $tracks */
        $tracks = Track::factory(3)
            ->has(Artist::factory(), 'artists')
            ->has(Image::factory(), 'images')
            ->create();

        $sorted = $tracks->sortBy('name')->values();

        $response = $this
            ->withoutMiddleware(ApiTokenMiddleware::class)
            ->getJson('v1/tracks');

        $response->assertStatus(200);
        $response->assertJsonCount(count: 3, key: 'data');
        $response->assertJsonPath('data.0.name', $sorted[0]->name);
        $response->assertJsonPath('data.1.name', $sorted[1]->name);
        $response->assertJsonPath('data.2.name', $sorted[2]->name);
    }
}
