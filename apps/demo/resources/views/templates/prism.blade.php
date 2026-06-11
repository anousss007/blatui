@php
    /* ——— DATA ——— */

    $navLinks = ['Explore' => '#explore', 'Collections' => '#collections', 'Artists' => '#artists', 'Auctions' => '#auctions'];

    $categories = [
        ['key' => 'all',          'label' => 'All Art'],
        ['key' => 'generative',   'label' => 'Generative'],
        ['key' => 'photography',  'label' => 'Photography'],
        ['key' => 'illustration', 'label' => 'Illustration'],
        ['key' => '3d',           'label' => '3D / Motion'],
    ];

    $collections = [
        ['title' => 'Chromatic Dreams',  'artist' => 'Nova Pixel',     'floor' => '0.48 ETH', 'items' => 120, 'seed' => 'chroma1',  'w' => 400, 'h' => 400, 'a1seed' => 'av11', 'a2seed' => 'av12', 'a3seed' => 'av13', 'tag' => 'generative'],
        ['title' => 'Neon Phantoms',     'artist' => 'Zeynep Alt',     'floor' => '1.20 ETH', 'items' => 88,  'seed' => 'neon7',   'w' => 400, 'h' => 400, 'a1seed' => 'av21', 'a2seed' => 'av22', 'a3seed' => 'av23', 'tag' => 'illustration'],
        ['title' => 'Void Frequencies',  'artist' => 'LMNOP Studio',   'floor' => '0.72 ETH', 'items' => 200, 'seed' => 'voidf',   'w' => 400, 'h' => 400, 'a1seed' => 'av31', 'a2seed' => 'av32', 'a3seed' => 'av33', 'tag' => '3d'],
        ['title' => 'Sacred Geometry',   'artist' => 'Orion Flux',     'floor' => '2.05 ETH', 'items' => 64,  'seed' => 'sacred1', 'w' => 400, 'h' => 400, 'a1seed' => 'av41', 'a2seed' => 'av42', 'a3seed' => 'av43', 'tag' => 'generative'],
        ['title' => 'Urban Reverie',     'artist' => 'Maren Cole',     'floor' => '0.31 ETH', 'items' => 150, 'seed' => 'urban9',  'w' => 400, 'h' => 400, 'a1seed' => 'av51', 'a2seed' => 'av52', 'a3seed' => 'av53', 'tag' => 'photography'],
        ['title' => 'Data Blooms',       'artist' => 'Kai Tanaka',     'floor' => '0.95 ETH', 'items' => 77,  'seed' => 'bloom2',  'w' => 400, 'h' => 400, 'a1seed' => 'av61', 'a2seed' => 'av62', 'a3seed' => 'av63', 'tag' => '3d'],
    ];

    $artists = [
        ['name' => 'Nova Pixel',   'handle' => '@novapixel',  'vol' => '142.3 ETH', 'works' => 312, 'seed' => 'artist1',  'vseed' => 'art1v', 'vw' => 60, 'vh' => 60],
        ['name' => 'Zeynep Alt',   'handle' => '@zeynep_alt', 'vol' => '98.7 ETH',  'works' => 89,  'seed' => 'artist2',  'vseed' => 'art2v', 'vw' => 60, 'vh' => 60],
        ['name' => 'LMNOP Studio', 'handle' => '@lmnop',      'vol' => '210.1 ETH', 'works' => 44,  'seed' => 'artist3',  'vseed' => 'art3v', 'vw' => 60, 'vh' => 60],
        ['name' => 'Orion Flux',   'handle' => '@orionflux',  'vol' => '55.0 ETH',  'works' => 190, 'seed' => 'artist4',  'vseed' => 'art4v', 'vw' => 60, 'vh' => 60],
        ['name' => 'Maren Cole',   'handle' => '@marencole',  'vol' => '77.4 ETH',  'works' => 130, 'seed' => 'artist5',  'vseed' => 'art5v', 'vw' => 60, 'vh' => 60],
        ['name' => 'Kai Tanaka',   'handle' => '@kai_t',      'vol' => '186.8 ETH', 'works' => 65,  'seed' => 'artist6',  'vseed' => 'art6v', 'vw' => 60, 'vh' => 60],
    ];

    $carouselArt = [
        ['title' => 'Prismatic Loop #7',   'price' => '0.62 ETH', 'seed' => 'crs1', 'w' => 600, 'h' => 500],
        ['title' => 'Spectral Entity',      'price' => '1.40 ETH', 'seed' => 'crs2', 'w' => 600, 'h' => 500],
        ['title' => 'Gradient Rift',        'price' => '0.88 ETH', 'seed' => 'crs3', 'w' => 600, 'h' => 500],
        ['title' => 'Holo Ghost',           'price' => '2.10 ETH', 'seed' => 'crs4', 'w' => 600, 'h' => 500],
        ['title' => 'Refracted Light #3',   'price' => '0.51 ETH', 'seed' => 'crs5', 'w' => 600, 'h' => 500],
    ];

    $auctions = [
        [
            'title'   => 'Iridescent Being #001',
            'artist'  => 'Nova Pixel',
            'bid'     => '3.20 ETH',
            'bidder'  => '0x8f3a…d1c9',
            'bids'    => 24,
            'seed'    => 'auc1',
            'aseed'   => 'av11',
            'ends'    => 7260,
        ],
        [
            'title'   => 'Hologram Reverie',
            'artist'  => 'LMNOP Studio',
            'bid'     => '1.85 ETH',
            'bidder'  => '0x2b9e…f440',
            'bids'    => 11,
            'seed'    => 'auc2',
            'aseed'   => 'av31',
            'ends'    => 18430,
        ],
        [
            'title'   => 'Spectral Overture',
            'artist'  => 'Kai Tanaka',
            'bid'     => '0.97 ETH',
            'bidder'  => '0x7d21…8b02',
            'bids'    => 6,
            'seed'    => 'auc3',
            'aseed'   => 'av61',
            'ends'    => 3610,
        ],
    ];

    $bidsTable = [
        ['from' => '0x8f3a…d1c9', 'amount' => '3.20 ETH', 'time' => '2 min ago',  'flag' => 'success'],
        ['from' => '0x7d21…8b02', 'amount' => '2.95 ETH', 'time' => '8 min ago',  'flag' => 'neutral'],
        ['from' => '0x4ac7…e331', 'amount' => '2.70 ETH', 'time' => '15 min ago', 'flag' => 'neutral'],
        ['from' => '0x1bf0…9924', 'amount' => '2.40 ETH', 'time' => '31 min ago', 'flag' => 'neutral'],
    ];

    $howItWorks = [
        ['title' => 'Connect Wallet',  'desc' => 'Link MetaMask, WalletConnect or any EVM wallet in seconds.'],
        ['title' => 'Discover & Bid',  'desc' => 'Browse curated drops, trending collections and live auctions.'],
        ['title' => 'Mint or Purchase','desc' => 'Bid, buy now, or mint directly from verified creator drops.'],
        ['title' => 'Own Your Art',    'desc' => 'Receive your piece on-chain. Display, resell, or gift it anytime.'],
    ];

    $faqs = [
        ['q' => 'What wallets are supported?',
         'a' => 'Prism supports MetaMask, WalletConnect, Coinbase Wallet, and all major EVM-compatible wallets. More chains coming soon.'],
        ['q' => 'How are royalties handled?',
         'a' => 'Creators earn a configurable royalty (up to 10%) on every secondary sale, enforced on-chain.'],
        ['q' => 'Is curation editorial or algorithmic?',
         'a' => 'Both. Our editorial team hand-picks Featured Drops; Trending collections are ranked by on-chain activity.'],
        ['q' => 'What are the platform fees?',
         'a' => 'Prism takes a flat 2.5% fee on completed sales — one of the lowest in the market.'],
        ['q' => 'Can I sell photography or AI-assisted work?',
         'a' => 'Yes. Any digital work is welcome as long as you hold the rights. AI-assisted pieces must be disclosed in the listing.'],
    ];

    $footerLinks = [
        'Marketplace' => ['Explore', 'Collections', 'Live Auctions', 'New Drops', 'Rankings'],
        'Creators'    => ['Apply to Create', 'Creator Hub', 'Royalties', 'Verify Identity', 'Brand Kit'],
        'Company'     => ['About', 'Blog', 'Careers', 'Press', 'Contact'],
        'Legal'       => ['Terms', 'Privacy', 'Cookie Policy', 'DMCA', 'Accessibility'],
    ];
