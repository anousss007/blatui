<?php

use App\Mcp\HttpServer;
use App\Support\AgentReadiness;
use App\Support\RegistryDistribution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::view('/', 'showcase.index');

Route::view('/docs', 'docs.getting-started')->name('docs.getting-started');

Route::view('/docs/mcp', 'docs.mcp')->name('docs.mcp');

Route::view('/themes', 'themes.index')->name('themes');

Route::get('/sitemap.xml', function () {
    $entries = [];
    $add = function (string $path, string $priority, string $freq, ?string $lastmod = null) use (&$entries) {
        $entries[] = compact('path', 'priority', 'freq', 'lastmod');
    };

    // Primary surfaces.
    $add('/', '1.0', 'weekly');
    foreach (['/components', '/blocks', '/templates', '/charts', '/docs'] as $p) {
        $add($p, '0.9', 'weekly');
    }
    $add('/themes', '0.8', 'weekly');
    $add('/docs/mcp', '0.6', 'monthly');

    // Component pages (one per example directory).
    foreach (glob(resource_path('views/examples/*'), GLOB_ONLYDIR) as $d) {
        $add('/components/'.basename($d), '0.8', 'monthly', date('Y-m-d', filemtime($d) ?: time()));
    }

    // Block / template / chart pages — the clean viewer URLs (the /raw duplicates are noindex).
    foreach (['templates' => '0.8', 'blocks' => '0.7', 'charts' => '0.6'] as $kind => $priority) {
        foreach (glob(resource_path("views/{$kind}/*.blade.php")) as $f) {
            $name = basename($f, '.blade.php');
            if ($name !== 'index') {
                $add("/{$kind}/{$name}", $priority, 'monthly', date('Y-m-d', filemtime($f) ?: time()));
            }
        }
    }

    $xml = '<?xml version="1.0" encoding="UTF-8"?>'."\n";
    $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">'."\n";
    foreach ($entries as $e) {
        $xml .= '  <url>'."\n";
        $xml .= '    <loc>'.e(url($e['path'])).'</loc>'."\n";
        if ($e['lastmod']) {
            $xml .= '    <lastmod>'.$e['lastmod'].'</lastmod>'."\n";
        }
        $xml .= '    <changefreq>'.$e['freq'].'</changefreq>'."\n";
        $xml .= '    <priority>'.$e['priority'].'</priority>'."\n";
        $xml .= '  </url>'."\n";
    }
    $xml .= '</urlset>';

    return response($xml, 200, ['Content-Type' => 'application/xml']);
})->name('sitemap');

Route::view('/blocks', 'blocks.index')->name('blocks.index');

// Examples merged into the Blocks gallery; keep the URL working.
Route::redirect('/examples', '/blocks#examples');

Route::get('/blocks/{block}/raw', function (string $block) {
    abort_unless(preg_match('/^[a-z0-9-]+$/', $block) && view()->exists("blocks.$block"), 404);

    return view("blocks.$block");
})->name('blocks.raw');

Route::get('/blocks/{block}', function (string $block) {
    abort_unless(preg_match('/^[a-z0-9-]+$/', $block) && view()->exists("blocks.$block"), 404);

    return view('docs.viewer', ['kind' => 'blocks', 'slug' => $block]);
})->name('blocks.show');

// Full-page HTML cache for static, content-only pages (templates assemble hundreds of
// components, so re-rendering per request is wasteful). The cache key carries the asset
// manifest's mtime, so every deploy (which rebuilds assets) busts it automatically. Only
// active in production — local dev always renders fresh so edits show immediately.
$cachePage = function (string $cacheKey, Closure $render) {
    if (! app()->isProduction()) {
        return $render();
    }

    $manifest = public_path('build/manifest.json');
    $sig = is_file($manifest) ? (string) filemtime($manifest) : '0';

    $html = cache()->remember("page:{$cacheKey}:{$sig}", now()->addDays(30), fn () => $render()->render());

    return response($html)->header('X-Blat-Cache', 'full-page');
};

// Templates — full, real-world pages assembled from many components.
Route::view('/templates', 'templates.index')->name('templates.index');

Route::get('/templates/{template}/raw', function (string $template) use ($cachePage) {
    abort_unless(preg_match('/^[a-z0-9-]+$/', $template) && view()->exists("templates.$template"), 404);

    return $cachePage("tpl-raw:{$template}", fn () => view("templates.$template"));
})->name('templates.raw');

Route::get('/templates/{template}', function (string $template) use ($cachePage) {
    abort_unless(preg_match('/^[a-z0-9-]+$/', $template) && view()->exists("templates.$template"), 404);

    return $cachePage("tpl-view:{$template}", fn () => view('docs.viewer', ['kind' => 'templates', 'slug' => $template]));
})->name('templates.show');

Route::view('/components', 'docs.index')->name('docs.index');

// Merged/renamed components: the old slug permanently redirects to the canonical
// component it folded into (e.g. /components/autocomplete → /components/combobox).
// Registered before the dynamic route below so these exact matches win.
foreach (config('docs.deprecated', []) as $oldSlug => $canonical) {
    Route::redirect('/components/'.$oldSlug, '/components/'.$canonical, 301);
}

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

/*
|--------------------------------------------------------------------------
| Registry distribution + AI discoverability
|--------------------------------------------------------------------------
|
| Public, shadcn-compatible endpoints so ANY tool — the official shadcn
| CLI/MCP, the BlatUI CLI, or a raw fetch — can install components, and so
| AI assistants can discover the library via llms.txt. Payloads are cached
| on a cheap content signature that busts automatically when sources change.
*/

