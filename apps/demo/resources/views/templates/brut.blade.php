@php
    $services = [
        ['icon' => 'pen-tool',      'title' => 'Brand Identity',   'desc' => 'Logos, systems, guidelines — your visual DNA, built to last and built to scale.', 'accent' => '#ff4d2e'],
        ['icon' => 'monitor',       'title' => 'Web & Digital',     'desc' => 'Pixel-perfect sites and apps that move as fast as your ambition.', 'accent' => '#2b50ff'],
        ['icon' => 'film',          'title' => 'Motion & Video',    'desc' => 'Animation, trailers, social content — moving stories that demand attention.', 'accent' => '#ffd400'],
        ['icon' => 'megaphone',     'title' => 'Campaign Design',   'desc' => 'OOH, digital, print — cohesive campaigns from concept to production.', 'accent' => '#b6ff3c'],
        ['icon' => 'package',       'title' => 'Packaging',         'desc' => 'Shelf presence that sells before a single word is read.', 'accent' => '#ff4d2e'],
        ['icon' => 'type',          'title' => 'Editorial & Print', 'desc' => 'Books, magazines, annual reports — typography as craft.', 'accent' => '#2b50ff'],
    ];

    $work = [
        ['seed' => 'brut1',   'w' => 600, 'h' => 720, 'client' => 'Vanta Foods',    'year' => '2025', 'tags' => ['Packaging', 'Identity']],
        ['seed' => 'brut2',   'w' => 600, 'h' => 720, 'client' => 'Vanta Foods',    'year' => '2025', 'tags' => ['Packaging', 'Identity']],
        ['seed' => 'brut3',   'w' => 600, 'h' => 720, 'client' => 'NRKL Studio',    'year' => '2025', 'tags' => ['Web', 'Motion']],
        ['seed' => 'brut4',   'w' => 600, 'h' => 720, 'client' => 'Orbit Sport',    'year' => '2024', 'tags' => ['Campaign', 'Brand']],
        ['seed' => 'brut5',   'w' => 600, 'h' => 720, 'client' => 'Lumio Records',  'year' => '2024', 'tags' => ['Identity', 'Print']],
        ['seed' => 'brut6',   'w' => 600, 'h' => 720, 'client' => 'Kroft Gin',      'year' => '2024', 'tags' => ['Packaging', 'Campaign']],
    ];

    $stats = [
        ['value' => '14', 'unit' => 'yrs', 'label' => 'Making brands loud'],
        ['value' => '280+',                 'label' => 'Projects delivered'],
        ['value' => '3×',                   'label' => 'Cannes Lion winner'],
        ['value' => '100%',                 'label' => 'Independent studio'],
    ];

    $projects = [
        ['project' => 'Vanta Foods — Full Rebrand', 'year' => '2025', 'category' => 'Brand + Packaging', 'status' => 'completed', 'tone' => 'success'],
        ['project' => 'NRKL Studio — Digital Presence', 'year' => '2025', 'category' => 'Web + Motion',  'status' => 'live',      'tone' => 'info'],
        ['project' => 'Orbit Sport — Campaign Series',  'year' => '2025', 'category' => 'Campaign',       'status' => 'ongoing',   'tone' => 'warning'],
        ['project' => 'Lumio Records — Visual Identity','year' => '2024', 'category' => 'Identity',       'status' => 'completed', 'tone' => 'success'],
        ['project' => 'Kroft Gin — Launch Campaign',    'year' => '2024', 'category' => 'Campaign + Pack','status' => 'completed', 'tone' => 'success'],
        ['project' => 'Méra Hotel — Brand System',      'year' => '2024', 'category' => 'Identity + Web', 'status' => 'completed', 'tone' => 'success'],
        ['project' => 'Durand Atelier — Editorial',     'year' => '2023', 'category' => 'Print + Web',    'status' => 'archived',  'tone' => 'neutral'],
    ];

    $awards = [
        ['title' => 'Cannes Lions — Gold, Brand Design',        'year' => '2025', 'client' => 'Vanta Foods'],
        ['title' => 'D&AD — Yellow Pencil, Packaging',          'year' => '2025', 'client' => 'Kroft Gin'],
        ['title' => 'Cannes Lions — Silver, Campaign',          'year' => '2024', 'client' => 'Orbit Sport'],
        ['title' => 'Awwwards — Site of the Year',              'year' => '2024', 'client' => 'NRKL Studio'],
        ['title' => 'Type Directors Club — Certificate',        'year' => '2023', 'client' => 'Durand Atelier'],
        ['title' => 'Cannes Lions — Bronze, Motion Design',     'year' => '2023', 'client' => 'Lumio Records'],
    ];

    $team = [
        ['seed' => 'team1', 'name' => 'Ines Voss',      'role' => 'Creative Director'],
        ['seed' => 'team2', 'name' => 'Theo Brunet',    'role' => 'Design Lead'],
        ['seed' => 'team3', 'name' => 'Mara Kuhn',      'role' => 'Motion Director'],
        ['seed' => 'team4', 'name' => 'Oscar Radin',    'role' => 'Strategy'],
        ['seed' => 'team5', 'name' => 'Yuki Tanaka',    'role' => 'Brand Designer'],
        ['seed' => 'team6', 'name' => 'Sara Pinto',     'role' => 'Digital Lead'],
    ];

    $services_select = ['Brand Identity', 'Web & Digital', 'Motion & Video', 'Campaign Design', 'Packaging', 'Editorial & Print', 'Multiple / Not sure'];
    $budget_select   = ['Under €10k', '€10k – €25k', '€25k – €75k', '€75k – €150k', '€150k+'];
