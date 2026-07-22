@php
    $navLinks = ['Destinations' => '#destinations', 'Experience' => '#experience', 'Packages' => '#packages', 'Crew' => '#crew', 'FAQ' => '#faq'];

    $destinations = [
        'orbit' => [
            'label' => 'Low Orbit',
            'icon' => 'orbit',
            'title' => 'Earth from 400 km',
            'desc' => 'Spend 3 days aboard the Orbital Station, floating above the curvature of Earth with a view no photograph can capture. Witness 16 sunrises per day.',
            'img' => 'https://picsum.photos/seed/orbit-earth/900/500',
            'duration' => '3 days',
            'altitude' => '408 km',
            'crew' => '6 passengers',
            'price' => '$495,000',
        ],
        'lunar' => [
            'label' => 'Lunar Gateway',
            'icon' => 'moon',
            'title' => 'Cislunar Space',
            'desc' => 'Join the Lunar Gateway crew 60,000 km beyond the Moon. No human has travelled this far since Apollo 17. You will be one of a handful who have.',
            'img' => 'https://picsum.photos/seed/lunar-gateway/900/500',
            'duration' => '8 days',
            'altitude' => '60,000 km',
            'crew' => '4 passengers',
            'price' => '$2.1M',
        ],
        'mars' => [
            'label' => 'Mars Flyby',
            'icon' => 'globe',
            'title' => 'Red Planet Passage',
            'desc' => 'The ultimate voyage: a 210-day transit looping around Mars at 600 km. Close enough to see Olympus Mons with the naked eye.',
            'img' => 'https://picsum.photos/seed/mars-planet/900/500',
            'duration' => '210 days',
            'altitude' => '600 km',
            'crew' => '2 passengers',
            'price' => '$55M',
        ],
    ];

    $experiences = [
        ['icon' => 'wind', 'title' => 'Zero-G Adaptation', 'desc' => 'Three days of pre-flight zero-gravity training in our parabolic aircraft — 30 seconds of weightlessness, repeated 20 times a session.', 'img' => 'https://picsum.photos/seed/zerog-float/600/400', 'tag' => 'Pre-flight'],
        ['icon' => 'eye', 'title' => 'The Cupola Window', 'desc' => 'A 360° panoramic dome 1.2 m wide. The largest window ever flown in space — designed for photography, reflection, and pure awe.', 'img' => 'https://picsum.photos/seed/cupola-view/600/400', 'tag' => 'On-board'],
        ['icon' => 'dumbbell', 'title' => 'Astronaut Training', 'desc' => 'Six months of Mission Readiness at our Houston campus: EVA simulation, emergency procedures, Russian language, and spacecraft systems.', 'img' => 'https://picsum.photos/seed/astro-train/600/400', 'tag' => 'Preparation'],
        ['icon' => 'sparkles', 'title' => 'Spacewalk (EVA)', 'desc' => 'Step outside. Premium packages include a fully supervised EVA — you, a pressurised suit, and the silent black of open space.', 'img' => 'https://picsum.photos/seed/spacewalk-eva/600/400', 'tag' => 'Add-on'],
    ];

    $gallery = [
        ['img' => 'https://picsum.photos/seed/cosmos-launch/900/600', 'alt' => 'Rocket launch at night'],
        ['img' => 'https://picsum.photos/seed/cosmos-earth2/900/600', 'alt' => 'Earth from orbit'],
        ['img' => 'https://picsum.photos/seed/cosmos-dock/900/600',   'alt' => 'Orbital docking sequence'],
        ['img' => 'https://picsum.photos/seed/cosmos-suit/900/600',   'alt' => 'Spacewalk EVA crew'],
        ['img' => 'https://picsum.photos/seed/cosmos-mars3/900/600',  'alt' => 'Mars horizon flyby'],
    ];

    $packages = [
        [
            'name' => 'Horizon',
            'tag' => 'Low Orbit · 3 days',
            'price' => '$495,000',
            'rating' => 4,
            'highlight' => false,
            'badge' => null,
            'img' => 'https://picsum.photos/seed/pkg-horizon/600/340',
            'features' => ['Orbital Station berth', 'Zero-G training (3 days)', 'Private cupola session', 'Commemorative EVA suit'],
        ],
        [
            'name' => 'Selene',
            'tag' => 'Lunar Gateway · 8 days',
            'price' => '$2.1M',
            'rating' => 5,
            'highlight' => true,
            'badge' => 'Most popular',
            'img' => 'https://picsum.photos/seed/pkg-selene/600/340',
            'features' => ['Cislunar trajectory', 'Full astronaut training', 'Private sleeping quarters', 'EVA add-on eligible', '24/7 mission support'],
        ],
        [
            'name' => 'Ares',
            'tag' => 'Mars Flyby · 210 days',
            'price' => '$55M',
            'rating' => 5,
            'highlight' => false,
            'badge' => 'Expedition',
            'img' => 'https://picsum.photos/seed/pkg-ares/600/340',
            'features' => ['Mars flyby trajectory', 'Full crew integration', 'Scientific payload slot', 'Included EVA × 3', 'Custom mission patch'],
        ],
    ];

    $crew = [
        ['name' => 'Cmdr. Nadia Voss', 'role' => 'Mission Commander', 'flights' => 4, 'seed' => '10/80'],
        ['name' => 'Dr. Felix Obara', 'role' => 'Chief Medical Officer', 'flights' => 2, 'seed' => '20/80'],
        ['name' => 'Yuki Tanaka', 'role' => 'Flight Engineer', 'flights' => 3, 'seed' => '30/80'],
        ['name' => 'Sara Al-Rashid', 'role' => 'Science Lead', 'flights' => 1, 'seed' => '40/80'],
        ['name' => 'Mikhail Petrov', 'role' => 'EVA Specialist', 'flights' => 5, 'seed' => '50/80'],
        ['name' => 'Lena Hartmann', 'role' => 'Propulsion Eng.', 'flights' => 2, 'seed' => '60/80'],
    ];

    $faqs = [
        ['q' => 'Do I need prior flight experience?', 'a' => 'No prior flight experience is required. Our six-month Mission Readiness programme is included in Selene and Ares packages — it is designed to prepare civilians with no background in aviation.'],
        ['q' => 'What are the health requirements?', 'a' => 'Passengers must pass a standard astronaut medical evaluation (blood pressure, cardiovascular fitness, vestibular function). Most healthy adults aged 18–70 qualify. We work with leading aerospace physicians to support candidates near the thresholds.'],
        ['q' => 'How is my safety guaranteed?', 'a' => 'Every Orbital vehicle has flown uncrewed and crewed test missions. We have a 100% crew-return record across 38 missions. Redundant life support, autonomous abort systems, and a dedicated flight surgeon on every mission.'],
        ['q' => 'Can I bring personal items?', 'a' => 'Each passenger is allocated 2 kg of personal cargo. Items that have flown to space hold significant sentimental (and re-sale) value. Orbital provides a certified manifest and certificate of flight.'],
        ['q' => 'What does the price include?', 'a' => 'All training, transportation to the launch site, pre-flight quarantine accommodation, the flight itself, post-flight medical evaluation, and a full-resolution mission media package. Horizon: excludes EVA. Selene / Ares: fully all-inclusive.'],
    ];

    $stats = [
        ['v' => '38', 'l' => 'Crewed missions'],
        ['v' => '100%', 'l' => 'Crew return rate'],
        ['v' => '147', 'l' => 'Civilians flown'],
        ['v' => '3', 'l' => 'Destinations'],
    ];

    $milestones = [
        ['year' => '2019', 'title' => 'Founded', 'desc' => 'Orbital established with a single ambition: safe, affordable commercial spaceflight.'],
        ['year' => '2021', 'title' => 'First Uncrewed', 'desc' => 'Aurora-1 completes 12 orbital laps and re-enters with a 0.0 m/s vert-velocity error.'],
        ['year' => '2023', 'title' => 'First Civilians', 'desc' => 'Horizon-1 carries 4 private passengers to the Orbital Station for 3 days.'],
        ['year' => '2025', 'title' => 'Lunar Gateway', 'desc' => 'Selene-1 becomes the first non-government vehicle to reach cislunar space.'],
        ['year' => '2028', 'title' => 'Mars Flyby', 'desc' => 'Ares-1 departs for Mars — the farthest any civilian has ever travelled.'],
    ];

    $footer = [
        'Missions' => ['Low Orbit', 'Lunar Gateway', 'Mars Flyby', 'Custom Mission'],
        'Company' => ['About Orbital', 'Careers', 'Press', 'Investors', 'Contact'],
        'Safety' => ['Safety Record', 'Medical FAQ', 'Mission Readiness', 'Insurance'],
        'Legal' => ['Privacy Policy', 'Terms', 'Liability Waiver', 'Cookies'],
    ];

    // Launch countdown target — next launch ~6 months away
    $launchTs = mktime(0, 0, 0, 11, 14, 2026);
