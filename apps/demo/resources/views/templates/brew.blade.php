@php
    /* ------------------------------------------------------------------ *
     *  Brew — Specialty Coffee Roasters  |  BlatUI template
     * ------------------------------------------------------------------ */

    $navLinks = ['Our Coffees' => '#shop', 'Subscribe' => '#subscribe', 'Origins' => '#story', 'Brew Guide' => '#guide'];

    $coffees = [
        ['name' => 'Yirgacheffe Dawn',  'origin' => 'Ethiopia',   'process' => 'Washed',   'roast' => 'Light',  'roastLevel' => 20, 'desc' => 'Jasmine florals, bergamot zest, lemon custard.', 'price' => 18.50, 'rating' => 5, 'reviews' => 214, 'badge' => 'Single Origin', 'seed' => 'coffee1',  'new' => true],
        ['name' => 'Huila Honey',       'origin' => 'Colombia',   'process' => 'Honey',    'roast' => 'Medium', 'roastLevel' => 45, 'desc' => 'Stone fruit, milk chocolate, brown sugar finish.', 'price' => 17.00, 'rating' => 5, 'reviews' => 187, 'badge' => 'Bestseller', 'seed' => 'coffee2',  'new' => false],
        ['name' => 'Sumatra Mandheling', 'origin' => 'Indonesia', 'process' => 'Wet-hulled','roast' => 'Dark',   'roastLevel' => 80, 'desc' => 'Dark cocoa, cedar smoke, earthy velvet body.', 'price' => 16.00, 'rating' => 4, 'reviews' => 132, 'badge' => null,          'seed' => 'coffee3',  'new' => false],
        ['name' => 'Gesha Naturale',    'origin' => 'Panama',     'process' => 'Natural',  'roast' => 'Light',  'roastLevel' => 25, 'desc' => 'Rose, tropical guava, cascading peach sweetness.', 'price' => 32.00, 'rating' => 5, 'reviews' => 98,  'badge' => 'Rare Find', 'seed' => 'coffee4',  'new' => true],
        ['name' => 'Bourbon Classic',   'origin' => 'Rwanda',     'process' => 'Washed',   'roast' => 'Medium', 'roastLevel' => 55, 'desc' => 'Red apple, toffee, gentle spice on the finish.', 'price' => 15.50, 'rating' => 4, 'reviews' => 161, 'badge' => null,          'seed' => 'coffee5',  'new' => false],
        ['name' => 'Espresso Blend No.7','origin' => 'Blend',     'process' => 'Various',  'roast' => 'Medium-Dark','roastLevel'=>65,'desc' => 'Dark cherry, dark choc, crema that lingers.', 'price' => 16.50, 'rating' => 5, 'reviews' => 309, 'badge' => 'Blend',       'seed' => 'coffee6',  'new' => false],
    ];

    $cart = [
        ['name' => 'Yirgacheffe Dawn', 'price' => 18.50, 'qty' => 1, 'seed' => 'coffee1'],
        ['name' => 'Huila Honey',      'price' => 17.00, 'qty' => 2, 'seed' => 'coffee2'],
    ];
    $cartSubtotal = collect($cart)->sum(fn ($l) => $l['price'] * $l['qty']);

    $brewMethods = [
        'pour-over'   => ['label' => 'Pour-Over',    'icon' => 'droplets',  'ratio' => '1:16', 'grind' => 'Medium-Fine', 'temp' => '93 °C', 'time' => '3–4 min',  'steps' => ['Rinse filter, discard water', 'Bloom with 60 ml for 45 s', 'Pour in slow concentric circles', 'Total brew 450 ml', 'Serve & enjoy immediately'], 'img' => 'brew-pour'],
        'espresso'    => ['label' => 'Espresso',     'icon' => 'zap',       'ratio' => '1:2',  'grind' => 'Fine',        'temp' => '92 °C', 'time' => '25–30 s',  'steps' => ['Dial in 18 g dose', 'Tamp level at 30 lb', 'Lock and pre-infuse 5 s', 'Pull 36 g in 28 s', 'Taste, adjust grind if needed'], 'img' => 'brew-esp'],
        'french-press'=> ['label' => 'French Press', 'icon' => 'coffee',    'ratio' => '1:12', 'grind' => 'Coarse',      'temp' => '96 °C', 'time' => '4 min',    'steps' => ['Add 30 g coarse grounds', 'Pour 360 ml off-boil', 'Stir gently, put lid on', 'Steep 4 minutes', 'Press slowly over 30 s'], 'img' => 'brew-fp'],
        'cold-brew'   => ['label' => 'Cold Brew',    'icon' => 'snowflake', 'ratio' => '1:8',  'grind' => 'Coarse',      'temp' => 'Cold',  'time' => '12–18 h',  'steps' => ['Add 100 g coarse grounds to jar', 'Pour 800 ml cold filtered water', 'Stir, seal and refrigerate', 'Steep 12–18 hours', 'Strain through filter, serve over ice'], 'img' => 'brew-cb'],
    ];

    $reviews = [
        ['q' => 'The Yirgacheffe Dawn changed how I think about light roasts. It brews like tea but drinks like a revelation.', 'a' => 'Marta Osei', 'r' => 'Home barista, Berlin', 'seed' => 'face1', 'rating' => 5],
        ['q' => 'Subscription is seamless — fresh bag every two weeks, grind dialled to my espresso machine. Never going back to supermarket beans.', 'a' => 'Tom Cavalier', 'r' => 'Café owner, Lyon', 'seed' => 'face2', 'rating' => 5],
        ['q' => 'The Gesha Naturale is worth every cent. I get compliments from guests every single time I serve it.', 'a' => 'Priya Anand', 'r' => 'Food blogger, Mumbai', 'seed' => 'face3', 'rating' => 5],
        ['q' => 'Kraft packaging is genuinely resealable, beans arrive within days of roasting. This is the real deal.', 'a' => 'James Fallon', 'r' => 'Coffee enthusiast, Dublin', 'seed' => 'face4', 'rating' => 4],
    ];

    $roastGuide = [
        ['name' => 'Yirgacheffe Dawn',   'level' => 20],
        ['name' => 'Gesha Naturale',     'level' => 25],
        ['name' => 'Huila Honey',        'level' => 45],
        ['name' => 'Bourbon Classic',    'level' => 55],
        ['name' => 'Espresso Blend No.7','level' => 65],
        ['name' => 'Sumatra Mandheling', 'level' => 80],
    ];

    $faqs = [
        ['q' => 'When do you roast?', 'a' => 'Every Monday and Thursday. Bags are shipped the same day so you receive beans within 48 hours of leaving the drum.'],
        ['q' => 'Can I choose my grind?', 'a' => 'Yes — whole bean, coarse (French Press / Cold Brew), medium, medium-fine (Pour-Over / AeroPress) or fine (Espresso / Moka Pot).'],
        ['q' => 'How does the subscription work?', 'a' => 'Pick a coffee, bag size, grind and delivery frequency. Pause, skip or cancel any time from your account — no phone calls.'],
        ['q' => 'Is the packaging recyclable?', 'a' => 'Our kraft bags are home-compostable and the tins are infinitely recyclable. We offset all shipping emissions.'],
        ['q' => 'Do you offer wholesale?', 'a' => 'Yes — cafés and restaurants get preferred pricing, dedicated sourcing and a free cupping session. Email hello@brew.coffee.'],
    ];

    $values = ['Small-batch roasting', 'Direct trade', 'Carbon-neutral delivery', 'Home-compostable packaging', 'Freshness guarantee', 'Farmer-first pricing', 'Zero-waste lab', 'Traceable to the farm'];

    $gallery = [
        ['src' => 'https://picsum.photos/seed/brewg1/1400/1000', 'thumb' => 'https://picsum.photos/seed/brewg1/600/600', 'alt' => 'Coffee farm at sunrise'],
        ['src' => 'https://picsum.photos/seed/brewg2/1400/1000', 'thumb' => 'https://picsum.photos/seed/brewg2/600/600', 'alt' => 'Sorting coffee cherries by hand'],
        ['src' => 'https://picsum.photos/seed/brewg3/1400/1000', 'thumb' => 'https://picsum.photos/seed/brewg3/600/600', 'alt' => 'Roasting drum interior'],
        ['src' => 'https://picsum.photos/seed/brewg4/1400/1000', 'thumb' => 'https://picsum.photos/seed/brewg4/600/600', 'alt' => 'Freshly pulled espresso shot'],
        ['src' => 'https://picsum.photos/seed/brewg5/1400/1000', 'thumb' => 'https://picsum.photos/seed/brewg5/600/600', 'alt' => 'Barista pouring latte art'],
        ['src' => 'https://picsum.photos/seed/brewg6/1400/1000', 'thumb' => 'https://picsum.photos/seed/brewg6/600/600', 'alt' => 'Kraft bag sealed on roast-day'],
    ];

    $footerLinks = [
        'Roastery'  => ['Our Story', 'The Roasters', 'Sourcing', 'Sustainability', 'Press'],
        'Shop'      => ['All Coffees', 'Subscriptions', 'Gift Cards', 'Merchandise', 'Sale'],
        'Brew Help' => ['Brewing Guides', 'Grind Chart', 'Track Order', 'Returns', 'Contact'],
    ];
