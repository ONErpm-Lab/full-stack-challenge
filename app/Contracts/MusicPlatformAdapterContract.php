<?php

namespace App\Contracts;

use App\DTOs\Track\CreateTrackDTO;

interface MusicPlatformAdapterContract
{
    public function fetchTrackByIsrc(string $isrc): ?CreateTrackDTO;
}
