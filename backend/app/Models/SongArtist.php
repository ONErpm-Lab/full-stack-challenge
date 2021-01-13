<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SongArtist extends Model
{
    use HasFactory;

    protected $fillable = [
        'song_id', 'artist_name',
    ];

}
