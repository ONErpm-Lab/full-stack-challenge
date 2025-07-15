<?php

namespace App\Console\Commands;

use App\Models\Album;
use App\Models\AlbumTrack;
use App\Models\Artist;
use App\Models\Track;
use App\Models\TrackArtist;
use App\Services\SpotifyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Throwable;

class ImportSpotifyTracks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-spotify-tracks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get tracks from Spotify by ISRC and import them into the database';

    protected $isrcs = [
        'US7VG1846811',
        'US7QQ1846811',
        'BRC310600002',
        'BR1SP1200071',
        'BR1SP1200070',
        'BR1SP1500002',
        'BXKZM1900338',
        'BXKZM1900345',
        'QZNJX2081700',
        'QZNJX2078148',
    ];

    public function __construct(protected SpotifyService $spotify)
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {

            DB::beginTransaction();

            foreach ($this->isrcs as $isrc) {
    
                $trackData = $this->spotify->searchTrackByISRC($isrc);
    
                if (!$trackData) {
                    $this->warn("⚠️  The soundtrack was not found. ISRC: $isrc");
                    continue;
                }
    
                foreach ($trackData['tracks']['items'] as $trackDataItem) {
    
                    $track = Track::updateOrCreate(
                        ['isrc' => $isrc],
                        [
                            'spotify_id'            => $trackDataItem['id'],
                            'title'                 => $trackDataItem['name'],
                            'preview_url'           => $trackDataItem['preview_url'],
                            'spotify_url'           => $trackDataItem['external_urls']['spotify'],
                            'duration_ms'           => $trackDataItem['duration_ms'],
                            'avaliable_in_brazil'   => in_array('BR', $trackDataItem['available_markets'] ?? false),
                        ]
                    );
        
                    $album = Album::updateOrCreate(
                        ['spotify_id' => $trackDataItem['album']['id']],
                        [
                            'name'          => $trackDataItem['album']['name'],
                            'thumb_url'     => $trackDataItem['album']['images'][0]['url'] ?? null,
                            'release_date'  => $trackDataItem['album']['release_date'],
                        ]
                    );
        
                    AlbumTrack::updateOrCreate(
                        ['album_id' => $album->id, 'track_id' => $track->id],
                        []
                    );
        
                    foreach ($trackDataItem['artists'] as $trackArtist) {
        
                        $artist = Artist::updateOrCreate(
                            ['spotify_id' => $trackArtist['id']],
                            [
                                'spotify_url' => $trackArtist['external_urls']['spotify'],
                                'name'        => $trackArtist['name'],
                            ]
                        );
        
                        TrackArtist::updateOrCreate(
                            ['track_id' => $track->id, 'artist_id' => $artist->id],
                            []
                        );
                    }
                }
            }

            DB::commit();

            $this->info('_____________________________________________');
            $this->info('Script finished.');

        } catch (Throwable $th) {
            DB::rollBack();
            $this->warn("⚠️  An error occurred: " . $th->getMessage());
        }
    }
}
