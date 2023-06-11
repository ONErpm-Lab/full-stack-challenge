<?php

namespace App\Adapters;

use App\Services\Contracts\StreamingAPIInterface;
use App\Services\DeezerAPIService;

class DeezerAPIAdapter implements StreamingAPIInterface
{
    public function __construct(private DeezerAPIService $service)
    {
    }

    public function getByISRC(string $isrc)
    {
        $params = 'isrc:' . $isrc;
        return $this->service->search($params);
    }
}
