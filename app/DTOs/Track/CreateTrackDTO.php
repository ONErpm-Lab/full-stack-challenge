<?php

namespace App\DTOs\Track;

use Spatie\LaravelData\Data;
use App\Enums\MusicPlatform;
use Illuminate\Validation\Rule;

/**
 * @property ArtistDTO[] $artists
 * @property ImageDTO[] $images
 */
class CreateTrackDTO extends Data
{
    public function __construct(
        public string $name,
        public string $release_date,
        public ?string $release_date_precision,
        public int $duration_ms,
        public string $external_url,
        public ?string $preview_url,
        public bool $is_playable,
        public string $isrc,
        public string $music_platform_id,
        public MusicPlatform $music_platform,
        public array $artists,
        public array $images,
    ) {}

    public static function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'release_date' => ['required', 'string', 'max:255'],
            'release_date_precision' => ['nullable', 'string', 'max:255'],
            'duration_ms' => ['required', 'integer'],
            'external_url' => ['required', 'string', 'url', 'max:255'],
            'preview_url' => ['nullable', 'string', 'url', 'max:255'],
            'is_playable' => ['required', 'boolean'],
            'isrc' => ['required', 'string', 'max:255'],
            'music_platform_id' => ['required', 'string', 'max:255'],
            'music_platform' => ['required', Rule::enum(MusicPlatform::class)],

            'artists' => ['required', 'array', 'min:1'],
            'artists.*.name' => ['required', 'string', 'max:255'],

            'images' => ['required', 'array', 'min:1'],
            'images.*.height' => ['nullable', 'integer'],
            'images.*.width' => ['nullable', 'integer'],
            'images.*.url' => ['required', 'string', 'url', 'max:255'],
        ];
    }
}
