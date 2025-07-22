<?php

namespace App\Http\Integrations\Spotify\Requests;

use Saloon\Enums\Method;
use Saloon\Http\SoloRequest;
use Saloon\Contracts\Body\HasBody;
use Saloon\Traits\Body\HasFormBody;
use Saloon\Traits\Plugins\AlwaysThrowOnErrors;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;
use Illuminate\Support\Facades\Cache;

class GetAccessTokenRequest extends SoloRequest implements HasBody, Cacheable
{
    use HasCaching;
    use HasFormBody;
    use AlwaysThrowOnErrors;

    protected Method $method = Method::POST;

    public function resolveEndpoint(): string
    {
        return 'https://accounts.spotify.com/api/token';
    }

    protected function defaultBody(): array
    {
        return [
            'grant_type' => 'client_credentials',
            'client_id' => config('services.spotify.client_id'),
            'client_secret' => config('services.spotify.client_secret'),
        ];
    }

    public function resolveCacheDriver(): Driver
    {
        return new LaravelCacheDriver(Cache::store('redis'));
    }

    protected function getCacheableMethods(): array
    {
        return [Method::POST];
    }

    public function cacheExpiryInSeconds(): int
    {
        return 60 * 59;
    }
}
