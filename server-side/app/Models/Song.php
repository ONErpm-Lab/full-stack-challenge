<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Song extends Model
{
    use HasFactory;

    protected $fillable = ['isrc', 'thumb', 'release_date', 'title',
      'artists', 'duration', 'audio_preview', 'spotify_link',
      'available_in_br'
    ];

    /**
     * @brief Set the song's artists. It's stored in the db as a comma
     *        separated string.
     * @param array $value an array of artist names
     */
    public function setArtistsAttribute($value)
    {
        $this->attributes['artists'] = implode(', ', $value);
    }

    /**
     * @brief Get song details from database. If not found in database, get
     * them from Spotify Web API and store it in DB.
     * @param string $isrc.
     */
    public static function findByISRC($isrc)
    {
      $DBSong = Song::where('isrc', $isrc)->first();
      if(!empty($DBSong)) {
        unset($DBSong->id);
        unset($DBSong->created_at);
        unset($DBSong->updated_at);
        return $DBSong;
      }

      $spotifySong = SpotifySong::getSongDetails($isrc);
      if($spotifySong->title == 'Track Not Found') {
        return 0;
      }

      $song = Song::create((array)$spotifySong);
      return $song;
    }
}