@endphp

<x-layouts.app title="Brew — Specialty Coffee Roasters">

{{-- ═══════════════════════════════════════════════
     OWN DESIGN SYSTEM — scoped to #tpl-brew
═══════════════════════════════════════════════ --}}
<style>
@import url('https://fonts.bunny.net/css?family=fraunces:400,500,600,700&display=swap');

/* ── Tokens ─────────────────────────────────────── */
#tpl-brew {
  --brew-kraft:   #d9c2a3;
  --brew-cream:   #f4ece1;
  --brew-espresso:#3b2417;
  --brew-caramel: #a9744f;
  --brew-roast:   #7c2d12;
  --brew-deep:    #1f1611;
  --brew-light:   #fdf8f2;
  --brew-border:  #c9ab88;

  background: var(--brew-cream);
  color: var(--brew-espresso);
  font-family: Inter, sans-serif;
}

/* ── Typography ─────────────────────────────────── */
#tpl-brew .brew-serif {
  font-family: 'Fraunces', Georgia, serif;
}

/* ── Paper texture overlay ──────────────────────── */
#tpl-brew .brew-paper {
  position: relative;
}
#tpl-brew .brew-paper::before {
  content: '';
  position: absolute;
  inset: 0;
  pointer-events: none;
  background-image:
    url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='n'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23n)' opacity='0.04'/%3E%3C/svg%3E");
  background-repeat: repeat;
  background-size: 200px 200px;
  opacity: 0.6;
  z-index: 0;
  border-radius: inherit;
}
#tpl-brew .brew-paper > * { position: relative; z-index: 1; }

/* ── Stamp / seal badge ─────────────────────────── */
#tpl-brew .brew-stamp {
  display: inline-flex;
  align-items: center;
  justify-content: center;
  border-radius: 9999px;
  border: 2.5px dashed var(--brew-caramel);
  background: var(--brew-light);
  color: var(--brew-roast);
  font-family: 'Fraunces', Georgia, serif;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.08em;
  font-size: 0.6rem;
  padding: 0.6rem 0.85rem;
  box-shadow: inset 0 0 0 2px var(--brew-cream), 0 1px 4px rgba(59,36,23,0.15);
  line-height: 1.2;
  text-align: center;
}

/* ── Hand-drawn underline ───────────────────────── */
#tpl-brew .brew-underline {
  text-decoration: underline;
  text-decoration-style: wavy;
  text-underline-offset: 5px;
  text-decoration-color: var(--brew-caramel);
  text-decoration-thickness: 2px;
}

/* ── Steam animation ────────────────────────────── */
@keyframes brew-steam {
  0%   { transform: translateY(0)    scaleX(1);   opacity: 0.55; }
  50%  { transform: translateY(-22px) scaleX(1.2); opacity: 0.25; }
  100% { transform: translateY(-44px) scaleX(0.8); opacity: 0; }
}
@media (prefers-reduced-motion: reduce) {
  @keyframes brew-steam { 0%, 100% { opacity: 0; } }
}
#tpl-brew .brew-steam-wisp {
  animation: brew-steam 2.4s ease-in-out infinite;
  filter: blur(5px);
  border-radius: 50%;
  background: rgba(249,243,236,0.9);
  position: absolute;
  width: 14px;
  height: 36px;
}
#tpl-brew .brew-steam-wisp:nth-child(2) { animation-delay: 0.8s; }
#tpl-brew .brew-steam-wisp:nth-child(3) { animation-delay: 1.6s; }

/* ── Roast-level bar colours ────────────────────── */
#tpl-brew .brew-roast-fill {
  background: linear-gradient(to right, #d4a96a 0%, #a9744f 40%, #7c2d12 70%, #3b2417 100%);
  height: 100%;
  border-radius: 9999px;
  transition: width 0.6s cubic-bezier(.4,0,.2,1);
}

/* ── Product card hover ─────────────────────────── */
#tpl-brew .brew-card {
  background: var(--brew-light);
  border: 1.5px solid var(--brew-border);
  border-radius: 1.25rem;
  transition: transform 0.22s ease, box-shadow 0.22s ease;
}
#tpl-brew .brew-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 12px 32px rgba(59,36,23,0.14);
}

/* ── Section backgrounds ────────────────────────── */
#tpl-brew .brew-bg-kraft  { background: var(--brew-kraft);   }
#tpl-brew .brew-bg-espresso { background: var(--brew-espresso); color: var(--brew-cream); }
#tpl-brew .brew-bg-cream  { background: var(--brew-cream);   }
#tpl-brew .brew-bg-light  { background: var(--brew-light);   }

