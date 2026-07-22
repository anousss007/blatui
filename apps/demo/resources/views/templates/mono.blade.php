@php
    $series = [
        ['seed' => 'mono01', 'w' => 1600, 'h' => 1067, 'tw' => 800, 'th' => 534, 'alt' => 'Coastal cliffs at golden hour', 'label' => 'Coastline I'],
        ['seed' => 'mono02', 'w' => 1600, 'h' => 1067, 'tw' => 800, 'th' => 534, 'alt' => 'Fog rolling over a mountain valley', 'label' => 'Valley Fog'],
        ['seed' => 'mono03', 'w' => 1067, 'h' => 1600, 'tw' => 534, 'th' => 800, 'alt' => 'Portrait of a woman in soft light', 'label' => 'Study No. 3'],
        ['seed' => 'mono04', 'w' => 1600, 'h' => 1067, 'tw' => 800, 'th' => 534, 'alt' => 'Deserted road through open plains', 'label' => 'Open Road'],
        ['seed' => 'mono05', 'w' => 1067, 'h' => 1600, 'tw' => 534, 'th' => 800, 'alt' => 'Architecture detail — shadow and concrete', 'label' => 'Form I'],
        ['seed' => 'mono06', 'w' => 1600, 'h' => 1067, 'tw' => 800, 'th' => 534, 'alt' => 'Still water at dawn', 'label' => 'Stillness'],
        ['seed' => 'mono07', 'w' => 1600, 'h' => 1067, 'tw' => 800, 'th' => 534, 'alt' => 'Snow-dusted pine forest', 'label' => 'Winter Silence'],
        ['seed' => 'mono08', 'w' => 1067, 'h' => 1600, 'tw' => 534, 'th' => 800, 'alt' => 'Market vendor at dusk', 'label' => 'Dusk Market'],
        ['seed' => 'mono09', 'w' => 1600, 'h' => 1067, 'tw' => 800, 'th' => 534, 'alt' => 'Aerial view of terraced fields', 'label' => 'Terraces'],
        ['seed' => 'mono10', 'w' => 1600, 'h' => 1067, 'tw' => 800, 'th' => 534, 'alt' => 'Empty chapel interior with raking light', 'label' => 'Light Study'],
        ['seed' => 'mono11', 'w' => 1067, 'h' => 1600, 'tw' => 534, 'th' => 800, 'alt' => 'Rain-slicked city street at night', 'label' => 'Night Rain'],
        ['seed' => 'mono12', 'w' => 1600, 'h' => 1067, 'tw' => 800, 'th' => 534, 'alt' => 'Icelandic geothermal landscape', 'label' => 'Geothermal'],
    ];

    $galleryImages = collect($series)->map(fn($s) => [
        'src'   => "https://picsum.photos/seed/{$s['seed']}/{$s['w']}/{$s['h']}",
        'thumb' => "https://picsum.photos/seed/{$s['seed']}/{$s['tw']}/{$s['th']}",
        'alt'   => $s['alt'],
    ])->all();

    $seriesSlides = [
        ['seed' => 'series01', 'w' => 1400, 'h' => 900, 'alt' => 'Coastline at blue hour — series frame 01', 'num' => '01'],
        ['seed' => 'series02', 'w' => 1400, 'h' => 900, 'alt' => 'Tide pools and volcanic rock — series frame 02', 'num' => '02'],
        ['seed' => 'series03', 'w' => 1400, 'h' => 900, 'alt' => 'Sea mist over boulders — series frame 03', 'num' => '03'],
        ['seed' => 'series04', 'w' => 1400, 'h' => 900, 'alt' => 'Silhouette against the setting sun — series frame 04', 'num' => '04'],
        ['seed' => 'series05', 'w' => 1400, 'h' => 900, 'alt' => 'Long exposure waves on dark sand — series frame 05', 'num' => '05'],
    ];

    $clients = ['Vogue', 'National Geographic', 'The Guardian', 'Monocle', 'Kinfolk', 'Wallpaper*', 'Le Monde', 'Zeit Magazin', 'Aperture', 'AnOther'];

    $approaches = [
        ['n' => '01', 'title' => 'Observation',    'desc' => 'Every assignment begins with prolonged looking — reading the light, the architecture, the quiet rhythms of a place before the lens cap comes off.'],
        ['n' => '02', 'title' => 'Restraint',      'desc' => 'I work with minimal equipment and natural light wherever possible. Less gear means more presence.'],
        ['n' => '03', 'title' => 'Single Frame',   'desc' => 'I rarely bracket. One carefully composed frame carries more conviction than a hundred alternatives.'],
        ['n' => '04', 'title' => 'Post-treatment', 'desc' => 'Retouching is a last resort. Tonal adjustments only — the photograph should earn its look in camera.'],
    ];

    $stats = [
        ['v' => '18 yrs', 'l' => 'in practice'],
        ['v' => '34',     'l' => 'solo exhibitions'],
        ['v' => '7',      'l' => 'monographs published'],
        ['v' => '62+',    'l' => 'editorial clients'],
    ];

    $categories = [
        'landscape'   => 'Landscape',
        'portrait'    => 'Portrait',
        'documentary' => 'Documentary',
    ];

    $catImages = [
        'landscape'   => ['lsc01','lsc02','lsc03','lsc04','lsc05','lsc06'],
        'portrait'    => ['por01','por02','por03','por04','por05','por06'],
        'documentary' => ['doc01','doc02','doc03','doc04','doc05','doc06'],
    ];
