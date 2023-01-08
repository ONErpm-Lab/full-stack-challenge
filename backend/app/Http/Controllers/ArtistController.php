<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use App\Models\Artist;

class ArtistController extends Controller
{
    public function getAllArtists()
    {
        $artists = Artist::get()->toJson(JSON_PRETTY_PRINT);
        return response($artists, Response::HTTP_OK);
    }

    public function createArtist(Request $request)
    {
        $artist = new Artist;

        $artist->spotify_id = $request->spotify_id;
        $artist->name = $request->name;

        $artist->save();

        return response()->json([
            "message" => "Artist saved!"
        ], Response::HTTP_CREATED);
    }

    public function getArtist($id)
    {
        if (Artist::where('id', $id)->exists()) {
            $artist = Artist::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($artist, Response::HTTP_OK);
        } else {
            return response()->json([
                "message" => "Artist not found!"
            ], Response::HTTP_NOT_FOUND);
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
                "message" => "Artist updated!"
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                "message" => "Artist not found!"
            ], Response::HTTP_NOT_FOUND);
        }
    }

    public function deleteArtist($id)
    {
        if (Artist::where('id', $id)->exists()) {
            $artist = Artist::find($id);

            $artist->delete();

            return response()->json([
                "message" => "Artist deleted!"
            ], Response::HTTP_ACCEPTED);
        } else {
            return response()->json([
                "message" => "Artist not found!"
            ], Response::HTTP_NOT_FOUND);
        }
    }
}