/* ── Buttons ────────────────────────────────────── */
#tpl-brew .brew-btn-primary {
  background: var(--brew-espresso);
  color: var(--brew-cream);
  border: none;
  border-radius: 0.6rem;
  padding: 0.6rem 1.4rem;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: background 0.18s ease, transform 0.18s ease;
}
#tpl-brew .brew-btn-primary:hover { background: var(--brew-roast); transform: translateY(-1px); }
#tpl-brew .brew-btn-outline {
  background: transparent;
  color: var(--brew-espresso);
  border: 2px solid var(--brew-caramel);
  border-radius: 0.6rem;
  padding: 0.55rem 1.35rem;
  font-size: 0.875rem;
  font-weight: 600;
  cursor: pointer;
  display: inline-flex;
  align-items: center;
  gap: 0.5rem;
  transition: background 0.18s ease, color 0.18s ease;
}
#tpl-brew .brew-btn-outline:hover { background: var(--brew-caramel); color: var(--brew-light); }

/* ── Roast badge pills ──────────────────────────── */
#tpl-brew .brew-badge-light       { background:#fef3c7; color:#92400e; border:1px solid #fde68a; }
#tpl-brew .brew-badge-medium      { background:#fed7aa; color:#9a3412; border:1px solid #fdba74; }
#tpl-brew .brew-badge-medium-dark { background:#fca5a5; color:#7f1d1d; border:1px solid #f87171; }
#tpl-brew .brew-badge-dark        { background:#3b2417; color:#f4ece1; border:1px solid #7c2d12; }

/* ── Separator ──────────────────────────────────── */
#tpl-brew .brew-separator {
  border: none;
  height: 1px;
  background: var(--brew-border);
  opacity: 0.5;
}

/* ── Override BlatUI tokens inside tpl-brew ─────── */
#tpl-brew [data-slot="badge"]   { font-family: inherit; }
#tpl-brew [data-slot="button"]  { font-family: inherit; }
#tpl-brew [data-slot="tabs-list"]    { background: rgba(217,194,163,0.35); }
#tpl-brew [data-slot="tabs-trigger"][data-state="active"] { background: var(--brew-light); color: var(--brew-espresso); }
#tpl-brew [data-slot="accordion-item"] { border-color: var(--brew-border); }
#tpl-brew [data-slot="accordion-trigger"] { color: var(--brew-espresso); }
#tpl-brew [data-slot="accordion-content"] { color: color-mix(in srgb,var(--brew-espresso) 75%,transparent); }
#tpl-brew [data-slot="slider-track"]  { background: rgba(217,194,163,0.6); }
#tpl-brew [data-slot="slider-range"]  { background: var(--brew-caramel); }
#tpl-brew [data-slot="slider-thumb"]  { border-color: var(--brew-caramel); }
#tpl-brew [data-slot="rating"] button { color: var(--brew-caramel); }
#tpl-brew [data-slot="quote"] blockquote { font-family: 'Fraunces', Georgia, serif; }
#tpl-brew [data-slot="separator"] { background: var(--brew-border); opacity: 0.5; }
#tpl-brew [data-slot="input"] {
  background: var(--brew-light);
  border-color: var(--brew-border);
  color: var(--brew-espresso);
}
#tpl-brew [data-slot="input"]:focus-visible {
  border-color: var(--brew-caramel);
  --tw-ring-color: rgba(169,116,79,0.35);
}
#tpl-brew [data-slot="carousel-previous"],
#tpl-brew [data-slot="carousel-next"] {
  background: var(--brew-light);
  border-color: var(--brew-border);
  color: var(--brew-espresso);
}
</style>

<div id="tpl-brew">

{{-- ── TOP ANNOUNCEMENT BAR ──────────────────────── --}}
<x-ui.banner tone="warning" id="brew-shipping" persist>
    <x-lucide-truck class="size-4" />
    <span>Free shipping on orders over €40 · Roasted every Monday &amp; Thursday</span>
    <a href="#shop" class="font-semibold underline underline-offset-2">Shop now</a>
</x-ui.banner>