@endphp

<x-layouts.app title="Orbital — Space Tourism">

<style>
/* ============================================================
   COSMOS TEMPLATE — scoped under #tpl-cosmos
   ============================================================ */
@import url('https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700&display=swap');

/* Force the template's own dark color scheme regardless of site theme */
#tpl-cosmos,
#tpl-cosmos *:not(.cosmos-passthrough) {
    --cosmos-bg: #05060f;
    --cosmos-bg2: #0a0e24;
    --cosmos-indigo: #4338ca;
    --cosmos-violet: #7c3aed;
    --cosmos-magenta: #db2777;
    --cosmos-cyan: #06b6d4;
    --cosmos-white: #f8fafc;
    --cosmos-muted: #94a3b8;
    --cosmos-amber: #fbbf24;
    --cosmos-card: rgba(255,255,255,0.04);
    --cosmos-border: rgba(255,255,255,0.10);
    color-scheme: dark;
}

#tpl-cosmos {
    background: var(--cosmos-bg);
    color: var(--cosmos-white);
    font-family: 'Inter', system-ui, sans-serif;
    overflow-x: hidden;
    min-height: 100dvh;
}

/* Typography */
#tpl-cosmos h1,
#tpl-cosmos h2,
#tpl-cosmos h3,
#tpl-cosmos .font-space {
    font-family: 'Space Grotesk', 'Inter', system-ui, sans-serif;
}

/* ── Starfield ─────────────────────────────────────────────── */
.cosmos-stars {
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 0;
    background:
        radial-gradient(1px 1px at 10% 15%, rgba(248,250,252,0.85) 0%, transparent 100%),
        radial-gradient(1px 1px at 25% 42%, rgba(248,250,252,0.70) 0%, transparent 100%),
        radial-gradient(1px 1px at 38% 8%, rgba(248,250,252,0.90) 0%, transparent 100%),
        radial-gradient(1px 1px at 52% 67%, rgba(248,250,252,0.65) 0%, transparent 100%),
        radial-gradient(1px 1px at 63% 22%, rgba(248,250,252,0.80) 0%, transparent 100%),
        radial-gradient(1px 1px at 74% 88%, rgba(248,250,252,0.70) 0%, transparent 100%),
        radial-gradient(1px 1px at 87% 35%, rgba(248,250,252,0.85) 0%, transparent 100%),
        radial-gradient(1px 1px at 92% 55%, rgba(248,250,252,0.60) 0%, transparent 100%),
        radial-gradient(1.5px 1.5px at 18% 78%, rgba(248,250,252,0.75) 0%, transparent 100%),
        radial-gradient(1.5px 1.5px at 44% 95%, rgba(248,250,252,0.80) 0%, transparent 100%),
        radial-gradient(1px 1px at 56% 48%, rgba(248,250,252,0.65) 0%, transparent 100%),
        radial-gradient(1px 1px at 79% 12%, rgba(248,250,252,0.90) 0%, transparent 100%),
        radial-gradient(1px 1px at 5% 60%, rgba(248,250,252,0.70) 0%, transparent 100%),
        radial-gradient(1px 1px at 31% 30%, rgba(248,250,252,0.55) 0%, transparent 100%),
        radial-gradient(1px 1px at 68% 72%, rgba(248,250,252,0.75) 0%, transparent 100%),
        radial-gradient(1px 1px at 84% 5%, rgba(248,250,252,0.85) 0%, transparent 100%),
        radial-gradient(2px 2px at 48% 38%, rgba(6,182,212,0.60) 0%, transparent 100%),
        radial-gradient(2px 2px at 72% 62%, rgba(124,58,237,0.50) 0%, transparent 100%),
        radial-gradient(2px 2px at 15% 90%, rgba(6,182,212,0.45) 0%, transparent 100%);
    background-size: 100% 100%;
    animation: cosmos-twinkle 8s ease-in-out infinite alternate;
}

@keyframes cosmos-twinkle {
    0%   { opacity: 0.75; }
    50%  { opacity: 1; }
    100% { opacity: 0.60; }
}

/* ── Nebula haze blobs ─────────────────────────────────────── */
.cosmos-nebula {
    position: absolute;
    inset: 0;
    pointer-events: none;
    overflow: hidden;
    z-index: 0;
}
.cosmos-nebula::before {
    content: '';
    position: absolute;
    top: -20%;
    left: -10%;
    width: 70%;
    height: 70%;
    background: radial-gradient(ellipse at center, rgba(67,56,202,0.22) 0%, transparent 70%);
    filter: blur(60px);
    animation: cosmos-drift 18s ease-in-out infinite alternate;
}
.cosmos-nebula::after {
    content: '';
    position: absolute;
    bottom: -10%;
    right: -5%;
    width: 60%;
    height: 60%;
    background: radial-gradient(ellipse at center, rgba(219,39,119,0.18) 0%, transparent 70%);
    filter: blur(80px);
    animation: cosmos-drift 22s ease-in-out infinite alternate-reverse;
}
.cosmos-nebula-cyan {
    position: absolute;
    top: 20%;
    right: 10%;
    width: 40%;
    height: 40%;
    background: radial-gradient(ellipse at center, rgba(6,182,212,0.14) 0%, transparent 70%);
    filter: blur(60px);
    animation: cosmos-drift 26s ease-in-out infinite alternate;
}

@keyframes cosmos-drift {
    0%   { transform: translate(0, 0) scale(1); }
    100% { transform: translate(40px, 30px) scale(1.08); }
}

