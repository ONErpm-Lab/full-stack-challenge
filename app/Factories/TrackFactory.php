<?php

namespace App\Factories;

use App\Entities\Track;
use Faker\Factory as Faker;

class TrackFactory
{
    public static function create(array $overrides = []): Track
    {
        $faker = Faker::create();

        $defaultAttributes = [
            'isrc' => $faker->unique()->regexify('[A-Z0-9]{12}'),
            'title' => $faker->sentence(3),
            'duration' => $faker->numberBetween(30000, 10000000),
            'album' => [
                'title' => $faker->sentence(3),
                'cover' => $faker->url(),
                'release_date' => $faker->date(),
                'external_url' => $faker->url(),
                'artists' => [$faker->name()]
            ],
            'artists' => [$faker->name],
            'external_url' => $faker->url(),
            'br_enabled' => $faker->boolean(),
            'preview_url' => $faker->url()
        ];

        $attributes = array_merge($defaultAttributes, $overrides);

        return Track::fromArray($attributes);
    }
}