@endphp

<x-layouts.app title="Mono — Selected Works">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,300;0,400;1,300&display=swap');

    #tpl-mono {
        --mono-bg:      #0a0a0a;
        --mono-text:    #ededed;
        --mono-muted:   #7a7a7a;
        --mono-accent:  #c9a227;
        --mono-border:  #222222;
        --mono-hover:   #181818;
        background: var(--mono-bg);
        color: var(--mono-text);
        font-family: 'Inter', system-ui, sans-serif;
        min-height: 100vh;
    }

    /* ── typography ─────────────────────────────────── */
    #tpl-mono .mono-display {
        font-family: 'Cormorant Garamond', Georgia, serif;
        font-weight: 300;
        line-height: 1.1;
        letter-spacing: -0.01em;
    }

    #tpl-mono .mono-label {
        font-size: 0.65rem;
        font-weight: 500;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        color: var(--mono-muted);
    }

    #tpl-mono .mono-accent-text {
        color: var(--mono-accent);
    }

    /* ── nav ─────────────────────────────────────────── */
    #tpl-mono .mono-nav {
        position: sticky;
        top: 0;
        z-index: 50;
        background: rgba(10,10,10,.85);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border-bottom: 1px solid var(--mono-border);
    }

    /* ── hero ────────────────────────────────────────── */
    #tpl-mono .mono-hero {
        position: relative;
        width: 100%;
        height: 100svh;
        min-height: 520px;
        overflow: hidden;
    }

    #tpl-mono .mono-hero-img {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
        transform: scale(1.04);
        transition: transform 8s ease-out;
    }

    #tpl-mono .mono-hero[data-loaded] .mono-hero-img {
        transform: scale(1);
    }

    /* cinematic letterbox bars */
    #tpl-mono .mono-hero::before,
    #tpl-mono .mono-hero::after {
        content: '';
        position: absolute;
        left: 0; right: 0;
        height: 9%;
        background: var(--mono-bg);
        z-index: 2;
        pointer-events: none;
    }
    #tpl-mono .mono-hero::before { top: 0; }
    #tpl-mono .mono-hero::after  { bottom: 0; }

    #tpl-mono .mono-hero-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to bottom,
            rgba(10,10,10,0.18) 0%,
            rgba(10,10,10,0.05) 40%,
            rgba(10,10,10,0.55) 100%);
        z-index: 1;
    }

    #tpl-mono .mono-hero-content {
        position: absolute;
        inset: 0;
        z-index: 3;
        display: flex;
        flex-direction: column;
        justify-content: flex-end;
        padding: 12% 6% 13%;
    }

    /* ── gallery grid (asymmetric masonry feel) ─────── */
    #tpl-mono .mono-masonry {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 3px;
    }

    #tpl-mono .mono-masonry .mono-thumb {
        position: relative;
        overflow: hidden;
        cursor: pointer;
        background: var(--mono-border);
        aspect-ratio: 4 / 3;
    }

    /* make every 5th item portrait */
    #tpl-mono .mono-masonry .mono-thumb:nth-child(5n+3) {
        aspect-ratio: 3 / 4;
        grid-row: span 2;
    }

    #tpl-mono .mono-masonry .mono-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
        transition: transform 0.5s ease;
    }

    #tpl-mono .mono-thumb:hover img {
        transform: scale(1.04);
    }

    #tpl-mono .mono-thumb-caption {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(0,0,0,.72) 0%, transparent 55%);
        display: flex;
        align-items: flex-end;
        padding: 0.9rem 1rem;
        opacity: 0;
        transition: opacity 0.35s ease;
    }

    #tpl-mono .mono-thumb:hover .mono-thumb-caption,
    #tpl-mono .mono-thumb:focus-within .mono-thumb-caption {
        opacity: 1;
    }

    /* ── carousel override (dark) ────────────────────── */
    #tpl-mono .mono-carousel-wrap [data-slot="carousel"] {
        --tw-ring-color: transparent;
    }

    #tpl-mono .mono-series-slide {
        position: relative;
        overflow: hidden;
    }

    #tpl-mono .mono-series-slide img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    /* ── approach list ───────────────────────────────── */
    #tpl-mono .mono-approach-item {
        display: grid;
        grid-template-columns: 2.5rem 1fr;
        gap: 1.5rem;
        align-items: start;
        padding: 2rem 0;
        border-bottom: 1px solid var(--mono-border);
    }

    #tpl-mono .mono-approach-item:first-child {
        border-top: 1px solid var(--mono-border);
    }

    /* ── stats row ───────────────────────────────────── */
    #tpl-mono .mono-stats {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1px;
        background: var(--mono-border);
        border: 1px solid var(--mono-border);
    }

    @media (min-width: 768px) {
        #tpl-mono .mono-stats { grid-template-columns: repeat(4, 1fr); }
    }

    #tpl-mono .mono-stat-cell {
        background: var(--mono-bg);
        padding: 2.5rem 2rem;
        text-align: center;
    }

    /* ── contact form ────────────────────────────────── */
    #tpl-mono .mono-input {
        width: 100%;
        background: transparent;
        border: none;
        border-bottom: 1px solid var(--mono-border);
        color: var(--mono-text);
        font-family: inherit;
        font-size: 0.9375rem;
        padding: 0.75rem 0;
        outline: none;
        transition: border-color 0.2s;
        caret-color: var(--mono-accent);
    }

    #tpl-mono .mono-input::placeholder {
        color: var(--mono-muted);
    }

    #tpl-mono .mono-input:focus {
        border-color: var(--mono-accent);
    }

    #tpl-mono .mono-submit {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        border: 1px solid var(--mono-text);
        background: transparent;
        color: var(--mono-text);
        font-family: inherit;
        font-size: 0.7rem;
        font-weight: 500;
        letter-spacing: 0.18em;
        text-transform: uppercase;
        padding: 0.875rem 2.25rem;
        cursor: pointer;
        transition: background 0.25s, color 0.25s;
    }

    #tpl-mono .mono-submit:hover {
        background: var(--mono-text);
        color: var(--mono-bg);
    }

    /* ── marquee override ────────────────────────────── */
    #tpl-mono [data-slot="marquee"] {
        border-top: 1px solid var(--mono-border);
        border-bottom: 1px solid var(--mono-border);
    }

    /* ── tabs override ───────────────────────────────── */
    #tpl-mono [data-slot="tabs-list"] {
        background: transparent;
        border-bottom: 1px solid var(--mono-border);
        border-radius: 0;
        height: auto;
        padding: 0;
        gap: 0;
        width: 100%;
        display: flex;
        justify-content: flex-start;
    }

    #tpl-mono [data-slot="tabs-trigger"] {
        color: var(--mono-muted);
        font-size: 0.65rem;
        font-weight: 500;
        letter-spacing: 0.15em;
        text-transform: uppercase;
        padding: 0.75rem 1.5rem;
        border-bottom: 2px solid transparent;
        border-radius: 0;
        flex: none;
        background: transparent;
        transition: color 0.2s, border-color 0.2s;
    }

    #tpl-mono [data-slot="tabs-trigger"][data-state="active"] {
        color: var(--mono-text);
        border-bottom-color: var(--mono-accent);
        background: transparent;
        box-shadow: none;
    }

    #tpl-mono [data-slot="tabs-trigger"]:hover {
        color: var(--mono-text);
    }

    /* ── badge override (custom labels) ─────────────── */
    #tpl-mono .mono-badge {
        display: inline-flex;
        align-items: center;
        border: 1px solid var(--mono-accent);
        color: var(--mono-accent);
        font-size: 0.6rem;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        padding: 0.2rem 0.6rem;
        border-radius: 0;
        font-weight: 500;
    }

    /* ── separator override ──────────────────────────── */
    #tpl-mono [data-slot="separator"] {
        background: var(--mono-border);
    }

    /* ── footer ──────────────────────────────────────── */
    #tpl-mono .mono-footer {
        border-top: 1px solid var(--mono-border);
    }

    /* ── hover-card override ─────────────────────────── */
    #tpl-mono [data-slot="hover-card-content"] {
        background: var(--mono-hover);
        border: 1px solid var(--mono-border);
        color: var(--mono-text);
        border-radius: 0;
        padding: 1rem;
        width: 14rem;
    }

    /* ── reduced motion ──────────────────────────────── */
    @media (prefers-reduced-motion: reduce) {
        #tpl-mono .mono-hero-img { transition: none; }
        #tpl-mono .mono-thumb img { transition: none; }
        #tpl-mono .mono-thumb-caption { transition: none; opacity: 1; }
        #tpl-mono [data-slot="marquee"] > div { animation: none !important; }
    }
