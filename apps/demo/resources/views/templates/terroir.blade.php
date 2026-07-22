@php
    // ── Data ──────────────────────────────────────────────────────────────────
    $menu = [
        'starters' => [
            ['name' => 'Langoustine & Caviar',   'desc' => 'Breton langoustine, Oscietra caviar, cucumber water, dill oil',         'price' => '48'],
            ['name' => 'Foie Gras Torchon',       'desc' => 'Terrine, brioche toast, Sauternes gelée, pickled black fig',            'price' => '42'],
            ['name' => 'Beetroot Trilogy',         'desc' => 'Roasted, compressed and raw Chioggia, goat curd, walnut crumble',       'price' => '28'],
            ['name' => 'Scallop "En Coquille"',   'desc' => 'Hand-dived Orkney scallop, truffle beurre blanc, chervil, sea herb',   'price' => '38'],
        ],
        'mains' => [
            ['name' => 'Dry-Aged Côte de Bœuf',  'desc' => '45-day aged Galician beef, bone marrow jus, pomme soufflé, watercress', 'price' => '68'],
            ['name' => 'Brittany Sole Meunière',  'desc' => 'Whole Dover sole, brown butter, capers, lemon confit, samphire',        'price' => '62'],
            ['name' => 'Pigeon Rôti',             'desc' => 'Anjou pigeon, black garlic purée, celeriac fondant, sauce périgourdine','price' => '58'],
            ['name' => 'Garden Tasting (V)',      'desc' => 'Seven seasonal vegetables, fermented grains, smoked butter emulsion',   'price' => '52'],
        ],
        'desserts' => [
            ['name' => 'Soufflé au Chocolat',     'desc' => 'Valrhona Guanaja 70%, Tahitian vanilla ice cream, caramel crème',      'price' => '22'],
            ['name' => 'Tarte Tatin Revisitée',   'desc' => 'Pink Lady apple, almond frangipane, Calvados sabayon',                  'price' => '18'],
            ['name' => 'Île Flottante',           'desc' => 'Soft meringue, crème anglaise, praline feuilletine, fleur de sel',     'price' => '16'],
            ['name' => 'Selection de Fromages',   'desc' => 'French farmhouse cheeses, honeycomb, quince, pain de campagne',        'price' => '24'],
        ],
        'wine' => [
            ['name' => 'Montrachet Grand Cru 2018',  'desc' => 'Domaine de la Romanée-Conti, Burgundy — Chardonnay',                'price' => '420'],
            ['name' => 'Château Pétrus 2015',        'desc' => 'Pomerol, Bordeaux — Merlot, profound and velvety',                  'price' => '680'],
            ['name' => 'Côte-Rôtie "La Mouline" 2017','desc' => 'E. Guigal, Rhône Valley — Syrah, iconic single vineyard',        'price' => '185'],
            ['name' => 'Billecart-Salmon Blanc de Blancs NV','desc' => 'Champagne — Chardonnay, minerality and elegance',           'price' => '95'],
        ],
    ];

    $gallery = [
        ['src' => 'https://picsum.photos/seed/plating1/900/600',  'thumb' => 'https://picsum.photos/seed/plating1/600/400',  'alt' => 'Duck confit with cherry reduction'],
        ['src' => 'https://picsum.photos/seed/dish-duck/900/600', 'thumb' => 'https://picsum.photos/seed/dish-duck/600/400', 'alt' => 'Pressed duck with foie gras sauce'],
        ['src' => 'https://picsum.photos/seed/vineyard/900/600',  'thumb' => 'https://picsum.photos/seed/vineyard/600/400',  'alt' => 'Estate vineyard at golden hour'],
        ['src' => 'https://picsum.photos/seed/lobster/900/600',   'thumb' => 'https://picsum.photos/seed/lobster/600/400',   'alt' => 'Poached lobster with bisque'],
        ['src' => 'https://picsum.photos/seed/dessert1/900/600',  'thumb' => 'https://picsum.photos/seed/dessert1/600/400',  'alt' => 'Chocolate soufflé fresh from the oven'],
        ['src' => 'https://picsum.photos/seed/cellar1/900/600',   'thumb' => 'https://picsum.photos/seed/cellar1/600/400',   'alt' => 'The Maison wine cellar'],
    ];

    $faq = [
        ['q' => 'What is the dress code?',             'a' => 'We ask guests to dress elegantly — smart casual is welcome; formal attire is encouraged for the Grand Tasting menu. Sports shoes and very casual dress are kindly asked to be reserved for other occasions.'],
        ['q' => 'Is parking available?',               'a' => 'Valet parking is complimentary for all dinner reservations. Self-parking is also available in the private courtyard, accessible from Rue du Terroir.'],
        ['q' => 'Can you accommodate dietary needs?',  'a' => 'Our kitchen crafts bespoke menus for all allergies and dietary preferences — vegetarian, vegan, gluten-free, and beyond. Please inform us at the time of booking so Chef Leblanc can prepare accordingly.'],
        ['q' => 'What is your cancellation policy?',   'a' => 'We hold reservations for 15 minutes. For cancellations, 48 hours\' notice is required for tables of up to 6; 72 hours for larger parties and private dining events. Our concierge is always happy to reschedule.'],
        ['q' => 'Do you offer private dining?',        'a' => 'The Bibliothèque private dining room accommodates 8–18 guests with a dedicated sommelier, bespoke menu and full AV facilities. Please contact our events team for availability.'],
    ];

    $partySizes = ['1' => '1 guest', '2' => '2 guests', '3' => '3 guests', '4' => '4 guests', '5' => '5 guests', '6' => '6 guests', '7' => '7–8 guests', '8' => 'Larger party'];
