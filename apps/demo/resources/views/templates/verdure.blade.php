@php
    $nav = ['Mission' => '#mission', 'Impact' => '#impact', 'Initiatives' => '#initiatives', 'FAQ' => '#faq'];

    $impactStats = [
        ['value' => '4.2M', 'label' => 'Trees planted', 'icon' => 'tree-pine'],
        ['value' => '18,400 t', 'label' => 'CO₂ removed', 'icon' => 'wind'],
        ['value' => '96', 'label' => 'Ecosystems restored', 'icon' => 'globe'],
        ['value' => '230k+', 'label' => 'Community members', 'icon' => 'users'],
    ];

    $goals = [
        ['label' => 'Reforestation (2025 target)', 'value' => 74],
        ['label' => 'Carbon sequestration (annual)', 'value' => 58],
        ['label' => 'Wetland restoration (5-yr plan)', 'value' => 41],
        ['label' => 'Seed diversity preserved', 'value' => 88],
    ];

    // Chart: CO₂ removed (tonnes × 100) per quarter since 2022 — @php vars, single-quote safe
    $co2Series = [
        ['name' => 'CO₂ Removed (t)', 'data' => [820, 1240, 1580, 2100, 2750, 3410, 4200, 5050, 6300, 7800, 9400, 11200, 13800, 16500, 18400]],
    ];
    $co2Options = [
        'xaxis' => [
            'categories' => ['Q1\'22','Q2\'22','Q3\'22','Q4\'22','Q1\'23','Q2\'23','Q3\'23','Q4\'23','Q1\'24','Q2\'24','Q3\'24','Q4\'24','Q1\'25','Q2\'25','Q3\'25'],
        ],
        'fill' => ['type' => 'gradient', 'gradient' => ['shadeIntensity' => 1, 'opacityFrom' => 0.45, 'opacityTo' => 0.05, 'stops' => [0, 100]]],
        'stroke' => ['width' => 2, 'curve' => 'smooth'],
        'yaxis' => ['show' => false],
        'tooltip' => ['y' => ['formatter' => 'function(v){return v.toLocaleString()+" t"}']],
        'grid' => ['show' => false],
    ];

    $values = [
        ['icon' => 'leaf', 'title' => 'Regenerative by design', 'desc' => 'Every initiative follows restorative principles — we give back more than we take, building living ecosystems that thrive for decades.'],
        ['icon' => 'flask-conical', 'title' => 'Science-led', 'desc' => 'Our programmes are peer-reviewed by ecologists and climate scientists. Measurable outcomes, independently verified.'],
        ['icon' => 'heart-handshake', 'title' => 'Community-first', 'desc' => 'Local stewards shape every project. We believe the people closest to the land are its best guardians.'],
        ['icon' => 'shield-check', 'title' => 'Radical transparency', 'desc' => 'Impact dashboards, annual audits, and live satellite data — every tonne of carbon, every tree, fully traceable.'],
        ['icon' => 'sun', 'title' => 'Solar-powered ops', 'desc' => 'Our field stations, cold chains and offices run on 100% renewable energy. We walk the talk.'],
        ['icon' => 'sprout', 'title' => 'Seed sovereignty', 'desc' => 'We maintain open-access seed libraries for 1,200 native species, free to local farmers and schools.'],
    ];

    $howItWorks = [
        ['title' => 'Choose your impact', 'desc' => 'Browse verified reforestation, wetland, and soil projects. Filter by biome, community or carbon potential.'],
        ['title' => 'Pledge a contribution', 'desc' => 'One-off or monthly giving. Your funds flow directly to on-the-ground stewards — 91 cents of every euro.'],
        ['title' => 'Track in real time', 'desc' => 'Watch satellite imagery update as your trees grow. Receive a verified impact certificate each quarter.'],
        ['title' => 'Compound the effect', 'desc' => 'Share your milestone with your network. Every referral unlocks an extra seedling planted in your name.'],
    ];

    $initiatives = [
        ['title' => 'Atlantic Forest Revival', 'region' => 'Brazil', 'tag' => 'Reforestation', 'tone' => 'success', 'img_seed' => 'verdure-brazil', 'trees' => '1.2M', 'desc' => 'Restoring a corridor of the world\'s most biodiverse forest, linking fragmented habitats across 120 km of Atlantic coast.'],
        ['title' => 'Scottish Peatland Rewild', 'region' => 'Scotland', 'tag' => 'Carbon sink', 'tone' => 'info', 'img_seed' => 'verdure-scotland', 'trees' => '48k ha', 'desc' => 'Rewetting 48,000 hectares of degraded peat — the most carbon-dense terrestrial ecosystem on Earth.'],
        ['title' => 'Sahel Green Wall', 'region' => 'West Africa', 'tag' => 'Agroforestry', 'tone' => 'warning', 'img_seed' => 'verdure-sahel', 'trees' => '860k', 'desc' => 'Farmer-managed natural regeneration across six nations, restoring food security and halting desertification.'],
        ['title' => 'Borneo Mangrove Belt', 'region' => 'Indonesia', 'tag' => 'Blue carbon', 'tone' => 'success', 'img_seed' => 'verdure-borneo', 'trees' => '320k', 'desc' => 'Replanting coastal mangroves that shelter nursery fish habitat and protect shorelines from storm surge.'],
        ['title' => 'Andean Seed Bank', 'region' => 'Peru & Bolivia', 'tag' => 'Biodiversity', 'tone' => 'neutral', 'img_seed' => 'verdure-andes', 'trees' => '1.2k spp', 'desc' => 'Cataloguing and conserving the genetic heritage of Andean flora — a living insurance policy for the planet.'],
        ['title' => 'Murray–Darling Wetlands', 'region' => 'Australia', 'tag' => 'Restoration', 'tone' => 'info', 'img_seed' => 'verdure-murray', 'trees' => '14k ha', 'desc' => 'Returning seasonal water flows to floodplain wetlands, recovering waterbird populations and river red gum forests.'],
    ];

    $galleryImages = [
        ['src' => 'https://picsum.photos/seed/verd-g1/900/600', 'thumb' => 'https://picsum.photos/seed/verd-g1/400/400', 'alt' => 'Aerial view of reforested hillside'],
        ['src' => 'https://picsum.photos/seed/verd-g2/900/600', 'thumb' => 'https://picsum.photos/seed/verd-g2/400/400', 'alt' => 'Community tree planting event'],
        ['src' => 'https://picsum.photos/seed/verd-g3/900/600', 'thumb' => 'https://picsum.photos/seed/verd-g3/400/400', 'alt' => 'Mangrove coastal restoration'],
        ['src' => 'https://picsum.photos/seed/verd-g4/900/600', 'thumb' => 'https://picsum.photos/seed/verd-g4/400/400', 'alt' => 'Wetland birds returning after restoration'],
        ['src' => 'https://picsum.photos/seed/verd-g5/900/600', 'thumb' => 'https://picsum.photos/seed/verd-g5/400/400', 'alt' => 'Seed library and native species collection'],
        ['src' => 'https://picsum.photos/seed/verd-g6/900/600', 'thumb' => 'https://picsum.photos/seed/verd-g6/400/400', 'alt' => 'Field scientist measuring tree growth'],
        ['src' => 'https://picsum.photos/seed/verd-g7/900/600', 'thumb' => 'https://picsum.photos/seed/verd-g7/400/400', 'alt' => 'Solar-powered field station at dawn'],
        ['src' => 'https://picsum.photos/seed/verd-g8/900/600', 'thumb' => 'https://picsum.photos/seed/verd-g8/400/400', 'alt' => 'Children in reforestation education programme'],
    ];

    $partners = ['Earthwatch', 'WWF', 'IUCN', 'Carbon Trust', 'Rainforest Alliance', 'GreenPeace', 'The Nature Conservancy', 'EcoAct', 'Gold Standard', 'Verra'];

    $testimonials = [
        ['q' => 'Verdure gave our offsetting programme real teeth. Satellite updates, soil samples, community reports — we can show our board actual impact, not just a number.', 'a' => 'Miriam van Houten', 'r' => 'Head of Sustainability, Renova Group', 'img' => 'https://picsum.photos/seed/verd-t1/160/160'],
        ['q' => 'As a smallholder farmer in the Sahel, Verdure\'s agroforestry training changed everything. My yields doubled and the land is alive again.', 'a' => 'Moussa Coulibaly', 'r' => 'Community Steward, Mali', 'img' => 'https://picsum.photos/seed/verd-t2/160/160'],
        ['q' => 'The science is impeccable. Independent verification, peer-reviewed methodology, transparent data. This is what serious climate action looks like.', 'a' => 'Dr. Lin Zhao', 'r' => 'Climate Researcher, ETH Zürich', 'img' => 'https://picsum.photos/seed/verd-t3/160/160'],
    ];

    $faqs = [
        ['q' => 'How is my contribution used?', 'a' => 'At least 91% of every pledge goes directly to on-the-ground project costs — labour, seedlings, equipment and community wages. The remainder covers auditing and operations.'],
        ['q' => 'Are the carbon figures independently verified?', 'a' => 'Yes. Every tonne reported is verified against Verra\'s VM0047 or Gold Standard protocols by accredited third-party auditors. Certificates are publicly downloadable.'],
        ['q' => 'Can my company sponsor an entire initiative?', 'a' => 'Absolutely. Corporate partners can co-brand and exclusively fund a project area from €12,000/yr. You\'ll receive branded impact reports, satellite imagery, and on-site plaque recognition.'],
        ['q' => 'What happens if a project underperforms?', 'a' => 'We maintain a buffer pool of verified credits. If a site falls short of targets, buffer credits are automatically allocated so your reported impact is never compromised.'],
        ['q' => 'Can I visit a project site?', 'a' => 'Yes — Verdure runs annual stewardship journeys for supporters. These are small-group, low-impact visits led by our local partners. Spaces are limited; apply via your dashboard.'],
    ];

    $footerLinks = [
        'Restore' => ['Reforestation', 'Wetlands', 'Peatlands', 'Agroforestry', 'Blue Carbon'],
        'Learn' => ['Impact Reports', 'Science Hub', 'Field Stories', 'Glossary', 'Press Kit'],
        'Engage' => ['Individual giving', 'Corporate plans', 'Schools', 'Events', 'Ambassador'],
        'About' => ['Our mission', 'Team', 'Advisors', 'Careers', 'Contact'],
    ];