</style>

<div id="tpl-mono">

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- 01 NAV                                          --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <header class="mono-nav">
        <div style="max-width:1400px;margin:0 auto;padding:0 2rem;height:3.5rem;display:flex;align-items:center;justify-content:space-between;">
            <a href="#" class="mono-display" style="font-size:1.5rem;color:var(--mono-text);text-decoration:none;letter-spacing:0.06em;">
                Mono
            </a>
            <nav style="display:flex;gap:2.5rem;align-items:center;">
                <a href="#work"    class="mono-label" style="color:var(--mono-muted);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='var(--mono-text)'" onmouseout="this.style.color='var(--mono-muted)'">Work</a>
                <a href="#series"  class="mono-label" style="color:var(--mono-muted);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='var(--mono-text)'" onmouseout="this.style.color='var(--mono-muted)'">Series</a>
                <a href="#about"   class="mono-label" style="color:var(--mono-muted);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='var(--mono-text)'" onmouseout="this.style.color='var(--mono-muted)'">About</a>
                <a href="#contact" class="mono-label" style="color:var(--mono-muted);text-decoration:none;transition:color .2s;" onmouseover="this.style.color='var(--mono-text)'" onmouseout="this.style.color='var(--mono-muted)'">Contact</a>
            </nav>
        </div>
    </header>

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- 02 HERO — full-bleed, cinematic letterboxing    --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <section class="mono-hero" x-data="{}" x-init="$el.setAttribute('data-loaded', '')">
        <img
            src="https://picsum.photos/seed/monohero/2400/1350"
            alt="Sweeping coastal landscape at blue hour — hero image"
            class="mono-hero-img"
            loading="eager"
            x-init="if ($el.complete) $el.closest('[data-slot]') || $el.dispatchEvent(new Event('load'))"
        />
        <div class="mono-hero-overlay" aria-hidden="true"></div>
        <div class="mono-hero-content">
            <div style="max-width:1400px;margin:0 auto;width:100%;padding:0 2rem;">
                <p class="mono-label" style="margin-bottom:1.5rem;">
                    <span class="mono-accent-text">—</span>&nbsp; Selected Works 2019–2025
                </p>
                <h1 class="mono-display" style="font-size:clamp(3.5rem,8vw,7.5rem);color:var(--mono-text);max-width:12ch;">
                    Light &amp;<br><em>Stillness</em>
                </h1>
                <p style="margin-top:1.25rem;color:rgba(237,237,237,.65);font-size:0.9375rem;max-width:38ch;line-height:1.6;">
                    Landscape, portrait and documentary work by&nbsp;<strong style="color:var(--mono-text);font-weight:400;">Elara Voss</strong>.
                </p>
                <div style="margin-top:2.5rem;display:flex;align-items:center;gap:1.5rem;">
                    <a href="#work" style="display:inline-flex;align-items:center;gap:0.6rem;border:1px solid rgba(237,237,237,.35);color:var(--mono-text);font-size:0.65rem;font-weight:500;letter-spacing:.18em;text-transform:uppercase;padding:.75rem 1.75rem;text-decoration:none;transition:border-color .2s,background .2s;" onmouseover="this.style.borderColor='var(--mono-text)'" onmouseout="this.style.borderColor='rgba(237,237,237,.35)'">
                        View Work
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </a>
                    <a href="#contact" style="color:rgba(237,237,237,.55);font-size:0.65rem;font-weight:500;letter-spacing:.18em;text-transform:uppercase;text-decoration:none;transition:color .2s;" onmouseover="this.style.color='var(--mono-text)'" onmouseout="this.style.color='rgba(237,237,237,.55)'">
                        Book a session
                    </a>
                </div>
            </div>
        </div>
        {{-- scroll indicator --}}
        <div style="position:absolute;bottom:12%;left:50%;transform:translateX(-50%);z-index:3;display:flex;flex-direction:column;align-items:center;gap:.4rem;" aria-hidden="true">
            <span class="mono-label" style="font-size:.55rem;">scroll</span>
            <div style="width:1px;height:2.5rem;background:rgba(237,237,237,.25);"></div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- 03 SELECTED WORK — masonry gallery + lightbox  --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <section id="work" style="padding:7rem 0 5rem;">
        <div style="max-width:1400px;margin:0 auto;padding:0 2rem;">

            {{-- section header --}}
            <div style="display:flex;align-items:baseline;justify-content:space-between;margin-bottom:3rem;">
                <div>
                    <p class="mono-label" style="margin-bottom:.75rem;"><span class="mono-accent-text">—</span>&nbsp; Selected Work</p>
                    <h2 class="mono-display" style="font-size:clamp(2rem,4vw,3.5rem);color:var(--mono-text);">
                        12 Photographs
                    </h2>
                </div>
                <span class="mono-label">2019 – 2025</span>
            </div>

            {{-- work category tabs (filter labels only — decorative in this demo) --}}
            <x-ui.tabs value="landscape" class="w-full" style="gap:0;">
                <x-ui.tabs-list variant="underline" class="mb-8 w-full">
                    @foreach ($categories as $key => $label)
                        <x-ui.tabs-trigger value="{{ $key }}">{{ $label }}</x-ui.tabs-trigger>
                    @endforeach
                </x-ui.tabs-list>

                {{-- each tab shows its own 6-image gallery --}}
                @foreach ($categories as $key => $label)
                    <x-ui.tabs-content value="{{ $key }}">
                        @php
                            $tabGalleryImages = collect($catImages[$key])->map(fn($seed) => [
                                'src'   => "https://picsum.photos/seed/{$seed}/1400/960",
                                'thumb' => "https://picsum.photos/seed/{$seed}/700/480",
                                'alt'   => "{$label} photograph — {$seed}",
                            ])->all();
                        @endphp
                        <x-ui.gallery
                            :images="$tabGalleryImages"
                            :columns="3"
                            rounded="rounded-none"
                            class="w-full"
                        />
                    </x-ui.tabs-content>
                @endforeach
            </x-ui.tabs>

        </div>
    </section>

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- 04 FULL MASONRY — All 12 with hover captions   --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <section style="padding:2rem 0 7rem;">
        <div style="max-width:1400px;margin:0 auto;padding:0 2rem;">
            <p class="mono-label" style="margin-bottom:2rem;text-align:right;">
                01&nbsp;<span class="mono-accent-text">/</span>&nbsp;{{ sprintf('%02d', count($galleryImages)) }}
            </p>

            {{-- Using the BlatUI gallery component for lightbox --}}
            <x-ui.gallery
                :images="$galleryImages"
                :columns="4"
                rounded="rounded-none"
                class="w-full"
            />
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- 05 FEATURED SERIES — full-width carousel        --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <section id="series" style="padding:7rem 0;border-top:1px solid var(--mono-border);">
        <div style="max-width:1400px;margin:0 auto;padding:0 2rem;">
            <div style="display:grid;grid-template-columns:1fr auto;align-items:end;margin-bottom:3rem;gap:1rem;">
                <div>
                    <p class="mono-label" style="margin-bottom:.75rem;"><span class="mono-accent-text">—</span>&nbsp; Featured Series</p>
                    <h2 class="mono-display" style="font-size:clamp(2rem,4vw,3.5rem);color:var(--mono-text);">
                        Coastline
                    </h2>
                    <p style="margin-top:.75rem;color:var(--mono-muted);font-size:.875rem;max-width:44ch;line-height:1.65;">
                        A five-part study of the Atlantic coast shot over three winters. Minimal intervention, maximum fidelity.
                    </p>
                </div>
                <span class="mono-badge">5 Frames</span>
            </div>
        </div>

        <div class="mono-carousel-wrap" style="padding:0 2rem 0 max(2rem,calc((100vw - 1400px)/2 + 2rem));">
            <x-ui.carousel class="w-full">
                <x-ui.carousel-content style="margin-left:-1rem;">
                    @foreach ($seriesSlides as $slide)
                        <x-ui.carousel-item style="padding-left:1rem;flex:0 0 min(80vw,900px);">
                            <div class="mono-series-slide" style="aspect-ratio:14/9;border-radius:0;overflow:hidden;position:relative;">
                                <img
                                    src="https://picsum.photos/seed/{{ $slide['seed'] }}/{{ $slide['w'] }}/{{ $slide['h'] }}"
                                    alt="{{ $slide['alt'] }}"
                                    loading="lazy"
                                    style="width:100%;height:100%;object-fit:cover;display:block;"
                                />
                                <div style="position:absolute;bottom:1.25rem;left:1.5rem;display:flex;align-items:center;gap:1rem;" aria-hidden="true">
                                    <span style="font-size:1.75rem;font-weight:300;color:rgba(237,237,237,.4);font-family:'Cormorant Garamond',Georgia,serif;letter-spacing:-.02em;">{{ $slide['num'] }}</span>
                                    <div style="width:2rem;height:1px;background:rgba(237,237,237,.3);"></div>
                                </div>
                            </div>
                        </x-ui.carousel-item>
                    @endforeach
                </x-ui.carousel-content>
                <x-ui.carousel-previous style="left:1.5rem;background:rgba(10,10,10,.75);border:1px solid var(--mono-border);color:var(--mono-text);" />
                <x-ui.carousel-next  style="right:1.5rem;background:rgba(10,10,10,.75);border:1px solid var(--mono-border);color:var(--mono-text);" />
            </x-ui.carousel>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- 06 ABOUT — portrait + bio + pull quote          --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <section id="about" style="padding:7rem 0;border-top:1px solid var(--mono-border);">
        <div style="max-width:1400px;margin:0 auto;padding:0 2rem;display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:start;">

            {{-- portrait --}}
            <div>
                <div style="position:relative;overflow:hidden;aspect-ratio:4/5;">
                    <img
                        src="https://picsum.photos/seed/monoabout/800/1000"
                        alt="Portrait of photographer Elara Voss"
                        loading="lazy"
                        style="width:100%;height:100%;object-fit:cover;display:block;"
                    />
                </div>
                <div style="margin-top:1.25rem;display:flex;align-items:center;gap:1rem;">
                    <x-ui.avatar class="size-10" style="border:1px solid var(--mono-border);">
                        <x-ui.avatar-image src="https://picsum.photos/seed/monoavatar/160/160" alt="Elara Voss" />
                        <x-ui.avatar-fallback style="background:var(--mono-hover);color:var(--mono-muted);">EV</x-ui.avatar-fallback>
                    </x-ui.avatar>
                    <div>
                        <p style="font-size:.875rem;color:var(--mono-text);font-weight:500;">Elara Voss</p>
                        <p class="mono-label" style="margin-top:.1rem;">Berlin — Cape Town</p>
                    </div>
                </div>
            </div>

            {{-- bio + quote --}}
            <div style="padding-top:3rem;">
                <p class="mono-label" style="margin-bottom:2rem;"><span class="mono-accent-text">—</span>&nbsp; About</p>
                <p style="font-size:1.0625rem;color:var(--mono-text);line-height:1.75;max-width:46ch;margin-bottom:2rem;">
                    Elara Voss is a documentary and landscape photographer based between Berlin and Cape Town. Her work explores the intersection of geological time and human presence — slow photographs for a fast world.
                </p>
                <p style="font-size:1.0625rem;color:var(--mono-muted);line-height:1.75;max-width:46ch;margin-bottom:3rem;">
                    She has exhibited at the Foam Museum Amsterdam, Paris Photo, and the Rencontres d'Arles. Her third monograph, <em>Margin</em>, was published in 2023.
                </p>

                <x-ui.separator style="margin-bottom:3rem;" />

                <x-ui.quote
                    author="Elara Voss"
                    role="Photographer"
                    class="max-w-none"
                    style="color:var(--mono-text);"
                >
                    A photograph is not a record of the world. It is a record of your attention.
                </x-ui.quote>
            </div>

        </div>
    </section>

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- 07 APPROACH — numbered list with separators    --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <section style="padding:7rem 0;border-top:1px solid var(--mono-border);">
        <div style="max-width:1400px;margin:0 auto;padding:0 2rem;">
            <div style="display:grid;grid-template-columns:1fr 2fr;gap:5rem;align-items:start;">
                <div>
                    <p class="mono-label" style="margin-bottom:.75rem;"><span class="mono-accent-text">—</span>&nbsp; Approach</p>
                    <h2 class="mono-display" style="font-size:clamp(1.75rem,3vw,3rem);color:var(--mono-text);">
                        How I work
                    </h2>
                </div>
                <div>
                    @foreach ($approaches as $item)
                        <div class="mono-approach-item">
                            <span class="mono-label mono-accent-text" style="padding-top:.1rem;">{{ $item['n'] }}</span>
                            <div>
                                <h3 style="font-size:1rem;font-weight:500;color:var(--mono-text);margin-bottom:.5rem;">{{ $item['title'] }}</h3>
                                <p style="font-size:.9rem;color:var(--mono-muted);line-height:1.7;">{{ $item['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- 08 CLIENTS MARQUEE                              --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <section style="padding:4rem 0;">
        <p class="mono-label" style="text-align:center;margin-bottom:2rem;">
            <span class="mono-accent-text">—</span>&nbsp; Clients &amp; publications
        </p>
        <x-ui.marquee
            :duration="'35s'"
            :fade="true"
            :gap="'3rem'"
            style="color:var(--mono-muted);"
        >
            @foreach ($clients as $client)
                <span class="mono-label" style="color:var(--mono-muted);font-size:.7rem;letter-spacing:.22em;white-space:nowrap;padding:1.25rem 0;">{{ $client }}</span>
            @endforeach
        </x-ui.marquee>
    </section>

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- 09 STATS                                        --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <section style="padding:6rem 0;border-top:1px solid var(--mono-border);">
        <div style="max-width:1400px;margin:0 auto;padding:0 2rem;">
            <div class="mono-stats">
                @foreach ($stats as $s)
                    <div class="mono-stat-cell">
                        <div class="mono-display" style="font-size:clamp(2.5rem,5vw,4rem);color:var(--mono-text);">{{ $s['v'] }}</div>
                        <div class="mono-label" style="margin-top:.5rem;">{{ $s['l'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- 10 SINGLE FEATURED IMAGE                        --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <section style="padding:0 0 7rem;">
        <div style="max-width:1400px;margin:0 auto;padding:0 2rem;">
            <x-ui.hover-card>
                <x-ui.hover-card-trigger>
                    <div style="position:relative;overflow:hidden;cursor:pointer;">
                        <img
                            src="https://picsum.photos/seed/monofeatured/1400/600"
                            alt="Featured photograph — wide panoramic landscape"
                            loading="lazy"
                            style="width:100%;display:block;object-fit:cover;aspect-ratio:21/9;transition:transform .5s ease;"
                            onmouseover="this.style.transform='scale(1.02)'"
                            onmouseout="this.style.transform='scale(1)'"
                        />
                    </div>
                </x-ui.hover-card-trigger>
                <x-ui.hover-card-content side="top" align="start">
                    <p style="font-size:.7rem;letter-spacing:.1em;text-transform:uppercase;color:var(--mono-accent);margin-bottom:.4rem;font-weight:500;">Featured</p>
                    <p style="font-size:.875rem;color:var(--mono-text);line-height:1.5;margin:0;">Open Horizon, Iceland<br><span style="color:var(--mono-muted);font-size:.8125rem;">Linhof Technika · Kodak Portra 160</span></p>
                </x-ui.hover-card-content>
            </x-ui.hover-card>
            <div style="display:flex;justify-content:flex-end;margin-top:.75rem;">
                <span class="mono-label">Open Horizon, Iceland — Linhof Technika · 2022</span>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- 11 CONTACT                                      --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <section id="contact" style="padding:7rem 0;border-top:1px solid var(--mono-border);">
        <div style="max-width:1400px;margin:0 auto;padding:0 2rem;display:grid;grid-template-columns:1fr 1fr;gap:5rem;align-items:start;">

            <div>
                <p class="mono-label" style="margin-bottom:.75rem;"><span class="mono-accent-text">—</span>&nbsp; Contact</p>
                <h2 class="mono-display" style="font-size:clamp(2rem,4vw,3.5rem);color:var(--mono-text);margin-bottom:2rem;">
                    Let's talk
                </h2>
                <p style="font-size:.9375rem;color:var(--mono-muted);line-height:1.7;max-width:40ch;margin-bottom:2.5rem;">
                    Available for editorial commissions, gallery representation, and print sales. Response within 48 hours.
                </p>

                <div style="display:flex;flex-direction:column;gap:1.25rem;">
                    @foreach (['editorial@elaravoss.com', 'Berlin, DE — Cape Town, ZA'] as $detail)
                        <p class="mono-label" style="color:var(--mono-muted);">{{ $detail }}</p>
                    @endforeach
                </div>

                <div style="margin-top:3rem;display:flex;gap:1rem;">
                    @foreach (['Instagram', 'Behance', 'LinkedIn'] as $social)
                        <a
                            href="#"
                            class="mono-label"
                            aria-label="{{ $social }}"
                            style="color:var(--mono-muted);text-decoration:none;transition:color .2s;"
                            onmouseover="this.style.color='var(--mono-text)'"
                            onmouseout="this.style.color='var(--mono-muted)'"
                        >{{ $social }}</a>
                    @endforeach
                </div>
            </div>

            {{-- contact form --}}
            <form
                action="#"
                method="POST"
                x-data="{ sent: false }"
                @submit.prevent="sent = true"
                style="padding-top:3rem;"
                aria-label="Contact form"
            >
                <div style="display:flex;flex-direction:column;gap:2rem;">
                    <div>
                        <label for="mono-name" class="mono-label" style="display:block;margin-bottom:.5rem;">Name</label>
                        <input
                            id="mono-name"
                            type="text"
                            name="name"
                            placeholder="Your name"
                            autocomplete="name"
                            required
                            class="mono-input"
                        />
                    </div>
                    <div>
                        <label for="mono-email" class="mono-label" style="display:block;margin-bottom:.5rem;">Email</label>
                        <input
                            id="mono-email"
                            type="email"
                            name="email"
                            placeholder="your@email.com"
                            autocomplete="email"
                            required
                            class="mono-input"
                        />
                    </div>
                    <div>
                        <label for="mono-subject" class="mono-label" style="display:block;margin-bottom:.5rem;">Subject</label>
                        <input
                            id="mono-subject"
                            type="text"
                            name="subject"
                            placeholder="Editorial commission, print sale…"
                            class="mono-input"
                        />
                    </div>
                    <div>
                        <label for="mono-message" class="mono-label" style="display:block;margin-bottom:.5rem;">Message</label>
                        <textarea
                            id="mono-message"
                            name="message"
                            rows="4"
                            placeholder="Tell me about your project…"
                            required
                            class="mono-input"
                            style="resize:vertical;min-height:7rem;border-bottom:1px solid var(--mono-border);"
                        ></textarea>
                    </div>
                </div>

                <div style="margin-top:2.5rem;display:flex;align-items:center;gap:2rem;">
                    <button type="submit" class="mono-submit" x-show="!sent">
                        Send message
                        <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
                    </button>
                    <p x-show="sent" x-cloak class="mono-label mono-accent-text" style="letter-spacing:.12em;">Message sent — thank you.</p>
                </div>
            </form>

        </div>
    </section>

    {{-- ═══════════════════════════════════════════════ --}}
    {{-- 12 FOOTER                                       --}}
    {{-- ═══════════════════════════════════════════════ --}}
    <footer class="mono-footer">
        <div style="max-width:1400px;margin:0 auto;padding:3rem 2rem;display:flex;flex-direction:column;gap:2rem;">
            <div style="display:flex;align-items:baseline;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
                <span class="mono-display" style="font-size:1.25rem;color:var(--mono-text);">Mono</span>
                <span class="mono-label">Photography © {{ date('Y') }}</span>
            </div>
            <x-ui.separator />
            <div style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:1rem;">
                <div style="display:flex;gap:2rem;flex-wrap:wrap;">
                    @foreach (['Privacy', 'Licensing', 'Colophon'] as $link)
                        <a href="#" class="mono-label" style="text-decoration:none;color:var(--mono-muted);transition:color .2s;" onmouseover="this.style.color='var(--mono-text)'" onmouseout="this.style.color='var(--mono-muted)'">{{ $link }}</a>
                    @endforeach
                </div>
                <p class="mono-label" style="font-size:.6rem;">All images retain full copyright · Reproduction prohibited without written consent</p>
            </div>
        </div>
    </footer>

</div>{{-- #tpl-mono --}}

</x-layouts.app>
