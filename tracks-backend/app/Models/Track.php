<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    protected $table = 'tracks';
    protected $primaryKey = 'id';
    protected $fillable = [
        'album_thumb',
        'release_date',
        'track_title',
        'artists',
        'duration',
        'audio_preview_url',
        'spotify_track_url',
        'is_available_in_br',
    ];

    protected $casts = [
        'artists' => 'array',
    ];
    
    public $timestamps = false;
    
    use HasFactory;
}
