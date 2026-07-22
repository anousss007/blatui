@php
    // ── Data ─────────────────────────────────────────────────────────────────────
    $listings = [
        [
            'seed'      => 'estate-villa',
            'title'     => 'Villa Aurore',
            'location'  => 'Côte d\'Azur, France',
            'price'     => '4 250 000',
            'beds'      => 5,
            'baths'     => 4,
            'sqft'      => '6 800',
            'badge'     => 'Exclusive',
            'badge_tone'=> 'warning',
        ],
        [
            'seed'      => 'estate-townhouse',
            'title'     => 'Maison Haussmann',
            'location'  => 'Paris 8e, France',
            'price'     => '2 890 000',
            'beds'      => 4,
            'baths'     => 3,
            'sqft'      => '3 200',
            'badge'     => 'New',
            'badge_tone'=> 'success',
        ],
        [
            'seed'      => 'estate-chateau',
            'title'     => 'Château de Miraval',
            'location'  => 'Provence, France',
            'price'     => '8 750 000',
            'beds'      => 9,
            'baths'     => 7,
            'sqft'      => '14 200',
            'badge'     => 'Exclusive',
            'badge_tone'=> 'warning',
        ],
        [
            'seed'      => 'estate-penthouse',
            'title'     => 'Penthouse Lumière',
            'location'  => 'Monaco',
            'price'     => '12 500 000',
            'beds'      => 3,
            'baths'     => 3,
            'sqft'      => '4 100',
            'badge'     => 'New',
            'badge_tone'=> 'success',
        ],
        [
            'seed'      => 'estate-manor',
            'title'     => 'The Manor House',
            'location'  => 'Cotswolds, England',
            'price'     => '3 475 000',
            'beds'      => 7,
            'baths'     => 5,
            'sqft'      => '9 600',
            'badge'     => 'Exclusive',
            'badge_tone'=> 'warning',
        ],
        [
            'seed'      => 'estate-lakefront',
            'title'     => 'Villa Lacustre',
            'location'  => 'Lake Geneva, Switzerland',
            'price'     => '6 200 000',
            'beds'      => 6,
            'baths'     => 5,
            'sqft'      => '7 800',
            'badge'     => 'New',
            'badge_tone'=> 'success',
        ],
    ];

    $galleryImages = [
        ['src' => 'https://picsum.photos/seed/est-gal1/1200/800',  'thumb' => 'https://picsum.photos/seed/est-gal1/600/400',  'alt' => 'Grand salon with floor-to-ceiling windows'],
        ['src' => 'https://picsum.photos/seed/est-gal2/1200/800',  'thumb' => 'https://picsum.photos/seed/est-gal2/600/400',  'alt' => 'Chef\'s kitchen with marble island'],
        ['src' => 'https://picsum.photos/seed/est-gal3/1200/800',  'thumb' => 'https://picsum.photos/seed/est-gal3/600/400',  'alt' => 'Master suite with private terrace'],
        ['src' => 'https://picsum.photos/seed/est-gal4/1200/800',  'thumb' => 'https://picsum.photos/seed/est-gal4/600/400',  'alt' => 'Infinity pool overlooking the Mediterranean'],
        ['src' => 'https://picsum.photos/seed/est-gal5/1200/800',  'thumb' => 'https://picsum.photos/seed/est-gal5/600/400',  'alt' => 'Manicured formal gardens and parterre'],
        ['src' => 'https://picsum.photos/seed/est-gal6/1200/800',  'thumb' => 'https://picsum.photos/seed/est-gal6/600/400',  'alt' => 'Wine cellar and private cinema'],
    ];

    $specsTable = [
        ['label' => 'Living Area',       'value' => '6 800 sq ft / 632 m²'],
        ['label' => 'Plot Size',          'value' => '1.8 acres / 0.73 ha'],
        ['label' => 'Bedrooms',           'value' => '5 (incl. 2 suites)'],
        ['label' => 'Bathrooms',          'value' => '4 (3 en-suite)'],
        ['label' => 'Year Built',         'value' => '1938 (fully restored 2022)'],
        ['label' => 'Energy Rating',      'value' => 'A+'],
        ['label' => 'Parking',            'value' => 'Triple garage + 4 exterior'],
        ['label' => 'Annual Service',     'value' => 'EUR 38 400'],
    ];

    $amenities = [
        ['icon' => 'waves',        'label' => 'Heated infinity pool'],
        ['icon' => 'flame',        'label' => 'Home cinema & wine cellar'],
        ['icon' => 'dumbbell',     'label' => 'Private gym & spa'],
        ['icon' => 'tree-pine',    'label' => 'Formal gardens (landscape design)'],
        ['icon' => 'shield-check', 'label' => '24/7 concierge & security'],
        ['icon' => 'sun',          'label' => 'Smart home & solar array'],
        ['icon' => 'utensils',     'label' => 'Summer kitchen & dining pavilion'],
        ['icon' => 'car',          'label' => 'EV charging & helicopter pad'],
    ];

    $neighbourhoods = [
        'riviera'   => ['label' => 'Côte d\'Azur', 'desc' => 'From Cap d\'Antibes to Saint-Tropez, the French Riviera remains Europe\'s most coveted address — unrivalled sunshine, crystalline waters and a social calendar without equal.', 'img_seed' => 'estate-nb-riviera', 'highlights' => ['Cannes Film Festival', 'Monaco Grand Prix', 'Nice International Airport 20 min', 'Michelin-starred restaurants']],
        'paris8'    => ['label' => 'Paris 8e', 'desc' => 'The golden triangle of haute couture and haute cuisine. Haussmann boulevards, the Arc de Triomphe and the finest private members\' clubs in France.', 'img_seed' => 'estate-nb-paris', 'highlights' => ['Avenue Montaigne', 'Élysée Palace quarter', 'Private schools & lycées', 'Three-minute walk to the Bois de Boulogne']],
        'provence'  => ['label' => 'Provence', 'desc' => 'Lavender plains, truffle forests and some of France\'s most acclaimed vineyards. Timeless villages, a luminous palette and an unhurried rhythm.', 'img_seed' => 'estate-nb-provence', 'highlights' => ['Luberon Natural Park', 'Les Baux de Provence', 'Direct TGV to Paris (3h)', 'Aix-en-Provence market']],
        'monaco'    => ['label' => 'Monaco', 'desc' => 'A sovereign principality where privacy, security and prestige converge on a single stunning kilometre of coast. Zero income tax. Absolute discretion.', 'img_seed' => 'estate-nb-monaco', 'highlights' => ['Principauté de Monaco', 'Monte-Carlo Casino', 'Nice Airport 30 min', 'World-class marina']],
    ];

    $stats = [
        ['value' => '€ 2.4B', 'label' => 'Properties sold this year'],
        ['value' => '14',     'label' => 'Avg days to close'],
        ['value' => '340+',   'label' => 'Active listings'],
        ['value' => '98%',    'label' => 'Client satisfaction'],
    ];

    $testimonials = [
        [
            'q'      => 'Maison Estates handled every detail with extraordinary discretion. We found our Provençal estate in three viewings — a process that felt less like a transaction and more like a curated experience.',
            'author' => 'Isabelle Fontaine',
            'role'   => 'Private client, Provence',
            'img'    => 'https://picsum.photos/seed/client-isabelle/160/160',
        ],
        [
            'q'      => 'The level of market intelligence and personal attention surpassed anything we had encountered elsewhere in Europe. Our Monaco penthouse was delivered exactly as promised.',
            'author' => 'James Ashworth',
            'role'   => 'Private client, Monaco',
            'img'    => 'https://picsum.photos/seed/client-james/160/160',
        ],
        [
            'q'      => 'From the initial consultation to the notarial act, the team was impeccable. They understood that we were not buying a property — we were acquiring a legacy.',
            'author' => 'Sophia Laurent',
            'role'   => 'Private client, Côte d\'Azur',
            'img'    => 'https://picsum.photos/seed/client-sophia/160/160',
        ],
    ];

    $faqs = [
        ['q' => 'What markets does Maison Estates cover?',           'a' => 'We operate exclusively in ultra-prime European markets — France (Paris, Côte d\'Azur, Provence, Bordeaux), Monaco, the Swiss Riviera, the Cotswolds and select Balearic addresses. Our network extends to off-market introductions in over 40 countries through trusted correspondent brokers.'],
        ['q' => 'How are off-market properties accessed?',           'a' => 'Over 60% of our mandates never appear on public portals. They are shared exclusively with qualified registered buyers after a confidential brief. To access the off-market portfolio, we invite you to complete a private client registration.'],
        ['q' => 'What is your buying-side service?',                 'a' => 'Our acquisition consultants act solely on your behalf — never on the vendor\'s. We conduct discreet property searches, independent valuations, legal due-diligence introductions and price negotiation, culminating in a seamless notarial process.'],
        ['q' => 'Do you assist with financing and wealth structuring?', 'a' => 'We work alongside a curated panel of private bankers, fiduciaires and family offices who understand the specific requirements of cross-border luxury acquisition — from SCI and SARL de famille structures to international mortgage solutions.'],
        ['q' => 'Is a private viewing available?',                   'a' => 'All viewings are strictly private and arranged at the buyer\'s convenience, including evenings and weekends. For international clients we offer accompanied itineraries with helicopter transfers and bespoke accommodation. Contact our concierge to schedule.'],
    ];

    $propertyTypes = [
        'villa'      => 'Villa / Maison de maître',
        'chateau'    => 'Château / Estate',
        'apartment'  => 'Apartment / Penthouse',
        'chalet'     => 'Chalet / Mountain retreat',
        'island'     => 'Island / Waterfront estate',
        'other'      => 'Other / Please advise',
    ];

    $budgetRanges = [
        '1m-3m'   => '€1M – €3M',
        '3m-5m'   => '€3M – €5M',
        '5m-10m'  => '€5M – €10M',
        '10m-25m' => '€10M – €25M',
        '25m+'    => '€25M+',
        'undisclosed' => 'Prefer not to disclose',
    ];