{{-- ── NAVIGATION ───────────────────────────────── --}}
<header style="background:rgba(244,236,225,0.88);border-bottom:1px solid var(--brew-border);backdrop-filter:blur(14px);" class="sticky top-0 z-40">
    <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-4 lg:px-6">

        {{-- Wordmark --}}
        <a href="#" class="brew-serif flex items-center gap-2" style="color:var(--brew-espresso);font-size:1.5rem;font-weight:700;letter-spacing:-0.02em;" aria-label="Brew home">
            <span class="brew-stamp" style="width:2rem;height:2rem;padding:0;font-size:0.5rem;">☕</span>
            Brew
        </a>

        {{-- Desktop nav --}}
        <nav class="ml-6 hidden items-center gap-1 md:flex" aria-label="Main navigation">
            @foreach ($navLinks as $label => $href)
                <a href="{{ $href }}"
                   style="color:var(--brew-espresso);font-size:0.875rem;font-weight:500;"
                   class="rounded-md px-3 py-1.5 transition-colors hover:bg-amber-100/60">{{ $label }}</a>
            @endforeach
        </nav>

        <div class="ml-auto flex items-center gap-2">
            {{-- Cart drawer --}}
            <x-ui.sheet>
                <x-ui.sheet-trigger>
                    <button class="relative inline-flex size-9 items-center justify-center rounded-md transition-colors hover:bg-amber-100/60" aria-label="Open cart" style="color:var(--brew-espresso);">
                        <x-lucide-shopping-bag class="size-5" />
                        <span class="absolute -right-0.5 -top-0.5 flex size-4 items-center justify-center rounded-full text-[10px] font-bold"
                              style="background:var(--brew-roast);color:var(--brew-cream);">{{ count($cart) }}</span>
                    </button>
                </x-ui.sheet-trigger>
                <x-ui.sheet-content side="right" class="flex flex-col">
                    <x-ui.sheet-header>
                        <x-ui.sheet-title class="brew-serif" style="color:var(--brew-espresso);">Your cart</x-ui.sheet-title>
                        <x-ui.sheet-description>{{ count($cart) }} bags · ships within 48 h of roasting</x-ui.sheet-description>
                    </x-ui.sheet-header>
                    <div class="flex-1 space-y-4 overflow-auto px-4">
                        @foreach ($cart as $line)
                            <div class="flex gap-3">
                                <img src="https://picsum.photos/seed/{{ $line['seed'] }}/160/160"
                                     alt="{{ $line['name'] }}"
                                     class="size-16 shrink-0 rounded-xl border object-cover"
                                     style="border-color:var(--brew-border);" />
                                <div class="min-w-0 flex-1">
                                    <div class="flex items-start justify-between gap-2">
                                        <span class="truncate text-sm font-semibold" style="color:var(--brew-espresso);">{{ $line['name'] }}</span>
                                        <button class="opacity-50 hover:opacity-100" aria-label="Remove {{ $line['name'] }}" style="color:var(--brew-espresso);"><x-lucide-x class="size-4" /></button>
                                    </div>
                                    <div class="mt-1 flex items-center justify-between text-sm" style="color:color-mix(in srgb,var(--brew-espresso) 60%,transparent);">
                                        <span>Qty {{ $line['qty'] }}</span>
                                        <span class="font-semibold" style="color:var(--brew-espresso);">€{{ number_format($line['price'] * $line['qty'], 2) }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <x-ui.sheet-footer>
                        <div class="mb-1 flex items-center justify-between text-sm">
                            <span style="color:color-mix(in srgb,var(--brew-espresso) 60%,transparent);">Subtotal</span>
                            <span class="brew-serif text-lg font-bold" style="color:var(--brew-espresso);">€{{ number_format($cartSubtotal, 2) }}</span>
                        </div>
                        <button type="button" class="brew-btn-primary w-full justify-center">Checkout <x-lucide-arrow-right class="size-4" /></button>
                        <button type="button" class="brew-btn-outline w-full justify-center" x-on:click="open = false">Continue shopping</button>
                    </x-ui.sheet-footer>
                </x-ui.sheet-content>
            </x-ui.sheet>

            {{-- Mobile menu --}}
            <x-ui.sheet>
                <x-ui.sheet-trigger class="md:hidden">
                    <button class="inline-flex size-9 items-center justify-center rounded-md transition-colors hover:bg-amber-100/60" aria-label="Open navigation menu" style="color:var(--brew-espresso);">
                        <x-lucide-menu class="size-5" />
                    </button>
                </x-ui.sheet-trigger>
                <x-ui.sheet-content side="left">
                    <x-ui.sheet-header>
                        <x-ui.sheet-title class="brew-serif" style="color:var(--brew-espresso);">Brew</x-ui.sheet-title>
                    </x-ui.sheet-header>
                    <nav class="grid gap-1 px-4 text-sm" aria-label="Mobile navigation">
                        @foreach ($navLinks as $label => $href)
                            <a href="{{ $href }}" @click="open = false"
                               class="rounded-md px-3 py-2 font-medium hover:bg-amber-100/60"
                               style="color:var(--brew-espresso);">{{ $label }}</a>
                        @endforeach
                    </nav>
                </x-ui.sheet-content>
            </x-ui.sheet>
        </div>
    </div>
</header>

{{-- ── HERO ──────────────────────────────────────── --}}
<section class="brew-paper brew-bg-light relative overflow-hidden border-b" style="border-color:var(--brew-border);" aria-label="Hero">
    {{-- Warm gradient blob --}}
    <div class="pointer-events-none absolute inset-0 -z-10 overflow-hidden" aria-hidden="true">
        <div class="absolute -left-32 -top-20 size-[42rem] rounded-full opacity-30"
             style="background:radial-gradient(circle,#d9c2a3,transparent 70%);"></div>
        <div class="absolute -bottom-24 right-0 size-[30rem] rounded-full opacity-20"
             style="background:radial-gradient(circle,#a9744f,transparent 70%);"></div>
    </div>

    <div class="mx-auto grid max-w-7xl items-center gap-10 px-4 py-20 lg:grid-cols-2 lg:py-28 lg:px-6">

        {{-- Copy --}}
        <div class="max-w-xl">
            <div class="mb-5 flex flex-wrap gap-2">
                <x-ui.badge tone="warning" variant="soft">
                    <x-lucide-leaf class="size-3" /> Single origin
                </x-ui.badge>
                <x-ui.badge tone="neutral" variant="outline">
                    Roasted to order
                </x-ui.badge>
            </div>

            <h1 class="brew-serif text-balance text-5xl font-bold leading-none tracking-tight sm:text-6xl lg:text-7xl"
                style="color:var(--brew-espresso);">
                Freshly<br/>
                <span class="brew-underline" style="color:var(--brew-roast);">Roasted,</span><br/>
                Shipped Weekly.
            </h1>

            <p class="mt-5 text-balance text-lg" style="color:color-mix(in srgb,var(--brew-espresso) 70%,transparent);">
                We source rare lots direct from farmers, roast in small batches and ship the same day. Specialty coffee the way it should be — fresh, traceable, extraordinary.
            </p>

            <div class="mt-7 flex flex-wrap gap-3">
                <a href="#shop" class="brew-btn-primary">
                    <x-lucide-shopping-bag class="size-4" /> Shop Coffees
                </a>
                <a href="#subscribe" class="brew-btn-outline">
                    <x-lucide-refresh-cw class="size-4" /> Subscribe &amp; Save
                </a>
            </div>

            <div class="mt-8 flex items-center gap-4">
                <div class="flex -space-x-2">
                    @foreach (['face1','face2','face3','face4'] as $fs)
                        <x-ui.avatar class="ring-2 size-9" style="--tw-ring-color:var(--brew-cream);">
                            <x-ui.avatar-image src="https://picsum.photos/seed/{{ $fs }}/80/80" alt="Customer" />
                            <x-ui.avatar-fallback style="background:var(--brew-kraft);color:var(--brew-espresso);">☕</x-ui.avatar-fallback>
                        </x-ui.avatar>
                    @endforeach
                </div>
                <div class="text-sm">
                    <x-ui.rating :value="5" readonly size="sm" color="text-amber-500" />
                    <span style="color:color-mix(in srgb,var(--brew-espresso) 65%,transparent);">
                        Loved by <strong style="color:var(--brew-espresso);">4,200+</strong> coffee lovers
                    </span>
                </div>
            </div>
        </div>

        {{-- Hero image + steam --}}
        <div class="relative flex items-center justify-center">
            {{-- Big round image --}}
            <div class="relative mx-auto aspect-square w-full max-w-sm overflow-hidden rounded-full border-4 shadow-2xl"
                 style="border-color:var(--brew-caramel);">
                <img src="https://picsum.photos/seed/brewhero/640/640"
                     alt="A freshly brewed cup of specialty coffee"
                     class="size-full object-cover" />
            </div>

            {{-- Steam wisps --}}
            <div class="absolute left-1/2 top-6 flex -translate-x-1/2 gap-3" aria-hidden="true">
                <div class="brew-steam-wisp" style="left:45%;top:-20px;position:absolute;"></div>
                <div class="brew-steam-wisp" style="left:50%;top:-14px;position:absolute;animation-delay:0.8s;"></div>
                <div class="brew-steam-wisp" style="left:55%;top:-18px;position:absolute;animation-delay:1.6s;"></div>
            </div>

            {{-- Floating stamp badge --}}
            <div class="brew-stamp absolute -right-2 bottom-12 size-24 flex-col leading-tight" aria-label="Roasted to order">
                Roasted<br/>to order<br/><span style="font-size:0.7rem;">🫘</span>
            </div>

            {{-- Floating score badge --}}
            <div class="brew-stamp absolute -left-4 top-16 flex-col"
                 style="font-size:0.55rem;padding:0.7rem;line-height:1.4;" aria-label="Specialty grade 90 plus">
                Specialty<br/>Grade<br/><span style="font-size:1rem;font-weight:900;">90+</span>
            </div>
        </div>
    </div>
</section>

{{-- ── VALUES MARQUEE ────────────────────────────── --}}
<section class="brew-bg-espresso overflow-hidden py-4" aria-label="Our values">
    <x-ui.marquee :duration="'38s'" class="text-sm font-medium" style="color:var(--brew-kraft);">
        @foreach ($values as $v)
            <span class="flex items-center gap-2 px-4 whitespace-nowrap">
                <span style="color:var(--brew-caramel);">✦</span> {{ $v }}
            </span>
        @endforeach
    </x-ui.marquee>
</section>

{{-- ── SHOP GRID ─────────────────────────────────── --}}
<section id="shop" class="brew-bg-light brew-paper scroll-mt-20 py-20 lg:py-28" aria-labelledby="shop-heading">
    <div class="mx-auto max-w-7xl px-4 lg:px-6">

        <div class="mb-12 text-center">
            <x-ui.badge tone="warning" variant="soft" class="mb-3">
                <x-lucide-coffee class="size-3" /> Our Coffees
            </x-ui.badge>
            <h2 id="shop-heading" class="brew-serif text-4xl font-bold tracking-tight sm:text-5xl"
                style="color:var(--brew-espresso);">
                Pick Your <span class="brew-underline" style="color:var(--brew-roast);">Perfect Cup</span>
            </h2>
            <p class="mx-auto mt-3 max-w-xl text-balance text-base"
               style="color:color-mix(in srgb,var(--brew-espresso) 65%,transparent);">
                Every lot is cupped, scored and sourced direct. We update the menu with each harvest.
            </p>
        </div>

        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($coffees as $coffee)
                <article class="brew-card group overflow-hidden" aria-label="{{ $coffee['name'] }} coffee">
                    {{-- Image --}}
                    <div class="relative aspect-[4/3] overflow-hidden rounded-t-[calc(1.25rem-1.5px)]">
                        <img src="https://picsum.photos/seed/{{ $coffee['seed'] }}/600/450"
                             alt="{{ $coffee['name'] }} from {{ $coffee['origin'] }}"
                             loading="lazy"
                             class="size-full object-cover transition-transform duration-300 group-hover:scale-105" />

                        {{-- Roast badge --}}
                        @php
                            $rb = match(strtolower($coffee['roast'])) {
                                'light' => 'brew-badge-light',
                                'medium' => 'brew-badge-medium',
                                'medium-dark' => 'brew-badge-medium-dark',
                                default => 'brew-badge-dark',
                            };
                        @endphp
                        <span class="{{ $rb }} absolute left-3 top-3 rounded-full px-2.5 py-0.5 text-xs font-semibold"
                              aria-label="Roast level: {{ $coffee['roast'] }}">
                            {{ $coffee['roast'] }}
                        </span>

                        @if ($coffee['new'])
                            <x-ui.badge tone="success" variant="solid" class="absolute right-3 top-3">New</x-ui.badge>
                        @elseif ($coffee['badge'])
                            <x-ui.badge tone="warning" variant="soft" class="absolute right-3 top-3">{{ $coffee['badge'] }}</x-ui.badge>
                        @endif

                        {{-- Hover CTA --}}
                        <div class="absolute inset-x-3 bottom-3 translate-y-2 opacity-0 transition-all duration-200 group-hover:translate-y-0 group-hover:opacity-100">
                            <button type="button" class="brew-btn-primary w-full justify-center">
                                <x-lucide-shopping-bag class="size-4" /> Add to cart
                            </button>
                        </div>
                    </div>

                    {{-- Details --}}
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-2">
                            <div>
                                <p class="text-xs font-medium uppercase tracking-wider"
                                   style="color:var(--brew-caramel);">{{ $coffee['origin'] }} · {{ $coffee['process'] }}</p>
                                <h3 class="brew-serif mt-0.5 text-lg font-semibold leading-snug"
                                    style="color:var(--brew-espresso);">{{ $coffee['name'] }}</h3>
                            </div>
                            <x-ui.tooltip>
                                <x-ui.tooltip-trigger>
                                    <span class="brew-stamp" style="font-size:0.5rem;padding:0.4rem 0.6rem;cursor:help;" aria-label="View roast info">
                                        {{ $coffee['roast'] }}
                                    </span>
                                </x-ui.tooltip-trigger>
                                <x-ui.tooltip-content style="background:var(--brew-espresso);color:var(--brew-cream);">
                                    Roast level: {{ $coffee['roast'] }}<br>Process: {{ $coffee['process'] }}
                                </x-ui.tooltip-content>
                            </x-ui.tooltip>
                        </div>

                        <p class="mt-2 text-sm" style="color:color-mix(in srgb,var(--brew-espresso) 65%,transparent);">
                            {{ $coffee['desc'] }}
                        </p>

                        <div class="mt-3 flex items-center gap-2">
                            <x-ui.rating :value="$coffee['rating']" readonly size="sm" color="text-amber-500" />
                            <span class="text-xs" style="color:color-mix(in srgb,var(--brew-espresso) 50%,transparent);">
                                ({{ $coffee['reviews'] }})
                            </span>
                        </div>

                        <div class="mt-3 flex items-center justify-between">
                            <span class="brew-serif text-2xl font-bold" style="color:var(--brew-espresso);">
                                €{{ number_format($coffee['price'], 2) }}
                            </span>
                            <span class="text-xs" style="color:color-mix(in srgb,var(--brew-espresso) 50%,transparent);">per 250 g</span>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ── SUBSCRIPTION BUILDER ──────────────────────── --}}
