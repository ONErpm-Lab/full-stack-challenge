<?php

namespace App\Factories;

use App\Enums\MusicPlatform;
use App\Contracts\MusicPlatformAdapterContract;
use App\Http\Integrations\Spotify\SpotifyAdapter;

final class MusicPlatformAdapterFactory
{
    public static function make(
        \BackedEnum|string $source = MusicPlatform::Spotify
    ): MusicPlatformAdapterContract {
        return match ($source) {
            MusicPlatform::Spotify,
            MusicPlatform::Spotify->value => new SpotifyAdapter(),
            default => throw new \InvalidArgumentException("music platform unavailable: {$source}"),
        };
    }
}