@endphp

<x-layouts.app title="Maison Estates — Luxury Property">

{{-- ══ SCOPED STYLES ══════════════════════════════════════════════════════════════ --}}
<style>
@import url('https://fonts.bunny.net/css?family=cormorant-garamond:400,500,600,700|inter:400,500,600,700');

/* ── Estate palette & base ── */
#tpl-estate {
    --es-stone:    #f3efe9;
    --es-stone-lt: #faf8f4;
    --es-charcoal: #1c1b19;
    --es-charcoal2:#2f2e2b;
    --es-gold:     #a98445;
    --es-gold-lt:  rgba(169,132,69,.18);
    --es-gold-line:rgba(169,132,69,.3);
    --es-forest:   #2f4034;
    --es-muted:    #7a7267;
    --es-divider:  rgba(169,132,69,.2);

    background-color: var(--es-stone);
    color: var(--es-charcoal);
    font-family: 'Inter', system-ui, sans-serif;
    font-size: 1rem;
    line-height: 1.7;
}

/* ── Typography helpers ── */
#tpl-estate .es-display {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-weight: 700;
    line-height: 1.08;
    letter-spacing: -0.02em;
}
#tpl-estate .es-display-md {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-weight: 600;
    line-height: 1.15;
    letter-spacing: -0.015em;
}
#tpl-estate .es-serif {
    font-family: 'Cormorant Garamond', Georgia, serif;
}
#tpl-estate .es-eyebrow {
    font-family: 'Inter', sans-serif;
    font-size: 0.62rem;
    font-weight: 600;
    letter-spacing: 0.22em;
    text-transform: uppercase;
    color: var(--es-gold);
}
#tpl-estate .es-label {
    font-family: 'Inter', sans-serif;
    font-size: 0.65rem;
    font-weight: 600;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--es-muted);
}
#tpl-estate .es-price {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-weight: 600;
    font-variant-numeric: tabular-nums;
    color: var(--es-charcoal);
}

/* ── Gold hairline ── */
#tpl-estate .es-hairline {
    border: none;
    border-top: 1px solid var(--es-divider);
}
#tpl-estate .es-gold-bar {
    display: block;
    width: 40px;
    height: 1px;
    background: var(--es-gold);
    margin-bottom: 1.25rem;
}

/* ── Image hover zoom ── */
#tpl-estate .es-zoom {
    overflow: hidden;
}
#tpl-estate .es-zoom img {
    transition: transform 0.9s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    will-change: transform;
}
@media (prefers-reduced-motion: reduce) {
    #tpl-estate .es-zoom img { transition: none; }
}
#tpl-estate .es-zoom:hover img,
#tpl-estate .es-zoom:focus-within img {
    transform: scale(1.045);
}

/* ── Fade-reveal animation ── */
@keyframes es-fadeup {
    from { opacity: 0; transform: translateY(20px); }
    to   { opacity: 1; transform: translateY(0); }
}
@media (prefers-reduced-motion: no-preference) {
    #tpl-estate .es-reveal {
        animation: es-fadeup 0.7s ease both;
    }
    #tpl-estate .es-reveal-2 { animation-delay: 0.12s; }
    #tpl-estate .es-reveal-3 { animation-delay: 0.24s; }
    #tpl-estate .es-reveal-4 { animation-delay: 0.36s; }
}

/* ── Numbered listing index ── */
#tpl-estate .es-index-num {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-weight: 600;
    font-size: 0.9rem;
    color: var(--es-gold);
    min-width: 1.8rem;
    padding-top: 0.05rem;
}

/* ── Nav ── */
#tpl-estate .es-nav {
    background-color: rgba(243,239,233,0.92);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border-bottom: 1px solid var(--es-divider);
}
#tpl-estate .es-nav-link {
    font-family: 'Inter', sans-serif;
    font-size: 0.72rem;
    font-weight: 500;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--es-charcoal2);
    text-decoration: none;
    padding: 0.35rem 0.9rem;
    border-radius: 4px;
    transition: color 0.2s, background-color 0.2s;
}
#tpl-estate .es-nav-link:hover {
    color: var(--es-gold);
    background-color: var(--es-gold-lt);
}

/* ── Sticky CTA bar ── */
#tpl-estate .es-sticky-cta {
    position: sticky;
    bottom: 1.25rem;
    z-index: 30;
    pointer-events: none;
}
#tpl-estate .es-sticky-cta > * {
    pointer-events: auto;
}

