<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class SongSeeder extends Seeder
{
    var $client_id;
    var $client_secret;
    var $acces_token;

    function __construct() {
       $this->client_id = "21f57101fa934d13b2b533c43d48d649";
       $this->client_secret = "c879ef8b5a784bd5824f51aa85391b99";
    }

    /**
     * Obtains authorization token to comunicate with spotify api
     */
    private function getAccesToken() {
        $client = new Client(); //GuzzleHttp\Client
        $url = "https://accounts.spotify.com/api/token";
        $auth = base64_encode($this->client_id . ':' .$this->client_secret);
        $params = [
            //If you have any Params Pass here
            'grant_type' => 'client_credentials',
            
        ];
        $headers = [
            'Authorization' => 'Basic '.$auth,
            'Content-Type' => 'application/x-www-form-urlencoded'
        ];

        $response = $client->request('POST', $url, [
            'headers' => $headers,
            'form_params' => $params,
            'verify'  => false,
        ]);
        $response = json_decode($response->getBody(), true);
        $this->acces_token = $response["access_token"];
    }

    /**
     * Seeds song_artists table
     */
    private function addSongArtist($song, $artists) {
        foreach ($artists as $artist) {
            DB::table('song_artists')->insert([
                'song_id' => $song,
                'artist_name' => $artist['name'],
            ]);
        }
    }

    /**
     * Retrieves song from spotify api with specified isrc and seed songs table
     */
    private function addSong($isrc) {
        $client = new Client(); //GuzzleHttp\Client
        $url = 'https://api.spotify.com/v1/search?type=track&q=isrc:'. $isrc;
        $headers = [
            'Authorization' => 'Bearer '. $this->acces_token,
        ];

        $response = $client->request('GET', $url, [
            'headers' => $headers,
            'verify'  => false,
        ]);
        $response = json_decode($response->getBody(), true)['tracks']['items'];
        if(count($response)) {
            $response = $response[0];
            DB::table('songs')->insert([
                'album_cover' => end($response['album']['images'])['url'],
                'isrc' => $isrc,
                'release_date' => $response['album']['release_date'],
                'title' =>$response['name'],
                'duration' => $response['duration_ms'],
                'preview_link' => $response['preview_url'],
                'spotify_link' => $response['external_urls']['spotify'],
                'brasil_available' => in_array('BR',$response['available_markets'])
            ]);

            $song = DB::table('songs')->where('isrc', '=', $isrc)->get()->toArray();
            $idSong = $song[0] ->id;
            $this->addSongArtist($idSong, $response['artists']);
        }

    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nonIncludedSongs = [
            'US7VG1846811',
            'US7QQ1846811',
            'BRC310600002',
            'BR1SP1200071',
            'BR1SP1200070',
            'BR1SP1500002',
            'BXKZM1900338',
            'BXKZM1900345',
            'QZNJX2081700',
            'QZNJX2078148'
        ];
        $this->getAccesToken();
        foreach ($nonIncludedSongs as $isrc) {
            $this->addSong($isrc);
        }
        
    }
}
