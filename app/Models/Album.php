<?php

namespace App\Models;

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
    ];

    public function tracks(): HasMany
    {
        return $this->hasMany(Track::class);
    }
}
