<?php

namespace App\Http\Integrations\Spotify\DTOs;

use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\MapName;
use App\Contracts\MusicPlatdormTrackContract;
use App\Enums\MusicPlatform;
use App\DTOs\Track\CreateTrackDTO;
use App\DTOs\Track\ArtistDTO;
use App\DTOs\Track\ImageDTO;

/**
 * @property ArtistDTO[] $artists
 * @property ImageDTO[] $images
 */
class TrackDTO extends Data implements MusicPlatdormTrackContract
{
    public function __construct(
        #[MapName('album.images')]
        public array $images,
        public array $artists,
        #[MapName('album.release_date')]
        public string $release_date,
        #[MapName('album.release_date_precision')]
        public string $release_date_precision,
        #[MapName('external_urls.spotify')]
        public string $external_url_spotify,
        public int $duration_ms,
        public string $id,
        public bool $is_playable,
        public string $name,
        public ?string $preview_url,
    ) {}

    public function toTrack(string $isrc): CreateTrackDTO
    {
        return new CreateTrackDTO(
            name: $this->name,
            release_date: $this->release_date,
            release_date_precision: $this->release_date_precision,
            duration_ms: $this->duration_ms,
            external_url: $this->external_url_spotify,
            preview_url: $this->preview_url,
            is_playable: $this->is_playable,
            isrc: $isrc,
            music_platform_id: $this->id,
            music_platform: MusicPlatform::Spotify,
            artists: $this->artists,
            images: $this->images,
        );
    }
}
