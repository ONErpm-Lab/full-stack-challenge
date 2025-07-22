<?php

namespace App\Repositories;

use App\Models\Artist;
use App\Models\Image;
use App\Models\Track;
use App\DTOs\Track\CreateTrackDTO;
use App\DTOs\Track\ArtistDTO;
use App\DTOs\Track\ImageDTO;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class TrackRepository
{
    public function createOrUpdate(CreateTrackDTO $trackDto): Track
    {
        return DB::transaction(function () use ($trackDto) {
            /** @var Track $track */
            $track = Track::updateOrCreate([
                'isrc' => $trackDto->isrc,
                'music_platform_id' => $trackDto->music_platform_id,
                'music_platform' => $trackDto->music_platform
            ], Arr::except($trackDto->toArray(), ['artists', 'images']));

            $artists = Arr::map(
                $trackDto->artists,
                fn(ArtistDTO $value) => new Artist($value->toArray())
            );

            $track->artists()->delete();
            $track->artists()->saveMany($artists);

            $images = Arr::map(
                $trackDto->images,
                fn(ImageDTO $value) => new Image($value->toArray())
            );

            $track->images()->delete();
            $track->images()->saveMany($images);

            return $track;
        });
    }
}