<section id="subscribe" class="brew-bg-kraft brew-paper scroll-mt-20 border-y py-20 lg:py-28" style="border-color:var(--brew-border);" aria-labelledby="sub-heading">
    <div class="mx-auto max-w-4xl px-4 lg:px-6">

        <div class="mb-10 text-center">
            <x-ui.badge tone="warning" variant="solid" class="mb-3">
                <x-lucide-refresh-cw class="size-3" /> Subscribe &amp; Save 15%
            </x-ui.badge>
            <h2 id="sub-heading" class="brew-serif text-4xl font-bold tracking-tight sm:text-5xl"
                style="color:var(--brew-espresso);">Build Your Subscription</h2>
            <p class="mt-3 text-base" style="color:color-mix(in srgb,var(--brew-espresso) 65%,transparent);">
                Fresh beans on your schedule. Pause or cancel any time, no questions.
            </p>
        </div>

        <x-ui.tabs value="pick" class="mx-auto w-full">
            <x-ui.tabs-list class="mx-auto mb-8 grid w-full max-w-sm grid-cols-3">
                <x-ui.tabs-trigger value="pick">1. Pick Coffee</x-ui.tabs-trigger>
                <x-ui.tabs-trigger value="grind">2. Grind &amp; Size</x-ui.tabs-trigger>
                <x-ui.tabs-trigger value="schedule">3. Schedule</x-ui.tabs-trigger>
            </x-ui.tabs-list>

            {{-- Step 1 --}}
            <x-ui.tabs-content value="pick">
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach (array_slice($coffees, 0, 6) as $c)
                        <label class="brew-card cursor-pointer p-4 transition-all has-[:checked]:ring-2"
                               style="--tw-ring-color:var(--brew-caramel);">
                            <input type="radio" name="sub-coffee" value="{{ $c['name'] }}" class="sr-only" @if ($loop->first) checked @endif />
                            <img src="https://picsum.photos/seed/{{ $c['seed'] }}/300/200"
                                 alt="{{ $c['name'] }}"
                                 class="mb-3 h-28 w-full rounded-lg object-cover" />
                            <p class="brew-serif font-semibold text-sm" style="color:var(--brew-espresso);">{{ $c['name'] }}</p>
                            <p class="text-xs mt-0.5" style="color:color-mix(in srgb,var(--brew-espresso) 55%,transparent);">{{ $c['origin'] }}</p>
                        </label>
                    @endforeach
                </div>
                <div class="mt-6 text-center">
                    <button type="button" class="brew-btn-primary" onclick="this.closest('[data-slot=tabs]')._x_dataStack[0].tab = 'grind'">
                        Next: Grind &amp; Size <x-lucide-arrow-right class="size-4" />
                    </button>
                </div>
            </x-ui.tabs-content>

            {{-- Step 2 --}}
            <x-ui.tabs-content value="grind">
                <div class="mx-auto max-w-md space-y-6">
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold" style="color:var(--brew-espresso);" for="grind-select">Grind preference</label>
                        <x-ui.select name="grind" value="whole-bean" native id="grind-select"
                            :options="['whole-bean' => 'Whole Bean', 'coarse' => 'Coarse (French Press / Cold Brew)', 'medium' => 'Medium (Drip / AeroPress)', 'medium-fine' => 'Medium-Fine (Pour-Over)', 'fine' => 'Fine (Espresso / Moka Pot)']" />
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold" style="color:var(--brew-espresso);" for="size-select">Bag size</label>
                        <x-ui.select name="bag_size" value="250g" native id="size-select"
                            :options="['250g' => '250 g — €16–€32', '500g' => '500 g — €30–€60 (save 8%)', '1kg' => '1 kg — €55–€110 (save 14%)']" />
                    </div>
                    <p class="rounded-xl border p-4 text-sm" style="border-color:var(--brew-border);background:var(--brew-light);color:color-mix(in srgb,var(--brew-espresso) 70%,transparent);">
                        <x-lucide-info class="mb-0.5 mr-1 inline size-4" style="color:var(--brew-caramel);" />
                        We grind to order on roast day. Whole bean keeps freshest — buy a grinder from our <a href="#" class="underline underline-offset-2" style="color:var(--brew-caramel);">gear shop</a>.
                    </p>
                </div>
                <div class="mt-6 flex justify-center gap-3">
                    <button type="button" class="brew-btn-outline" onclick="this.closest('[data-slot=tabs]')._x_dataStack[0].tab = 'pick'">
                        <x-lucide-arrow-left class="size-4" /> Back
                    </button>
                    <button type="button" class="brew-btn-primary" onclick="this.closest('[data-slot=tabs]')._x_dataStack[0].tab = 'schedule'">
                        Next: Schedule <x-lucide-arrow-right class="size-4" />
                    </button>
                </div>
            </x-ui.tabs-content>

            {{-- Step 3 --}}
            <x-ui.tabs-content value="schedule">
                <div class="mx-auto max-w-md space-y-6">
                    <div>
                        <label class="mb-1.5 block text-sm font-semibold" style="color:var(--brew-espresso);" for="freq-select">Delivery frequency</label>
                        <x-ui.select name="frequency" value="2-weeks" native id="freq-select"
                            :options="['1-week' => 'Every week', '2-weeks' => 'Every 2 weeks (most popular)', '3-weeks' => 'Every 3 weeks', '4-weeks' => 'Every 4 weeks']" />
                    </div>
                    <div class="rounded-2xl border p-5 text-sm space-y-2" style="border-color:var(--brew-border);background:var(--brew-light);">
                        <p class="brew-serif font-semibold text-base" style="color:var(--brew-espresso);">Your subscription</p>
                        <div class="flex justify-between"><span style="color:color-mix(in srgb,var(--brew-espresso) 60%,transparent);">Coffee</span><span style="color:var(--brew-espresso);">Huila Honey</span></div>
                        <div class="flex justify-between"><span style="color:color-mix(in srgb,var(--brew-espresso) 60%,transparent);">Grind</span><span style="color:var(--brew-espresso);">Whole Bean</span></div>
                        <div class="flex justify-between"><span style="color:color-mix(in srgb,var(--brew-espresso) 60%,transparent);">Size</span><span style="color:var(--brew-espresso);">250 g</span></div>
                        <div class="flex justify-between"><span style="color:color-mix(in srgb,var(--brew-espresso) 60%,transparent);">Frequency</span><span style="color:var(--brew-espresso);">Every 2 weeks</span></div>
                        <hr class="brew-separator" />
                        <div class="flex justify-between font-bold"><span style="color:var(--brew-espresso);">Price per delivery</span><span class="brew-serif text-lg" style="color:var(--brew-roast);">€14.45 <span class="text-xs line-through opacity-50">€17.00</span></span></div>
                    </div>
                </div>
                <div class="mt-6 flex justify-center gap-3">
                    <button type="button" class="brew-btn-outline" onclick="this.closest('[data-slot=tabs]')._x_dataStack[0].tab = 'grind'">
                        <x-lucide-arrow-left class="size-4" /> Back
                    </button>
                    <button type="button" class="brew-btn-primary">
                        <x-lucide-check class="size-4" /> Start My Subscription
                    </button>
                </div>
            </x-ui.tabs-content>
        </x-ui.tabs>
    </div>
