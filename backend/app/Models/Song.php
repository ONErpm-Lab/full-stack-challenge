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

    public function artists()
    {
        return $this->hasMany('App\Models\SongArtist')->get();
    }

}