@endphp

<x-layouts.app title="Prism — Digital Art Marketplace">

<style>
/* ── Prism template — scoped under #tpl-prism ── */
@import url('https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap');

/* Palette tokens */
#tpl-prism {
    --prism-bg:        #0a0a12;
    --prism-bg2:       #0d0b1a;
    --prism-surface:   rgba(255,255,255,0.04);
    --prism-border:    rgba(255,255,255,0.09);
    --prism-text:      #f0ecff;
    --prism-muted:     rgba(240,236,255,0.5);
    --prism-mono:      'Geist Mono', ui-monospace, monospace;

    /* Gradient stops */
    --g-mag:  #ff5ed2;
    --g-vio:  #8b5cf6;
    --g-cya:  #22d3ee;
    --g-lime: #a3e635;

    font-family: 'Inter', sans-serif;
    background: var(--prism-bg);
    color: var(--prism-text);
    overflow-x: hidden;
}

/* Grain overlay */
#tpl-prism::before {
    content: '';
    position: fixed;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.75' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23n)' opacity='0.03'/%3E%3C/svg%3E");
    pointer-events: none;
    z-index: 9999;
}

/* Holographic animated gradient */
@keyframes holo-shift {
    0%   { filter: hue-rotate(0deg); }
    50%  { filter: hue-rotate(40deg); }
    100% { filter: hue-rotate(0deg); }
}
@keyframes gradient-move {
    0%   { background-position: 0% 50%; }
    50%  { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
@keyframes border-spin {
    to { --angle: 360deg; }
}
@keyframes float-slow {
    0%, 100% { transform: translateY(0px); }
    50%       { transform: translateY(-14px); }
}
@keyframes pulse-glow {
    0%, 100% { opacity: 0.6; }
    50%       { opacity: 1; }
}
@media (prefers-reduced-motion: reduce) {
    .prism-holo-text,
    .prism-holo-bg,
    .prism-float,
    .prism-pulse,
    .prism-border-anim { animation: none !important; }
}

/* Holographic text */
.prism-holo-text {
    background: linear-gradient(135deg, var(--g-mag), var(--g-vio), var(--g-cya), var(--g-lime), var(--g-mag));
    background-size: 300% 300%;
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
    animation: gradient-move 12s ease infinite, holo-shift 14s ease infinite;
}

/* Holographic backgrounds */
.prism-holo-bg {
    background: linear-gradient(135deg, var(--g-mag), var(--g-vio), var(--g-cya), var(--g-lime));
    background-size: 300% 300%;
    animation: gradient-move 10s ease infinite;
}

/* Glass surface */
.prism-glass {
    background: var(--prism-surface);
    border: 1px solid var(--prism-border);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
}

/* Animated gradient border card */
.prism-card-border {
    position: relative;
    border-radius: 16px;
    padding: 1px;
    background: linear-gradient(135deg, #ff5ed255, #8b5cf655, #22d3ee55, #a3e63555);
    background-size: 300% 300%;
    animation: gradient-move 8s ease infinite;
}
.prism-card-border > * {
    border-radius: 15px;
    background: #0d0b1a;
}

/* Art card hover glow */
.prism-art-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.prism-art-card:hover {
    transform: translateY(-4px) scale(1.01);
    box-shadow: 0 0 40px rgba(139,92,246,0.4), 0 0 80px rgba(34,211,238,0.15);
}

/* Float animation */
.prism-float {
    animation: float-slow 5s ease-in-out infinite;
}

/* Pulse glow */
.prism-pulse {
    animation: pulse-glow 2s ease-in-out infinite;
}

/* Mono text */
.prism-mono {
    font-family: var(--prism-mono);
    letter-spacing: -0.02em;
}

/* Section divider */
.prism-divider {
    height: 1px;
    background: linear-gradient(to right, transparent, rgba(139,92,246,0.4), rgba(34,211,238,0.4), transparent);
}

/* Scrollbar */
#tpl-prism ::-webkit-scrollbar { width: 4px; height: 4px; }
#tpl-prism ::-webkit-scrollbar-track { background: var(--prism-bg); }
#tpl-prism ::-webkit-scrollbar-thumb { background: #8b5cf650; border-radius: 4px; }

/* Nav active glow link */
.prism-nav-link {
    color: var(--prism-muted);
    font-size: 0.875rem;
    font-weight: 500;
    padding: 0.375rem 0.75rem;
    border-radius: 0.5rem;
    transition: color 0.2s, background 0.2s;
}
.prism-nav-link:hover {
    color: var(--prism-text);
    background: rgba(255,255,255,0.07);
}

/* Hero orb */
.prism-orb {
    border-radius: 50%;
    filter: blur(80px);
    position: absolute;
    pointer-events: none;
}

/* Bid countdown digits */
.prism-countdown-digit {
    font-family: var(--prism-mono);
    font-size: 1.5rem;
    font-weight: 700;
    background: var(--prism-surface);
    border: 1px solid var(--prism-border);
    border-radius: 8px;
    padding: 4px 10px;
    min-width: 52px;
    text-align: center;
    line-height: 1.4;
}

/* Override BlatUI table for dark theme */
#tpl-prism [data-slot="table-container"] {
    background: transparent;
    border-color: var(--prism-border);
}
#tpl-prism [data-slot="table-row"] {
    border-color: var(--prism-border);
}
#tpl-prism [data-slot="table-row"]:hover {
    background: rgba(255,255,255,0.04);
}
#tpl-prism [data-slot="table-head"],
#tpl-prism [data-slot="table-cell"] {
    color: var(--prism-text);
}

