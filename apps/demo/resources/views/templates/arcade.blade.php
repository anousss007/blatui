@php
    $games = [
        ['seed' => 'neon1', 'title' => 'VAPORWAVE RIDERS', 'genre' => 'Racing', 'rating' => 4, 'players' => '2.1M', 'tag' => 'HOT', 'tagColor' => 'danger', 'price' => 'FREE'],
        ['seed' => 'cyber2', 'title' => 'CHROME PROTOCOL', 'genre' => 'Action RPG', 'rating' => 5, 'players' => '4.7M', 'tag' => 'NEW', 'tagColor' => 'info', 'price' => '$9.99'],
        ['seed' => 'arcade3', 'title' => 'NEON DUNGEON', 'genre' => 'Roguelite', 'rating' => 4, 'players' => '1.3M', 'tag' => 'TOP', 'tagColor' => 'success', 'price' => '$4.99'],
        ['seed' => 'space4', 'title' => 'VOID STRIKER', 'genre' => 'Shoot-em-up', 'rating' => 5, 'players' => '3.9M', 'tag' => 'SALE', 'tagColor' => 'warning', 'price' => '$2.99'],
        ['seed' => 'pixel5', 'title' => 'GRID RUNNER X', 'genre' => 'Platformer', 'rating' => 4, 'players' => '890K', 'tag' => 'NEW', 'tagColor' => 'info', 'price' => 'FREE'],
        ['seed' => 'retro6', 'title' => 'SYNTH WARS', 'genre' => 'Strategy', 'rating' => 5, 'players' => '2.6M', 'tag' => 'HOT', 'tagColor' => 'danger', 'price' => '$14.99'],
    ];

    $trending = [
        ['seed' => 'trend1', 'title' => 'LASER DRIFT', 'genre' => 'Racing', 'players' => '5.2M', 'rating' => 5],
        ['seed' => 'trend2', 'title' => 'MECHA CLASH', 'genre' => 'Fighting', 'players' => '3.1M', 'rating' => 4],
        ['seed' => 'trend3', 'title' => 'PIXEL HEIST', 'genre' => 'Stealth', 'players' => '1.8M', 'rating' => 5],
        ['seed' => 'trend4', 'title' => 'ASTRO BLITZ', 'genre' => 'Shoot-em-up', 'players' => '2.4M', 'rating' => 4],
        ['seed' => 'trend5', 'title' => 'TURBO QUEST', 'genre' => 'RPG', 'players' => '4.0M', 'rating' => 5],
    ];

    $leaderboard = [
        ['rank' => 1, 'player' => 'NeonSlayer99', 'avatar' => '10', 'score' => '9,847,210', 'wins' => '1,842', 'badge' => 'LEGENDARY'],
        ['rank' => 2, 'player' => 'CyberPhoenix', 'avatar' => '20', 'score' => '8,312,540', 'wins' => '1,601', 'badge' => 'MASTER'],
        ['rank' => 3, 'player' => 'VoidHunterX', 'avatar' => '30', 'score' => '7,990,005', 'wins' => '1,488', 'badge' => 'MASTER'],
        ['rank' => 4, 'player' => 'GlitchMaster', 'avatar' => '40', 'score' => '6,441,880', 'wins' => '1,210', 'badge' => 'ELITE'],
        ['rank' => 5, 'player' => 'ArcadePrincess', 'avatar' => '50', 'score' => '5,999,120', 'wins' => '1,099', 'badge' => 'ELITE'],
        ['rank' => 6, 'player' => 'PixelDemon', 'avatar' => '60', 'score' => '4,701,330', 'wins' => '992', 'badge' => 'PRO'],
        ['rank' => 7, 'player' => 'LaserKnight', 'avatar' => '70', 'score' => '3,888,900', 'wins' => '870', 'badge' => 'PRO'],
    ];

    $achievements = [
        ['icon' => 'zap', 'label' => 'Speed Runner',   'desc' => 'Complete a level under 60s', 'pct' => 78, 'xp' => '780 XP'],
        ['icon' => 'trophy', 'label' => 'Tournament King', 'desc' => 'Win 10 consecutive matches',  'pct' => 55, 'xp' => '550 XP'],
        ['icon' => 'flame', 'label' => 'Blaze Streak',  'desc' => '30-day login streak',         'pct' => 93, 'xp' => '930 XP'],
        ['icon' => 'sword', 'label' => 'Boss Slayer',   'desc' => 'Defeat all bosses on Hard',   'pct' => 40, 'xp' => '400 XP'],
    ];

    $community = [
        ['seed' => 'c1', 'name' => 'NeonSlayer99',  'msg' => 'Chrome Protocol just dropped update 2.4 and it\'s absolutely insane. Best patch yet!',      'time' => '2m ago'],
        ['seed' => 'c2', 'name' => 'CyberPhoenix',  'msg' => 'Finally hit Legendary rank after 6 months. The grind was worth every single second.',         'time' => '15m ago'],
        ['seed' => 'c3', 'name' => 'PixelDemon',    'msg' => 'The new Neon Dungeon expansion has me absolutely hooked. 40 hours in and still going strong.', 'time' => '1h ago'],
    ];

    $plans = [
        ['name' => 'ARCADE',    'price_m' => 0,  'price_y' => 0,  'tag' => 'For casual players',    'cta' => 'Play Free',     'hot' => false, 'color' => '#00f0ff', 'perks' => ['Access to 50+ free games', 'Standard matchmaking', 'Community forums', '5 GB cloud saves']],
        ['name' => 'NEON PRO',  'price_m' => 12, 'price_y' => 9,  'tag' => 'For serious gamers',    'cta' => 'Go Pro',        'hot' => true,  'color' => '#ff2bd6', 'perks' => ['All free games + 120 Pro titles', 'Priority matchmaking', 'Exclusive cosmetics & badges', '100 GB cloud saves', 'Early access drops']],
        ['name' => 'CHROME',    'price_m' => 24, 'price_y' => 18, 'tag' => 'For the elite few',     'cta' => 'Go Chrome',     'hot' => false, 'color' => '#aaff00', 'perks' => ['Everything in Pro', 'All 300+ games', 'Exclusive Chrome badge', '500 GB cloud saves', 'Beta access + dev streams', 'Monthly merch drop']],
    ];

    $faqs = [
        ['q' => 'Can I play for free?',                  'a' => 'Absolutely. The Arcade tier is free forever with access to 50+ titles. No credit card needed — just create an account and dive in.'],
        ['q' => 'How often are new games added?',        'a' => 'We ship new titles every two weeks. Pro and Chrome members get early access 72 hours before general release.'],
        ['q' => 'Is cross-platform play supported?',     'a' => 'Yes — PC, console and mobile players all share the same matchmaking pool. Your progress syncs across every device.'],
        ['q' => 'What happens if I cancel my sub?',      'a' => 'You keep access until the end of your billing period. Your saved data, achievements and cosmetics are preserved forever.'],
        ['q' => 'Do you run tournaments?',               'a' => 'Every weekend we host ranked tournaments with real prize pools. Pro+ members are automatically eligible — no sign-up required.'],
    ];

    $nav = ['Games' => '#games', 'Trending' => '#trending', 'Leaderboard' => '#leaderboard', 'Membership' => '#membership'];
