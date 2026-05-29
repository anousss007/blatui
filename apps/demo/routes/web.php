<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'showcase.index');

Route::view('/docs', 'docs.getting-started')->name('docs.getting-started');

Route::get('/sitemap.xml', function () {
    $urls = ['/', '/docs', '/components', '/blocks', '/charts'];
    foreach (glob(resource_path('views/examples/*'), GLOB_ONLYDIR) as $d) {
        $urls[] = '/components/'.basename($d);
    }
    foreach (['blocks', 'charts'] as $kind) {
        foreach (glob(resource_path("views/{$kind}/*.blade.php")) as $f) {
            $name = basename($f, '.blade.php');
            if ($name !== 'index') {
                $urls[] = "/{$kind}/{$name}";
            }
        }
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
    foreach ($urls as $u) {
        $xml .= '  <url><loc>'.e(url($u)).'</loc></url>'."\n";
    }
    $xml .= '</urlset>';

    return response($xml, 200, ['Content-Type' => 'application/xml']);
})->name('sitemap');

Route::view('/blocks', 'blocks.index')->name('blocks.index');

Route::get('/blocks/{block}/raw', function (string $block) {
    abort_unless(preg_match('/^[a-z0-9-]+$/', $block) && view()->exists("blocks.$block"), 404);

    return view("blocks.$block");
})->name('blocks.raw');

Route::get('/blocks/{block}', function (string $block) {
    abort_unless(preg_match('/^[a-z0-9-]+$/', $block) && view()->exists("blocks.$block"), 404);

    return view('docs.viewer', ['kind' => 'blocks', 'slug' => $block]);
})->name('blocks.show');

Route::view('/components', 'docs.index')->name('docs.index');

Route::get('/components/{component}', function (string $component) {
    abort_unless(preg_match('/^[a-z0-9-]+$/', $component) && is_dir(resource_path('views/examples/'.$component)), 404);

    return view('docs.component', ['slug' => $component]);
})->name('docs.component');

Route::view('/charts', 'charts.index')->name('charts.index');

Route::get('/charts/{chart}/raw', function (string $chart) {
    abort_unless(preg_match('/^[a-z0-9-]+$/', $chart) && view()->exists("charts.$chart"), 404);

    return view("charts.$chart");
})->name('charts.raw');

Route::get('/charts/{chart}', function (string $chart) {
    abort_unless(preg_match('/^[a-z0-9-]+$/', $chart) && view()->exists("charts.$chart"), 404);

    return view('docs.viewer', ['kind' => 'charts', 'slug' => $chart]);
})->name('charts.show');
