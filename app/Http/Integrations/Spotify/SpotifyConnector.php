<?php

namespace App\Http\Integrations\Spotify;

use Saloon\Http\Connector;
use Saloon\Http\Auth\TokenAuthenticator;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Saloon\RateLimitPlugin\Limit;
use Saloon\RateLimitPlugin\Traits\HasRateLimits;
use Saloon\RateLimitPlugin\Contracts\RateLimitStore;
use Saloon\RateLimitPlugin\Stores\LaravelCacheStore;
use Illuminate\Support\Facades\Cache;

class SpotifyConnector extends Connector
{
    use AcceptsJson;
    use HasRateLimits;
    use AlwaysThrowOnErrors;

    public function __construct(private string $token) {}

    public function resolveBaseUrl(): string
    {
        return 'https://api.spotify.com/v1';
    }

    protected function defaultHeaders(): array
    {
        return [
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    protected function defaultAuth(): TokenAuthenticator
    {
        return new TokenAuthenticator($this->token);
    }

    protected function resolveLimits(): array
    {
        return [
            Limit::allow(50)->everySeconds(seconds: 30),
        ];
    }

    protected function resolveRateLimitStore(): RateLimitStore
    {
        return new LaravelCacheStore(Cache::store('redis'));
    }
}