</section>

{{-- ── ORIGIN / STORY SPLIT ──────────────────────── --}}
<section id="story" class="brew-bg-light scroll-mt-20 overflow-hidden border-b py-0" style="border-color:var(--brew-border);" aria-labelledby="story-heading">
    <div class="mx-auto grid max-w-7xl lg:grid-cols-2">

        {{-- Image side --}}
        <div class="relative min-h-[380px] overflow-hidden lg:min-h-[560px]">
            <img src="https://picsum.photos/seed/brewfarm/900/700"
                 alt="Coffee farmers sorting cherries on raised drying beds in Ethiopia"
                 class="size-full object-cover" />
            <div class="absolute inset-0" style="background:linear-gradient(to right,transparent 60%,var(--brew-light));" aria-hidden="true"></div>
        </div>

        {{-- Text side --}}
        <div class="flex flex-col justify-center px-8 py-16 lg:px-14">
            <x-ui.badge tone="warning" variant="soft" class="mb-4 w-fit">
                <x-lucide-map-pin class="size-3" /> Our Origins
            </x-ui.badge>
            <h2 id="story-heading" class="brew-serif text-4xl font-bold leading-snug tracking-tight"
                style="color:var(--brew-espresso);">
                From Hillside<br/>to Your Cup
            </h2>

            <x-ui.separator class="my-6" />

            <x-ui.quote
                author="Abebe Girma"
                role="Fourth-generation farmer, Yirgacheffe Co-op"
                avatar="https://picsum.photos/seed/farmer1/80/80"
                class="mb-6"
            >
                We pick every cherry by hand at peak ripeness. When a roaster pays a fair price and tells the story, we can invest in the next generation.
            </x-ui.quote>

            <p class="text-base leading-relaxed" style="color:color-mix(in srgb,var(--brew-espresso) 72%,transparent);">
                Brew travels to origin twice a year, cupping alongside farmers before buying. No brokers, no middlemen — just direct relationships that benefit both the grower and your morning ritual. Every bag is stamped with the farm name, harvest date and cupping score.
            </p>

            <div class="mt-7 flex flex-wrap gap-3">
                @foreach (['Ethiopia', 'Colombia', 'Panama', 'Rwanda', 'Indonesia'] as $origin)
                    <x-ui.badge tone="warning" variant="soft" class="gap-1">
                        <x-lucide-map-pin class="size-2.5" /> {{ $origin }}
                    </x-ui.badge>
                @endforeach
            </div>
        </div>
    </div>
