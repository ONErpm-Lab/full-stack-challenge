<?php

use PHPUnit\Framework\TestCase;
use App\Services\TokenService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;

class TokenServiceTest extends TestCase
{
    public function testGetAccessToken()
    {
        $mockHandler = new MockHandler([
            new Response(200, [], '{"access_token": "test_access_token"}'),
        ]);
        $handlerStack = HandlerStack::create($mockHandler);
        $httpClient = new Client(['handler' => $handlerStack]);

        $tokenService = new TokenService($httpClient);

        $response = $tokenService->getAccessToken();
        $this->assertEquals($response, "test_access_token");
    }
}

