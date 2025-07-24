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
            'name'                   => $this->faker->sentence(2),
            'spotify_id'             => $this->faker->unique()->uuid(),
            'spotify_url'            => $this->faker->url(),
            'release_date'           => $this->faker->date(),
            'release_date_precision' => $this->faker->randomElement(['day', 'month', 'year']),
            'thumb_url'              => $this->faker->imageUrl(),
        ];
    }
}