</section>

{{-- ── ROAST GUIDE ───────────────────────────────── --}}
<section id="guide" class="brew-bg-cream brew-paper scroll-mt-20 border-b py-20 lg:py-28" style="border-color:var(--brew-border);" aria-labelledby="roast-heading">
    <div class="mx-auto max-w-4xl px-4 lg:px-6">
        <div class="mb-10 text-center">
            <x-ui.badge tone="warning" variant="soft" class="mb-3">
                <x-lucide-thermometer class="size-3" /> Roast Guide
            </x-ui.badge>
            <h2 id="roast-heading" class="brew-serif text-4xl font-bold tracking-tight sm:text-5xl"
                style="color:var(--brew-espresso);">
                Light <span style="color:var(--brew-border);">→</span> Dark
            </h2>
            <p class="mt-3 text-base" style="color:color-mix(in srgb,var(--brew-espresso) 65%,transparent);">
                Drag the slider to explore each coffee's roast character.
            </p>
        </div>

        <div class="space-y-6">
            @foreach ($roastGuide as $r)
                <div class="flex items-center gap-4">
                    <span class="w-44 shrink-0 truncate text-sm font-medium" style="color:var(--brew-espresso);">{{ $r['name'] }}</span>
                    <div class="flex-1">
                        <x-ui.slider :value="$r['level']" :min="0" :max="100" :step="1" aria-label="{{ $r['name'] }} roast level" />
                    </div>
                    <span class="w-10 text-right text-xs font-semibold tabular-nums" style="color:var(--brew-caramel);">{{ $r['level'] }}%</span>
                </div>
            @endforeach
        </div>

        {{-- Light → Dark legend --}}
        <div class="mt-8 flex items-center gap-2 text-xs" style="color:color-mix(in srgb,var(--brew-espresso) 55%,transparent);">
            <span class="h-3 w-16 rounded-full" style="background:linear-gradient(to right,#fef3c7,#7c2d12,#1f1611);"></span>
            <span class="ml-1">Light (floral, fruit, bright acidity)</span>
            <span class="mx-2">→</span>
            <span>Dark (chocolate, smoke, full body)</span>
        </div>
    </div>
</section>

{{-- ── BREWING METHODS TABS ───────────────────────── --}}
<section class="brew-bg-kraft brew-paper border-b py-20 lg:py-28" style="border-color:var(--brew-border);" aria-labelledby="methods-heading">
    <div class="mx-auto max-w-5xl px-4 lg:px-6">
        <div class="mb-10 text-center">
            <x-ui.badge tone="warning" variant="soft" class="mb-3">
                <x-lucide-book-open class="size-3" /> Brew Guide
            </x-ui.badge>
            <h2 id="methods-heading" class="brew-serif text-4xl font-bold tracking-tight sm:text-5xl"
                style="color:var(--brew-espresso);">How to Brew</h2>
        </div>

        <x-ui.tabs value="pour-over" class="mx-auto w-full">
            <x-ui.tabs-list variant="pills" class="mx-auto mb-8 flex flex-wrap justify-center gap-2">
                @foreach ($brewMethods as $key => $m)
                    <x-ui.tabs-trigger value="{{ $key }}" class="gap-1.5">
                        <x-dynamic-component :component="'lucide-'.$m['icon']" class="size-4" />
                        {{ $m['label'] }}
                    </x-ui.tabs-trigger>
                @endforeach
            </x-ui.tabs-list>

            @foreach ($brewMethods as $key => $m)
                <x-ui.tabs-content value="{{ $key }}">
                    <div class="grid items-center gap-8 lg:grid-cols-2">
                        <div>
                            <h3 class="brew-serif text-2xl font-bold" style="color:var(--brew-espresso);">{{ $m['label'] }}</h3>

                            {{-- Params row --}}
                            <div class="mt-4 flex flex-wrap gap-3">
                                @foreach (['Ratio' => $m['ratio'], 'Grind' => $m['grind'], 'Temp' => $m['temp'], 'Time' => $m['time']] as $lbl => $val)
                                    <div class="rounded-xl border px-3 py-2 text-sm" style="border-color:var(--brew-border);background:var(--brew-light);">
                                        <span class="block text-xs uppercase tracking-wide" style="color:var(--brew-caramel);">{{ $lbl }}</span>
                                        <span class="brew-serif font-bold" style="color:var(--brew-espresso);">{{ $val }}</span>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Steps --}}
                            <ol class="mt-6 space-y-3">
                                @foreach ($m['steps'] as $idx => $step)
                                    <li class="flex items-start gap-3 text-sm" style="color:color-mix(in srgb,var(--brew-espresso) 75%,transparent);">
                                        <span class="brew-stamp mt-0.5 shrink-0 size-6 p-0 text-[0.6rem] font-bold"
                                              style="border-color:var(--brew-caramel);color:var(--brew-roast);" aria-hidden="true">
                                            {{ $idx + 1 }}
                                        </span>
                                        {{ $step }}
                                    </li>
                                @endforeach
                            </ol>
                        </div>

                        <div class="overflow-hidden rounded-2xl border shadow-lg" style="border-color:var(--brew-border);">
                            <img src="https://picsum.photos/seed/{{ $m['img'] }}/700/480"
                                 alt="{{ $m['label'] }} brewing method"
                                 loading="lazy"
                                 class="aspect-[4/3] w-full object-cover" />
                        </div>
                    </div>
                </x-ui.tabs-content>
            @endforeach
        </x-ui.tabs>
    </div>
</section>

{{-- ── PHOTO GALLERY ─────────────────────────────── --}}
<section class="brew-bg-light border-b py-16 lg:py-20" style="border-color:var(--brew-border);" aria-labelledby="gallery-heading">
    <div class="mx-auto max-w-7xl px-4 lg:px-6">
        <div class="mb-8 flex items-end justify-between">
            <div>
                <h2 id="gallery-heading" class="brew-serif text-3xl font-bold" style="color:var(--brew-espresso);">
                    From Farm to Cup
                </h2>
                <p class="mt-1 text-sm" style="color:color-mix(in srgb,var(--brew-espresso) 55%,transparent);">
                    Tap any photo to explore full-size.
                </p>
            </div>
        </div>
        <x-ui.gallery :columns="3" rounded="rounded-2xl" :images="$gallery" />
    </div>