/* ── Primary button ── */
#tpl-estate .es-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background-color: var(--es-charcoal);
    color: var(--es-stone-lt);
    font-family: 'Inter', sans-serif;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    padding: 0.8rem 2.2rem;
    border: 1.5px solid var(--es-charcoal);
    border-radius: 2px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.25s, color 0.25s, box-shadow 0.25s;
}
#tpl-estate .es-btn-primary:hover {
    background-color: var(--es-gold);
    border-color: var(--es-gold);
    box-shadow: 0 6px 24px rgba(169,132,69,.28);
}
#tpl-estate .es-btn-outline {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background-color: transparent;
    color: var(--es-charcoal);
    font-family: 'Inter', sans-serif;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    padding: 0.78rem 2.1rem;
    border: 1.5px solid var(--es-charcoal);
    border-radius: 2px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.25s, color 0.25s;
}
#tpl-estate .es-btn-outline:hover {
    background-color: var(--es-charcoal);
    color: var(--es-stone-lt);
}
#tpl-estate .es-btn-gold {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background-color: var(--es-gold);
    color: #fff;
    font-family: 'Inter', sans-serif;
    font-size: 0.72rem;
    font-weight: 600;
    letter-spacing: 0.16em;
    text-transform: uppercase;
    padding: 0.8rem 2.2rem;
    border: 1.5px solid var(--es-gold);
    border-radius: 2px;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.25s, box-shadow 0.25s;
}
#tpl-estate .es-btn-gold:hover {
    background-color: #8a6a34;
    border-color: #8a6a34;
    box-shadow: 0 6px 24px rgba(169,132,69,.3);
}

/* ── Listing card ── */
#tpl-estate .es-card {
    background: var(--es-stone-lt);
    border: 1px solid var(--es-divider);
    transition: box-shadow 0.3s;
}
#tpl-estate .es-card:hover {
    box-shadow: 0 12px 40px rgba(28,27,25,.1);
}

/* ── Stat block ── */
#tpl-estate .es-stat-value {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-weight: 700;
    font-size: clamp(2.5rem, 4vw, 3.5rem);
    color: var(--es-charcoal);
    line-height: 1;
}

/* ── Form overrides ── */
#tpl-estate [data-slot="input"],
#tpl-estate [data-slot="select"],
#tpl-estate [data-slot="date-picker"] button,
#tpl-estate [data-slot="time-field"] select,
#tpl-estate [data-slot="time-field"] input,
#tpl-estate [data-slot="phone-input"] input,
#tpl-estate [data-slot="phone-input"] button {
    background-color: #faf8f4 !important;
    border-color: var(--es-divider) !important;
    color: var(--es-charcoal) !important;
}
#tpl-estate [data-slot="field-label"] {
    color: var(--es-charcoal2);
    font-family: 'Inter', sans-serif;
    font-size: 0.68rem;
    font-weight: 600;
    letter-spacing: 0.12em;
    text-transform: uppercase;
}

/* ── Accordion overrides ── */
#tpl-estate [data-slot="accordion-item"] {
    border-bottom-color: var(--es-divider) !important;
}
#tpl-estate [data-slot="accordion-trigger"] {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-weight: 600;
    font-size: 1.05rem;
    color: var(--es-charcoal);
}
#tpl-estate [data-slot="accordion-content"] {
    color: var(--es-muted);
    font-size: 0.92rem;
    line-height: 1.8;
}

/* ── Tabs overrides ── */
#tpl-estate [data-slot="tabs-list"] {
    background-color: rgba(169,132,69,0.1) !important;
    border: 1px solid var(--es-divider) !important;
    border-radius: 2px !important;
}
#tpl-estate [data-slot="tabs-trigger"][data-state="active"] {
    background-color: var(--es-charcoal) !important;
    color: var(--es-stone-lt) !important;
}
#tpl-estate [data-slot="tabs-trigger"] {
    font-family: 'Inter', sans-serif;
    font-size: 0.68rem;
    font-weight: 600;
    letter-spacing: 0.14em;
    text-transform: uppercase;
    color: var(--es-muted) !important;
    border-radius: 2px !important;
}

/* ── Quote override ── */
#tpl-estate [data-slot="quote"] blockquote {
    font-family: 'Cormorant Garamond', Georgia, serif;
    font-weight: 500;
    font-size: 1.2rem;
    color: var(--es-charcoal);
    line-height: 1.6;
}

/* ── Table overrides ── */
#tpl-estate [data-slot="table-container"] {
    background: var(--es-stone-lt) !important;
    border-color: var(--es-divider) !important;
}
#tpl-estate [data-slot="table"] th {
    font-family: 'Inter', sans-serif;
    font-size: 0.62rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: var(--es-muted);
    background: var(--es-stone-lt);
    border-bottom: 1px solid var(--es-divider);
    padding: 0.75rem 1.25rem;
    font-weight: 600;
}
#tpl-estate [data-slot="table"] td {
    padding: 0.85rem 1.25rem;
    border-bottom: 1px solid var(--es-divider);
    color: var(--es-charcoal2);
    font-size: 0.9rem;
}
#tpl-estate [data-slot="table"] tr:last-child td {
    border-bottom: none;
}

/* ── Footer ── */
#tpl-estate .es-footer {
    background-color: var(--es-charcoal);
    color: rgba(243,239,233,.55);
}
#tpl-estate .es-footer a {
    color: rgba(243,239,233,.45);
    text-decoration: none;
    transition: color 0.2s;
}
#tpl-estate .es-footer a:hover { color: rgba(243,239,233,.85); }

/* ── Carousel  ── */
#tpl-estate .es-carousel-track {
    display: flex;
    transition: transform 0.55s cubic-bezier(0.4,0,0.2,1);
}
@media (prefers-reduced-motion: reduce) {
    #tpl-estate .es-carousel-track { transition: none; }
}

/* ── Spotlight section ── */
#tpl-estate .es-spotlight-img {
    aspect-ratio: 4/3;
    overflow: hidden;
}
</style>

<div id="tpl-estate">

{{-- ═══════════════════════════════════════════════════════════════════════════════
     1.  STICKY NAV
═══════════════════════════════════════════════════════════════════════════════ --}}
<header class="es-nav sticky top-0 z-40">
    <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-6">

        {{-- Mobile menu --}}
        <x-ui.sheet>
            <x-ui.sheet-trigger class="md:hidden">
                <button type="button" aria-label="Open menu" style="background:transparent;border:none;cursor:pointer;color:var(--es-charcoal2)">
                    <x-lucide-menu class="size-5" />
                </button>
            </x-ui.sheet-trigger>
            <x-ui.sheet-content side="left" style="background:var(--es-stone);border-color:var(--es-divider)">
                <x-ui.sheet-header>
                    <x-ui.sheet-title class="es-display" style="color:var(--es-charcoal);font-size:1.25rem">Maison Estates</x-ui.sheet-title>
                </x-ui.sheet-header>
                <nav class="grid gap-0.5 px-4">
                    @foreach (['Properties' => '#listings', 'Spotlight' => '#spotlight', 'Neighbourhoods' => '#neighbourhoods', 'Concierge' => '#concierge', 'Schedule a Viewing' => '#viewing'] as $lbl => $href)
                        <a href="{{ $href }}" @click="open = false" class="es-nav-link">{{ $lbl }}</a>
                    @endforeach
                </nav>
                <x-ui.sheet-footer>
                    <a href="#viewing" class="es-btn-primary w-full justify-center">Schedule a Viewing</a>
                </x-ui.sheet-footer>
            </x-ui.sheet-content>
        </x-ui.sheet>

        {{-- Wordmark — centred on mobile, left-aligned on desktop --}}
        <div class="flex flex-1 justify-center md:justify-start">
            <a href="#" class="es-display" style="font-size:1.45rem;color:var(--es-charcoal);text-decoration:none;letter-spacing:-0.01em">
                Maison <em style="font-style:italic;color:var(--es-gold)">Estates</em>
            </a>
        </div>

        {{-- Desktop nav --}}
        <nav class="hidden items-center gap-0.5 md:flex">
            @foreach (['Properties' => '#listings', 'Spotlight' => '#spotlight', 'Neighbourhoods' => '#neighbourhoods', 'Concierge' => '#concierge'] as $lbl => $href)
                <a href="{{ $href }}" class="es-nav-link">{{ $lbl }}</a>
            @endforeach
        </nav>

        <div class="hidden items-center gap-4 md:flex">
            <x-ui.separator orientation="vertical" style="height:1.25rem;background-color:var(--es-divider)" />
            <x-ui.tooltip :delay="150">
                <x-ui.tooltip-trigger>
                    <a href="tel:+33140000000" aria-label="Call us" style="color:var(--es-muted);display:inline-flex;align-items:center">
                        <x-lucide-phone class="size-4" />
                    </a>
                </x-ui.tooltip-trigger>
                <x-ui.tooltip-content side="bottom" style="background:var(--es-charcoal);color:var(--es-stone)">
                    +33 1 40 00 00 00
                </x-ui.tooltip-content>
            </x-ui.tooltip>
            <a href="#viewing" class="es-btn-primary" style="padding:0.5rem 1.5rem">Schedule a Viewing</a>
        </div>
    </div>
