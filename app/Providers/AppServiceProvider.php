<?php

namespace App\Providers;

use App\Adapters\SpotifyAPIAdatpter;
use App\Repositories\Contracts\RepositoryInterface;
use App\Repositories\TrackRepository;
use App\Services\Contracts\StreamingAPIInterface;
use App\Services\SpotifyAPIService;
use App\Services\TrackService;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(StreamingAPIInterface::class, function (Application $app) {
            $service = $app->make(SpotifyAPIService::class);
            return new SpotifyAPIAdatpter($service);
        });
        $this->app->when(TrackService::class)->needs(RepositoryInterface::class)->give(fn () => new TrackRepository);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
