<?php

namespace App\Services;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\LazyCollection;
use App\Factories\MusicPlatformAdapterFactory;
use App\Contracts\MusicPlatformAdapterContract;
use App\Repositories\PendingIsrcRepository;
use App\Repositories\TrackRepository;
use App\Models\PendingIsrc;
use App\Jobs\ProcessPendingIsrcJob;

class PendingIsrcService
{
    private MusicPlatformAdapterContract $musicPlatform;

    public function __construct(
        private readonly TrackRepository $trackRepository,
        private readonly PendingIsrcRepository $pendingIsrcRepository,
    ) {
        $this->musicPlatform = MusicPlatformAdapterFactory::make();
    }

    public function process()
    {
        $this->pendingIsrcRepository->getIsrcWithStatusPending()
            ->chunk(100)->each(function (LazyCollection $collection) {
                $isrcs = $collection->pluck('isrc')->toArray();
                $collection->each(function (PendingIsrc $model) use ($isrcs) {
                    DB::transaction(function () use ($model, $isrcs) {
                        $this->pendingIsrcRepository->updateProcessing($isrcs);
                        ProcessPendingIsrcJob::dispatch($model->isrc);
                    });
                });
            });
    }

    public function fetchTrackByIsrc(string $isrc)
    {
        DB::transaction(function () use ($isrc) {
            try {
                if (!$track = $this->musicPlatform->fetchTrackByIsrc($isrc)) {
                    $this->pendingIsrcRepository->updateNotFound($isrc);
                    return;
                }

                $validate = Validator::make(
                    data: $track->toArray(),
                    rules: $track->rules()
                );

                if ($validate->fails()) {
                    $this->pendingIsrcRepository->updateFailed($isrc, json_encode([
                        'message' => 'validation error',
                        'data' => $track->toArray(),
                        'errors' => $validate->errors()->toArray()
                    ]));
                    return;
                }

                $this->trackRepository->createOrUpdate($track);
                $this->pendingIsrcRepository->updateCompleted($isrc);
            } catch (\Throwable $exception) {
                $this->pendingIsrcRepository->updateFailed($isrc, json_encode([
                    'message' => $exception->getMessage(),
                    'trace' => $exception->getTraceAsString()
                ]));
                throw $exception;
            }
        });
    }
}
