<?php

namespace App\Repositories;

use App\Models\PendingIsrc;
use App\Enums\PendingIsrcStatus;
use Illuminate\Support\LazyCollection;

class PendingIsrcRepository
{
    /**
     * @return LazyCollection<int, PendingIsrc>
     */
    public function getIsrcWithStatusPending(): LazyCollection
    {
        return PendingIsrc::pending()
            ->select(['id', 'isrc'])
            ->cursor();
    }

    private function updateStatus(
        \BackedEnum $status,
        string|array $isrc,
        ?string $failureReason = null
    ): void {
        $isrc = is_array($isrc) ? $isrc : [$isrc];
        PendingIsrc::whereIn('isrc', $isrc)
            ->update([
                'status' => $status,
                'failure_reason' => $failureReason
            ]);
    }

    public function updateProcessing(string|array $isrc): void
    {
        $this->updateStatus(PendingIsrcStatus::Processing, $isrc);
    }

    public function updateCompleted(string|array $isrc): void
    {
        $this->updateStatus(PendingIsrcStatus::Completed, $isrc);
    }

    public function updateFailed(string|array $isrc, string $failureReason): void
    {
        $this->updateStatus(PendingIsrcStatus::Failed, $isrc, $failureReason);
    }

    public function updateNotFound(string|array $isrc): void
    {
        $this->updateStatus(PendingIsrcStatus::NotFound, $isrc);
    }
}