@endphp

<x-layouts.app title="Stüdio Brut — We make brands LOUD">

{{-- ━━━━━━━━━━━━━━━━━━━━━━━━━ SCOPED STYLES ━━━━━━━━━━━━━━━━━━━━━━━━━ --}}
<style>
    @import url('https://fonts.bunny.net/css?family=archivo:800,900|dm-sans:400,500');

    /* ── Reset within scope ── */
    #tpl-brut { font-family: 'DM Sans', sans-serif; }
    #tpl-brut * { box-sizing: border-box; border-radius: 0 !important; }

    /* ── Force own palette (theme-agnostic) ── */
    #tpl-brut {
        background-color: #f4f1e8;
        color: #111111;
    }

    /* ── Display font ── */
    .brut-display {
        font-family: 'Archivo', sans-serif;
        font-weight: 900;
        line-height: 0.92;
        letter-spacing: -0.03em;
        color: #111111;
    }

    /* ── Hard offset shadow system ── */
    .brut-shadow         { box-shadow:  6px  6px 0 #111111; }
    .brut-shadow-red     { box-shadow:  6px  6px 0 #ff4d2e; }
    .brut-shadow-blue    { box-shadow:  6px  6px 0 #2b50ff; }
    .brut-shadow-yellow  { box-shadow:  6px  6px 0 #ffd400; }
    .brut-shadow-lime    { box-shadow:  6px  6px 0 #b6ff3c; }

    /* ── Lift effect on hover ── */
    .brut-lift {
        transition: transform 0.12s ease, box-shadow 0.12s ease;
    }
    .brut-lift:hover {
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0 #111111;
    }
    .brut-lift-red:hover {
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0 #ff4d2e;
    }
    .brut-lift-blue:hover {
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0 #2b50ff;
    }
    .brut-lift-yellow:hover {
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0 #ffd400;
    }
    .brut-lift-lime:hover {
        transform: translate(-3px, -3px);
        box-shadow: 9px 9px 0 #b6ff3c;
    }

    /* ── Cards ── */
    .brut-card {
        background: #f4f1e8;
        border: 3px solid #111111;
        padding: 1.5rem;
    }

    /* ── Buttons ── */
    .brut-btn {
        font-family: 'Archivo', sans-serif;
        font-weight: 800;
        font-size: 0.875rem;
        letter-spacing: 0.04em;
        text-transform: uppercase;
        border: 3px solid #111111;
        padding: 0.625rem 1.5rem;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        cursor: pointer;
        transition: transform 0.12s ease, box-shadow 0.12s ease;
        text-decoration: none;
        white-space: nowrap;
    }
    .brut-btn:focus-visible {
        outline: 3px solid #2b50ff;
        outline-offset: 3px;
    }
    .brut-btn-ink {
        background: #111111;
        color: #f4f1e8;
        box-shadow: 4px 4px 0 #ff4d2e;
    }
    .brut-btn-ink:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0 #ff4d2e;
    }
    .brut-btn-paper {
        background: #f4f1e8;
        color: #111111;
        box-shadow: 4px 4px 0 #111111;
    }
    .brut-btn-paper:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0 #111111;
    }
    .brut-btn-red {
        background: #ff4d2e;
        color: #111111;
        box-shadow: 4px 4px 0 #111111;
    }
    .brut-btn-red:hover {
        transform: translate(-2px, -2px);
        box-shadow: 6px 6px 0 #111111;
    }

    /* ── Ticker / marquee strip ── */
    .brut-ticker {
        background: #111111;
        color: #f4f1e8;
        border-top: 3px solid #111111;
        border-bottom: 3px solid #111111;
        overflow: hidden;
        padding: 0.75rem 0;
    }
    .brut-ticker-word {
        font-family: 'Archivo', sans-serif;
        font-weight: 900;
        font-size: 1.125rem;
        letter-spacing: 0.06em;
        text-transform: uppercase;
        padding: 0 2rem;
        color: #f4f1e8;
        white-space: nowrap;
    }
    .brut-ticker-dot {
        color: #ff4d2e;
        font-size: 1.5rem;
    }

    /* ── Sticker badge ── */
    .brut-sticker {
        font-family: 'Archivo', sans-serif;
        font-weight: 900;
        font-size: 0.8rem;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        background: #ffd400;
        color: #111111;
        border: 3px solid #111111;
        padding: 0.375rem 0.75rem;
        display: inline-block;
        box-shadow: 4px 4px 0 #111111;
        transform: rotate(-4deg);
    }
    .brut-sticker-red {
        background: #ff4d2e;
        color: #f4f1e8;
    }
    .brut-sticker-blue {
        background: #2b50ff;
        color: #f4f1e8;
        transform: rotate(3deg);
    }
    .brut-sticker-lime {
        background: #b6ff3c;
        color: #111111;
        transform: rotate(-2deg);
    }

    /* ── Section borders ── */
    .brut-section {
        border-top: 3px solid #111111;
    }

    /* ── Form inputs override ── */
    #tpl-brut [data-slot="input"],
    #tpl-brut [data-slot="textarea"],
    #tpl-brut [data-slot="select"] {
        border: 3px solid #111111 !important;
        background: #f4f1e8 !important;
        color: #111111 !important;
        box-shadow: 4px 4px 0 #111111 !important;
        transition: box-shadow 0.12s ease, transform 0.12s ease !important;
    }
    #tpl-brut [data-slot="input"]:focus,
    #tpl-brut [data-slot="textarea"]:focus {
        box-shadow: 4px 4px 0 #2b50ff !important;
        outline: none !important;
    }

    /* ── Table overrides ── */
    #tpl-brut [data-slot="table-container"] {
        border: 3px solid #111111;
        box-shadow: 6px 6px 0 #111111;
        background: #f4f1e8;
        overflow: hidden;
    }
    #tpl-brut [data-slot="table-head"] {
        background: #111111;
        color: #f4f1e8;
        font-family: 'Archivo', sans-serif;
        font-weight: 800;
        font-size: 0.75rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
    }
    #tpl-brut [data-slot="table-row"] {
        border-color: #111111 !important;
    }
    #tpl-brut [data-slot="table-row"]:hover {
        background: rgba(43, 80, 255, 0.08) !important;
    }
    #tpl-brut [data-slot="table-cell"] {
        color: #111111;
    }

    /* ── Accordion overrides ── */
    #tpl-brut [data-slot="accordion-item"] {
        border-color: #111111 !important;
        border-width: 0 0 3px 0 !important;
    }
    #tpl-brut [data-slot="accordion-trigger"] {
        font-family: 'Archivo', sans-serif;
        font-weight: 800;
        font-size: 1rem;
        color: #111111;
        letter-spacing: -0.01em;
    }
    #tpl-brut [data-slot="accordion-trigger"]:hover { text-decoration: none; }
    #tpl-brut [data-slot="accordion-content"] { color: #111111; }

    /* ── Quote override ── */
    #tpl-brut [data-slot="quote"] blockquote {
        color: #111111;
        font-family: 'Archivo', sans-serif;
        font-weight: 800;
        font-size: clamp(1.75rem, 4vw, 3rem);
        line-height: 1.1;
        letter-spacing: -0.02em;
    }

    /* ── Hero oversized background word ── */
    .brut-hero-bg-text {
        font-family: 'Archivo', sans-serif;
        font-weight: 900;
        font-size: clamp(8rem, 22vw, 22rem);
        line-height: 0.85;
        letter-spacing: -0.05em;
        color: transparent;
        -webkit-text-stroke: 3px rgba(17,17,17,0.07);
        user-select: none;
        pointer-events: none;
        position: absolute;
        top: -0.1em;
        left: -0.02em;
        white-space: nowrap;
    }

    /* ── Grid lines (decorative horizontal rules) ── */
    .brut-grid-line {
        border-top: 1px solid rgba(17,17,17,0.15);
    }

    /* ── Number counter in stats ── */
    .brut-stat-number {
        font-family: 'Archivo', sans-serif;
        font-weight: 900;
        font-size: clamp(3rem, 7vw, 5.5rem);
        line-height: 1;
        letter-spacing: -0.04em;
        color: #111111;
    }

    /* ── Work card image hover ── */
    .brut-work-card img { transition: transform 0.25s ease; }
    .brut-work-card:hover img { transform: scale(1.03); }

    /* ── Separator override ── */
    #tpl-brut [data-slot="separator"] { background: #111111; opacity: 0.25; }

    /* ── Nav bar ── */
    .brut-nav {
        background: #111111;
        border-bottom: 3px solid #111111;
        position: sticky;
        top: 0;
        z-index: 50;
    }
    .brut-nav-link {
        font-family: 'Archivo', sans-serif;
        font-weight: 800;
        font-size: 0.8rem;
        letter-spacing: 0.07em;
        text-transform: uppercase;
        color: rgba(244,241,232,0.7);
        text-decoration: none;
        padding: 0.25rem 0;
        transition: color 0.12s ease;
        border-bottom: 2px solid transparent;
    }
    .brut-nav-link:hover {
        color: #ffd400;
        border-bottom-color: #ffd400;
    }

    /* ── Footer ── */
    .brut-footer {
        background: #111111;
        color: #f4f1e8;
        border-top: 3px solid #111111;
    }

    /* ── Contact section ── */
    .brut-contact-label {
        font-family: 'Archivo', sans-serif;
        font-weight: 800;
        font-size: 0.75rem;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        color: #111111;
    }

    /* ── Reduced motion ── */
    @media (prefers-reduced-motion: reduce) {
        .brut-lift,
        .brut-btn,
        .brut-lift-red,
        .brut-lift-blue,
        .brut-lift-yellow,
        .brut-lift-lime {
            transition: none !important;
        }
        .brut-lift:hover,
        .brut-btn:hover,
        .brut-lift-red:hover,
        .brut-lift-blue:hover,
        .brut-lift-yellow:hover,
        .brut-lift-lime:hover {
            transform: none !important;
        }
        .brut-work-card img,
        .brut-work-card:hover img {
            transition: none !important;
            transform: none !important;
        }
    }