/* ── Planet / orb ─────────────────────────────────────────── */
.cosmos-planet {
    position: absolute;
    right: -80px;
    top: 50%;
    transform: translateY(-50%);
    width: 520px;
    height: 520px;
    border-radius: 50%;
    background: radial-gradient(circle at 35% 35%,
        rgba(99,102,241,0.9) 0%,
        rgba(67,56,202,0.8) 25%,
        rgba(10,14,36,0.95) 65%,
        rgba(5,6,15,1) 100%);
    box-shadow:
        0 0 60px 20px rgba(67,56,202,0.35),
        0 0 120px 40px rgba(124,58,237,0.20),
        inset -30px -20px 60px rgba(0,0,0,0.6);
    pointer-events: none;
}
.cosmos-planet::after {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%) rotate(-20deg);
    width: 140%;
    height: 30%;
    border-radius: 50%;
    border: 18px solid rgba(124,58,237,0.22);
    box-shadow: 0 0 30px rgba(124,58,237,0.15);
}
.cosmos-planet-sm {
    position: absolute;
    left: -40px;
    bottom: 10%;
    width: 200px;
    height: 200px;
    border-radius: 50%;
    background: radial-gradient(circle at 40% 30%,
        rgba(6,182,212,0.7) 0%,
        rgba(10,14,36,0.9) 60%,
        rgba(5,6,15,1) 100%);
    box-shadow: 0 0 40px 10px rgba(6,182,212,0.25);
    pointer-events: none;
}

/* ── Gradient text ─────────────────────────────────────────── */
.cosmos-gradient-text {
    background: linear-gradient(135deg, var(--cosmos-indigo) 0%, var(--cosmos-violet) 35%, var(--cosmos-magenta) 65%, var(--cosmos-cyan) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* ── Cards ─────────────────────────────────────────────────── */
.cosmos-card {
    background: var(--cosmos-card);
    border: 1px solid var(--cosmos-border);
    border-radius: 16px;
    backdrop-filter: blur(8px);
    -webkit-backdrop-filter: blur(8px);
    transition: border-color 0.3s, box-shadow 0.3s, transform 0.3s;
}
.cosmos-card:hover {
    border-color: rgba(124,58,237,0.40);
    box-shadow: 0 8px 40px rgba(124,58,237,0.15);
    transform: translateY(-2px);
}

/* ── Glow buttons ──────────────────────────────────────────── */
.cosmos-btn-primary {
    background: linear-gradient(135deg, var(--cosmos-indigo), var(--cosmos-violet));
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 0.65rem 1.5rem;
    font-weight: 600;
    font-size: 0.9375rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    transition: box-shadow 0.25s, transform 0.2s;
    text-decoration: none;
    white-space: nowrap;
}
.cosmos-btn-primary:hover {
    box-shadow: 0 0 24px rgba(124,58,237,0.55);
    transform: translateY(-1px);
}
.cosmos-btn-outline {
    background: transparent;
    color: var(--cosmos-white);
    border: 1px solid var(--cosmos-border);
    border-radius: 8px;
    padding: 0.65rem 1.5rem;
    font-weight: 600;
    font-size: 0.9375rem;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    cursor: pointer;
    transition: border-color 0.25s, background 0.25s, transform 0.2s;
    text-decoration: none;
    white-space: nowrap;
}
.cosmos-btn-outline:hover {
    border-color: rgba(124,58,237,0.60);
    background: rgba(124,58,237,0.10);
    transform: translateY(-1px);
}

/* ── Countdown ─────────────────────────────────────────────── */
.cosmos-countdown-unit {
    background: rgba(255,255,255,0.05);
    border: 1px solid var(--cosmos-border);
    border-radius: 12px;
    padding: 1rem 1.25rem;
    text-align: center;
    min-width: 72px;
}
.cosmos-countdown-num {
    font-family: 'Space Grotesk', monospace;
    font-size: 2.25rem;
    font-weight: 700;
    line-height: 1;
    font-variant-numeric: tabular-nums;
    background: linear-gradient(180deg, var(--cosmos-white) 60%, rgba(124,58,237,0.7) 100%);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}
.cosmos-countdown-label {
    font-size: 0.6875rem;
    font-weight: 500;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    color: var(--cosmos-muted);
    margin-top: 0.25rem;
}

/* ── Separator ─────────────────────────────────────────────── */
.cosmos-hr {
    height: 1px;
    background: linear-gradient(90deg, transparent, rgba(124,58,237,0.4), transparent);
    border: none;
    margin: 0;
}

/* ── Stat card ─────────────────────────────────────────────── */
.cosmos-stat {
    text-align: center;
    padding: 2rem 1rem;
}
.cosmos-stat-val {
    font-family: 'Space Grotesk', sans-serif;
    font-size: 2.75rem;
    font-weight: 700;
    background: linear-gradient(135deg, var(--cosmos-cyan), var(--cosmos-violet));
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
    background-clip: text;
}

/* ── Section label ─────────────────────────────────────────── */
.cosmos-label {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.25rem 0.75rem;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 600;
    letter-spacing: 0.07em;
    text-transform: uppercase;
    border: 1px solid rgba(124,58,237,0.35);
    background: rgba(124,58,237,0.12);
    color: rgba(167,139,250,1);
    margin-bottom: 1rem;
}

/* ── Marquee partner text ──────────────────────────────────── */
.cosmos-marquee-item {
    padding: 0 2rem;
    font-weight: 700;
    font-size: 0.875rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: rgba(148,163,184,0.55);
    white-space: nowrap;
}

/* ── Tabs override for cosmos ──────────────────────────────── */
#tpl-cosmos [data-slot="tabs-list"] {
    background: rgba(255,255,255,0.05) !important;
}
#tpl-cosmos [data-slot="tabs-trigger"][data-state="active"] {
    background: rgba(124,58,237,0.25) !important;
    color: #fff !important;
    border-color: rgba(124,58,237,0.4) !important;
}
#tpl-cosmos [data-slot="tabs-trigger"] {
    color: var(--cosmos-muted) !important;
}

/* ── Accordion override ────────────────────────────────────── */
#tpl-cosmos [data-slot="accordion-item"] {
    border-color: var(--cosmos-border) !important;
}
#tpl-cosmos [data-slot="accordion-trigger"] {
    color: var(--cosmos-white) !important;
}

/* ── Stepper override ──────────────────────────────────────── */
#tpl-cosmos [data-slot="stepper-indicator"][data-state="active"] {
    border-color: var(--cosmos-violet) !important;
    background: var(--cosmos-violet) !important;
}
#tpl-cosmos [data-slot="stepper-indicator"][data-state="completed"] {
    border-color: var(--cosmos-cyan) !important;
    background: var(--cosmos-cyan) !important;
    color: #05060f !important;
}
#tpl-cosmos [data-slot="stepper-separator"][data-state="completed"] {
    background: var(--cosmos-cyan) !important;
}

/* ── Progress override ─────────────────────────────────────── */
#tpl-cosmos [data-slot="progress"] {
    background: rgba(255,255,255,0.08) !important;
}
#tpl-cosmos [data-slot="progress"] [data-slot="progress-indicator"] {
    background: linear-gradient(90deg, var(--cosmos-violet), var(--cosmos-cyan)) !important;
}

