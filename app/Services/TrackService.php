<?php

namespace App\Services;

use App\Adapters\DeezerAPIAdapter;
use App\Entities\Track;
use App\Repositories\MissingIsrcRepository;
use App\Repositories\TrackRepository;
use App\Services\Contracts\StreamingAPIInterface;

class TrackService
{

    public function __construct(
        private TrackRepository $repository,
        private StreamingAPIInterface $apiService)
    {
    }

    public function list()
    {
        return $this->repository->list();
    }

    public function getFromSpotify(string $isrc)
    {
        return $this->apiService->getByISRC($isrc);
    }

    public function getFromDeezer(string $isrc)
    {
        $service = app()->make(DeezerAPIService::class);
        return (new DeezerAPIAdapter($service))->getByISRC($isrc);
    }

    public function store(array $data)
    {
        $track = Track::fromArray($data);
        return $track->save();
    }

    public function searchForMissingIsrc()
    {
        $missing = MissingIsrcRepository::get();
        $found = $this->repository->getAll()->map(fn ($track) => $track->isrc)->toArray();
        $toBeSearched = array_filter($missing, fn ($m) => !in_array($m, $found));
        foreach ($toBeSearched as $isrc) {
            $data = $this->getFromSpotify($isrc);
            if (!empty($data)) {
                $this->store($data);
            } elseif(env('ENABLE_DEEZER_API')) {
                $data = $this->getFromDeezer($isrc);
                if (!empty($data)) $this->store($data);
            }
        }
    }
}
