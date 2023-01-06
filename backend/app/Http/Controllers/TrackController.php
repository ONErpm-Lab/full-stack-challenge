<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Track;

class TrackController extends Controller
{
    public function getAllTracks()
    {
        $tracks = Track::get()->toJson(JSON_PRETTY_PRINT);
        return response($tracks, 200);
    }

    public function createTrack(Request $request)
    {
        $track = new Track;

        $track->isrc = $request->isrc;
        $track->thumb_url = $request->thumb_url;
        $track->release_date = $request->release_date;
        $track->title = $request->title;
        $track->length = $request->length;

        $track->save();

        return response()->json([
            "message" => "track record created"
        ], 201);
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
