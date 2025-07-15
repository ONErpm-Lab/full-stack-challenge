<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AlbumTrack extends Model
{
    protected $fillable = [
        'album_id',
        'track_id',
    ];
}
