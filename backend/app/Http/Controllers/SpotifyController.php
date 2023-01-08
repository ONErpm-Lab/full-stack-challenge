<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Symfony\Component\HttpFoundation\Response;

class SpotifyController extends Controller
{
    public function token()
    {
        $client_id = config("app.SPOTIFY_CLIENT_ID");
        $client_secret = config("app.SPOTIFY_CLIENT_SECRET");

        $client = new Client();

        $response = $client->request("POST", "https://accounts.spotify.com/api/token", [
            "headers" => [
                "Content-Type" => "application/x-www-form-urlencoded",
            ],
            "form_params" => [
                "grant_type" => "client_credentials",
            ],
            "auth" => [
                $client_id, $client_secret,
            ],
        ]);

        return response($response->getBody(), Response::HTTP_OK);
    }
}
