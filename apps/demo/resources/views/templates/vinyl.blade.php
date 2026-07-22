@php
    /* ─────────────────────────────────────────────────────
     | WAVELENGTH 2026 — Music Festival template
     | Retro-editorial poster aesthetic: deep indigo base,
     | magenta→orange→yellow gradients, cyan accent.
     ───────────────────────────────────────────────────── */

    $artists = [
        ['name' => 'SOLARA',      'genre' => 'Electronic',  'time' => '22:00', 'day' => 1, 'seed' => 'solara1',     'bio' => 'Solara blends hyper-textured bass with ethereal synths, forging a sound that feels both ancient and alien.'],
        ['name' => 'KRYPT',       'genre' => 'Techno',      'time' => '00:30', 'day' => 1, 'seed' => 'krypt22',     'bio' => "Berlin-trained selector and producer, Krypt's sets unfold like brutalist architecture — relentless and hypnotic."],
        ['name' => 'NOVA VEGA',   'genre' => 'Indie Pop',   'time' => '20:00', 'day' => 2, 'seed' => 'novavega3',   'bio' => 'Nova Vega writes love songs for collapsing stars. Four acclaimed albums and a sold-out world tour in 2025.'],
        ['name' => 'THRENODY',    'genre' => 'Post-Rock',   'time' => '21:30', 'day' => 2, 'seed' => 'threnody4',   'bio' => 'Cinematic post-rock from Dublin. Guitars, cello, and found sounds woven into forty-minute soundscapes.'],
        ['name' => 'PULSE UNIT',  'genre' => 'Synth-Pop',   'time' => '19:00', 'day' => 1, 'seed' => 'pulseunit5',  'bio' => 'Pulse Unit resurrects the best of 80s synth-pop and electrifies it with modern production muscle.'],
        ['name' => 'MARIGOLD',    'genre' => 'R&B / Soul',  'time' => '21:00', 'day' => 3, 'seed' => 'marigold6',   'bio' => "Marigold's voice is raw honey. Her debut album topped charts in 27 countries; the follow-up drops June 2026."],
        ['name' => 'CIRCUIT BOY', 'genre' => 'Hyperpop',    'time' => '23:00', 'day' => 3, 'seed' => 'circuitboy7', 'bio' => 'Chaotic, glitchy, irresistible — Circuit Boy is the act everyone talks about the morning after.'],
        ['name' => 'SERAPHINE',   'genre' => 'Dream Pop',   'time' => '18:30', 'day' => 2, 'seed' => 'seraphine8',  'bio' => "Seraphine's hazy, reverb-soaked dream pop is the perfect opener for a festival sunset."],
    ];

    $schedule = [
        1 => [
            ['time' => '16:00', 'act' => 'DOORS OPEN', 'stage' => '—',         'genre' => ''],
            ['time' => '17:00', 'act' => 'DJ WARMUP',  'stage' => 'Stage B',    'genre' => 'House'],
            ['time' => '19:00', 'act' => 'PULSE UNIT', 'stage' => 'Main Stage', 'genre' => 'Synth-Pop'],
            ['time' => '21:00', 'act' => 'SOLARA',     'stage' => 'Main Stage', 'genre' => 'Electronic'],
            ['time' => '23:00', 'act' => 'KRYPT',      'stage' => 'Stage B',    'genre' => 'Techno'],
        ],
        2 => [
            ['time' => '16:00', 'act' => 'DOORS OPEN',  'stage' => '—',          'genre' => ''],
            ['time' => '17:30', 'act' => 'OPEN DECKS',  'stage' => 'Stage B',     'genre' => 'Various'],
            ['time' => '18:30', 'act' => 'SERAPHINE',   'stage' => 'Main Stage',  'genre' => 'Dream Pop'],
            ['time' => '20:00', 'act' => 'NOVA VEGA',   'stage' => 'Main Stage',  'genre' => 'Indie Pop'],
            ['time' => '21:30', 'act' => 'THRENODY',    'stage' => 'Stage B',     'genre' => 'Post-Rock'],
        ],
        3 => [
            ['time' => '16:00', 'act' => 'DOORS OPEN',  'stage' => '—',          'genre' => ''],
            ['time' => '18:00', 'act' => 'RISING ACTS', 'stage' => 'Stage B',     'genre' => 'Various'],
            ['time' => '21:00', 'act' => 'MARIGOLD',    'stage' => 'Main Stage',  'genre' => 'R&B / Soul'],
            ['time' => '23:00', 'act' => 'CIRCUIT BOY', 'stage' => 'Stage B',     'genre' => 'Hyperpop'],
            ['time' => '00:30', 'act' => 'CLOSING SET', 'stage' => 'Main Stage',  'genre' => 'Electronic'],
        ],
    ];

    $tickets = [
        ['tier' => 'General Admission', 'price' => '€89', 'badge' => 'Available', 'badge_tone' => 'success', 'rating' => 4, 'perks' => ['3-day festival access', 'Camping included', 'Late-night zones', 'Food-market access'], 'highlight' => false],
        ['tier' => 'VIP',               'price' => '€219', 'badge' => 'Popular',  'badge_tone' => null,       'rating' => 5, 'perks' => ['GA + VIP fast-track entry', 'Private viewing platform', 'Artist meet & greet ballot', 'Lounge bar & concierge'], 'highlight' => true],
        ['tier' => 'Backstage Pass',    'price' => '€499', 'badge' => 'Limited',  'badge_tone' => 'warning',  'rating' => 5, 'perks' => ['Everything in VIP', 'Backstage access all 3 days', 'Exclusive merchandise box', 'Post-show dinner with artists'], 'highlight' => false],
    ];

    $faqs = [
        ['q' => 'Where is Wavelength 2026 held?',        'a' => 'The festival takes place at Parc des Ondes, Brussels — accessible by metro, train and dedicated shuttle buses from Brussels Central.'],
        ['q' => 'Is camping included in the ticket?',    'a' => 'Yes — all General Admission and VIP tickets include camping. Upgrade to a glamping pod for an extra fee at checkout.'],
        ['q' => 'Can I bring my own food and drinks?',   'a' => 'Sealed water bottles are welcome. Outside alcohol is not permitted, but our food-market and zero-waste bars cover every taste.'],
        ['q' => 'Are tickets transferable?',             'a' => 'GA and VIP tickets can be transferred once via your account dashboard up to 7 days before the event. Backstage Passes are non-transferable.'],
        ['q' => 'What is the minimum age?',              'a' => 'All ages welcome until 22:00. Late-night zones (Stage B after midnight) are 18+ with valid ID.'],
    ];

    $gallery = [
        ['src' => 'https://picsum.photos/seed/wl-g1/900/600',  'thumb' => 'https://picsum.photos/seed/wl-g1/400/400',  'alt' => 'Crowd at night stage'],
        ['src' => 'https://picsum.photos/seed/wl-g2/900/600',  'thumb' => 'https://picsum.photos/seed/wl-g2/400/400',  'alt' => 'DJ performing under lasers'],
        ['src' => 'https://picsum.photos/seed/wl-g3/900/600',  'thumb' => 'https://picsum.photos/seed/wl-g3/400/400',  'alt' => 'Festival crowd from above'],
        ['src' => 'https://picsum.photos/seed/wl-g4/900/600',  'thumb' => 'https://picsum.photos/seed/wl-g4/400/400',  'alt' => 'Colourful light show on main stage'],
        ['src' => 'https://picsum.photos/seed/wl-g5/900/600',  'thumb' => 'https://picsum.photos/seed/wl-g5/400/400',  'alt' => 'Artist backstage moment'],
        ['src' => 'https://picsum.photos/seed/wl-g6/900/600',  'thumb' => 'https://picsum.photos/seed/wl-g6/400/400',  'alt' => 'Sunset over the festival grounds'],
    ];

    $listeners = ['wl-l1', 'wl-l2', 'wl-l3', 'wl-l4', 'wl-l5'];

    $ticker = ['WAVELENGTH 2026', 'BRUSSELS · JULY 18–20', 'SOLARA', 'KRYPT', 'NOVA VEGA', 'THRENODY', 'PULSE UNIT', 'MARIGOLD', 'CIRCUIT BOY', 'SERAPHINE', '60+ ARTISTS', '3 STAGES', '3 DAYS'];