@endphp

<x-layouts.app title="Neon Arcade — Game Studio">

<div id="tpl-arcade">

{{-- ═══════════════════════════════════════════════════════ STYLES ═══ --}}
<style>
@import url('https://fonts.bunny.net/css?family=orbitron:400,500,600,700,800,900|press-start-2p:400');

/* ── Scope all overrides under #tpl-arcade ── */
#tpl-arcade {
    --arc-bg:       #0d0221;
    --arc-bg2:      #1a0b2e;
    --arc-bg3:      #120828;
    --arc-magenta:  #ff2bd6;
    --arc-cyan:     #00f0ff;
    --arc-purple:   #a855f7;
    --arc-lime:     #aaff00;
    --arc-orange:   #ff6b35;
    --arc-chrome1:  #e8e8e8;
    --arc-chrome2:  #a0a0c0;
    --arc-chrome3:  #6060a0;
    background: var(--arc-bg);
    color: #e8e0f0;
    font-family: 'Outfit', 'Inter', sans-serif;
    /* Override site theme completely */
    color-scheme: dark;
}

/* ── CHROME gradient text helper ── */
#tpl-arcade .arc-chrome {
    background: linear-gradient(135deg, #e8e8e8 0%, #c0c0e0 30%, #8080cc 60%, #e0e0ff 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}
#tpl-arcade .arc-neon-m {
    background: linear-gradient(135deg, #ff2bd6 0%, #c020a0 50%, #ff80e0 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}
#tpl-arcade .arc-neon-c {
    background: linear-gradient(135deg, #00f0ff 0%, #0090cc 50%, #80f8ff 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}
#tpl-arcade .arc-neon-lime {
    background: linear-gradient(135deg, #aaff00 0%, #66cc00 50%, #ccff66 100%);
    -webkit-background-clip: text;
    background-clip: text;
    -webkit-text-fill-color: transparent;
}
#tpl-arcade .arc-title {
    font-family: 'Orbitron', sans-serif;
    letter-spacing: 0.04em;
}
#tpl-arcade .arc-accent {
    font-family: 'Press Start 2P', monospace;
    font-size: 0.55rem;
    letter-spacing: 0.08em;
}

/* ── Neon glow helpers ── */
#tpl-arcade .glow-m  { text-shadow: 0 0 8px #ff2bd680, 0 0 20px #ff2bd640; }
#tpl-arcade .glow-c  { text-shadow: 0 0 8px #00f0ff80, 0 0 20px #00f0ff40; }
#tpl-arcade .glow-p  { text-shadow: 0 0 8px #a855f780, 0 0 20px #a855f740; }

/* ── Glossy neon button ── */
#tpl-arcade .arc-btn-magenta {
    background: linear-gradient(135deg, #ff2bd6, #cc10a0);
    color: #fff;
    border: 1px solid #ff2bd6;
    box-shadow: 0 0 12px #ff2bd660, 0 0 30px #ff2bd620, inset 0 1px 0 rgba(255,255,255,0.25);
    font-family: 'Orbitron', sans-serif;
    letter-spacing: 0.05em;
    transition: box-shadow 0.2s, transform 0.15s;
}
#tpl-arcade .arc-btn-magenta:hover {
    box-shadow: 0 0 20px #ff2bd680, 0 0 50px #ff2bd630, inset 0 1px 0 rgba(255,255,255,0.3);
    transform: translateY(-1px);
}
#tpl-arcade .arc-btn-cyan {
    background: linear-gradient(135deg, #00f0ff, #0090cc);
    color: #001020;
    border: 1px solid #00f0ff;
    box-shadow: 0 0 12px #00f0ff60, 0 0 30px #00f0ff20, inset 0 1px 0 rgba(255,255,255,0.25);
    font-family: 'Orbitron', sans-serif;
    letter-spacing: 0.05em;
    transition: box-shadow 0.2s, transform 0.15s;
}
#tpl-arcade .arc-btn-cyan:hover {
    box-shadow: 0 0 20px #00f0ff80, 0 0 50px #00f0ff30, inset 0 1px 0 rgba(255,255,255,0.3);
    transform: translateY(-1px);
}
#tpl-arcade .arc-btn-outline {
    background: transparent;
    color: var(--arc-cyan);
    border: 1px solid #00f0ff60;
    box-shadow: 0 0 8px #00f0ff20;
    font-family: 'Orbitron', sans-serif;
    letter-spacing: 0.05em;
    transition: box-shadow 0.2s, border-color 0.2s, color 0.2s;
}
#tpl-arcade .arc-btn-outline:hover {
    border-color: #00f0ff;
    box-shadow: 0 0 16px #00f0ff50;
    color: #fff;
}

/* ── Card neon glow on hover ── */
#tpl-arcade .arc-game-card {
    background: linear-gradient(145deg, #1a0b2e, #120828);
    border: 1px solid #2a1050;
    border-radius: 12px;
    transition: border-color 0.25s, box-shadow 0.25s, transform 0.2s;
}
#tpl-arcade .arc-game-card:hover {
    border-color: #ff2bd680;
    box-shadow: 0 0 20px #ff2bd630, 0 8px 32px rgba(0,0,0,0.5);
    transform: translateY(-4px);
}

/* ── Section panel ── */
#tpl-arcade .arc-panel {
    background: linear-gradient(145deg, rgba(26,11,46,0.95), rgba(18,8,40,0.98));
    border: 1px solid rgba(168,85,247,0.2);
    border-radius: 16px;
}

/* ── Perspective GRID FLOOR ── */
#tpl-arcade .arc-grid-floor {
    position: absolute;
    inset: 0;
    overflow: hidden;
    pointer-events: none;
    z-index: 0;
}
#tpl-arcade .arc-grid-floor::before {
    content: '';
    position: absolute;
    bottom: -20%;
    left: 50%;
    transform: translateX(-50%) rotateX(60deg);
    width: 200%;
    height: 120%;
    transform-origin: bottom center;
    background-image:
        linear-gradient(to right, #a855f730 1px, transparent 1px),
        linear-gradient(to bottom, #a855f730 1px, transparent 1px);
    background-size: 60px 60px;
    animation: arc-grid-drift 8s linear infinite;
    mask-image: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 70%);
    -webkit-mask-image: linear-gradient(to top, rgba(0,0,0,0.8) 0%, transparent 70%);
}
#tpl-arcade .arc-grid-floor::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0; right: 0;
    height: 40%;
    background: linear-gradient(to top, var(--arc-bg) 0%, transparent 100%);
}

/* ── Scanlines overlay ── */
#tpl-arcade .arc-scanlines {
    position: fixed;
    inset: 0;
    pointer-events: none;
    z-index: 9999;
    background: repeating-linear-gradient(
        to bottom,
        transparent 0px,
        transparent 2px,
        rgba(0,0,0,0.06) 2px,
        rgba(0,0,0,0.06) 4px
    );
    opacity: 0.5;
}

