<?php

namespace App\DTOs\Track;

use OpenApi\Attributes as OA;
use Spatie\LaravelData\Data;

#[OA\Schema()]
class ArtistDTO extends Data
{
    public function __construct(
        #[OA\Property()]
        public string $name,
    ) {}
}
