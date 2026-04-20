<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
        'isrc',
        'title',
        'album_thumb',
        'release_date',
        'artists',
        'duration',
        'preview_url',
        'spotify_url',
        'available_in_br',
    ];
}