</section>

{{-- ── REVIEWS CAROUSEL ──────────────────────────── --}}
<section class="brew-bg-espresso brew-paper py-20 lg:py-28" aria-labelledby="reviews-heading">
    <div class="mx-auto max-w-5xl px-4 lg:px-6">
        <div class="mb-10 text-center">
            <x-ui.badge tone="warning" variant="soft" class="mb-3">
                <x-lucide-heart class="size-3" /> Reviews
            </x-ui.badge>
            <h2 id="reviews-heading" class="brew-serif text-4xl font-bold tracking-tight sm:text-5xl"
                style="color:var(--brew-kraft);">
                What Coffee Lovers Say
            </h2>
        </div>

        <x-ui.carousel class="mx-auto max-w-2xl px-12">
            <x-ui.carousel-content>
                @foreach ($reviews as $review)
                    <x-ui.carousel-item>
                        <div class="rounded-2xl border p-8 text-center" style="border-color:rgba(217,194,163,0.2);background:rgba(255,255,255,0.06);">
                            <x-ui.rating :value="$review['rating']" readonly color="text-amber-400" class="mb-5 justify-center" />
                            <blockquote class="brew-serif text-xl font-medium leading-relaxed text-balance"
                                        style="color:var(--brew-kraft);">
                                "{{ $review['q'] }}"
                            </blockquote>
                            <figcaption class="mt-6 flex items-center justify-center gap-3">
                                <x-ui.avatar class="size-12">
                                    <x-ui.avatar-image src="https://picsum.photos/seed/{{ $review['seed'] }}/96/96" alt="{{ $review['a'] }}" />
                                    <x-ui.avatar-fallback style="background:var(--brew-caramel);color:var(--brew-cream);">{{ substr($review['a'], 0, 1) }}</x-ui.avatar-fallback>
                                </x-ui.avatar>
                                <div class="text-left text-sm">
                                    <div class="font-semibold" style="color:var(--brew-kraft);">{{ $review['a'] }}</div>
                                    <div style="color:rgba(217,194,163,0.65);">{{ $review['r'] }}</div>
                                </div>
                            </figcaption>
                        </div>
                    </x-ui.carousel-item>
                @endforeach
            </x-ui.carousel-content>
            <x-ui.carousel-previous />
            <x-ui.carousel-next />
        </x-ui.carousel>
    </div>
</section>

{{-- ── FAQ ────────────────────────────────────────── --}}
<section class="brew-bg-light brew-paper border-b py-20 lg:py-28" style="border-color:var(--brew-border);" aria-labelledby="faq-heading">
    <div class="mx-auto max-w-3xl px-4 lg:px-6">
        <div class="mb-10 text-center">
            <x-ui.badge tone="warning" variant="soft" class="mb-3">FAQ</x-ui.badge>
            <h2 id="faq-heading" class="brew-serif text-4xl font-bold tracking-tight"
                style="color:var(--brew-espresso);">Got Questions?</h2>
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

{{-- ── NEWSLETTER ────────────────────────────────── --}}
<section class="brew-bg-kraft brew-paper py-20 lg:py-24" aria-labelledby="newsletter-heading">
    <div class="mx-auto max-w-xl px-4 text-center lg:px-6">
        <div class="brew-stamp mx-auto mb-5 size-16" style="font-size:1.6rem;" aria-hidden="true">☕</div>
        <h2 id="newsletter-heading" class="brew-serif text-3xl font-bold tracking-tight sm:text-4xl"
            style="color:var(--brew-espresso);">
            10% Off Your First Bag
        </h2>
        <p class="mt-2 text-base" style="color:color-mix(in srgb,var(--brew-espresso) 65%,transparent);">
            Join 4,200+ subscribers. New arrivals, harvest news and the occasional good deal.
        </p>
        <form class="mx-auto mt-6 flex max-w-sm gap-2" novalidate>
            <x-ui.input type="email" placeholder="your@email.com" class="flex-1" aria-label="Email address" />
            <button type="submit" class="brew-btn-primary shrink-0">Subscribe</button>
        </form>
        <p class="mt-3 text-xs" style="color:color-mix(in srgb,var(--brew-espresso) 45%,transparent);">
            No spam. Unsubscribe any time. We respect your inbox.
        </p>
    </div>
</section>

{{-- ── FOOTER ────────────────────────────────────── --}}
<footer class="brew-bg-espresso" style="color:var(--brew-kraft);" role="contentinfo">
    <div class="mx-auto max-w-7xl px-4 py-14 lg:px-6">
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-5">
            {{-- Brand column --}}
            <div class="lg:col-span-2">
                <a href="#" class="brew-serif inline-flex items-center gap-2 text-2xl font-bold"
                   style="color:var(--brew-cream);" aria-label="Brew home">
                    <span class="brew-stamp" style="font-size:1rem;width:2.25rem;height:2.25rem;padding:0;color:var(--brew-roast);">☕</span>
                    Brew
                </a>
                <p class="mt-3 max-w-xs text-sm" style="color:rgba(217,194,163,0.65);">
                    Specialty coffee roasters. Sourced direct, roasted fresh, shipped with care.
                </p>
                <div class="mt-5 flex gap-2">
                    @foreach (['instagram', 'twitter', 'youtube'] as $social)
                        <a href="#" aria-label="{{ ucfirst($social) }}"
                           class="inline-flex size-9 items-center justify-center rounded-md border transition-colors hover:opacity-80"
                           style="border-color:rgba(217,194,163,0.25);color:var(--brew-kraft);">
                            <x-dynamic-component :component="'lucide-'.$social" class="size-4" />
                        </a>
                    @endforeach
                </div>
            </div>

            {{-- Link columns --}}
            @foreach ($footerLinks as $heading => $links)
                <div>
                    <h3 class="text-sm font-semibold" style="color:var(--brew-cream);">{{ $heading }}</h3>
                    <ul class="mt-3 space-y-2 text-sm" role="list">
                        @foreach ($links as $link)
                            <li>
                                <a href="#" class="transition-opacity hover:opacity-100"
                                   style="color:rgba(217,194,163,0.65);">{{ $link }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <x-ui.separator class="my-8" />

        <div class="flex flex-col items-center justify-between gap-3 text-xs sm:flex-row"
             style="color:rgba(217,194,163,0.5);">
            <span>© {{ date('Y') }} Brew Roastery. All rights reserved.</span>
            <span class="flex items-center gap-3">
                <a href="#" class="hover:opacity-100 transition-opacity" style="color:rgba(217,194,163,0.5);">Privacy</a>
                <a href="#" class="hover:opacity-100 transition-opacity" style="color:rgba(217,194,163,0.5);">Terms</a>
                <span class="flex items-center gap-1">
                    <x-lucide-leaf class="size-3.5" style="color:var(--brew-caramel);" /> Carbon neutral delivery
                </span>
            </span>
        </div>
    </div>
</footer>

</div>{{-- #tpl-brew --}}
</x-layouts.app>
