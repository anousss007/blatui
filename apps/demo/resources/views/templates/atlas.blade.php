@php
    $destinations = [
        ['name' => 'Patagonia', 'country' => 'Argentina', 'category' => 'wild', 'price' => 2490, 'rating' => 5, 'reviews' => 143, 'badge' => 'Top Pick', 'tone' => 'warning', 'seed' => 'patagonia1', 'w' => 600, 'h' => 400],
        ['name' => 'Amalfi Coast', 'country' => 'Italy', 'category' => 'coast', 'price' => 1890, 'rating' => 5, 'reviews' => 218, 'badge' => 'Trending', 'tone' => 'info', 'seed' => 'amalfi2', 'w' => 600, 'h' => 400],
        ['name' => 'Machu Picchu', 'country' => 'Peru', 'category' => 'mountains', 'price' => 2100, 'rating' => 5, 'reviews' => 192, 'badge' => 'UNESCO', 'tone' => 'success', 'seed' => 'machu3', 'w' => 600, 'h' => 400],
        ['name' => 'Kyoto', 'country' => 'Japan', 'category' => 'cities', 'price' => 1650, 'rating' => 4, 'reviews' => 307, 'badge' => 'New Route', 'tone' => 'primary', 'seed' => 'kyoto4', 'w' => 600, 'h' => 400],
        ['name' => 'Lofoten Islands', 'country' => 'Norway', 'category' => 'coast', 'price' => 3100, 'rating' => 5, 'reviews' => 87, 'badge' => 'Exclusive', 'tone' => 'danger', 'seed' => 'lofoten5', 'w' => 600, 'h' => 400],
        ['name' => 'Serengeti', 'country' => 'Tanzania', 'category' => 'wild', 'price' => 3600, 'rating' => 5, 'reviews' => 155, 'badge' => 'Wild', 'tone' => 'warning', 'seed' => 'serengeti6', 'w' => 600, 'h' => 400],
        ['name' => 'Dolomites', 'country' => 'Italy', 'category' => 'mountains', 'price' => 1420, 'rating' => 4, 'reviews' => 241, 'badge' => null, 'tone' => null, 'seed' => 'dolom7', 'w' => 600, 'h' => 400],
        ['name' => 'Marrakech', 'country' => 'Morocco', 'category' => 'cities', 'price' => 980, 'rating' => 4, 'reviews' => 389, 'badge' => 'Best Value', 'tone' => 'success', 'seed' => 'marrak8', 'w' => 600, 'h' => 400],
    ];

    $trips = [
        ['title' => 'Silk Road Odyssey', 'duration' => '14 days', 'countries' => 'Uzbekistan · Kyrgyzstan · Tajikistan', 'price' => 3890, 'seed' => 'silk1', 'w' => 800, 'h' => 500, 'highlight' => 'Small group · max 12'],
        ['title' => 'Patagonia Traverse', 'duration' => '10 days', 'countries' => 'Chile · Argentina', 'price' => 4200, 'seed' => 'pata2', 'w' => 800, 'h' => 500, 'highlight' => 'Guided trekking'],
        ['title' => 'African Safari Circuit', 'duration' => '12 days', 'countries' => 'Kenya · Tanzania · Rwanda', 'price' => 5400, 'seed' => 'safari3', 'w' => 800, 'h' => 500, 'highlight' => 'Wildlife specialist'],
        ['title' => 'Norwegian Fjord Quest', 'duration' => '8 days', 'countries' => 'Norway', 'price' => 2650, 'seed' => 'fjord4', 'w' => 800, 'h' => 500, 'highlight' => 'Private boat'],
        ['title' => 'Japan Deep Culture', 'duration' => '11 days', 'countries' => 'Japan', 'price' => 2980, 'seed' => 'japan5', 'w' => 800, 'h' => 500, 'highlight' => 'Local hosts'],
    ];

    $experiences = [
        ['icon' => 'tent', 'title' => 'Wild Camping', 'desc' => 'Sleep under a sky unpolluted by light. We handle permits, gear and safety.', 'seed' => 'camp1', 'span' => 'col-span-1 row-span-1'],
        ['icon' => 'waves', 'title' => 'Ocean Freediving', 'desc' => 'Descend into blue silence with certified instructors on remote coral atolls.', 'seed' => 'ocean2', 'span' => 'col-span-1 row-span-2'],
        ['icon' => 'mountain', 'title' => 'Summit Expeditions', 'desc' => 'From trekking peaks to technical ascents — for every level of ambition.', 'seed' => 'mount3', 'span' => 'col-span-1 row-span-1'],
        ['icon' => 'utensils', 'title' => 'Culinary Journeys', 'desc' => 'Markets, farms, fire pits. Taste a country the way locals have for centuries.', 'seed' => 'food4', 'span' => 'col-span-2 row-span-1'],
    ];

    $testimonials = [
        ['q' => 'Atlas turned a vague dream into the most defining three weeks of my life. The Silk Road trip was flawlessly executed — every detail felt intentional.', 'a' => 'Camille Fontaine', 'r' => 'Travel writer, Lyon', 'seed' => 'ava1', 'rating' => 5],
        ['q' => 'I\'ve booked eight trips through Atlas over six years. Each one raised the bar. The guides aren\'t just knowledgeable — they\'re obsessive about their landscape.', 'a' => 'Ryo Tanaka', 'r' => 'Photographer, Tokyo', 'seed' => 'ava2', 'rating' => 5],
        ['q' => 'Completely solo traveller here, and I never once felt out of place. The small groups attract the kind of curious, open people you genuinely want to share a meal with.', 'a' => 'Amara Diallo', 'r' => 'Engineer, Accra', 'seed' => 'ava3', 'rating' => 5],
    ];

    $stats = [
        ['v' => '89', 'l' => 'Countries explored', 'icon' => 'globe'],
        ['v' => '42k+', 'l' => 'Adventurers guided', 'icon' => 'users'],
        ['v' => '98%', 'l' => 'Trip satisfaction', 'icon' => 'heart'],
        ['v' => '12', 'l' => 'Years of expertise', 'icon' => 'award'],
    ];

    $gallery = [
        ['seed' => 'gal1', 'w' => 400, 'h' => 500, 'alt' => 'Sunrise over misty peaks'],
        ['seed' => 'gal2', 'w' => 400, 'h' => 300, 'alt' => 'Desert dune silhouettes at dusk'],
        ['seed' => 'gal3', 'w' => 400, 'h' => 300, 'alt' => 'Dense jungle canopy'],
        ['seed' => 'gal4', 'w' => 400, 'h' => 500, 'alt' => 'Icy blue glacier lagoon'],
        ['seed' => 'gal5', 'w' => 400, 'h' => 300, 'alt' => 'Night sky over volcanic crater'],
        ['seed' => 'gal6', 'w' => 400, 'h' => 300, 'alt' => 'Cobalt ocean cove'],
    ];

    $faqs = [
        ['q' => 'What experience level do I need?', 'a' => 'Every trip is graded from "Easy walker" to "Technical". Most adventures require only reasonable fitness; the listing tells you exactly what to expect — elevation, daily km, terrain type.'],
        ['q' => 'Are flights included?', 'a' => 'All land arrangements, accommodation, guides and most meals are included. Flights are optional add-ons — our travel team can bundle them at competitive rates or let you book independently.'],
        ['q' => 'How small are the small groups?', 'a' => 'Typically 6–12 people. Some premium expeditions cap at 4. The listing always states the maximum.'],
        ['q' => 'What\'s the cancellation policy?', 'a' => 'Cancel free up to 60 days before departure for a full refund. Inside 60 days a credit is issued, valid 24 months. Travel insurance is strongly recommended.'],
        ['q' => 'Can I customise a trip for a private group?', 'a' => 'Absolutely. Contact our Bespoke team to tailor any itinerary — dates, pace, accommodation tier and off-itinerary extensions are all on the table.'],
    ];

    $footer = [
        'Explore' => ['Destinations', 'Curated Trips', 'Experiences', 'Map View', 'New Routes'],
        'Company' => ['Our Story', 'Guides & Crew', 'Sustainability', 'Press', 'Careers'],
        'Resources' => ['Trip Guides', 'Packing Lists', 'Visa Help', 'Travel Insurance', 'Community'],
        'Legal' => ['Privacy', 'Terms', 'Cookie Policy', 'Accessibility'],
    ];

    $destinations_select = ['Any destination' => 'Any destination', 'patagonia' => 'Patagonia, Argentina', 'amalfi' => 'Amalfi Coast, Italy', 'machu-picchu' => 'Machu Picchu, Peru', 'kyoto' => 'Kyoto, Japan', 'lofoten' => 'Lofoten Islands, Norway', 'serengeti' => 'Serengeti, Tanzania'];
    $guests_select = ['1' => '1 traveller', '2' => '2 travellers', '3' => '3 travellers', '4' => '4 travellers', '5+' => '5+ travellers'];
