<?php

namespace App\Adapters;

use App\Services\Contracts\StreamingAPIInterface;
use App\Services\SpotifyAPIService;

class SpotifyAPIAdatpter implements StreamingAPIInterface
{

    public function __construct(private SpotifyAPIService $service)
    {
    }

    public function getByISRC(string $isrc)
    {
        $params = [
            'type' => 'track',
            'q' => 'isrc:' . $isrc
        ];
        return $this->service->search($params);
    }
}
