<?php

namespace BlatUI;

use BlatUI\Console\Commands\AddCommand;
use BlatUI\Console\Commands\InitCommand;
use BlatUI\Console\Commands\ListCommand;
use BlatUI\Console\Commands\McpCommand;
use Illuminate\Support\ServiceProvider;

class BlatuiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->mergeConfigFrom(dirname(__DIR__).'/config/blatui.php', 'blatui');

        $this->app->singleton(Registry::class, fn () => new Registry);
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InitCommand::class,
                ListCommand::class,
                AddCommand::class,
                McpCommand::class,
            ]);

            // Foundations: theme tokens (CSS) + Alpine/chart/calendar engine (JS).
            // blatui.js is the greenfield bootstrap; blatui-core.js is the engine
            // (exports registerBlatUI) for apps that already run their own Alpine.
            // php artisan vendor:publish --tag=blatui-foundations
            $this->publishes([
                dirname(__DIR__).'/stubs/foundations/app.css' => resource_path('css/blatui.css'),
                dirname(__DIR__).'/stubs/foundations/app.js' => resource_path('js/blatui.js'),
                dirname(__DIR__).'/stubs/foundations/blatui-core.js' => resource_path('js/blatui-core.js'),
            ], 'blatui-foundations');
        }
    }
}