@endphp

<x-layouts.app title="Atlas — Find your horizon">
<div id="tpl-atlas">

<style>
    @import url('https://fonts.bunny.net/css?family=sora:400,600,700,800&display=swap');

    #tpl-atlas {
        --atlas-teal:        #0d3b3e;
        --atlas-sand:        #e9d8a6;
        --atlas-orange:      #ee6c4d;
        --atlas-sky:         #3d5a80;
        --atlas-offwhite:    #fdfcf7;
        --atlas-teal-dark:   #081e20;
        --atlas-teal-mid:    #155a5e;
        --atlas-sand-dark:   #c9b87a;
        color-scheme: light;
    }

    #tpl-atlas * {
        font-family: 'Inter', 'Sora', ui-sans-serif, system-ui, sans-serif;
    }

    #tpl-atlas .atlas-heading {
        font-family: 'Sora', 'Inter', ui-sans-serif, system-ui, sans-serif;
    }

    /* ── Cinematic hero ── */
    #tpl-atlas .atlas-hero {
        position: relative;
        min-height: 92vh;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        overflow: hidden;
    }

    #tpl-atlas .atlas-hero-bg {
        position: absolute;
        inset: 0;
        background-image: url('https://picsum.photos/seed/heroatlas/1800/1100');
        background-size: cover;
        background-position: center 30%;
        will-change: transform;
        transition: transform 0.1s linear;
    }

    #tpl-atlas .atlas-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(
            180deg,
            rgba(8, 30, 32, 0.25) 0%,
            rgba(8, 30, 32, 0.15) 30%,
            rgba(8, 30, 32, 0.70) 75%,
            rgba(8, 30, 32, 0.92) 100%
        );
    }

    /* ── Destination card zoom ── */
    #tpl-atlas .atlas-dest-card {
        overflow: hidden;
        border-radius: 1rem;
        position: relative;
    }

    #tpl-atlas .atlas-dest-card img {
        transition: transform 0.55s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        display: block;
        width: 100%;
        height: 220px;
        object-fit: cover;
    }

    #tpl-atlas .atlas-dest-card:hover img {
        transform: scale(1.08);
    }

    /* ── Gallery grid ── */
    #tpl-atlas .atlas-gallery {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        grid-template-rows: 220px 220px;
        gap: 0.75rem;
    }

    #tpl-atlas .atlas-gallery-item:nth-child(1) { grid-row: span 2; }
    #tpl-atlas .atlas-gallery-item:nth-child(4) { grid-row: span 2; }

    #tpl-atlas .atlas-gallery-item {
        overflow: hidden;
        border-radius: 0.75rem;
    }

    #tpl-atlas .atlas-gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.55s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        display: block;
    }

    #tpl-atlas .atlas-gallery-item:hover img {
        transform: scale(1.06);
    }

    /* ── Bento experiences grid ── */
    #tpl-atlas .atlas-bento {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        grid-template-rows: 200px 200px;
        gap: 0.875rem;
    }

    #tpl-atlas .atlas-bento-tall { grid-row: span 2; }

    #tpl-atlas .atlas-bento-wide { grid-column: span 2; }

    /* ── Search bar ── */
    #tpl-atlas .atlas-searchbar {
        background: rgba(253, 252, 247, 0.97);
        border-radius: 1rem;
        padding: 1.25rem 1.5rem;
        box-shadow: 0 20px 60px rgba(8, 30, 32, 0.45);
        backdrop-filter: blur(12px);
    }

    /* ── Section backgrounds ── */
    #tpl-atlas .atlas-section-dark  { background-color: var(--atlas-teal); color: var(--atlas-offwhite); }
    #tpl-atlas .atlas-section-sand  { background-color: var(--atlas-sand); }
    #tpl-atlas .atlas-section-light { background-color: var(--atlas-offwhite); }

    /* ── Marquee destination text ── */
    #tpl-atlas .atlas-marquee-text {
        background-color: var(--atlas-orange);
        color: var(--atlas-offwhite);
        overflow: hidden;
        padding: 0.65rem 0;
    }

    /* ── Stats card ── */
    #tpl-atlas .atlas-stat-card {
        background: rgba(255,255,255,0.06);
        border: 1px solid rgba(233,216,166,0.2);
        border-radius: 1rem;
        padding: 2rem 1.5rem;
        text-align: center;
    }

    /* ── Trip card ── */
    #tpl-atlas .atlas-trip-card {
        position: relative;
        border-radius: 1.25rem;
        overflow: hidden;
        background: var(--atlas-teal-dark);
    }

    #tpl-atlas .atlas-trip-card img {
        width: 100%;
        height: 280px;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }

    #tpl-atlas .atlas-trip-card:hover img {
        transform: scale(1.06);
    }

    #tpl-atlas .atlas-trip-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(8,30,32,0.90) 0%, rgba(8,30,32,0.30) 55%, transparent 100%);
    }

    /* ── Reduced-motion overrides ── */
    @media (prefers-reduced-motion: reduce) {
        #tpl-atlas .atlas-dest-card img,
        #tpl-atlas .atlas-gallery-item img,
        #tpl-atlas .atlas-trip-card img {
            transition: none !important;
        }
        #tpl-atlas .atlas-hero-bg {
            transition: none !important;
        }
    }

    /* ── Responsive gallery ── */
    @media (max-width: 768px) {
        #tpl-atlas .atlas-gallery {
            grid-template-columns: repeat(2, 1fr);
            grid-template-rows: auto;
        }
        #tpl-atlas .atlas-gallery-item:nth-child(1),
        #tpl-atlas .atlas-gallery-item:nth-child(4) {
            grid-row: span 1;
        }
    }

    @media (max-width: 640px) {
        #tpl-atlas .atlas-bento {
            grid-template-columns: 1fr;
            grid-template-rows: auto;
        }
        #tpl-atlas .atlas-bento-tall,
        #tpl-atlas .atlas-bento-wide {
            grid-row: span 1;
            grid-column: span 1;
        }
    }
