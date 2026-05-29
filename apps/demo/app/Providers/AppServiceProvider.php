<?php

namespace App\Providers;

use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

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
        // Behind Cloudflare Tunnel the origin is reached over http, so generated
        // URLs (canonical, og:url, sitemap) would otherwise be http. Force https
        // in production so every absolute URL matches the public scheme.
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }
    }
}