/** Cache + serve a generated JSON payload (404 when the builder returns null). */
$registryJson = function (string $key, Closure $build) {
    $dist = app(RegistryDistribution::class);
    $data = cache()->remember(
        "blatui:dist:{$key}:{$dist->signature()}",
        now()->addDay(),
        $build,
    );

    abort_if($data === null, 404);

    return response()->json($data, 200, [
        'Access-Control-Allow-Origin' => '*',
        'Cache-Control' => 'public, max-age=3600',
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
};

/** Cache + serve generated plain text (llms.txt family). */
$registryText = function (string $key, Closure $build) {
    $dist = app(RegistryDistribution::class);
    $text = cache()->remember(
        "blatui:dist:{$key}:{$dist->signature()}",
        now()->addDay(),
        $build,
    );

    return response($text, 200, [
        'Content-Type' => 'text/markdown; charset=utf-8',
        'Access-Control-Allow-Origin' => '*',
        'Cache-Control' => 'public, max-age=3600',
    ]);
};

Route::get('/registry.json', fn () => $registryJson('index', fn () => app(RegistryDistribution::class)->index()))
    ->name('registry.index');

Route::get('/r/blocks/{name}.json', fn (string $name) => $registryJson("block:{$name}", fn () => app(RegistryDistribution::class)->blockItem($name)))
    ->where('name', '[a-z0-9-]+')->name('registry.block');

Route::get('/r/charts/{name}.json', fn (string $name) => $registryJson("chart:{$name}", fn () => app(RegistryDistribution::class)->chartItem($name)))
    ->where('name', '[a-z0-9-]+')->name('registry.chart');

Route::get('/r/{name}.json', fn (string $name) => $registryJson("component:{$name}", fn () => app(RegistryDistribution::class)->componentItem($name)))
    ->where('name', '[a-z0-9-]+')->name('registry.component');

Route::get('/llms.txt', fn () => $registryText('llms', fn () => app(RegistryDistribution::class)->llms()))
    ->name('llms');

Route::get('/llms-full.txt', fn () => $registryText('llms-full', fn () => app(RegistryDistribution::class)->llmsFull()))
    ->name('llms.full');

/*
|--------------------------------------------------------------------------
| Agent readiness — MCP endpoint + .well-known discovery documents
|--------------------------------------------------------------------------
|
| A hosted, stateless MCP server at /mcp plus the machine-readable cards that
| let AI agents discover it: MCP server card, A2A agent card, Agent Skills,
| RFC 9727 API catalogue and an OpenAPI description. Everything points back to
| the real registry, so the advertisements are honest.
*/

/** JSON (+CORS) responder for the discovery documents. */
$discoveryJson = function (array $data, string $contentType = 'application/json') {
    return response()->json($data, 200, [
        'Content-Type' => $contentType,
        'Access-Control-Allow-Origin' => '*',
        'Cache-Control' => 'public, max-age=3600',
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
};

// --- Hosted MCP endpoint (Streamable HTTP transport, stateless) ----------
Route::match(['POST', 'OPTIONS'], '/mcp', function (Request $request) {
    if ($request->isMethod('OPTIONS')) {
        return response('', 204, [
            'Access-Control-Allow-Origin' => '*',
            'Access-Control-Allow-Methods' => 'POST, OPTIONS',
            'Access-Control-Allow-Headers' => 'Content-Type, Mcp-Session-Id, Mcp-Protocol-Version',
        ]);
    }

    $server = app(HttpServer::class);
    $payload = json_decode($request->getContent(), true);

    $cors = ['Access-Control-Allow-Origin' => '*'];

    if (! is_array($payload)) {
        return response()->json(['jsonrpc' => '2.0', 'id' => null, 'error' => ['code' => -32700, 'message' => 'Parse error']], 400, $cors);
    }

    // JSON-RPC batch vs single message.
    $isBatch = array_is_list($payload);
    $messages = $isBatch ? $payload : [$payload];
    $responses = [];
    foreach ($messages as $message) {
        if (is_array($message) && ($r = $server->handle($message)) !== null) {
            $responses[] = $r;
        }
    }

    if (! $responses) {
        return response('', 202, $cors); // notifications only
    }

    return response()->json($isBatch ? $responses : $responses[0], 200, $cors,
        JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
})->name('mcp');

// GET /mcp has no SSE stream on this stateless server.
Route::get('/mcp', fn () => response()->json(
    ['error' => 'Use POST for JSON-RPC. Server card: /.well-known/mcp/server-card.json'],
    405, ['Allow' => 'POST', 'Access-Control-Allow-Origin' => '*'],
))->name('mcp.get');

// --- .well-known discovery documents -------------------------------------
Route::get('/.well-known/mcp/server-card.json', fn () => $discoveryJson(app(AgentReadiness::class)->mcpServerCard()))
    ->name('wk.mcp-card');

Route::get('/.well-known/agent-card.json', fn () => $discoveryJson(app(AgentReadiness::class)->agentCard()))
    ->name('wk.agent-card');

Route::get('/.well-known/agent-skills/index.json', fn () => $discoveryJson(app(AgentReadiness::class)->agentSkillsIndex()))
    ->name('wk.agent-skills');

Route::get('/.well-known/agent-skills/blatui/SKILL.md', fn () => response(
    app(AgentReadiness::class)->skillMarkdown(), 200, [
        'Content-Type' => 'text/markdown; charset=utf-8',
        'Access-Control-Allow-Origin' => '*',
        'Cache-Control' => 'public, max-age=3600',
    ],
))->name('wk.skill');

Route::get('/.well-known/api-catalog', fn () => $discoveryJson(app(AgentReadiness::class)->apiCatalog(), 'application/linkset+json'))
    ->name('wk.api-catalog');

Route::get('/openapi.json', fn () => $discoveryJson(app(AgentReadiness::class)->openApi()))
    ->name('openapi');
