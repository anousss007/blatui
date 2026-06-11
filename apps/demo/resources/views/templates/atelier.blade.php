@php
    $fabrics = ['Boiled Wool', 'Japanese Denim', 'Duchess Satin', 'Raw Silk', 'Merino Jersey', 'Washed Linen', 'Technical Twill', 'Cashmere Blend', 'Organza', 'Ponte Roma'];

    $collections = ['Collection 01 — Umbra', 'Collection 02 — Cendre', 'Collection 03 — Ardoise', 'Collection 04 — Ivoire', 'Collection 05 — Craie'];

    $lookbookImages = [
        ['src' => 'https://picsum.photos/seed/atel-lb1/900/1200?grayscale', 'thumb' => 'https://picsum.photos/seed/atel-lb1/600/800?grayscale', 'alt' => 'Lookbook image 1 — oversized wool coat'],
        ['src' => 'https://picsum.photos/seed/atel-lb2/900/1200?grayscale', 'thumb' => 'https://picsum.photos/seed/atel-lb2/600/800?grayscale', 'alt' => 'Lookbook image 2 — structured blazer'],
        ['src' => 'https://picsum.photos/seed/atel-lb3/900/1200?grayscale', 'thumb' => 'https://picsum.photos/seed/atel-lb3/600/800?grayscale', 'alt' => 'Lookbook image 3 — draped trousers'],
        ['src' => 'https://picsum.photos/seed/atel-lb4/900/1200?grayscale', 'thumb' => 'https://picsum.photos/seed/atel-lb4/600/800?grayscale', 'alt' => 'Lookbook image 4 — silk blouse'],
        ['src' => 'https://picsum.photos/seed/atel-lb5/900/1200?grayscale', 'thumb' => 'https://picsum.photos/seed/atel-lb5/600/800?grayscale', 'alt' => 'Lookbook image 5 — minimal dress'],
        ['src' => 'https://picsum.photos/seed/atel-lb6/900/1200?grayscale', 'thumb' => 'https://picsum.photos/seed/atel-lb6/600/800?grayscale', 'alt' => 'Lookbook image 6 — tailored coat'],
    ];

    $editProducts = [
        ['name' => 'Le Manteau Oversized', 'category' => 'Outerwear', 'price' => '€ 1 290', 'badge' => 'New', 'seed' => 'atel-p1', 'w' => 480, 'h' => 640],
        ['name' => 'La Robe Tombée', 'category' => 'Dresses', 'price' => '€ 890', 'badge' => null, 'seed' => 'atel-p2', 'w' => 480, 'h' => 640],
        ['name' => 'Le Blazer Strict', 'category' => 'Tailoring', 'price' => '€ 740', 'badge' => 'Limited', 'seed' => 'atel-p3', 'w' => 480, 'h' => 640],
        ['name' => 'La Jupe Plissée', 'category' => 'Bottoms', 'price' => '€ 520', 'badge' => null, 'seed' => 'atel-p4', 'w' => 480, 'h' => 640],
    ];

    $runwaySlides = [
        ['seed' => 'atel-rw1', 'caption' => 'Look 01 — Umbra Opening'],
        ['seed' => 'atel-rw2', 'caption' => 'Look 02 — Structured Volume'],
        ['seed' => 'atel-rw3', 'caption' => 'Look 03 — Fluid Drape'],
        ['seed' => 'atel-rw4', 'caption' => 'Look 04 — Evening Silhouette'],
        ['seed' => 'atel-rw5', 'caption' => 'Look 05 — Final Exit'],
    ];

    $categories = [
        'outerwear' => [
            'label' => 'Outerwear',
            'items' => [
                ['name' => 'Manteau Double-Faced', 'price' => '€ 1 590', 'seed' => 'atel-c1'],
                ['name' => 'Trench Technique', 'price' => '€ 980', 'seed' => 'atel-c2'],
                ['name' => 'Veste Boxy', 'price' => '€ 640', 'seed' => 'atel-c3'],
            ],
        ],
        'tailoring' => [
            'label' => 'Tailoring',
            'items' => [
                ['name' => 'Blazer Croisé', 'price' => '€ 890', 'seed' => 'atel-c4'],
                ['name' => 'Pantalon Cigarette', 'price' => '€ 490', 'seed' => 'atel-c5'],
                ['name' => 'Gilet Structuré', 'price' => '€ 370', 'seed' => 'atel-c6'],
            ],
        ],
        'essentials' => [
            'label' => 'Essentials',
            'items' => [
                ['name' => 'Top Minimal', 'price' => '€ 220', 'seed' => 'atel-c7'],
                ['name' => 'Robe Fourreau', 'price' => '€ 560', 'seed' => 'atel-c8'],
                ['name' => 'Blouse en Soie', 'price' => '€ 410', 'seed' => 'atel-c9'],
            ],
        ],
    ];

    $press = ['Le Monde', 'Vogue Paris', 'SYSTEM Mag', 'AnOther', 'Dazed', 'i-D', 'CR Fashion'];

    $teamAvatars = [
        ['seed' => 'atel-t1', 'name' => 'Isabelle Moreau', 'role' => 'Creative Director'],
        ['seed' => 'atel-t2', 'name' => 'Jean-Paul Arènes', 'role' => 'Head of Atelier'],
        ['seed' => 'atel-t3', 'name' => 'Clémentine Voss', 'role' => 'Head of Design'],
    ];

    $footerLinks = [
        'Maison' => ['Story', 'Atelier', 'Sustainability', 'Careers'],
        'Collections' => ['Women', 'Men', 'Archive', 'Bespoke'],
        'Client' => ['Sizing Guide', 'Care & Repair', 'Shipping', 'Returns'],
        'Contact' => ['Press', 'Wholesale', 'Boutiques', 'Newsletter'],
    ];