</style>

{{-- ════════════════════════════════════════════
     NAV
════════════════════════════════════════════ --}}
<header style="background-color: var(--atlas-teal); border-bottom: 1px solid rgba(233,216,166,0.15);" class="sticky top-0 z-40">
    <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-6">
        {{-- Logo --}}
        <a href="#" class="flex items-center gap-2.5 atlas-heading" style="color: var(--atlas-offwhite);">
            <span style="background-color: var(--atlas-orange); color: var(--atlas-offwhite);" class="flex size-9 items-center justify-center rounded-lg">
                <x-lucide-compass class="size-5" />
            </span>
            <span class="text-xl font-bold tracking-tight">Atlas</span>
        </a>

        <nav class="ml-6 hidden items-center gap-1 text-sm md:flex">
            @foreach (['Destinations' => '#destinations', 'Trips' => '#trips', 'Experiences' => '#experiences', 'Book' => '#booking', 'FAQ' => '#faq'] as $label => $href)
                <a href="{{ $href }}" style="color: rgba(253,252,247,0.75);" class="hover:text-white rounded-md px-3 py-1.5 font-medium transition-colors">{{ $label }}</a>
            @endforeach
        </nav>

        <div class="ml-auto flex items-center gap-2">
            <x-ui.button href="#booking" size="sm" class="hidden sm:inline-flex" style="background-color: var(--atlas-orange); color: var(--atlas-offwhite); border: none;">
                Book a Trip <x-lucide-arrow-right class="size-4" />
            </x-ui.button>
            {{-- Mobile --}}
            <x-ui.sheet>
                <x-ui.sheet-trigger class="md:hidden">
                    <x-ui.button variant="ghost" size="icon" style="color: var(--atlas-offwhite);" aria-label="Open menu"><x-lucide-menu class="size-5" /></x-ui.button>
                </x-ui.sheet-trigger>
                <x-ui.sheet-content side="right">
                    <x-ui.sheet-header>
                        <x-ui.sheet-title>Atlas</x-ui.sheet-title>
                    </x-ui.sheet-header>
                    <nav class="grid gap-1 px-4 text-sm">
                        @foreach (['Destinations' => '#destinations', 'Trips' => '#trips', 'Experiences' => '#experiences', 'Book' => '#booking', 'FAQ' => '#faq'] as $label => $href)
                            <a href="{{ $href }}" @click="open = false" class="hover:bg-accent rounded-md px-3 py-2 font-medium">{{ $label }}</a>
                        @endforeach
                    </nav>
                    <x-ui.sheet-footer>
                        <x-ui.button href="#booking" class="w-full">Book a Trip</x-ui.button>
                    </x-ui.sheet-footer>
                </x-ui.sheet-content>
            </x-ui.sheet>
        </div>
    </div>
</header>

{{-- ════════════════════════════════════════════
     HERO — full-bleed cinematic
════════════════════════════════════════════ --}}
<section class="atlas-hero"
    x-data="{ scrollY: 0 }"
    @scroll.window="scrollY = window.scrollY"