@endphp

<x-layouts.app title="Wavelength — Music Festival 2026">

{{-- ═══════════════════════════════════════════════════════════
     SONNER TOASTER (needed for "Added to queue" toast)
═══════════════════════════════════════════════════════════ --}}
<x-ui.sonner position="bottom-right" />

{{-- ═══════════════════════════════════════════════════════════
     SCOPED STYLES
═══════════════════════════════════════════════════════════ --}}
<style>
@import url('https://fonts.bunny.net/css?family=space-grotesk:400,500,700,900|outfit:300,400,500,600&display=swap');

/* Reset site theme influence inside the template */
#tpl-vinyl,
#tpl-vinyl * {
    --tw-ring-color: #ff2d95;
}

#tpl-vinyl {
    --vl-base:    #1b0a3b;
    --vl-base2:   #120726;
    --vl-magenta: #ff2d95;
    --vl-orange:  #ff8a00;
    --vl-yellow:  #ffd23f;
    --vl-cyan:    #00e5ff;
    --vl-cream:   #fff3e6;
    --vl-white:   #ffffff;
    --vl-purple:  #7b2fff;
    --vl-muted:   rgba(255,243,230,0.55);
    font-family: 'Outfit', sans-serif;
    background: var(--vl-base);
    color: var(--vl-cream);
}

/* Display headings use Space Grotesk */
#tpl-vinyl .vl-display {
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 900;
}

/* Gradient text helper */
#tpl-vinyl .vl-grad-text {
    background: linear-gradient(90deg, var(--vl-magenta) 0%, var(--vl-orange) 50%, var(--vl-yellow) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* Diagonal gradient band */
#tpl-vinyl .vl-diagonal-band {
    background: linear-gradient(135deg, var(--vl-magenta) 0%, var(--vl-orange) 55%, var(--vl-yellow) 100%);
}

/* Vinyl record */
#tpl-vinyl .vl-record {
    width: 340px;
    height: 340px;
    border-radius: 50%;
    background: radial-gradient(circle at 50%,
        #1a1a1a 0 9%,
        #2d2d2d 9% 11%,
        #111    11% 18%,
        #2a2a2a 18% 20%,
        #111    20% 28%,
        #2a2a2a 28% 30%,
        #111    30% 39%,
        #2a2a2a 39% 41%,
        #111    41% 50%,
        #1f1f1f 50% 100%
    );
    box-shadow:
        0 0 0 3px #333,
        0 0 40px rgba(255,45,149,0.45),
        0 0 80px rgba(0,229,255,0.15);
    animation: vl-spin 14s linear infinite;
    flex-shrink: 0;
}

#tpl-vinyl .vl-record::after {
    content: '';
    position: absolute;
    inset: 41%;
    border-radius: 50%;
    background: radial-gradient(circle, var(--vl-magenta) 0%, var(--vl-orange) 60%, var(--vl-yellow) 100%);
    box-shadow: 0 0 12px rgba(255,45,149,0.8);
}

#tpl-vinyl .vl-record-wrap {
    position: relative;
}

@keyframes vl-spin {
    from { transform: rotate(0deg); }
    to   { transform: rotate(360deg); }
}

/* Grain overlay */
#tpl-vinyl .vl-grain::before {
    content: '';
    position: absolute;
    inset: 0;
    background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 200 200' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23n)' opacity='0.06'/%3E%3C/svg%3E");
    background-size: 200px 200px;
    pointer-events: none;
    z-index: 1;
    opacity: 0.35;
    mix-blend-mode: overlay;
}

