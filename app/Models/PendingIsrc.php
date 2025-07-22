<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use App\Enums\PendingIsrcStatus;

/**
 * @property int $id
 * @property string $isrc
 * @property PendingIsrcStatus $status
 * @property ?string $failure_reason
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method static Builder|QueryBuilder pending()
 */
class PendingIsrc extends Model
{
    protected $fillable = [
        'isrc',
        'status',
        'failure_reason'
    ];

    protected function casts(): array
    {
        return [
            'status' => PendingIsrcStatus::class,
        ];
    }

    #[Scope]
    protected function pending(Builder $query): void
    {
        $query->where('status', PendingIsrcStatus::Pending);
    }
}