>
    <div class="atlas-hero-bg" :style="`transform: translateY(${scrollY * 0.22}px)`" aria-hidden="true"></div>
    <div class="atlas-hero-overlay" aria-hidden="true"></div>

    {{-- Hero content --}}
    <div class="relative z-10 mx-auto w-full max-w-7xl px-6 pb-16 pt-24">
        <div class="max-w-3xl">
            <div class="mb-5 flex flex-wrap items-center gap-2">
                <x-ui.badge style="background-color: var(--atlas-orange); color: var(--atlas-offwhite); border: none;" class="gap-1.5 text-xs font-semibold px-3 py-1">
                    <x-lucide-map-pin class="size-3" /> 89 Countries
                </x-ui.badge>
                <x-ui.badge variant="outline" style="border-color: rgba(233,216,166,0.5); color: var(--atlas-sand); background: transparent;" class="text-xs px-3 py-1">
                    <x-lucide-star class="size-3 fill-current" /> 4.9 · 42 000+ travellers
                </x-ui.badge>
            </div>

            <h1 class="atlas-heading text-5xl font-extrabold leading-none tracking-tight text-balance sm:text-6xl lg:text-7xl xl:text-8xl" style="color: var(--atlas-offwhite);">
                FIND YOUR<br/>
                <span style="color: var(--atlas-sand);">HORIZON</span>
            </h1>

            <p class="mt-5 max-w-xl text-lg font-light leading-relaxed" style="color: rgba(253,252,247,0.80);">
                Curated small-group adventures to the world's most extraordinary places. Expert guides, seamless logistics, unforgettable experiences.
            </p>
        </div>

        {{-- Search bar --}}
        <div class="atlas-searchbar mt-10 max-w-4xl" x-data="{ checkIn: '', checkOut: '' }">
            <div class="mb-3 flex items-center gap-2">
                <x-lucide-search class="size-4" style="color: var(--atlas-teal);" />
                <span class="text-sm font-semibold uppercase tracking-widest" style="color: var(--atlas-teal);">Find your adventure</span>
            </div>
            <div class="grid gap-3 sm:grid-cols-2 lg:grid-cols-4">
                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide" style="color: var(--atlas-teal);">Destination</label>
                    <x-ui.select
                        :options="$destinations_select"
                        placeholder="Any destination"
                    />
                </div>
                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide" style="color: var(--atlas-teal);">Departure</label>
                    <x-ui.input type="date" placeholder="Check-in" />
                </div>
                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide" style="color: var(--atlas-teal);">Return</label>
                    <x-ui.input type="date" placeholder="Check-out" />
                </div>
                <div>
                    <label class="mb-1 block text-xs font-semibold uppercase tracking-wide" style="color: var(--atlas-teal);">Travellers</label>
                    <x-ui.select :options="$guests_select" placeholder="Guests" />
                </div>
            </div>
            <div class="mt-4 flex items-center justify-between gap-3 flex-wrap">
                <div class="flex flex-wrap gap-2">
                    @foreach (['Mountains', 'Coast', 'Cities', 'Wild'] as $tag)
                        <x-ui.badge variant="outline" style="border-color: rgba(13,59,62,0.35); color: var(--atlas-teal);" class="cursor-pointer hover:border-[#ee6c4d] hover:text-[#ee6c4d] transition-colors text-xs px-2.5 py-1">{{ $tag }}</x-ui.badge>
                    @endforeach
                </div>
                <x-ui.button size="lg" style="background-color: var(--atlas-orange); color: white; border: none; font-weight: 700;">
                    <x-lucide-search class="size-4" /> Search Trips
                </x-ui.button>
            </div>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     DESTINATION MARQUEE
════════════════════════════════════════════ --}}
<div class="atlas-marquee-text overflow-hidden">
    <x-ui.marquee :duration="'28s'" :pause-on-hover="true">
        @foreach (['Patagonia', '✦', 'Amalfi Coast', '✦', 'Kyoto', '✦', 'Serengeti', '✦', 'Lofoten', '✦', 'Machu Picchu', '✦', 'Dolomites', '✦', 'Marrakech', '✦', 'Iceland', '✦', 'Rajasthan', '✦', 'Galápagos'] as $place)
            <span class="px-4 text-sm font-bold uppercase tracking-widest whitespace-nowrap" style="color: var(--atlas-offwhite);">{{ $place }}</span>
        @endforeach
    </x-ui.marquee>
</div>

