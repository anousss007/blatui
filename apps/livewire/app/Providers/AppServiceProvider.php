<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    /**
     * Render the AUTHORED components, not a copy of them.
     *
     * apps/starter carries a GENERATED copy of apps/demo's components and pays for it with a
     * drift job in CI. This app deliberately does not: `<x-ui.field>` here compiles the very
     * file the demo renders, so there is nothing to regenerate and nothing that can go stale.
     * That matters more here than anywhere else, since the whole point of this app is to catch
     * bugs in those files that no other app can see.
     *
     * Registering the whole components directory also exposes the demo's own `layouts`,
     * `site`, `docs` and `brand` components, which are the docs site's chrome and read config
     * this app does not have. Nothing here renders them, and the page layout deliberately
     * lives under Livewire's `layouts::` namespace (resources/views/layouts/app.blade.php)
     * rather than in `components/`, so the demo's `layouts/app` can never shadow it.
     */
    public function boot(): void
    {
        if ($demo = realpath(base_path('../demo/resources/views/components'))) {
            Blade::anonymousComponentPath($demo);
        }
    }
}