@endphp

<x-layouts.app title="Maison Atelier — Fall / Winter 26">

<style>
    @import url('https://fonts.bunny.net/css?family=fraunces:400,500,600,700,900&display=swap');

    #tpl-atelier {
        --at-paper: #faf9f7;
        --at-ink: #0a0a0a;
        --at-ink-60: rgba(10,10,10,.60);
        --at-ink-20: rgba(10,10,10,.12);
        --at-accent: #ff2f00;
        --at-accent-soft: rgba(255,47,0,.08);
        --at-serif: 'Fraunces', Georgia, serif;
        --at-sans: 'Inter', system-ui, sans-serif;
        --at-radius: 0px;

        background: var(--at-paper);
        color: var(--at-ink);
        font-family: var(--at-sans);
        overflow-x: hidden;
        /* Override theme tokens scoped to this wrapper */
        --background: var(--at-paper);
        --foreground: var(--at-ink);
        --muted: #f0ede8;
        --muted-foreground: var(--at-ink-60);
        --border: var(--at-ink-20);
        --card: var(--at-paper);
        --card-foreground: var(--at-ink);
        --popover: var(--at-paper);
        --popover-foreground: var(--at-ink);
        --primary: var(--at-ink);
        --primary-foreground: var(--at-paper);
        --secondary: #f0ede8;
        --secondary-foreground: var(--at-ink);
        --accent: #f0ede8;
        --accent-foreground: var(--at-ink);
    }

    #tpl-atelier a { color: inherit; text-decoration: none; }

    /* --- Display type --- */
    .at-serif { font-family: var(--at-serif); }
    .at-label {
        font-family: var(--at-sans);
        font-size: .6875rem;
        letter-spacing: .18em;
        text-transform: uppercase;
        color: var(--at-ink-60);
    }
    .at-index {
        font-family: var(--at-sans);
        font-size: .6875rem;
        letter-spacing: .12em;
        color: var(--at-ink-60);
    }

    /* --- Hairline rule --- */
    .at-rule { border-color: var(--at-ink-20); }

    /* --- Nav --- */
    #tpl-atelier .at-nav-link {
        font-size: .75rem;
        letter-spacing: .15em;
        text-transform: uppercase;
        color: var(--at-ink-60);
        transition: color .2s;
    }
    #tpl-atelier .at-nav-link:hover { color: var(--at-ink); }

    /* --- Hero --- */
    .at-hero-headline {
        font-family: var(--at-serif);
        font-weight: 900;
        line-height: .92;
        letter-spacing: -.03em;
        color: var(--at-ink);
    }

    /* --- Color-reveal on hover --- */
    .at-color-reveal img {
        filter: grayscale(1);
        transition: filter .6s cubic-bezier(.25,.46,.45,.94);
    }
    .at-color-reveal:hover img { filter: grayscale(0); }

    /* --- Magazine grid --- */
    .at-mag-grid {
        display: grid;
        grid-template-columns: repeat(12, 1fr);
        gap: 1px;
        background: var(--at-ink-20);
    }
    .at-mag-grid > * { background: var(--at-paper); }

    /* --- Pull-quote campaign --- */
    .at-pullquote-wrap {
        position: relative;
        overflow: hidden;
    }
    .at-pullquote-wrap::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(to right, rgba(10,10,10,.72) 0%, rgba(10,10,10,.32) 55%, transparent 100%);
    }
    .at-pullquote-content { position: relative; z-index: 1; }

    /* --- Product card --- */
    .at-product-card .at-product-img {
        filter: grayscale(1);
        transition: filter .5s ease, transform .5s ease;
    }
    .at-product-card:hover .at-product-img {
        filter: grayscale(0);
        transform: scale(1.03);
    }

    /* --- Marquee accent --- */
    .at-marquee-item {
        font-family: var(--at-serif);
        font-size: 1rem;
        font-style: italic;
        color: var(--at-ink-60);
        padding: 0 2rem;
        white-space: nowrap;
    }
    .at-marquee-dot {
        color: var(--at-accent);
        font-style: normal;
    }

    /* --- Section numbers --- */
    .at-section-num {
        font-family: var(--at-sans);
        font-size: .625rem;
        letter-spacing: .2em;
        color: var(--at-ink-60);
    }

    /* --- Carousel customisation --- */
    #tpl-atelier [data-slot="carousel-previous"],
    #tpl-atelier [data-slot="carousel-next"] {
        background: var(--at-ink);
        color: var(--at-paper);
        border-color: var(--at-ink);
        border-radius: 0;
        width: 2.5rem;
        height: 2.5rem;
    }
    #tpl-atelier [data-slot="carousel-previous"]:hover,
    #tpl-atelier [data-slot="carousel-next"]:hover {
        background: var(--at-accent);
        border-color: var(--at-accent);
    }

    /* --- Tabs underline variant override --- */
    #tpl-atelier [data-slot="tabs-list"][data-variant="underline"] {
        border-color: var(--at-ink-20);
    }

    /* --- Badge override --- */
    #tpl-atelier [data-slot="badge"] {
        border-radius: 0;
        letter-spacing: .1em;
        text-transform: uppercase;
        font-size: .5625rem;
    }

    /* --- Input group override --- */
    #tpl-atelier [data-slot="input-group"] {
        border-color: var(--at-ink);
        border-radius: 0;
    }
    #tpl-atelier [data-slot="input-group"]:focus-within {
        box-shadow: none;
        border-color: var(--at-ink);
    }
    #tpl-atelier [data-slot="input-group-control"] {
        font-family: var(--at-sans);
        font-size: .8125rem;
        letter-spacing: .04em;
    }
    #tpl-atelier [data-slot="input-group-button"] {
        border-radius: 0;
        background: var(--at-ink);
        color: var(--at-paper);
        padding: 0 1.25rem;
        height: 100%;
        font-size: .6875rem;
        letter-spacing: .15em;
        text-transform: uppercase;
    }
    #tpl-atelier [data-slot="input-group-button"]:hover {
        background: var(--at-accent);
    }

    /* --- Separator --- */
    #tpl-atelier [data-slot="separator"] { background: var(--at-ink-20); }

    /* --- Button override --- */
    #tpl-atelier [data-slot="button"] {
        border-radius: 0;
        letter-spacing: .1em;
        text-transform: uppercase;
        font-size: .6875rem;
    }

    /* --- Hover-card override --- */
    #tpl-atelier [data-slot="hover-card-content"] {
        border-radius: 0;
        border-color: var(--at-ink-20);
        box-shadow: 0 8px 32px rgba(10,10,10,.12);
    }

    /* --- Tooltip override --- */
    #tpl-atelier [data-slot="tooltip-content"] {
        border-radius: 0;
        background: var(--at-ink);
        color: var(--at-paper);
        font-size: .6875rem;
        letter-spacing: .08em;
    }

    /* --- Card override --- */
    #tpl-atelier [data-slot="card"] {
        border-radius: 0;
        border-color: var(--at-ink-20);
    }

    /* --- Animations --- */
    @keyframes at-fade-up {
        from { opacity: 0; transform: translateY(24px); }
        to   { opacity: 1; transform: translateY(0); }
    }
    .at-fade-up { animation: at-fade-up .8s cubic-bezier(.25,.46,.45,.94) both; }
    .at-fade-up-d1 { animation-delay: .1s; }
    .at-fade-up-d2 { animation-delay: .22s; }
    .at-fade-up-d3 { animation-delay: .36s; }

    @keyframes at-reveal-line {
        from { transform: scaleX(0); }
        to   { transform: scaleX(1); }
    }
    .at-reveal-line {
        display: block;
        height: 1px;
        background: var(--at-accent);
        transform-origin: left;
        animation: at-reveal-line 1s cubic-bezier(.77,0,.175,1) .4s both;
    }

    @media (prefers-reduced-motion: reduce) {
        .at-fade-up,
        .at-reveal-line,
        .at-color-reveal img,
        .at-product-card .at-product-img {
            animation: none !important;
            transition: none !important;
            filter: none !important;
            transform: none !important;
        }
    }
