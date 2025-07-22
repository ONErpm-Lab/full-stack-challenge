<?php

namespace App\Contracts;

use App\DTOs\Track\CreateTrackDTO;

interface MusicPlatdormTrackContract
{
    public function toTrack(string $isrc): CreateTrackDTO;
}