/* Glow hero title */
#tpl-vinyl .vl-hero-title {
    text-shadow:
        0 0 40px rgba(255,45,149,0.7),
        0 0 80px rgba(255,138,0,0.4),
        0 2px 0 rgba(0,0,0,0.5);
}

/* Marquee ticker */
#tpl-vinyl .vl-ticker {
    background: linear-gradient(90deg, var(--vl-magenta) 0%, var(--vl-orange) 50%, var(--vl-yellow) 100%);
    color: var(--vl-base);
}

/* Section divider */
#tpl-vinyl .vl-divider {
    height: 4px;
    background: linear-gradient(90deg, var(--vl-magenta), var(--vl-orange), var(--vl-yellow), var(--vl-cyan));
    border: none;
}

/* Player widget */
#tpl-vinyl .vl-player {
    background: linear-gradient(135deg, rgba(27,10,59,0.9) 0%, rgba(123,47,255,0.25) 100%);
    border: 1px solid rgba(255,45,149,0.3);
    backdrop-filter: blur(12px);
}

/* Cards with glow on hover */
#tpl-vinyl .vl-card {
    background: rgba(255,255,255,0.04);
    border: 1px solid rgba(255,243,230,0.12);
    transition: border-color .25s, box-shadow .25s, transform .2s;
}
#tpl-vinyl .vl-card:hover {
    border-color: rgba(255,45,149,0.55);
    box-shadow: 0 0 24px rgba(255,45,149,0.2);
    transform: translateY(-2px);
}

/* Ticket highlight */
#tpl-vinyl .vl-ticket-highlight {
    border: 2px solid var(--vl-magenta) !important;
    box-shadow: 0 0 40px rgba(255,45,149,0.35);
    background: rgba(255,45,149,0.08) !important;
}

/* Button overrides */
#tpl-vinyl .vl-btn-primary {
    background: linear-gradient(90deg, var(--vl-magenta) 0%, var(--vl-orange) 100%);
    color: var(--vl-base);
    font-weight: 700;
    font-family: 'Space Grotesk', sans-serif;
    letter-spacing: 0.02em;
    border: none;
    transition: filter .2s, transform .15s;
}
#tpl-vinyl .vl-btn-primary:hover {
    filter: brightness(1.12);
    transform: translateY(-1px);
}

#tpl-vinyl .vl-btn-outline {
    background: transparent;
    border: 2px solid var(--vl-cyan);
    color: var(--vl-cyan);
    font-weight: 600;
    font-family: 'Space Grotesk', sans-serif;
    transition: background .2s, color .2s, transform .15s;
}
#tpl-vinyl .vl-btn-outline:hover {
    background: var(--vl-cyan);
    color: var(--vl-base);
    transform: translateY(-1px);
}

/* Accordion overrides */
#tpl-vinyl [data-slot="accordion-item"] {
    border-color: rgba(255,243,230,0.15);
}
#tpl-vinyl [data-slot="accordion-trigger"] {
    color: var(--vl-cream);
}
#tpl-vinyl [data-slot="accordion-content"] {
    color: var(--vl-muted);
}

/* Table */
#tpl-vinyl [data-slot="table"] th {
    color: var(--vl-muted);
    font-family: 'Space Grotesk', sans-serif;
    font-size: 0.7rem;
    letter-spacing: 0.1em;
    text-transform: uppercase;
}
#tpl-vinyl [data-slot="table"] td {
    color: var(--vl-cream);
}
#tpl-vinyl [data-slot="table-row"] {
    border-color: rgba(255,243,230,0.08);
}
#tpl-vinyl [data-slot="table-row"]:hover {
    background: rgba(255,45,149,0.06);
}

/* Tabs override */
#tpl-vinyl [data-slot="tabs-list"] {
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,243,230,0.12);
}
#tpl-vinyl [data-slot="tabs-trigger"] {
    color: var(--vl-muted);
}
#tpl-vinyl [data-slot="tabs-trigger"][data-state="active"] {
    background: linear-gradient(90deg, var(--vl-magenta), var(--vl-orange)) !important;
    color: var(--vl-base) !important;
    font-weight: 700;
    border: none !important;
    box-shadow: none !important;
}

/* Slider fill */
#tpl-vinyl [data-slot="slider-range"] {
    background: linear-gradient(90deg, var(--vl-magenta), var(--vl-orange));
}
#tpl-vinyl [data-slot="slider-thumb"] {
    border-color: var(--vl-magenta);
    background: var(--vl-cream);
}

/* Progress fill */
#tpl-vinyl [data-slot="progress"] {
    background: rgba(255,243,230,0.15);
}
#tpl-vinyl [data-slot="progress-indicator"] {
    background: linear-gradient(90deg, var(--vl-magenta), var(--vl-cyan));
}

/* Input group */
#tpl-vinyl [data-slot="input-group"] {
    background: rgba(255,255,255,0.06);
    border-color: rgba(255,243,230,0.2);
}
#tpl-vinyl [data-slot="input-group-control"] {
    color: var(--vl-cream);
}
#tpl-vinyl [data-slot="input-group-control"]::placeholder {
    color: var(--vl-muted);
}

/* Separator */
#tpl-vinyl [data-slot="separator"] {
    background: rgba(255,243,230,0.12);
}

/* Hover-card */
#tpl-vinyl [data-slot="hover-card-content"] {
    background: #1b0a3b;
    border: 1px solid rgba(255,45,149,0.35);
    color: var(--vl-cream);
    width: 220px;
}

/* Badge: override for custom look */
#tpl-vinyl .vl-badge-grad {
    background: linear-gradient(90deg, var(--vl-magenta) 0%, var(--vl-orange) 100%);
    color: var(--vl-base);
    border: none;
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 700;
    letter-spacing: 0.04em;
}

/* Nav bar */
#tpl-vinyl .vl-nav {
    background: rgba(27,10,59,0.85);
    border-bottom: 1px solid rgba(255,45,149,0.25);
    backdrop-filter: blur(16px);
}