/* ── Tooltip override ──────────────────────────────────────── */
#tpl-cosmos [data-slot="tooltip-content"] {
    background: rgba(10,14,36,0.95) !important;
    border: 1px solid var(--cosmos-border) !important;
    color: var(--cosmos-white) !important;
}

/* ── Reduced motion ────────────────────────────────────────── */
@media (prefers-reduced-motion: reduce) {
    .cosmos-stars,
    .cosmos-nebula::before,
    .cosmos-nebula::after,
    .cosmos-nebula-cyan,
    .cosmos-planet {
        animation: none !important;
        transition: none !important;
    }
    .cosmos-card {
        transition: none !important;
    }
    .cosmos-btn-primary,
    .cosmos-btn-outline {
        transition: none !important;
    }
}

/* Responsive helpers */
@media (max-width: 768px) {
    .cosmos-planet { display: none; }
    .cosmos-planet-sm { display: none; }
    .cosmos-countdown-num { font-size: 1.625rem; }
    .cosmos-countdown-unit { min-width: 52px; padding: 0.6rem 0.8rem; }
}

/* ── Glow line ─────────────────────────────────────────────── */
.cosmos-glow-line {
    height: 1px;
    background: linear-gradient(90deg, transparent 0%, var(--cosmos-violet) 30%, var(--cosmos-cyan) 70%, transparent 100%);
    opacity: 0.6;
}

/* Nav glow on scroll */
.cosmos-nav {
    position: sticky;
    top: 0;
    z-index: 50;
    background: rgba(5,6,15,0.80);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
    border-bottom: 1px solid var(--cosmos-border);
}

/* ── Mission timeline ──────────────────────────────────────── */
.cosmos-timeline-dot {
    width: 12px;
    height: 12px;
    border-radius: 50%;
    background: var(--cosmos-violet);
    box-shadow: 0 0 12px rgba(124,58,237,0.7);
    flex-shrink: 0;
    margin-top: 4px;
}
</style>