</style>

<div id="tpl-brut">

    {{-- ═══════════════════════════════════════════════
         SECTION 1 — NAV BAR
    ═══════════════════════════════════════════════ --}}
    <nav class="brut-nav" aria-label="Main navigation">
        <div class="mx-auto flex h-14 max-w-7xl items-center justify-between gap-6 px-6">
            {{-- Logo --}}
            <a href="#" aria-label="Stüdio Brut home">
                <span class="brut-display" style="font-size:1.35rem; color:#f4f1e8; letter-spacing:-0.02em;">
                    STÜDIO<span style="color:#ff4d2e;">.</span>BRUT
                </span>
            </a>
            {{-- Links --}}
            <div class="hidden items-center gap-6 md:flex">
                @foreach (['Work' => '#work', 'Services' => '#services', 'About' => '#team', 'Awards' => '#awards', 'Contact' => '#contact'] as $label => $href)
                    <a href="{{ $href }}" class="brut-nav-link">{{ $label }}</a>
                @endforeach
            </div>
            {{-- CTA --}}
            <a href="#contact" class="brut-btn brut-btn-red hidden md:inline-flex" style="font-size:0.75rem; padding:0.4rem 1rem;">
                Start a project
                <x-lucide-arrow-right class="size-4" />
            </a>
        </div>
    </nav>

    {{-- ═══════════════════════════════════════════════
         SECTION 2 — TOP TICKER
    ═══════════════════════════════════════════════ --}}
    <div class="brut-ticker" aria-label="Studio tagline ticker">
        <x-ui.marquee :duration="'28s'" :gap="'0px'" :fade="false">
            @foreach (['DESIGN', 'BRAND', 'MOTION', 'PACKAGING', 'WEB', 'IDENTITY', 'CAMPAIGN'] as $word)
                <span class="brut-ticker-word">{{ $word }}</span>
                <span class="brut-ticker-dot" aria-hidden="true"> ✱ </span>
            @endforeach
        </x-ui.marquee>
    </div>

    {{-- ═══════════════════════════════════════════════
         SECTION 3 — HERO
    ═══════════════════════════════════════════════ --}}
    <section id="hero" style="background:#f4f1e8; border-bottom:3px solid #111; position:relative; overflow:hidden; padding:4rem 1.5rem 5rem;">
        {{-- Background ghost text --}}
        <span class="brut-hero-bg-text" aria-hidden="true">BRUT</span>

        <div class="mx-auto max-w-7xl relative z-10">
            {{-- Sticker badges --}}
            <div class="mb-6 flex flex-wrap items-center gap-4">
                <span class="brut-sticker">Est. 2011</span>
                <span class="brut-sticker brut-sticker-blue">Award-winning</span>
                <span class="brut-sticker brut-sticker-lime">Independent</span>
            </div>

            {{-- Main headline --}}
            <h1 class="brut-display" style="font-size:clamp(3.5rem,11vw,10rem); max-width:14ch;">
                WE MAKE<br>
                <span style="color:#ff4d2e; -webkit-text-stroke:0;">BRANDS</span><br>
                LOUD.
            </h1>

            {{-- Sub --}}
            <p style="font-size:clamp(1rem,2vw,1.375rem); font-weight:500; max-width:36ch; margin-top:2rem; line-height:1.5; color:#111;">
                A creative studio for brands that refuse to go unnoticed. Identity, campaigns, digital, motion — made with conviction.
            </p>

            {{-- CTA row --}}
            <div class="mt-8 flex flex-wrap items-center gap-5">
                <a href="#work" class="brut-btn brut-btn-ink" style="font-size:1rem; padding:0.875rem 2rem;">
                    See our work
                    <x-lucide-arrow-down class="size-5" />
                </a>
                <a href="#contact" class="brut-btn brut-btn-paper" style="font-size:1rem; padding:0.875rem 2rem;">
                    Start a project
                </a>
            </div>

            {{-- Decorative ruled line --}}
            <div style="margin-top:3rem; display:flex; align-items:center; gap:1rem;">
                <div style="height:3px; width:4rem; background:#ff4d2e;"></div>
                <span style="font-family:'Archivo',sans-serif; font-weight:800; font-size:0.75rem; letter-spacing:0.12em; text-transform:uppercase; color:#111;">Creative branding studio — Brussels / Berlin / Online</span>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════
         SECTION 4 — SERVICES GRID
    ═══════════════════════════════════════════════ --}}
    <section id="services" class="brut-section" style="padding:4rem 1.5rem; background:#f4f1e8;">
        <div class="mx-auto max-w-7xl">
            {{-- Section label --}}
            <div class="mb-8 flex items-center gap-4">
                <span class="brut-sticker brut-sticker-red" style="transform:rotate(-2deg);">What we do</span>
                <div style="flex:1; height:3px; background:#111;"></div>
                <span style="font-family:'Archivo',sans-serif; font-weight:800; font-size:0.7rem; letter-spacing:0.1em; text-transform:uppercase;">6 disciplines</span>
            </div>

            <div class="grid gap-0 sm:grid-cols-2 lg:grid-cols-3" style="border:3px solid #111; box-shadow:8px 8px 0 #111;">
                @foreach ($services as $i => $s)
                    @php
                        $accents = ['#ff4d2e','#2b50ff','#ffd400','#b6ff3c','#ff4d2e','#2b50ff'];
                        $accent  = $accents[$i];
                    @endphp
                    <div
                        class="brut-card brut-lift"
                        style="border:0; border-right:3px solid #111; border-bottom:3px solid #111; position:relative;"
                        x-data
                        @mouseenter="$el.style.background='{{ $accent }}20'"
                        @mouseleave="$el.style.background=''"
                    >
                        {{-- Accent top strip --}}
                        <div style="height:4px; background:{{ $accent }}; margin:-1.5rem -1.5rem 1.25rem; width:calc(100% + 3rem);"></div>

                        <div style="display:flex; align-items:flex-start; gap:1rem;">
                            <span style="display:inline-flex; align-items:center; justify-content:center; width:2.75rem; height:2.75rem; background:#111; color:#f4f1e8; flex-shrink:0;">
                                <x-dynamic-component :component="'lucide-'.$s['icon']" class="size-5" />
                            </span>
                            <div>
                                <h3 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:1.1rem; letter-spacing:-0.01em; color:#111; margin-bottom:0.5rem;">{{ $s['title'] }}</h3>
                                <p style="font-size:0.875rem; line-height:1.6; color:#444;">{{ $s['desc'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════
         SECTION 5 — SELECTED WORK
    ═══════════════════════════════════════════════ --}}
    <section id="work" class="brut-section" style="padding:4rem 1.5rem; background:#111111;">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex flex-wrap items-end justify-between gap-4">
                <div>
                    <h2 class="brut-display" style="font-size:clamp(2rem,6vw,5rem); color:#f4f1e8;">SELECTED<br>WORK</h2>
                </div>
                <a href="#contact" class="brut-btn" style="background:#ffd400; color:#111; border-color:#ffd400; box-shadow:4px 4px 0 #f4f1e8; font-size:0.8rem;">
                    Commission a project
                    <x-lucide-arrow-right class="size-4" />
                </a>
            </div>

            {{-- Gallery grid --}}
            <div class="grid grid-cols-1 gap-0 sm:grid-cols-2 lg:grid-cols-3" style="border:3px solid #f4f1e8;">
                @foreach ($work as $i => $w)
                    <div class="brut-work-card" style="border:3px solid #f4f1e8; overflow:hidden; position:relative; aspect-ratio:5/6; cursor:pointer;" tabindex="0" role="img" :aria-label="'Project: {{ $w['client'] }}'">
                        <img
                            src="https://picsum.photos/seed/{{ $w['seed'] }}/600/720"
                            alt="Project for {{ $w['client'] }}"
                            loading="lazy"
                            style="width:100%; height:100%; object-fit:cover; display:block;"
                        />
                        {{-- Overlay on hover --}}
                        <div style="position:absolute; inset:0; background:#111; opacity:0; transition:opacity 0.2s ease; display:flex; flex-direction:column; justify-content:flex-end; padding:1.5rem;" class="brut-work-overlay">
                        </div>
                        {{-- Always visible bottom strip --}}
                        <div style="position:absolute; bottom:0; left:0; right:0; background:#111111; padding:0.875rem 1rem; display:flex; align-items:center; justify-content:space-between;">
                            <div>
                                <div style="font-family:'Archivo',sans-serif; font-weight:800; font-size:0.875rem; color:#f4f1e8; letter-spacing:-0.01em;">{{ $w['client'] }}</div>
                                <div style="font-size:0.75rem; color:rgba(244,241,232,0.6); margin-top:0.125rem;">{{ $w['year'] }}</div>
                            </div>
                            <div style="display:flex; gap:0.375rem; flex-wrap:wrap; justify-content:flex-end;">
                                @foreach ($w['tags'] as $tag)
                                    <x-ui.badge tone="neutral" variant="solid" style="border-radius:0!important; font-size:0.65rem; letter-spacing:0.06em; text-transform:uppercase; font-family:'Archivo',sans-serif; font-weight:800;">{{ $tag }}</x-ui.badge>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════
         SECTION 6 — STATS
    ═══════════════════════════════════════════════ --}}
    <section class="brut-section" style="padding:4rem 1.5rem; background:#ff4d2e;">
        <div class="mx-auto max-w-7xl">
            <div class="grid grid-cols-2 gap-0 lg:grid-cols-4" style="border:3px solid #111; box-shadow:8px 8px 0 #111;">
                @foreach ($stats as $i => $s)
                    <div style="padding:2.5rem 2rem; border-right:3px solid #111; border-bottom:3px solid #111; {{ $i >= 2 ? 'border-bottom:0;' : '' }} {{ $i % 2 === 1 ? 'border-right:0;' : '' }} {{ $i >= 2 ? 'border-bottom:0!important;' : '' }}">
                        <div class="brut-stat-number">
                            {{ $s['value'] }}@if(isset($s['unit']))<span style="font-size:0.45em; color:#f4f1e8aa;">{{ $s['unit'] }}</span>@endif
                        </div>
                        <div style="font-family:'Archivo',sans-serif; font-weight:800; font-size:0.8rem; letter-spacing:0.06em; text-transform:uppercase; margin-top:0.5rem; color:#111;">{{ $s['label'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════
         SECTION 7 — PROJECTS TABLE
    ═══════════════════════════════════════════════ --}}
    <section class="brut-section" style="padding:4rem 1.5rem; background:#f4f1e8;">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex items-center gap-4">
                <span class="brut-sticker brut-sticker-blue" style="transform:rotate(2deg);">Project log</span>
                <div style="flex:1; height:3px; background:#111;"></div>
            </div>

            <x-ui.table>
                <x-ui.table-header>
                    <x-ui.table-row>
                        <x-ui.table-head>Project</x-ui.table-head>
                        <x-ui.table-head>Year</x-ui.table-head>
                        <x-ui.table-head>Category</x-ui.table-head>
                        <x-ui.table-head>Status</x-ui.table-head>
                    </x-ui.table-row>
                </x-ui.table-header>
                <x-ui.table-body>
                    @foreach ($projects as $p)
                        <x-ui.table-row>
                            <x-ui.table-cell>
                                <span style="font-family:'Archivo',sans-serif; font-weight:800; font-size:0.9rem; color:#111;">{{ $p['project'] }}</span>
                            </x-ui.table-cell>
                            <x-ui.table-cell style="color:#111; font-weight:500;">{{ $p['year'] }}</x-ui.table-cell>
                            <x-ui.table-cell style="color:#444; font-size:0.875rem;">{{ $p['category'] }}</x-ui.table-cell>
                            <x-ui.table-cell>
                                <x-ui.badge :tone="$p['tone']" variant="solid" style="font-family:'Archivo',sans-serif; font-weight:800; font-size:0.65rem; letter-spacing:0.08em; text-transform:uppercase;">
                                    {{ $p['status'] }}
                                </x-ui.badge>
                            </x-ui.table-cell>
                        </x-ui.table-row>
                    @endforeach
                </x-ui.table-body>
            </x-ui.table>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════
         SECTION 8 — AWARDS (ACCORDION)
    ═══════════════════════════════════════════════ --}}
    <section id="awards" class="brut-section" style="padding:4rem 1.5rem; background:#2b50ff;">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8">
                <h2 class="brut-display" style="font-size:clamp(2rem,6vw,5rem); color:#f4f1e8;">RECOGNITION</h2>
                <div style="height:3px; width:6rem; background:#ffd400; margin-top:1rem;"></div>
            </div>

            <div style="border:3px solid #f4f1e8; box-shadow:8px 8px 0 #ffd400;">
                <x-ui.accordion type="single" collapsible value="award-0">
                    @foreach ($awards as $i => $award)
                        <x-ui.accordion-item value="award-{{ $i }}" style="border-color: rgba(244,241,232,0.3) !important;">
                            <x-ui.accordion-trigger style="color:#f4f1e8 !important; padding-left:1.5rem; padding-right:1.5rem;">
                                <span style="display:flex; align-items:center; gap:1rem; flex:1;">
                                    <span style="font-family:'Archivo',sans-serif; font-weight:900; font-size:2rem; color:#ffd400; line-height:1; min-width:3.5rem;">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                                    <span style="font-family:'Archivo',sans-serif; font-weight:800; font-size:0.95rem; color:#f4f1e8; letter-spacing:-0.01em;">{{ $award['title'] }}</span>
                                </span>
                            </x-ui.accordion-trigger>
                            <x-ui.accordion-content style="padding-left:1.5rem; padding-right:1.5rem;">
                                <div style="display:flex; align-items:center; gap:1.5rem; padding-bottom:0.5rem;">
                                    <span style="font-size:0.875rem; color:rgba(244,241,232,0.7);">Client: <strong style="color:#f4f1e8;">{{ $award['client'] }}</strong></span>
                                    <x-ui.badge tone="neutral" variant="outline" style="border-color:rgba(244,241,232,0.4)!important; color:rgba(244,241,232,0.7)!important; font-family:'Archivo',sans-serif; font-weight:800; font-size:0.65rem; letter-spacing:0.08em; text-transform:uppercase;">{{ $award['year'] }}</x-ui.badge>
                                </div>
                            </x-ui.accordion-content>
                        </x-ui.accordion-item>
                    @endforeach
                </x-ui.accordion>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════
         SECTION 9 — TEAM
    ═══════════════════════════════════════════════ --}}
    <section id="team" class="brut-section" style="padding:4rem 1.5rem; background:#f4f1e8;">
        <div class="mx-auto max-w-7xl">
            <div class="mb-8 flex items-center gap-4">
                <h2 class="brut-display" style="font-size:clamp(2rem,5vw,4rem);">THE CREW</h2>
                <span class="brut-sticker" style="transform:rotate(3deg);">6 people, no bullshit</span>
            </div>

            <div class="grid grid-cols-2 gap-0 sm:grid-cols-3 lg:grid-cols-6" style="border:3px solid #111; box-shadow:8px 8px 0 #111;">
                @foreach ($team as $i => $member)
                    @php $accents2 = ['#ff4d2e','#2b50ff','#ffd400','#b6ff3c','#ff4d2e','#2b50ff']; @endphp
                    <div
                        class="brut-lift"
                        style="border-right:3px solid #111; padding:1.5rem 1rem; text-align:center; cursor:default; {{ $i === 5 ? 'border-right:0;' : '' }}"
                        x-data
                        @mouseenter="$el.style.background='{{ $accents2[$i] }}'"
                        @mouseleave="$el.style.background=''"
                    >
                        <x-ui.tooltip>
                            <x-ui.tooltip-trigger>
                                <x-ui.avatar style="width:4rem; height:4rem; margin:0 auto 0.75rem; border:3px solid #111; box-shadow:3px 3px 0 #111;">
                                    <x-ui.avatar-image
                                        src="https://picsum.photos/seed/{{ $member['seed'] }}/64/64"
                                        alt="{{ $member['name'] }}"
                                    />
                                    <x-ui.avatar-fallback style="background:#111; color:#f4f1e8; font-family:'Archivo',sans-serif; font-weight:800;">
                                        {{ strtoupper(substr($member['name'], 0, 2)) }}
                                    </x-ui.avatar-fallback>
                                </x-ui.avatar>
                            </x-ui.tooltip-trigger>
                            <x-ui.tooltip-content side="top">{{ $member['role'] }}</x-ui.tooltip-content>
                        </x-ui.tooltip>
                        <div style="font-family:'Archivo',sans-serif; font-weight:800; font-size:0.8rem; letter-spacing:-0.01em; color:#111; line-height:1.2;">{{ $member['name'] }}</div>
                        <div style="font-size:0.7rem; color:#666; margin-top:0.25rem; font-weight:500;">{{ $member['role'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════
         SECTION 10 — PULL QUOTE
    ═══════════════════════════════════════════════ --}}
    <section class="brut-section" style="padding:5rem 1.5rem; background:#ffd400;">
        <div class="mx-auto max-w-6xl">
            <div style="border:3px solid #111; box-shadow:10px 10px 0 #111; padding:3rem 2.5rem; position:relative;">
                {{-- Decorative quote mark --}}
                <div aria-hidden="true" style="font-family:'Archivo',sans-serif; font-weight:900; font-size:12rem; line-height:0.7; color:rgba(17,17,17,0.1); position:absolute; top:1rem; left:1.5rem; pointer-events:none;">"</div>

                <x-ui.quote
                    author="Mara Kuhn"
                    role="Motion Director, Stüdio Brut"
                    avatar="https://picsum.photos/seed/team3/80/80"
                >
                    Great branding is not decoration. It is the difference between a brand people remember and one they scroll past without blinking.
                </x-ui.quote>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════
         SECTION 11 — CONTACT FORM
    ═══════════════════════════════════════════════ --}}
    <section id="contact" class="brut-section" style="padding:4rem 1.5rem; background:#f4f1e8;">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-12 lg:grid-cols-2 lg:gap-16">
                {{-- Left: pitch --}}
                <div>
                    <span class="brut-sticker brut-sticker-red" style="transform:rotate(-3deg); display:inline-block; margin-bottom:1.5rem;">Let's work</span>
                    <h2 class="brut-display" style="font-size:clamp(2.5rem,7vw,6rem);">START A<br>PROJECT</h2>
                    <p style="margin-top:1.5rem; font-size:1.05rem; line-height:1.7; max-width:34ch; color:#333;">
                        We pick our projects carefully — and when we say yes, we go all in. Tell us about your brand and what needs to change.
                    </p>
                    <div style="margin-top:2rem; display:flex; flex-direction:column; gap:1rem;">
                        <div style="display:flex; align-items:center; gap:1rem;">
                            <span style="display:inline-flex; width:2.5rem; height:2.5rem; background:#111; color:#f4f1e8; align-items:center; justify-content:center; flex-shrink:0;">
                                <x-lucide-mail class="size-4" />
                            </span>
                            <span style="font-family:'Archivo',sans-serif; font-weight:800; font-size:0.9rem; letter-spacing:-0.01em;">hello@studibrut.com</span>
                        </div>
                        <div style="display:flex; align-items:center; gap:1rem;">
                            <span style="display:inline-flex; width:2.5rem; height:2.5rem; background:#111; color:#f4f1e8; align-items:center; justify-content:center; flex-shrink:0;">
                                <x-lucide-map-pin class="size-4" />
                            </span>
                            <span style="font-family:'Archivo',sans-serif; font-weight:800; font-size:0.9rem; letter-spacing:-0.01em;">Brussels — Berlin — Online</span>
                        </div>
                    </div>
                </div>

                {{-- Right: form --}}
                <div>
                    <form action="#" method="POST" novalidate>
                        @csrf
                        <div style="display:flex; flex-direction:column; gap:1.25rem;">

                            {{-- Name + Email row --}}
                            <div class="grid grid-cols-1 gap-1.25rem sm:grid-cols-2" style="display:grid; grid-template-columns:1fr 1fr; gap:1rem;">
                                <x-ui.field>
                                    <x-ui.field-label for="brut-name" class="brut-contact-label">Full name <span aria-hidden="true" style="color:#ff4d2e;">*</span></x-ui.field-label>
                                    <x-ui.input id="brut-name" name="name" type="text" placeholder="Ines Voss" required />
                                </x-ui.field>
                                <x-ui.field>
                                    <x-ui.field-label for="brut-email" class="brut-contact-label">Email <span aria-hidden="true" style="color:#ff4d2e;">*</span></x-ui.field-label>
                                    <x-ui.input id="brut-email" name="email" type="email" placeholder="you@brand.com" required />
                                </x-ui.field>
                            </div>

                            {{-- Company --}}
                            <x-ui.field>
                                <x-ui.field-label for="brut-company" class="brut-contact-label">Company / Brand</x-ui.field-label>
                                <x-ui.input id="brut-company" name="company" type="text" placeholder="Acme Corp" />
                            </x-ui.field>

                            {{-- Service select --}}
                            <x-ui.field>
                                <x-ui.field-label for="brut-service" class="brut-contact-label">Service needed <span aria-hidden="true" style="color:#ff4d2e;">*</span></x-ui.field-label>
                                <x-ui.select
                                    native
                                    name="service"
                                    id="brut-service"
                                    :options="$services_select"
                                    placeholder="Choose a discipline"
                                    required
                                />
                            </x-ui.field>

                            {{-- Budget select --}}
                            <x-ui.field>
                                <x-ui.field-label for="brut-budget" class="brut-contact-label">Estimated budget</x-ui.field-label>
                                <x-ui.select
                                    native
                                    name="budget"
                                    id="brut-budget"
                                    :options="$budget_select"
                                    placeholder="Select a range"
                                />
                            </x-ui.field>

                            {{-- Message --}}
                            <x-ui.field>
                                <x-ui.field-label for="brut-message" class="brut-contact-label">Tell us about your project <span aria-hidden="true" style="color:#ff4d2e;">*</span></x-ui.field-label>
                                <x-ui.textarea
                                    id="brut-message"
                                    name="message"
                                    placeholder="What's the brand, what needs to change, what's the timeline..."
                                    size="lg"
                                    required
                                />
                            </x-ui.field>

                            {{-- Submit --}}
                            <div style="padding-top:0.5rem;">
                                <button type="submit" class="brut-btn brut-btn-ink" style="font-size:1rem; padding:0.875rem 2.5rem; width:100%; justify-content:center;">
                                    Send the brief
                                    <x-lucide-arrow-right class="size-5" />
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════
         SECTION 12 — FOOTER TICKER + FOOTER
    ═══════════════════════════════════════════════ --}}
    <div class="brut-ticker" aria-hidden="true">
        <x-ui.marquee :direction="'right'" :duration="'32s'" :gap="'0px'">
            @foreach (['BOLD', 'LOUD', 'RAW', 'PRECISE', 'FEARLESS', 'INDEPENDENT', 'CREATIVE'] as $word)
                <span class="brut-ticker-word">{{ $word }}</span>
                <span class="brut-ticker-dot"> ✱ </span>
            @endforeach
        </x-ui.marquee>
    </div>

    <footer class="brut-footer" style="padding:3.5rem 1.5rem 2rem;">
        <div class="mx-auto max-w-7xl">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4" style="padding-bottom:3rem; border-bottom:2px solid rgba(244,241,232,0.2);">
                {{-- Brand col --}}
                <div class="lg:col-span-2">
                    <div class="brut-display" style="font-size:2.5rem; color:#f4f1e8; margin-bottom:1rem;">
                        STÜDIO<span style="color:#ff4d2e;">.</span>BRUT
                    </div>
                    <p style="font-size:0.9rem; line-height:1.7; color:rgba(244,241,232,0.6); max-width:28ch;">
                        A creative branding studio making brands that are impossible to ignore — since 2011.
                    </p>
                    <div style="margin-top:1.5rem; display:flex; gap:0.75rem;">
                        @foreach (['instagram', 'twitter', 'linkedin', 'github'] as $social)
                            <a href="#" aria-label="{{ ucfirst($social) }}" style="display:inline-flex; width:2.5rem; height:2.5rem; border:2px solid rgba(244,241,232,0.3); align-items:center; justify-content:center; color:rgba(244,241,232,0.6); text-decoration:none; transition:border-color 0.12s, color 0.12s;"
                                @mouseenter="$el.style.borderColor='#ff4d2e'; $el.style.color='#ff4d2e';"
                                @mouseleave="$el.style.borderColor=''; $el.style.color=''"
                                x-data>
                                <x-dynamic-component :component="'lucide-'.$social" class="size-4" />
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Links --}}
                <div>
                    <h3 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:0.75rem; letter-spacing:0.1em; text-transform:uppercase; color:rgba(244,241,232,0.5); margin-bottom:1rem;">Studio</h3>
                    <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:0.625rem;">
                        @foreach (['Work', 'Services', 'About', 'Awards', 'Careers'] as $link)
                            <li>
                                <a href="#" style="font-size:0.9rem; color:rgba(244,241,232,0.75); text-decoration:none; font-weight:500; transition:color 0.12s;"
                                    @mouseenter="$el.style.color='#ffd400'"
                                    @mouseleave="$el.style.color=''"
                                    x-data>{{ $link }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div>
                    <h3 style="font-family:'Archivo',sans-serif; font-weight:800; font-size:0.75rem; letter-spacing:0.1em; text-transform:uppercase; color:rgba(244,241,232,0.5); margin-bottom:1rem;">Get in touch</h3>
                    <ul style="list-style:none; padding:0; margin:0; display:flex; flex-direction:column; gap:0.625rem;">
                        @foreach (['Start a project', 'Partnership', 'Press', 'Privacy policy'] as $link)
                            <li>
                                <a href="#" style="font-size:0.9rem; color:rgba(244,241,232,0.75); text-decoration:none; font-weight:500; transition:color 0.12s;"
                                    @mouseenter="$el.style.color='#ffd400'"
                                    @mouseleave="$el.style.color=''"
                                    x-data>{{ $link }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div style="padding-top:1.5rem; display:flex; flex-wrap:wrap; align-items:center; justify-content:space-between; gap:1rem;">
                <span style="font-size:0.8rem; color:rgba(244,241,232,0.4);">© {{ date('Y') }} Stüdio Brut. All rights reserved.</span>
                <div style="display:flex; align-items:center; gap:0.75rem;">
                    <x-ui.badge tone="success" variant="solid" style="font-family:'Archivo',sans-serif; font-weight:800; font-size:0.65rem; letter-spacing:0.06em; text-transform:uppercase;">
                        <x-lucide-circle class="size-2.5" style="fill:#b6ff3c; stroke:none;" /> Open to projects
                    </x-ui.badge>
                    <x-ui.separator orientation="vertical" style="height:1rem;" />
                    <span style="font-size:0.75rem; color:rgba(244,241,232,0.4);">Brussels / Berlin</span>
                </div>
            </div>
        </div>
    </footer>

</div>{{-- #tpl-brut --}}

</x-layouts.app>