@endphp

<x-layouts.app title="Maison Terroir — Fine Dining">

{{-- ══ SCOPED STYLES ══════════════════════════════════════════════════════════ --}}
<style>
@import url('https://fonts.bunny.net/css?family=fraunces:400,500,600,700|lora:400,400i,500,600|inter:400,500,600');

/* ── Reset site theme, enforce warm palette ── */
#tpl-terroir {
    --tr-cream:     #f7f1e6;
    --tr-cream-lt:  #faf6ee;
    --tr-ink:       #211b16;
    --tr-ink-lt:    #3d332a;
    --tr-bordeaux:  #7b2233;
    --tr-gold:      #b8893b;
    --tr-olive:     #5c6b3f;
    --tr-muted:     #8a7b6e;
    --tr-divider:   rgba(184,137,59,.25);

    background-color: var(--tr-cream);
    color: var(--tr-ink);
    font-family: 'Lora', Georgia, serif;
    font-size: 1rem;
    line-height: 1.7;
}

/* ── Typography ── */
#tpl-terroir .tr-display {
    font-family: 'Fraunces', 'Times New Roman', serif;
    font-weight: 700;
    line-height: 1.1;
    letter-spacing: -0.02em;
}
#tpl-terroir .tr-display-md {
    font-family: 'Fraunces', 'Times New Roman', serif;
    font-weight: 600;
    line-height: 1.2;
    letter-spacing: -0.015em;
}
#tpl-terroir .tr-eyebrow {
    font-family: 'Inter', sans-serif;
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 0.2em;
    text-transform: uppercase;
    color: var(--tr-gold);
}
#tpl-terroir .tr-label {
    font-family: 'Inter', sans-serif;
    font-size: 0.7rem;
    font-weight: 500;
    letter-spacing: 0.18em;
    text-transform: uppercase;
}
#tpl-terroir .tr-price {
    font-family: 'Inter', sans-serif;
    font-variant-numeric: tabular-nums;
    font-weight: 600;
    color: var(--tr-ink-lt);
}

/* ── Editorial drop cap ── */
#tpl-terroir .tr-dropcap::first-letter {
    font-family: 'Fraunces', serif;
    font-size: 4.2em;
    font-weight: 700;
    line-height: 0.82;
    float: left;
    margin-right: 0.1em;
    margin-top: 0.06em;
    color: var(--tr-bordeaux);
}

/* ── Pull quote ── */
#tpl-terroir .tr-pullquote {
    text-align: center;
    padding: 2.5rem 2rem;
    position: relative;
    font-family: 'Fraunces', serif;
    font-style: italic;
    font-size: 1.35rem;
    line-height: 1.5;
    color: var(--tr-ink-lt);
}
#tpl-terroir .tr-pullquote::before,
#tpl-terroir .tr-pullquote::after {
    content: '';
    display: block;
    height: 1px;
    background: var(--tr-gold);
    width: 60px;
    margin: 0 auto 1.5rem;
}
#tpl-terroir .tr-pullquote::after {
    margin: 1.5rem auto 0;
}

/* ── Hairline divider ── */
#tpl-terroir .tr-hairline {
    border: none;
    border-top: 1px solid var(--tr-divider);
}

/* ── Image hover zoom ── */
#tpl-terroir .tr-zoom-wrap {
    overflow: hidden;
}
#tpl-terroir .tr-zoom-wrap img {
    transition: transform 0.8s cubic-bezier(0.25,0.46,0.45,0.94);
}
@media (prefers-reduced-motion: reduce) {
    #tpl-terroir .tr-zoom-wrap img { transition: none; }
}
#tpl-terroir .tr-zoom-wrap:hover img,
#tpl-terroir .tr-zoom-wrap:focus-within img {
    transform: scale(1.04);
}

/* ── Nav ── */
#tpl-terroir .tr-nav {
    background-color: rgba(247,241,230,0.92);
    backdrop-filter: blur(16px);
    border-bottom: 1px solid var(--tr-divider);
}
#tpl-terroir .tr-nav a {
    color: var(--tr-ink-lt);
    font-family: 'Inter', sans-serif;
    font-size: 0.8rem;
    font-weight: 500;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    text-decoration: none;
    padding: 0.35rem 0.9rem;
    border-radius: 4px;
    transition: color 0.2s, background-color 0.2s;
}
#tpl-terroir .tr-nav a:hover {
    color: var(--tr-bordeaux);
    background-color: rgba(123,34,51,0.07);
}

/* ── Buttons ── */
#tpl-terroir .tr-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background-color: var(--tr-bordeaux);
    color: #faf6ee;
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    padding: 0.75rem 2rem;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.25s, box-shadow 0.25s;
}
#tpl-terroir .tr-btn-primary:hover {
    background-color: #5f1a28;
    box-shadow: 0 4px 20px rgba(123,34,51,0.3);
}
#tpl-terroir .tr-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background-color: transparent;
    color: var(--tr-bordeaux);
    font-family: 'Inter', sans-serif;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    padding: 0.72rem 1.9rem;
    border: 1.5px solid var(--tr-bordeaux);
    border-radius: 4px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.25s, color 0.25s;
}
#tpl-terroir .tr-btn-outline:hover {
    background-color: var(--tr-bordeaux);
    color: #faf6ee;
}

/* ── Menu row ── */
#tpl-terroir .tr-menu-row {
    display: flex;
    align-items: baseline;
    gap: 1rem;
    padding: 1.25rem 0;
    border-bottom: 1px solid var(--tr-divider);
}
#tpl-terroir .tr-menu-row:last-child { border-bottom: none; }
#tpl-terroir .tr-menu-dots {
    flex: 1;
    border-bottom: 1px dotted var(--tr-divider);
    min-width: 1.5rem;
    margin-bottom: 0.25rem;
}