@endphp

<x-layouts.app title="Verdure — A greener tomorrow">

<style>
    @import url('https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,400;0,9..144,500;0,9..144,600;0,9..144,700;1,9..144,400;1,9..144,600&display=swap');

    /* ── Verdure design tokens ─────────────────────────────── */
    #tpl-verdure {
        --v-moss:       #3a5a40;
        --v-forest:     #283618;
        --v-sage:       #a3b18a;
        --v-cream:      #faf3e0;
        --v-terra:      #bc6c25;
        --v-terra-light:#e8925a;
        --v-stone:      #8c7b6e;
        --v-paper:      #f5ede0;
        background-color: var(--v-cream);
        color: var(--v-forest);
        font-family: 'Inter', sans-serif;
    }

    /* Typography */
    #tpl-verdure .v-serif {
        font-family: 'Fraunces', Georgia, serif;
    }

    /* Grain texture overlay (paper effect) */
    #tpl-verdure::before {
        content: '';
        position: fixed;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='200' height='200'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.85' numOctaves='4' stitchTiles='stitch'/%3E%3CfeColorMatrix type='saturate' values='0'/%3E%3C/filter%3E%3Crect width='200' height='200' filter='url(%23noise)' opacity='0.04'/%3E%3C/svg%3E");
        pointer-events: none;
        z-index: 9999;
    }

    /* Blob masks for images */
    #tpl-verdure .v-blob-1 {
        border-radius: 60% 40% 70% 30% / 50% 60% 40% 50%;
    }
    #tpl-verdure .v-blob-2 {
        border-radius: 40% 60% 30% 70% / 60% 30% 70% 40%;
    }
    #tpl-verdure .v-blob-3 {
        border-radius: 55% 45% 65% 35% / 45% 55% 45% 55%;
    }

    /* Organic card border */
    #tpl-verdure .v-card {
        background: #fff;
        border: 1px solid rgba(163,177,138,.35);
        border-radius: 1.25rem;
        box-shadow: 0 2px 12px rgba(58,90,64,.07);
    }

    /* Verdure nav */
    #tpl-verdure .v-nav {
        background: rgba(250,243,224,.88);
        backdrop-filter: blur(18px);
        -webkit-backdrop-filter: blur(18px);
        border-bottom: 1px solid rgba(163,177,138,.3);
    }
    #tpl-verdure .v-nav a {
        color: var(--v-forest);
    }
    #tpl-verdure .v-nav a:hover {
        color: var(--v-moss);
    }

    /* Section alternates */
    #tpl-verdure .v-section-alt {
        background: var(--v-paper);
    }
    #tpl-verdure .v-section-forest {
        background: var(--v-forest);
        color: var(--v-cream);
    }
    #tpl-verdure .v-section-moss {
        background: var(--v-moss);
        color: var(--v-cream);
    }

    /* Big stat numbers */
    #tpl-verdure .v-stat-num {
        font-family: 'Fraunces', Georgia, serif;
        font-size: clamp(2.4rem, 5vw, 3.5rem);
        font-weight: 700;
        color: var(--v-moss);
        line-height: 1;
    }

    /* Buttons */
    #tpl-verdure .v-btn-primary {
        background: var(--v-moss);
        color: var(--v-cream);
        border-radius: 9999px;
        padding: .65rem 1.6rem;
        font-weight: 600;
        font-size: .9rem;
        border: 2px solid transparent;
        transition: background .2s, transform .15s;
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        text-decoration: none;
        cursor: pointer;
    }
    #tpl-verdure .v-btn-primary:hover {
        background: var(--v-forest);
        transform: translateY(-1px);
    }
    #tpl-verdure .v-btn-outline {
        background: transparent;
        color: var(--v-moss);
        border-radius: 9999px;
        padding: .65rem 1.6rem;
        font-weight: 600;
        font-size: .9rem;
        border: 2px solid var(--v-moss);
        transition: background .2s, color .2s, transform .15s;
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        text-decoration: none;
        cursor: pointer;
    }
    #tpl-verdure .v-btn-outline:hover {
        background: var(--v-moss);
        color: var(--v-cream);
        transform: translateY(-1px);
    }
    #tpl-verdure .v-btn-terra {
        background: var(--v-terra);
        color: #fff;
        border-radius: 9999px;
        padding: .65rem 1.6rem;
        font-weight: 600;
        font-size: .9rem;
        border: 2px solid transparent;
        transition: background .2s, transform .15s;
        display: inline-flex;
        align-items: center;
        gap: .45rem;
        text-decoration: none;
        cursor: pointer;
    }
    #tpl-verdure .v-btn-terra:hover {
        background: #a05a1e;
        transform: translateY(-1px);
    }

    /* Progress bar verdure colors */
    #tpl-verdure .v-progress-wrap [data-slot="progress"] {
        background: rgba(163,177,138,.25);
    }
    #tpl-verdure .v-progress-wrap [data-slot="progress-indicator"] {
        background: var(--v-moss);
    }

    /* Badge verdure overrides */
    #tpl-verdure .v-badge-moss {
        background: rgba(58,90,64,.12);
        color: var(--v-moss);
        border: none;
        border-radius: 9999px;
        padding: .2rem .75rem;
        font-size: .75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: .3rem;
    }
    #tpl-verdure .v-badge-terra {
        background: rgba(188,108,37,.14);
        color: var(--v-terra);
        border: none;
        border-radius: 9999px;
        padding: .2rem .75rem;
        font-size: .75rem;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: .3rem;
    }

    /* Stepper verdure override */
    #tpl-verdure [data-slot="stepper-indicator"][data-state="active"] {
        background: var(--v-moss) !important;
        border-color: var(--v-moss) !important;
    }
    #tpl-verdure [data-slot="stepper-indicator"][data-state="completed"] {
        background: var(--v-moss) !important;
        border-color: var(--v-moss) !important;
    }
    #tpl-verdure [data-slot="stepper-separator"][data-state="completed"] {
        background: var(--v-moss) !important;
    }

    /* Chart area verdure color */
    #tpl-verdure [data-slot="chart"] {
        --chart-1: var(--v-moss);
    }

    /* Accordion verdure */
    #tpl-verdure [data-slot="accordion-item"] {
        border-bottom: 1px solid rgba(163,177,138,.4);
    }

    /* Leaf decoration */
    #tpl-verdure .v-leaf-deco {
        position: absolute;
        opacity: .07;
        pointer-events: none;
        user-select: none;
    }

    /* Scroll reveal */
    @media (prefers-reduced-motion: no-preference) {
        #tpl-verdure .v-reveal {
            opacity: 0;
            transform: translateY(22px);
            transition: opacity .6s ease, transform .6s ease;
        }
        #tpl-verdure .v-reveal.v-visible {
            opacity: 1;
            transform: none;
        }
    }

    /* Marquee partner text */
    #tpl-verdure .v-partner {
        font-family: 'Fraunces', serif;
        font-size: 1.1rem;
        font-weight: 600;
        color: rgba(250,243,224,.55);
        padding: 0 2rem;
        white-space: nowrap;
        letter-spacing: .03em;
    }

    /* Tabs verdure */
    #tpl-verdure [data-slot="tabs-list"] {
        background: rgba(163,177,138,.2) !important;
    }
    #tpl-verdure [data-slot="tabs-trigger"][data-state="active"] {
        background: var(--v-moss) !important;
        color: var(--v-cream) !important;
        box-shadow: 0 1px 6px rgba(58,90,64,.25) !important;
    }

    /* Pledge form */
    #tpl-verdure .v-pledge-input [data-slot="input-group"] {
        border-color: rgba(163,177,138,.5);
        background: rgba(255,255,255,.15);
        border-radius: 9999px;
        overflow: hidden;
    }
    #tpl-verdure .v-pledge-input input {
        color: var(--v-cream);
        background: transparent;
    }
    #tpl-verdure .v-pledge-input input::placeholder {
        color: rgba(250,243,224,.55);
    }
    #tpl-verdure .v-pledge-input [data-slot="input-group-button"] {
        background: var(--v-terra) !important;
        color: #fff !important;
        border-radius: 9999px !important;
        padding-left: 1.25rem !important;
        padding-right: 1.25rem !important;
        font-weight: 600 !important;
        border: none !important;
    }

    /* Footer */
    #tpl-verdure .v-footer {
        background: var(--v-forest);
        color: rgba(250,243,224,.75);
    }
    #tpl-verdure .v-footer a {
        color: rgba(250,243,224,.6);
        text-decoration: none;
        transition: color .2s;
    }
    #tpl-verdure .v-footer a:hover {
        color: var(--v-sage);
    }
    #tpl-verdure .v-footer-heading {
        color: var(--v-sage);
        font-family: 'Fraunces', serif;
        font-weight: 600;
    }