{{-- ════════════════════════════════════════════
     FEATURED DESTINATIONS (Tabs)
════════════════════════════════════════════ --}}
<section id="destinations" class="atlas-section-light scroll-mt-16 py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-6">
        <div class="mb-10 flex flex-col items-start gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <x-ui.badge class="mb-3" style="background-color: rgba(13,59,62,0.08); color: var(--atlas-teal); border: 1px solid rgba(13,59,62,0.18);">
                    <x-lucide-map class="size-3" /> Destinations
                </x-ui.badge>
                <h2 class="atlas-heading text-3xl font-bold tracking-tight text-balance sm:text-4xl" style="color: var(--atlas-teal);">
                    Where will you go next?
                </h2>
                <p class="mt-2 text-base" style="color: rgba(13,59,62,0.65);">Hand-picked corners of the world, ready to explore.</p>
            </div>
            <x-ui.button variant="outline" href="#" style="border-color: var(--atlas-teal); color: var(--atlas-teal);" class="shrink-0">
                View all destinations <x-lucide-arrow-right class="size-4" />
            </x-ui.button>
        </div>

        <x-ui.tabs value="mountains">
            <x-ui.tabs-list variant="pills" class="mb-8 flex-wrap">
                @foreach (['mountains' => 'Mountains', 'coast' => 'Coast', 'cities' => 'Cities', 'wild' => 'Wild'] as $val => $label)
                    <x-ui.tabs-trigger value="{{ $val }}">
                        <x-dynamic-component
                            :component="'lucide-'.['mountains'=>'mountain','coast'=>'waves','cities'=>'building-2','wild'=>'trees'][$val]"
                            class="size-4"
                        />
                        {{ $label }}
                    </x-ui.tabs-trigger>
                @endforeach
            </x-ui.tabs-list>

            @foreach (['mountains', 'coast', 'cities', 'wild'] as $cat)
                <x-ui.tabs-content value="{{ $cat }}">
                    <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                        @foreach ($destinations as $d)
                            @if ($d['category'] === $cat)
                                <x-ui.hover-card>
                                    <x-ui.hover-card-trigger>
                                        <div class="atlas-dest-card" style="background: var(--atlas-offwhite); border: 1px solid rgba(13,59,62,0.1); box-shadow: 0 2px 12px rgba(13,59,62,0.07);">
                                            <div class="relative overflow-hidden">
                                                <img
                                                    src="https://picsum.photos/seed/{{ $d['seed'] }}/{{ $d['w'] }}/{{ $d['h'] }}"
                                                    alt="{{ $d['name'] }}, {{ $d['country'] }}"
                                                    loading="lazy"
                                                />
                                                @if ($d['badge'])
                                                    <div class="absolute left-3 top-3">
                                                        <x-ui.badge :tone="$d['tone']" variant="solid" class="text-[10px] font-bold uppercase tracking-wide">{{ $d['badge'] }}</x-ui.badge>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="p-4">
                                                <div class="mb-1 flex items-start justify-between gap-2">
                                                    <div>
                                                        <h3 class="atlas-heading font-semibold leading-tight" style="color: var(--atlas-teal);">{{ $d['name'] }}</h3>
                                                        <p class="text-xs" style="color: rgba(13,59,62,0.55);">{{ $d['country'] }}</p>
                                                    </div>
                                                    <span class="mt-0.5 text-sm font-bold whitespace-nowrap" style="color: var(--atlas-orange);">from ${{ number_format($d['price']) }}</span>
                                                </div>
                                                <div class="mt-2 flex items-center gap-2">
                                                    <x-ui.rating :value="$d['rating']" :readonly="true" size="sm" color="text-[#ee6c4d]" />
                                                    <span class="text-xs" style="color: rgba(13,59,62,0.50);">({{ $d['reviews'] }})</span>
                                                </div>
                                            </div>
                                        </div>
                                    </x-ui.hover-card-trigger>
                                    <x-ui.hover-card-content side="top" class="w-56">
                                        <div class="space-y-1.5 text-sm">
                                            <p class="font-semibold">{{ $d['name'] }}</p>
                                            <p class="text-muted-foreground">Small groups · expert local guides · all-inclusive logistics.</p>
                                            <x-ui.button size="sm" href="#booking" class="mt-2 w-full" style="background-color: var(--atlas-orange); color: white; border: none;">Book Now</x-ui.button>
                                        </div>
                                    </x-ui.hover-card-content>
                                </x-ui.hover-card>
                            @endif
                        @endforeach
                    </div>
                </x-ui.tabs-content>
            @endforeach
        </x-ui.tabs>
    </div>
</section>

{{-- ════════════════════════════════════════════
     CURATED TRIPS (Carousel)
════════════════════════════════════════════ --}}
<section id="trips" class="atlas-section-dark scroll-mt-16 py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-6">
        <div class="mb-10 flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
            <div>
                <x-ui.badge class="mb-3" style="background-color: rgba(233,216,166,0.15); color: var(--atlas-sand); border: 1px solid rgba(233,216,166,0.25);">
                    <x-lucide-route class="size-3" /> Curated Trips
                </x-ui.badge>
                <h2 class="atlas-heading text-3xl font-bold tracking-tight text-balance sm:text-4xl" style="color: var(--atlas-offwhite);">
                    Epic journeys, perfectly crafted
                </h2>
                <p class="mt-2 text-base" style="color: rgba(233,216,166,0.65);">Multi-country itineraries built around the moments that stay with you forever.</p>
            </div>
            <x-ui.button variant="outline" style="border-color: rgba(233,216,166,0.40); color: var(--atlas-sand); background: transparent;" class="shrink-0">
                All trips <x-lucide-arrow-right class="size-4" />
            </x-ui.button>
        </div>

        <x-ui.carousel class="w-full">
            <x-ui.carousel-content>
                @foreach ($trips as $trip)
                    <x-ui.carousel-item class="basis-full sm:basis-1/2 lg:basis-1/3">
                        <div class="atlas-trip-card h-full">
                            <img
                                src="https://picsum.photos/seed/{{ $trip['seed'] }}/{{ $trip['w'] }}/{{ $trip['h'] }}"
                                alt="{{ $trip['title'] }}"
                                loading="lazy"
                            />
                            <div class="atlas-trip-overlay" aria-hidden="true"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-5">
                                <x-ui.badge class="mb-2 text-[10px] font-semibold uppercase tracking-wider" style="background-color: var(--atlas-orange); color: white; border: none;">{{ $trip['highlight'] }}</x-ui.badge>
                                <h3 class="atlas-heading text-lg font-bold leading-tight" style="color: var(--atlas-offwhite);">{{ $trip['title'] }}</h3>
                                <p class="mt-1 text-xs" style="color: rgba(233,216,166,0.75);">{{ $trip['countries'] }}</p>
                                <div class="mt-3 flex items-center justify-between gap-2">
                                    <div class="flex items-center gap-1.5">
                                        <x-lucide-clock class="size-3.5" style="color: var(--atlas-sand);" />
                                        <span class="text-xs font-medium" style="color: var(--atlas-sand);">{{ $trip['duration'] }}</span>
                                    </div>
                                    <span class="text-sm font-bold" style="color: var(--atlas-orange);">from ${{ number_format($trip['price']) }}</span>
                                </div>
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