<div id="tpl-cosmos">
    <!-- Fixed starfield -->
    <div class="cosmos-stars" aria-hidden="true"></div>

    {{-- ── ANNOUNCEMENT BANNER ── --}}
    <x-ui.banner tone="primary" id="cosmos-launch-banner" persist>
        <span class="inline-flex items-center gap-2">
            <x-lucide-rocket class="size-4" aria-hidden="true" />
            Ares-1 Mars Flyby seats now open — only 2 berths available
        </span>
        <a href="#packages" class="font-semibold underline underline-offset-2">Reserve yours</a>
    </x-ui.banner>

    {{-- ── NAV ── --}}
    <header class="cosmos-nav">
        <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-6">
            <!-- Logo -->
            <a href="#" class="flex items-center gap-2 font-space font-bold text-lg tracking-tight" style="color: var(--cosmos-white);">
                <span style="background: linear-gradient(135deg, var(--cosmos-indigo), var(--cosmos-violet)); display:flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px;">
                    <x-lucide-orbit class="size-5" style="color:#fff;" />
                </span>
                ORBITAL
            </a>
            <nav class="ml-6 hidden items-center gap-1 text-sm md:flex">
                @foreach ($navLinks as $label => $href)
                    <a href="{{ $href }}" class="rounded-md px-3 py-1.5 font-medium transition-colors"
                       style="color: var(--cosmos-muted);"
                       onmouseover="this.style.color='#f8fafc'; this.style.background='rgba(255,255,255,0.06)';"
                       onmouseout="this.style.color=''; this.style.background='';">{{ $label }}</a>
                @endforeach
            </nav>
            <div class="ml-auto flex items-center gap-2">
                <a href="#packages" class="cosmos-btn-primary hidden sm:inline-flex" style="padding: 0.45rem 1.1rem; font-size:0.875rem;">
                    Book a mission <x-lucide-arrow-right class="size-4" aria-hidden="true" />
                </a>
            </div>
        </div>
    </header>

    {{-- ── HERO ── --}}
    <section style="position:relative; min-height:92dvh; display:flex; align-items:center; overflow:hidden; padding: 5rem 0 4rem;">
        <div class="cosmos-nebula" aria-hidden="true">
            <div class="cosmos-nebula-cyan"></div>
        </div>
        <!-- Planet orb -->
        <div class="cosmos-planet" aria-hidden="true"></div>
        <div class="cosmos-planet-sm" aria-hidden="true"></div>

        <div class="mx-auto max-w-7xl px-6 relative" style="z-index:1;">
            <div class="max-w-3xl">
                <div class="cosmos-label">
                    <x-lucide-sparkles class="size-3" aria-hidden="true" />
                    Commercial Spaceflight
                </div>
                <h1 class="font-space font-bold tracking-tight" style="font-size: clamp(3rem, 8vw, 6rem); line-height: 1.03; color: var(--cosmos-white);">
                    BEYOND<br>
                    <span class="cosmos-gradient-text">THE BLUE</span>
                </h1>
                <p class="mt-5 text-lg leading-relaxed max-w-xl" style="color: var(--cosmos-muted);">
                    The first generation of private space explorers didn't wait. Join them.
                    Orbital makes human spaceflight real for civilians — from low Earth orbit to the edge of Mars.
                </p>

                <!-- Badges -->
                <div class="mt-5 flex flex-wrap gap-2">
                    <span class="cosmos-label" style="margin-bottom:0;">
                        <x-lucide-shield-check class="size-3" aria-hidden="true" />
                        100% crew return rate
                    </span>
                    <span class="cosmos-label" style="margin-bottom:0; border-color:rgba(6,182,212,0.35); background:rgba(6,182,212,0.10); color:rgba(103,232,249,1);">
                        <x-lucide-star class="size-3" aria-hidden="true" />
                        38 crewed missions
                    </span>
                    <span class="cosmos-label" style="margin-bottom:0; border-color:rgba(251,191,36,0.35); background:rgba(251,191,36,0.10); color:rgba(251,191,36,1);">
                        <x-lucide-award class="size-3" aria-hidden="true" />
                        FAA licensed
                    </span>
                </div>

                <!-- CTA -->
                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="#packages" class="cosmos-btn-primary">
                        Explore missions
                        <x-lucide-rocket class="size-4" aria-hidden="true" />
                    </a>
                    <a href="#experience" class="cosmos-btn-outline">
                        <x-lucide-play class="size-4" aria-hidden="true" />
                        How it works
                    </a>
                </div>

                <!-- Launch Countdown -->
                <div class="mt-10"
                     x-data="{
                         target: {{ $launchTs }},
                         days: 0, hrs: 0, mins: 0, secs: 0,
                         tick() {
                             const diff = Math.max(0, this.target - Math.floor(Date.now() / 1000));
                             this.days = Math.floor(diff / 86400);
                             this.hrs  = Math.floor((diff % 86400) / 3600);
                             this.mins = Math.floor((diff % 3600) / 60);
                             this.secs = diff % 60;
                         },
                         pad(n) { return String(n).padStart(2, '0'); },
                         init() { this.tick(); setInterval(() => this.tick(), 1000); }
                     }">
                    <p class="text-xs font-semibold uppercase tracking-widest mb-3" style="color: var(--cosmos-muted);">Next launch — Ares-1 · Nov 14 2026</p>
                    <div class="flex items-start gap-3 flex-wrap">
                        <div class="cosmos-countdown-unit">
                            <div class="cosmos-countdown-num" x-text="pad(days)">000</div>
                            <div class="cosmos-countdown-label">Days</div>
                        </div>
                        <div class="cosmos-countdown-unit">
                            <div class="cosmos-countdown-num" x-text="pad(hrs)">00</div>
                            <div class="cosmos-countdown-label">Hours</div>
                        </div>
                        <div class="cosmos-countdown-unit">
                            <div class="cosmos-countdown-num" x-text="pad(mins)">00</div>
                            <div class="cosmos-countdown-label">Min</div>
                        </div>
                        <div class="cosmos-countdown-unit">
                            <div class="cosmos-countdown-num" x-text="pad(secs)">00</div>
                            <div class="cosmos-countdown-label">Sec</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="cosmos-glow-line"></div>

    {{-- ── PARTNER MARQUEE ── --}}
    <section style="padding: 2rem 0; background: rgba(10,14,36,0.7); border-bottom: 1px solid var(--cosmos-border);">
        <p class="text-center text-xs font-semibold uppercase tracking-widest mb-4" style="color: var(--cosmos-muted);">Trusted by explorers from</p>
        <x-ui.marquee fade :duration="'36s'" class="max-w-5xl mx-auto">
            @foreach (['NASA Partners', 'ESA Alumni', 'SpaceX Crew', 'MIT AeroAstro', 'Blue Origin', 'JAXA Collab', 'Stanford SSI', 'CNES France', 'DLR Germany'] as $partner)
                <span class="cosmos-marquee-item">{{ $partner }}</span>
            @endforeach
        </x-ui.marquee>
    </section>

    {{-- ── STATS ── --}}
    <section style="padding: 3rem 0; position:relative; z-index:1;">
        <div class="mx-auto max-w-5xl px-6">
            <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
                @foreach ($stats as $s)
                    <div class="cosmos-card cosmos-stat">
                        <div class="cosmos-stat-val">{{ $s['v'] }}</div>
                        <div class="text-sm mt-1" style="color: var(--cosmos-muted);">{{ $s['l'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="cosmos-hr"></div>

    {{-- ── DESTINATIONS (TABS) ── --}}
    <section id="destinations" class="scroll-mt-20" style="padding: 5rem 0; position:relative; z-index:1;">
        <div class="mx-auto max-w-6xl px-6">
            <div class="text-center mb-12">
                <div class="cosmos-label" style="display:inline-flex;">
                    <x-lucide-map-pin class="size-3" aria-hidden="true" />
                    Destinations
                </div>
                <h2 class="font-space font-bold text-4xl md:text-5xl" style="color: var(--cosmos-white);">
                    Where do you want to go?
                </h2>
                <p class="mt-3 max-w-xl mx-auto text-lg" style="color: var(--cosmos-muted);">
                    Three itineraries. Three entirely different scales of wonder.
                </p>
            </div>

            <x-ui.tabs value="orbit" class="w-full">
                <x-ui.tabs-list class="mx-auto w-fit mb-8" variant="segmented">
                    @foreach ($destinations as $key => $dest)
                        <x-ui.tabs-trigger value="{{ $key }}">
                            <x-dynamic-component :component="'lucide-'.$dest['icon']" class="size-4" aria-hidden="true" />
                            {{ $dest['label'] }}
                        </x-ui.tabs-trigger>
                    @endforeach
                </x-ui.tabs-list>

                @foreach ($destinations as $key => $dest)
                    <x-ui.tabs-content value="{{ $key }}">
                        <div class="cosmos-card overflow-hidden" style="display:grid; gap:0;">
                            <div style="display:grid; grid-template-columns:1fr; gap:0;" class="md:grid-cols-2">
                                <div style="aspect-ratio:16/9; overflow:hidden;" class="md:aspect-auto">
                                    <img src="{{ $dest['img'] }}" alt="{{ $dest['title'] }}" loading="lazy"
                                         style="width:100%; height:100%; object-fit:cover; display:block;" />
                                </div>
                                <div style="padding: 2.5rem;">
                                    <div class="cosmos-label" style="display:inline-flex; margin-bottom:1rem;">
                                        <x-dynamic-component :component="'lucide-'.$dest['icon']" class="size-3" aria-hidden="true" />
                                        {{ $dest['label'] }}
                                    </div>
                                    <h3 class="font-space font-bold text-2xl md:text-3xl" style="color: var(--cosmos-white);">{{ $dest['title'] }}</h3>
                                    <p class="mt-3 leading-relaxed" style="color: var(--cosmos-muted);">{{ $dest['desc'] }}</p>

                                    <!-- Specs grid -->
                                    <div class="mt-6 grid grid-cols-2 gap-3">
                                        @foreach ([['clock', 'Duration', $dest['duration']], ['arrow-up', 'Altitude', $dest['altitude']], ['users', 'Capacity', $dest['crew']], ['dollar-sign', 'From', $dest['price']]] as [$icon, $lbl, $val])
                                            <div style="background:rgba(255,255,255,0.04); border:1px solid var(--cosmos-border); border-radius:10px; padding:0.75rem 1rem;">
                                                <div class="flex items-center gap-1.5 text-xs mb-1" style="color: var(--cosmos-muted);">
                                                    <x-dynamic-component :component="'lucide-'.$icon" class="size-3" aria-hidden="true" />
                                                    {{ $lbl }}
                                                </div>
                                                <div class="font-semibold text-sm" style="color: var(--cosmos-white);">{{ $val }}</div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <div class="mt-6">
                                        <a href="#packages" class="cosmos-btn-primary" style="font-size:0.875rem; padding:0.5rem 1.2rem;">
                                            Book this mission
                                            <x-lucide-arrow-right class="size-4" aria-hidden="true" />
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </x-ui.tabs-content>
                @endforeach
            </x-ui.tabs>
        </div>
    </section>

    <div class="cosmos-hr"></div>

    {{-- ── THE EXPERIENCE (BENTO GRID) ── --}}
    <section id="experience" class="scroll-mt-20" style="padding: 5rem 0; position:relative; z-index:1;">
        <div class="mx-auto max-w-6xl px-6">
            <div class="text-center mb-12">
                <div class="cosmos-label" style="display:inline-flex;">
                    <x-lucide-zap class="size-3" aria-hidden="true" />
                    The Experience
                </div>
                <h2 class="font-space font-bold text-4xl md:text-5xl" style="color: var(--cosmos-white);">
                    Nothing prepares you.<br>
                    <span class="cosmos-gradient-text">We come close.</span>
                </h2>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                @foreach ($experiences as $i => $exp)
                    <div class="cosmos-card overflow-hidden" style="display:flex; flex-direction:column;">
                        <div style="aspect-ratio:16/9; overflow:hidden; flex-shrink:0;">
                            <img src="{{ $exp['img'] }}" alt="{{ $exp['title'] }}" loading="lazy"
                                 style="width:100%; height:100%; object-fit:cover; display:block;" />
                        </div>
                        <div style="padding:1.75rem; flex:1; display:flex; flex-direction:column; gap:0.5rem;">
                            <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:0.25rem;">
                                <span style="display:inline-flex; align-items:center; justify-content:center; width:40px; height:40px; border-radius:10px; background:rgba(124,58,237,0.18); color:rgba(167,139,250,1);">
                                    <x-dynamic-component :component="'lucide-'.$exp['icon']" class="size-5" aria-hidden="true" />
                                </span>
                                <span class="cosmos-label" style="margin-bottom:0; font-size:0.6875rem;">{{ $exp['tag'] }}</span>
                            </div>
                            <h3 class="font-space font-semibold text-xl" style="color:var(--cosmos-white);">{{ $exp['title'] }}</h3>
                            <p class="text-sm leading-relaxed" style="color:var(--cosmos-muted);">{{ $exp['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="cosmos-hr"></div>

    {{-- ── MISSION GALLERY (CAROUSEL) ── --}}
    <section style="padding: 5rem 0; position:relative; z-index:1; overflow:hidden;">
        <div class="mx-auto max-w-6xl px-6">
            <div class="text-center mb-10">
                <div class="cosmos-label" style="display:inline-flex;">
                    <x-lucide-images class="size-3" aria-hidden="true" />
                    Mission Gallery
                </div>
                <h2 class="font-space font-bold text-4xl" style="color: var(--cosmos-white);">Through the porthole</h2>
            </div>

            <div class="relative px-12">
                <x-ui.carousel>
                    <x-ui.carousel-content>
                        @foreach ($gallery as $img)
                            <x-ui.carousel-item class="md:basis-1/2 lg:basis-1/2">
                                <div class="cosmos-card overflow-hidden" style="border-radius:14px;">
                                    <img src="{{ $img['img'] }}" alt="{{ $img['alt'] }}" loading="lazy"
                                         style="width:100%; aspect-ratio:16/9; object-fit:cover; display:block;" />
                                </div>
                            </x-ui.carousel-item>
                        @endforeach
                    </x-ui.carousel-content>
                    <x-ui.carousel-previous style="background:rgba(10,14,36,0.8); border-color:var(--cosmos-border); color:var(--cosmos-white);" />
                    <x-ui.carousel-next style="background:rgba(10,14,36,0.8); border-color:var(--cosmos-border); color:var(--cosmos-white);" />
                </x-ui.carousel>
            </div>
        </div>
    </section>

    <div class="cosmos-hr"></div>

    {{-- ── TRIP PACKAGES ── --}}
    <section id="packages" class="scroll-mt-20" style="padding: 5rem 0; position:relative; z-index:1;">
        <div class="mx-auto max-w-6xl px-6">
            <div class="text-center mb-12">
                <div class="cosmos-label" style="display:inline-flex;">
                    <x-lucide-package class="size-3" aria-hidden="true" />
                    Mission Packages
                </div>
                <h2 class="font-space font-bold text-4xl md:text-5xl" style="color: var(--cosmos-white);">
                    Choose your trajectory
                </h2>
                <p class="mt-3 max-w-lg mx-auto" style="color:var(--cosmos-muted);">
                    All-inclusive pricing. No hidden fees. Financing available.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($packages as $pkg)
                    <div class="cosmos-card relative" style="padding:2rem; display:flex; flex-direction:column; @if($pkg['highlight']) border-color: rgba(124,58,237,0.55); box-shadow: 0 0 40px rgba(124,58,237,0.20); @endif">
                        @if ($pkg['badge'])
                            <span style="position:absolute; top:-12px; left:50%; transform:translateX(-50%); background:linear-gradient(135deg,var(--cosmos-indigo),var(--cosmos-violet)); color:#fff; border-radius:999px; padding:0.2rem 0.9rem; font-size:0.7rem; font-weight:700; letter-spacing:0.05em; white-space:nowrap;">
                                {{ $pkg['badge'] }}
                            </span>
                        @endif
                        <!-- Image -->
                        <div style="border-radius:10px; overflow:hidden; margin-bottom:1.25rem;">
                            <img src="{{ $pkg['img'] }}" alt="{{ $pkg['name'] }} mission" loading="lazy"
                                 style="width:100%; aspect-ratio:16/9; object-fit:cover; display:block;" />
                        </div>
                        <!-- Name + tag -->
                        <h3 class="font-space font-bold text-xl" style="color:var(--cosmos-white);">{{ $pkg['name'] }}</h3>
                        <p class="text-xs mt-0.5 mb-3" style="color:var(--cosmos-muted);">{{ $pkg['tag'] }}</p>
                        <!-- Rating -->
                        <x-ui.rating :value="$pkg['rating']" :max="5" readonly color="text-amber-400" size="sm" />
                        <!-- Price -->
                        <div class="mt-4 mb-5">
                            <span class="font-space font-bold text-3xl" style="color:var(--cosmos-white);">{{ $pkg['price'] }}</span>
                            <span class="text-sm ml-1" style="color:var(--cosmos-muted);">/person</span>
                        </div>
                        <!-- Features -->
                        <ul class="space-y-2.5 text-sm flex-1 mb-6">
                            @foreach ($pkg['features'] as $feat)
                                <li class="flex items-center gap-2.5">
                                    <x-lucide-check class="size-4 shrink-0" style="color:var(--cosmos-cyan);" aria-hidden="true" />
                                    <span style="color:var(--cosmos-muted);">{{ $feat }}</span>
                                </li>
                            @endforeach
                        </ul>
                        <a href="#booking" class="{{ $pkg['highlight'] ? 'cosmos-btn-primary' : 'cosmos-btn-outline' }}" style="width:100%; justify-content:center;">
                            Reserve a berth
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="cosmos-hr"></div>

    {{-- ── BOOKING STEPPER ── --}}
    <section id="booking" class="scroll-mt-20" style="padding: 5rem 0; position:relative; z-index:1;">
        <div class="mx-auto max-w-3xl px-6">
            <div class="text-center mb-12">
                <div class="cosmos-label" style="display:inline-flex;">
                    <x-lucide-clipboard-list class="size-3" aria-hidden="true" />
                    Booking Flow
                </div>
                <h2 class="font-space font-bold text-4xl" style="color:var(--cosmos-white);">How to reserve your seat</h2>
                <p class="mt-3" style="color:var(--cosmos-muted);">A five-step process from enquiry to launch day.</p>
            </div>

            <x-ui.stepper :value="2">
                <x-ui.stepper-nav>
                    @foreach (['Choose Mission', 'Medical Check', 'Training', 'Payment', 'Launch'] as $si => $slabel)
                        <x-ui.stepper-item :step="$si + 1">
                            <x-ui.stepper-trigger>
                                <x-ui.stepper-indicator />
                            </x-ui.stepper-trigger>
                            @if ($si < 4)
                                <x-ui.stepper-separator />
                            @endif
                        </x-ui.stepper-item>
                    @endforeach
                </x-ui.stepper-nav>

                <div class="cosmos-card" style="padding:2rem; margin-top:0.5rem;">
                    @foreach ([
                        ['Choose your mission', 'Browse our three destinations and select the package that matches your ambition and timeline. Our advisors are available 24/7.', 'map-pin'],
                        ['Medical evaluation', 'Complete a standard astronaut physical with our partner clinics worldwide. Most candidates qualify within 2 weeks.', 'heart-pulse'],
                        ['Mission Readiness training', 'Six-month programme at our Houston campus. Zero-G flights, EVA simulation, and spacecraft systems certification.', 'graduation-cap'],
                        ['Secure your reservation', 'A 10% deposit holds your berth. Balance due 90 days before launch. Finance options available.', 'credit-card'],
                        ['Launch day', 'Transfer to the launch facility 5 days prior. T-0 and you leave Earth behind.', 'rocket'],
                    ] as $ci => $step)
                        <x-ui.stepper-content :step="$ci + 1">
                            <div class="flex items-start gap-4">
                                <span style="display:inline-flex; align-items:center; justify-content:center; width:44px; height:44px; border-radius:12px; background:rgba(124,58,237,0.18); color:rgba(167,139,250,1); flex-shrink:0;">
                                    <x-dynamic-component :component="'lucide-'.$step[2]" class="size-5" aria-hidden="true" />
                                </span>
                                <div>
                                    <h3 class="font-space font-semibold text-lg" style="color:var(--cosmos-white);">{{ $step[0] }}</h3>
                                    <p class="mt-1.5 text-sm leading-relaxed" style="color:var(--cosmos-muted);">{{ $step[1] }}</p>
                                </div>
                            </div>
                            <div class="flex gap-3 mt-6">
                                <button type="button" x-on:click="step > 1 && step--"
                                        class="cosmos-btn-outline" style="padding:0.45rem 1.1rem; font-size:0.875rem;"
                                        x-bind:style="step <= 1 ? 'opacity:0.4; cursor:not-allowed;' : ''">
                                    <x-lucide-chevron-left class="size-4" aria-hidden="true" />
                                    Back
                                </button>
                                <button type="button" x-on:click="step < 5 && step++"
                                        class="cosmos-btn-primary" style="padding:0.45rem 1.1rem; font-size:0.875rem;"
                                        x-bind:style="step >= 5 ? 'opacity:0.4; cursor:not-allowed;' : ''">
                                    @{{ step < 5 ? 'Continue' : 'Submit' }}
                                    <x-lucide-chevron-right class="size-4" aria-hidden="true" />
                                </button>
                            </div>
                        </x-ui.stepper-content>
                    @endforeach
                </div>
            </x-ui.stepper>
        </div>
    </section>

    <div class="cosmos-hr"></div>

    {{-- ── READINESS PROGRESS ── --}}
    <section style="padding: 4rem 0; position:relative; z-index:1;">
        <div class="mx-auto max-w-4xl px-6">
            <div class="text-center mb-8">
                <div class="cosmos-label" style="display:inline-flex;">
                    <x-lucide-bar-chart-2 class="size-3" aria-hidden="true" />
                    Mission Readiness Score
                </div>
                <h2 class="font-space font-bold text-3xl" style="color:var(--cosmos-white);">Where do you stand?</h2>
                <p class="mt-2 text-sm" style="color:var(--cosmos-muted);">Average passenger profile across our 38 missions.</p>
            </div>
            <div class="cosmos-card" style="padding:2rem 2.5rem;">
                <div class="space-y-5">
                    @foreach ([
                        ['Physical fitness', 82],
                        ['Technical aptitude', 67],
                        ['Psychological resilience', 91],
                        ['Zero-G adaptation', 54],
                        ['Mission systems knowledge', 73],
                    ] as [$label, $val])
                        <div>
                            <div class="flex justify-between items-center mb-1.5">
                                <span class="text-sm font-medium" style="color:var(--cosmos-white);">{{ $label }}</span>
                                <span class="text-xs font-semibold" style="color:var(--cosmos-muted);">{{ $val }}%</span>
                            </div>
                            <x-ui.progress :value="$val" :aria-label="$label" />
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="cosmos-hr"></div>

    {{-- ── CREW ── --}}
    <section id="crew" class="scroll-mt-20" style="padding: 5rem 0; position:relative; z-index:1;">
        <div class="mx-auto max-w-6xl px-6">
            <div class="text-center mb-12">
                <div class="cosmos-label" style="display:inline-flex;">
                    <x-lucide-users class="size-3" aria-hidden="true" />
                    The Crew
                </div>
                <h2 class="font-space font-bold text-4xl md:text-5xl" style="color:var(--cosmos-white);">
                    The people keeping you alive
                </h2>
                <p class="mt-3" style="color:var(--cosmos-muted);">Combined 17 spaceflights and counting.</p>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                @foreach ($crew as $member)
                    <x-ui.tooltip>
                        <x-ui.tooltip-trigger>
                            <div class="cosmos-card" style="padding:1.5rem 1rem; text-align:center; cursor:default;">
                                <x-ui.avatar class="size-16 mx-auto mb-3" style="ring-color:rgba(124,58,237,0.4);">
                                    <x-ui.avatar-image
                                        src="https://picsum.photos/seed/crew-{{ $member['seed'] }}/80/80"
                                        alt="{{ $member['name'] }}" />
                                    <x-ui.avatar-fallback style="background:rgba(124,58,237,0.2); color:rgba(167,139,250,1);">
                                        {{ substr($member['name'], 0, 1) }}
                                    </x-ui.avatar-fallback>
                                </x-ui.avatar>
                                <div class="text-xs font-semibold leading-tight" style="color:var(--cosmos-white);">{{ $member['name'] }}</div>
                                <div class="text-xs mt-0.5" style="color:var(--cosmos-muted);">{{ $member['role'] }}</div>
                            </div>
                        </x-ui.tooltip-trigger>
                        <x-ui.tooltip-content side="top">
                            {{ $member['flights'] }} spaceflight{{ $member['flights'] > 1 ? 's' : '' }}
                        </x-ui.tooltip-content>
                    </x-ui.tooltip>
                @endforeach
            </div>
        </div>
    </section>

    <div class="cosmos-hr"></div>

    {{-- ── MISSION TIMELINE ── --}}
    <section style="padding: 5rem 0; position:relative; z-index:1;">
        <div class="mx-auto max-w-4xl px-6">
            <div class="text-center mb-12">
                <div class="cosmos-label" style="display:inline-flex;">
                    <x-lucide-history class="size-3" aria-hidden="true" />
                    Mission History
                </div>
                <h2 class="font-space font-bold text-4xl" style="color:var(--cosmos-white);">A decade of firsts</h2>
            </div>
            <div class="relative" style="padding-left:2rem;">
                <!-- Vertical line -->
                <div style="position:absolute; left:5px; top:8px; bottom:8px; width:2px; background:linear-gradient(180deg, var(--cosmos-violet), var(--cosmos-cyan)); border-radius:2px;"></div>
                <div class="space-y-8">
                    @foreach ($milestones as $m)
                        <div class="relative flex gap-5">
                            <div class="cosmos-timeline-dot" style="position:absolute; left:-1.75rem; margin-top:4px;"></div>
                            <div>
                                <span class="text-xs font-bold uppercase tracking-widest" style="color:var(--cosmos-amber);">{{ $m['year'] }}</span>
                                <h3 class="font-space font-semibold mt-0.5" style="color:var(--cosmos-white);">{{ $m['title'] }}</h3>
                                <p class="text-sm leading-relaxed mt-1" style="color:var(--cosmos-muted);">{{ $m['desc'] }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    <div class="cosmos-hr"></div>

    {{-- ── FAQ ── --}}
    <section id="faq" class="scroll-mt-20" style="padding: 5rem 0; position:relative; z-index:1;">
        <div class="mx-auto max-w-3xl px-6">
            <div class="text-center mb-12">
                <div class="cosmos-label" style="display:inline-flex;">
                    <x-lucide-help-circle class="size-3" aria-hidden="true" />
                    FAQ
                </div>
                <h2 class="font-space font-bold text-4xl" style="color:var(--cosmos-white);">Questions we love</h2>
            </div>

            <x-ui.accordion type="single" collapsible value="faq-0" class="w-full">
                @foreach ($faqs as $i => $faq)
                    <x-ui.accordion-item value="faq-{{ $i }}">
                        <x-ui.accordion-trigger class="text-left">{{ $faq['q'] }}</x-ui.accordion-trigger>
                        <x-ui.accordion-content>
                            <p style="color:var(--cosmos-muted);">{{ $faq['a'] }}</p>
                        </x-ui.accordion-content>
                    </x-ui.accordion-item>
                @endforeach
            </x-ui.accordion>
        </div>
    </section>

    <div class="cosmos-hr"></div>

    {{-- ── FINAL CTA ── --}}
    <section style="padding: 6rem 0; position:relative; z-index:1; overflow:hidden;">
        <div class="mx-auto max-w-5xl px-6">
            <div style="position:relative; border-radius:24px; overflow:hidden; padding: 4rem 2rem; text-align:center; background: linear-gradient(135deg, rgba(67,56,202,0.35) 0%, rgba(124,58,237,0.30) 40%, rgba(219,39,119,0.20) 70%, rgba(6,182,212,0.15) 100%); border:1px solid rgba(124,58,237,0.35);">
                <!-- Background blur blobs inside CTA -->
                <div style="position:absolute; top:-40px; left:-40px; width:200px; height:200px; background:radial-gradient(circle, rgba(124,58,237,0.3) 0%, transparent 70%); filter:blur(40px); pointer-events:none;" aria-hidden="true"></div>
                <div style="position:absolute; bottom:-40px; right:-40px; width:200px; height:200px; background:radial-gradient(circle, rgba(6,182,212,0.25) 0%, transparent 70%); filter:blur(40px); pointer-events:none;" aria-hidden="true"></div>

                <div style="position:relative; z-index:1;">
                    <span class="cosmos-label" style="display:inline-flex; border-color:rgba(251,191,36,0.4); background:rgba(251,191,36,0.10); color:var(--cosmos-amber);">
                        <x-lucide-rocket class="size-3" aria-hidden="true" />
                        Limited berths available
                    </span>
                    <h2 class="font-space font-bold mt-4" style="font-size:clamp(2rem,5vw,3.5rem); color:var(--cosmos-white); line-height:1.1;">
                        Your name belongs<br>in the stars.
                    </h2>
                    <p class="mt-4 max-w-xl mx-auto text-lg" style="color:rgba(148,163,184,0.9);">
                        Humanity's next chapter is being written by civilians.
                        Reserve your berth today — and become part of the story.
                    </p>
                    <div class="mt-8 flex flex-wrap justify-center gap-4">
                        <a href="#packages" class="cosmos-btn-primary" style="font-size:1rem; padding:0.8rem 2rem;">
                            Reserve a berth
                            <x-lucide-rocket class="size-5" aria-hidden="true" />
                        </a>
                        <a href="#destinations" class="cosmos-btn-outline" style="font-size:1rem; padding:0.8rem 2rem;">
                            Explore destinations
                        </a>
                    </div>
                    <!-- Social proof avatars -->
                    <div class="mt-8 flex items-center justify-center gap-3 flex-wrap">
                        <div class="flex -space-x-2">
                            @foreach (['crew-10/80', 'crew-20/80', 'crew-30/80', 'crew-40/80'] as $seed)
                                <x-ui.avatar class="size-9" style="box-shadow:0 0 0 2px rgba(5,6,15,0.9);">
                                    <x-ui.avatar-image src="https://picsum.photos/seed/{{ $seed }}/80/80" alt="" />
                                    <x-ui.avatar-fallback style="background:rgba(124,58,237,0.2); color:#a78bfa;">O</x-ui.avatar-fallback>
                                </x-ui.avatar>
                            @endforeach
                        </div>
                        <span class="text-sm" style="color:var(--cosmos-muted);">
                            Joined by <strong style="color:var(--cosmos-white);">147 civilians</strong> who already flew
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ── FOOTER ── --}}
    <footer style="border-top:1px solid var(--cosmos-border); padding:3.5rem 0 2rem; position:relative; z-index:1;">
        <div class="mx-auto max-w-6xl px-6">
            <div class="grid grid-cols-2 md:grid-cols-6 gap-8 mb-10">
                <div class="col-span-2">
                    <a href="#" class="inline-flex items-center gap-2 font-space font-bold text-lg" style="color:var(--cosmos-white);">
                        <span style="background:linear-gradient(135deg,var(--cosmos-indigo),var(--cosmos-violet)); display:flex; align-items:center; justify-content:center; width:32px; height:32px; border-radius:8px;">
                            <x-lucide-orbit class="size-5" style="color:#fff;" />
                        </span>
                        ORBITAL
                    </a>
                    <p class="mt-3 text-sm max-w-xs leading-relaxed" style="color:var(--cosmos-muted);">
                        Making human spaceflight accessible — safely, responsibly, and with wonder.
                    </p>
                    <div class="mt-5 flex gap-2">
                        @foreach (['twitter', 'youtube', 'linkedin', 'github'] as $social)
                            <a href="#" aria-label="{{ $social }}" style="display:inline-flex; align-items:center; justify-content:center; width:36px; height:36px; border-radius:8px; border:1px solid var(--cosmos-border); color:var(--cosmos-muted); transition:border-color 0.2s, color 0.2s;"
                               onmouseover="this.style.borderColor='rgba(124,58,237,0.5)'; this.style.color='#f8fafc';"
                               onmouseout="this.style.borderColor=''; this.style.color='';">
                                <x-dynamic-component :component="'lucide-'.$social" class="size-4" aria-hidden="true" />
                            </a>
                        @endforeach
                    </div>
                </div>
                @foreach ($footer as $heading => $links)
                    <div>
                        <h3 class="text-xs font-semibold uppercase tracking-widest mb-3" style="color:var(--cosmos-white);">{{ $heading }}</h3>
                        <ul class="space-y-2 text-sm">
                            @foreach ($links as $link)
                                <li><a href="#" style="color:var(--cosmos-muted); transition:color 0.2s; text-decoration:none;"
                                       onmouseover="this.style.color='#f8fafc';" onmouseout="this.style.color='';">{{ $link }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
            <div class="cosmos-hr"></div>
            <div class="flex flex-col sm:flex-row items-center justify-between gap-3 text-xs mt-6" style="color:var(--cosmos-muted);">
                <span>© {{ date('Y') }} Orbital Space Technologies, Inc. All rights reserved.</span>
                <span class="flex items-center gap-1.5">
                    <x-lucide-shield-check class="size-4" aria-hidden="true" />
                    FAA Licensed · ITAR Compliant · SOC 2 Type II
                </span>
            </div>
        </div>
    </footer>
</div>

</x-layouts.app>