/* Accordion dark override */
#tpl-prism [data-slot="accordion-item"] {
    border-color: var(--prism-border);
}
#tpl-prism [data-slot="accordion-trigger"] {
    color: var(--prism-text);
}
#tpl-prism [data-slot="accordion-content"] {
    color: var(--prism-muted);
}

/* Stepper dark override */
#tpl-prism [data-slot="stepper-indicator"][data-state="inactive"] {
    border-color: rgba(255,255,255,0.2);
    color: var(--prism-muted);
}
#tpl-prism [data-slot="stepper-separator"] {
    background: rgba(255,255,255,0.12);
}
#tpl-prism [data-slot="stepper-title"] {
    color: var(--prism-text);
}
#tpl-prism [data-slot="stepper-description"] {
    color: var(--prism-muted);
}

/* Tabs dark override */
#tpl-prism [data-slot="tabs-list"] {
    background: rgba(255,255,255,0.06);
    border: 1px solid var(--prism-border);
}
#tpl-prism [data-slot="tabs-trigger"][data-state="active"] {
    background: rgba(139,92,246,0.25) !important;
    color: #c4b5fd !important;
    border-color: rgba(139,92,246,0.4) !important;
}
#tpl-prism [data-slot="tabs-trigger"] {
    color: var(--prism-muted);
}

/* Progress dark */
#tpl-prism [data-slot="progress"] {
    background: rgba(255,255,255,0.08);
}
</style>

