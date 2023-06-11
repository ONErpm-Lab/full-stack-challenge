<?php

namespace App\Actions;

use App\Services\TrackService;
use Exception;
use Throwable;

class ListTracks extends Action
{
    public function __invoke(TrackService $service)
    {
        try {
            $service->searchForMissingIsrc();
            $tracks = $service->list()->toArray();
            return $this->asHtml('tracks', ['tracks' => $tracks]);
        } catch (Throwable $th) {
            throw new Exception($th->getMessage(), 500);
        }
    }
}
