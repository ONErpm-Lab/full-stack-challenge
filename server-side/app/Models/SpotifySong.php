<?php

namespace App\Models;

/** 
 * @brief This class uses the https://github.com/jwilsson/spotify-web-api-php
 * library to access the Spotify Web API and also serves as a data object to
 * hold the relevant fields for a song.
 */
class SpotifySong 
{
  /** 
   * @brief ISRC identifier for a song
   */
  public $isrc = "";

  /** 
   * @brief The url for the thumbnail of the album art.
   */
  public $thumb = "";

  /** 
   * @brief The date in which the album was released formated as YYYY-MM-DD
   */
  public $release_date = "";

  /** 
   * @brief The name of the track
   */
  public $title = "";

  /** 
   * @brief An array of strings with artist names.
   */
  public $artists = [];

  /** 
   * @brief Duration of the song in milliseconds.
   */
  public $duration = 0;

  /** 
   * @brief The URL of the 30 sec audio preview for the song.
   */
  public $audio_preview = "";

  /** 
   * @brief The URL of the song in spotify.
   */
  public $spotify_link = "";

  /**
   * @brief True if this track is available in the Spotify Brazilian market.
   */
  public $available_in_br = false;


  /**
   * @brief This method will fetch a track's information from the spotify
   * catalog based on it's ISRC number. If the ISRC was not found, the title of
   * the returned SpotifySong will be "Track Not Found".
   *
   * @param isrc string isrc identifier.
   * @return A SpotifySong object populated with the details for the requested
   * song
   */
  public static function getSongDetails($isrc) : SpotifySong {
    $token = SpotifySong::getAccessToken();

    $api = new \SpotifyWebAPI\SpotifyWebAPI();
    $api->setAccessToken($token);

    $song = new SpotifySong();
    $song->isrc = $isrc;
    $searchResult = $api->search('isrc:'.$isrc, 'track');

    // If there are no search results.
    if(count($searchResult->tracks->items) == 0){
      $song->title = "Track Not Found";
      $song->release_date = "1970-01-01";
      return $song;
    }

    // Song was found, get the relevant fields and return them as a SpotifySong object.
    $item = $searchResult->tracks->items[0];
    $song->thumb = $item->album->images[0]->url;
    $song->release_date = $item->album->release_date;
    $song->title = $item->name;
    foreach ($item->artists as $artist) {
      $song->artists[] = $artist->name;
    }
    $song->duration = $item->duration_ms;
    $song->audio_preview = $item->preview_url;
    $song->spotify_link = $item->external_urls->spotify;
    if(in_array('BR', $item->available_markets)) {
      $song->available_in_br = true;
    }

    return $song;
  }

  private static function getAccessToken() : string {
    // TO-DO: We should implement an access token cache. Tokens are good for 1 hour so
    // we don't need to ask for one every time we call the spotify api. Leaving
    // as is for simplicity's sake.

    $session = new \SpotifyWebAPI\Session(
      env('SPOTIFY_CLIENT_ID'),
      env('SPOTIFY_CLIENT_SECRET')
    );

    $session->requestCredentialsToken();
    $accessToken = $session->getAccessToken();

    return $accessToken;
  }
}
