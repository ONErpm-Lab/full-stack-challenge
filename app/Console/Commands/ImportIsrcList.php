<?php

namespace App\Console\Commands;

use App\Models\{Album, Artist, Track};
use App\Services\Spotify\Spotify;
use Exception;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class ImportIsrcList extends Command
{
    protected $signature = 'spotify:import-tracks {--isrc=* : Specific ISRCs to import}';

    protected $description = 'Import tracks from Spotify using ISRC codes';

    private array $defaultIsrcs = [
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

    public function handle(): int
    {
        $isrcs = $this->option('isrc') ?: $this->defaultIsrcs;

        $this->info("Starting import of " . count($isrcs) . " ISRC codes...");

        $imported = 0;
        $failed   = 0;

        $progressBar = $this->output->createProgressBar(count($isrcs));
        $progressBar->start();

        foreach ($isrcs as $isrc) {
            try {
                if ($this->importTrack($isrc)) {
                    $imported++;
                    $this->info("\nImported: {$isrc}");
                } else {
                    $failed++;
                    $this->warn("\nNot found: {$isrc}");
                }
            } catch (Exception $e) {
                $failed++;
                $this->error("\nFailed {$isrc}: " . $e->getMessage());
                Log::error("Failed to import ISRC {$isrc}", ['error' => $e->getMessage()]);
            }

            $progressBar->advance();
        }

        $progressBar->finish();

        $this->newLine(2);
        $this->info("Import completed!");
        $this->table(['Status', 'Count'], [
            ['Imported', $imported],
            ['Failed/Not Found', $failed],
            ['Total', count($isrcs)],
        ]);

        return self::SUCCESS;
    }

    private function importTrack(string $isrc): bool
    {
        if (Track::query()->where('isrc', $isrc)->exists()) {
            $this->warn("Track with ISRC {$isrc} already exists. Skipping...");

            return true;
        }

        try {
            $tracks = Spotify::search()->searchTracksByIsrc($isrc, ['limit' => 1]);

            if (empty($tracks)) {
                return false;
            }

            $trackData = $tracks[0];

            $album = $this->createOrFindAlbum($trackData['album']);

            $track = Track::query()->create([
                'isrc'            => $isrc,
                'spotify_id'      => $trackData['id'],
                'name'            => $trackData['name'],
                'duration_ms'     => $trackData['duration_ms'],
                'preview_url'     => $trackData['preview_url'],
                'spotify_url'     => $trackData['external_urls']['spotify'] ?? null,
                'available_in_br' => $this->isAvailableInBrazil($trackData),
                'album_id'        => $album->id,
                'thumb_url'       => $trackData['album']['images'][0]['url'] ?? null,
            ]);

            $this->attachArtists($track, $trackData['artists']);

            return true;
        } catch (Exception $e) {
            $this->error("Failed to import track with ISRC {$isrc}: " . $e->getMessage());

            return false;
        }
    }

    private function createOrFindAlbum(array $albumData): Album
    {
        return Album::query()->firstOrCreate(
            [
                'spotify_id' => $albumData['id'],
            ],
            [
                'name'                   => $albumData['name'],
                'release_date'           => $albumData['release_date'] ?? null,
                'release_date_precision' => $albumData['release_date_precision'] ?? null,
                'thumb_url'              => $albumData['images'][0]['url'] ?? null,
                'spotify_url'            => $albumData['external_urls']['spotify'] ?? null,
            ]
        );
    }

    private function attachArtists(Track $track, array $artistsData): void
    {
        $artistIds = [];

        foreach ($artistsData as $artistData) {
            $artist = Artist::query()->firstOrCreate(
                [
                    'spotify_id' => $artistData['id'],
                ],
                [
                    'name'        => $artistData['name'],
                    'spotify_url' => $artistData['external_urls']['spotify'] ?? null,
                ]
            );

            $artistIds[] = $artist->id;
        }

        $track->artists()->sync($artistIds);
    }

    private function isAvailableInBrazil(array $trackData): bool
    {
        return $trackData['available_markets'] && in_array('BR', $trackData['available_markets'], true);
    }
}