</style>

<div id="tpl-atelier">

    {{-- ══════════════════════════════════════════════════
         01 — NAVIGATION
    ══════════════════════════════════════════════════ --}}
    <header class="sticky top-0 z-40 border-b at-rule" style="background: var(--at-paper);">
        <div class="mx-auto flex h-16 max-w-7xl items-center px-6 lg:px-10">

            {{-- Left nav --}}
            <nav class="hidden items-center gap-8 md:flex" aria-label="Primary navigation">
                <a href="#lookbook" class="at-nav-link">Lookbook</a>
                <a href="#edit" class="at-nav-link">The Edit</a>
            </nav>

            {{-- Centered wordmark --}}
            <a href="#" class="at-serif absolute left-1/2 -translate-x-1/2 text-xl font-semibold tracking-widest uppercase" style="letter-spacing:.3em; font-size:1.05rem;" aria-label="Maison Atelier home">
                Maison Atelier
            </a>

            {{-- Right nav --}}
            <div class="ml-auto flex items-center gap-6">
                <a href="#runway" class="at-nav-link hidden md:block">Runway</a>
                <a href="#newsletter" class="at-nav-link hidden md:block">Journal</a>
                <x-ui.tooltip>
                    <x-ui.tooltip-trigger>
                        <button type="button" class="at-nav-link flex items-center gap-1" aria-label="Open bag">
                            <x-lucide-shopping-bag class="size-4" />
                            <span class="hidden sm:inline">Bag</span>
                        </button>
                    </x-ui.tooltip-trigger>
                    <x-ui.tooltip-content side="bottom">0 items</x-ui.tooltip-content>
                </x-ui.tooltip>
            </div>
        </div>
    </header>

    {{-- ══════════════════════════════════════════════════
         02 — HERO
    ══════════════════════════════════════════════════ --}}
    <section class="relative border-b at-rule overflow-hidden" aria-label="Hero — Fall / Winter 26">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:px-10 lg:py-0">
            <div class="grid items-stretch gap-0 lg:grid-cols-[1fr_420px] lg:min-h-[92vh]">

                {{-- Type column --}}
                <div class="flex flex-col justify-center py-16 pr-8 lg:py-24">
                    <p class="at-index at-fade-up mb-6">01 — Fall / Winter 2026</p>
                    <span class="at-reveal-line mb-8 w-16"></span>

                    <h1 class="at-hero-headline at-fade-up at-fade-up-d1 text-[clamp(4.5rem,11vw,10rem)] leading-none">
                        The<br/>
                        <em class="not-italic" style="color: var(--at-accent);">Dark</em><br/>
                        Season
                    </h1>

                    <p class="at-fade-up at-fade-up-d2 mt-8 max-w-sm text-sm leading-relaxed" style="color: var(--at-ink-60);">
                        A collection born of shadow and structure. Volumes that question the body. Fabrics that remember the wearer.
                    </p>

                    <div class="at-fade-up at-fade-up-d3 mt-10 flex flex-wrap items-center gap-4">
                        <x-ui.button href="#lookbook" size="lg" style="background: var(--at-ink); color: var(--at-paper);">
                            View Lookbook
                        </x-ui.button>
                        <x-ui.button href="#edit" variant="outline" size="lg">
                            Shop the Edit
                        </x-ui.button>
                    </div>

                    <div class="mt-14 flex items-center gap-5">
                        @foreach ($teamAvatars as $member)
                            <x-ui.hover-card :openDelay="200">
                                <x-ui.hover-card-trigger>
                                    <x-ui.avatar class="ring-2 size-9 cursor-pointer" style="ring-color: var(--at-ink-20);">
                                        <x-ui.avatar-image
                                            src="https://picsum.photos/seed/{{ $member['seed'] }}/80/80?grayscale"
                                            alt="{{ $member['name'] }}" />
                                        <x-ui.avatar-fallback style="background:var(--at-ink);color:var(--at-paper);font-size:.7rem;">
                                            {{ strtoupper(substr($member['name'], 0, 2)) }}
                                        </x-ui.avatar-fallback>
                                    </x-ui.avatar>
                                </x-ui.hover-card-trigger>
                                <x-ui.hover-card-content side="top" align="start">
                                    <div class="flex items-center gap-3">
                                        <x-ui.avatar class="size-10">
                                            <x-ui.avatar-image
                                                src="https://picsum.photos/seed/{{ $member['seed'] }}/80/80?grayscale"
                                                alt="{{ $member['name'] }}" />
                                            <x-ui.avatar-fallback style="background:var(--at-ink);color:var(--at-paper);font-size:.7rem;">
                                                {{ strtoupper(substr($member['name'], 0, 2)) }}
                                            </x-ui.avatar-fallback>
                                        </x-ui.avatar>
                                        <div>
                                            <p class="text-sm font-medium" style="color:var(--at-ink);">{{ $member['name'] }}</p>
                                            <p class="at-label" style="font-size:.6rem;">{{ $member['role'] }}</p>
                                        </div>
                                    </div>
                                </x-ui.hover-card-content>
                            </x-ui.hover-card>
                        @endforeach
                        <span class="at-label ml-1">Atelier Team</span>
                    </div>
                </div>

                {{-- Hero image --}}
                <div class="at-color-reveal relative hidden overflow-hidden border-l at-rule lg:block">
                    <img
                        src="https://picsum.photos/seed/atel-hero/840/1200?grayscale"
                        alt="Maison Atelier Fall/Winter 26 hero look — dark structured coat"
                        class="h-full w-full object-cover"
                    />
                    <div class="absolute bottom-8 left-6 right-6">
                        <x-ui.badge style="background:var(--at-accent);color:#fff;border:none;">
                            F/W 26
                        </x-ui.badge>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════
         03 — MARQUEE (fabrics / collections)
    ══════════════════════════════════════════════════ --}}
    <div class="border-b at-rule py-5 overflow-hidden" aria-label="Collection material names">
        <x-ui.marquee :duration="'50s'" :pauseOnHover="true">
            @foreach ($fabrics as $fabric)
                <span class="at-marquee-item">
                    {{ $fabric }}<span class="at-marquee-dot" aria-hidden="true"> ✦ </span>
                </span>
            @endforeach
        </x-ui.marquee>
    </div>

    {{-- ══════════════════════════════════════════════════
         04 — LOOKBOOK GRID
    ══════════════════════════════════════════════════ --}}
    <section id="lookbook" class="py-20 lg:py-28" aria-label="Lookbook">
        <div class="mx-auto max-w-7xl px-6 lg:px-10">

            <div class="mb-12 flex items-end justify-between border-b at-rule pb-6">
                <div>
                    <p class="at-index mb-2">02 —</p>
                    <h2 class="at-serif text-4xl font-semibold leading-tight lg:text-5xl">The Lookbook</h2>
                </div>
                <p class="at-label hidden sm:block">Hover to reveal colour</p>
            </div>

            {{-- Asymmetric magazine grid --}}
            <div class="at-mag-grid">
                {{-- Row 1: wide-left + narrow-right --}}
                <div class="at-color-reveal col-span-8 relative overflow-hidden" style="aspect-ratio:4/3;">
                    <img
                        src="https://picsum.photos/seed/atel-lb1/1200/900?grayscale"
                        alt="Editorial look — oversized wool coat in pale stone"
                        class="h-full w-full object-cover"
                    />
                    <div class="absolute bottom-4 left-4 z-10 at-label" style="color:#fff; background: rgba(10,10,10,.5); padding: .25rem .5rem;">Look 01</div>
                </div>
                <div class="at-color-reveal col-span-4 relative overflow-hidden" style="aspect-ratio:3/4;">
                    <img
                        src="https://picsum.photos/seed/atel-lb2/600/800?grayscale"
                        alt="Editorial look — structured blazer with wide lapel"
                        class="h-full w-full object-cover"
                    />
                </div>
                {{-- Row 2: three equal --}}
                <div class="at-color-reveal col-span-4 relative overflow-hidden" style="aspect-ratio:3/4;">
                    <img
                        src="https://picsum.photos/seed/atel-lb3/600/800?grayscale"
                        alt="Editorial look — draped wide-leg trousers"
                        class="h-full w-full object-cover"
                    />
                </div>
                <div class="at-color-reveal col-span-4 relative overflow-hidden flex items-center justify-center" style="background:var(--at-ink);">
                    <div class="p-8 text-center">
                        <p class="at-serif text-3xl font-light leading-snug" style="color:var(--at-paper);">
                            "Clothes for<br/>the unconvinced"
                        </p>
                        <span class="at-label mt-4 block" style="color:rgba(250,249,247,.45);">Maison Atelier, F/W 26</span>
                    </div>
                </div>
                <div class="at-color-reveal col-span-4 relative overflow-hidden" style="aspect-ratio:3/4;">
                    <img
                        src="https://picsum.photos/seed/atel-lb4/600/800?grayscale"
                        alt="Editorial look — silk blouse fluid volume"
                        class="h-full w-full object-cover"
                    />
                </div>
                {{-- Row 3: narrow-left + wide-right --}}
                <div class="at-color-reveal col-span-5 relative overflow-hidden" style="aspect-ratio:5/4;">
                    <img
                        src="https://picsum.photos/seed/atel-lb5/900/720?grayscale"
                        alt="Editorial look — minimal dress with high neck"
                        class="h-full w-full object-cover"
                    />
                </div>
                <div class="at-color-reveal col-span-7 relative overflow-hidden" style="aspect-ratio:7/4;">
                    <img
                        src="https://picsum.photos/seed/atel-lb6/1260/720?grayscale"
                        alt="Editorial look — tailored coat with belt"
                        class="h-full w-full object-cover"
                    />
                    <div class="absolute bottom-4 right-4 z-10 at-label" style="color:#fff; background: rgba(10,10,10,.5); padding: .25rem .5rem;">Look 06</div>
                </div>
            </div>

            {{-- Gallery lightbox trigger row --}}
            <div class="mt-8 flex items-center justify-between">
                <p class="at-label">6 looks — F/W 2026</p>
                <x-ui.gallery
                    :images="$lookbookImages"
                    :columns="6"
                    rounded="rounded-none"
                    class="w-72"
                />
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════
         05 — THE EDIT (product cards)
    ══════════════════════════════════════════════════ --}}
    <section id="edit" class="border-t at-rule py-20 lg:py-28" aria-label="The Edit — shop products">
        <div class="mx-auto max-w-7xl px-6 lg:px-10">

            <div class="mb-12 flex items-end justify-between border-b at-rule pb-6">
                <div>
                    <p class="at-index mb-2">03 —</p>
                    <h2 class="at-serif text-4xl font-semibold leading-tight lg:text-5xl">The Edit</h2>
                </div>
                <x-ui.button href="#" variant="ghost" size="sm">
                    View all <x-lucide-arrow-right class="size-3.5" />
                </x-ui.button>
            </div>

            <div class="grid gap-px sm:grid-cols-2 lg:grid-cols-4" style="background: var(--at-ink-20);">
                @foreach ($editProducts as $product)
                    <article class="at-product-card group relative overflow-hidden" style="background: var(--at-paper);" aria-label="{{ $product['name'] }}">
                        <div class="relative overflow-hidden" style="aspect-ratio:3/4;">
                            <img
                                src="https://picsum.photos/seed/{{ $product['seed'] }}/{{ $product['w'] }}/{{ $product['h'] }}?grayscale"
                                alt="{{ $product['name'] }} — {{ $product['category'] }}"
                                class="at-product-img h-full w-full object-cover"
                                loading="lazy"
                            />
                            @if ($product['badge'])
                                <div class="absolute left-3 top-3">
                                    <x-ui.badge style="background:var(--at-accent);color:#fff;border:none;">
                                        {{ $product['badge'] }}
                                    </x-ui.badge>
                                </div>
                            @endif
                            <button
                                type="button"
                                class="absolute bottom-3 left-3 right-3 translate-y-4 opacity-0 transition-all duration-300 group-hover:translate-y-0 group-hover:opacity-100"
                                style="background:var(--at-ink);color:var(--at-paper);padding:.6rem 1rem;font-size:.6875rem;letter-spacing:.12em;text-transform:uppercase;"
                                aria-label="Add {{ $product['name'] }} to bag"
                            >
                                Add to bag
                            </button>
                        </div>
                        <div class="border-t at-rule p-4">
                            <p class="at-label mb-1">{{ $product['category'] }}</p>
                            <div class="flex items-baseline justify-between">
                                <h3 class="at-serif text-base font-medium">{{ $product['name'] }}</h3>
                                <span class="text-sm font-medium tabular-nums">{{ $product['price'] }}</span>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════
         06 — CAMPAIGN FULL-BLEED PULL-QUOTE
    ══════════════════════════════════════════════════ --}}
    <section class="at-pullquote-wrap" aria-label="Campaign image with pull-quote">
        <img
            src="https://picsum.photos/seed/atel-campaign/1600/800?grayscale"
            alt="Maison Atelier F/W 26 campaign — full-bleed editorial photograph"
            class="h-[520px] w-full object-cover lg:h-[680px]"
        />
        <div class="at-pullquote-content absolute inset-0 flex items-center">
            <div class="mx-auto max-w-7xl w-full px-6 lg:px-10">
                <p class="at-index mb-4" style="color:rgba(250,249,247,.6);">04 —</p>
                <blockquote class="at-serif max-w-2xl text-[clamp(2rem,5vw,4.5rem)] font-semibold leading-[1.05]" style="color: var(--at-paper);">
                    "Structure<br/>is the new<br/><em style="color:var(--at-accent);">freedom.</em>"
                </blockquote>
                <cite class="at-label mt-6 block not-italic" style="color:rgba(250,249,247,.5);">Maison Atelier — F/W 2026 Campaign</cite>
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════
         07 — RUNWAY CAROUSEL
    ══════════════════════════════════════════════════ --}}
    <section id="runway" class="border-t at-rule py-20 lg:py-28" aria-label="Runway looks carousel">
        <div class="mx-auto max-w-7xl px-6 lg:px-10">

            <div class="mb-12 flex items-end justify-between border-b at-rule pb-6">
                <div>
                    <p class="at-index mb-2">05 —</p>
                    <h2 class="at-serif text-4xl font-semibold leading-tight lg:text-5xl">The Runway</h2>
                </div>
                <p class="at-label hidden sm:block">Fall / Winter 2026</p>
            </div>

            <x-ui.carousel class="w-full px-16">
                <x-ui.carousel-content>
                    @foreach ($runwaySlides as $slide)
                        <x-ui.carousel-item class="basis-full sm:basis-1/2 lg:basis-1/3">
                            <div class="at-color-reveal group relative overflow-hidden" style="aspect-ratio:3/4;">
                                <img
                                    src="https://picsum.photos/seed/{{ $slide['seed'] }}/600/800?grayscale"
                                    alt="{{ $slide['caption'] }}"
                                    loading="lazy"
                                    class="h-full w-full object-cover transition-transform duration-700 group-hover:scale-[1.04]"
                                />
                                <div class="absolute inset-x-0 bottom-0 p-4" style="background:linear-gradient(to top, rgba(10,10,10,.55), transparent);">
                                    <p class="at-label" style="color:rgba(250,249,247,.8);">{{ $slide['caption'] }}</p>
                                </div>
                            </div>
                        </x-ui.carousel-item>
                    @endforeach
                </x-ui.carousel-content>
                <x-ui.carousel-previous />
                <x-ui.carousel-next />
            </x-ui.carousel>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════
         08 — CATEGORY TABS
    ══════════════════════════════════════════════════ --}}
    <section class="border-t at-rule py-20 lg:py-28 bg-[#f0ede8]" aria-label="Shop by category">
        <div class="mx-auto max-w-7xl px-6 lg:px-10">

            <div class="mb-12 flex items-end justify-between border-b at-rule pb-6" style="border-color: var(--at-ink-20);">
                <div>
                    <p class="at-index mb-2">06 —</p>
                    <h2 class="at-serif text-4xl font-semibold leading-tight lg:text-5xl">By Category</h2>
                </div>
            </div>

            <x-ui.tabs value="outerwear">
                <x-ui.tabs-list variant="underline" class="mb-10">
                    @foreach ($categories as $key => $cat)
                        <x-ui.tabs-trigger value="{{ $key }}">{{ $cat['label'] }}</x-ui.tabs-trigger>
                    @endforeach
                </x-ui.tabs-list>

                @foreach ($categories as $key => $cat)
                    <x-ui.tabs-content value="{{ $key }}">
                        <div class="grid gap-px sm:grid-cols-3" style="background: var(--at-ink-20);">
                            @foreach ($cat['items'] as $item)
                                <div class="at-color-reveal group relative overflow-hidden" style="background: var(--at-paper); aspect-ratio: 3/4;">
                                    <img
                                        src="https://picsum.photos/seed/{{ $item['seed'] }}/480/640?grayscale"
                                        alt="{{ $item['name'] }}"
                                        loading="lazy"
                                        class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.03]"
                                    />
                                    <div class="absolute inset-x-0 bottom-0 border-t at-rule p-4" style="background:var(--at-paper);">
                                        <div class="flex items-baseline justify-between">
                                            <span class="at-serif text-sm font-medium">{{ $item['name'] }}</span>
                                            <span class="text-xs tabular-nums" style="color:var(--at-ink-60);">{{ $item['price'] }}</span>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </x-ui.tabs-content>
                @endforeach
            </x-ui.tabs>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════
         09 — SECOND MARQUEE (collections)
    ══════════════════════════════════════════════════ --}}
    <div class="border-y at-rule py-5 overflow-hidden" aria-label="Collection names">
        <x-ui.marquee direction="right" :duration="'60s'" :pauseOnHover="true">
            @foreach ($collections as $col)
                <span class="at-marquee-item">
                    {{ $col }}<span class="at-marquee-dot" aria-hidden="true"> — </span>
                </span>
            @endforeach
        </x-ui.marquee>
    </div>

    {{-- ══════════════════════════════════════════════════
         10 — PRESS LOGOS
    ══════════════════════════════════════════════════ --}}
    <section class="py-16" aria-label="Press coverage">
        <div class="mx-auto max-w-7xl px-6 lg:px-10">
            <p class="at-label mb-10 text-center">As seen in</p>
            <div class="flex flex-wrap items-center justify-center gap-x-12 gap-y-6">
                @foreach ($press as $pub)
                    <x-ui.tooltip>
                        <x-ui.tooltip-trigger>
                            <span class="at-serif text-lg font-medium transition-colors cursor-default select-none" style="color:var(--at-ink-60); letter-spacing:.04em;" aria-label="{{ $pub }} press mention">
                                {{ $pub }}
                            </span>
                        </x-ui.tooltip-trigger>
                        <x-ui.tooltip-content side="bottom">Featured in {{ $pub }}</x-ui.tooltip-content>
                    </x-ui.tooltip>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════
         11 — NEWSLETTER
    ══════════════════════════════════════════════════ --}}
    <section id="newsletter" class="border-t at-rule py-20 lg:py-28" aria-label="Newsletter signup">
        <div class="mx-auto max-w-2xl px-6 text-center">
            <p class="at-index mb-4">08 —</p>
            <h2 class="at-serif mb-4 text-4xl font-semibold lg:text-5xl">The Journal</h2>
            <p class="mb-10 text-sm leading-relaxed" style="color:var(--at-ink-60);">
                Receive invitations to private previews, archive stories, and notes from the atelier.
            </p>
            <form action="#" method="post" class="flex flex-col items-center gap-4 sm:flex-row sm:gap-0">
                <x-ui.input-group class="w-full sm:flex-1">
                    <x-ui.input-group-text>
                        <x-lucide-mail class="size-4" />
                    </x-ui.input-group-text>
                    <x-ui.input-group-input
                        type="email"
                        name="email"
                        placeholder="Your email address"
                        required
                        autocomplete="email"
                    />
                    <x-ui.input-group-button type="submit" size="sm" variant="default" style="border-radius:0; background: var(--at-ink); color: var(--at-paper); padding: 0 1.25rem; height: 100%; font-size: .6875rem; letter-spacing: .15em; text-transform: uppercase;">
                        Subscribe
                    </x-ui.input-group-button>
                </x-ui.input-group>
            </form>
            <p class="at-label mt-5">No frequency. Only substance.</p>
        </div>
    </section>

    {{-- ══════════════════════════════════════════════════
         12 — FOOTER
    ══════════════════════════════════════════════════ --}}
    <footer class="border-t at-rule" aria-label="Site footer">
        <div class="mx-auto max-w-7xl px-6 py-16 lg:px-10">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-6">

                {{-- Brand --}}
                <div class="lg:col-span-2">
                    <a href="#" class="at-serif text-base font-semibold tracking-widest uppercase" style="letter-spacing:.3em;">
                        Maison Atelier
                    </a>
                    <p class="mt-3 max-w-xs text-xs leading-relaxed" style="color:var(--at-ink-60);">
                        A fashion house founded on the belief that clothing is the architecture of the self.
                    </p>
                    <div class="mt-6 flex gap-3">
                        @foreach (['instagram', 'twitter', 'youtube'] as $social)
                            <x-ui.tooltip>
                                <x-ui.tooltip-trigger>
                                    <a
                                        href="#"
                                        aria-label="{{ ucfirst($social) }}"
                                        class="inline-flex size-8 items-center justify-center border at-rule transition-colors"
                                        style="color:var(--at-ink-60);"
                                        onmouseover="this.style.background='var(--at-ink)';this.style.color='var(--at-paper)'"
                                        onmouseout="this.style.background='';this.style.color='var(--at-ink-60)'"
                                    >
                                        <x-dynamic-component :component="'lucide-'.$social" class="size-3.5" />
                                    </a>
                                </x-ui.tooltip-trigger>
                                <x-ui.tooltip-content>{{ ucfirst($social) }}</x-ui.tooltip-content>
                            </x-ui.tooltip>
                        @endforeach
                    </div>
                </div>

                {{-- Links --}}
                @foreach ($footerLinks as $heading => $links)
                    <div>
                        <h3 class="at-label mb-4">{{ $heading }}</h3>
                        <ul class="space-y-2.5 text-xs" style="color:var(--at-ink-60);">
                            @foreach ($links as $link)
                                <li><a href="#" class="transition-colors hover:text-[var(--at-ink)]">{{ $link }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <x-ui.separator class="my-10" />

            <div class="flex flex-col items-center justify-between gap-3 text-xs sm:flex-row" style="color:var(--at-ink-60);">
                <span>© {{ date('Y') }} Maison Atelier. All rights reserved.</span>
                <div class="flex items-center gap-5">
                    <a href="#" class="transition-colors hover:text-[var(--at-ink)]">Privacy</a>
                    <a href="#" class="transition-colors hover:text-[var(--at-ink)]">Terms</a>
                    <a href="#" class="transition-colors hover:text-[var(--at-ink)]">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

</div>
</x-layouts.app>
