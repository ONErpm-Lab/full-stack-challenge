<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Album>
 */
class AlbumFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'                   => 'Test Album ' . rand(1, 1000),
            'spotify_id'             => 'spotify_' . uniqid('', true),
            'spotify_url'            => 'https://open.spotify.com/album/' . uniqid('', true),
            'release_date'           => '2023-01-01',
            'release_date_precision' => 'day',
            'thumb_url'              => 'https://example.com/thumb.jpg',
        ];
    }
}
