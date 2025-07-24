<?php

use App\Models\{Album, Track};

describe('Track Search Request Validation Tests', function () {
    describe('Pagination Validation', function () {
        it('accepts valid per_page values', function () {
            $album = Album::factory()->create();

            Track::factory()->create(['album_id' => $album->id]);

            $this->getJson('/api/tracks?per_page=1')->assertStatus(200);
            $this->getJson('/api/tracks?per_page=50')->assertStatus(200);
            $this->getJson('/api/tracks?per_page=100')->assertStatus(200);
        });

        it('rejects per_page values outside valid range', function () {
            $this->getJson('/api/tracks?per_page=0')
                ->assertStatus(422)
                ->assertJsonValidationErrors(['per_page']);

            $this->getJson('/api/tracks?per_page=101')
                ->assertStatus(422)
                ->assertJsonValidationErrors(['per_page']);
        });

        it('rejects non-integer per_page values', function () {
            $this->getJson('/api/tracks?per_page=abc')
                ->assertStatus(422)
                ->assertJsonValidationErrors(['per_page']);

            $this->getJson('/api/tracks?per_page=10.5')
                ->assertStatus(422)
                ->assertJsonValidationErrors(['per_page']);
        });

        it('accepts valid page values', function () {
            $album = Album::factory()->create();

            Track::factory()->count(20)->create(['album_id' => $album->id]);

            $this->getJson('/api/tracks?page=1')->assertStatus(200);
            $this->getJson('/api/tracks?page=2')->assertStatus(200);
        });

        it('rejects invalid page values', function () {
            $this->getJson('/api/tracks?page=0')
                ->assertStatus(422)
                ->assertJsonValidationErrors(['page']);

            $this->getJson('/api/tracks?page=-1')
                ->assertStatus(422)
                ->assertJsonValidationErrors(['page']);
        });
    });

    describe('Sorting Validation', function () {
        it('accepts valid sort fields', function () {
            $album = Album::factory()->create();

            Track::factory()->create(['album_id' => $album->id]);

            $this->getJson('/api/tracks?sort=name')->assertStatus(200);
            $this->getJson('/api/tracks?sort=created_at')->assertStatus(200);
            $this->getJson('/api/tracks?sort=release_date')->assertStatus(200);
        });

        it('rejects invalid sort fields', function () {
            $this->getJson('/api/tracks?sort=invalid_field')
                ->assertStatus(422)
                ->assertJsonValidationErrors(['sort'])
                ->assertJsonPath('errors.sort.0', 'Sort field must be one of: name, created_at, release_date.');
        });

        it('accepts valid direction values', function () {
            $album = Album::factory()->create();

            Track::factory()->create(['album_id' => $album->id]);

            $this->getJson('/api/tracks?direction=asc')->assertStatus(200);
            $this->getJson('/api/tracks?direction=desc')->assertStatus(200);
        });

        it('rejects invalid direction values', function () {
            $this->getJson('/api/tracks?direction=invalid')
                ->assertStatus(422)
                ->assertJsonValidationErrors(['direction'])
                ->assertJsonPath('errors.direction.0', 'Direction must be either asc or desc.');
        });
    });

    describe('Search Parameter Validation', function () {
        it('accepts valid search strings', function () {
            $album = Album::factory()->create();

            Track::factory()->create(['album_id' => $album->id]);

            $this->getJson('/api/tracks?search=test')->assertStatus(200);
            $this->getJson('/api/tracks?search=' . str_repeat('a', 255))->assertStatus(200);
        });

        it('rejects search strings that are too long', function () {
            $this->getJson('/api/tracks?search=' . str_repeat('a', 256))
                ->assertStatus(422)
                ->assertJsonValidationErrors(['search'])
                ->assertJsonPath('errors.search.0', 'Search term cannot exceed 255 characters.');
        });

        it('accepts valid artist strings', function () {
            $album = Album::factory()->create();

            Track::factory()->create(['album_id' => $album->id]);

            $this->getJson('/api/tracks?artist=test')->assertStatus(200);
            $this->getJson('/api/tracks?artist=' . str_repeat('a', 255))->assertStatus(200);
        });

        it('rejects artist strings that are too long', function () {
            $this->getJson('/api/tracks?artist=' . str_repeat('a', 256))
                ->assertStatus(422)
                ->assertJsonValidationErrors(['artist'])
                ->assertJsonPath('errors.artist.0', 'Artist name cannot exceed 255 characters.');
        });
    });

    describe('Available in Brazil Validation', function () {
        it('accepts valid boolean values for available_in_brazil', function () {
            $album = Album::factory()->create();

            Track::factory()->create(['album_id' => $album->id]);

            $this->getJson('/api/tracks?available_in_brazil=1')->assertStatus(200);
            $this->getJson('/api/tracks?available_in_brazil=0')->assertStatus(200);
        });

        it('rejects invalid boolean values for available_in_brazil', function () {
            $this->getJson('/api/tracks?available_in_brazil=invalid')
                ->assertStatus(422)
                ->assertJsonValidationErrors(['available_in_brazil']);
        });
    });

    describe('Multiple Validation Errors', function () {
        it('returns multiple validation errors when multiple fields are invalid', function () {
            $response = $this->getJson('/api/tracks?per_page=150&sort=invalid&direction=wrong&search=' . str_repeat('a', 300));

            $response->assertStatus(422)
                ->assertJsonValidationErrors(['per_page', 'sort', 'direction', 'search']);
        });
    });

    describe('Custom Validation Messages', function () {
        it('returns custom validation message for per_page max', function () {
            $response = $this->getJson('/api/tracks?per_page=150');

            $response->assertStatus(422)
                ->assertJsonPath('errors.per_page.0', 'Maximum of 100 items per page allowed.');
        });

        it('returns custom validation message for sort field', function () {
            $response = $this->getJson('/api/tracks?sort=invalid');

            $response->assertStatus(422)
                ->assertJsonPath('errors.sort.0', 'Sort field must be one of: name, created_at, release_date.');
        });

        it('returns custom validation message for direction', function () {
            $response = $this->getJson('/api/tracks?direction=invalid');

            $response->assertStatus(422)
                ->assertJsonPath('errors.direction.0', 'Direction must be either asc or desc.');
        });

        it('returns custom validation message for search max length', function () {
            $response = $this->getJson('/api/tracks?search=' . str_repeat('a', 256));

            $response->assertStatus(422)
                ->assertJsonPath('errors.search.0', 'Search term cannot exceed 255 characters.');
        });

        it('returns custom validation message for artist max length', function () {
            $response = $this->getJson('/api/tracks?artist=' . str_repeat('a', 256));

            $response->assertStatus(422)
                ->assertJsonPath('errors.artist.0', 'Artist name cannot exceed 255 characters.');
        });
    });
});