</style>

{{-- Alpine scroll-reveal init --}}
<script>
document.addEventListener('DOMContentLoaded', function () {
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) return;
    const obs = new IntersectionObserver((entries) => {
        entries.forEach(e => { if (e.isIntersecting) { e.target.classList.add('v-visible'); obs.unobserve(e.target); } });
    }, { threshold: 0.12 });
    document.querySelectorAll('#tpl-verdure .v-reveal').forEach(el => obs.observe(el));
});
</script>

<div id="tpl-verdure">

    {{-- ── NAV ──────────────────────────────────────────────── --}}
    <header class="v-nav sticky top-0 z-40">
        <div class="mx-auto flex h-16 max-w-6xl items-center gap-4 px-6">
            <a href="#" class="flex items-center gap-2 v-serif font-semibold text-lg" style="color:var(--v-moss)">
                <span class="flex size-8 items-center justify-center rounded-full" style="background:var(--v-moss)">
                    <x-lucide-leaf class="size-4" style="color:var(--v-cream)" />
                </span>
                Verdure
            </a>
            <nav class="ml-5 hidden items-center gap-1 text-sm md:flex">
                @foreach ($nav as $label => $href)
                    <a href="{{ $href }}" class="rounded-full px-4 py-1.5 font-medium transition-colors" style="color:var(--v-forest)">{{ $label }}</a>
                @endforeach
            </nav>
            <div class="ml-auto flex items-center gap-2">
                <a href="#pledge" class="v-btn-outline text-sm hidden sm:inline-flex">Donate</a>
                <a href="#pledge" class="v-btn-primary text-sm hidden sm:inline-flex"><x-lucide-heart class="size-4" /> Join the movement</a>
            </div>
        </div>
    </header>

    {{-- ── HERO ─────────────────────────────────────────────── --}}
    <section class="relative overflow-hidden" style="background: linear-gradient(160deg, #f0e9d2 0%, #e8f0e0 50%, #d8e8c8 100%); min-height: 88vh; display: flex; align-items: center;">

        {{-- Organic background blobs --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
            <div class="v-blob-1 absolute" style="width:52rem;height:52rem;top:-18rem;right:-18rem;background:radial-gradient(circle, rgba(163,177,138,.28) 0%, transparent 70%)"></div>
            <div class="v-blob-2 absolute" style="width:38rem;height:38rem;bottom:-12rem;left:-10rem;background:radial-gradient(circle, rgba(58,90,64,.15) 0%, transparent 70%)"></div>
        </div>

        {{-- Decorative leaf SVG --}}
        <svg class="v-leaf-deco" style="width:480px;right:2%;top:5%;transform:rotate(25deg)" viewBox="0 0 200 200" aria-hidden="true">
            <path d="M100 10 C140 10 180 50 180 100 C180 140 140 180 100 190 C60 180 20 140 20 100 C20 50 60 10 100 10Z" fill="#3a5a40"/>
            <path d="M100 10 L100 190 M60 50 Q100 80 140 50 M50 100 Q100 120 150 100 M60 150 Q100 130 140 150" stroke="#faf3e0" stroke-width="2" fill="none" opacity=".6"/>
        </svg>

        <div class="relative mx-auto grid max-w-6xl items-center gap-12 px-6 py-20 lg:grid-cols-2 lg:py-28 w-full">
            <div class="v-reveal">
                <div class="v-badge-moss mb-6 w-fit">
                    <x-lucide-sprout class="size-3.5" />
                    Certified B Corp · 2026
                </div>
                <h1 class="v-serif text-5xl font-bold leading-tight text-balance sm:text-6xl lg:text-7xl" style="color:var(--v-forest)">
                    Restore the<br />
                    <em style="color:var(--v-moss);font-style:italic">living world.</em>
                </h1>
                <p class="mt-5 max-w-lg text-lg leading-relaxed text-balance" style="color:var(--v-stone)">
                    Verdure channels science, community and capital into regenerative ecosystems — forests, peatlands and coasts that heal the climate and feed the future.
                </p>
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#pledge" class="v-btn-primary">
                        <x-lucide-heart class="size-4" /> Start giving
                    </a>
                    <a href="#initiatives" class="v-btn-outline">
                        <x-lucide-map-pin class="size-4" /> See projects
                    </a>
                </div>
                {{-- Impact badges --}}
                <div class="mt-9 flex flex-wrap gap-3">
                    @foreach ([['4.2M', 'trees'], ['18,400 t', 'CO₂'], ['96', 'ecosystems']] as [$n, $l])
                        <x-ui.tooltip>
                            <x-ui.tooltip-trigger>
                                <span class="v-badge-moss cursor-default text-sm">
                                    <strong style="font-family:'Fraunces',serif;font-size:1rem">{{ $n }}</strong> {{ $l }}
                                </span>
                            </x-ui.tooltip-trigger>
                            <x-ui.tooltip-content side="top">Verified impact figure · Q3 2025</x-ui.tooltip-content>
                        </x-ui.tooltip>
                    @endforeach
                </div>
                {{-- Avatars --}}
                <div class="mt-8 flex items-center gap-3">
                    <div class="flex -space-x-2">
                        @foreach (['verd-av1','verd-av2','verd-av3','verd-av4'] as $seed)
                            <x-ui.avatar class="size-10 ring-2" style="--tw-ring-color:var(--v-cream)">
                                <x-ui.avatar-image src="https://picsum.photos/seed/{{ $seed }}/80/80" alt="Verdure member" />
                                <x-ui.avatar-fallback style="background:var(--v-sage);color:var(--v-forest)">V</x-ui.avatar-fallback>
                            </x-ui.avatar>
                        @endforeach
                    </div>
                    <span class="text-sm" style="color:var(--v-stone)">
                        Join <strong style="color:var(--v-forest)">230,000+</strong> regenerators worldwide
                    </span>
                </div>
            </div>

            {{-- Hero image with organic blob mask --}}
            <div class="v-reveal relative flex items-center justify-center" style="transition-delay:.15s">
                <div class="relative w-full max-w-md mx-auto">
                    <div class="v-blob-1 overflow-hidden aspect-square" style="background:var(--v-sage)">
                        <img
                            src="https://picsum.photos/seed/verdure-hero/640/640"
                            alt="Lush restored forest canopy"
                            class="size-full object-cover mix-blend-multiply opacity-90"
                            loading="eager"
                        />
                    </div>
                    {{-- Floating stat card --}}
                    <div class="v-card absolute -bottom-4 -left-6 flex items-center gap-3 px-4 py-3 shadow-xl" style="border-radius:1rem">
                        <span class="flex size-10 items-center justify-center rounded-full" style="background:rgba(58,90,64,.1)">
                            <x-lucide-trending-up class="size-5" style="color:var(--v-moss)" />
                        </span>
                        <div>
                            <div class="v-serif font-bold text-lg leading-none" style="color:var(--v-moss)">+38%</div>
                            <div class="text-xs mt-0.5" style="color:var(--v-stone)">Forest cover this year</div>
                        </div>
                    </div>
                    {{-- Floating badge --}}
                    <div class="v-card absolute -top-3 -right-4 px-3 py-2 flex items-center gap-2 shadow-lg" style="border-radius:.9rem">
                        <x-lucide-check-circle class="size-4" style="color:var(--v-moss)" />
                        <span class="text-xs font-semibold" style="color:var(--v-forest)">Gold Standard verified</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── IMPACT STATS + CHART ─────────────────────────────── --}}
    <section id="impact" class="scroll-mt-20 v-section-alt py-20 lg:py-28">
        <div class="mx-auto max-w-6xl px-6">

            <div class="mx-auto max-w-2xl text-center v-reveal">
                <div class="v-badge-moss mb-4 w-fit mx-auto">
                    <x-lucide-bar-chart-3 class="size-3.5" />
                    Measurable change
                </div>
                <h2 class="v-serif text-4xl font-bold text-balance sm:text-5xl" style="color:var(--v-forest)">Our impact, in numbers</h2>
                <p class="mt-3 text-lg text-balance" style="color:var(--v-stone)">Every figure is third-party audited and updated quarterly. No greenwashing — just data.</p>
            </div>

            {{-- Stats grid --}}
            <div class="mt-14 grid grid-cols-2 gap-6 lg:grid-cols-4">
                @foreach ($impactStats as $i => $stat)
                    <div class="v-card v-reveal text-center p-6" style="transition-delay:{{ $i * 80 }}ms">
                        <div class="flex size-12 items-center justify-center rounded-full mx-auto mb-4" style="background:rgba(58,90,64,.1)">
                            <x-dynamic-component :component="'lucide-'.$stat['icon']" class="size-5" style="color:var(--v-moss)" />
                        </div>
                        <div class="v-stat-num">{{ $stat['value'] }}</div>
                        <div class="mt-2 text-sm font-medium" style="color:var(--v-stone)">{{ $stat['label'] }}</div>
                    </div>
                @endforeach
            </div>

            {{-- Chart + Goals --}}
            <div class="mt-16 grid gap-10 lg:grid-cols-[3fr_2fr] items-start">

                {{-- CO₂ Area Chart --}}
                <div class="v-card v-reveal p-6">
                    <div class="flex items-center justify-between mb-1">
                        <h3 class="v-serif font-semibold text-xl" style="color:var(--v-forest)">CO₂ removed over time</h3>
                        <span class="v-badge-moss text-xs">Cumulative · tonnes</span>
                    </div>
                    <p class="text-sm mb-4" style="color:var(--v-stone)">Accelerating removals since programme launch in early 2022.</p>
                    <x-ui.chart
                        type="area"
                        :series="$co2Series"
                        :options="$co2Options"
                        :colors="['#3a5a40']"
                        label="CO₂ removed over time in tonnes"
                        :height="220"
                        class="aspect-auto"
                    />
                </div>

                {{-- Goal progress --}}
                <div class="v-card v-reveal p-6" style="transition-delay:.1s">
                    <h3 class="v-serif font-semibold text-xl mb-1" style="color:var(--v-forest)">Progress to targets</h3>
                    <p class="text-sm mb-6" style="color:var(--v-stone)">Measured against 2025 programme milestones.</p>
                    <div class="space-y-5">
                        @foreach ($goals as $goal)
                            <div class="v-progress-wrap">
                                <div class="flex justify-between items-center mb-1.5">
                                    <span class="text-sm font-medium" style="color:var(--v-forest)">{{ $goal['label'] }}</span>
                                    <span class="v-serif font-bold text-sm" style="color:var(--v-moss)">{{ $goal['value'] }}%</span>
                                </div>
                                <x-ui.progress :value="$goal['value']" :ariaLabel="$goal['label'].' progress'" />
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── VALUES BENTO ─────────────────────────────────────── --}}
    <section id="mission" class="scroll-mt-20 py-20 lg:py-28" style="background:var(--v-cream)">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mx-auto max-w-2xl text-center v-reveal mb-14">
                <div class="v-badge-terra mb-4 w-fit mx-auto">
                    <x-lucide-heart class="size-3.5" />
                    Our principles
                </div>
                <h2 class="v-serif text-4xl font-bold text-balance sm:text-5xl" style="color:var(--v-forest)">Why Verdure is different</h2>
            </div>

            {{-- Bento grid of value cards --}}
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($values as $i => $val)
                    <div class="v-card v-reveal p-7" style="transition-delay:{{ $i * 70 }}ms">
                        <div class="flex size-12 items-center justify-center rounded-2xl mb-5" style="background:rgba(58,90,64,.08)">
                            <x-dynamic-component :component="'lucide-'.$val['icon']" class="size-6" style="color:var(--v-moss)" />
                        </div>
                        <h3 class="v-serif font-semibold text-lg mb-2" style="color:var(--v-forest)">{{ $val['title'] }}</h3>
                        <p class="text-sm leading-relaxed" style="color:var(--v-stone)">{{ $val['desc'] }}</p>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── HOW IT WORKS (STEPPER) ───────────────────────────── --}}
    <section class="v-section-alt py-20 lg:py-28">
        <div class="mx-auto max-w-4xl px-6">
            <div class="mx-auto max-w-2xl text-center v-reveal mb-14">
                <div class="v-badge-moss mb-4 w-fit mx-auto">
                    <x-lucide-footprints class="size-3.5" />
                    Simple process
                </div>
                <h2 class="v-serif text-4xl font-bold text-balance sm:text-5xl" style="color:var(--v-forest)">How it works</h2>
                <p class="mt-3 text-lg text-balance" style="color:var(--v-stone)">Four steps from first click to certified real-world impact.</p>
            </div>

            <x-ui.stepper :value="1" class="w-full v-reveal">
                <x-ui.stepper-nav>
                    @foreach ($howItWorks as $i => $step)
                        <x-ui.stepper-item :step="$i + 1">
                            <x-ui.stepper-trigger>
                                <x-ui.stepper-indicator />
                            </x-ui.stepper-trigger>
                            @if ($i < count($howItWorks) - 1)
                                <x-ui.stepper-separator />
                            @endif
                        </x-ui.stepper-item>
                    @endforeach
                </x-ui.stepper-nav>

                <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($howItWorks as $i => $step)
                        <div class="v-card p-5">
                            <div class="v-serif text-3xl font-bold mb-3" style="color:rgba(58,90,64,.2)">{{ str_pad($i+1, 2, '0', STR_PAD_LEFT) }}</div>
                            <h4 class="v-serif font-semibold text-base mb-2" style="color:var(--v-forest)">{{ $step['title'] }}</h4>
                            <p class="text-sm leading-relaxed" style="color:var(--v-stone)">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>

                <div class="flex justify-center gap-3 mt-8">
                    <x-ui.button variant="outline" x-bind:disabled="step === 1" x-on:click="step = Math.max(1, step - 1)" style="border-color:var(--v-moss);color:var(--v-moss);border-radius:9999px">
                        <x-lucide-arrow-left class="size-4" /> Back
                    </x-ui.button>
                    <x-ui.button x-bind:disabled="step === 4" x-on:click="step = Math.min(4, step + 1)" style="background:var(--v-moss);color:var(--v-cream);border-radius:9999px">
                        Next <x-lucide-arrow-right class="size-4" />
                    </x-ui.button>
                </div>
            </x-ui.stepper>
        </div>
    </section>

    {{-- ── INITIATIVES (TABS + CARDS) ──────────────────────── --}}
    <section id="initiatives" class="scroll-mt-20 py-20 lg:py-28" style="background:var(--v-cream)">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mx-auto max-w-2xl text-center v-reveal mb-12">
                <div class="v-badge-terra mb-4 w-fit mx-auto">
                    <x-lucide-map class="size-3.5" />
                    Active projects
                </div>
                <h2 class="v-serif text-4xl font-bold text-balance sm:text-5xl" style="color:var(--v-forest)">Where we're working</h2>
                <p class="mt-3 text-lg text-balance" style="color:var(--v-stone)">Six flagship initiatives across four continents — each shaped by the communities who call these landscapes home.</p>
            </div>

            <x-ui.tabs value="forests" class="w-full">
                <x-ui.tabs-list variant="pills" class="mx-auto w-fit mb-10" style="background:rgba(163,177,138,.2)">
                    <x-ui.tabs-trigger value="forests">Forests</x-ui.tabs-trigger>
                    <x-ui.tabs-trigger value="wetlands">Wetlands & Peat</x-ui.tabs-trigger>
                    <x-ui.tabs-trigger value="soil">Soil & Seeds</x-ui.tabs-trigger>
                </x-ui.tabs-list>

                <x-ui.tabs-content value="forests">
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach (array_slice($initiatives, 0, 3) as $proj)
                            <div class="v-card overflow-hidden v-reveal">
                                <div class="v-blob-3 overflow-hidden aspect-[4/3] -mx-6 -mt-6 mb-5">
                                    <img
                                        src="https://picsum.photos/seed/{{ $proj['img_seed'] }}/600/450"
                                        alt="{{ $proj['title'] }}"
                                        loading="lazy"
                                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                    />
                                </div>
                                <div class="flex items-center justify-between mb-3">
                                    <x-ui.badge tone="{{ $proj['tone'] }}" variant="soft">{{ $proj['tag'] }}</x-ui.badge>
                                    <span class="text-xs font-medium" style="color:var(--v-stone)">{{ $proj['region'] }}</span>
                                </div>
                                <h3 class="v-serif font-semibold text-lg mb-2" style="color:var(--v-forest)">{{ $proj['title'] }}</h3>
                                <p class="text-sm leading-relaxed mb-4" style="color:var(--v-stone)">{{ $proj['desc'] }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="v-badge-moss text-xs"><x-lucide-tree-pine class="size-3" /> {{ $proj['trees'] }}</span>
                                    <a href="#pledge" class="text-sm font-semibold transition-colors" style="color:var(--v-moss)">Support →</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </x-ui.tabs-content>

                <x-ui.tabs-content value="wetlands">
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ([$initiatives[1], $initiatives[5]] as $proj)
                            <div class="v-card overflow-hidden v-reveal">
                                <div class="v-blob-3 overflow-hidden aspect-[4/3] -mx-6 -mt-6 mb-5">
                                    <img
                                        src="https://picsum.photos/seed/{{ $proj['img_seed'] }}/600/450"
                                        alt="{{ $proj['title'] }}"
                                        loading="lazy"
                                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                    />
                                </div>
                                <div class="flex items-center justify-between mb-3">
                                    <x-ui.badge tone="{{ $proj['tone'] }}" variant="soft">{{ $proj['tag'] }}</x-ui.badge>
                                    <span class="text-xs font-medium" style="color:var(--v-stone)">{{ $proj['region'] }}</span>
                                </div>
                                <h3 class="v-serif font-semibold text-lg mb-2" style="color:var(--v-forest)">{{ $proj['title'] }}</h3>
                                <p class="text-sm leading-relaxed mb-4" style="color:var(--v-stone)">{{ $proj['desc'] }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="v-badge-moss text-xs"><x-lucide-tree-pine class="size-3" /> {{ $proj['trees'] }}</span>
                                    <a href="#pledge" class="text-sm font-semibold transition-colors" style="color:var(--v-moss)">Support →</a>
                                </div>
                            </div>
                        @endforeach
                        {{-- Teaser card --}}
                        <div class="v-card overflow-hidden flex flex-col items-center justify-center p-10 text-center" style="background:linear-gradient(135deg,rgba(58,90,64,.06),rgba(163,177,138,.12))">
                            <x-lucide-plus-circle class="size-10 mb-4" style="color:var(--v-moss);opacity:.5" />
                            <h3 class="v-serif font-semibold text-lg mb-2" style="color:var(--v-forest)">New projects launching 2026</h3>
                            <p class="text-sm" style="color:var(--v-stone)">Mekong Delta and Congo Basin initiatives in scoping phase.</p>
                        </div>
                    </div>
                </x-ui.tabs-content>

                <x-ui.tabs-content value="soil">
                    <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                        @foreach ([$initiatives[2], $initiatives[4]] as $proj)
                            <div class="v-card overflow-hidden v-reveal">
                                <div class="v-blob-3 overflow-hidden aspect-[4/3] -mx-6 -mt-6 mb-5">
                                    <img
                                        src="https://picsum.photos/seed/{{ $proj['img_seed'] }}/600/450"
                                        alt="{{ $proj['title'] }}"
                                        loading="lazy"
                                        class="w-full h-full object-cover transition-transform duration-500 hover:scale-105"
                                    />
                                </div>
                                <div class="flex items-center justify-between mb-3">
                                    <x-ui.badge tone="{{ $proj['tone'] }}" variant="soft">{{ $proj['tag'] }}</x-ui.badge>
                                    <span class="text-xs font-medium" style="color:var(--v-stone)">{{ $proj['region'] }}</span>
                                </div>
                                <h3 class="v-serif font-semibold text-lg mb-2" style="color:var(--v-forest)">{{ $proj['title'] }}</h3>
                                <p class="text-sm leading-relaxed mb-4" style="color:var(--v-stone)">{{ $proj['desc'] }}</p>
                                <div class="flex items-center justify-between">
                                    <span class="v-badge-moss text-xs"><x-lucide-tree-pine class="size-3" /> {{ $proj['trees'] }}</span>
                                    <a href="#pledge" class="text-sm font-semibold transition-colors" style="color:var(--v-moss)">Support →</a>
                                </div>
                            </div>
                        @endforeach
                        <div class="v-card overflow-hidden flex flex-col items-center justify-center p-10 text-center" style="background:linear-gradient(135deg,rgba(188,108,37,.06),rgba(163,177,138,.1))">
                            <x-lucide-sprout class="size-10 mb-4" style="color:var(--v-terra);opacity:.6" />
                            <h3 class="v-serif font-semibold text-lg mb-2" style="color:var(--v-forest)">Soil carbon pilot</h3>
                            <p class="text-sm" style="color:var(--v-stone)">Regenerative agriculture trials across four climate zones, launching 2026.</p>
                        </div>
                    </div>
                </x-ui.tabs-content>
            </x-ui.tabs>
        </div>
    </section>

    {{-- ── PROCESS GALLERY ─────────────────────────────────── --}}
    <section class="v-section-alt py-20 lg:py-24">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mx-auto max-w-2xl text-center v-reveal mb-12">
                <div class="v-badge-moss mb-4 w-fit mx-auto">
                    <x-lucide-camera class="size-3.5" />
                    Field gallery
                </div>
                <h2 class="v-serif text-4xl font-bold text-balance sm:text-5xl" style="color:var(--v-forest)">Restoration in action</h2>
                <p class="mt-3 text-lg text-balance" style="color:var(--v-stone)">From seed nursery to closed canopy — eight moments from the field.</p>
            </div>

            <div class="v-reveal">
                <x-ui.gallery :images="$galleryImages" :columns="4" rounded="v-blob-3 rounded-xl" />
            </div>
        </div>
    </section>

    {{-- ── TESTIMONIALS ─────────────────────────────────────── --}}
    <section class="py-20 lg:py-28" style="background:var(--v-cream)">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mx-auto max-w-2xl text-center v-reveal mb-12">
                <div class="v-badge-terra mb-4 w-fit mx-auto">
                    <x-lucide-quote class="size-3.5" />
                    Voices from the field
                </div>
                <h2 class="v-serif text-4xl font-bold text-balance sm:text-5xl" style="color:var(--v-forest)">Stories of regeneration</h2>
            </div>
            <div class="grid gap-6 lg:grid-cols-3">
                @foreach ($testimonials as $i => $t)
                    <div class="v-card v-reveal p-7" style="transition-delay:{{ $i * 100 }}ms">
                        <x-ui.quote
                            author="{{ $t['a'] }}"
                            role="{{ $t['r'] }}"
                            avatar="{{ $t['img'] }}"
                            class="max-w-none"
                        >{{ $t['q'] }}</x-ui.quote>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ── PARTNERS MARQUEE ─────────────────────────────────── --}}
    <section class="v-section-forest py-14">
        <p class="text-center text-sm font-medium mb-6" style="color:rgba(250,243,224,.5);letter-spacing:.08em;text-transform:uppercase">Our scientific & NGO partners</p>
        <x-ui.marquee fade :duration="'38s'" class="mx-auto max-w-5xl">
            @foreach ($partners as $partner)
                <span class="v-partner">{{ $partner }}</span>
            @endforeach
        </x-ui.marquee>
    </section>

    {{-- ── PLEDGE / CTA FORM ────────────────────────────────── --}}
    <section id="pledge" class="scroll-mt-20 v-section-moss py-24 lg:py-32 relative overflow-hidden">

        {{-- Blob decoration --}}
        <div class="pointer-events-none absolute inset-0 overflow-hidden" aria-hidden="true">
            <div class="v-blob-2 absolute" style="width:40rem;height:40rem;right:-12rem;top:-10rem;background:rgba(250,243,224,.06)"></div>
        </div>

        {{-- Leaf SVG deco --}}
        <svg class="v-leaf-deco" style="width:320px;left:-30px;bottom:-30px;transform:rotate(-15deg);opacity:.06" viewBox="0 0 200 200" aria-hidden="true">
            <path d="M100 10 C140 10 180 50 180 100 C180 140 140 180 100 190 C60 180 20 140 20 100 C20 50 60 10 100 10Z" fill="#faf3e0"/>
        </svg>

        <div class="relative mx-auto max-w-2xl px-6 text-center">
            <div class="mb-5 inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-sm font-medium" style="background:rgba(250,243,224,.12);color:var(--v-cream)">
                <x-lucide-sparkles class="size-4" style="color:var(--v-sage)" />
                Make a pledge today
            </div>
            <h2 class="v-serif text-4xl font-bold text-balance sm:text-5xl mb-3" style="color:var(--v-cream)">Become a regenerator</h2>
            <p class="text-lg mb-9" style="color:rgba(250,243,224,.75)">
                Your contribution — however small — plants trees, restores soil, and sequesters carbon. Join 230,000+ people choosing a living future.
            </p>

            <div class="v-pledge-input mx-auto max-w-md mb-5">
                <x-ui.input-group>
                    <x-ui.input-group-addon align="inline-start">
                        <x-lucide-mail class="size-4" style="color:rgba(250,243,224,.55)" />
                    </x-ui.input-group-addon>
                    <x-ui.input-group-input type="email" placeholder="your@email.com" aria-label="Email address" />
                    <x-ui.input-group-addon align="inline-end">
                        <x-ui.input-group-button variant="default">Join free</x-ui.input-group-button>
                    </x-ui.input-group-addon>
                </x-ui.input-group>
            </div>

            <p class="text-xs" style="color:rgba(250,243,224,.45)">No spam. Unsubscribe anytime. We plant a tree when you sign up.</p>

            <x-ui.separator class="my-8" style="background:rgba(250,243,224,.15)" />

            <div class="flex flex-wrap justify-center gap-4">
                <a href="#" class="v-btn-terra"><x-lucide-credit-card class="size-4" /> Monthly giving</a>
                <a href="#" class="inline-flex items-center gap-2 rounded-full border-2 px-5 py-2.5 text-sm font-semibold transition-colors" style="border-color:rgba(250,243,224,.35);color:var(--v-cream)" onmouseover="this.style.background='rgba(250,243,224,.1)'" onmouseout="this.style.background='transparent'">
                    <x-lucide-building-2 class="size-4" /> Corporate plans
                </a>
            </div>
        </div>
    </section>

    {{-- ── FAQ ───────────────────────────────────────────────── --}}
    <section id="faq" class="scroll-mt-20 v-section-alt py-20 lg:py-28">
        <div class="mx-auto max-w-3xl px-6">
            <div class="text-center v-reveal mb-12">
                <div class="v-badge-moss mb-4 w-fit mx-auto">
                    <x-lucide-help-circle class="size-3.5" />
                    Questions
                </div>
                <h2 class="v-serif text-4xl font-bold text-balance sm:text-5xl" style="color:var(--v-forest)">Everything you want to know</h2>
                <p class="mt-3 text-lg text-balance" style="color:var(--v-stone)">Still curious? Reach us at <a href="mailto:hello@verdure.earth" style="color:var(--v-moss)">hello@verdure.earth</a></p>
            </div>

            <div class="v-reveal v-card p-2 overflow-hidden">
                <x-ui.accordion type="single" collapsible value="faq-0" class="w-full">
                    @foreach ($faqs as $i => $faq)
                        <x-ui.accordion-item value="faq-{{ $i }}">
                            <x-ui.accordion-trigger class="px-5" style="color:var(--v-forest);font-weight:600">{{ $faq['q'] }}</x-ui.accordion-trigger>
                            <x-ui.accordion-content class="px-5" style="color:var(--v-stone)">{{ $faq['a'] }}</x-ui.accordion-content>
                        </x-ui.accordion-item>
                    @endforeach
                </x-ui.accordion>
            </div>
        </div>
    </section>

    {{-- ── FOOTER ───────────────────────────────────────────── --}}
    <footer class="v-footer">
        <div class="mx-auto max-w-6xl px-6 py-16">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-6">
                <div class="lg:col-span-2">
                    <a href="#" class="v-serif font-semibold text-xl flex items-center gap-2 mb-1" style="color:var(--v-sage)">
                        <span class="flex size-8 items-center justify-center rounded-full" style="background:var(--v-moss)">
                            <x-lucide-leaf class="size-4" style="color:var(--v-cream)" />
                        </span>
                        Verdure
                    </a>
                    <p class="text-sm leading-relaxed max-w-xs mt-3" style="color:rgba(250,243,224,.55)">Regenerating 96 ecosystems across 4 continents. Science-led, community-owned, radically transparent.</p>
                    <div class="mt-5 flex gap-2">
                        @foreach (['instagram', 'twitter', 'linkedin', 'youtube'] as $soc)
                            <a href="#" aria-label="{{ $soc }}" class="flex size-9 items-center justify-center rounded-md border transition-colors" style="border-color:rgba(163,177,138,.2);color:rgba(250,243,224,.5)" onmouseover="this.style.color='var(--v-sage)'" onmouseout="this.style.color='rgba(250,243,224,.5)'">
                                <x-dynamic-component :component="'lucide-'.$soc" class="size-4" />
                            </a>
                        @endforeach
                    </div>
                    <div class="mt-5">
                        <span class="v-badge-moss text-xs inline-flex items-center gap-1.5" style="background:rgba(163,177,138,.15);color:var(--v-sage)">
                            <x-lucide-award class="size-3" /> Certified B Corp 2026
                        </span>
                    </div>
                </div>
                @foreach ($footerLinks as $heading => $links)
                    <div>
                        <h3 class="v-footer-heading text-sm mb-4">{{ $heading }}</h3>
                        <ul class="space-y-2 text-sm">
                            @foreach ($links as $link)
                                <li><a href="#">{{ $link }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <x-ui.separator class="my-8" style="background:rgba(163,177,138,.15)" />

            <div class="flex flex-col items-center justify-between gap-3 text-xs sm:flex-row" style="color:rgba(250,243,224,.35)">
                <span>© {{ date('Y') }} Verdure Earth Ltd. All rights reserved.</span>
                <div class="flex items-center gap-4">
                    <a href="#" class="hover:text-sage transition-colors" style="color:rgba(250,243,224,.35)">Privacy</a>
                    <a href="#" class="hover:text-sage transition-colors" style="color:rgba(250,243,224,.35)">Terms</a>
                    <a href="#" class="hover:text-sage transition-colors" style="color:rgba(250,243,224,.35)">Cookie policy</a>
                    <span class="flex items-center gap-1.5"><x-lucide-shield-check class="size-3.5" /> Gold Standard verified</span>
                </div>
            </div>
        </div>
    </footer>

</div>

</x-layouts.app>
