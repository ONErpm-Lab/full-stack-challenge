<?php

namespace App\Console\Commands;

use App\Models\Artist;
use App\Models\Track;
use App\Services\SpotifyService;
use Illuminate\Console\Command;

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
        foreach ($this->isrcs as $isrc) {

            $trackData = $this->spotify->searchTrackByISRC($isrc);

            if (!$trackData) {
                $this->warn("⚠️  The soundtrack was not found. ISRC: $isrc");
                continue;
            }

            if (!isset($trackData['tracks']['items'][0]) || empty($trackData['tracks']['items'])) {
                $this->warn("⚠️  The soundtrack was not found. ISRC: $isrc");
                continue;
            }

            $firstTrack = $trackData['tracks']['items'][0];

            $track = Track::updateOrCreate(
                ['isrc' => $isrc],
                [
                    'spotify_id'            => $firstTrack['id'],
                    'title'                 => $firstTrack['name'],
                    'preview_url'           => $firstTrack['preview_url'],
                    'spotify_url'           => $firstTrack['external_urls']['spotify'],
                    'duration_ms'           => $firstTrack['duration_ms'],
                    'avaliable_in_brazil'   => in_array('BR', $firstTrack['available_markets'] ?? false),
                ]
            );

            foreach ($firstTrack['artists'] as $trackArtist) {
                Artist::updateOrCreate(
                    ['spotify_id' => $trackArtist['id']],
                    [
                        'spotify_url' => $trackArtist['external_urls']['spotify'],
                        'name'        => $trackArtist['name'],
                    ]
                );
            }

            $this->info("✅ Soundtrack has been found. Title: {$track->title}");
        }

        $this->info('_____________________________________________');
        $this->info('Script finished.');
    }
}
