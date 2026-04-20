<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\Track;
use App\Services\SpotifyService;

class ImportTracks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-tracks';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Returns track data from the Spotify API for those not found in the local database.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $isrcs = [
            'US7VG1846811', 'US7QQ1846811', 'BRC310600002', 'BR1SP1200071', 'BR1SP1200070',
            'BR1SP1500002', 'BXKZM1900338', 'BXKZM1900345', 'QZNJX2081700', 'QZNJX2078148'
        ];

        $spotify = new SpotifyService();

        foreach ($isrcs as $isrc) {
            $data = $spotify->searchByISRC($isrc);
     
            $track = $data['tracks']['items'][0] ?? null;

            if (!$track) {
                $this->error("ISRC {$isrc} não encontrado.");
                continue;
            }

            Track::updateOrCreate(
                ['isrc' => $isrc],
                [
                    'title' => $track['name'],
                    'album_thumb' => $track['album']['images'][0]['url'] ?? '',
                    'release_date' => $track['album']['release_date'],
                    'artists' => collect($track['artists'])->pluck('name')->join(', '),
                    'duration' => gmdate("i:s", $track['duration_ms'] / 1000),
                    'preview_url' => $track['preview_url'],
                    'spotify_url' => $track['external_urls']['spotify'],
                    'available_in_br' => in_array('BR', $track['available_markets']),
                ]
            );

            $this->info("ISRC {$isrc} importado com sucesso.");
        }
    }
}
