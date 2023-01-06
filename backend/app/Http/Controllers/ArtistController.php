<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Artist;

class ArtistController extends Controller
{
    public function getAllArtists()
    {
        $artists = Artist::get()->toJson(JSON_PRETTY_PRINT);
        return response($artists, 200);
    }

    public function createArtist(Request $request)
    {
        $artist = new Artist;

        $artist->spotify_id = $request->spotify_id;
        $artist->name = $request->name;

        $artist->save();

        return response()->json([
            "message" => "artist record created"
        ], 201);
    }

    public function getArtist($id)
    {
        if (Artist::where('id', $id)->exists()) {
            $artist = Artist::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($artist, 200);
        } else {
            return response()->json([
                "message" => "Artist not found"
            ], 404);
        }
    }

    public function updateArtist(Request $request, $id)
    {
        if (Artist::where('id', $id)->exists()) {
            $artist = Artist::find($id);

            $artist->spotify_id = is_null($request->spotify_id) ? $artist->spotify_id : $request->spotify_id;
            $artist->name = is_null($request->name) ? $artist->name : $request->name;

            $artist->save();

            return response()->json([
                "message" => "Artist updated successfully"
            ], 200);
        } else {
            return response()->json([
                "message" => "Artist not found"
            ], 404);
        }
    }

    public function deleteArtist($id)
    {
        if (Artist::where('id', $id)->exists()) {
            $artist = Artist::find($id);

            $artist->delete();

            return response()->json([
                "message" => "Artist deleted"
            ], 202);
        } else {
            return response()->json([
                "message" => "Artist not found"
            ], 404);
        }
    }
}