</header>

{{-- ═══════════════════════════════════════════════════════════════════════════════
     2.  HERO — full-bleed with overlaid serif title + price + badges
═══════════════════════════════════════════════════════════════════════════════ --}}
<section class="relative overflow-hidden" style="min-height:94vh;display:flex;align-items:flex-end">
    {{-- Full-bleed image with slow zoom --}}
    <div class="absolute inset-0 es-zoom">
        <img
            src="https://picsum.photos/seed/estate-hero/1800/1100"
            alt="Maison Estates — a grand villa overlooking the Mediterranean"
            class="size-full object-cover"
            style="filter:brightness(0.52) saturate(0.9)"
        />
    </div>
    {{-- Deep gradient overlay --}}
    <div class="absolute inset-0" style="background:linear-gradient(to top, rgba(28,27,25,0.95) 0%, rgba(28,27,25,0.5) 40%, transparent 100%)"></div>

    {{-- Gold hairline accent --}}
    <div class="absolute left-8 top-1/2 hidden -translate-y-1/2 lg:block" style="width:1px;height:120px;background:var(--es-gold);opacity:.5"></div>
    <div class="absolute right-8 top-1/2 hidden -translate-y-1/2 lg:block" style="width:1px;height:120px;background:var(--es-gold);opacity:.5"></div>

    <div class="relative z-10 mx-auto w-full max-w-6xl px-6 pb-24 pt-32 lg:pb-32">
        <div class="es-reveal" style="max-width:54rem">
            <div class="es-eyebrow mb-5" style="color:var(--es-gold);letter-spacing:.28em">
                Exclusively Presented &ensp;&middot;&ensp; Côte d'Azur, France
            </div>

            <h1 class="es-display" style="font-size:clamp(3rem,7vw,5.8rem);color:#faf8f4;margin-bottom:1.25rem">
                Villa Aurore
                <br>
                <em style="font-style:italic;color:rgba(243,239,233,.7);font-size:.78em">Cap d'Antibes</em>
            </h1>

            {{-- Price + badges inline --}}
            <div class="flex flex-wrap items-center gap-4 mb-8">
                <span class="es-price" style="font-size:clamp(1.5rem,3vw,2.25rem);color:var(--es-gold)">€ 4 250 000</span>
                <div class="flex gap-2.5 flex-wrap">
                    <x-ui.badge style="background:rgba(169,132,69,.2);color:#e0c07a;border-color:rgba(169,132,69,.4);font-family:'Inter',sans-serif;font-size:.58rem;letter-spacing:.18em;text-transform:uppercase">
                        <x-lucide-star class="size-3 fill-current" /> Exclusive Mandate
                    </x-ui.badge>
                    <x-ui.badge style="background:rgba(47,64,52,.3);color:#a8d4b1;border-color:rgba(47,64,52,.5);font-family:'Inter',sans-serif;font-size:.58rem;letter-spacing:.18em;text-transform:uppercase">
                        <x-lucide-leaf class="size-3" /> 5 Beds
                    </x-ui.badge>
                    <x-ui.badge style="background:rgba(243,239,233,.1);color:rgba(243,239,233,.7);border-color:rgba(243,239,233,.2);font-family:'Inter',sans-serif;font-size:.58rem;letter-spacing:.18em;text-transform:uppercase">
                        6 800 sq ft
                    </x-ui.badge>
                </div>
            </div>

            <p class="es-reveal es-reveal-2" style="font-family:'Cormorant Garamond',Georgia,serif;font-size:1.1rem;color:rgba(243,239,233,.68);max-width:34rem;line-height:1.75;margin-bottom:2.5rem">
                A masterwork of Provençal modernism — four season gardens, an infinity pool and uninterrupted views across the Iles de Lérins.
            </p>

            <div class="es-reveal es-reveal-3 flex flex-wrap gap-4">
                <a href="#viewing" class="es-btn-gold">
                    <x-lucide-calendar class="size-4" /> Schedule a Viewing
                </a>
                <a href="#listings" class="es-btn-outline" style="border-color:rgba(243,239,233,.45);color:rgba(243,239,233,.85)">
                    <x-lucide-building-2 class="size-4" /> All Properties
                </a>
            </div>
        </div>

        {{-- Quick specs row --}}
        <div class="es-reveal es-reveal-4 mt-14 flex flex-wrap gap-x-10 gap-y-4">
            @foreach ([['bed-double', '5 Bedrooms'], ['bath', '4 Bathrooms'], ['ruler', '6 800 sq ft'], ['map-pin', 'Cap d\'Antibes']] as [$icon, $lbl])
                <div class="flex items-center gap-2.5">
                    <x-dynamic-component :component="'lucide-'.$icon" class="size-4" style="color:var(--es-gold)" />
                    <span style="font-family:'Inter',sans-serif;font-size:.78rem;color:rgba(243,239,233,.65);letter-spacing:.08em">{{ $lbl }}</span>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════════
     3.  FEATURED LISTINGS
