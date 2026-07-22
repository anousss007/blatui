@props([
    'title' => null,
    'description' => null,
])

@php
    use Illuminate\Support\Str;

    $brand = config('brand.name');
    $base = rtrim(config('brand.url'), '/');
    $description = $description ?: config('brand.description');
    $homeTitle = $brand.' — '.config('brand.tagline');
    // Pages pass a short title ("Blocks"); append the brand unless it's already there.
    $fullTitle = ! $title ? $homeTitle : (str_contains($title, $brand) ? $title : $title.' — '.$brand);

    // Canonicalisation: a "/raw" standalone (templates/blocks/charts) duplicates its viewer page,
    // and ?query variants (e.g. theme share links) duplicate the clean URL — point both at the clean
    // canonical and keep /raw out of the index so ranking signals consolidate on one URL.
    $path = trim(request()->path(), '/');
    $isRaw = Str::endsWith($path, '/raw');
    $cleanPath = $isRaw ? Str::beforeLast($path, '/raw') : $path;
    $canonical = $cleanPath === '' ? $base.'/' : $base.'/'.$cleanPath;
    $noindex = $isRaw;

    // Breadcrumb trail derived from the clean path (Home › Section › Page).
    $crumbs = [['name' => $brand, 'url' => $base.'/']];
    $acc = '';
    foreach (array_filter(explode('/', $cleanPath)) as $seg) {
        $acc .= '/'.$seg;
        $crumbs[] = ['name' => Str::headline($seg), 'url' => $base.$acc];
    }

    $graph = [
        [
            '@type' => 'WebSite',
            '@id' => $base.'/#website',
            'name' => $brand,
            'url' => $base.'/',
            'description' => config('brand.description'),
            'publisher' => ['@id' => $base.'/#org'],
            'inLanguage' => 'en',
        ],
        [
            '@type' => 'Organization',
            '@id' => $base.'/#org',
            'name' => $brand,
            'url' => $base.'/',
            'logo' => $base.'/favicon.svg',
            'sameAs' => array_values(array_filter([config('brand.github'), config('brand.package')])),
        ],
        [
            '@type' => 'SoftwareApplication',
            '@id' => $base.'/#software',
            'name' => $brand,
            'applicationCategory' => 'DeveloperApplication',
            'operatingSystem' => 'Any',
            'description' => config('brand.description'),
            'url' => $base.'/',
            'softwareHelp' => $base.'/docs',
            'license' => 'https://opensource.org/licenses/MIT',
            'isAccessibleForFree' => true,
            'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'USD'],
            'codeRepository' => config('brand.package'),
            'publisher' => ['@id' => $base.'/#org'],
        ],
    ];

    if (count($crumbs) > 1) {
        $graph[] = [
            '@type' => 'BreadcrumbList',
            'itemListElement' => array_map(fn ($c, $i) => [
                '@type' => 'ListItem', 'position' => $i + 1, 'name' => $c['name'], 'item' => $c['url'],
            ], $crumbs, array_keys($crumbs)),
        ];
    }

    $jsonLd = json_encode([
        '@context' => 'https://schema.org',
        '@graph' => $graph,
    ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ $fullTitle }}</title>
    <meta name="description" content="{{ $description }}">
    <link rel="canonical" href="{{ $canonical }}">
    <meta name="robots" content="{{ $noindex ? 'noindex, follow' : 'index, follow, max-snippet:-1, max-image-preview:large, max-video-preview:-1' }}">
    <meta name="author" content="{{ $brand }}">
    <link rel="manifest" href="/site.webmanifest">
    <meta name="theme-color" content="#ffffff" media="(prefers-color-scheme: light)">
    <meta name="theme-color" content="#0a0a0a" media="(prefers-color-scheme: dark)">

    {{-- Open Graph --}}
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $brand }}">
    <meta property="og:title" content="{{ $fullTitle }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:url" content="{{ $canonical }}">
    <meta property="og:image" content="{{ url('/og.png') }}">
    <meta property="og:image:type" content="image/png">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">
    <meta property="og:image:alt" content="{{ $brand }} — {{ config('brand.tagline') }}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $fullTitle }}">
    <meta name="twitter:description" content="{{ $description }}">
    <meta name="twitter:image" content="{{ url('/og.png') }}">

    {{-- Structured data --}}
    <script type="application/ld+json">{!! $jsonLd !!}</script>

    {{-- Agent discovery: machine-readable resources for AI agents --}}
    <link rel="alternate" type="text/markdown" href="{{ $canonical }}.md" title="Markdown">
    <link rel="llms-txt" type="text/markdown" href="{{ url('/llms.txt') }}" title="LLM index">
    <link rel="sitemap" type="application/xml" href="{{ url('/sitemap.xml') }}">
    <link rel="api-catalog" href="{{ url('/.well-known/api-catalog') }}">
    <link rel="mcp-server" href="{{ url('/.well-known/mcp/server-card.json') }}">
    <link rel="agent-card" href="{{ url('/.well-known/agent-card.json') }}">
    <meta name="mcp-endpoint" content="{{ url('/mcp') }}">

    {{-- WebMCP: expose in-page tools to a browser agent when the API exists --}}
    <script>
        (function () {
            const mc = navigator.modelContext;
            if (!mc || typeof mc.registerTool !== 'function') return;
            const origin = location.origin;
            mc.registerTool({
                name: 'search_blatui',
                description: 'Search BlatUI components, blocks and charts by name or description.',
                inputSchema: { type: 'object', properties: { query: { type: 'string' } }, required: ['query'] },
                async execute({ query }) {
                    const res = await fetch(origin + '/registry.json');
                    const data = await res.json();
                    const q = String(query || '').toLowerCase();
                    // Skip deprecated (merged) items: their search keywords live on the
                    // canonical component, so a query for "autocomplete" resolves to combobox.
                    const hits = (data.items || []).filter(i => !i.deprecated).filter(i =>
                        (i.name + ' ' + (i.title || '') + ' ' + (i.description || '') + ' ' + (i.keywords || []).join(' ')).toLowerCase().includes(q)
                    ).slice(0, 25).map(i => `- [${i.type}] ${i.name}${i.description ? ' — ' + i.description : ''}`);
                    return { content: [{ type: 'text', text: hits.join('\n') || 'No matches.' }] };
                },
            });
        })();
    </script>

    {{-- Icons --}}
    <link rel="icon" href="/favicon.svg" type="image/svg+xml">
    <link rel="apple-touch-icon" href="/favicon.svg">

    {{-- Customizer font families (privacy-friendly Bunny mirror; graceful fallback offline) --}}
    <link rel="preconnect" href="https://fonts.bunny.net" crossorigin>
    <link rel="stylesheet" href="https://fonts.bunny.net/css?family=dm-sans:400,500,600,700|geist:400,500,600,700|inter:400,500,600,700|jetbrains-mono:400,500,600,700|lora:400,500,600,700|manrope:400,500,600,700|outfit:400,500,600,700|plus-jakarta-sans:400,500,600,700|sora:400,500,600,700|source-serif-4:400,500,600,700|space-grotesk:400,500,600,700">

    {{-- Demo-site brand identity (Forge dev-tool aesthetic): a themeable green accent that adapts
         to light/dark, plus a JetBrains Mono utility. Scoped to the showcase chrome — NOT shipped
         in the package foundation. --}}
    <style>
        :root { --blat-brand: #15803d; --blat-brand-fg: #ffffff; --blat-brand-ink: #15803d; --blat-brand-cyan: #0e7490; }
        .dark { --blat-brand: #3fb950; --blat-brand-fg: #052e16; --blat-brand-ink: #56d364; --blat-brand-cyan: #39c5cf; }
        .blat-mono { font-family: 'JetBrains Mono', ui-monospace, 'SFMono-Regular', monospace; }
        .blat-brand-fill { background: var(--blat-brand); color: var(--blat-brand-fg); }
        .blat-brand-text { color: var(--blat-brand-ink); }
        .blat-card { transition: border-color .2s ease, box-shadow .2s ease, transform .2s ease; }
        .blat-card:hover { border-color: color-mix(in srgb, var(--blat-brand) 45%, transparent); }
        .blat-icon-tile {
            background: color-mix(in srgb, var(--blat-brand) 12%, transparent);
            color: var(--blat-brand-ink);
            border: 1px solid color-mix(in srgb, var(--blat-brand) 25%, transparent);
        }
        .blat-pill {
            background: color-mix(in srgb, var(--blat-brand) 10%, transparent);
            color: var(--blat-brand-ink);
            border: 1px solid color-mix(in srgb, var(--blat-brand) 30%, transparent);
        }
        .blat-hairline { background: linear-gradient(90deg, transparent, var(--border), transparent); }
        .blat-dotgrid {
            background-image: radial-gradient(circle, var(--border) 1px, transparent 1px);
            background-size: 22px 22px;
        }
        .blat-glow-btn { box-shadow: 0 0 0 0 transparent; transition: box-shadow .2s ease, transform .2s ease; }
        .blat-glow-btn:hover { box-shadow: 0 0 28px -4px var(--blat-brand); transform: translateY(-1px); }
        /* Terminal chrome — intentionally dark in BOTH themes (a terminal is a terminal). */
        .blat-term { background: #0b0f17; border: 1px solid #20262e; border-radius: .7rem; overflow: hidden; box-shadow: 0 1px 0 #ffffff0a inset, 0 24px 60px -20px #00000080; }
        .blat-term-bar { background: #11161f; border-bottom: 1px solid #20262e; }
        .blat-term-body { font-family: 'JetBrains Mono', ui-monospace, monospace; color: #e6edf3; overflow-x: auto; overscroll-behavior-x: contain; scrollbar-width: thin; }
        @keyframes blat-caret { 0%,49%{opacity:1} 50%,100%{opacity:0} }
        .blat-caret { display:inline-block; width:.55ch; height:1.05em; background: var(--blat-brand); vertical-align:text-bottom; animation: blat-caret 1.1s step-end infinite; }
        @keyframes blat-line-in { from{opacity:0; transform:translateY(3px)} to{opacity:1; transform:translateY(0)} }
        /* Keep each command on one line; the body scrolls horizontally on narrow screens
           (authentic terminal behaviour) instead of wrapping a command mid-line. */
        .blat-term-line { animation: blat-line-in .25s ease both; white-space: nowrap; }
        @media (prefers-reduced-motion: reduce) { .blat-caret{animation:none;opacity:1} .blat-term-line{animation:none} .blat-glow-btn:hover{transform:none} }
    </style>


    {{-- No-flash: apply every persisted theme dimension before first paint.
         A ?t= shared-theme link is decoded and adopted (persisted) up front so
         it both paints correctly and becomes the working theme. --}}
    <script>
        (function () {
            const root = document.documentElement;
            try {
                const p = new URLSearchParams(location.search).get('t');
                if (p) {
                    const shared = JSON.parse(atob(p.replace(/-/g, '+').replace(/_/g, '/')));
                    if (shared && typeof shared === 'object') {
                        ['mode', 'base', 'preset', 'radius', 'font', 'shadow', 'spacing', 'tracking', 'inputStyle', 'fontHeading']
                            .forEach((k) => { if (shared[k] != null) localStorage.setItem('theme:' + k, String(shared[k])); });
                    }
                }
            } catch (e) { /* malformed share link — ignore */ }
            const get = (k, d) => localStorage.getItem('theme:' + k) || d;
            const mode = get('mode', 'system');
            const dark = mode === 'dark' || (mode === 'system' && matchMedia('(prefers-color-scheme: dark)').matches);
            root.classList.toggle('dark', dark);
            const set = (attr, val, fallback) => {
                if (val && val !== fallback) root.setAttribute(attr, val);
                else root.removeAttribute(attr);
            };
            set('data-base', get('base', 'neutral'), 'neutral');
            set('data-theme', get('preset', 'default'), 'default');
            set('data-font', get('font', 'sans'), 'sans');
            set('data-shadow', get('shadow', 'default'), 'default');
            set('data-spacing', get('spacing', 'default'), 'default');
            set('data-tracking', get('tracking', 'normal'), 'normal');
            set('data-input-style', get('inputStyle', 'outline'), 'outline');
            set('data-font-heading', get('fontHeading', 'sans'), 'sans');
            root.setAttribute('data-radius', get('radius', '0.625'));
        })();
    </script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body x-data class="min-h-screen bg-background font-sans text-foreground antialiased">
    {{ $slot }}
</body>
</html>
