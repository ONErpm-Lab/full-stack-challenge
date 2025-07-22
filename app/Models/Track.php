<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

/**
 * @property int $id
 * @property string $name
 * @property string $release_date
 * @property ?string $release_date_precision
 * @property int $duration_ms
 * @property string $external_url
 * @property ?string $preview_url
 * @property bool $is_playable
 * @property string $isrc
 * @property string $music_platform_id
 * @property string $music_platform
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @method HasMany artists()
 * @property Collection $artists
 * @method HasMany images()
 * @property Collection $images
 */
class Track extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'release_date',
        'release_date_precision',
        'duration_ms',
        'external_url',
        'preview_url',
        'is_playable',
        'isrc',
        'music_platform_id',
        'music_platform',
    ];

    public function artists(): HasMany
    {
        return $this->hasMany(Artist::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(Image::class);
    }
}
