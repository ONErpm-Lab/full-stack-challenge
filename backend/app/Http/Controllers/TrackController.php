<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Symfony\Component\HttpFoundation\Response;

use App\Models\Track;
use App\Models\Artist;

class TrackController extends Controller
{
    public function getAllTracks()
    {
        $tracks = Track::with("artists")->get()->toJson(JSON_PRETTY_PRINT);
        return response($tracks, Response::HTTP_OK);
    }

    public function createTrack(Request $request)
    {
        if (!Track::where("spotify_id", $request->spotify_id)->exists()) {
            DB::beginTransaction();

            try {
                $json = $request->getContent();

                $data = json_decode($json);

                $track = new Track;

                $track->set($data);

                unset($track["artists"]);

                $track->save();

                foreach ($data->artists as $artist_data) {
                    $artist = Artist::firstOrCreate(
                        ["spotify_id" => $artist_data->spotify_id],
                        ["name" => $artist_data->name],
                    );
    
                    $track->artists()->syncWithoutDetaching($artist->id);
                }

                DB::commit();

                return response()->json([
                    "message" => "Track saved!"
                ], Response::HTTP_CREATED);
            } catch (\Throwable $th) {
                DB::rollBack();
                throw $th;
            }
        } else {
            return response()->json([
                "message" => "Track already saved!"
            ], Response::HTTP_CREATED);
        }
    }

    public function getTrack($id)
    {
        if (Track::where("id", $id)->exists()) {
            $track = Track::where("id", $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($track, Response::HTTP_OK);
        } else {
            return response()->json([
                "message" => "Track not found!"
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function updateTrack(Request $request, $id)
    {
        if (Track::where("id", $id)->exists()) {
            $track = Track::find($id);

            $track->isrc = is_null($request->isrc) ? $track->isrc : $request->isrc;
            $track->thumb_url = is_null($request->thumb_url) ? $track->thumb_url : $request->thumb_url;
            $track->release_date = is_null($request->release_date) ? $track->release_date : $request->release_date;
            $track->title = is_null($request->title) ? $track->title : $request->title;
            $track->length = is_null($request->length) ? $track->length : $request->length;
            $track->spotify_url = is_null($request->spotify_url) ? $track->spotify_url : $request->spotify_url;
            $track->preview_url = is_null($request->preview_url) ? $track->preview_url : $request->preview_url;
            $track->br_avaiable = is_null($request->br_avaiable) ? $track->br_avaiable : $request->br_avaiable;
            $track->spotify_id = is_null($request->spotify_id) ? $track->spotify_id : $request->spotify_id;

            $track->save();

            return response()->json([
                "message" => "Track updated!"
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                "message" => "Track not found!"
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function deleteTrack($id)
    {
        if (Track::where("id", $id)->exists()) {
            $track = Track::find($id);

            $track->delete();

            return response()->json([
                "message" => "Track deleted!"
            ], Response::HTTP_ACCEPTED);
        } else {
            return response()->json([
                "message" => "Track not found!"
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
