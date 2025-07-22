<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use OpenApi\Attributes as OA;

#[OA\Info(version: 'v1', title: 'Music API')]
#[OA\SecurityScheme(
    securityScheme: 'ApiToken',
    in: 'header',
    name: 'Authorization',
    type: 'apiKey',
    description: 'Bearer mytoken'
)]
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