═══════════════════════════════════════════════════════════════════════════════ --}}
<section id="listings" class="scroll-mt-20" style="background:var(--es-stone)">
    <div class="mx-auto max-w-7xl px-6 py-20 lg:py-28">
        <div class="mb-12 flex flex-col items-start gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <span class="es-gold-bar"></span>
                <div class="es-eyebrow mb-3">Our Portfolio</div>
                <h2 class="es-display-md" style="font-size:clamp(2rem,4vw,3rem);color:var(--es-charcoal)">
                    Featured Properties
                </h2>
            </div>
            <a href="#" class="es-btn-outline shrink-0">
                View All Listings <x-lucide-arrow-right class="size-4" />
            </a>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($listings as $i => $prop)
                <article class="es-card group" style="border-radius:2px;overflow:hidden">
                    {{-- Image --}}
                    <div class="es-zoom relative" style="aspect-ratio:4/3">
                        <img
                            src="https://picsum.photos/seed/{{ $prop['seed'] }}/800/600"
                            alt="{{ $prop['title'] }} — {{ $prop['location'] }}"
                            loading="lazy"
                            class="size-full object-cover"
                        />
                        {{-- Overlay badge top-left --}}
                        <div class="absolute left-4 top-4">
                            <x-ui.badge :tone="$prop['badge_tone']" variant="solid" style="font-family:'Inter',sans-serif;font-size:.58rem;letter-spacing:.14em;text-transform:uppercase">
                                {{ $prop['badge'] }}
                            </x-ui.badge>
                        </div>
                        {{-- Index number bottom-right --}}
                        <div class="es-index-num absolute bottom-4 right-4" style="background:rgba(28,27,25,.7);padding:.25rem .6rem;border-radius:1px;backdrop-filter:blur(4px)">
                            <span style="color:var(--es-gold)">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                        </div>
                    </div>
                    {{-- Body --}}
                    <div style="padding:1.5rem 1.75rem">
                        <div class="es-label mb-1.5" style="color:var(--es-gold)">{{ $prop['location'] }}</div>
                        <h3 class="es-serif" style="font-size:1.3rem;font-weight:600;color:var(--es-charcoal);margin-bottom:.5rem;letter-spacing:-.01em">
                            {{ $prop['title'] }}
                        </h3>
                        <div class="es-price" style="font-size:1.2rem;margin-bottom:1rem">€ {{ $prop['price'] }}</div>

                        <hr class="es-hairline mb-4" />

                        {{-- Specs row --}}
                        <div class="flex items-center gap-5 flex-wrap">
                            @foreach ([['bed-double', $prop['beds'].' beds'], ['bath', $prop['baths'].' baths'], ['ruler', $prop['sqft'].' sq ft']] as [$icon, $spec])
                                <div class="flex items-center gap-1.5">
                                    <x-dynamic-component :component="'lucide-'.$icon" class="size-3.5" style="color:var(--es-muted)" />
                                    <span style="font-family:'Inter',sans-serif;font-size:.75rem;color:var(--es-muted)">{{ $spec }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div class="mt-5">
                            <x-ui.button href="#viewing" variant="outline" class="w-full" style="border-radius:2px;font-family:'Inter',sans-serif;font-size:.68rem;letter-spacing:.12em;text-transform:uppercase;border-color:var(--es-divider);color:var(--es-charcoal2)">
                                Request Details
                            </x-ui.button>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<hr class="es-hairline" />

{{-- ═══════════════════════════════════════════════════════════════════════════════
     4.  PROPERTY SPOTLIGHT — gallery + specs table + amenities
═══════════════════════════════════════════════════════════════════════════════ --}}
<section id="spotlight" class="scroll-mt-20" style="background:var(--es-stone-lt)">
    <div class="mx-auto max-w-7xl px-6 py-20 lg:py-28">
        <div class="mb-14 text-center">
            <span class="es-gold-bar mx-auto"></span>
            <div class="es-eyebrow mb-3">Property Spotlight</div>
            <h2 class="es-display-md" style="font-size:clamp(2rem,4vw,3rem);color:var(--es-charcoal)">Villa Aurore — In Detail</h2>
            <p style="color:var(--es-muted);margin-top:.75rem;max-width:38rem;margin-left:auto;margin-right:auto;font-size:.95rem">
                A complete introduction to this singular property — every room considered, every aspect curated.
            </p>
        </div>

        {{-- Gallery --}}
        <x-ui.gallery
            :images="$galleryImages"
            :columns="3"
            rounded="rounded-none"
        />

        {{-- Specs + Amenities grid --}}
        <div class="mt-14 grid gap-12 lg:grid-cols-2">

            {{-- Specs table --}}
            <div>
                <div class="es-eyebrow mb-6">Property Specifications</div>
                <x-ui.table variant="card">
                    <thead>
                        <tr>
                            <th style="text-align:left">Specification</th>
                            <th style="text-align:left">Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($specsTable as $row)
                            <tr>
                                <td class="es-label" style="color:var(--es-muted)">{{ $row['label'] }}</td>
                                <td style="color:var(--es-charcoal);font-weight:500">{{ $row['value'] }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </x-ui.table>
            </div>

            {{-- Amenities list --}}
            <div>
                <div class="es-eyebrow mb-6">Signature Amenities</div>
                <div class="grid gap-4 sm:grid-cols-2">
                    @foreach ($amenities as $i => $amenity)
                        <div class="flex items-start gap-3.5">
                            <span class="es-index-num shrink-0" style="font-size:.7rem;padding-top:.15rem">{{ str_pad($i + 1, 2, '0', STR_PAD_LEFT) }}</span>
                            <div class="flex items-center gap-2.5">
                                <div style="width:32px;height:32px;background:var(--es-gold-lt);border:1px solid var(--es-gold-line);border-radius:2px;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                                    <x-dynamic-component :component="'lucide-'.$amenity['icon']" class="size-3.5" style="color:var(--es-gold)" />
                                </div>
                                <span style="font-family:'Inter',sans-serif;font-size:.85rem;color:var(--es-charcoal2);line-height:1.4">{{ $amenity['label'] }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-10">
                    <a href="#viewing" class="es-btn-primary">
                        <x-lucide-calendar class="size-4" /> Schedule a Private Viewing
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<hr class="es-hairline" />

{{-- ═══════════════════════════════════════════════════════════════════════════════
     5.  NEIGHBOURHOODS — tabs
═══════════════════════════════════════════════════════════════════════════════ --}}
<section id="neighbourhoods" class="scroll-mt-20" style="background:var(--es-stone)">
    <div class="mx-auto max-w-7xl px-6 py-20 lg:py-28">
        <div class="mb-12 text-center">
            <span class="es-gold-bar mx-auto"></span>
            <div class="es-eyebrow mb-3">Location Intelligence</div>
            <h2 class="es-display-md" style="font-size:clamp(2rem,4vw,3rem);color:var(--es-charcoal)">
                Our Markets
            </h2>
            <p style="color:var(--es-muted);margin-top:.75rem;font-size:.95rem">
                Each address we represent is chosen for its irreplaceable position.
            </p>
        </div>

        <x-ui.tabs value="riviera" class="w-full">
            <div class="flex justify-center mb-10">
                <x-ui.tabs-list class="grid w-full max-w-2xl grid-cols-4">
                    @foreach ($neighbourhoods as $key => $nb)
                        <x-ui.tabs-trigger value="{{ $key }}">{{ $nb['label'] }}</x-ui.tabs-trigger>
                    @endforeach
                </x-ui.tabs-list>
            </div>

            @foreach ($neighbourhoods as $key => $nb)
                <x-ui.tabs-content value="{{ $key }}">
                    <div class="grid items-center gap-10 lg:grid-cols-2">
                        {{-- Text --}}
                        <div>
                            <h3 class="es-display-md mb-4" style="font-size:clamp(1.7rem,3vw,2.4rem);color:var(--es-charcoal)">
                                {{ $nb['label'] }}
                            </h3>
                            <p style="color:var(--es-muted);line-height:1.8;margin-bottom:1.75rem">
                                {{ $nb['desc'] }}
                            </p>
                            <ul class="space-y-3">
                                @foreach ($nb['highlights'] as $hl)
                                    <li class="flex items-start gap-3">
                                        <span style="width:24px;height:24px;background:var(--es-gold-lt);border:1px solid var(--es-gold-line);border-radius:50%;display:inline-flex;align-items:center;justify-content:center;flex-shrink:0;margin-top:.1rem">
                                            <x-lucide-check class="size-3" style="color:var(--es-gold)" />
                                        </span>
                                        <span style="font-family:'Inter',sans-serif;font-size:.88rem;color:var(--es-charcoal2)">{{ $hl }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        {{-- Image --}}
                        <div class="es-spotlight-img es-zoom" style="border-radius:2px">
                            <img
                                src="https://picsum.photos/seed/{{ $nb['img_seed'] }}/900/675"
                                alt="{{ $nb['label'] }} — Maison Estates"
                                loading="lazy"
                                class="size-full object-cover"
                            />
                        </div>
                    </div>
                </x-ui.tabs-content>
            @endforeach
        </x-ui.tabs>
    </div>
</section>

<hr class="es-hairline" />

{{-- ═══════════════════════════════════════════════════════════════════════════════
     6.  CONCIERGE / AGENT
═══════════════════════════════════════════════════════════════════════════════ --}}
<section id="concierge" class="scroll-mt-20" style="background:var(--es-charcoal)">
    <div class="mx-auto max-w-6xl px-6 py-20 lg:py-28">
        <div class="grid items-center gap-14 lg:grid-cols-2">

            {{-- Agent portrait + card --}}
            <div class="flex flex-col items-center text-center lg:items-start lg:text-left">
                <div class="es-zoom mb-6" style="width:160px;height:160px;border-radius:50%;overflow:hidden;border:3px solid var(--es-gold-line)">
                    <img
                        src="https://picsum.photos/seed/agent-pierre/320/320"
                        alt="Pierre Beaumont, Senior Estate Director"
                        class="size-full object-cover"
                    />
                </div>

                <div class="es-eyebrow mb-2" style="color:var(--es-gold)">Your Concierge</div>
                <h3 class="es-display-md mb-1" style="font-size:1.8rem;color:#faf8f4">Pierre Beaumont</h3>
                <div class="es-label mb-4" style="color:rgba(243,239,233,.4)">Senior Estate Director — Europe</div>

                <div class="flex flex-wrap gap-3 mb-6 justify-center lg:justify-start">
                    <x-ui.badge style="background:rgba(169,132,69,.15);color:var(--es-gold);border-color:var(--es-gold-line);font-family:'Inter',sans-serif;font-size:.58rem;letter-spacing:.14em;text-transform:uppercase">
                        <x-lucide-award class="size-3" /> 18 Years Experience
                    </x-ui.badge>
                    <x-ui.badge style="background:rgba(47,64,52,.2);color:#a8d4b1;border-color:rgba(47,64,52,.4);font-family:'Inter',sans-serif;font-size:.58rem;letter-spacing:.14em;text-transform:uppercase">
                        <x-lucide-globe class="size-3" /> FR · MC · CH
                    </x-ui.badge>
                </div>

                <div class="flex gap-3">
                    <x-ui.tooltip :delay="150">
                        <x-ui.tooltip-trigger>
                            <a href="tel:+33140000001" aria-label="Call Pierre" style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;border:1px solid rgba(243,239,233,.15);border-radius:50%;color:rgba(243,239,233,.55);transition:color .2s,border-color .2s" onmouseover="this.style.color='var(--es-gold)';this.style.borderColor='var(--es-gold-line)'" onmouseout="this.style.color='rgba(243,239,233,.55)';this.style.borderColor='rgba(243,239,233,.15)'">
                                <x-lucide-phone class="size-4" />
                            </a>
                        </x-ui.tooltip-trigger>
                        <x-ui.tooltip-content side="top" style="background:var(--es-stone);color:var(--es-charcoal)">Call Pierre</x-ui.tooltip-content>
                    </x-ui.tooltip>
                    <x-ui.tooltip :delay="150">
                        <x-ui.tooltip-trigger>
                            <a href="mailto:pierre@maisonestates.com" aria-label="Email Pierre" style="display:inline-flex;align-items:center;justify-content:center;width:38px;height:38px;border:1px solid rgba(243,239,233,.15);border-radius:50%;color:rgba(243,239,233,.55);transition:color .2s,border-color .2s" onmouseover="this.style.color='var(--es-gold)';this.style.borderColor='var(--es-gold-line)'" onmouseout="this.style.color='rgba(243,239,233,.55)';this.style.borderColor='rgba(243,239,233,.15)'">
                                <x-lucide-mail class="size-4" />
                            </a>
                        </x-ui.tooltip-trigger>
                        <x-ui.tooltip-content side="top" style="background:var(--es-stone);color:var(--es-charcoal)">Email Pierre</x-ui.tooltip-content>
                    </x-ui.tooltip>
                </div>
            </div>

            {{-- Pull quote --}}
            <div>
                <x-ui.quote
                    author="Pierre Beaumont"
                    role="Senior Estate Director, Maison Estates"
                    avatar="https://picsum.photos/seed/agent-pierre/160/160"
                    class="[&_blockquote]:text-lg"
                    style="color:rgba(243,239,233,.85)"
                >
                    Every property search is, at its heart, a search for belonging. We listen before we advise — and we never present a property we would not be proud to call our own.
                </x-ui.quote>

                <div class="mt-10 space-y-4" style="border-left:2px solid var(--es-gold-line);padding-left:1.5rem">
                    @foreach (['Ultra-prime European markets since 2006', 'Over €950M in closed transactions', 'Fully bilingual team: English, French, German', 'Discreet off-market access for registered clients'] as $point)
                        <div class="flex items-start gap-3">
                            <x-lucide-check class="size-4 shrink-0 mt-0.5" style="color:var(--es-gold)" />
                            <span style="font-family:'Inter',sans-serif;font-size:.88rem;color:rgba(243,239,233,.65)">{{ $point }}</span>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════════════════════════════════════════════
     7.  STATS
═══════════════════════════════════════════════════════════════════════════════ --}}
<section style="background:var(--es-stone-lt)">
    <div class="mx-auto max-w-6xl px-6 py-16 lg:py-20">
        <div class="grid grid-cols-2 gap-8 lg:grid-cols-4">
            @foreach ($stats as $i => $stat)
                <div class="text-center" style="border-right:1px solid var(--es-divider);padding: 0 1rem; {{ $i === count($stats) - 1 ? 'border-right:none' : '' }}">
                    <div class="es-stat-value">{{ $stat['value'] }}</div>
                    <div class="es-label mt-2" style="color:var(--es-muted)">{{ $stat['label'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<hr class="es-hairline" />

{{-- ═══════════════════════════════════════════════════════════════════════════════
     8.  TESTIMONIALS CAROUSEL
═══════════════════════════════════════════════════════════════════════════════ --}}
<section style="background:var(--es-stone)">
    <div class="mx-auto max-w-6xl px-6 py-20 lg:py-28">
        <div class="mb-12 text-center">
            <span class="es-gold-bar mx-auto"></span>
            <div class="es-eyebrow mb-3">Client Voices</div>
            <h2 class="es-display-md" style="font-size:clamp(2rem,4vw,3rem);color:var(--es-charcoal)">
                Trusted by Discerning Buyers
            </h2>
        </div>

        {{-- Carousel --}}
        <div
            x-data="{ idx: 0, total: {{ count($testimonials) }}, auto: null,
                start() { this.auto = setInterval(() => this.next(), 6000); },
                stop()  { clearInterval(this.auto); },
                next()  { this.idx = (this.idx + 1) % this.total; },
                prev()  { this.idx = (this.idx - 1 + this.total) % this.total; }
            }"
            x-init="start()"
            @mouseenter="stop()"
            @mouseleave="start()"
            class="relative overflow-hidden"
            role="region"
            aria-label="Testimonials"
        >
            <div class="es-carousel-track" :style="'transform: translateX(-' + (idx * 100) + '%)'">
                @foreach ($testimonials as $t)
                    <div class="min-w-full px-4">
                        <div class="mx-auto max-w-3xl" style="border:1px solid var(--es-divider);border-radius:2px;padding:3rem 3.5rem;background:var(--es-stone-lt)">
                            <x-ui.quote
                                author="{{ $t['author'] }}"
                                role="{{ $t['role'] }}"
                                avatar="{{ $t['img'] }}"
                            >{{ $t['q'] }}</x-ui.quote>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Prev / Next --}}
            <button
                type="button"
                @click="prev()"
                aria-label="Previous testimonial"
                class="absolute left-0 top-1/2 -translate-y-1/2"
                style="background:var(--es-stone-lt);border:1px solid var(--es-divider);border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background .2s"
                onmouseover="this.style.background='var(--es-gold-lt)'" onmouseout="this.style.background='var(--es-stone-lt)'"
            >
                <x-lucide-chevron-left class="size-4" style="color:var(--es-charcoal2)" />
            </button>
            <button
                type="button"
                @click="next()"
                aria-label="Next testimonial"
                class="absolute right-0 top-1/2 -translate-y-1/2"
                style="background:var(--es-stone-lt);border:1px solid var(--es-divider);border-radius:50%;width:40px;height:40px;display:flex;align-items:center;justify-content:center;cursor:pointer;transition:background .2s"
                onmouseover="this.style.background='var(--es-gold-lt)'" onmouseout="this.style.background='var(--es-stone-lt)'"
            >
                <x-lucide-chevron-right class="size-4" style="color:var(--es-charcoal2)" />
            </button>

            {{-- Dots --}}
            <div class="mt-8 flex justify-center gap-2.5">
                @for ($i = 0; $i < count($testimonials); $i++)
                    <button
                        type="button"
                        @click="idx = {{ $i }}"
                        :aria-label="'Go to testimonial {{ $i + 1 }}'"
                        :style="idx === {{ $i }} ? 'width:2rem;background:var(--es-gold)' : 'width:.625rem;background:var(--es-divider)'"
                        style="height:.625rem;border-radius:100px;border:none;cursor:pointer;transition:width .3s,background .3s"
                    ></button>
                @endfor
            </div>
        </div>
    </div>
</section>

<hr class="es-hairline" />

{{-- ═══════════════════════════════════════════════════════════════════════════════
     9.  VIEWING REQUEST FORM
═══════════════════════════════════════════════════════════════════════════════ --}}
<section id="viewing" class="scroll-mt-20" style="background:var(--es-stone-lt)">
    <div class="mx-auto max-w-3xl px-6 py-20 lg:py-28">
        <div class="mb-12 text-center">
            <span class="es-gold-bar mx-auto"></span>
            <div class="es-eyebrow mb-3">Private Viewings</div>
            <h2 class="es-display-md" style="font-size:clamp(2rem,4vw,3rem);color:var(--es-charcoal)">
                Schedule a Viewing
            </h2>
            <p style="color:var(--es-muted);margin-top:.75rem;font-size:.95rem;max-width:28rem;margin-left:auto;margin-right:auto">
                All viewings are arranged at your convenience. Our concierge will confirm within two business hours.
            </p>
        </div>

        <form
            x-data="{ submitting: false, done: false }"
            @submit.prevent="submitting = true; setTimeout(() => { submitting = false; done = true; }, 1500)"
            style="background:var(--es-stone);border:1px solid var(--es-divider);border-radius:2px;padding:2.75rem;box-shadow:0 6px 32px rgba(28,27,25,.07)"
            aria-label="Schedule a viewing form"
        >
            {{-- Success state --}}
            <div x-show="done" x-cloak style="text-align:center;padding:2rem 0">
                <div style="width:56px;height:56px;background:var(--es-gold-lt);border:1px solid var(--es-gold-line);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem">
                    <x-lucide-check class="size-6" style="color:var(--es-gold)" />
                </div>
                <h3 class="es-display-md" style="font-size:1.6rem;color:var(--es-charcoal);margin-bottom:.5rem">Request Received</h3>
                <p style="color:var(--es-muted);font-size:.9rem">Our concierge will be in touch within two business hours to confirm your private viewing.</p>
            </div>

            {{-- Form fields --}}
            <div x-show="!done">
                {{-- Row 1: Property type + Budget --}}
                <div class="grid gap-6 sm:grid-cols-2 mb-6">
                    <x-ui.field>
                        <x-ui.field-label>Property Type</x-ui.field-label>
                        <x-ui.field-content>
                            <x-ui.select
                                name="property_type"
                                :options="$propertyTypes"
                                placeholder="Select type…"
                                class="w-full"
                            />
                        </x-ui.field-content>
                    </x-ui.field>

                    <x-ui.field>
                        <x-ui.field-label>Budget Range</x-ui.field-label>
                        <x-ui.field-content>
                            <x-ui.select
                                name="budget_range"
                                :options="$budgetRanges"
                                placeholder="Select range…"
                                class="w-full"
                            />
                        </x-ui.field-content>
                    </x-ui.field>
                </div>

                {{-- Row 2: Preferred date + time --}}
                <div class="grid gap-6 sm:grid-cols-2 mb-6">
                    <x-ui.field>
                        <x-ui.field-label>Preferred Date</x-ui.field-label>
                        <x-ui.field-content>
                            <x-ui.date-picker
                                name="viewing_date"
                                :min="date('Y-m-d')"
                                placeholder="Choose a date"
                                class="w-full"
                            />
                        </x-ui.field-content>
                    </x-ui.field>

                    <x-ui.field>
                        <x-ui.field-label>Preferred Time</x-ui.field-label>
                        <x-ui.field-content>
                            <x-ui.time-field
                                name="viewing_time"
                                variant="select"
                                hour-cycle="24"
                                :minute-step="30"
                                class="w-full"
                            />
                        </x-ui.field-content>
                    </x-ui.field>
                </div>

                {{-- Row 3: Full name + Email --}}
                <div class="grid gap-6 sm:grid-cols-2 mb-6">
                    <x-ui.field>
                        <x-ui.field-label for="view-name">Full Name</x-ui.field-label>
                        <x-ui.field-content>
                            <x-ui.input
                                id="view-name"
                                name="full_name"
                                type="text"
                                placeholder="Your full name"
                                autocomplete="name"
                                required
                            />
                        </x-ui.field-content>
                    </x-ui.field>

                    <x-ui.field>
                        <x-ui.field-label for="view-email">Email Address</x-ui.field-label>
                        <x-ui.field-content>
                            <x-ui.input
                                id="view-email"
                                name="email"
                                type="email"
                                placeholder="you@example.com"
                                autocomplete="email"
                                required
                            />
                        </x-ui.field-content>
                    </x-ui.field>
                </div>

                {{-- Row 4: Phone --}}
                <div class="mb-6">
                    <x-ui.field>
                        <x-ui.field-label>Phone Number</x-ui.field-label>
                        <x-ui.field-content>
                            <x-ui.phone-input
                                name="phone"
                                country="FR"
                                placeholder="Mobile or direct line"
                                class="max-w-none w-full"
                            />
                        </x-ui.field-content>
                    </x-ui.field>
                </div>

                {{-- Row 5: Notes --}}
                <div class="mb-8">
                    <x-ui.field>
                        <x-ui.field-label for="view-notes">Additional Notes</x-ui.field-label>
                        <x-ui.field-content>
                            <textarea
                                id="view-notes"
                                name="notes"
                                rows="3"
                                placeholder="Specific properties of interest, travel arrangements, special requirements…"
                                style="width:100%;background:#faf8f4;border:1px solid var(--es-divider);border-radius:2px;padding:.625rem .875rem;font-family:'Inter',sans-serif;font-size:.88rem;color:var(--es-charcoal);resize:vertical;outline:none;transition:border-color .2s,box-shadow .2s;line-height:1.65"
                                onfocus="this.style.borderColor='var(--es-gold)';this.style.boxShadow='0 0 0 3px rgba(169,132,69,.12)'"
                                onblur="this.style.borderColor='var(--es-divider)';this.style.boxShadow='none'"
                            ></textarea>
                        </x-ui.field-content>
                    </x-ui.field>
                </div>

                <div class="flex flex-wrap items-center justify-between gap-4">
                    <p style="font-family:'Inter',sans-serif;font-size:.72rem;color:var(--es-muted);line-height:1.55;max-width:26rem">
                        Your details are held in strict confidence and never shared with third parties. We operate under GDPR.
                    </p>
                    <button
                        type="submit"
                        class="es-btn-gold"
                        :disabled="submitting"
                        :style="submitting ? 'opacity:.65;pointer-events:none' : ''"
                    >
                        <x-lucide-loader class="size-4" x-show="submitting" style="animation:es-spin 1s linear infinite" />
                        <x-lucide-calendar-check class="size-4" x-show="!submitting" />
                        <span x-text="submitting ? 'Submitting…' : 'Request Viewing'"></span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<style>@keyframes es-spin { to { transform: rotate(360deg); } }</style>

<hr class="es-hairline" />

{{-- ═══════════════════════════════════════════════════════════════════════════════
     10.  FAQ ACCORDION
═══════════════════════════════════════════════════════════════════════════════ --}}
<section id="faq" class="scroll-mt-20" style="background:var(--es-stone)">
    <div class="mx-auto max-w-3xl px-6 py-20 lg:py-28">
        <div class="mb-12 text-center">
            <span class="es-gold-bar mx-auto"></span>
            <div class="es-eyebrow mb-3">Frequently Asked</div>
            <h2 class="es-display-md" style="font-size:clamp(2rem,4vw,3rem);color:var(--es-charcoal)">
                Your Questions, Answered
            </h2>
        </div>

        <x-ui.accordion type="single" collapsible class="w-full">
            @foreach ($faqs as $i => $item)
                <x-ui.accordion-item value="faq-estate-{{ $i }}">
                    <x-ui.accordion-trigger>{{ $item['q'] }}</x-ui.accordion-trigger>
                    <x-ui.accordion-content>{{ $item['a'] }}</x-ui.accordion-content>
                </x-ui.accordion-item>
            @endforeach
        </x-ui.accordion>

        <div class="mt-10 text-center">
            <p style="color:var(--es-muted);font-size:.9rem;margin-bottom:1.5rem">
                Have a question not listed here?
            </p>
            <a href="mailto:enquiries@maisonestates.com" class="es-btn-outline">
                <x-lucide-mail class="size-4" /> Contact Our Team
            </a>
        </div>
    </div>
</section>

<hr class="es-hairline" />

{{-- ═══════════════════════════════════════════════════════════════════════════════
     11.  STICKY CTA (floating)
═══════════════════════════════════════════════════════════════════════════════ --}}
<div
    class="es-sticky-cta"
    x-data="{ show: false }"
    x-init="window.addEventListener('scroll', () => { show = window.scrollY > 600 })"
>
    <div
        x-show="show"
        x-cloak
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-4"
        x-transition:enter-end="opacity-100 translate-y-0"
        class="flex justify-end mx-auto max-w-7xl px-6"
        style="margin-top:-4rem;padding-bottom:1.5rem"
    >
        <a
            href="#viewing"
            class="es-btn-gold"
            style="box-shadow:0 8px 32px rgba(28,27,25,.25)"
        >
            <x-lucide-calendar class="size-4" /> Schedule a Viewing
        </a>
    </div>
</div>

{{-- ═══════════════════════════════════════════════════════════════════════════════
     12.  FOOTER
═══════════════════════════════════════════════════════════════════════════════ --}}
<footer class="es-footer" style="background:var(--es-charcoal)">
    <div class="mx-auto max-w-7xl px-6 py-16 lg:py-20">
        <div class="grid gap-12 sm:grid-cols-2 lg:grid-cols-5 mb-14">
            {{-- Brand column --}}
            <div class="lg:col-span-2">
                <a href="#" class="es-display" style="font-size:1.4rem;color:#faf8f4;text-decoration:none;display:inline-block;margin-bottom:.85rem">
                    Maison <em style="font-style:italic;color:var(--es-gold)">Estates</em>
                </a>
                <p style="font-size:.84rem;line-height:1.75;max-width:22rem;color:rgba(243,239,233,.45);margin-bottom:1.5rem">
                    Ultra-prime European property — curated mandates, confidential introductions and a concierge service without equal.
                </p>
                {{-- Social --}}
                <div style="display:flex;gap:.625rem">
                    @foreach (['instagram', 'linkedin', 'twitter'] as $soc)
                        <a href="#" aria-label="{{ ucfirst($soc) }}" style="display:inline-flex;align-items:center;justify-content:center;width:34px;height:34px;border:1px solid rgba(243,239,233,.12);border-radius:50%;color:rgba(243,239,233,.4);transition:color .2s,border-color .2s" onmouseover="this.style.color='var(--es-gold)';this.style.borderColor='var(--es-gold-line)'" onmouseout="this.style.color='rgba(243,239,233,.4)';this.style.borderColor='rgba(243,239,233,.12)'">
                            <x-dynamic-component :component="'lucide-'.$soc" class="size-3.5" />
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Link columns --}}
            @foreach (['Properties' => ['Côte d\'Azur', 'Paris & Île-de-France', 'Provence', 'Monaco & Riviera'], 'Services' => ['Buying', 'Selling', 'Private Valuations', 'Investment Advisory'], 'Company' => ['About Us', 'Our Concierge', 'Press', 'Contact']] as $heading => $links)
                <div>
                    <div class="es-label mb-4" style="color:rgba(243,239,233,.3)">{{ $heading }}</div>
                    <ul style="display:flex;flex-direction:column;gap:.55rem">
                        @foreach ($links as $link)
                            <li>
                                <a href="#" class="es-footer" style="font-family:'Inter',sans-serif;font-size:.84rem">{{ $link }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <x-ui.separator style="background-color:rgba(243,239,233,.08);margin-bottom:1.75rem" />

        <div style="display:flex;flex-wrap:wrap;align-items:center;justify-content:space-between;gap:1rem">
            <span style="font-family:'Inter',sans-serif;font-size:.7rem;color:rgba(243,239,233,.28);letter-spacing:.06em">
                © {{ date('Y') }} Maison Estates SAS. All rights reserved.
            </span>
            <div style="display:flex;gap:1.75rem;flex-wrap:wrap">
                @foreach (['Privacy Policy', 'Terms of Use', 'Cookie Notice', 'GDPR'] as $lnk)
                    <a href="#" style="font-family:'Inter',sans-serif;font-size:.7rem;color:rgba(243,239,233,.28);letter-spacing:.06em;text-decoration:none;transition:color .2s" onmouseover="this.style.color='rgba(243,239,233,.55)'" onmouseout="this.style.color='rgba(243,239,233,.28)'">{{ $lnk }}</a>
                @endforeach
            </div>
        </div>
    </div>
</footer>

</div>{{-- #tpl-estate --}}
</x-layouts.app>