<div id="tpl-prism" class="min-h-screen" style="background:#0a0a12;">

    {{-- ═══════════════════════════════════════════
         NAV
    ═══════════════════════════════════════════ --}}
    <header class="prism-glass sticky top-0 z-50" style="border-bottom:1px solid rgba(255,255,255,0.08);">
        <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-6">
            {{-- Wordmark --}}
            <a href="#" class="flex items-center gap-2.5" aria-label="Prism home">
                <span class="prism-holo-bg flex size-8 items-center justify-center rounded-lg text-white font-bold text-sm shrink-0">P</span>
                <span class="font-bold text-lg tracking-tight" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">Prism</span>
            </a>

            <nav class="ml-6 hidden items-center gap-1 md:flex" aria-label="Main navigation">
                @foreach ($navLinks as $label => $href)
                    <a href="{{ $href }}" class="prism-nav-link">{{ $label }}</a>
                @endforeach
            </nav>

            <div class="ml-auto flex items-center gap-2">
                <x-ui.tooltip :delay="200">
                    <x-ui.tooltip-trigger>
                        <button type="button" class="prism-nav-link hidden sm:inline-flex items-center gap-1.5 px-3 py-1.5 rounded-md text-sm font-medium" style="color:rgba(240,236,255,0.6);">
                            <x-lucide-search class="size-4" />
                            <span>Search</span>
                        </button>
                    </x-ui.tooltip-trigger>
                    <x-ui.tooltip-content>Search artworks &amp; artists</x-ui.tooltip-content>
                </x-ui.tooltip>

                <x-ui.button
                    href="#"
                    variant="outline"
                    size="sm"
                    class="hidden sm:inline-flex"
                    style="border-color:rgba(139,92,246,0.5); color:#c4b5fd; background:rgba(139,92,246,0.08);"
                >
                    <x-lucide-wallet class="size-3.5" />
                    Connect Wallet
                </x-ui.button>

                <x-ui.badge tone="success" variant="soft" class="hidden sm:inline-flex gap-1.5">
                    <span class="prism-pulse inline-block size-1.5 rounded-full bg-emerald-400"></span>
                    ETH 3,210
                </x-ui.badge>
            </div>
        </div>
    </header>

    {{-- ═══════════════════════════════════════════
         HERO — Featured Drop
    ═══════════════════════════════════════════ --}}
    <section class="relative overflow-hidden" style="min-height:88vh; display:flex; align-items:center;">
        {{-- Background orbs --}}
        <div class="prism-orb prism-pulse" style="width:600px;height:600px;background:radial-gradient(circle,rgba(139,92,246,0.22) 0%,transparent 70%);top:-100px;left:-100px;"></div>
        <div class="prism-orb prism-pulse" style="width:500px;height:500px;background:radial-gradient(circle,rgba(34,211,238,0.18) 0%,transparent 70%);top:50%;right:-80px;animation-delay:1s;"></div>
        <div class="prism-orb" style="width:300px;height:300px;background:radial-gradient(circle,rgba(255,94,210,0.15) 0%,transparent 70%);bottom:-50px;left:40%;"></div>

        <div class="relative mx-auto grid max-w-7xl items-center gap-12 px-6 py-20 lg:grid-cols-2 lg:py-28 w-full">
            {{-- Left: text + countdown --}}
            <div class="order-2 lg:order-1">
                <x-ui.badge variant="default" class="mb-5" style="background:rgba(255,94,210,0.15); color:#ff5ed2; border-color:rgba(255,94,210,0.3);">
                    <span class="prism-pulse inline-block size-1.5 rounded-full bg-rose-400"></span>
                    Featured Drop · Live Auction
                </x-ui.badge>

                <h1 class="text-5xl font-bold tracking-tight text-balance sm:text-6xl lg:text-7xl mb-2" style="font-family:'Space Grotesk',sans-serif; line-height:1.05;">
                    <span class="prism-holo-text">Iridescent</span><br>
                    <span style="color:#f0ecff;">Being #001</span>
                </h1>

                <div class="flex items-center gap-3 mt-5 mb-6">
                    <x-ui.avatar class="size-10 ring-2" style="--tw-ring-color:rgba(139,92,246,0.5);">
                        <x-ui.avatar-image src="https://picsum.photos/seed/av11/80/80" alt="Nova Pixel" />
                        <x-ui.avatar-fallback>NP</x-ui.avatar-fallback>
                    </x-ui.avatar>
                    <div>
                        <div class="text-sm font-semibold" style="color:#f0ecff;">Nova Pixel</div>
                        <div class="text-xs" style="color:rgba(240,236,255,0.5);">Verified Creator</div>
                    </div>
                    <x-ui.badge tone="info" variant="soft" class="ml-2">
                        <x-lucide-badge-check class="size-3" />
                        Verified
                    </x-ui.badge>
                </div>

                <p class="text-base leading-relaxed mb-8" style="color:rgba(240,236,255,0.65); max-width:480px;">
                    A transcendent journey through prismatic light and digital matter. Each element is procedurally generated from on-chain entropy — no two are alike.
                </p>

                {{-- Auction countdown --}}
                <div
                    x-data="{
                        total: 7260,
                        get h() { return String(Math.floor(this.total / 3600)).padStart(2,'0') },
                        get m() { return String(Math.floor((this.total % 3600) / 60)).padStart(2,'0') },
                        get s() { return String(this.total % 60).padStart(2,'0') },
                        tick() { if (this.total > 0) this.total-- },
                        init() { setInterval(() => this.tick(), 1000) }
                    }"
                    class="mb-6"
                >
                    <div class="text-xs font-medium uppercase tracking-widest mb-3" style="color:rgba(240,236,255,0.45);">Auction ends in</div>
                    <div class="flex items-center gap-2">
                        <div class="flex flex-col items-center">
                            <span class="prism-countdown-digit" x-text="h" style="color:#c4b5fd;"></span>
                            <span class="text-[10px] mt-1" style="color:rgba(240,236,255,0.4);">HRS</span>
                        </div>
                        <span class="prism-countdown-digit flex items-center justify-center pb-5" style="color:rgba(139,92,246,0.6); background:transparent; border:none; font-size:1.25rem;">:</span>
                        <div class="flex flex-col items-center">
                            <span class="prism-countdown-digit" x-text="m" style="color:#c4b5fd;"></span>
                            <span class="text-[10px] mt-1" style="color:rgba(240,236,255,0.4);">MIN</span>
                        </div>
                        <span class="prism-countdown-digit flex items-center justify-center pb-5" style="color:rgba(139,92,246,0.6); background:transparent; border:none; font-size:1.25rem;">:</span>
                        <div class="flex flex-col items-center">
                            <span class="prism-countdown-digit" x-text="s" style="color:#c4b5fd;"></span>
                            <span class="text-[10px] mt-1" style="color:rgba(240,236,255,0.4);">SEC</span>
                        </div>
                    </div>
                </div>

                {{-- Current bid --}}
                <div class="prism-glass rounded-2xl p-4 mb-6 inline-flex flex-col gap-1" style="min-width:220px;">
                    <span class="text-xs uppercase tracking-widest" style="color:rgba(240,236,255,0.45);">Current Bid</span>
                    <span class="prism-mono text-3xl font-bold prism-holo-text">3.20 ETH</span>
                    <span class="text-xs prism-mono" style="color:rgba(240,236,255,0.4);">≈ $10,944 USD · 24 bids</span>
                </div>

                <div class="flex flex-wrap items-center gap-3">
                    <x-ui.button href="#" size="lg" class="prism-holo-bg border-0 text-white font-semibold shadow-lg" style="box-shadow:0 0 30px rgba(139,92,246,0.4);">
                        <x-lucide-gavel class="size-4" />
                        Place Bid
                    </x-ui.button>
                    <x-ui.button href="#" size="lg" variant="outline" style="border-color:rgba(255,255,255,0.15); color:#f0ecff; background:rgba(255,255,255,0.05);">
                        <x-lucide-eye class="size-4" />
                        View Details
                    </x-ui.button>
                </div>
            </div>

            {{-- Right: featured artwork --}}
            <div class="order-1 lg:order-2 flex justify-center">
                <div class="prism-float relative" style="max-width:480px; width:100%;">
                    <div class="prism-card-border">
                        <div class="overflow-hidden rounded-[15px]">
                            <img
                                src="https://picsum.photos/seed/hero-prism/800/900"
                                alt="Iridescent Being #001 — featured NFT artwork"
                                class="w-full object-cover"
                                style="aspect-ratio:4/4.5;"
                            />
                        </div>
                    </div>
                    {{-- Floating badge --}}
                    <div class="absolute -bottom-4 -right-4 prism-glass rounded-xl px-4 py-2.5" style="border:1px solid rgba(163,230,53,0.3);">
                        <div class="text-xs" style="color:rgba(240,236,255,0.5);">Floor price</div>
                        <div class="prism-mono font-bold text-sm" style="color:#a3e635;">0.48 ETH</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="prism-divider"></div>

    {{-- ═══════════════════════════════════════════
         TRENDING COLLECTIONS
    ═══════════════════════════════════════════ --}}
    <section id="collections" class="py-20 scroll-mt-20">
        <div class="mx-auto max-w-7xl px-6">
            <div class="flex items-end justify-between mb-12">
                <div>
                    <x-ui.badge variant="outline" class="mb-3" style="border-color:rgba(139,92,246,0.4); color:#c4b5fd;">Trending</x-ui.badge>
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">
                        Top Collections
                    </h2>
                </div>
                <x-ui.button href="#" variant="ghost" size="sm" style="color:#c4b5fd;">
                    View all <x-lucide-arrow-right class="size-4" />
                </x-ui.button>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($collections as $col)
                    <div class="prism-art-card prism-glass rounded-2xl overflow-hidden cursor-pointer" style="border:1px solid rgba(255,255,255,0.08);">
                        <div class="relative overflow-hidden" style="aspect-ratio:1/1;">
                            <img
                                src="https://picsum.photos/seed/{{ $col['seed'] }}/{{ $col['w'] }}/{{ $col['h'] }}"
                                alt="{{ $col['title'] }} collection artwork"
                                class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                loading="lazy"
                            />
                            {{-- Overlay on hover --}}
                            <div class="absolute inset-0 opacity-0 hover:opacity-100 transition-opacity duration-300 flex items-end p-4" style="background:linear-gradient(to top,rgba(10,10,18,0.9) 0%,transparent 60%);">
                                <x-ui.button href="#" size="sm" class="prism-holo-bg border-0 text-white w-full justify-center">
                                    <x-lucide-shopping-bag class="size-3.5" />
                                    Buy Now
                                </x-ui.button>
                            </div>
                            <div class="absolute top-3 right-3">
                                <x-ui.badge variant="default" style="background:rgba(10,10,18,0.75); color:#f0ecff; border-color:rgba(255,255,255,0.15); backdrop-filter:blur(8px);">
                                    {{ $col['items'] }} items
                                </x-ui.badge>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-start justify-between mb-3">
                                <div>
                                    <h3 class="font-semibold text-base" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">{{ $col['title'] }}</h3>
                                    <p class="text-xs mt-0.5" style="color:rgba(240,236,255,0.5);">by {{ $col['artist'] }}</p>
                                </div>
                                <x-ui.badge tone="neutral" variant="soft" style="background:rgba(255,255,255,0.06); color:rgba(240,236,255,0.6); border-color:transparent;">
                                    {{ $col['tag'] }}
                                </x-ui.badge>
                            </div>
                            <x-ui.separator style="background:rgba(255,255,255,0.07);" />
                            <div class="flex items-center justify-between mt-3">
                                <div>
                                    <div class="text-[10px] uppercase tracking-wider" style="color:rgba(240,236,255,0.4);">Floor</div>
                                    <div class="prism-mono font-semibold text-sm" style="color:#a3e635;">{{ $col['floor'] }}</div>
                                </div>
                                <div class="flex -space-x-1.5">
                                    @foreach ([$col['a1seed'], $col['a2seed'], $col['a3seed']] as $aseed)
                                        <x-ui.avatar class="size-6 ring-1" style="--tw-ring-color:rgba(10,10,18,0.8);">
                                            <x-ui.avatar-image src="https://picsum.photos/seed/{{ $aseed }}/48/48" alt="" />
                                            <x-ui.avatar-fallback style="background:rgba(139,92,246,0.2); color:#c4b5fd; font-size:0.5rem;">A</x-ui.avatar-fallback>
                                        </x-ui.avatar>
                                    @endforeach
                                    <div class="size-6 rounded-full ring-1 flex items-center justify-center text-[9px] font-medium" style="--tw-ring-color:rgba(10,10,18,0.8); background:rgba(139,92,246,0.2); color:#c4b5fd; ring-color:rgba(10,10,18,0.8);">+</div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="prism-divider"></div>

    {{-- ═══════════════════════════════════════════
         TOP ARTISTS
    ═══════════════════════════════════════════ --}}
    <section id="artists" class="py-20 scroll-mt-20" style="background:rgba(13,11,26,0.8);">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-12 text-center">
                <x-ui.badge variant="outline" class="mb-3" style="border-color:rgba(34,211,238,0.4); color:#22d3ee;">Creators</x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">
                    Top Artists This Week
                </h2>
                <p class="mt-3 text-base" style="color:rgba(240,236,255,0.5);">Ranked by on-chain trading volume over the last 7 days.</p>
            </div>

            <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($artists as $idx => $artist)
                    <x-ui.hover-card>
                        <x-ui.hover-card-trigger>
                            <div class="prism-glass rounded-2xl p-5 flex items-center gap-4 cursor-pointer transition-all duration-200 hover:border-violet-500/30" style="border:1px solid rgba(255,255,255,0.08);">
                                <span class="prism-mono text-xl font-bold w-8 text-center shrink-0" style="color:rgba(240,236,255,0.25);">{{ str_pad($idx + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                <x-ui.avatar class="size-14 ring-2" style="--tw-ring-color:rgba(139,92,246,0.3);">
                                    <x-ui.avatar-image src="https://picsum.photos/seed/{{ $artist['seed'] }}/112/112" alt="{{ $artist['name'] }}" />
                                    <x-ui.avatar-fallback style="background:rgba(139,92,246,0.2); color:#c4b5fd;">{{ substr($artist['name'],0,1) }}</x-ui.avatar-fallback>
                                </x-ui.avatar>
                                <div class="flex-1 min-w-0">
                                    <div class="font-semibold truncate" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">{{ $artist['name'] }}</div>
                                    <div class="text-xs truncate" style="color:rgba(240,236,255,0.4);">{{ $artist['handle'] }}</div>
                                    <div class="mt-1.5 flex items-center gap-2">
                                        <x-ui.progress :value="min(100, ($idx === 2 ? 100 : ($idx === 0 ? 68 : ($idx === 5 ? 89 : ($idx === 1 ? 47 : ($idx === 4 ? 37 : 26))))))" aria-label="Relative volume" class="h-1 flex-1" style="--tw-bg-opacity:1;" />
                                    </div>
                                </div>
                                <div class="text-right shrink-0">
                                    <div class="prism-mono font-bold text-sm" style="color:#a3e635;">{{ $artist['vol'] }}</div>
                                    <div class="text-[10px] mt-0.5" style="color:rgba(240,236,255,0.4);">{{ $artist['works'] }} works</div>
                                </div>
                            </div>
                        </x-ui.hover-card-trigger>
                        <x-ui.hover-card-content side="top" align="start" style="background:#0d0b1a; border-color:rgba(139,92,246,0.3); color:#f0ecff;">
                            <div class="flex gap-3 items-start">
                                <x-ui.avatar class="size-12">
                                    <x-ui.avatar-image src="https://picsum.photos/seed/{{ $artist['vseed'] }}/96/96" alt="{{ $artist['name'] }}" />
                                    <x-ui.avatar-fallback style="background:rgba(139,92,246,0.2); color:#c4b5fd;">{{ substr($artist['name'],0,1) }}</x-ui.avatar-fallback>
                                </x-ui.avatar>
                                <div>
                                    <div class="font-semibold text-sm" style="font-family:'Space Grotesk',sans-serif;">{{ $artist['name'] }}</div>
                                    <div class="text-xs mt-0.5" style="color:rgba(240,236,255,0.5);">{{ $artist['handle'] }}</div>
                                    <div class="mt-2 flex gap-3 text-xs">
                                        <span><span class="font-semibold prism-mono" style="color:#c4b5fd;">{{ $artist['vol'] }}</span> volume</span>
                                        <span><span class="font-semibold prism-mono" style="color:#22d3ee;">{{ $artist['works'] }}</span> works</span>
                                    </div>
                                </div>
                            </div>
                        </x-ui.hover-card-content>
                    </x-ui.hover-card>
                @endforeach
            </div>
        </div>
    </section>

    <div class="prism-divider"></div>

    {{-- ═══════════════════════════════════════════
         ARTWORK CAROUSEL
    ═══════════════════════════════════════════ --}}
    <section class="py-20">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-12 flex items-end justify-between">
                <div>
                    <x-ui.badge variant="outline" class="mb-3" style="border-color:rgba(255,94,210,0.4); color:#ff5ed2;">Gallery</x-ui.badge>
                    <h2 class="text-3xl font-bold tracking-tight sm:text-4xl" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">
                        Artworks for You
                    </h2>
                </div>
            </div>

            <x-ui.carousel class="w-full">
                <x-ui.carousel-content class="-ml-4">
                    @foreach ($carouselArt as $art)
                        <x-ui.carousel-item class="pl-4 basis-full sm:basis-1/2 lg:basis-1/3">
                            <div class="prism-art-card prism-glass rounded-2xl overflow-hidden" style="border:1px solid rgba(255,255,255,0.08);">
                                <div class="relative overflow-hidden" style="aspect-ratio:4/3;">
                                    <img
                                        src="https://picsum.photos/seed/{{ $art['seed'] }}/{{ $art['w'] }}/{{ $art['h'] }}"
                                        alt="{{ $art['title'] }} artwork"
                                        class="w-full h-full object-cover"
                                        loading="lazy"
                                    />
                                    <div class="absolute top-3 left-3">
                                        <x-ui.badge variant="default" style="background:rgba(10,10,18,0.8); color:#f0ecff; border-color:rgba(255,255,255,0.1); backdrop-filter:blur(8px);">
                                            <x-lucide-layers class="size-3" />
                                            1 of 1
                                        </x-ui.badge>
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex items-center justify-between">
                                        <h3 class="font-semibold text-sm" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">{{ $art['title'] }}</h3>
                                        <span class="prism-mono font-bold text-sm" style="color:#a3e635;">{{ $art['price'] }}</span>
                                    </div>
                                    <div class="mt-3 flex gap-2">
                                        <x-ui.button href="#" size="xs" class="flex-1 justify-center prism-holo-bg border-0 text-white">Buy</x-ui.button>
                                        <x-ui.button href="#" size="xs" variant="outline" style="border-color:rgba(255,255,255,0.15); color:#f0ecff; background:transparent;">
                                            <x-lucide-heart class="size-3" />
                                        </x-ui.button>
                                    </div>
                                </div>
                            </div>
                        </x-ui.carousel-item>
                    @endforeach
                </x-ui.carousel-content>
                <x-ui.carousel-previous style="border-color:rgba(139,92,246,0.4); background:rgba(13,11,26,0.9); color:#c4b5fd;" />
                <x-ui.carousel-next style="border-color:rgba(139,92,246,0.4); background:rgba(13,11,26,0.9); color:#c4b5fd;" />
            </x-ui.carousel>
        </div>
    </section>

    <div class="prism-divider"></div>

    {{-- ═══════════════════════════════════════════
         LIVE AUCTIONS — cards + bids table
    ═══════════════════════════════════════════ --}}
    <section id="auctions" class="py-20 scroll-mt-20" style="background:rgba(13,11,26,0.8);">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-12 text-center">
                <x-ui.badge variant="default" class="mb-3" style="background:rgba(255,94,210,0.15); color:#ff5ed2; border-color:rgba(255,94,210,0.3);">
                    <span class="prism-pulse inline-block size-1.5 rounded-full bg-rose-400"></span>
                    Live Now
                </x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">
                    Live Auctions
                </h2>
            </div>

            <div class="grid gap-6 lg:grid-cols-3 mb-14">
                @foreach ($auctions as $auc)
                    <div
                        x-data="{
                            total: {{ $auc['ends'] }},
                            get h() { return String(Math.floor(this.total/3600)).padStart(2,'0') },
                            get m() { return String(Math.floor((this.total%3600)/60)).padStart(2,'0') },
                            get s() { return String(this.total%60).padStart(2,'0') },
                            tick() { if(this.total>0) this.total-- },
                            init() { setInterval(()=>this.tick(),1000) }
                        }"
                        class="prism-art-card prism-glass rounded-2xl overflow-hidden"
                        style="border:1px solid rgba(255,255,255,0.08);"
                    >
                        <div class="relative overflow-hidden" style="aspect-ratio:4/3;">
                            <img
                                src="https://picsum.photos/seed/{{ $auc['seed'] }}/600/450"
                                alt="{{ $auc['title'] }} auction artwork"
                                class="w-full h-full object-cover"
                                loading="lazy"
                            />
                            <div class="absolute inset-x-0 bottom-0 p-3 flex items-center justify-between" style="background:linear-gradient(to top,rgba(10,10,18,0.95) 0%,transparent 100%);">
                                <div class="prism-mono text-xs font-semibold" style="color:#ff5ed2;">
                                    <span x-text="h"></span>:<span x-text="m"></span>:<span x-text="s"></span>
                                </div>
                                <x-ui.badge variant="default" style="background:rgba(255,94,210,0.2); color:#ff5ed2; border-color:rgba(255,94,210,0.3); font-size:0.65rem;">
                                    {{ $auc['bids'] }} bids
                                </x-ui.badge>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="flex items-center gap-2 mb-3">
                                <x-ui.avatar class="size-7">
                                    <x-ui.avatar-image src="https://picsum.photos/seed/{{ $auc['aseed'] }}/56/56" alt="{{ $auc['artist'] }}" />
                                    <x-ui.avatar-fallback style="background:rgba(139,92,246,0.2); color:#c4b5fd; font-size:0.6rem;">{{ substr($auc['artist'],0,1) }}</x-ui.avatar-fallback>
                                </x-ui.avatar>
                                <span class="text-xs" style="color:rgba(240,236,255,0.5);">{{ $auc['artist'] }}</span>
                            </div>
                            <h3 class="font-semibold text-base mb-1" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">{{ $auc['title'] }}</h3>
                            <div class="flex items-end justify-between mt-3">
                                <div>
                                    <div class="text-[10px] uppercase tracking-wider" style="color:rgba(240,236,255,0.4);">Current Bid</div>
                                    <div class="prism-mono font-bold text-lg" style="color:#a3e635;">{{ $auc['bid'] }}</div>
                                </div>
                                <div class="text-right">
                                    <div class="text-[10px] uppercase tracking-wider" style="color:rgba(240,236,255,0.4);">Top Bidder</div>
                                    <div class="prism-mono text-xs" style="color:rgba(240,236,255,0.55);">{{ $auc['bidder'] }}</div>
                                </div>
                            </div>
                            <x-ui.button href="#" size="sm" class="mt-4 w-full justify-center prism-holo-bg border-0 text-white font-semibold">
                                <x-lucide-gavel class="size-3.5" />
                                Place Bid
                            </x-ui.button>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Bid history table --}}
            <div class="prism-glass rounded-2xl overflow-hidden" style="border:1px solid rgba(255,255,255,0.08);">
                <div class="px-5 py-4 flex items-center justify-between" style="border-bottom:1px solid rgba(255,255,255,0.07);">
                    <h3 class="font-semibold text-sm" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">
                        Recent Bids — Iridescent Being #001
                    </h3>
                    <x-ui.badge tone="success" variant="soft" class="gap-1.5">
                        <span class="prism-pulse inline-block size-1.5 rounded-full bg-emerald-400"></span>
                        Live
                    </x-ui.badge>
                </div>
                <x-ui.table>
                    <x-ui.table-header>
                        <x-ui.table-row>
                            <x-ui.table-head>From</x-ui.table-head>
                            <x-ui.table-head>Amount</x-ui.table-head>
                            <x-ui.table-head>Time</x-ui.table-head>
                            <x-ui.table-head>Status</x-ui.table-head>
                        </x-ui.table-row>
                    </x-ui.table-header>
                    <x-ui.table-body>
                        @foreach ($bidsTable as $bid)
                            <x-ui.table-row>
                                <x-ui.table-cell>
                                    <span class="prism-mono text-xs" style="color:rgba(240,236,255,0.7);">{{ $bid['from'] }}</span>
                                </x-ui.table-cell>
                                <x-ui.table-cell>
                                    <span class="prism-mono font-semibold text-sm" style="color:#a3e635;">{{ $bid['amount'] }}</span>
                                </x-ui.table-cell>
                                <x-ui.table-cell>
                                    <span class="text-xs" style="color:rgba(240,236,255,0.4);">{{ $bid['time'] }}</span>
                                </x-ui.table-cell>
                                <x-ui.table-cell>
                                    @if ($bid['flag'] === 'success')
                                        <x-ui.badge tone="success" variant="soft" class="gap-1">
                                            <x-lucide-crown class="size-2.5" />
                                            Highest
                                        </x-ui.badge>
                                    @else
                                        <x-ui.badge tone="neutral" variant="soft">Outbid</x-ui.badge>
                                    @endif
                                </x-ui.table-cell>
                            </x-ui.table-row>
                        @endforeach
                    </x-ui.table-body>
                </x-ui.table>
            </div>
        </div>
    </section>

    <div class="prism-divider"></div>

    {{-- ═══════════════════════════════════════════
         HOW IT WORKS — Stepper
    ═══════════════════════════════════════════ --}}
    <section class="py-20">
        <div class="mx-auto max-w-4xl px-6">
            <div class="mb-14 text-center">
                <x-ui.badge variant="outline" class="mb-3" style="border-color:rgba(163,230,53,0.4); color:#a3e635;">Simple</x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">
                    How It Works
                </h2>
                <p class="mt-3 text-base" style="color:rgba(240,236,255,0.5);">Collect, trade, and own digital art in four steps.</p>
            </div>

            <x-ui.stepper :value="2" orientation="horizontal">
                <ol class="flex w-full items-start gap-0">
                    @foreach ($howItWorks as $si => $step)
                        <x-ui.stepper-item :step="$si + 1" class="flex-1">
                            <x-ui.stepper-trigger class="flex-col items-center text-center gap-2 w-full">
                                <x-ui.stepper-indicator style="background:rgba(13,11,26,1); border-color:rgba(139,92,246,0.4);" />
                                <div class="flex flex-col items-center gap-1">
                                    <x-ui.stepper-title style="color:#f0ecff; font-family:'Space Grotesk',sans-serif;">{{ $step['title'] }}</x-ui.stepper-title>
                                    <x-ui.stepper-description class="text-center max-w-[140px]">{{ $step['desc'] }}</x-ui.stepper-description>
                                </div>
                            </x-ui.stepper-trigger>
                            @if ($si < count($howItWorks) - 1)
                                <x-ui.stepper-separator />
                            @endif
                        </x-ui.stepper-item>
                    @endforeach
                </ol>
            </x-ui.stepper>
        </div>
    </section>

    <div class="prism-divider"></div>

    {{-- ═══════════════════════════════════════════
         CATEGORIES — Tabs
    ═══════════════════════════════════════════ --}}
    <section id="explore" class="py-20 scroll-mt-20" style="background:rgba(13,11,26,0.8);">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-10 text-center">
                <x-ui.badge variant="outline" class="mb-3" style="border-color:rgba(34,211,238,0.4); color:#22d3ee;">Browse</x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">
                    Explore by Category
                </h2>
            </div>

            <x-ui.tabs value="all" class="w-full">
                <x-ui.tabs-list variant="pills" class="mx-auto mb-10 flex-wrap justify-center gap-2">
                    @foreach ($categories as $cat)
                        <x-ui.tabs-trigger value="{{ $cat['key'] }}">{{ $cat['label'] }}</x-ui.tabs-trigger>
                    @endforeach
                </x-ui.tabs-list>

                @foreach ($categories as $cat)
                    <x-ui.tabs-content value="{{ $cat['key'] }}">
                        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                            @php
                                $seedMap = [
                                    'all'          => ['cat-all-a','cat-all-b','cat-all-c','cat-all-d'],
                                    'generative'   => ['gen-a','gen-b','gen-c','gen-d'],
                                    'photography'  => ['pho-a','pho-b','pho-c','pho-d'],
                                    'illustration' => ['ill-a','ill-b','ill-c','ill-d'],
                                    '3d'           => ['thr-a','thr-b','thr-c','thr-d'],
                                ];
                                $seeds = $seedMap[$cat['key']] ?? $seedMap['all'];
                                $prices = ['0.14 ETH','0.28 ETH','0.62 ETH','1.05 ETH'];
                                $names = ['Fragment #'.(rand(10,99)), 'Echo Series #'.(rand(1,9)), 'Drift #'.(rand(100,199)), 'Arc #'.(rand(200,299))];
                            @endphp
                            @for ($ci = 0; $ci < 4; $ci++)
                                <div class="prism-art-card prism-glass rounded-xl overflow-hidden" style="border:1px solid rgba(255,255,255,0.08);">
                                    <div class="overflow-hidden" style="aspect-ratio:1/1;">
                                        <img
                                            src="https://picsum.photos/seed/{{ $seeds[$ci] }}/400/400"
                                            alt="{{ $names[$ci] }} digital artwork"
                                            class="w-full h-full object-cover"
                                            loading="lazy"
                                        />
                                    </div>
                                    <div class="p-3">
                                        <div class="flex items-center justify-between">
                                            <span class="text-xs font-medium" style="color:#f0ecff;">{{ $names[$ci] }}</span>
                                            <span class="prism-mono text-xs font-semibold" style="color:#a3e635;">{{ $prices[$ci] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endfor
                        </div>
                    </x-ui.tabs-content>
                @endforeach
            </x-ui.tabs>
        </div>
    </section>

    <div class="prism-divider"></div>

    {{-- ═══════════════════════════════════════════
         CREATORS CTA
    ═══════════════════════════════════════════ --}}
    <section class="py-20">
        <div class="mx-auto max-w-6xl px-6">
            <div class="prism-card-border">
                <div class="rounded-[15px] overflow-hidden relative px-8 py-14 text-center" style="background:linear-gradient(135deg,rgba(139,92,246,0.15) 0%,rgba(34,211,238,0.08) 50%,rgba(255,94,210,0.12) 100%);">
                    {{-- decorative orbs --}}
                    <div class="prism-orb" style="width:300px;height:300px;background:radial-gradient(circle,rgba(139,92,246,0.2) 0%,transparent 70%);top:-80px;left:-60px;"></div>
                    <div class="prism-orb" style="width:250px;height:250px;background:radial-gradient(circle,rgba(34,211,238,0.15) 0%,transparent 70%);bottom:-60px;right:-40px;"></div>

                    <x-ui.badge variant="outline" class="mb-5" style="border-color:rgba(255,94,210,0.4); color:#ff5ed2;">For Creators</x-ui.badge>
                    <h2 class="text-3xl font-bold tracking-tight text-balance sm:text-5xl mb-4" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">
                        Mint your vision.<br>
                        <span class="prism-holo-text">Own your future.</span>
                    </h2>
                    <p class="text-base max-w-xl mx-auto mb-8" style="color:rgba(240,236,255,0.6);">
                        Join 12,000+ digital artists on Prism. Keep up to 97.5% of every sale and earn royalties forever on secondaries.
                    </p>
                    <div class="flex flex-wrap items-center justify-center gap-4">
                        <x-ui.button href="#" size="lg" class="prism-holo-bg border-0 text-white font-semibold" style="box-shadow:0 0 40px rgba(139,92,246,0.35);">
                            <x-lucide-sparkles class="size-4" />
                            Apply to Create
                        </x-ui.button>
                        <x-ui.button href="#" size="lg" variant="outline" style="border-color:rgba(255,255,255,0.2); color:#f0ecff; background:rgba(255,255,255,0.05);">
                            Learn more <x-lucide-arrow-right class="size-4" />
                        </x-ui.button>
                    </div>
                    <div class="mt-8 flex flex-wrap items-center justify-center gap-6">
                        @foreach (['2.5% platform fee', 'Up to 10% royalties', 'On-chain provenance', 'Gas-optimised minting'] as $feat)
                            <div class="flex items-center gap-2 text-sm" style="color:rgba(240,236,255,0.6);">
                                <x-lucide-check class="size-4" style="color:#a3e635;" />
                                {{ $feat }}
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="prism-divider"></div>

    {{-- ═══════════════════════════════════════════
         FAQ — Accordion
    ═══════════════════════════════════════════ --}}
    <section class="py-20" style="background:rgba(13,11,26,0.8);">
        <div class="mx-auto max-w-3xl px-6">
            <div class="mb-12 text-center">
                <x-ui.badge variant="outline" class="mb-3" style="border-color:rgba(139,92,246,0.4); color:#c4b5fd;">FAQ</x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight sm:text-4xl" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">
                    Questions Answered
                </h2>
            </div>

            <x-ui.accordion type="single" collapsible value="faq-0">
                @foreach ($faqs as $fi => $faq)
                    <x-ui.accordion-item value="faq-{{ $fi }}">
                        <x-ui.accordion-trigger>{{ $faq['q'] }}</x-ui.accordion-trigger>
                        <x-ui.accordion-content>{{ $faq['a'] }}</x-ui.accordion-content>
                    </x-ui.accordion-item>
                @endforeach
            </x-ui.accordion>
        </div>
    </section>

    <div class="prism-divider"></div>

    {{-- ═══════════════════════════════════════════
         FOOTER
    ═══════════════════════════════════════════ --}}
    <footer class="py-14" style="border-top:1px solid rgba(255,255,255,0.06);">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-6">
                <div class="lg:col-span-2">
                    <a href="#" class="flex items-center gap-2.5 mb-4" aria-label="Prism home">
                        <span class="prism-holo-bg flex size-9 items-center justify-center rounded-xl text-white font-bold">P</span>
                        <span class="font-bold text-xl tracking-tight" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">Prism</span>
                    </a>
                    <p class="text-sm max-w-xs mb-5" style="color:rgba(240,236,255,0.45);">
                        The holographic NFT marketplace for digital artists and collectors. Own the future of art.
                    </p>
                    <div class="flex gap-2 mb-6">
                        @foreach (['twitter', 'youtube', 'linkedin', 'github'] as $soc)
                            <a href="#" aria-label="{{ $soc }}" class="inline-flex size-9 items-center justify-center rounded-lg transition-colors" style="border:1px solid rgba(255,255,255,0.1); color:rgba(240,236,255,0.5); background:rgba(255,255,255,0.04);">
                                <x-dynamic-component :component="'lucide-'.$soc" class="size-4" />
                            </a>
                        @endforeach
                    </div>
                    <div class="flex items-center gap-2">
                        <x-ui.badge tone="success" variant="soft" class="gap-1.5">
                            <span class="inline-block size-1.5 rounded-full bg-emerald-400"></span>
                            All systems operational
                        </x-ui.badge>
                    </div>
                </div>

                @foreach ($footerLinks as $heading => $links)
                    <div>
                        <h3 class="text-sm font-semibold mb-4" style="font-family:'Space Grotesk',sans-serif; color:#f0ecff;">{{ $heading }}</h3>
                        <ul class="space-y-2.5">
                            @foreach ($links as $link)
                                <li>
                                    <a href="#" class="text-sm transition-colors hover:text-violet-300" style="color:rgba(240,236,255,0.45);">{{ $link }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <x-ui.separator class="my-8" style="background:rgba(255,255,255,0.07);" />

            <div class="flex flex-col items-center justify-between gap-4 sm:flex-row">
                <span class="text-sm" style="color:rgba(240,236,255,0.35);">
                    &copy; {{ date('Y') }} Prism Labs, Inc. All rights reserved.
                </span>
                <div class="flex items-center gap-3">
                    <x-ui.badge variant="outline" class="gap-1.5 text-[10px]" style="border-color:rgba(255,255,255,0.1); color:rgba(240,236,255,0.4);">
                        <x-lucide-zap class="size-2.5" />
                        Powered by Ethereum
                    </x-ui.badge>
                    <x-ui.badge variant="outline" class="gap-1.5 text-[10px]" style="border-color:rgba(255,255,255,0.1); color:rgba(240,236,255,0.4);">
                        <x-lucide-shield-check class="size-2.5" />
                        Audited Contracts
                    </x-ui.badge>
                </div>
            </div>
        </div>
    </footer>

</div>
</x-layouts.app>