/* ── Glow radials ── */
#tpl-arcade .arc-glow-blob-m {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle, #ff2bd630 0%, transparent 70%);
    pointer-events: none;
}
#tpl-arcade .arc-glow-blob-c {
    position: absolute;
    border-radius: 50%;
    background: radial-gradient(circle, #00f0ff20 0%, transparent 70%);
    pointer-events: none;
}

/* ── Membership plan cards ── */
#tpl-arcade .arc-plan-card {
    background: linear-gradient(160deg, #1a0b2e 0%, #0d0221 100%);
    border-radius: 16px;
    border: 1px solid #2a1050;
    transition: box-shadow 0.25s, border-color 0.25s, transform 0.2s;
}
#tpl-arcade .arc-plan-card:hover {
    transform: translateY(-4px);
}
#tpl-arcade .arc-plan-card.featured {
    border-color: #ff2bd680;
    box-shadow: 0 0 30px #ff2bd630, 0 12px 40px rgba(0,0,0,0.5);
}

/* ── Table ── */
#tpl-arcade .arc-table { border-collapse: collapse; width: 100%; font-variant-numeric: tabular-nums; }
#tpl-arcade .arc-table th {
    font-family: 'Orbitron', sans-serif;
    font-size: 0.65rem;
    letter-spacing: 0.12em;
    text-transform: uppercase;
    color: #a855f7;
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #2a1050;
    text-align: left;
}
#tpl-arcade .arc-table td {
    padding: 0.75rem 1rem;
    border-bottom: 1px solid #1a0b3a;
    font-size: 0.875rem;
}
#tpl-arcade .arc-table tr:last-child td { border-bottom: none; }
#tpl-arcade .arc-table tbody tr { transition: background 0.15s; }
#tpl-arcade .arc-table tbody tr:hover { background: rgba(168,85,247,0.06); }
#tpl-arcade .arc-rank-1 { color: #aaff00; font-family: 'Orbitron', sans-serif; font-weight: 700; }
#tpl-arcade .arc-rank-2 { color: #00f0ff; font-family: 'Orbitron', sans-serif; font-weight: 700; }
#tpl-arcade .arc-rank-3 { color: #ff2bd6; font-family: 'Orbitron', sans-serif; font-weight: 700; }
#tpl-arcade .arc-rank-n { color: #6060a0; font-family: 'Orbitron', sans-serif; font-weight: 600; }

/* ── Progress custom colors ── */
#tpl-arcade .arc-progress-m [data-slot="progress-indicator"] { background: linear-gradient(to right, #ff2bd6, #a020c0); }
#tpl-arcade .arc-progress-c [data-slot="progress-indicator"] { background: linear-gradient(to right, #00f0ff, #0080cc); }
#tpl-arcade .arc-progress-l [data-slot="progress-indicator"] { background: linear-gradient(to right, #aaff00, #66cc00); }
#tpl-arcade .arc-progress-p [data-slot="progress-indicator"] { background: linear-gradient(to right, #a855f7, #7020c0); }
#tpl-arcade [data-slot="progress"] { background: rgba(168,85,247,0.12); }

/* ── Accordion arcade override ── */
#tpl-arcade [data-slot="accordion-item"] { border-bottom: 1px solid #2a1050; }
#tpl-arcade [data-slot="accordion-trigger"] {
    color: #d0c0e8;
    font-size: 0.9rem;
}
#tpl-arcade [data-slot="accordion-trigger"]:hover { color: #00f0ff; text-decoration: none; }

/* ── Switch arcade override ── */
#tpl-arcade [data-slot="switch"][data-state="checked"] { background: linear-gradient(135deg, #ff2bd6, #a020c0) !important; border-color: #ff2bd6 !important; }

/* ── Marquee ticker bar ── */
#tpl-arcade .arc-ticker {
    background: linear-gradient(90deg, #ff2bd6, #a855f7, #00f0ff, #aaff00, #ff6b35, #ff2bd6);
    background-size: 200% 100%;
    animation: arc-ticker-bg 6s linear infinite;
    height: 36px;
}

/* ── Keyframes ── */
@keyframes arc-grid-drift {
    from { background-position: 0 0; }
    to   { background-position: 0 60px; }
}
@keyframes arc-ticker-bg {
    from { background-position: 0% 50%; }
    to   { background-position: 200% 50%; }
}
@keyframes arc-pulse-glow {
    0%, 100% { opacity: 0.6; transform: scale(1); }
    50%       { opacity: 1;   transform: scale(1.05); }
}
@keyframes arc-float {
    0%, 100% { transform: translateY(0); }
    50%       { transform: translateY(-10px); }
}
@keyframes arc-shimmer {
    from { background-position: -200% center; }
    to   { background-position: 200% center; }
}
@media (prefers-reduced-motion: reduce) {
    #tpl-arcade .arc-grid-floor::before,
    #tpl-arcade .arc-ticker,
    #tpl-arcade [class*="arc-float"],
    #tpl-arcade [class*="arc-pulse"] {
        animation: none !important;
    }
}
</style>

{{-- Scanlines overlay (fixed, entire page) --}}
<div class="arc-scanlines" aria-hidden="true"></div>

{{-- ══════════════════════════ NAV ══════════════════════════ --}}
<header style="background: rgba(13,2,33,0.9); border-bottom: 1px solid rgba(168,85,247,0.25); backdrop-filter: blur(16px);" class="sticky top-0 z-40">
    <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-6">
        {{-- Logo --}}
        <a href="#" class="flex items-center gap-2.5 shrink-0">
            <span style="background: linear-gradient(135deg, #ff2bd6, #a855f7); box-shadow: 0 0 16px #ff2bd650;" class="flex size-9 items-center justify-center rounded-lg">
                <x-lucide-gamepad-2 class="size-5 text-white" />
            </span>
            <span class="arc-title font-bold text-lg arc-chrome">NEON ARCADE</span>
        </a>

        {{-- Desktop nav --}}
        <nav class="ml-6 hidden items-center gap-1 text-sm md:flex">
            @foreach ($nav as $label => $href)
                <a href="{{ $href }}" style="color: #b090d0;" class="hover:text-white rounded-md px-3 py-1.5 font-medium transition-colors hover:bg-white/5">{{ $label }}</a>
            @endforeach
        </nav>

        <div class="ml-auto flex items-center gap-3">
            <x-ui.badge tone="danger" variant="solid" class="arc-accent hidden sm:inline-flex">LIVE</x-ui.badge>
            <x-ui.button class="arc-btn-cyan rounded-lg text-xs font-semibold px-5 h-9">PLAY NOW</x-ui.button>
        </div>
    </div>
</header>

