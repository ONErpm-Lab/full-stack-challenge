<?php

namespace App\Repositories;

use App\Entities\Album;
use App\Entities\Track;
use Illuminate\Support\Facades\DB;

class TrackRepository extends Repository
{
    public function __construct()
    {
        parent::__construct('tracks');
    }

    public function save(Track $track)
    {
        return DB::transaction(function () use ($track) {
            $data = $track->toArray();
            if (empty($track->album->id())) $track->album->save();
            $data['album_id'] = $track->album->id();
            $newTrack = $track->fromArray($this->insert($data));
            $newTrack->album = $track->album;
            $newTrack->artists = $track->artists;
            $this->saveAlbumArtists($newTrack->album);
            $this->saveTrackArtists($newTrack);
            return $newTrack;
        });
    }

    public function list()
    {
        return $this->query()
            ->join('tracks_artists as TA', 'TA.track_id', '=', 'T.id')
            ->join('artists as Ar', 'Ar.id', '=', 'TA.artist_id')
            ->join('albums as Al', 'Al.id', '=', 'T.album_id')
            ->orderBy('T.title')
            ->select([
                'T.*',
                'Al.title as album_title',
                'Al.cover',
                'Al.release_date',
                DB::raw("GROUP_CONCAT(Ar.name) as artists")
            ])
            ->groupBy('T.id')->distinct()->get();
    }

    private function saveTrackArtists(Track $track)
    {
        $tracksArtists = array_map(function ($artist) use ($track) {
            return [
                'track_id' => $track->id(),
                'artist_id' => $artist->id()
            ];
        }, $track->artists);
        return DB::table('tracks_artists')->insert($tracksArtists);
    }

    private function saveAlbumArtists(Album $album)
    {
        $albumArtists = array_map(function ($artist) use ($album) {
            return [
                'album_id' => $album->id(),
                'artist_id' => $artist->id()
            ];
        }, $album->artists);
        return DB::table('albums_artists')->insert($albumArtists);
    }
}
