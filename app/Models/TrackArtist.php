<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TrackArtist extends Model
{
    protected $fillable = [
        'track_id', 
        'artist_id'
    ];
}