{{-- ══════════════════════════ TICKER ══════════════════════════ --}}
<div class="arc-ticker overflow-hidden" aria-label="News ticker">
    <x-ui.marquee :duration="'22s'" :gap="'2.5rem'" class="h-full">
        @foreach (['INSERT COIN', 'NEW DROP: CHROME PROTOCOL 2.4', 'TOURNAMENT LIVE NOW', 'SEASON 7 LAUNCHED', 'NEW GAME: SYNTH WARS', '100,000 PLAYERS ONLINE', 'DAILY REWARDS AVAILABLE', 'WEEKEND DOUBLE XP'] as $t)
            <span class="arc-accent text-[#0d0221] font-bold whitespace-nowrap">✦ {{ $t }}</span>
        @endforeach
    </x-ui.marquee>
</div>

{{-- ══════════════════════════ HERO ══════════════════════════ --}}
<section class="relative overflow-hidden" style="background: linear-gradient(180deg, #0d0221 0%, #1a0b2e 60%, #0d0221 100%); min-height: 92vh; display:flex; align-items:center;">
    {{-- Grid floor --}}
    <div class="arc-grid-floor" aria-hidden="true"></div>

    {{-- Glow blobs --}}
    <div class="arc-glow-blob-m" style="width:600px;height:600px;top:-200px;left:-100px;" aria-hidden="true"></div>
    <div class="arc-glow-blob-c" style="width:500px;height:500px;top:-100px;right:-80px;" aria-hidden="true"></div>

    <div class="relative z-10 mx-auto max-w-7xl px-6 py-24 text-center">
        {{-- Badges --}}
        <div class="flex flex-wrap justify-center gap-2 mb-8">
            <x-ui.badge tone="danger" variant="solid" class="arc-accent">NEW DROP</x-ui.badge>
            <x-ui.badge tone="info" variant="soft" class="arc-accent">SEASON 7</x-ui.badge>
            <x-ui.badge tone="success" variant="soft" class="arc-accent">100K ONLINE</x-ui.badge>
        </div>

        {{-- Hero title --}}
        <h1 class="arc-title font-black leading-none mb-4" style="font-size: clamp(3rem, 10vw, 8rem);">
            <span class="arc-neon-m glow-m block" style="filter: drop-shadow(0 0 24px #ff2bd660);">NEON</span>
            <span class="arc-chrome block" style="filter: drop-shadow(0 0 16px rgba(200,200,255,0.3));">ARCADE</span>
        </h1>

        {{-- Tagline --}}
        <p class="arc-accent text-center mb-3" style="color: #a855f7; letter-spacing: 0.2em; font-size: 0.6rem;">
            — INDIE GAME STUDIO &amp; PLATFORM —
        </p>
        <p class="text-lg mb-10 max-w-2xl mx-auto" style="color: #b090d0; line-height: 1.7;">
            300+ games. Global tournaments. Legendary rewards. The arcade never closes.
        </p>

        {{-- CTAs --}}
        <div class="flex flex-wrap justify-center gap-4 mb-12">
            <x-ui.button class="arc-btn-magenta rounded-xl text-sm px-8 h-12">
                <x-lucide-gamepad-2 class="size-5" />
                PRESS START
            </x-ui.button>
            <x-ui.button class="arc-btn-outline rounded-xl text-sm px-8 h-12">
                <x-lucide-play class="size-5" />
                WATCH TRAILER
            </x-ui.button>
        </div>

        {{-- Stats row --}}
        <div class="inline-grid grid-cols-3 gap-8 sm:gap-16 text-center" style="border: 1px solid rgba(168,85,247,0.2); border-radius: 16px; padding: 1.5rem 2.5rem; background: rgba(26,11,46,0.6); backdrop-filter: blur(10px);">
            @foreach ([['12M+', 'PLAYERS'], ['300+', 'GAMES'], ['$500K', 'PRIZE POOL']] as [$v, $l])
                <div>
                    <div class="arc-title font-bold text-2xl arc-neon-c">{{ $v }}</div>
                    <div class="arc-accent mt-1" style="color: #8060a0; font-size: 0.5rem; letter-spacing: 0.15em;">{{ $l }}</div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════ FEATURED GAMES ══════════════════════════ --}}
<section id="games" class="scroll-mt-20 py-20" style="background: var(--arc-bg2);">
    <div class="mx-auto max-w-7xl px-6">
        {{-- Section header --}}
        <div class="flex flex-wrap items-end justify-between gap-4 mb-12">
            <div>
                <x-ui.badge tone="info" variant="soft" class="arc-accent mb-3">FEATURED GAMES</x-ui.badge>
                <h2 class="arc-title font-bold text-3xl sm:text-4xl arc-chrome">HOT RELEASES</h2>
            </div>
            <x-ui.button class="arc-btn-outline rounded-lg text-xs px-5 h-9">VIEW ALL GAMES</x-ui.button>
        </div>

        {{-- Games grid --}}
        <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
            @foreach ($games as $g)
                <div class="arc-game-card overflow-hidden group">
                    {{-- Cover art --}}
                    <div class="relative overflow-hidden" style="aspect-ratio:16/9;">
                        <img
                            src="https://picsum.photos/seed/{{ $g['seed'] }}/640/360"
                            alt="{{ $g['title'] }} cover art"
                            loading="lazy"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                        />
                        {{-- Overlay gradient --}}
                        <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(13,2,33,0.9) 0%, transparent 50%);"></div>
                        {{-- Tag badge --}}
                        <div class="absolute top-3 left-3">
                            <x-ui.badge tone="{{ $g['tagColor'] }}" variant="solid" class="arc-accent">{{ $g['tag'] }}</x-ui.badge>
                        </div>
                        {{-- Price --}}
                        <div class="absolute top-3 right-3">
                            <span class="arc-accent rounded px-2 py-1 text-white" style="background: rgba(13,2,33,0.8); border: 1px solid rgba(255,255,255,0.15); font-size:0.55rem;">{{ $g['price'] }}</span>
                        </div>
                    </div>

                    {{-- Card body --}}
                    <div class="p-4">
                        <div class="flex items-start justify-between gap-2 mb-2">
                            <h3 class="arc-title font-bold text-sm arc-neon-m leading-tight">{{ $g['title'] }}</h3>
                            <x-ui.badge variant="outline" class="shrink-0 text-xs" style="border-color: rgba(168,85,247,0.4); color:#a855f7;">{{ $g['genre'] }}</x-ui.badge>
                        </div>
                        <div class="flex items-center justify-between">
                            <x-ui.rating :value="$g['rating']" :readonly="true" size="sm" color="text-yellow-400" />
                            <span class="text-xs" style="color: #7060a0;"><x-lucide-users class="inline size-3 mr-1" />{{ $g['players'] }}</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════ TRENDING CAROUSEL ══════════════════════════ --}}
