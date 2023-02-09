<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'spotify_id' => $this->faker->regexify('[A-Z][a-z][0-9]{12}'),
            'isrc' => $this->faker->regexify('[A-Z][a-z][0-9]{12}'),
            'thumb_url' => $this->faker->url(),
            'release_date' => $this->faker->date('Y-m-d'),
            'title' => $this->faker->name,
            'length' => $this->faker->regexify('[0-9]{2}:[0-9]{2}'),
            'spotify_url' => $this->faker->url(),
            'preview_url' => $this->faker->url(),
            'br_avaiable' => $this->faker->boolean(),
        ];
    }
}
