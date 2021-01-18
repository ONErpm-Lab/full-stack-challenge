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

    protected $hidden = ['id', 'created_at', 'updated_at'];

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
      // TODO: At some point, the songs in the database should be cleared to
      // allow for fetching updated song details from the spotify api. Perhaps
      // a cron job every few days?
      
      $dBSong = Song::where('isrc', $isrc)->first();
      if(!empty($dBSong)) {
        return $dBSong;
      }

      $spotifySong = SpotifySong::getSongDetails($isrc);
      $song = Song::create((array)$spotifySong);
      $dBSong = Song::where('isrc', $isrc)->first();
      return $dBSong;
    }

    protected function getDurationAttribute($duration) {
      $seconds = $duration/1000.0;
      $minutes = intval($seconds/60);
      if($minutes < 10) {
        $minutes = '0'.$minutes;
      }
      $seconds = intval($seconds % 60);
      if($seconds < 10) {
        $seconds = '0'.$seconds;
      }
      return $minutes . ':' . $seconds;
    }


}