<section id="trending" class="scroll-mt-20 py-20" style="background: var(--arc-bg);">
    <div class="mx-auto max-w-7xl px-6">
        <div class="mb-10">
            <x-ui.badge tone="warning" variant="soft" class="arc-accent mb-3">NOW TRENDING</x-ui.badge>
            <h2 class="arc-title font-bold text-3xl sm:text-4xl arc-neon-c">TOP CHARTS</h2>
        </div>

        <x-ui.carousel class="w-full">
            <x-ui.carousel-content>
                @foreach ($trending as $t)
                    <x-ui.carousel-item class="md:basis-1/2 lg:basis-1/3">
                        <div class="arc-game-card overflow-hidden p-0 cursor-pointer" style="height: 260px; position: relative;">
                            <img
                                src="https://picsum.photos/seed/{{ $t['seed'] }}/480/260"
                                alt="{{ $t['title'] }}"
                                loading="lazy"
                                class="w-full h-full object-cover"
                            />
                            <div class="absolute inset-0" style="background: linear-gradient(to top, rgba(13,2,33,0.95) 0%, rgba(13,2,33,0.3) 60%, transparent 100%);"></div>
                            <div class="absolute bottom-0 left-0 right-0 p-4">
                                <h3 class="arc-title font-bold text-sm arc-chrome mb-1">{{ $t['title'] }}</h3>
                                <div class="flex items-center justify-between">
                                    <x-ui.badge variant="outline" class="text-xs" style="border-color:rgba(0,240,255,0.4);color:#00f0ff;">{{ $t['genre'] }}</x-ui.badge>
                                    <span class="text-xs" style="color:#7060a0;"><x-lucide-users class="inline size-3 mr-1" />{{ $t['players'] }}</span>
                                </div>
                            </div>
                        </div>
                    </x-ui.carousel-item>
                @endforeach
            </x-ui.carousel-content>
            <x-ui.carousel-previous class="left-0 -translate-x-0" style="background: rgba(168,85,247,0.2); border-color: rgba(168,85,247,0.4); color: #a855f7;" />
            <x-ui.carousel-next class="right-0 translate-x-0" style="background: rgba(168,85,247,0.2); border-color: rgba(168,85,247,0.4); color: #a855f7;" />
        </x-ui.carousel>
    </div>
</section>

{{-- ══════════════════════════ LEADERBOARD ══════════════════════════ --}}
<section id="leaderboard" class="scroll-mt-20 py-20" style="background: var(--arc-bg2);">
    <div class="mx-auto max-w-5xl px-6">
        <div class="text-center mb-12">
            <x-ui.badge tone="success" variant="soft" class="arc-accent mb-3">GLOBAL RANKINGS</x-ui.badge>
            <h2 class="arc-title font-bold text-3xl sm:text-4xl arc-neon-lime">LEADERBOARD</h2>
        </div>

        <div class="arc-panel overflow-hidden">
            <div class="overflow-x-auto">
                <table class="arc-table">
                    <thead>
                        <tr>
                            <th style="width:60px;">RANK</th>
                            <th>PLAYER</th>
                            <th class="hidden sm:table-cell">SCORE</th>
                            <th class="hidden md:table-cell">WINS</th>
                            <th>TIER</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($leaderboard as $row)
                            <tr>
                                <td>
                                    @if ($row['rank'] === 1)
                                        <span class="arc-rank-1">{{ $row['rank'] }}</span>
                                        <x-lucide-crown class="inline size-4 ml-1" style="color:#aaff00;" />
                                    @elseif ($row['rank'] === 2)
                                        <span class="arc-rank-2">{{ $row['rank'] }}</span>
                                    @elseif ($row['rank'] === 3)
                                        <span class="arc-rank-3">{{ $row['rank'] }}</span>
                                    @else
                                        <span class="arc-rank-n">{{ $row['rank'] }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="flex items-center gap-3">
                                        <x-ui.avatar class="size-8 shrink-0">
                                            <x-ui.avatar-image src="https://picsum.photos/seed/av{{ $row['avatar'] }}/64/64" alt="{{ $row['player'] }}" />
                                            <x-ui.avatar-fallback style="background: rgba(168,85,247,0.2); color:#a855f7;">{{ strtoupper(substr($row['player'], 0, 1)) }}</x-ui.avatar-fallback>
                                        </x-ui.avatar>
                                        <span class="font-semibold text-sm" style="color:#e0d0f8;">{{ $row['player'] }}</span>
                                    </div>
                                </td>
                                <td class="hidden sm:table-cell">
                                    <span class="font-mono font-semibold text-sm" style="color:#00f0ff;">{{ $row['score'] }}</span>
                                </td>
                                <td class="hidden md:table-cell">
                                    <span class="font-mono text-sm" style="color:#a090c0;">{{ $row['wins'] }}</span>
                                </td>
                                <td>
                                    @php
                                        $toneMap = ['LEGENDARY' => ['danger', 'solid'], 'MASTER' => ['info', 'solid'], 'ELITE' => ['warning', 'soft'], 'PRO' => ['neutral', 'soft']];
                                        [$t, $v] = $toneMap[$row['badge']] ?? ['neutral', 'soft'];
                                    @endphp
                                    <x-ui.badge tone="{{ $t }}" variant="{{ $v }}" class="arc-accent">{{ $row['badge'] }}</x-ui.badge>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════ GAME MODES (TABS) ══════════════════════════ --}}
