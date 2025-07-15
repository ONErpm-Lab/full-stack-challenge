<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $fillable = [
        'isrc',
        'spotify_id',
        'title',
        'duration_ms',
        'preview_url',
        'spotify_url',
        'avaliable_in_brazil'
    ];
}