{{-- ════════════════════════════════════════════
     EXPERIENCES Bento
════════════════════════════════════════════ --}}
<section id="experiences" class="atlas-section-sand scroll-mt-16 py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-6">
        <div class="mb-10 text-center">
            <x-ui.badge class="mb-3" style="background-color: rgba(13,59,62,0.1); color: var(--atlas-teal); border: 1px solid rgba(13,59,62,0.2);">
                <x-lucide-sparkles class="size-3" /> Experiences
            </x-ui.badge>
            <h2 class="atlas-heading text-3xl font-bold tracking-tight text-balance sm:text-4xl" style="color: var(--atlas-teal);">Beyond the beaten path</h2>
            <p class="mx-auto mt-2 max-w-xl text-base" style="color: rgba(13,59,62,0.65);">Immersive encounters that no highlight reel can replace.</p>
        </div>

        <div class="atlas-bento mx-auto max-w-4xl">
            @foreach ($experiences as $exp)
                <div
                    class="relative overflow-hidden rounded-2xl {{ $exp['span'] }}"
                    style="background: var(--atlas-teal-dark); min-height: 200px;"
                >
                    <img
                        src="https://picsum.photos/seed/{{ $exp['seed'] }}/600/400"
                        alt="{{ $exp['title'] }}"
                        loading="lazy"
                        class="absolute inset-0 w-full h-full object-cover opacity-60"
                    />
                    <div class="absolute inset-0" style="background: linear-gradient(135deg, rgba(8,30,32,0.7) 0%, rgba(8,30,32,0.3) 100%);"></div>
                    <div class="absolute inset-0 flex flex-col justify-end p-5">
                        <div class="mb-2 inline-flex size-9 items-center justify-center rounded-lg" style="background-color: var(--atlas-orange);">
                            <x-dynamic-component :component="'lucide-'.$exp['icon']" class="size-4" style="color: white;" />
                        </div>
                        <h3 class="atlas-heading text-base font-bold" style="color: var(--atlas-offwhite);">{{ $exp['title'] }}</h3>
                        <p class="mt-1 text-xs leading-relaxed" style="color: rgba(233,216,166,0.75);">{{ $exp['desc'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     BOOKING WIDGET (Stepper)
════════════════════════════════════════════ --}}
<section id="booking" class="atlas-section-light scroll-mt-16 py-20 lg:py-28">
    <div class="mx-auto max-w-4xl px-6">
        <div class="mb-10 text-center">
            <x-ui.badge class="mb-3" style="background-color: rgba(13,59,62,0.08); color: var(--atlas-teal); border: 1px solid rgba(13,59,62,0.18);">
                <x-lucide-calendar class="size-3" /> Book Your Trip
            </x-ui.badge>
            <h2 class="atlas-heading text-3xl font-bold tracking-tight sm:text-4xl" style="color: var(--atlas-teal);">Three steps to adventure</h2>
            <p class="mt-2 text-base" style="color: rgba(13,59,62,0.60);">Simple, transparent booking. No hidden fees, ever.</p>
        </div>

        <x-ui.stepper :value="1" x-data="{ step: 1 }" class="w-full">
            <x-ui.stepper-nav>
                @foreach (['Choose Trip' => 1, 'Travellers' => 2, 'Confirm' => 3] as $label => $s)
                    <x-ui.stepper-item :step="$s" x-data="{ itemStep: {{ $s }} }">
                        <x-ui.stepper-trigger>
                            <x-ui.stepper-indicator style="border-color: var(--atlas-teal);" />
                            <x-ui.stepper-title>{{ $label }}</x-ui.stepper-title>
                        </x-ui.stepper-trigger>
                        @if ($s < 3)
                            <x-ui.stepper-separator />
                        @endif
                    </x-ui.stepper-item>
                @endforeach
            </x-ui.stepper-nav>

            {{-- Step content inline (non-compositional, Alpine-driven) --}}
            <div class="mt-10">
                <div x-show="step === 1">
                    <div class="rounded-2xl border p-8" style="border-color: rgba(13,59,62,0.12); background: rgba(13,59,62,0.02);">
                        <h3 class="atlas-heading mb-6 text-xl font-semibold" style="color: var(--atlas-teal);">Select your destination &amp; dates</h3>
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium" style="color: var(--atlas-teal);">Destination</label>
                                <x-ui.select :options="$destinations_select" placeholder="Choose destination" />
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium" style="color: var(--atlas-teal);">Trip type</label>
                                <x-ui.select :options="['guided' => 'Guided Group', 'self' => 'Self-guided', 'bespoke' => 'Bespoke Private']" placeholder="Trip style" />
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium" style="color: var(--atlas-teal);">Departure date</label>
                                <x-ui.input type="date" />
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium" style="color: var(--atlas-teal);">Duration</label>
                                <x-ui.select :options="['7' => '7 days', '10' => '10 days', '14' => '14 days', '21' => '21 days']" placeholder="Duration" />
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <x-ui.button @click="step = 2" style="background-color: var(--atlas-teal); color: white; border: none;">
                                Continue <x-lucide-arrow-right class="size-4" />
                            </x-ui.button>
                        </div>
                    </div>
                </div>

                <div x-show="step === 2" x-cloak>
                    <div class="rounded-2xl border p-8" style="border-color: rgba(13,59,62,0.12); background: rgba(13,59,62,0.02);">
                        <h3 class="atlas-heading mb-6 text-xl font-semibold" style="color: var(--atlas-teal);">Traveller details</h3>
                        <div class="grid gap-5 sm:grid-cols-2">
                            <div>
                                <label class="mb-1.5 block text-sm font-medium" style="color: var(--atlas-teal);">First name</label>
                                <x-ui.input placeholder="Jane" />
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium" style="color: var(--atlas-teal);">Last name</label>
                                <x-ui.input placeholder="Doe" />
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium" style="color: var(--atlas-teal);">Email</label>
                                <x-ui.input type="email" placeholder="jane@example.com" />
                            </div>
                            <div>
                                <label class="mb-1.5 block text-sm font-medium" style="color: var(--atlas-teal);">Travellers</label>
                                <x-ui.select :options="$guests_select" placeholder="How many?" />
                            </div>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <x-ui.button variant="outline" @click="step = 1" style="border-color: var(--atlas-teal); color: var(--atlas-teal);">
                                <x-lucide-arrow-left class="size-4" /> Back
                            </x-ui.button>
                            <x-ui.button @click="step = 3" style="background-color: var(--atlas-teal); color: white; border: none;">
                                Review booking <x-lucide-arrow-right class="size-4" />
                            </x-ui.button>
                        </div>
                    </div>
                </div>

                <div x-show="step === 3" x-cloak>
                    <div class="rounded-2xl border p-8" style="border-color: rgba(13,59,62,0.12); background: rgba(13,59,62,0.02);">
                        <h3 class="atlas-heading mb-6 text-xl font-semibold" style="color: var(--atlas-teal);">Booking summary</h3>
                        <div class="rounded-xl p-5 space-y-3" style="background: rgba(13,59,62,0.06);">
                            @foreach (['Destination' => 'Patagonia, Argentina', 'Trip style' => 'Guided Group', 'Departure' => 'Oct 12, 2026', 'Duration' => '10 days', 'Travellers' => '2'] as $k => $v)
                                <div class="flex justify-between text-sm">
                                    <span style="color: rgba(13,59,62,0.60);">{{ $k }}</span>
                                    <span class="font-medium" style="color: var(--atlas-teal);">{{ $v }}</span>
                                </div>
                                @if (!$loop->last)
                                    <x-ui.separator />
                                @endif
                            @endforeach
                        </div>
                        <div class="mt-4 flex items-center justify-between rounded-xl px-5 py-4" style="background-color: var(--atlas-teal);">
                            <span class="font-medium" style="color: rgba(233,216,166,0.8);">Total (2 travellers)</span>
                            <span class="atlas-heading text-2xl font-bold" style="color: var(--atlas-sand);">$8,400</span>
                        </div>
                        <div class="mt-6 flex justify-between">
                            <x-ui.button variant="outline" @click="step = 2" style="border-color: var(--atlas-teal); color: var(--atlas-teal);">
                                <x-lucide-arrow-left class="size-4" /> Back
                            </x-ui.button>
                            <x-ui.button size="lg" style="background-color: var(--atlas-orange); color: white; border: none; font-weight: 700;">
                                <x-lucide-check class="size-4" /> Confirm &amp; Pay
                            </x-ui.button>
                        </div>
                    </div>
                </div>
            </div>
        </x-ui.stepper>
    </div>
</section>

{{-- ════════════════════════════════════════════
     TESTIMONIALS
════════════════════════════════════════════ --}}
<section class="atlas-section-dark py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-6">
        <div class="mb-12 text-center">
            <x-ui.badge class="mb-3" style="background-color: rgba(233,216,166,0.15); color: var(--atlas-sand); border: 1px solid rgba(233,216,166,0.25);">
                <x-lucide-quote class="size-3" /> Traveller stories
            </x-ui.badge>
            <h2 class="atlas-heading text-3xl font-bold tracking-tight sm:text-4xl" style="color: var(--atlas-offwhite);">
                The world through their eyes
            </h2>
        </div>

        <div class="grid gap-6 lg:grid-cols-3">
            @foreach ($testimonials as $t)
                <div class="rounded-2xl p-7 flex flex-col" style="background: rgba(255,255,255,0.05); border: 1px solid rgba(233,216,166,0.12);">
                    <div class="mb-4 flex text-[#ee6c4d]">
                        @for ($i = 0; $i < 5; $i++)
                            <x-lucide-star class="size-4 fill-current" />
                        @endfor
                    </div>
                    <blockquote class="flex-1 text-base italic leading-relaxed" style="color: rgba(253,252,247,0.85);">
                        "{{ $t['q'] }}"
                    </blockquote>
                    <div class="mt-6 flex items-center gap-3">
                        <x-ui.avatar class="size-11 ring-2" style="--ring-color: var(--atlas-orange);">
                            <x-ui.avatar-image src="https://picsum.photos/seed/{{ $t['seed'] }}/80/80" alt="{{ $t['a'] }}" />
                            <x-ui.avatar-fallback style="background-color: var(--atlas-orange); color: white;">{{ substr($t['a'], 0, 1) }}</x-ui.avatar-fallback>
                        </x-ui.avatar>
                        <div>
                            <p class="text-sm font-semibold" style="color: var(--atlas-sand);">{{ $t['a'] }}</p>
                            <p class="text-xs" style="color: rgba(233,216,166,0.55);">{{ $t['r'] }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     STATS
════════════════════════════════════════════ --}}
<section style="background-image: url('https://picsum.photos/seed/statsatlas/1600/600'); background-size: cover; background-position: center; position: relative;">
    <div style="position: absolute; inset: 0; background: rgba(8,30,32,0.82);"></div>
    <div class="relative z-10 mx-auto max-w-5xl px-6 py-20">
        <div class="grid grid-cols-2 gap-6 lg:grid-cols-4">
            @foreach ($stats as $s)
                <div class="atlas-stat-card">
                    <x-dynamic-component :component="'lucide-'.$s['icon']" class="mx-auto mb-3 size-7" style="color: var(--atlas-orange);" />
                    <div class="atlas-heading text-4xl font-extrabold" style="color: var(--atlas-sand);">{{ $s['v'] }}</div>
                    <div class="mt-1 text-sm" style="color: rgba(233,216,166,0.65);">{{ $s['l'] }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     ADVENTURES GALLERY
════════════════════════════════════════════ --}}
<section class="atlas-section-light py-20 lg:py-28">
    <div class="mx-auto max-w-7xl px-6">
        <div class="mb-10 text-center">
            <x-ui.badge class="mb-3" style="background-color: rgba(13,59,62,0.08); color: var(--atlas-teal); border: 1px solid rgba(13,59,62,0.18);">
                <x-lucide-camera class="size-3" /> Gallery
            </x-ui.badge>
            <h2 class="atlas-heading text-3xl font-bold tracking-tight sm:text-4xl" style="color: var(--atlas-teal);">Adventures in frame</h2>
        </div>
        <div class="atlas-gallery">
            @foreach ($gallery as $img)
                <div class="atlas-gallery-item">
                    <img
                        src="https://picsum.photos/seed/{{ $img['seed'] }}/{{ $img['w'] }}/{{ $img['h'] }}"
                        alt="{{ $img['alt'] }}"
                        loading="lazy"
                    />
                </div>
            @endforeach
        </div>
        <div class="mt-8 text-center">
            <x-ui.button variant="outline" style="border-color: var(--atlas-teal); color: var(--atlas-teal);">
                <x-lucide-instagram class="size-4" /> Follow our journey
            </x-ui.button>
        </div>
    </div>
