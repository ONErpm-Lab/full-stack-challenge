<?php

namespace Database\Factories;

use App\Models\Album;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Track>
 */
class TrackFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'isrc'            => $this->faker->unique()->regexify('[A-Z]{2}[A-Z0-9]{3}[0-9]{7}'),
            'name'            => $this->faker->sentence(3),
            'thumb_url'       => $this->faker->imageUrl(),
            'duration_ms'     => $this->faker->numberBetween(30000, 300000),
            'spotify_id'      => $this->faker->unique()->uuid(),
            'spotify_url'     => $this->faker->url(),
            'preview_url'     => $this->faker->url(),
            'available_in_br' => $this->faker->boolean(),
            'album_id'        => Album::factory(),
        ];
    }
}