<section class="py-20" style="background: var(--arc-bg);">
    <div class="mx-auto max-w-6xl px-6">
        <div class="text-center mb-12">
            <x-ui.badge tone="info" variant="soft" class="arc-accent mb-3">PLAY YOUR WAY</x-ui.badge>
            <h2 class="arc-title font-bold text-3xl sm:text-4xl arc-neon-m">GAME MODES</h2>
        </div>

        <x-ui.tabs value="solo" class="w-full">
            <x-ui.tabs-list variant="pills" class="flex-wrap justify-center gap-2 mb-8 border-0 bg-transparent" style="gap:0.5rem;">
                @foreach (['solo' => 'SOLO QUEST', 'pvp' => 'PVP ARENA', 'coop' => 'CO-OP RAID', 'tournament' => 'TOURNAMENT'] as $key => $label)
                    <x-ui.tabs-trigger value="{{ $key }}" class="arc-title text-xs px-5 h-9 rounded-full" style="border: 1px solid rgba(168,85,247,0.3); color: #b090d0; font-family: 'Orbitron', sans-serif; letter-spacing: 0.08em; data-[state=active]:background: linear-gradient(135deg, #ff2bd6, #a855f7);">{{ $label }}</x-ui.tabs-trigger>
                @endforeach
            </x-ui.tabs-list>

            <x-ui.tabs-content value="solo">
                <div class="arc-panel p-8 grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <x-lucide-user class="size-10 mb-4" style="color:#ff2bd6;" />
                        <h3 class="arc-title font-bold text-xl arc-neon-m mb-3">SOLO QUEST</h3>
                        <p style="color:#b090d0;" class="mb-6 leading-relaxed">Dive deep into single-player campaigns. 40+ hours of story content, procedural dungeons, and boss encounters that will test your limits.</p>
                        <ul class="space-y-2 text-sm" style="color:#9080c0;">
                            @foreach (['40+ campaign hours', 'Procedural dungeons', 'Offline play supported', 'Cloud save sync'] as $pt)
                                <li class="flex items-center gap-2"><x-lucide-check class="size-4 shrink-0" style="color:#aaff00;" />{{ $pt }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="rounded-xl overflow-hidden" style="aspect-ratio:16/9;">
                        <img src="https://picsum.photos/seed/mode-solo/640/360" alt="Solo mode gameplay" class="w-full h-full object-cover" loading="lazy" />
                    </div>
                </div>
            </x-ui.tabs-content>

            <x-ui.tabs-content value="pvp">
                <div class="arc-panel p-8 grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <x-lucide-swords class="size-10 mb-4" style="color:#00f0ff;" />
                        <h3 class="arc-title font-bold text-xl arc-neon-c mb-3">PVP ARENA</h3>
                        <p style="color:#b090d0;" class="mb-6 leading-relaxed">Go head-to-head with players worldwide. Ranked ladders, seasonal resets, and prestige rewards. Rise to the top of the global leaderboard.</p>
                        <ul class="space-y-2 text-sm" style="color:#9080c0;">
                            @foreach (['Global ranked matchmaking', 'Seasonal ladder resets', 'Prestige badges & rewards', 'Anti-cheat protection'] as $pt)
                                <li class="flex items-center gap-2"><x-lucide-check class="size-4 shrink-0" style="color:#00f0ff;" />{{ $pt }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="rounded-xl overflow-hidden" style="aspect-ratio:16/9;">
                        <img src="https://picsum.photos/seed/mode-pvp/640/360" alt="PVP arena gameplay" class="w-full h-full object-cover" loading="lazy" />
                    </div>
                </div>
            </x-ui.tabs-content>

            <x-ui.tabs-content value="coop">
                <div class="arc-panel p-8 grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <x-lucide-users class="size-10 mb-4" style="color:#a855f7;" />
                        <h3 class="arc-title font-bold text-xl arc-neon-m mb-3">CO-OP RAID</h3>
                        <p style="color:#b090d0;" class="mb-6 leading-relaxed">Squad up with up to 4 friends for massive raid bosses. Coordinate abilities, share loot, and earn exclusive raid-only cosmetics.</p>
                        <ul class="space-y-2 text-sm" style="color:#9080c0;">
                            @foreach (['Up to 4-player squads', 'Raid boss encounters', 'Shared loot & XP', 'Exclusive raid cosmetics'] as $pt)
                                <li class="flex items-center gap-2"><x-lucide-check class="size-4 shrink-0" style="color:#a855f7;" />{{ $pt }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="rounded-xl overflow-hidden" style="aspect-ratio:16/9;">
                        <img src="https://picsum.photos/seed/mode-coop/640/360" alt="Co-op raid gameplay" class="w-full h-full object-cover" loading="lazy" />
                    </div>
                </div>
            </x-ui.tabs-content>

            <x-ui.tabs-content value="tournament">
                <div class="arc-panel p-8 grid md:grid-cols-2 gap-8 items-center">
                    <div>
                        <x-lucide-trophy class="size-10 mb-4" style="color:#aaff00;" />
                        <h3 class="arc-title font-bold text-xl arc-neon-lime mb-3">TOURNAMENT</h3>
                        <p style="color:#b090d0;" class="mb-6 leading-relaxed">Compete in weekly and monthly tournaments with real prize pools up to $50,000. Auto-entry for Pro+ members every single weekend.</p>
                        <ul class="space-y-2 text-sm" style="color:#9080c0;">
                            @foreach (['Weekly prize pools $500+', 'Monthly grand finals $50K', 'Auto-entry for Pro+', 'Spectator & broadcast mode'] as $pt)
                                <li class="flex items-center gap-2"><x-lucide-check class="size-4 shrink-0" style="color:#aaff00;" />{{ $pt }}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="rounded-xl overflow-hidden" style="aspect-ratio:16/9;">
                        <img src="https://picsum.photos/seed/mode-tour/640/360" alt="Tournament mode" class="w-full h-full object-cover" loading="lazy" />
                    </div>
                </div>
            </x-ui.tabs-content>
        </x-ui.tabs>
    </div>
</section>

{{-- ══════════════════════════ ACHIEVEMENTS ══════════════════════════ --}}
<section class="py-20" style="background: var(--arc-bg2);">
    <div class="mx-auto max-w-6xl px-6">
        <div class="grid lg:grid-cols-2 gap-12 items-center">
            {{-- Left: achievements --}}
            <div>
                <x-ui.badge tone="warning" variant="soft" class="arc-accent mb-4">YOUR PROGRESS</x-ui.badge>
                <h2 class="arc-title font-bold text-3xl arc-chrome mb-8">ACHIEVEMENTS</h2>

                <div class="space-y-6">
                    @php $colors = ['m', 'c', 'l', 'p']; @endphp
                    @foreach ($achievements as $i => $ach)
                        <div class="arc-panel p-4">
                            <div class="flex items-center gap-4 mb-3">
                                <div class="flex size-10 items-center justify-center rounded-lg shrink-0" style="background: rgba(168,85,247,0.15); border: 1px solid rgba(168,85,247,0.3);">
                                    <x-dynamic-component :component="'lucide-'.$ach['icon']" class="size-5" style="color:#a855f7;" />
                                </div>
                                <div class="flex-1 min-w-0">
                                    <div class="flex items-center justify-between gap-2">
                                        <span class="arc-title font-bold text-sm arc-neon-m">{{ $ach['label'] }}</span>
                                        <span class="arc-accent shrink-0" style="color:#a855f7; font-size:0.5rem;">{{ $ach['xp'] }}</span>
                                    </div>
                                    <p class="text-xs mt-0.5" style="color:#7060a0;">{{ $ach['desc'] }}</p>
                                </div>
                                <span class="arc-title font-bold text-sm shrink-0" style="color:#00f0ff;">{{ $ach['pct'] }}%</span>
                            </div>
                            <x-ui.progress :value="$ach['pct']" :ariaLabel="$ach['label'].' progress'" class="arc-progress-{{ $colors[$i] }} h-2" />
                        </div>
                    @endforeach
                </div>
            </div>

            {{-- Right: stats panel --}}
            <div class="arc-panel p-8">
                <h3 class="arc-title font-bold text-xl arc-neon-c mb-6">PLAYER STATS</h3>
                <div class="grid grid-cols-2 gap-4">
                    @foreach ([['4,291', 'HOURS PLAYED', 'clock'], ['847', 'GAMES WON', 'trophy'], ['23', 'BADGES', 'award'], ['Legendary', 'CURRENT RANK', 'star']] as [$v, $l, $ic])
                        <div class="text-center p-4 rounded-xl" style="background: rgba(168,85,247,0.08); border: 1px solid rgba(168,85,247,0.15);">
                            <x-dynamic-component :component="'lucide-'.$ic" class="size-6 mx-auto mb-2" style="color:#a855f7;" />
                            <div class="arc-title font-bold text-xl arc-neon-m">{{ $v }}</div>
                            <div class="arc-accent mt-1" style="color:#6050a0; font-size:0.45rem; letter-spacing:0.12em;">{{ $l }}</div>
                        </div>
                    @endforeach
                </div>

                <x-ui.separator class="my-6" style="background: rgba(168,85,247,0.2);" />

                {{-- Tooltip example --}}
                <div class="flex items-center justify-between">
                    <span class="text-sm" style="color:#9080c0;">Daily Login Streak</span>
                    <x-ui.tooltip>
                        <x-ui.tooltip-trigger>
                            <x-ui.badge tone="success" variant="solid" class="cursor-help arc-accent">30 DAYS</x-ui.badge>
                        </x-ui.tooltip-trigger>
                        <x-ui.tooltip-content>Keep going! 60 days unlocks the Chrome Frame cosmetic.</x-ui.tooltip-content>
                    </x-ui.tooltip>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══════════════════════════ COMMUNITY ══════════════════════════ --}}
<section class="py-20" style="background: var(--arc-bg);">
    <div class="mx-auto max-w-6xl px-6">
        <div class="text-center mb-12">
            <x-ui.badge tone="info" variant="soft" class="arc-accent mb-3">THE COMMUNITY</x-ui.badge>
            <h2 class="arc-title font-bold text-3xl sm:text-4xl arc-neon-m">12 MILLION STRONG</h2>
            <p class="mt-3 text-base" style="color:#9080c0;">What our players are saying right now</p>
        </div>

        {{-- Avatar stack --}}
        <div class="flex justify-center mb-10">
            <div class="flex -space-x-3">
                @foreach (['p10', 'p20', 'p30', 'p40', 'p50', 'p60', 'p70', 'p80'] as $seed)
                    <x-ui.tooltip>
                        <x-ui.tooltip-trigger>
                            <x-ui.avatar class="size-11 ring-2" style="ring-color: #1a0b2e;">
                                <x-ui.avatar-image src="https://picsum.photos/seed/{{ $seed }}/64/64" alt="Community member" />
                                <x-ui.avatar-fallback style="background: rgba(168,85,247,0.2); color:#a855f7;">?</x-ui.avatar-fallback>
                            </x-ui.avatar>
                        </x-ui.tooltip-trigger>
                        <x-ui.tooltip-content>Active player</x-ui.tooltip-content>
                    </x-ui.tooltip>
                @endforeach
                <div class="size-11 rounded-full flex items-center justify-center text-xs font-bold" style="background: rgba(168,85,247,0.2); border: 2px solid #1a0b2e; color:#a855f7; font-family:'Orbitron',sans-serif;">+12M</div>
            </div>
        </div>

        {{-- Testimonials --}}
        <div class="grid gap-5 md:grid-cols-3">
            @foreach ($community as $c)
                <x-ui.hover-card>
                    <x-ui.hover-card-trigger>
                        <div class="arc-panel p-5 cursor-pointer transition-all hover:border-purple-500/40" style="border-radius:12px;">
                            <div class="flex items-center gap-3 mb-4">
                                <x-ui.avatar class="size-10 shrink-0">
                                    <x-ui.avatar-image src="https://picsum.photos/seed/{{ $c['seed'] }}/64/64" alt="{{ $c['name'] }}" />
                                    <x-ui.avatar-fallback style="background: rgba(255,43,214,0.2); color:#ff2bd6;">{{ strtoupper(substr($c['name'], 0, 1)) }}</x-ui.avatar-fallback>
                                </x-ui.avatar>
                                <div>
                                    <div class="font-semibold text-sm arc-title" style="color:#e0d0f8;">{{ $c['name'] }}</div>
                                    <div class="text-xs" style="color:#6050a0;">{{ $c['time'] }}</div>
                                </div>
                            </div>
                            <p class="text-sm leading-relaxed" style="color:#b090d0;">"{{ $c['msg'] }}"</p>
                            <div class="mt-3 flex items-center gap-1">
                                <x-lucide-heart class="size-4" style="color:#ff2bd6;" />
                                <span class="text-xs" style="color:#7060a0;">{{ rand(12, 240) }} likes</span>
                            </div>
                        </div>
                    </x-ui.hover-card-trigger>
                    <x-ui.hover-card-content class="text-sm" style="background:#1a0b2e; border-color: rgba(168,85,247,0.3); color:#d0c0e8;">
                        <div class="font-semibold mb-1" style="color:#a855f7;">{{ $c['name'] }}</div>
                        <p style="color:#9080c0; font-size:0.75rem;">Active community member. Hover cards show quick player info.</p>
                    </x-ui.hover-card-content>
                </x-ui.hover-card>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════ MEMBERSHIP ══════════════════════════ --}}
