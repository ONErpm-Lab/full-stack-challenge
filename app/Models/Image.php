<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property int $track_id
 * @property string $url
 * @property ?int $width
 * @property ?int $height
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method BelongsTo track()
 * @property Track $track
 */
class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'url',
        'width',
        'height',
        'track_id'
    ];

    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }
}
