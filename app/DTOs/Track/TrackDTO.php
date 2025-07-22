<?php

namespace App\DTOs\Track;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Attributes\Computed;
use Spatie\LaravelData\Attributes\MapInputName;
use Spatie\LaravelData\Mappers\SnakeCaseMapper;
use Spatie\LaravelData\Data;

/**
 * @property ArtistDTO[] $artists
 * @property ImageDTO[] $images
 */
#[OA\Schema()]
#[MapInputName(SnakeCaseMapper::class)]
class TrackDTO extends Data
{
    #[OA\Property()]
    #[Computed]
    public string $durationFormatted;

    public function __construct(
        #[OA\Property()]
        public string $name,
        #[OA\Property()]
        public string $releaseDate,
        #[OA\Property()]
        public ?string $releaseDatePrecision,
        #[OA\Property()]
        public int $durationMs,
        #[OA\Property()]
        public string $externalUrl,
        #[OA\Property()]
        public ?string $previewUrl,
        #[OA\Property()]
        public bool $isPlayable,
        #[OA\Property(items: new OA\Items(ref: ArtistDTO::class))]
        public array $artists,
        #[OA\Property(items: new OA\Items(ref: ImageDTO::class))]
        public array $images,
    ) {
        $this->durationFormatted = $this->formatDuration();
    }

    private function formatDuration(): string
    {
        $totalSeconds = intdiv($this->durationMs, 1000);
        $minutes = intdiv($totalSeconds, 60);
        $seconds = $totalSeconds % 60;
        return sprintf('%d:%02d', $minutes, $seconds);
    }
}
