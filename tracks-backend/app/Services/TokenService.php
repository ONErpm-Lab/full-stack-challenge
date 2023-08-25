<?php

namespace App\Services;

use GuzzleHttp\Client;

class TokenService
{
    public function __construct(
        private Client $client
    ) {
    }

    public function getAccessToken(): string
    {
        $clientID = env('SPOTIFY_CLIENT_ID');
        $clientSecret = env('SPOTIFY_CLIENT_SECRET');

        $accessTokenUrl = 'https://accounts.spotify.com/api/token';

        $data = [
            'grant_type' => 'client_credentials',
        ];

        $response = $this->client->post($accessTokenUrl, [
            'auth' => [$clientID, $clientSecret],
            'form_params' => $data,
        ]);

        if ($response->getStatusCode() !== 200) {
            throw new \Exception('Error getting access token');
        }

        $responseData = json_decode($response->getBody()->getContents(), true);
        $accessToken = $responseData['access_token'];
        return $accessToken;
    }
}
