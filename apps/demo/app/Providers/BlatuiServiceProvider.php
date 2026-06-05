<?php

namespace App\Providers;

use App\Console\Commands\BlatuiRegistryBuildCommand;
use App\Support\BlatuiRegistry;
use Illuminate\Support\ServiceProvider;

class BlatuiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(BlatuiRegistry::class, fn () => new BlatuiRegistry);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                BlatuiRegistryBuildCommand::class,
            ]);
        }
    }
}
