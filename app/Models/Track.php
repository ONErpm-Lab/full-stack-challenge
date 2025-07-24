<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\{BelongsTo, BelongsToMany};

class Track extends Model
{
    /** @use HasFactory<\Database\Factories\TrackFactory> */
    use HasFactory;

    protected $fillable = [
        'isrc',
        'name',
        'thumb_url',
        'duration_ms',
        'spotify_id',
        'spotify_url',
        'preview_url',
        'available_in_br',
        'album_id',
    ];

    protected $casts = [
        'available_in_br' => 'boolean',
        'duration_ms'     => 'integer',
    ];

    protected function duration(): Attribute
    {
        return Attribute::make(
            get: function (): string {
                if (!$this->duration_ms) {
                    return '00:00';
                }

                $totalSeconds = (int)($this->duration_ms / 1000);
                $minutes      = (int)($totalSeconds / 60);
                $seconds      = $totalSeconds % 60;

                return sprintf('%02d:%02d', $minutes, $seconds);
            }
        );
    }

    public function album(): BelongsTo
    {
        return $this->belongsTo(Album::class);
    }

    public function artists(): BelongsToMany
    {
        return $this->belongsToMany(Artist::class);
    }
}
