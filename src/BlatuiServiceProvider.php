<?php

namespace BlatUI;

use BlatUI\Console\Commands\AddCommand;
use BlatUI\Console\Commands\InitCommand;
use BlatUI\Console\Commands\ListCommand;
use Illuminate\Support\ServiceProvider;

class BlatuiServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(Registry::class, fn () => new Registry());
    }

    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                InitCommand::class,
                ListCommand::class,
                AddCommand::class,
            ]);

            // Foundations: theme tokens (CSS) + Alpine/chart/calendar engine (JS).
            // php artisan vendor:publish --tag=blatui-foundations
            $this->publishes([
                dirname(__DIR__).'/stubs/foundations/app.css' => resource_path('css/blatui.css'),
                dirname(__DIR__).'/stubs/foundations/app.js' => resource_path('js/blatui.js'),
            ], 'blatui-foundations');
        }
    }
}