</section>

{{-- ════════════════════════════════════════════
     FAQ
════════════════════════════════════════════ --}}
<section id="faq" class="atlas-section-sand scroll-mt-16 py-20 lg:py-28">
    <div class="mx-auto max-w-3xl px-6">
        <div class="mb-10 text-center">
            <x-ui.badge class="mb-3" style="background-color: rgba(13,59,62,0.10); color: var(--atlas-teal); border: 1px solid rgba(13,59,62,0.18);">
                <x-lucide-help-circle class="size-3" /> FAQ
            </x-ui.badge>
            <h2 class="atlas-heading text-3xl font-bold tracking-tight sm:text-4xl" style="color: var(--atlas-teal);">Good questions, honest answers</h2>
        </div>
        <x-ui.accordion type="single" collapsible class="w-full">
            @foreach ($faqs as $i => $faq)
                <x-ui.accordion-item value="afaq-{{ $i }}">
                    <x-ui.accordion-trigger class="text-left font-medium" style="color: var(--atlas-teal);">{{ $faq['q'] }}</x-ui.accordion-trigger>
                    <x-ui.accordion-content style="color: rgba(13,59,62,0.70);">{{ $faq['a'] }}</x-ui.accordion-content>
                </x-ui.accordion-item>
            @endforeach
        </x-ui.accordion>
    </div>
