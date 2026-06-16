<?php

namespace App\Console\Commands;

use App\Support\BlatuiRegistry;
use Illuminate\Console\Command;

/**
 * Regenerates registry.json from the authored Blade components. This file is
 * the single contract consumed by the CLI package (anousss007/blatui): the demo
 * is the source of truth, scripts/sync-package.sh ships registry.json + the
 * component stubs into the package, and the package reads the manifest
 * verbatim instead of re-deriving it.
 */
class BlatuiRegistryBuildCommand extends Command
{
    protected $signature = 'blatui:registry:build {--check : Verify registry.json is up to date without writing}';

    protected $description = 'Generate registry.json from the authored components';

    public function handle(BlatuiRegistry $registry): int
    {
        $path = base_path('registry.json');
        $json = json_encode(
            $registry->manifest(),
            JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        )."\n";

        if ($this->option('check')) {
            $current = is_file($path) ? file_get_contents($path) : '';

            if ($current !== $json) {
                $this->components->error('registry.json is out of date — run `php artisan blatui:registry:build`.');

                return self::FAILURE;
            }

            $this->components->info('registry.json is up to date.');

            return self::SUCCESS;
        }

        file_put_contents($path, $json);

        $this->components->info(count($registry->families()).' component families written to registry.json.');

        return self::SUCCESS;
    }
}
