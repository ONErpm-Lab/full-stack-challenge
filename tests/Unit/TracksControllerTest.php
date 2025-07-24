<?php

use App\Http\Controllers\Api\TracksController;
use App\Http\Requests\TrackSearchRequest;
use App\Http\Resources\TrackResource;
use App\Models\{Album, Artist, Track};
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Pagination\LengthAwarePaginator;

beforeEach(function () {
    $this->controller = new TracksController();
});

describe('TracksController Unit Tests', function () {
    describe('index method', function () {
        it('returns paginated tracks with default parameters', function () {
            $album = Album::factory()->create();

            $artist = Artist::factory()->create();

            $track = Track::factory()->create(['album_id' => $album->id]);

            $track->artists()->attach($artist);

            $request = Mockery::mock(TrackSearchRequest::class);
            $request->shouldReceive('getSearch')->andReturn(null);
            $request->shouldReceive('getAvailableInBrazil')->andReturn(null);
            $request->shouldReceive('getArtist')->andReturn(null);
            $request->shouldReceive('getSort')->andReturn('name');
            $request->shouldReceive('getDirection')->andReturn('asc');
            $request->shouldReceive('getPerPage')->andReturn(15);

            $result = $this->controller->index($request);

            expect($result)->toBeInstanceOf(AnonymousResourceCollection::class)
                ->and($result->resource)->toBeInstanceOf(LengthAwarePaginator::class);
        });

        it('filters tracks by search term in name', function () {
            $album = Album::factory()->create();

            Track::factory()->create([
                'name'     => 'Comfortably Numb',
                'album_id' => $album->id,
            ]);

            Track::factory()->create([
                'name'     => 'Another Song',
                'album_id' => $album->id,
            ]);

            $request = Mockery::mock(TrackSearchRequest::class);
            $request->shouldReceive('getSearch')->andReturn('Numb');
            $request->shouldReceive('getAvailableInBrazil')->andReturn(null);
            $request->shouldReceive('getArtist')->andReturn(null);
            $request->shouldReceive('getSort')->andReturn('name');
            $request->shouldReceive('getDirection')->andReturn('asc');
            $request->shouldReceive('getPerPage')->andReturn(15);

            $result = $this->controller->index($request);

            expect($result->resource->items())->toHaveCount(1)
                ->and($result->resource->items()[0]->name)->toBe('Comfortably Numb');
        });

        it('filters tracks by search term in isrc', function () {
            $album = Album::factory()->create();

            Track::factory()->create([
                'isrc'     => 'TEST123456789',
                'album_id' => $album->id,
            ]);

            Track::factory()->create([
                'isrc'     => 'ANOTHER123456',
                'album_id' => $album->id,
            ]);

            $request = Mockery::mock(TrackSearchRequest::class);
            $request->shouldReceive('getSearch')->andReturn('TEST');
            $request->shouldReceive('getAvailableInBrazil')->andReturn(null);
            $request->shouldReceive('getArtist')->andReturn(null);
            $request->shouldReceive('getSort')->andReturn('name');
            $request->shouldReceive('getDirection')->andReturn('asc');
            $request->shouldReceive('getPerPage')->andReturn(15);

            $result = $this->controller->index($request);

            expect($result->resource->items())->toHaveCount(1)
                ->and($result->resource->items()[0]->isrc)->toBe('TEST123456789');
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

            $request = Mockery::mock(TrackSearchRequest::class);
            $request->shouldReceive('getSearch')->andReturn(null);
            $request->shouldReceive('getAvailableInBrazil')->andReturn(true);
            $request->shouldReceive('getArtist')->andReturn(null);
            $request->shouldReceive('getSort')->andReturn('name');
            $request->shouldReceive('getDirection')->andReturn('asc');
            $request->shouldReceive('getPerPage')->andReturn(15);

            $result = $this->controller->index($request);

            expect($result->resource->items())->toHaveCount(1)
                ->and($result->resource->items()[0]->available_in_br)->toBeTrue();
        });

        it('filters tracks by artist name', function () {
            $album = Album::factory()->create();

            $artist1 = Artist::factory()->create(['name' => 'Pink Floyd']);

            $artist2 = Artist::factory()->create(['name' => 'Coldplay']);

            $track1 = Track::factory()->create(['album_id' => $album->id]);

            $track2 = Track::factory()->create(['album_id' => $album->id]);

            $track1->artists()->attach($artist1);
            $track2->artists()->attach($artist2);

            $request = Mockery::mock(TrackSearchRequest::class);
            $request->shouldReceive('getSearch')->andReturn(null);
            $request->shouldReceive('getAvailableInBrazil')->andReturn(null);
            $request->shouldReceive('getArtist')->andReturn('Floyd');
            $request->shouldReceive('getSort')->andReturn('name');
            $request->shouldReceive('getDirection')->andReturn('asc');
            $request->shouldReceive('getPerPage')->andReturn(15);

            $result = $this->controller->index($request);

            expect($result->resource->items())->toHaveCount(1)
                ->and($result->resource->items()[0]->artists->first()->name)->toBe('Pink Floyd');
        });

        it('applies multiple filters simultaneously', function () {
            $album = Album::factory()->create();

            $artist = Artist::factory()->create(['name' => 'Pink Floyd']);

            $track1 = Track::factory()->create([
                'name'            => 'Comfortably Numb',
                'available_in_br' => true,
                'album_id'        => $album->id,
            ]);

            $track2 = Track::factory()->create([
                'name'            => 'Paradise',
                'available_in_br' => false,
                'album_id'        => $album->id,
            ]);

            $track1->artists()->attach($artist);
            $track2->artists()->attach($artist);

            $request = Mockery::mock(TrackSearchRequest::class);
            $request->shouldReceive('getSearch')->andReturn('Comfortably');
            $request->shouldReceive('getAvailableInBrazil')->andReturn(true);
            $request->shouldReceive('getArtist')->andReturn('Pink Floyd');
            $request->shouldReceive('getSort')->andReturn('name');
            $request->shouldReceive('getDirection')->andReturn('asc');
            $request->shouldReceive('getPerPage')->andReturn(15);

            $result = $this->controller->index($request);

            expect($result->resource->items())->toHaveCount(1)
                ->and($result->resource->items()[0]->name)->toBe('Comfortably Numb')
                ->and($result->resource->items()[0]->available_in_br)->toBeTrue();
        });

        it('returns empty result when no tracks match filters', function () {
            $album = Album::factory()->create();
            Track::factory()->create([
                'name'     => 'Different Song',
                'album_id' => $album->id,
            ]);

            $request = Mockery::mock(TrackSearchRequest::class);
            $request->shouldReceive('getSearch')->andReturn('NonExistent');
            $request->shouldReceive('getAvailableInBrazil')->andReturn(null);
            $request->shouldReceive('getArtist')->andReturn(null);
            $request->shouldReceive('getSort')->andReturn('name');
            $request->shouldReceive('getDirection')->andReturn('asc');
            $request->shouldReceive('getPerPage')->andReturn(15);

            $result = $this->controller->index($request);

            expect($result->resource->items())->toHaveCount(0);
        });

        it('respects pagination parameters', function () {
            $album = Album::factory()->create();
            Track::factory()->count(25)->create(['album_id' => $album->id]);

            $request = Mockery::mock(TrackSearchRequest::class);
            $request->shouldReceive('getSearch')->andReturn(null);
            $request->shouldReceive('getAvailableInBrazil')->andReturn(null);
            $request->shouldReceive('getArtist')->andReturn(null);
            $request->shouldReceive('getSort')->andReturn('name');
            $request->shouldReceive('getDirection')->andReturn('asc');
            $request->shouldReceive('getPerPage')->andReturn(10);

            $result = $this->controller->index($request);

            expect($result->resource->perPage())->toBe(10)
                ->and($result->resource->items())->toHaveCount(10);
        });
    });

    describe('show method', function () {
        it('returns a single track with relationships loaded', function () {
            $album  = Album::factory()->create();
            $artist = Artist::factory()->create();
            $track  = Track::factory()->create(['album_id' => $album->id]);
            $track->artists()->attach($artist);

            $result = $this->controller->show($track);

            expect($result)->toBeInstanceOf(TrackResource::class)
                ->and($result->resource->relationLoaded('album'))->toBeTrue()
                ->and($result->resource->relationLoaded('artists'))->toBeTrue();
        });

        it('returns track with correct data structure', function () {
            $album  = Album::factory()->create();
            $artist = Artist::factory()->create();
            $track  = Track::factory()->create([
                'name'     => 'Test Track',
                'isrc'     => 'TEST123456789',
                'album_id' => $album->id,
            ]);
            $track->artists()->attach($artist);

            $result = $this->controller->show($track);

            expect($result->resource->name)->toBe('Test Track')
                ->and($result->resource->isrc)->toBe('TEST123456789')
                ->and($result->resource->album)->not->toBeNull()
                ->and($result->resource->artists)->toHaveCount(1);
        });
    });
});