/* ── Custom badge ── */
#tpl-terroir .tr-badge-award {
    display: inline-flex;
    align-items: center;
    gap: 0.3rem;
    background-color: rgba(184,137,59,0.12);
    color: var(--tr-gold);
    border: 1px solid rgba(184,137,59,0.3);
    font-family: 'Inter', sans-serif;
    font-size: 0.62rem;
    font-weight: 600;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    padding: 0.2rem 0.7rem;
    border-radius: 100px;
}

/* ── Chef signature ── */
#tpl-terroir .tr-signature {
    font-family: 'Fraunces', serif;
    font-style: italic;
    font-size: 1.5rem;
    color: var(--tr-bordeaux);
    opacity: 0.85;
}

/* ── Form overrides ── */
#tpl-terroir input, #tpl-terroir select,
#tpl-terroir [data-slot="input"], [data-slot="select"],
#tpl-terroir [data-slot="date-picker"] button,
#tpl-terroir [data-slot="time-field"] input {
    background-color: var(--tr-cream-lt) !important;
    border-color: var(--tr-divider) !important;
    color: var(--tr-ink) !important;
}
#tpl-terroir [data-slot="field-label"] {
    color: var(--tr-ink-lt);
    font-family: 'Inter', sans-serif;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
}

/* ── Accordion overrides ── */
#tpl-terroir [data-slot="accordion-item"] {
    border-bottom-color: var(--tr-divider) !important;
}
#tpl-terroir [data-slot="accordion-trigger"] {
    font-family: 'Lora', serif;
    color: var(--tr-ink);
    font-size: 0.95rem;
}
#tpl-terroir [data-slot="accordion-content"] {
    color: var(--tr-muted);
    font-size: 0.9rem;
    line-height: 1.75;
}

/* ── Footer ── */
#tpl-terroir .tr-footer {
    background-color: var(--tr-ink);
    color: rgba(247,241,230,0.65);
}
#tpl-terroir .tr-footer a {
    color: rgba(247,241,230,0.55);
    text-decoration: none;
    transition: color 0.2s;
}
#tpl-terroir .tr-footer a:hover { color: var(--tr-cream); }

/* ── Tabs overrides to match warm palette ── */
#tpl-terroir [data-slot="tabs-list"] {
    background-color: rgba(123,34,51,0.08) !important;
}
#tpl-terroir [data-slot="tabs-trigger"][data-state="active"] {
    background-color: var(--tr-bordeaux) !important;
    color: #faf6ee !important;
}
#tpl-terroir [data-slot="tabs-trigger"] {
    font-family: 'Inter', sans-serif;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.1em;
    text-transform: uppercase;
    color: var(--tr-muted) !important;
}
</style>

<div id="tpl-terroir">

{{-- ══ 1. STICKY NAV ════════════════════════════════════════════════════════════ --}}
<header class="tr-nav sticky top-0 z-40">
    <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-6">
        {{-- Mobile menu --}}
        <x-ui.sheet>
            <x-ui.sheet-trigger class="md:hidden">
                <button type="button" aria-label="Open menu" style="background:transparent;border:none;cursor:pointer;color:var(--tr-ink-lt)">
                    <x-lucide-menu class="size-5" />
                </button>
            </x-ui.sheet-trigger>
            <x-ui.sheet-content side="left" style="background:var(--tr-cream);border-color:var(--tr-divider)">
                <x-ui.sheet-header>
                    <x-ui.sheet-title style="font-family:'Fraunces',serif;color:var(--tr-bordeaux)">Maison Terroir</x-ui.sheet-title>
                </x-ui.sheet-header>
                <nav class="grid gap-1 px-4 text-sm">
                    @foreach (['Philosophy' => '#philosophy', 'Menu' => '#menu', 'Chef' => '#chef', 'Gallery' => '#gallery', 'Reserve' => '#reservation'] as $label => $href)
                        <a href="{{ $href }}" @click="open = false" class="rounded-md px-3 py-2 font-medium" style="color:var(--tr-ink-lt);font-family:'Inter',sans-serif;">{{ $label }}</a>
                    @endforeach
                </nav>
                <x-ui.sheet-footer>
                    <a href="#reservation" class="tr-btn-primary w-full justify-center">Reserve a Table</a>
                </x-ui.sheet-footer>
            </x-ui.sheet-content>
        </x-ui.sheet>

        {{-- Wordmark (centered) --}}
        <div class="flex flex-1 justify-center md:justify-start">
            <a href="#" class="tr-display" style="font-size:1.4rem;color:var(--tr-ink);text-decoration:none;letter-spacing:-0.01em">
                Maison Terroir
            </a>
        </div>

        {{-- Desktop nav --}}
        <nav class="hidden items-center gap-0.5 md:flex">
            @foreach (['Philosophy' => '#philosophy', 'Menu' => '#menu', 'Chef' => '#chef', 'Gallery' => '#gallery'] as $label => $href)
                <a href="{{ $href }}" class="tr-nav">{{ $label }}</a>
            @endforeach
        </nav>

        <div class="hidden items-center gap-3 md:flex">
            <x-ui.separator orientation="vertical" class="h-5 mx-2" style="background-color:var(--tr-divider)" />
            <x-ui.tooltip :delay="200">
                <x-ui.tooltip-trigger>
                    <a href="tel:+33140123456" aria-label="Call us" style="color:var(--tr-muted);display:inline-flex;align-items:center">
                        <x-lucide-phone class="size-4" />
                    </a>
                </x-ui.tooltip-trigger>
                <x-ui.tooltip-content side="bottom" style="background:var(--tr-ink);color:var(--tr-cream)">
                    +33 1 40 12 34 56
                </x-ui.tooltip-content>
            </x-ui.tooltip>
            <a href="#reservation" class="tr-btn-primary" style="padding:0.5rem 1.4rem">Reserve</a>
        </div>
    </div>
