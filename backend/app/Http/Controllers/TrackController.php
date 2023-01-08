<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Track;
use App\Models\Artist;

class TrackController extends Controller
{
    public function getAllTracks()
    {
        $tracks = Track::with("artists")->get()->toJson(JSON_PRETTY_PRINT);
        return response($tracks, 200);
    }

    public function createTrack(Request $request)
    {
        DB::beginTransaction();

        try {
            $json = $request->getContent();

            $data = json_decode($json);

            $track = new Track;

            $track->set($data);

            unset($track["artists"]);

            $track->save();

            foreach ($data->artists as $artist_data) {
                $artist = new Artist;

                $artist->set($artist_data);

                $artist->save();

                $track->artists()->syncWithoutDetaching($artist->id);
            }

            DB::commit();

            return response()->json([
                "message" => "track record created"
            ], 201);
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    public function getTrack($id)
    {
        if (Track::where('id', $id)->exists()) {
            $track = Track::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($track, 200);
        } else {
            return response()->json([
                "message" => "Track not found"
            ], 404);
        }
    }

    public function updateTrack(Request $request, $id)
    {
        if (Track::where('id', $id)->exists()) {
            $track = Track::find($id);

            $track->isrc = is_null($request->isrc) ? $track->isrc : $request->isrc;
            $track->thumb_url = is_null($request->thumb_url) ? $track->thumb_url : $request->thumb_url;
            $track->release_date = is_null($request->release_date) ? $track->release_date : $request->release_date;
            $track->title = is_null($request->title) ? $track->title : $request->title;
            $track->length = is_null($request->length) ? $track->length : $request->length;
            $track->spotify_url = is_null($request->spotify_url) ? $track->spotify_url : $request->spotify_url;
            $track->preview_url = is_null($request->preview_url) ? $track->preview_url : $request->preview_url;
            $track->br_avaiable = is_null($request->br_avaiable) ? $track->br_avaiable : $request->br_avaiable;

            $track->save();

            return response()->json([
                "message" => "Track updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Track not found"
            ], 404);
        }
    }

    public function deleteTrack($id)
    {
        if (Track::where('id', $id)->exists()) {
            $track = Track::find($id);

            $track->delete();

            return response()->json([
                "message" => "Track deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Track not found"
            ], 404);
        }
    }
}