<section id="membership" class="scroll-mt-20 py-20" style="background: var(--arc-bg2);" x-data="{ yearly: false }">
    <div class="mx-auto max-w-6xl px-6">
        <div class="text-center mb-10">
            <x-ui.badge tone="success" variant="soft" class="arc-accent mb-3">MEMBERSHIP TIERS</x-ui.badge>
            <h2 class="arc-title font-bold text-3xl sm:text-4xl arc-chrome mb-4">CHOOSE YOUR RANK</h2>

            {{-- Billing toggle --}}
            <div class="inline-flex items-center gap-3 rounded-full p-1 px-4 text-sm" style="background: rgba(26,11,46,0.8); border: 1px solid rgba(168,85,247,0.3);">
                <span class="text-sm" style="color: #9080c0;">Monthly</span>
                <x-ui.switch x-model="yearly" :checked="false" />
                <span class="text-sm" style="color: #9080c0;">Annual</span>
                <x-ui.badge tone="success" variant="soft" class="arc-accent ml-1">SAVE 25%</x-ui.badge>
            </div>
        </div>

        <div class="grid gap-6 md:grid-cols-3 items-stretch">
            @foreach ($plans as $plan)
                <div class="arc-plan-card p-7 flex flex-col {{ $plan['hot'] ? 'featured' : '' }}" style="{{ $plan['hot'] ? 'background: linear-gradient(160deg, #2a0a3e 0%, #1a0b2e 100%);' : '' }}">
                    @if ($plan['hot'])
                        <div class="text-center mb-4">
                            <x-ui.badge tone="danger" variant="solid" class="arc-accent">MOST POPULAR</x-ui.badge>
                        </div>
                    @endif

                    <div class="mb-1">
                        <span class="arc-accent text-xs" style="color:{{ $plan['color'] }}; letter-spacing:0.15em;">TIER</span>
                    </div>
                    <h3 class="arc-title font-black text-2xl mb-1" style="color:{{ $plan['color'] }}; text-shadow: 0 0 16px {{ $plan['color'] }}50;">{{ $plan['name'] }}</h3>
                    <p class="text-sm mb-5" style="color:#7060a0;">{{ $plan['tag'] }}</p>

                    {{-- Price --}}
                    <div class="mb-6">
                        <span class="arc-title font-bold text-4xl" style="color:#e0d0f8;">
                            $<span x-text="yearly ? {{ $plan['price_y'] }} : {{ $plan['price_m'] }}">{{ $plan['price_m'] }}</span>
                        </span>
                        <span class="text-sm" style="color:#6050a0;">/mo</span>
                        <template x-if="yearly && {{ $plan['price_y'] }} > 0">
                            <div class="text-xs mt-1" style="color:#a855f7;">billed annually</div>
                        </template>
                    </div>

                    <x-ui.button class="{{ $plan['hot'] ? 'arc-btn-magenta' : 'arc-btn-outline' }} rounded-xl w-full mb-6 text-sm h-10">
                        {{ $plan['cta'] }}
                    </x-ui.button>

                    <x-ui.separator class="mb-6" style="background: rgba(168,85,247,0.15);" />

                    <ul class="space-y-3 text-sm flex-1" style="color:#b090d0;">
                        @foreach ($plan['perks'] as $perk)
                            <li class="flex items-start gap-2.5">
                                <x-lucide-check class="size-4 shrink-0 mt-0.5" style="color:{{ $plan['color'] }};" />
                                {{ $perk }}
                            </li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══════════════════════════ FAQ ══════════════════════════ --}}
