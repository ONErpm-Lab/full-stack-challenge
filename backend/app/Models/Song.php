<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;
    protected $fillable = [
        'album_cover','isrc', 'release_date', 'title', 'duration', 'preview_link', 'spotify_link','brasil_available'
    ];

    /**
     * Returns all all entries from song_artists table aoscieted with this song
     */
    public function artists()
    {
        return $this->hasMany('App\Models\SongArtist')->get();
    }

}
