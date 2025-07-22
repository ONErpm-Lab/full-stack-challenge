<?php

namespace App\DTOs\Track;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema()]
class ImageDTO extends Data
{
    public function __construct(
        #[OA\Property()]
        public ?int $height,
        #[OA\Property()]
        public ?int $width,
        #[OA\Property()]
        public string $url,
    ) {}
}