</section>

{{-- ════════════════════════════════════════════
     NEWSLETTER
════════════════════════════════════════════ --}}
<section style="background-image: url('https://picsum.photos/seed/newslatlas/1600/600'); background-size: cover; background-position: center 60%; position: relative;" class="py-24">
    <div style="position: absolute; inset: 0; background: rgba(8,30,32,0.88);"></div>
    <div class="relative z-10 mx-auto max-w-xl px-6 text-center">
        <x-lucide-send class="mx-auto mb-4 size-8" style="color: var(--atlas-orange);" />
        <h2 class="atlas-heading text-3xl font-bold tracking-tight sm:text-4xl" style="color: var(--atlas-offwhite);">
            Get routes before they sell out
        </h2>
        <p class="mt-3 text-base" style="color: rgba(253,252,247,0.70);">
            New itineraries, early-bird spots and insider guides — to your inbox, once a month.
        </p>
        <form class="mt-8 flex flex-col gap-3 sm:flex-row" @submit.prevent>
            <x-ui.input
                type="email"
                placeholder="your@email.com"
                class="flex-1"
                style="background: rgba(253,252,247,0.95); border: none; color: var(--atlas-teal);"
            />
            <x-ui.button
                type="submit"
                size="lg"
                style="background-color: var(--atlas-orange); color: white; border: none; font-weight: 700; white-space: nowrap;"
            >
                Subscribe <x-lucide-arrow-right class="size-4" />
            </x-ui.button>
        </form>
        <p class="mt-3 text-xs" style="color: rgba(253,252,247,0.40);">No spam. Unsubscribe anytime. We respect your privacy.</p>
    </div>
</section>

{{-- ════════════════════════════════════════════
     FOOTER
════════════════════════════════════════════ --}}
<footer style="background-color: var(--atlas-teal-dark); border-top: 1px solid rgba(233,216,166,0.10);">
    <div class="mx-auto max-w-7xl px-6 py-16">
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-6">
            {{-- Brand --}}
            <div class="lg:col-span-2">
                <a href="#" class="flex items-center gap-2.5 atlas-heading" style="color: var(--atlas-offwhite);">
                    <span style="background-color: var(--atlas-orange);" class="flex size-9 items-center justify-center rounded-lg">
                        <x-lucide-compass class="size-5" style="color: white;" />
                    </span>
                    <span class="text-xl font-bold tracking-tight">Atlas</span>
                </a>
                <p class="mt-3 max-w-xs text-sm" style="color: rgba(233,216,166,0.55);">
                    Small-group adventures to the world's most extraordinary places. Expert guides, seamless logistics.
                </p>
                <div class="mt-5 flex gap-2">
                    @foreach (['instagram', 'twitter', 'youtube', 'facebook'] as $soc)
                        <x-ui.tooltip>
                            <x-ui.tooltip-trigger>
                                <a href="#" aria-label="{{ ucfirst($soc) }}" class="inline-flex size-9 items-center justify-center rounded-lg border transition-colors" style="border-color: rgba(233,216,166,0.20); color: rgba(233,216,166,0.60);">
                                    <x-dynamic-component :component="'lucide-'.$soc" class="size-4" />
                                </a>
                            </x-ui.tooltip-trigger>
                            <x-ui.tooltip-content>{{ ucfirst($soc) }}</x-ui.tooltip-content>
                        </x-ui.tooltip>
                    @endforeach
                </div>
            </div>

            {{-- Links --}}
            @foreach ($footer as $heading => $links)
                <div>
                    <h3 class="text-sm font-semibold" style="color: var(--atlas-sand);">{{ $heading }}</h3>
                    <ul class="mt-3 space-y-2 text-sm">
                        @foreach ($links as $link)
                            <li><a href="#" class="transition-colors" style="color: rgba(233,216,166,0.50);" onmouseover="this.style.color='#e9d8a6'" onmouseout="this.style.color='rgba(233,216,166,0.50)'">{{ $link }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <x-ui.separator class="my-8" style="background-color: rgba(233,216,166,0.12);" />

        <div class="flex flex-col items-center justify-between gap-3 text-sm sm:flex-row" style="color: rgba(233,216,166,0.40);">
            <span>© {{ date('Y') }} Atlas Expeditions. All rights reserved.</span>
            <div class="flex items-center gap-3">
                <x-ui.badge variant="outline" style="border-color: rgba(233,216,166,0.20); color: rgba(233,216,166,0.50); background: transparent;" class="text-[10px]">
                    <x-lucide-leaf class="size-3" /> Carbon-offset trips
                </x-ui.badge>
                <x-ui.badge variant="outline" style="border-color: rgba(233,216,166,0.20); color: rgba(233,216,166,0.50); background: transparent;" class="text-[10px]">
                    <x-lucide-shield-check class="size-3" /> ATOL Protected
                </x-ui.badge>
            </div>
        </div>
    </div>
</footer>

</div>
</x-layouts.app>