</header>

{{-- ══ 2. HERO ══════════════════════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden" style="min-height:92vh;display:flex;align-items:flex-end">
    {{-- Full-bleed image --}}
    <div class="absolute inset-0 tr-zoom-wrap">
        <img
            src="https://picsum.photos/seed/terroir-hero/1600/1000"
            alt="Maison Terroir dining room — candlelit tables and stone archways"
            class="size-full object-cover"
            style="filter:brightness(0.55) saturate(0.85)"
        />
    </div>
    {{-- Gradient overlay --}}
    <div class="absolute inset-0" style="background:linear-gradient(to top, rgba(33,27,22,0.92) 0%, rgba(33,27,22,0.45) 45%, transparent 100%)"></div>

    {{-- Hero content --}}
    <div class="relative z-10 mx-auto w-full max-w-5xl px-6 pb-20 pt-40 text-center">
        <div class="tr-eyebrow mb-5" style="color:var(--tr-gold);letter-spacing:.25em">Since 1998 &ensp;·&ensp; Paris, France</div>

        <h1 class="tr-display" style="font-size:clamp(3rem,7vw,5.5rem);color:#faf6ee;line-height:1.05;margin-bottom:1.5rem">
            Where the Land<br>
            <em style="font-style:italic;color:rgba(247,241,230,.82)">Arrives at the Table</em>
        </h1>

        <p style="font-family:'Lora',serif;font-size:1.1rem;color:rgba(247,241,230,.7);max-width:36rem;margin:0 auto 2.5rem;line-height:1.75">
            A sanctuary of French gastronomy — two Michelin stars, one passionate kitchen.
        </p>

        {{-- Badges --}}
        <div class="flex flex-wrap items-center justify-center gap-3 mb-8">
            <x-ui.badge
                style="background:rgba(184,137,59,0.15);color:#e8c677;border-color:rgba(184,137,59,0.4);font-family:'Inter',sans-serif;font-size:.62rem;letter-spacing:.16em;text-transform:uppercase"
            >
                <x-lucide-star class="size-3 fill-current" />
                Michelin ★★
            </x-ui.badge>
            <x-ui.badge
                style="background:rgba(247,241,230,0.1);color:rgba(247,241,230,.75);border-color:rgba(247,241,230,.2);font-family:'Inter',sans-serif;font-size:.62rem;letter-spacing:.16em;text-transform:uppercase"
            >
                <x-lucide-award class="size-3" />
                Gault &amp; Millau 19/20
            </x-ui.badge>
            <x-ui.badge
                style="background:rgba(92,107,63,0.2);color:#a8bf7d;border-color:rgba(92,107,63,0.4);font-family:'Inter',sans-serif;font-size:.62rem;letter-spacing:.16em;text-transform:uppercase"
            >
                <x-lucide-leaf class="size-3" />
                Green Star
            </x-ui.badge>
        </div>

        <div class="flex flex-wrap justify-center gap-4">
            <a href="#reservation" class="tr-btn-primary">
                <x-lucide-calendar class="size-4" />
                Reserve a Table
            </a>
            <a href="#menu" class="tr-btn-outline" style="border-color:rgba(247,241,230,.5);color:rgba(247,241,230,.85)">
                View the Menu
            </a>
        </div>
    </div>
</section>

{{-- ══ 3. PHILOSOPHY / INTRO (editorial + drop cap + pull quote) ════════════════ --}}
<section id="philosophy" class="scroll-mt-20" style="background-color:var(--tr-cream)">
    <div class="mx-auto max-w-6xl px-6 py-20 lg:py-28">
        <div class="grid items-center gap-16 lg:grid-cols-2">

            {{-- Text column --}}
            <div>
                <div class="tr-eyebrow mb-6">Our Philosophy</div>
                <h2 class="tr-display-md mb-8" style="font-size:clamp(2rem,4vw,3rem);color:var(--tr-ink)">
                    Honest cooking from<br>exceptional ingredients
                </h2>
                <p class="tr-dropcap" style="color:var(--tr-ink-lt);margin-bottom:1.5rem">
                    Terroir is the soul of French cuisine — the living bond between soil, climate and the hands that tend the land. At Maison Terroir, Chef Leblanc forges direct relationships with seventeen artisan producers, from Brittany fishermen who call at dawn with the morning's catch, to alpine cheesemakers who age wheels on beds of mountain hay.
                </p>
                <p style="color:var(--tr-muted)">
                    Each dish is a conversation between season and technique — classical foundations reframed with quiet restraint. No flourish for its own sake. Only clarity, depth, and the pure pleasure of eating something that could only exist here, now, and nowhere else.
                </p>

                <div style="margin-top:2.5rem;display:flex;align-items:center;gap:1.5rem">
                    <div class="tr-zoom-wrap" style="width:64px;height:64px;border-radius:50%;flex-shrink:0">
                        <img src="https://picsum.photos/seed/chef-portrait-sm/128/128" alt="Chef Julien Leblanc" style="width:64px;height:64px;border-radius:50%;object-fit:cover" />
                    </div>
                    <div>
                        <div style="font-family:'Fraunces',serif;font-size:1rem;color:var(--tr-ink);font-weight:600">Julien Leblanc</div>
                        <div class="tr-label" style="color:var(--tr-muted);margin-top:2px">Executive Chef &amp; Owner</div>
                    </div>
                </div>
            </div>

            {{-- Asymmetric image --}}
            <div class="relative">
                <div class="tr-zoom-wrap rounded-sm" style="aspect-ratio:3/4;overflow:hidden;border-radius:2px">
                    <img
                        src="https://picsum.photos/seed/dish-plate/700/900"
                        alt="An artistically plated dish at Maison Terroir"
                        class="size-full object-cover"
                    />
                </div>
                {{-- Offset inset image --}}
                <div class="tr-zoom-wrap absolute" style="bottom:-2rem;left:-2rem;width:48%;aspect-ratio:1;overflow:hidden;border:6px solid var(--tr-cream);border-radius:2px;box-shadow:0 8px 32px rgba(33,27,22,.2)">
                    <img
                        src="https://picsum.photos/seed/produce-market/600/600"
                        alt="Fresh produce from our partner farms"
                        class="size-full object-cover"
                    />
                </div>
            </div>
        </div>

        {{-- Pull quote --}}
        <div class="tr-pullquote mx-auto mt-16 max-w-2xl">
            "Great cooking has no secrets — only great ingredients, patience, and the courage to do less."
            <div class="tr-label mt-4" style="color:var(--tr-muted)">— Julien Leblanc, 2019 Identité Gourmande</div>
        </div>
    </div>
</section>

<hr class="tr-hairline" />

{{-- ══ 4. THE MENU (Tabs) ═══════════════════════════════════════════════════════ --}}
<section id="menu" class="scroll-mt-20" style="background-color:var(--tr-cream-lt)">
    <div class="mx-auto max-w-5xl px-6 py-20 lg:py-28">
        <div class="text-center mb-12">
            <div class="tr-eyebrow mb-4">À la Carte</div>
            <h2 class="tr-display-md" style="font-size:clamp(2rem,4vw,2.8rem);color:var(--tr-ink)">The Menu</h2>
            <p style="color:var(--tr-muted);margin-top:.75rem;font-size:.95rem">
                All prices in euros, inclusive of VAT. Menu changes with the seasons.
            </p>
        </div>

        <x-ui.tabs value="starters" class="w-full">
            <div class="flex justify-center mb-10">
                <x-ui.tabs-list class="grid grid-cols-4 w-full max-w-xl">
                    <x-ui.tabs-trigger value="starters">Starters</x-ui.tabs-trigger>
                    <x-ui.tabs-trigger value="mains">Mains</x-ui.tabs-trigger>
                    <x-ui.tabs-trigger value="desserts">Desserts</x-ui.tabs-trigger>
                    <x-ui.tabs-trigger value="wine">Wine</x-ui.tabs-trigger>
                </x-ui.tabs-list>
            </div>

            @foreach ($menu as $key => $courses)
                <x-ui.tabs-content value="{{ $key }}">
                    <div style="border-top:1px solid var(--tr-divider)">
                        @foreach ($courses as $course)
                            <div class="tr-menu-row">
                                <div style="flex:1;min-width:0">
                                    <div style="font-family:'Fraunces',serif;font-weight:600;font-size:1.05rem;color:var(--tr-ink);margin-bottom:.25rem">
                                        {{ $course['name'] }}
                                    </div>
                                    <div style="font-family:'Lora',serif;font-style:italic;font-size:.85rem;color:var(--tr-muted)">
                                        {{ $course['desc'] }}
                                    </div>
                                </div>
                                <div class="tr-menu-dots" aria-hidden="true"></div>
                                <div class="tr-price" style="white-space:nowrap">
                                    €&thinsp;{{ $course['price'] }}
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Bottom note --}}
                    <p style="font-family:'Inter',sans-serif;font-size:.72rem;color:var(--tr-muted);text-align:center;margin-top:2rem;letter-spacing:.04em">
                        Please inform your server of any allergies or dietary requirements before ordering.
                    </p>
                </x-ui.tabs-content>
            @endforeach
        </x-ui.tabs>
    </div>
