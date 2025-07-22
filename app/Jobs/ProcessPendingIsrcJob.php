<?php

namespace App\Jobs;

use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Saloon\RateLimitPlugin\Helpers\ApiRateLimited;
use App\Services\PendingIsrcService;

class ProcessPendingIsrcJob implements ShouldQueue
{
    use Queueable;

    public function __construct(
        public readonly string $isrc
    ) {
        $this->onQueue('isrc_lookup');
    }

    public function handle(): void
    {
        /** @var PendingIsrcService $service */
        $service = app(PendingIsrcService::class);
        $service->fetchTrackByIsrc($this->isrc);
    }

    public function middleware(): array
    {
        return [
            new ApiRateLimited
        ];
    }
}