/* Footer */
#tpl-vinyl .vl-footer {
    background: var(--vl-base2);
    border-top: 1px solid rgba(255,45,149,0.25);
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    #tpl-vinyl .vl-record { animation: none; }
}

/* Rating gold */
#tpl-vinyl [data-slot="rating"] { color: var(--vl-yellow); }
</style>

<div id="tpl-vinyl">

    {{-- ───────────────────────────────────────────────────────
         § 0 · TOP MARQUEE TICKER (dates + cities)
    ─────────────────────────────────────────────────────────── --}}
    <div class="vl-ticker overflow-hidden py-2.5" aria-label="Wavelength festival dates ticker">
        <x-ui.marquee :duration="'28s'" :pause-on-hover="false" gap="0.5rem">
            @foreach ($ticker as $item)
                <span class="vl-display text-xs sm:text-sm font-bold tracking-widest uppercase px-4 whitespace-nowrap">{{ $item }}</span>
                <span class="text-sm opacity-60 px-1" aria-hidden="true">✱</span>
            @endforeach
        </x-ui.marquee>
    </div>

    {{-- ───────────────────────────────────────────────────────
         § 1 · NAVIGATION
    ─────────────────────────────────────────────────────────── --}}
    <header class="vl-nav sticky top-0 z-40">
        <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-6">
            <a href="#" class="vl-display flex items-center gap-2 text-xl font-black tracking-tight text-white">
                <span class="inline-flex size-8 items-center justify-center rounded-full" style="background: linear-gradient(135deg, #ff2d95, #ff8a00);" aria-hidden="true">
                    <x-lucide-music class="size-4 text-white" />
                </span>
                WAVELENGTH
            </a>
            <nav class="ml-6 hidden items-center gap-5 text-sm md:flex" aria-label="Primary navigation">
                @foreach (['Line-Up' => '#lineup', 'Schedule' => '#schedule', 'Tickets' => '#tickets', 'Gallery' => '#gallery', 'FAQ' => '#faq'] as $label => $href)
                    <a href="{{ $href }}" class="font-medium tracking-wide transition-colors hover:text-white" style="color: var(--vl-muted)">{{ $label }}</a>
                @endforeach
            </nav>
            <div class="ml-auto flex items-center gap-2">
                <a href="#tickets" class="vl-btn-primary inline-flex items-center gap-1.5 rounded-lg px-4 py-2 text-sm" role="button">
                    <x-lucide-ticket class="size-4" />
                    Get Tickets
                </a>
            </div>
        </div>
    </header>

    {{-- ───────────────────────────────────────────────────────
         § 2 · HERO
    ─────────────────────────────────────────────────────────── --}}
    <section class="vl-grain relative overflow-hidden" style="background: radial-gradient(ellipse at 30% 0%, rgba(255,45,149,0.22) 0%, transparent 55%), radial-gradient(ellipse at 80% 30%, rgba(0,229,255,0.12) 0%, transparent 50%), var(--vl-base);">
        <div class="mx-auto grid max-w-7xl items-center gap-12 px-6 py-20 lg:grid-cols-2 lg:py-28">
            {{-- Left: text --}}
            <div class="relative z-10">
                <div class="mb-5 flex flex-wrap items-center gap-2">
                    <x-ui.badge class="vl-badge-grad px-3 py-1 text-xs">3 DAYS</x-ui.badge>
                    <x-ui.badge class="vl-badge-grad px-3 py-1 text-xs">60+ ARTISTS</x-ui.badge>
                    <x-ui.badge class="vl-badge-grad px-3 py-1 text-xs">3 STAGES</x-ui.badge>
                </div>

                <h1 class="vl-display vl-hero-title text-6xl font-black leading-none tracking-tight text-white sm:text-7xl lg:text-8xl">
                    WAVE<br>
                    <span class="vl-grad-text">LENGTH</span>
                </h1>
                <p class="vl-display mt-3 text-2xl font-bold tracking-widest" style="color: var(--vl-cyan);">2026</p>

                <div class="mt-5 flex flex-wrap items-center gap-3 text-sm font-medium" style="color: var(--vl-muted);">
                    <span class="flex items-center gap-1.5"><x-lucide-calendar class="size-4" style="color: var(--vl-yellow);" /> July 18 – 20, 2026</span>
                    <span aria-hidden="true">·</span>
                    <span class="flex items-center gap-1.5"><x-lucide-map-pin class="size-4" style="color: var(--vl-yellow);" /> Parc des Ondes, Brussels</span>
                </div>

                <p class="mt-5 max-w-md leading-relaxed" style="color: var(--vl-muted); font-size: 1.05rem;">
                    Three days of electronic music, indie anthems, post-rock landscapes and everything in between — under open skies on the outskirts of Brussels.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#tickets" class="vl-btn-primary inline-flex items-center gap-2 rounded-xl px-7 py-3 text-base font-bold" role="button">
                        <x-lucide-ticket class="size-5" />
                        Buy Tickets
                    </a>
                    <a href="#lineup" class="vl-btn-outline inline-flex items-center gap-2 rounded-xl px-7 py-3 text-base" role="button">
                        <x-lucide-users class="size-5" />
                        See Line-Up
                    </a>
                </div>

                <div class="mt-8 flex items-center gap-3">
                    <div class="flex -space-x-2" aria-label="Festival attendees">
                        @foreach ($listeners as $seed)
                            <x-ui.avatar class="ring-2 size-9" style="--tw-ring-color: var(--vl-base);">
                                <x-ui.avatar-image src="https://picsum.photos/seed/{{ $seed }}/80/80" alt="Attendee" />
                                <x-ui.avatar-fallback style="background: var(--vl-purple); color: var(--vl-cream);">W</x-ui.avatar-fallback>
                            </x-ui.avatar>
                        @endforeach
                    </div>
                    <p class="text-sm" style="color: var(--vl-muted);">
                        <span class="font-bold text-white">12,400+</span> tickets already sold
                    </p>
                </div>
            </div>

            {{-- Right: spinning vinyl --}}
            <div class="flex items-center justify-center lg:justify-end">
                <div class="vl-record-wrap relative flex items-center justify-center">
                    <div class="vl-record" role="img" aria-label="Vinyl record graphic"></div>
                    {{-- Glowing ring behind the record --}}
                    <div class="pointer-events-none absolute inset-0 rounded-full" style="box-shadow: 0 0 100px rgba(255,45,149,0.3), 0 0 200px rgba(0,229,255,0.1);"></div>
                </div>
            </div>
        </div>

        {{-- Diagonal colour stripe at bottom --}}
        <div class="vl-diagonal-band h-2 w-full" aria-hidden="true"></div>
    </section>

    {{-- ───────────────────────────────────────────────────────
         § 3 · LINE-UP GRID (hover-cards for bios)
    ─────────────────────────────────────────────────────────── --}}
    <section id="lineup" class="scroll-mt-20 py-20 lg:py-28" style="background: linear-gradient(180deg, var(--vl-base) 0%, rgba(18,7,38,1) 100%);">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-12 text-center">
                <x-ui.badge class="vl-badge-grad mb-4 px-3 py-1">LINE-UP</x-ui.badge>
                <h2 class="vl-display text-4xl font-black text-white sm:text-5xl">The Artists</h2>
                <p class="mt-3 text-sm sm:text-base" style="color: var(--vl-muted);">Hover an artist card to learn more. Three days, one lineup to remember.</p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($artists as $artist)
                    <x-ui.hover-card>
                        <x-ui.hover-card-trigger>
                            <div class="vl-card group cursor-pointer overflow-hidden rounded-2xl">
                                <div class="relative aspect-square overflow-hidden">
                                    <img
                                        src="https://picsum.photos/seed/{{ $artist['seed'] }}/400/400"
                                        alt="{{ $artist['name'] }}"
                                        loading="lazy"
                                        class="size-full object-cover transition-transform duration-500 group-hover:scale-110"
                                    />
                                    {{-- Gradient overlay --}}
                                    <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(27,10,59,0.9) 0%, transparent 60%);" aria-hidden="true"></div>
                                    {{-- Day badge --}}
                                    <span class="absolute right-2 top-2">
                                        <x-ui.badge class="vl-badge-grad text-xs px-2 py-0.5">Day {{ $artist['day'] }}</x-ui.badge>
                                    </span>
                                    {{-- Artist info at bottom --}}
                                    <div class="absolute bottom-0 left-0 right-0 p-4">
                                        <p class="vl-display text-lg font-black text-white leading-none">{{ $artist['name'] }}</p>
                                        <p class="mt-1 text-xs font-medium tracking-wider uppercase" style="color: var(--vl-cyan);">{{ $artist['genre'] }}</p>
                                    </div>
                                </div>
                                <div class="p-3 flex items-center justify-between">
                                    <span class="text-xs font-semibold" style="color: var(--vl-muted);">
                                        <x-lucide-clock class="inline size-3.5 mr-1 align-middle" aria-hidden="true" />{{ $artist['time'] }}
                                    </span>
                                    <x-ui.tooltip>
                                        <x-ui.tooltip-trigger>
                                            <x-lucide-info class="size-4" style="color: var(--vl-muted);" aria-label="Artist info" />
                                        </x-ui.tooltip-trigger>
                                        <x-ui.tooltip-content>{{ $artist['genre'] }} · Day {{ $artist['day'] }} @ {{ $artist['time'] }}</x-ui.tooltip-content>
                                    </x-ui.tooltip>
                                </div>
                            </div>
                        </x-ui.hover-card-trigger>

                        <x-ui.hover-card-content side="top" align="center">
                            <p class="vl-display text-sm font-bold text-white">{{ $artist['name'] }}</p>
                            <p class="text-xs mb-2" style="color: var(--vl-cyan);">{{ $artist['genre'] }} · Day {{ $artist['day'] }} · {{ $artist['time'] }}</p>
                            <p class="text-xs leading-relaxed" style="color: var(--vl-muted);">{{ $artist['bio'] }}</p>
                        </x-ui.hover-card-content>
                    </x-ui.hover-card>
                @endforeach
            </div>
        </div>
    </section>

    <hr class="vl-divider" aria-hidden="true" />

    {{-- ───────────────────────────────────────────────────────
         § 4 · NOW PLAYING PLAYER WIDGET
    ─────────────────────────────────────────────────────────── --}}
    <section class="py-16" style="background: var(--vl-base2);">
        <div class="mx-auto max-w-4xl px-6">
            <div class="mb-8 text-center">
                <x-ui.badge class="vl-badge-grad mb-3 px-3 py-1">NOW PLAYING</x-ui.badge>
                <h2 class="vl-display text-3xl font-black text-white sm:text-4xl">Festival Vibes</h2>
            </div>

            <div class="vl-player rounded-3xl p-6 sm:p-8"
                 x-data="{
                     playing: false,
                     progress: 34,
                     volume: 72,
                     trackIndex: 0,
                     tracks: [
                         { title: 'Ultraviolet', artist: 'SOLARA', duration: '6:42' },
                         { title: 'Concrete Jungle', artist: 'KRYPT', duration: '8:15' },
                         { title: 'Open Skies', artist: 'NOVA VEGA', duration: '4:28' },
                     ],
                     get track() { return this.tracks[this.trackIndex]; },
                     next() { this.trackIndex = (this.trackIndex + 1) % this.tracks.length; this.progress = 0; },
                     prev() { this.trackIndex = (this.trackIndex - 1 + this.tracks.length) % this.tracks.length; this.progress = 0; },
                 }">
                <div class="grid gap-8 sm:grid-cols-[auto_1fr]">
                    {{-- Album art --}}
                    <div class="relative mx-auto sm:mx-0">
                        <div class="overflow-hidden rounded-2xl shadow-2xl" style="width: 140px; height: 140px; box-shadow: 0 0 40px rgba(255,45,149,0.4);">
                            <img src="https://picsum.photos/seed/wl-now/280/280" alt="Album art" class="size-full object-cover" />
                        </div>
                        {{-- Animated ring on playing --}}
                        <div x-show="playing" class="pointer-events-none absolute inset-0 rounded-2xl" style="box-shadow: 0 0 0 3px rgba(255,45,149,0.6), 0 0 30px rgba(255,45,149,0.3);" aria-hidden="true"></div>
                    </div>

                    {{-- Controls --}}
                    <div class="flex min-w-0 flex-col justify-between gap-4">
                        <div>
                            <p class="vl-display text-xl font-black text-white" x-text="track.title"></p>
                            <p class="text-sm font-medium mt-0.5" style="color: var(--vl-cyan);" x-text="track.artist"></p>
                        </div>

                        {{-- Seek slider --}}
                        <div>
                            <x-ui.slider :value="34" :min="0" :max="100" ariaLabel="Track position" x-model="progress" />
                            <div class="mt-1.5 flex justify-between text-xs tabular-nums" style="color: var(--vl-muted);">
                                <span x-text="Math.floor(progress * 0.0642) + ':' + String(Math.floor((progress * 0.0642 % 1) * 60)).padStart(2,'0')">2:18</span>
                                <span x-text="track.duration">6:42</span>
                            </div>
                        </div>

                        {{-- Playback buttons --}}
                        <div class="flex items-center justify-between gap-2">
                            <div class="flex items-center gap-1">
                                <x-ui.button variant="ghost" size="icon-sm" @click="prev()" aria-label="Previous track" class="text-white/60 hover:text-white">
                                    <x-lucide-skip-back class="size-5" />
                                </x-ui.button>
                                <button
                                    type="button"
                                    @click="playing = !playing"
                                    :aria-label="playing ? 'Pause' : 'Play'"
                                    class="vl-btn-primary inline-flex size-11 items-center justify-center rounded-full text-base"
                                >
                                    <x-lucide-play class="size-5" x-show="!playing" aria-hidden="true" />
                                    <x-lucide-pause class="size-5" x-show="playing" x-cloak aria-hidden="true" />
                                </button>
                                <x-ui.button variant="ghost" size="icon-sm" @click="next()" aria-label="Next track" class="text-white/60 hover:text-white">
                                    <x-lucide-skip-forward class="size-5" />
                                </x-ui.button>
                            </div>

                            {{-- Volume --}}
                            <div class="hidden items-center gap-2 sm:flex">
                                <x-lucide-volume-2 class="size-4 shrink-0" style="color: var(--vl-muted);" aria-hidden="true" />
                                <div class="w-24">
                                    <x-ui.slider :value="72" :min="0" :max="100" ariaLabel="Volume" x-model="volume" />
                                </div>
                            </div>

                            {{-- Add to queue toast trigger --}}
                            <x-ui.button
                                variant="ghost"
                                size="sm"
                                @click="window.toast({ type: 'success', title: 'Added to queue', description: track.title + ' by ' + track.artist })"
                                class="text-xs"
                                style="color: var(--vl-muted);"
                                aria-label="Add current track to queue"
                            >
                                <x-lucide-list-plus class="size-4" />
                                Queue
                            </x-ui.button>
                        </div>

                        {{-- Progress bar (overall festival stream progress) --}}
                        <div>
                            <p class="mb-1.5 text-xs font-medium" style="color: var(--vl-muted);">Stream popularity</p>
                            <x-ui.progress :value="78" ariaLabel="Track stream popularity 78%" />
                        </div>
                    </div>
                </div>

                {{-- Listeners --}}
                <x-ui.separator class="my-5" />
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-2">
                        <div class="flex -space-x-1.5">
                            @foreach ($listeners as $seed)
                                <x-ui.avatar class="ring-1 size-6" style="--tw-ring-color: var(--vl-base2);">
                                    <x-ui.avatar-image src="https://picsum.photos/seed/{{ $seed }}/48/48" alt="Listener" />
                                    <x-ui.avatar-fallback style="background: var(--vl-purple); color: var(--vl-cream); font-size: 0.55rem;">W</x-ui.avatar-fallback>
                                </x-ui.avatar>
                            @endforeach
                        </div>
                        <p class="text-xs" style="color: var(--vl-muted);"><span class="font-semibold text-white">3,842</span> listening now</p>
                    </div>
                    <x-ui.badge variant="outline" class="border-current text-xs" style="color: var(--vl-cyan); border-color: var(--vl-cyan);">
                        <x-lucide-radio class="size-3 animate-pulse" aria-hidden="true" /> LIVE
                    </x-ui.badge>
                </div>
            </div>
        </div>
    </section>

    <hr class="vl-divider" aria-hidden="true" />

    {{-- ───────────────────────────────────────────────────────
         § 5 · SCHEDULE TABS → TABLE
    ─────────────────────────────────────────────────────────── --}}
    <section id="schedule" class="scroll-mt-20 py-20 lg:py-28" style="background: var(--vl-base);">
        <div class="mx-auto max-w-4xl px-6">
            <div class="mb-10 text-center">
                <x-ui.badge class="vl-badge-grad mb-4 px-3 py-1">SCHEDULE</x-ui.badge>
                <h2 class="vl-display text-4xl font-black text-white sm:text-5xl">Set Times</h2>
                <p class="mt-2 text-sm" style="color: var(--vl-muted);">All times CEST. Subject to change — check the app day-of.</p>
            </div>

            <x-ui.tabs value="day-1">
                <x-ui.tabs-list class="mx-auto w-full max-w-xs grid grid-cols-3">
                    <x-ui.tabs-trigger value="day-1">Day 1</x-ui.tabs-trigger>
                    <x-ui.tabs-trigger value="day-2">Day 2</x-ui.tabs-trigger>
                    <x-ui.tabs-trigger value="day-3">Day 3</x-ui.tabs-trigger>
                </x-ui.tabs-list>

                @foreach ([1, 2, 3] as $day)
                    <x-ui.tabs-content value="day-{{ $day }}" class="mt-6">
                        <x-ui.table>
                            <x-ui.table-header>
                                <x-ui.table-row>
                                    <x-ui.table-head>Time</x-ui.table-head>
                                    <x-ui.table-head>Artist / Act</x-ui.table-head>
                                    <x-ui.table-head>Stage</x-ui.table-head>
                                    <x-ui.table-head>Genre</x-ui.table-head>
                                </x-ui.table-row>
                            </x-ui.table-header>
                            <x-ui.table-body>
                                @foreach ($schedule[$day] as $set)
                                    <x-ui.table-row>
                                        <x-ui.table-cell class="tabular-nums font-mono text-sm font-semibold" style="color: var(--vl-cyan);">{{ $set['time'] }}</x-ui.table-cell>
                                        <x-ui.table-cell class="vl-display font-bold text-white">{{ $set['act'] }}</x-ui.table-cell>
                                        <x-ui.table-cell style="color: var(--vl-muted); font-size: 0.85rem;">{{ $set['stage'] }}</x-ui.table-cell>
                                        <x-ui.table-cell>
                                            @if ($set['genre'])
                                                <x-ui.badge variant="outline" class="text-xs border-white/20" style="color: var(--vl-muted);">{{ $set['genre'] }}</x-ui.badge>
                                            @endif
                                        </x-ui.table-cell>
                                    </x-ui.table-row>
                                @endforeach
                            </x-ui.table-body>
                        </x-ui.table>
                    </x-ui.tabs-content>
                @endforeach
            </x-ui.tabs>
        </div>
    </section>

    {{-- ───────────────────────────────────────────────────────
         § 6 · PHOTO GALLERY
    ─────────────────────────────────────────────────────────── --}}
    <section id="gallery" class="scroll-mt-20 py-20 lg:py-28" style="background: var(--vl-base2);">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-10 text-center">
                <x-ui.badge class="vl-badge-grad mb-4 px-3 py-1">GALLERY</x-ui.badge>
                <h2 class="vl-display text-4xl font-black text-white sm:text-5xl">Past Editions</h2>
                <p class="mt-2 text-sm" style="color: var(--vl-muted);">Click any photo to open the full-screen lightbox.</p>
            </div>
            <x-ui.gallery :images="$gallery" :columns="3" rounded="rounded-xl" />
        </div>
    </section>

    <hr class="vl-divider" aria-hidden="true" />

    {{-- ───────────────────────────────────────────────────────
         § 7 · TICKETS
    ─────────────────────────────────────────────────────────── --}}
    <section id="tickets" class="scroll-mt-20 py-20 lg:py-28" style="background: var(--vl-base);">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-12 text-center">
                <x-ui.badge class="vl-badge-grad mb-4 px-3 py-1">TICKETS</x-ui.badge>
                <h2 class="vl-display text-4xl font-black text-white sm:text-5xl">Choose Your Experience</h2>
                <p class="mt-3 text-sm sm:text-base" style="color: var(--vl-muted);">All tiers include 3-day festival access + camping. Prices include all fees.</p>
            </div>

            <div class="grid items-stretch gap-6 lg:grid-cols-3">
                @foreach ($tickets as $ticket)
                    <div class="vl-card @if($ticket['highlight']) vl-ticket-highlight @endif relative flex flex-col rounded-2xl p-7">
                        @if ($ticket['highlight'])
                            <div class="absolute -top-3.5 left-1/2 -translate-x-1/2">
                                <x-ui.badge class="vl-badge-grad px-4 py-1 text-xs font-bold uppercase tracking-wider">Most Popular</x-ui.badge>
                            </div>
                        @endif

                        <div class="flex items-start justify-between gap-2">
                            <h3 class="vl-display text-xl font-bold text-white">{{ $ticket['tier'] }}</h3>
                            @if ($ticket['badge_tone'])
                                <x-ui.badge :tone="$ticket['badge_tone']" variant="soft" class="text-xs shrink-0">{{ $ticket['badge'] }}</x-ui.badge>
                            @else
                                <x-ui.badge class="vl-badge-grad text-xs shrink-0">{{ $ticket['badge'] }}</x-ui.badge>
                            @endif
                        </div>

                        <div class="mt-4 flex items-baseline gap-1">
                            <span class="vl-display text-5xl font-black" style="color: var(--vl-yellow);">{{ $ticket['price'] }}</span>
                            <span class="text-sm" style="color: var(--vl-muted);">/person</span>
                        </div>

                        {{-- Star rating --}}
                        <div class="mt-3">
                            <x-ui.rating :value="$ticket['rating']" :max="5" :readonly="true" color="text-yellow-400" size="sm" />
                        </div>

                        <x-ui.separator class="my-5" />

                        <ul class="mb-6 flex-1 space-y-2.5 text-sm" style="color: var(--vl-muted);">
                            @foreach ($ticket['perks'] as $perk)
                                <li class="flex items-center gap-2.5">
                                    <x-lucide-check class="size-4 shrink-0" style="color: var(--vl-cyan);" aria-hidden="true" />
                                    {{ $perk }}
                                </li>
                            @endforeach
                        </ul>

                        <a
                            href="#"
                            class="@if($ticket['highlight']) vl-btn-primary @else vl-btn-outline @endif inline-flex w-full items-center justify-center gap-2 rounded-xl py-3 text-sm font-bold"
                            role="button"
                        >
                            <x-lucide-ticket class="size-4" />
                            Buy {{ $ticket['tier'] }}
                        </a>
                    </div>
                @endforeach
            </div>

            <p class="mt-8 text-center text-xs" style="color: var(--vl-muted);">
                Secure checkout · Instant e-ticket delivery · 100% money-back guarantee if the event is cancelled
            </p>
        </div>
    </section>

    <hr class="vl-divider" aria-hidden="true" />

    {{-- ───────────────────────────────────────────────────────
         § 8 · FAQ ACCORDION
    ─────────────────────────────────────────────────────────── --}}
    <section id="faq" class="scroll-mt-20 py-20 lg:py-28" style="background: var(--vl-base2);">
        <div class="mx-auto max-w-2xl px-6">
            <div class="mb-10 text-center">
                <x-ui.badge class="vl-badge-grad mb-4 px-3 py-1">FAQ</x-ui.badge>
                <h2 class="vl-display text-4xl font-black text-white sm:text-5xl">Need to Know</h2>
            </div>

            <x-ui.accordion type="single" collapsible class="w-full">
                @foreach ($faqs as $i => $faq)
                    <x-ui.accordion-item value="faq-{{ $i }}">
                        <x-ui.accordion-trigger>{{ $faq['q'] }}</x-ui.accordion-trigger>
                        <x-ui.accordion-content>{{ $faq['a'] }}</x-ui.accordion-content>
                    </x-ui.accordion-item>
                @endforeach
            </x-ui.accordion>
        </div>
    </section>

    {{-- ───────────────────────────────────────────────────────
         § 9 · NEWSLETTER SIGNUP
    ─────────────────────────────────────────────────────────── --}}
    <section class="vl-grain relative overflow-hidden py-20 lg:py-28" style="background: linear-gradient(135deg, rgba(255,45,149,0.18) 0%, rgba(27,10,59,1) 40%, rgba(0,229,255,0.1) 100%);">
        <div class="relative z-10 mx-auto max-w-2xl px-6 text-center">
            <x-ui.badge class="vl-badge-grad mb-4 px-3 py-1">STAY CONNECTED</x-ui.badge>
            <h2 class="vl-display text-4xl font-black text-white sm:text-5xl">
                Never Miss a Drop
            </h2>
            <p class="mt-3 text-sm sm:text-base" style="color: var(--vl-muted);">
                Line-up updates, pre-sale codes, and last-minute ticket alerts — direct to your inbox.
            </p>

            <form
                class="mt-8 flex w-full max-w-md mx-auto flex-col gap-2 sm:flex-row"
                @submit.prevent="window.toast({ type: 'success', title: 'You\'re on the list!', description: 'We\'ll be in touch before tickets go on sale.' })"
            >
                <x-ui.input-group class="flex-1" style="background: rgba(255,255,255,0.07); border-color: rgba(255,243,230,0.2);">
                    <x-ui.input-group-input
                        type="email"
                        placeholder="your@email.com"
                        required
                        aria-label="Email address"
                        autocomplete="email"
                    />
                </x-ui.input-group>
                <button type="submit" class="vl-btn-primary inline-flex items-center justify-center gap-2 rounded-xl px-6 py-2.5 text-sm font-bold whitespace-nowrap">
                    <x-lucide-bell class="size-4" />
                    Notify Me
                </button>
            </form>
            <p class="mt-3 text-xs" style="color: var(--vl-muted);">No spam. Unsubscribe any time.</p>
        </div>
    </section>

    {{-- ───────────────────────────────────────────────────────
         § 10 · FOOTER WITH BOTTOM MARQUEE
    ─────────────────────────────────────────────────────────── --}}
    <footer class="vl-footer pt-14">
        <div class="mx-auto max-w-6xl px-6 pb-10">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
                <div class="lg:col-span-2">
                    <a href="#" class="vl-display flex items-center gap-2 text-2xl font-black text-white">
                        <span class="inline-flex size-9 items-center justify-center rounded-full" style="background: linear-gradient(135deg, #ff2d95, #ff8a00);" aria-hidden="true">
                            <x-lucide-music class="size-4 text-white" />
                        </span>
                        WAVELENGTH
                    </a>
                    <p class="mt-3 max-w-xs text-sm leading-relaxed" style="color: var(--vl-muted);">
                        Three days. Three stages. One festival that redefines what music outdoors can be.
                    </p>
                    <div class="mt-5 flex items-center gap-2">
                        @foreach (['instagram', 'twitter', 'youtube', 'music'] as $social)
                            <a href="#" aria-label="{{ ucfirst($social) }}" class="inline-flex size-9 items-center justify-center rounded-full border transition-colors hover:border-white/40" style="border-color: rgba(255,243,230,0.15); color: var(--vl-muted);">
                                <x-dynamic-component :component="'lucide-'.$social" class="size-4" />
                            </a>
                        @endforeach
                    </div>
                </div>

                @foreach (['Festival' => ['Line-Up', 'Schedule', 'Stages', 'Artists', 'Gallery'], 'Info' => ['Tickets', 'Getting There', 'Camping', 'Accessibility', 'FAQ']] as $heading => $links)
                    <div>
                        <h3 class="vl-display text-xs font-bold uppercase tracking-widest" style="color: var(--vl-cyan);">{{ $heading }}</h3>
                        <ul class="mt-4 space-y-2 text-sm">
                            @foreach ($links as $link)
                                <li><a href="#" class="transition-colors hover:text-white" style="color: var(--vl-muted);">{{ $link }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <x-ui.separator class="my-8" />

            <div class="text-xs flex flex-col sm:flex-row items-center justify-between gap-3" style="color: var(--vl-muted);">
                <span>© {{ date('Y') }} Wavelength Festival. All rights reserved.</span>
                <div class="flex items-center gap-4">
                    <a href="#" class="hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms</a>
                    <a href="#" class="hover:text-white transition-colors">Cookies</a>
                </div>
            </div>
        </div>

        {{-- Bottom marquee --}}
        <div class="vl-ticker overflow-hidden py-3" aria-hidden="true">
            <x-ui.marquee :duration="'40s'" direction="right" :pause-on-hover="false" gap="0.75rem">
                @foreach ($ticker as $item)
                    <span class="vl-display text-xs font-bold tracking-widest uppercase px-4 whitespace-nowrap">{{ $item }}</span>
                    <span class="opacity-50 px-1">●</span>
                @endforeach
            </x-ui.marquee>
        </div>
    </footer>

</div>
</x-layouts.app>
