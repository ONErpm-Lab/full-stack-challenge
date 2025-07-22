<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\MusicPlatform;

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
            'name' => $this->faker->name,
            'release_date' => $this->faker->date(),
            'release_date_precision' => $this->faker->randomElement(['year', 'month', 'day']),
            'duration_ms' => $this->faker->numberBetween(100000, 250000),
            'external_url' => $this->faker->url,
            'preview_url' => $this->faker->url,
            'is_playable' => $this->faker->boolean,
            'isrc' => $this->faker->uuid,
            'music_platform_id' => $this->faker->uuid,
            'music_platform' => MusicPlatform::Spotify,
            'created_at' => $this->faker->dateTime(),
            'updated_at' => $this->faker->dateTime(),
        ];
    }
}
