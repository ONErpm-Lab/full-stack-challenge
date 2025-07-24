<?php

namespace App\Models;

use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    /** @use HasFactory<\Database\Factories\AlbumFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'spotify_id',
        'spotify_url',
        'release_date',
        'release_date_precision',
        'thumb_url',
    ];

    public function releaseDateFormatted(): Attribute
    {
        return Attribute::make(
            get: function (): ?string {
                if (!$this->release_date) {
                    return null;
                }

                try {
                    $date = Carbon::parse($this->release_date);

                    return match ($this->release_date_precision) {
                        'year'  => $date->format('Y'),
                        'month' => $date->format('M Y'),
                        default => $date->format('d M Y'),
                    };
                } catch (Exception $e) {
                    return $this->release_date;
                }
            }
        );
    }

    public function tracks(): HasMany
    {
        return $this->hasMany(Track::class);
    }
}
