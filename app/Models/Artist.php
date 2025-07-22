<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property int $track_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method BelongsTo track()
 * @property Track $track
 */
class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'track_id'
    ];

    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }
}