</section>

<hr class="tr-hairline" />

{{-- ══ 5. CHEF'S STORY (asymmetric editorial split) ═════════════════════════════ --}}
<section id="chef" class="scroll-mt-20" style="background-color:var(--tr-cream)">
    <div class="mx-auto max-w-6xl px-6 py-20 lg:py-28">
        <div class="grid items-center gap-16 lg:grid-cols-2">

            {{-- Portrait --}}
            <div class="relative order-2 lg:order-1">
                <div class="tr-zoom-wrap" style="border-radius:2px;overflow:hidden;aspect-ratio:4/5">
                    <img
                        src="https://picsum.photos/seed/chef-portrait/700/875"
                        alt="Chef Julien Leblanc in the kitchen"
                        class="size-full object-cover"
                    />
                </div>
                {{-- Award badge floating --}}
                <div class="absolute" style="top:2rem;right:-1.5rem;padding:1.25rem 1.5rem;background:var(--tr-ink);border-radius:2px;box-shadow:0 8px 32px rgba(33,27,22,.35);text-align:center">
                    <div style="font-family:'Fraunces',serif;font-size:2rem;font-weight:700;color:var(--tr-gold);line-height:1">★★</div>
                    <div class="tr-label" style="color:rgba(247,241,230,.6);margin-top:.3rem">Michelin</div>
                </div>
            </div>

            {{-- Text --}}
            <div class="order-1 lg:order-2">
                <div class="tr-eyebrow mb-6">The Chef</div>
                <h2 class="tr-display-md mb-6" style="font-size:clamp(2rem,4vw,2.8rem);color:var(--tr-ink)">
                    Julien Leblanc
                </h2>
                <p style="color:var(--tr-ink-lt);margin-bottom:1.25rem">
                    Born in Lyon to a family of bakers, Julien discovered his calling at fifteen when he staged at a village bistro in the Luberon. After training under Paul Bocuse and a formative decade in Tokyo, he returned to Paris with a singular vision: to marry the rigour of classical French technique with the reverence for nature he found in Japanese cuisine.
                </p>
                <p style="color:var(--tr-muted);margin-bottom:2rem">
                    He opened Maison Terroir in 1998 in a converted 17th-century townhouse near the Palais-Royal. The first Michelin star arrived in 2003; the second in 2011. He has never sought a third, preferring intimacy over accolade.
                </p>

                <div style="display:flex;flex-wrap:wrap;gap:.75rem;margin-bottom:2rem">
                    <span class="tr-badge-award"><x-lucide-star class="size-3" />Michelin ★★</span>
                    <span class="tr-badge-award"><x-lucide-award class="size-3" />Gault &amp; Millau 19/20</span>
                    <span class="tr-badge-award"><x-lucide-leaf class="size-3" />Green Star</span>
                    <span class="tr-badge-award"><x-lucide-book-open class="size-3" />3 Cookbooks</span>
                </div>

                <div class="tr-signature">Julien Leblanc</div>
                <div class="tr-label" style="color:var(--tr-muted);margin-top:.4rem">Executive Chef &amp; Owner, Maison Terroir</div>
            </div>
        </div>
    </div>
</section>

<hr class="tr-hairline" />

{{-- ══ 6. GALLERY ═══════════════════════════════════════════════════════════════ --}}
<section id="gallery" class="scroll-mt-20" style="background-color:var(--tr-cream-lt)">
    <div class="mx-auto max-w-6xl px-6 py-20 lg:py-24">
        <div class="text-center mb-12">
            <div class="tr-eyebrow mb-4">In the Kitchen &amp; Beyond</div>
            <h2 class="tr-display-md" style="font-size:clamp(1.8rem,3.5vw,2.6rem);color:var(--tr-ink)">A Feast for the Eyes</h2>
        </div>
        <x-ui.gallery
            :images="$gallery"
            :columns="3"
            rounded="rounded-sm"
        />
    </div>
</section>

<hr class="tr-hairline" />

{{-- ══ 7. PRESS & AWARDS ════════════════════════════════════════════════════════ --}}
<section style="background-color:var(--tr-cream);overflow:hidden">
    <div class="mx-auto max-w-5xl px-6 py-16">
        <div class="tr-eyebrow mb-10 text-center">As Seen In</div>
        <div class="grid grid-cols-2 gap-0 sm:grid-cols-3 lg:grid-cols-6" style="border-top:1px solid var(--tr-divider)">
            @foreach (['Le Monde', 'Le Figaro', 'Vogue Paris', 'The Guardian', 'Financial Times', 'Condé Nast'] as $pub)
                <div style="padding:1.75rem 1rem;text-align:center;border-right:1px solid var(--tr-divider);border-bottom:1px solid var(--tr-divider)">
                    <span style="font-family:'Fraunces',serif;font-weight:600;font-size:.9rem;color:var(--tr-muted);letter-spacing:-.01em">{{ $pub }}</span>
                </div>
            @endforeach
        </div>

        {{-- Critic quotes carousel / pull-quote row --}}
        <div class="mt-16 grid gap-8 sm:grid-cols-3">
            @foreach ([
                ['quote' => '"A masterclass in restraint. Every dish whispers, never shouts."', 'source' => 'The Guardian, 2023'],
                ['quote' => '"Leblanc is the rare chef who improves with each passing year."', 'source' => 'Gault &amp; Millau Guide'],
                ['quote' => '"Paris has many temples; Terroir remains its most human."', 'source' => 'Financial Times Weekend'],
            ] as $review)
                <div style="text-align:center;padding:1.5rem 1rem">
                    <div style="font-family:'Fraunces',serif;font-style:italic;font-size:1rem;color:var(--tr-ink-lt);line-height:1.6;margin-bottom:.75rem">
                        {!! $review['quote'] !!}
                    </div>
                    <div class="tr-label" style="color:var(--tr-gold)">{!! $review['source'] !!}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<hr class="tr-hairline" />

{{-- ══ 8. RESERVATION FORM ═════════════════════════════════════════════════════ --}}
<section id="reservation" class="scroll-mt-20" style="background-color:var(--tr-cream-lt)">
    <div class="mx-auto max-w-3xl px-6 py-20 lg:py-28">
        <div class="text-center mb-12">
            <div class="tr-eyebrow mb-4">Reservations</div>
            <h2 class="tr-display-md" style="font-size:clamp(2rem,4vw,2.8rem);color:var(--tr-ink)">
                Reserve Your Table
            </h2>
            <p style="color:var(--tr-muted);margin-top:.75rem;font-size:.95rem">
                We welcome reservations up to three months in advance.<br>
                <em style="font-style:italic">For parties of 7 or more, please contact us directly.</em>
            </p>
        </div>

        <form
            x-data="{ submitting: false, done: false }"
            @submit.prevent="submitting = true; setTimeout(() => { submitting = false; done = true; }, 1400)"
            style="background:var(--tr-cream);border:1px solid var(--tr-divider);border-radius:4px;padding:2.5rem;box-shadow:0 4px 24px rgba(33,27,22,.07)"
            aria-label="Table reservation form"
        >
            <div x-show="done" x-cloak style="text-align:center;padding:2rem 0">
                <x-lucide-check-circle class="size-10 mx-auto mb-4" style="color:var(--tr-olive)" />
                <div class="tr-display-md" style="font-size:1.5rem;color:var(--tr-ink);margin-bottom:.5rem">Your table is reserved.</div>
                <p style="color:var(--tr-muted);font-size:.9rem">A confirmation will arrive in your inbox shortly. We look forward to welcoming you.</p>
            </div>

            <div x-show="!done">
                {{-- Row 1: Date + Time --}}
                <div class="grid gap-6 sm:grid-cols-2 mb-6">
                    <x-ui.field>
                        <x-ui.field-label for="res-date">Date</x-ui.field-label>
                        <x-ui.field-content>
                            <x-ui.date-picker
                                name="reservation_date"
                                :min="date('Y-m-d')"
                                placeholder="Choose a date"
                                class="w-full"
                            />
                        </x-ui.field-content>
                    </x-ui.field>

                    <x-ui.field>
                        <x-ui.field-label for="res-time">Time</x-ui.field-label>
                        <x-ui.field-content>
                            <x-ui.time-field
                                name="reservation_time"
                                variant="select"
                                hour-cycle="24"
                                :minute-step="30"
                                class="w-full"
                            />
                        </x-ui.field-content>
                    </x-ui.field>
                </div>

                {{-- Row 2: Party size + Name --}}
                <div class="grid gap-6 sm:grid-cols-2 mb-6">
                    <x-ui.field>
                        <x-ui.field-label>Number of Guests</x-ui.field-label>
                        <x-ui.field-content>
                            <x-ui.select
                                name="party_size"
                                :options="$partySizes"
                                placeholder="Select…"
                                class="w-full"
                            />
                        </x-ui.field-content>
                    </x-ui.field>

                    <x-ui.field>
                        <x-ui.field-label for="res-name">Full Name</x-ui.field-label>
                        <x-ui.field-content>
                            <x-ui.input
                                id="res-name"
                                name="guest_name"
                                type="text"
                                placeholder="e.g. Marie Dupont"
                                autocomplete="name"
                                required
                            />
                        </x-ui.field-content>
                    </x-ui.field>
                </div>

                {{-- Row 3: Phone --}}
                <div class="mb-6">
                    <x-ui.field>
                        <x-ui.field-label for="res-phone">Phone Number</x-ui.field-label>
                        <x-ui.field-content>
                            <x-ui.phone-input
                                id="res-phone"
                                name="phone"
                                country="FR"
                                placeholder="06 12 34 56 78"
                                class="max-w-none w-full"
                            />
                        </x-ui.field-content>
                    </x-ui.field>
                </div>

                {{-- Row 4: Special requests --}}
                <div class="mb-8">
                    <x-ui.field>
                        <x-ui.field-label for="res-notes">Special Requests</x-ui.field-label>
                        <x-ui.field-content>
                            <textarea
                                id="res-notes"
                                name="notes"
                                rows="3"
                                placeholder="Dietary requirements, occasion, seating preferences…"
                                style="width:100%;background:var(--tr-cream-lt);border:1px solid var(--tr-divider);border-radius:6px;padding:.625rem .75rem;font-family:'Lora',serif;font-size:.9rem;color:var(--tr-ink);resize:vertical;outline:none;transition:border-color .2s,box-shadow .2s;line-height:1.6"
                                onfocus="this.style.borderColor='var(--tr-bordeaux)';this.style.boxShadow='0 0 0 3px rgba(123,34,51,.12)'"
                                onblur="this.style.borderColor='var(--tr-divider)';this.style.boxShadow='none'"
                            ></textarea>
                        </x-ui.field-content>
                    </x-ui.field>
                </div>

                <div class="flex items-center justify-between gap-4 flex-wrap">
                    <p style="font-family:'Inter',sans-serif;font-size:.72rem;color:var(--tr-muted);line-height:1.5;max-width:28rem">
                        By reserving you agree to our cancellation policy. A credit card is held but not charged unless you miss your reservation without notice.
                    </p>
                    <button
                        type="submit"
                        class="tr-btn-primary"
                        :disabled="submitting"
                        :style="submitting ? 'opacity:.7;pointer-events:none' : ''"
                    >
                        <x-lucide-loader class="size-4" x-show="submitting" style="animation:spin 1s linear infinite" />
                        <x-lucide-calendar-check class="size-4" x-show="!submitting" />
                        <span x-text="submitting ? 'Confirming…' : 'Confirm Reservation'"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<style>@keyframes spin { to { transform: rotate(360deg); } }</style>

<hr class="tr-hairline" />

{{-- ══ 9. HOURS & LOCATION + FAQ ════════════════════════════════════════════════ --}}
<section style="background-color:var(--tr-cream)">
    <div class="mx-auto max-w-6xl px-6 py-20 lg:py-24">
        <div class="grid gap-16 lg:grid-cols-2">

            {{-- Hours & Address --}}
            <div>
                <div class="tr-eyebrow mb-8">Find Us</div>

                <div class="grid sm:grid-cols-2 gap-8 mb-10">
                    <div>
                        <div class="tr-label mb-3" style="color:var(--tr-bordeaux)">Lunch Service</div>
                        <div style="color:var(--tr-ink-lt);font-size:.95rem">
                            Tuesday – Saturday<br>
                            12:30 pm — 2:30 pm
                        </div>
                    </div>
                    <div>
                        <div class="tr-label mb-3" style="color:var(--tr-bordeaux)">Dinner Service</div>
                        <div style="color:var(--tr-ink-lt);font-size:.95rem">
                            Tuesday – Saturday<br>
                            7:00 pm — 10:00 pm
                        </div>
                    </div>
                </div>

                <hr class="tr-hairline mb-8" />

                <div class="flex gap-4">
                    <x-lucide-map-pin class="size-5 shrink-0 mt-1" style="color:var(--tr-bordeaux)" aria-hidden="true" />
                    <div>
                        <div style="font-family:'Fraunces',serif;font-weight:600;font-size:1rem;color:var(--tr-ink);margin-bottom:.4rem">Maison Terroir</div>
                        <address style="font-style:normal;color:var(--tr-muted);font-size:.9rem;line-height:1.7">
                            12 Rue du Terroir<br>
                            75001 Paris, France<br>
                            <a href="tel:+33140123456" style="color:var(--tr-bordeaux)">+33 1 40 12 34 56</a>
                        </address>
                    </div>
                </div>

                <div class="flex gap-4 mt-6">
                    <x-lucide-train class="size-5 shrink-0 mt-0.5" style="color:var(--tr-olive)" aria-hidden="true" />
                    <div style="color:var(--tr-muted);font-size:.9rem">
                        Palais-Royal – Musée du Louvre (lines 1 &amp; 7)<br>
                        <span style="font-size:.82rem">3-minute walk from the arcade exit</span>
                    </div>
                </div>

                <div class="flex gap-3 mt-8">
                    @foreach (['instagram', 'facebook'] as $soc)
                        <x-ui.tooltip>
                            <x-ui.tooltip-trigger>
                                <a href="#" aria-label="{{ ucfirst($soc) }}" style="display:inline-flex;align-items:center;justify-content:center;width:36px;height:36px;border-radius:50%;border:1px solid var(--tr-divider);color:var(--tr-muted);transition:color .2s,border-color .2s" onmouseover="this.style.color='var(--tr-bordeaux)';this.style.borderColor='var(--tr-bordeaux)'" onmouseout="this.style.color='var(--tr-muted)';this.style.borderColor='var(--tr-divider)'">
                                    <x-dynamic-component :component="'lucide-'.$soc" class="size-4" />
                                </a>
                            </x-ui.tooltip-trigger>
                            <x-ui.tooltip-content side="top" style="background:var(--tr-ink);color:var(--tr-cream)">
                                Follow on {{ ucfirst($soc) }}
                            </x-ui.tooltip-content>
                        </x-ui.tooltip>
                    @endforeach
                </div>
            </div>

            {{-- FAQ --}}
            <div>
                <div class="tr-eyebrow mb-8">Frequently Asked</div>
                <x-ui.accordion type="single" collapsible>
                    @foreach ($faq as $i => $item)
                        <x-ui.accordion-item value="faq-{{ $i }}">
                            <x-ui.accordion-trigger>{{ $item['q'] }}</x-ui.accordion-trigger>
                            <x-ui.accordion-content>{{ $item['a'] }}</x-ui.accordion-content>
                        </x-ui.accordion-item>
                    @endforeach
                </x-ui.accordion>
            </div>

        </div>
    </div>
</section>

{{-- ══ 10. FOOTER ═══════════════════════════════════════════════════════════════ --}}
<footer class="tr-footer" style="background-color:var(--tr-ink)">
    <div class="mx-auto max-w-6xl px-6 py-16">
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4 mb-12">
            {{-- Brand --}}
            <div class="lg:col-span-1">
                <div class="tr-display" style="font-size:1.3rem;color:var(--tr-cream);margin-bottom:.75rem">Maison Terroir</div>
                <p style="font-size:.82rem;line-height:1.7;max-width:18rem">Two Michelin stars. One kitchen. The honest pursuit of perfection through seasonal French gastronomy.</p>
                <div style="display:flex;gap:.5rem;margin-top:1.25rem">
                    <span class="tr-badge-award" style="background:rgba(184,137,59,.12);color:var(--tr-gold)"><x-lucide-star class="size-3" />★★</span>
                    <span class="tr-badge-award" style="background:rgba(92,107,63,.12);color:#a8bf7d"><x-lucide-leaf class="size-3" />Green Star</span>
                </div>
            </div>

            {{-- Links --}}
            @foreach (['Experience' => ['The Menu', 'Grand Tasting', 'Wine Cellar', 'Private Dining'], 'Visit' => ['Reservations', 'Hours & Location', 'Dress Code', 'Gift Vouchers'], 'The House' => ['Our Story', 'The Team', 'Press', 'Careers']] as $heading => $links)
                <div>
                    <div class="tr-label mb-4" style="color:rgba(247,241,230,.4)">{{ $heading }}</div>
                    <ul style="display:flex;flex-direction:column;gap:.5rem">
                        @foreach ($links as $link)
                            <li><a href="#" class="tr-footer" style="font-size:.85rem">{{ $link }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <div style="border-top:1px solid rgba(247,241,230,.1);padding-top:1.5rem;display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:1rem">
            <span style="font-family:'Inter',sans-serif;font-size:.72rem;color:rgba(247,241,230,.3);letter-spacing:.04em">
                © {{ date('Y') }} Maison Terroir SAS. All rights reserved.
            </span>
            <div style="display:flex;gap:1.5rem">
                @foreach (['Privacy', 'Legal', 'Cookies'] as $lnk)
                    <a href="#" style="font-family:'Inter',sans-serif;font-size:.72rem;color:rgba(247,241,230,.3);letter-spacing:.04em;text-decoration:none;transition:color .2s" onmouseover="this.style.color='rgba(247,241,230,.6)'" onmouseout="this.style.color='rgba(247,241,230,.3)'">{{ $lnk }}</a>
                @endforeach
            </div>
        </div>
    </div>
</footer>

</div>{{-- #tpl-terroir --}}
</x-layouts.app>
