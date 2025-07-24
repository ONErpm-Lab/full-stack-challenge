<?php

namespace App\Services\Spotify;

use App\Services\Spotify\Endpoints\Search;
use Illuminate\Support\Facades\Facade;

/**
 * @method static Search search()
 */

class Spotify extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return SpotifyService::class;
    }
}