<section id="faq" class="scroll-mt-20 py-20" style="background: var(--arc-bg);">
    <div class="mx-auto max-w-3xl px-6">
        <div class="text-center mb-12">
            <x-ui.badge variant="outline" class="arc-accent mb-4" style="border-color:rgba(168,85,247,0.4);color:#a855f7;">FAQ</x-ui.badge>
            <h2 class="arc-title font-bold text-3xl sm:text-4xl arc-neon-c">QUESTIONS?</h2>
        </div>

        <x-ui.accordion type="single" collapsible class="w-full">
            @foreach ($faqs as $i => $faq)
                <x-ui.accordion-item value="faq-{{ $i }}">
                    <x-ui.accordion-trigger>{{ $faq['q'] }}</x-ui.accordion-trigger>
                    <x-ui.accordion-content>
                        <span style="color:#9080c0;">{{ $faq['a'] }}</span>
                    </x-ui.accordion-content>
                </x-ui.accordion-item>
            @endforeach
        </x-ui.accordion>
    </div>
</section>

{{-- ══════════════════════════ NEWSLETTER ══════════════════════════ --}}
<section class="py-20" style="background: var(--arc-bg2);">
    <div class="mx-auto max-w-2xl px-6 text-center">
        <x-ui.badge tone="info" variant="soft" class="arc-accent mb-4">STAY IN THE LOOP</x-ui.badge>
        <h2 class="arc-title font-bold text-3xl sm:text-4xl arc-neon-m mb-3">JOIN THE GRID</h2>
        <p class="mb-8 text-base" style="color:#9080c0;">New game drops, tournament alerts, and exclusive codes — straight to your inbox.</p>

        <form class="flex flex-col sm:flex-row gap-3 max-w-lg mx-auto" @submit.prevent>
            <x-ui.input
                type="email"
                placeholder="your@email.com"
                class="flex-1 rounded-xl text-sm"
                style="background: rgba(26,11,46,0.8); border-color: rgba(168,85,247,0.3); color:#e0d0f8;"
                aria-label="Email address"
            />
            <x-ui.button type="submit" class="arc-btn-magenta rounded-xl px-6 h-9 text-sm shrink-0">
                <x-lucide-send class="size-4" />
                SUBSCRIBE
            </x-ui.button>
        </form>

        <p class="mt-4 text-xs" style="color:#4030608;">No spam. Unsubscribe any time.</p>
    </div>
</section>

{{-- ══════════════════════════ FOOTER ══════════════════════════ --}}
<footer style="background: #080112; border-top: 1px solid rgba(168,85,247,0.2);">
    {{-- Footer ticker --}}
    <div class="overflow-hidden" style="border-bottom: 1px solid rgba(168,85,247,0.1); height: 32px; display:flex; align-items:center;">
        <x-ui.marquee :duration="'28s'" direction="right" class="h-full">
            @foreach (['NEON ARCADE', 'PLAY HARD', 'LEVEL UP', 'NO MERCY', 'INSERT COIN', 'HIGH SCORE', 'PRESS START', 'GG WP'] as $w)
                <span class="arc-accent" style="color: rgba(168,85,247,0.4); letter-spacing:0.2em; font-size:0.5rem;">{{ $w }} ✦</span>
            @endforeach
        </x-ui.marquee>
    </div>

    <div class="mx-auto max-w-7xl px-6 py-12">
        <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-5">
            <div class="lg:col-span-2">
                <div class="flex items-center gap-2.5 mb-4">
                    <span style="background: linear-gradient(135deg, #ff2bd6, #a855f7); box-shadow: 0 0 12px #ff2bd640;" class="flex size-9 items-center justify-center rounded-lg">
                        <x-lucide-gamepad-2 class="size-5 text-white" />
                    </span>
                    <span class="arc-title font-bold text-base arc-chrome">NEON ARCADE</span>
                </div>
                <p class="text-sm mb-5" style="color:#6050a0; max-width:260px;">The ultimate indie gaming platform. 300+ titles, global tournaments, legendary rewards.</p>
                <div class="flex gap-2">
                    @foreach (['twitter', 'github', 'youtube', 'monitor'] as $s)
                        <a href="#" aria-label="{{ $s }}" class="flex size-9 items-center justify-center rounded-lg transition-all" style="background: rgba(168,85,247,0.1); border: 1px solid rgba(168,85,247,0.2); color: #a855f7;" onmouseover="this.style.borderColor='#a855f7';this.style.boxShadow='0 0 12px rgba(168,85,247,0.4)'" onmouseout="this.style.borderColor='rgba(168,85,247,0.2)';this.style.boxShadow='none'">
                            <x-dynamic-component :component="'lucide-'.$s" class="size-4" />
                        </a>
                    @endforeach
                </div>
            </div>

            @foreach (['GAMES' => ['Action', 'Racing', 'RPG', 'Strategy', 'Puzzle'], 'COMPANY' => ['About', 'Careers', 'Press', 'Blog', 'Contact'], 'SUPPORT' => ['Help Center', 'Community', 'Status', 'Privacy', 'Terms']] as $heading => $links)
                <div>
                    <h3 class="arc-accent font-semibold mb-4" style="color:#a855f7; letter-spacing:0.15em; font-size:0.55rem;">{{ $heading }}</h3>
                    <ul class="space-y-2.5 text-sm">
                        @foreach ($links as $link)
                            <li><a href="#" class="transition-colors" style="color:#6050a0;" onmouseover="this.style.color='#00f0ff'" onmouseout="this.style.color='#6050a0'">{{ $link }}</a></li>
                        @endforeach
                    </ul>
                </div>
            @endforeach
        </div>

        <x-ui.separator class="my-8" style="background: rgba(168,85,247,0.1);" />

        <div class="flex flex-col sm:flex-row items-center justify-between gap-3 text-xs" style="color:#4030608;">
            <span style="color:#5040708;">© {{ date('Y') }} Neon Arcade, Inc. All rights reserved.</span>
            <div class="flex items-center gap-2" style="color:#5040708;">
                <x-lucide-shield-check class="size-4" style="color:#a855f7;" />
                <span>Secure &amp; Encrypted</span>
                <span class="arc-accent ml-2" style="color:#3020508; font-size:0.45rem;">NEON ARCADE v7.0</span>
            </div>
        </div>
    </div>
</footer>

</div>{{-- /tpl-arcade --}}
</x-layouts.app>
