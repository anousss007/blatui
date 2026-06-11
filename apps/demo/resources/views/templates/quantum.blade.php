@php
    /* ──────────────────────────────────────────────────────
     |  QUANTUM — Cyberpunk Web3 Portfolio Dashboard
     |  BlatUI template · dark / neon-futurist art direction
     ────────────────────────────────────────────────────── */

    $navItems = [
        ['Portfolio',  'pie-chart',        true],
        ['Markets',    'bar-chart-2',       false],
        ['Swap',       'arrow-left-right',  false],
        ['Staking',    'layers',            false],
        ['Activity',   'activity',          false],
        ['Settings',   'settings',          false],
    ];

    $kpis = [
        [
            'label'  => 'Total Balance',
            'value'  => '$142,840.52',
            'delta'  => '+8.34%',
            'up'     => true,
            'color'  => '#22d3ee',
            'spark'  => '0,22 14,18 28,20 42,12 56,14 70,6 84,10 98,4 112,2',
            'icon'   => 'wallet',
            'prog'   => 68,
        ],
        [
            'label'  => '24h P/L',
            'value'  => '+$4,219.30',
            'delta'  => '+3.04%',
            'up'     => true,
            'color'  => '#34d399',
            'spark'  => '0,20 14,16 28,12 42,18 56,8 70,14 84,6 98,10 112,4',
            'icon'   => 'trending-up',
            'prog'   => 74,
        ],
        [
            'label'  => 'Staked',
            'value'  => '$38,200.00',
            'delta'  => '+0.18%',
            'up'     => true,
            'color'  => '#7c3aed',
            'spark'  => '0,24 14,20 28,22 42,18 56,20 70,16 84,18 98,14 112,12',
            'icon'   => 'layers',
            'prog'   => 42,
        ],
        [
            'label'  => 'Rewards',
            'value'  => '$1,048.77',
            'delta'  => '-0.91%',
            'up'     => false,
            'color'  => '#ff2bd6',
            'spark'  => '0,6 14,10 28,8 42,14 56,12 70,18 84,16 98,22 112,24',
            'icon'   => 'gift',
            'prog'   => 29,
        ],
    ];

    $allocation = [
        ['ETH',  'Ethereum',     42, '#22d3ee', 'E'],
        ['BTC',  'Bitcoin',      28, '#f59e0b', 'B'],
        ['SOL',  'Solana',       14, '#7c3aed', 'S'],
        ['ARB',  'Arbitrum',      9, '#34d399', 'A'],
        ['MATIC','Polygon',        7, '#ff2bd6', 'M'],
    ];

    $markets = [
        ['ETH',   'Ethereum',   '$3,421.80', '+4.21', 'success', '0,28 14,22 28,24 42,16 56,14 70,6 84,8 98,2', 'E', '#22d3ee'],
        ['BTC',   'Bitcoin',    '$67,840.00','+2.18', 'success', '0,26 14,20 28,22 42,18 56,12 70,10 84,6 98,4', 'B', '#f59e0b'],
        ['SOL',   'Solana',      '$183.44',  '+7.55', 'success', '0,30 14,18 28,10 42,14 56,8 70,4 84,2 98,0', 'S', '#7c3aed'],
        ['ARB',   'Arbitrum',     '$1.24',   '-1.80', 'danger',  '0,4 14,8 28,6 42,12 56,14 70,18 84,20 98,26', 'A', '#34d399'],
        ['MATIC', 'Polygon',      '$0.844',  '+0.92', 'success', '0,22 14,18 28,20 42,16 56,14 70,12 84,10 98,8', 'M', '#ff2bd6'],
        ['LINK',  'Chainlink',   '$16.82',  '-2.11', 'danger',  '0,6 14,10 28,8 42,14 56,16 70,20 84,22 98,26', 'L', '#64748b'],
    ];

    $activity = [
        ['Swapped ETH → USDC',   'swap',         '$2,400.00',  '2m ago',   'info',    'arrow-left-right'],
        ['Staked 4.2 SOL',       'stake',         '$772.45',   '18m ago',  'success', 'layers'],
        ['Received ARB Reward',  'reward',         '$48.20',   '1h ago',   'warning', 'gift'],
        ['Bought 0.05 BTC',      'buy',        '$3,392.00',   '3h ago',   'success', 'trending-up'],
        ['Withdrew MATIC',       'withdraw',    '$214.60',    '5h ago',   'danger',  'arrow-up-right'],
        ['LP Fees Claimed',      'fees',          '$31.08',   '12h ago',  'info',    'coins'],
    ];

    $staking = [
        ['Ethereum 2.0',  'ETH', '4.2%',  78, '#22d3ee', '32.0 ETH',  '~12 days'],
        ['Solana',        'SOL', '6.8%',  55, '#7c3aed', '120.0 SOL', '~2 days'],
        ['Polygon',       'MATIC','8.4%', 33, '#ff2bd6', '5,000 MATIC','~30 days'],
    ];

    $setupStep = 2;

    // ── Chart series + options (single-quoted only; no nested double quotes in attributes) ──
    $portfolioSeries = [
        ['name' => 'Portfolio',  'data' => [98200, 101400, 99800, 104200, 108600, 112000, 109800, 115200, 119400, 123800, 118600, 128400, 131200, 135600, 142840]],
        ['name' => 'BTC Weight', 'data' => [38200, 39400, 37800, 40200, 42600, 44000, 42800, 45200, 47400, 50800, 47600, 53400, 55200, 58600, 61840]],
    ];

    $portfolioOptions = [
        'chart'  => ['background' => 'transparent', 'toolbar' => ['show' => false], 'sparkline' => ['enabled' => false]],
        'xaxis'  => [
            'categories' => ['Jun 28', 'Jun 29', 'Jun 30', 'Jul 1', 'Jul 2', 'Jul 3', 'Jul 4', 'Jul 5', 'Jul 6', 'Jul 7', 'Jul 8', 'Jul 9', 'Jul 10', 'Jul 11', 'Jul 12'],
            'labels'     => ['style' => ['colors' => '#64748b', 'fontSize' => '11px']],
        ],
        'yaxis'  => [
            'labels' => ['style' => ['colors' => '#64748b', 'fontSize' => '11px']],
        ],
        'grid'   => ['borderColor' => 'rgba(34,211,238,0.08)', 'strokeDashArray' => 4],
        'fill'   => ['type' => 'gradient', 'gradient' => ['shadeIntensity' => 1, 'opacityFrom' => 0.35, 'opacityTo' => 0.02, 'stops' => [0, 100]]],
        'stroke' => ['width' => 2, 'curve' => 'smooth'],
        'legend' => ['labels' => ['colors' => '#94a3b8']],
        'tooltip' => ['theme' => 'dark'],
    ];

    $volumeSeries = [
        ['name' => 'Buy',  'data' => [12400, 18900, 9200, 22100, 15800, 28400, 19600]],
        ['name' => 'Sell', 'data' => [8200, 14100, 7400, 16800, 12200, 21000, 14800]],
    ];

    $volumeOptions = [
        'chart'       => ['background' => 'transparent', 'toolbar' => ['show' => false], 'stacked' => false],
        'plotOptions' => ['bar' => ['borderRadius' => 6, 'columnWidth' => '55%', 'borderRadiusApplication' => 'end']],
        'xaxis'       => [
            'categories' => ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'],
            'labels'     => ['style' => ['colors' => '#64748b', 'fontSize' => '11px']],
        ],
        'yaxis'       => [
            'labels' => ['style' => ['colors' => '#64748b', 'fontSize' => '11px']],
        ],
        'grid'        => ['borderColor' => 'rgba(34,211,238,0.08)', 'strokeDashArray' => 4],
        'legend'      => ['labels' => ['colors' => '#94a3b8']],
        'tooltip'     => ['theme' => 'dark'],
        'dataLabels'  => ['enabled' => false],
    ];

    $donutOptions = [
        'chart'       => ['background' => 'transparent'],
        'plotOptions' => ['pie' => ['donut' => ['size' => '65%']]],
        'legend'      => ['show' => false],
        'dataLabels'  => ['enabled' => false],
        'tooltip'     => ['theme' => 'dark'],
        'stroke'      => ['width' => 0],
    ];
@endphp

<x-layouts.app title="Quantum — Web3 Portfolio">

{{-- ═══════════════════════════════════════════════
     STYLES — scoped under #tpl-quantum
═══════════════════════════════════════════════ --}}
<style>
@import url('https://fonts.bunny.net/css?family=space-grotesk:400,500,600,700|space-mono:400,700&display=swap');

#tpl-quantum {
    --q-base:    #07090f;
    --q-panel:   #0d1018;
    --q-border:  rgba(34,211,238,0.18);
    --q-cyan:    #22d3ee;
    --q-green:   #34d399;
    --q-neon:    #00ff9c;
    --q-magenta: #ff2bd6;
    --q-violet:  #7c3aed;
    --q-text:    #e2e8f0;
    --q-muted:   #64748b;
    --q-card-bg: #0d1018;
    --q-font-head: 'Space Grotesk', sans-serif;
    --q-font-mono: 'Space Mono', monospace;

    font-family: 'Inter', sans-serif;
    background: var(--q-base);
    color: var(--q-text);
    min-height: 100vh;
    position: relative;
    isolation: isolate;
}

/* Glowing grid background */
#tpl-quantum::before {
    content: '';
    position: fixed;
    inset: 0;
    z-index: 0;
    background-image:
        repeating-linear-gradient(0deg,   transparent, transparent 39px, rgba(34,211,238,0.04) 40px),
        repeating-linear-gradient(90deg,  transparent, transparent 39px, rgba(34,211,238,0.04) 40px);
    pointer-events: none;
}

/* Scanline overlay */
#tpl-quantum::after {
    content: '';
    position: fixed;
    inset: 0;
    z-index: 0;
    background: repeating-linear-gradient(
        0deg,
        transparent,
        transparent 2px,
        rgba(0,0,0,0.06) 2px,
        rgba(0,0,0,0.06) 4px
    );
    pointer-events: none;
}

#tpl-quantum * { position: relative; z-index: 1; }

/* Typography */
#tpl-quantum .q-heading { font-family: var(--q-font-head); }
#tpl-quantum .q-mono    { font-family: var(--q-font-mono); font-variant-numeric: tabular-nums; }

/* Panels */
#tpl-quantum .q-panel {
    background: var(--q-panel);
    border: 1px solid var(--q-border);
    border-radius: 12px;
}

/* Neon number glow */
#tpl-quantum .q-glow-cyan    { color: var(--q-cyan);    text-shadow: 0 0 12px rgba(34,211,238,0.7), 0 0 30px rgba(34,211,238,0.35); }
#tpl-quantum .q-glow-green   { color: var(--q-green);   text-shadow: 0 0 12px rgba(52,211,153,0.7), 0 0 30px rgba(52,211,153,0.35); }
#tpl-quantum .q-glow-magenta { color: var(--q-magenta); text-shadow: 0 0 12px rgba(255,43,214,0.7), 0 0 30px rgba(255,43,214,0.35); }
#tpl-quantum .q-glow-violet  { color: var(--q-violet);  text-shadow: 0 0 12px rgba(124,58,237,0.7), 0 0 30px rgba(124,58,237,0.35); }

/* Animated gradient border on hero card */
@keyframes q-border-spin {
    0%   { background-position: 0% 50%; }
    50%  { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
}
#tpl-quantum .q-hero-card {
    position: relative;
    border-radius: 14px;
    padding: 1px;
    background: linear-gradient(135deg, #22d3ee, #7c3aed, #ff2bd6, #34d399, #22d3ee);
    background-size: 300% 300%;
    animation: q-border-spin 5s ease infinite;
    box-shadow: 0 0 32px rgba(34,211,238,0.2), 0 0 64px rgba(124,58,237,0.12);
}
#tpl-quantum .q-hero-card-inner {
    background: var(--q-panel);
    border-radius: 13px;
    padding: 1.25rem 1.5rem;
    height: 100%;
}

/* Active sidebar item */
#tpl-quantum .q-nav-active {
    background: rgba(34,211,238,0.1);
    border: 1px solid rgba(34,211,238,0.3);
    color: var(--q-cyan);
}
#tpl-quantum .q-nav-item {
    border: 1px solid transparent;
    color: var(--q-muted);
    transition: color .15s, background .15s, border-color .15s;
}
#tpl-quantum .q-nav-item:hover {
    background: rgba(255,255,255,0.04);
    border-color: rgba(34,211,238,0.12);
    color: var(--q-text);
}

/* Neon button */
#tpl-quantum .q-btn-neon {
    background: rgba(34,211,238,0.12);
    border: 1px solid rgba(34,211,238,0.4);
    color: var(--q-cyan);
    border-radius: 8px;
    padding: 0.4rem 1rem;
    font-size: 0.8125rem;
    font-weight: 600;
    font-family: var(--q-font-head);
    cursor: pointer;
    transition: background .15s, box-shadow .15s;
}
#tpl-quantum .q-btn-neon:hover {
    background: rgba(34,211,238,0.2);
    box-shadow: 0 0 14px rgba(34,211,238,0.35);
}
#tpl-quantum .q-btn-neon:focus-visible {
    outline: 2px solid var(--q-cyan);
    outline-offset: 2px;
}

/* Token logo circle */
#tpl-quantum .q-token {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 32px;
    height: 32px;
    border-radius: 50%;
    font-family: var(--q-font-mono);
    font-size: 0.6875rem;
    font-weight: 700;
    flex-shrink: 0;
    border: 1px solid rgba(255,255,255,0.12);
}

/* Table rows */
#tpl-quantum .q-tr:hover { background: rgba(34,211,238,0.04); }

/* Progress track neon */
#tpl-quantum .q-progress-track {
    background: rgba(255,255,255,0.07);
    border-radius: 999px;
    height: 6px;
    overflow: hidden;
}
#tpl-quantum .q-progress-fill {
    height: 100%;
    border-radius: 999px;
    transition: width .6s ease;
}

/* Sparkline */
#tpl-quantum .q-spark { overflow: visible; }

/* Command palette trigger */
#tpl-quantum .q-cmd-trigger {
    display: flex;
    align-items: center;
    gap: 8px;
    background: rgba(255,255,255,0.04);
    border: 1px solid var(--q-border);
    border-radius: 8px;
    padding: 0.3rem 0.75rem;
    color: var(--q-muted);
    font-size: 0.8125rem;
    cursor: pointer;
    transition: border-color .15s, background .15s;
}
#tpl-quantum .q-cmd-trigger:hover {
    border-color: rgba(34,211,238,0.35);
    background: rgba(34,211,238,0.06);
    color: var(--q-cyan);
}

/* Topbar */
#tpl-quantum .q-topbar {
    background: rgba(7,9,15,0.92);
    border-bottom: 1px solid var(--q-border);
    backdrop-filter: blur(16px);
    -webkit-backdrop-filter: blur(16px);
}

/* Sidebar */
#tpl-quantum .q-sidebar {
    background: rgba(7,9,15,0.95);
    border-right: 1px solid var(--q-border);
}

/* Wallet badge */
#tpl-quantum .q-wallet {
    background: rgba(34,211,238,0.08);
    border: 1px solid rgba(34,211,238,0.25);
    border-radius: 20px;
    padding: 0.2rem 0.65rem 0.2rem 0.5rem;
    font-size: 0.75rem;
    font-family: var(--q-font-mono);
    color: var(--q-cyan);
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

/* Swap dialog input area */
#tpl-quantum .q-swap-input {
    background: rgba(255,255,255,0.04);
    border: 1px solid var(--q-border);
    border-radius: 10px;
    padding: 0.75rem 1rem;
    color: var(--q-text);
}
#tpl-quantum .q-swap-input:focus-within {
    border-color: rgba(34,211,238,0.45);
}

/* Separator neon */
#tpl-quantum .q-sep {
    height: 1px;
    background: linear-gradient(90deg, transparent, var(--q-border), transparent);
}

/* Pulse dot */
@keyframes q-pulse {
    0%, 100% { opacity: 1; }
    50%       { opacity: 0.4; }
}
#tpl-quantum .q-live-dot {
    width: 6px; height: 6px;
    border-radius: 50%;
    background: var(--q-neon);
    box-shadow: 0 0 6px var(--q-neon);
    animation: q-pulse 1.8s ease-in-out infinite;
    display: inline-block;
}

/* Stepper neon override */
#tpl-quantum [data-slot=stepper-indicator][data-state=active] {
    border-color: var(--q-cyan) !important;
    background: rgba(34,211,238,0.15) !important;
    color: var(--q-cyan) !important;
    box-shadow: 0 0 10px rgba(34,211,238,0.4);
}
#tpl-quantum [data-slot=stepper-indicator][data-state=completed] {
    border-color: var(--q-green) !important;
    background: rgba(52,211,153,0.15) !important;
    color: var(--q-green) !important;
}
#tpl-quantum [data-slot=stepper-indicator][data-state=inactive] {
    border-color: rgba(255,255,255,0.12) !important;
    color: var(--q-muted) !important;
}
#tpl-quantum [data-slot=stepper-title]   { color: var(--q-text); font-family: var(--q-font-head); font-weight: 600; }
#tpl-quantum [data-slot=stepper-description] { color: var(--q-muted); font-size: 0.75rem; }
#tpl-quantum [data-slot=stepper-separator] { background: var(--q-border) !important; }

/* Chart override — neon palette */
#tpl-quantum [data-slot=chart] {
    --chart-1: #22d3ee;
    --chart-2: #7c3aed;
    --chart-3: #34d399;
    --chart-4: #ff2bd6;
    --chart-5: #f59e0b;
}
#tpl-quantum .apexcharts-canvas,
#tpl-quantum .apexcharts-svg {
    background: transparent !important;
}

/* Badge tones in quantum context */
#tpl-quantum [data-slot=badge] {
    border-radius: 4px;
    font-family: var(--q-font-mono);
    font-size: 0.6875rem;
}

/* Reduced motion */
@media (prefers-reduced-motion: reduce) {
    #tpl-quantum .q-hero-card { animation: none; }
    #tpl-quantum .q-live-dot  { animation: none; }
    #tpl-quantum * { transition-duration: .01ms !important; animation-duration: .01ms !important; }
}
</style>

{{-- Sonner toaster (quantum position) --}}
<x-ui.sonner position="top-right" />

{{-- ═══════════════════════════════════════════════
     TEMPLATE ROOT
═══════════════════════════════════════════════ --}}
<div id="tpl-quantum" x-data="{
    swapOpen: false,
    cmdOpen:  false,
    fromAmt:  '',
    fromAsset: 'ETH',
    toAsset:  'USDC',
    chartRange: '1W',
    setupStep: 2
}">

    {{-- ════════════════════════════════════════════
         APP SHELL — sidebar + main column
    ════════════════════════════════════════════ --}}
    <div class="flex min-h-screen">

        {{-- ── Sidebar (desktop) ─────────────────── --}}
        <aside class="q-sidebar hidden w-56 shrink-0 flex-col lg:flex">
            {{-- Logo --}}
            <div class="flex h-14 items-center gap-2.5 border-b px-4 q-heading" style="border-color: var(--q-border);">
                <div style="width:30px;height:30px;border-radius:8px;background:linear-gradient(135deg,#22d3ee,#7c3aed);display:flex;align-items:center;justify-content:center;">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-4" viewBox="0 0 24 24" fill="none" stroke="white" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><polygon points="13 2 3 14 12 14 11 22 21 10 12 10 13 2"/></svg>
                </div>
                <span class="text-base font-bold tracking-tight" style="font-family:var(--q-font-head);color:var(--q-text);">Quantum</span>
                <span class="q-live-dot ml-auto" title="Live data"></span>
            </div>

            {{-- Nav --}}
            <nav class="flex-1 space-y-0.5 overflow-y-auto p-3">
                <p class="px-2 pb-1.5 text-[10px] font-semibold uppercase tracking-widest" style="color:var(--q-muted);">Main</p>
                @foreach ($navItems as [$label, $icon, $active])
                    <a href="#"
                       @class([
                           'flex items-center gap-2.5 rounded-lg px-2.5 py-2 text-sm font-medium q-nav-item',
                           'q-nav-active' => $active,
                       ])
                       @if ($active) aria-current="page" @endif
                    >
                        <x-dynamic-component :component="'lucide-'.$icon" class="size-4 shrink-0" />
                        {{ $label }}
                    </a>
                @endforeach

                <div class="my-3 q-sep"></div>
                <p class="px-2 pb-1.5 text-[10px] font-semibold uppercase tracking-widest" style="color:var(--q-muted);">Assets</p>
                @foreach ($allocation as [$sym, $name, $pct, $color, $init])
                    <a href="#" class="q-nav-item flex items-center gap-2.5 rounded-lg px-2.5 py-1.5 text-sm">
                        <span class="q-token text-[10px]" style="background:linear-gradient(135deg,{{ $color }}22,{{ $color }}44);color:{{ $color }};">{{ $init }}</span>
                        <span style="color:var(--q-text);font-family:var(--q-font-head);">{{ $sym }}</span>
                        <span class="ml-auto text-xs" style="color:var(--q-muted);font-family:var(--q-font-mono);">{{ $pct }}%</span>
                    </a>
                @endforeach
            </nav>

            {{-- User footer --}}
            <div class="border-t p-3" style="border-color:var(--q-border);">
                <div class="flex items-center gap-2.5 rounded-lg p-2 q-nav-item cursor-pointer">
                    <x-ui.avatar class="size-7">
                        <x-ui.avatar-image src="https://picsum.photos/seed/quser/64/64" alt="0xCafe" />
                        <x-ui.avatar-fallback class="text-xs">QW</x-ui.avatar-fallback>
                    </x-ui.avatar>
                    <div class="min-w-0 flex-1">
                        <div class="truncate text-xs font-semibold" style="color:var(--q-text);font-family:var(--q-font-head);">0xCafe…d3aD</div>
                        <div class="truncate text-[10px]" style="color:var(--q-muted);">Ethereum Mainnet</div>
                    </div>
                    <x-lucide-chevrons-up-down class="size-3.5 shrink-0" style="color:var(--q-muted);" />
                </div>
            </div>
        </aside>

        {{-- ── Main column ───────────────────────── --}}
        <div class="flex min-w-0 flex-1 flex-col">

            {{-- ── Topbar ──────────────────────────── --}}
            <header class="q-topbar sticky top-0 z-30 flex h-14 items-center gap-3 px-4 lg:px-6">
                {{-- Mobile menu --}}
                <x-ui.sheet>
                    <x-ui.sheet-trigger class="lg:hidden">
                        <x-ui.button variant="ghost" size="icon-sm" aria-label="Open menu" style="color:var(--q-muted);">
                            <x-lucide-menu class="size-4" />
                        </x-ui.button>
                    </x-ui.sheet-trigger>
                    <x-ui.sheet-content side="left" class="w-56 p-0" style="background:var(--q-base);border-color:var(--q-border);">
                        <div class="flex h-14 items-center gap-2.5 border-b px-4" style="border-color:var(--q-border);">
                            <span class="text-base font-bold" style="font-family:var(--q-font-head);color:var(--q-cyan);">Quantum</span>
                        </div>
                        <nav class="space-y-0.5 p-3">
                            @foreach ($navItems as [$label, $icon, $active])
                                <a href="#" class="flex items-center gap-2.5 rounded-lg px-2.5 py-2 text-sm font-medium q-nav-item {{ $active ? 'q-nav-active' : '' }}" @click="open = false">
                                    <x-dynamic-component :component="'lucide-'.$icon" class="size-4" />{{ $label }}
                                </a>
                            @endforeach
                        </nav>
                    </x-ui.sheet-content>
                </x-ui.sheet>

                {{-- Wordmark (mobile) --}}
                <span class="font-bold text-sm lg:hidden q-heading" style="color:var(--q-cyan);">Quantum</span>

                {{-- ⌘K Command palette trigger --}}
                <button class="q-cmd-trigger hidden sm:flex" @click="cmdOpen = true" aria-label="Open command palette">
                    <x-lucide-search class="size-3.5" />
                    <span>Search assets, actions…</span>
                    <x-ui.kbd>⌘K</x-ui.kbd>
                </button>

                <div class="ml-auto flex items-center gap-2">
                    {{-- Price alert toast --}}
                    <x-ui.tooltip>
                        <x-ui.tooltip-trigger>
                            <button
                                type="button"
                                aria-label="Trigger price alert"
                                class="q-btn-neon flex items-center gap-1.5"
                                @click="window.dispatchEvent(new CustomEvent('toast', { detail: { type: 'warning', title: 'Price Alert', description: 'ETH crossed $3,500 — up 8.1% in 4 hours.' } }))"
                            >
                                <x-lucide-bell class="size-3.5" />
                                <span class="hidden sm:inline">Alerts</span>
                            </button>
                        </x-ui.tooltip-trigger>
                        <x-ui.tooltip-content>Trigger sample price alert toast</x-ui.tooltip-content>
                    </x-ui.tooltip>

                    {{-- Wallet badge --}}
                    <x-ui.tooltip>
                        <x-ui.tooltip-trigger>
                            <span class="q-wallet" tabindex="0">
                                <span class="size-1.5 rounded-full inline-block" style="background:var(--q-neon);box-shadow:0 0 6px var(--q-neon);"></span>
                                0xCafe…d3aD
                            </span>
                        </x-ui.tooltip-trigger>
                        <x-ui.tooltip-content>Ethereum Mainnet · 32.4 ETH</x-ui.tooltip-content>
                    </x-ui.tooltip>

                    {{-- Avatar + dropdown --}}
                    <x-ui.dropdown-menu>
                        <x-ui.dropdown-menu-trigger>
                            <button aria-label="Account menu">
                                <x-ui.avatar class="size-8">
                                    <x-ui.avatar-image src="https://picsum.photos/seed/quser/64/64" alt="Wallet owner" />
                                    <x-ui.avatar-fallback class="text-xs" style="background:rgba(34,211,238,0.15);color:var(--q-cyan);">QW</x-ui.avatar-fallback>
                                </x-ui.avatar>
                            </button>
                        </x-ui.dropdown-menu-trigger>
                        <x-ui.dropdown-menu-content align="end" class="w-48" style="background:var(--q-panel);border-color:var(--q-border);color:var(--q-text);">
                            <x-ui.dropdown-menu-label style="color:var(--q-muted);">Wallet</x-ui.dropdown-menu-label>
                            <x-ui.dropdown-menu-separator style="background:var(--q-border);" />
                            <x-ui.dropdown-menu-item>Portfolio</x-ui.dropdown-menu-item>
                            <x-ui.dropdown-menu-item>Settings</x-ui.dropdown-menu-item>
                            <x-ui.dropdown-menu-item>API Keys</x-ui.dropdown-menu-item>
                            <x-ui.dropdown-menu-separator style="background:var(--q-border);" />
                            <x-ui.dropdown-menu-item>Disconnect</x-ui.dropdown-menu-item>
                        </x-ui.dropdown-menu-content>
                    </x-ui.dropdown-menu>
                </div>
            </header>

            {{-- ═══════════════════════════════════════
                 DASHBOARD BODY
            ═══════════════════════════════════════ --}}
            <main class="flex-1 space-y-5 p-4 lg:p-6">

                {{-- Page header --}}
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div>
                        <h1 class="text-xl font-bold q-heading" style="color:var(--q-text);">Portfolio Overview</h1>
                        <p class="text-sm mt-0.5 flex items-center gap-1.5" style="color:var(--q-muted);">
                            <span class="q-live-dot"></span>
                            Live · Updated just now
                        </p>
                    </div>
                    <div class="flex gap-2">
                        <button type="button" class="q-btn-neon flex items-center gap-1.5" @click="swapOpen = true">
                            <x-lucide-arrow-left-right class="size-3.5" aria-hidden="true" />
                            Swap
                        </button>
                        <x-ui.button variant="outline" size="sm" style="border-color:var(--q-border);color:var(--q-muted);background:transparent;">
                            <x-lucide-download class="size-3.5" /> Export
                        </x-ui.button>
                    </div>
                </div>

                {{-- ──────────────────────────────────────
                     SECTION 1 — KPI cards (4)
                ─────────────────────────────────────── --}}
                <div class="grid gap-4 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($kpis as $k)
                        <div class="q-panel p-5">
                            <div class="flex items-center justify-between mb-3">
                                <span class="text-xs font-medium q-heading uppercase tracking-wide" style="color:var(--q-muted);">{{ $k['label'] }}</span>
                                <x-ui.badge :tone="$k['up'] ? 'success' : 'danger'" variant="{{ $k['up'] ? 'soft' : 'soft' }}">
                                    {{ $k['delta'] }}
                                </x-ui.badge>
                            </div>
                            <div class="q-mono text-2xl font-bold leading-none mb-3" style="color:{{ $k['color'] }};text-shadow:0 0 14px {{ $k['color'] }}88;">
                                {{ $k['value'] }}
                            </div>
                            {{-- Sparkline --}}
                            <svg viewBox="0 0 112 30" class="q-spark h-7 w-full mb-3" fill="none" preserveAspectRatio="none" aria-hidden="true">
                                <defs>
                                    <linearGradient id="spark-grad-{{ $loop->index }}" x1="0" x2="0" y1="0" y2="1">
                                        <stop offset="0%" stop-color="{{ $k['color'] }}" stop-opacity="0.3"/>
                                        <stop offset="100%" stop-color="{{ $k['color'] }}" stop-opacity="0"/>
                                    </linearGradient>
                                </defs>
                                <polyline points="{{ $k['spark'] }}" stroke="{{ $k['color'] }}" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" fill="none"/>
                            </svg>
                            <div class="q-progress-track">
                                <div class="q-progress-fill" style="width:{{ $k['prog'] }}%;background:{{ $k['color'] }};box-shadow:0 0 8px {{ $k['color'] }}55;"></div>
                            </div>
                        </div>
                    @endforeach
                </div>

                {{-- ──────────────────────────────────────
                     SECTION 2 — Portfolio Chart + Allocation
                ─────────────────────────────────────── --}}
                <div class="grid gap-4 lg:grid-cols-3">

                    {{-- Portfolio area chart (2/3) --}}
                    <div class="q-panel p-5 lg:col-span-2">
                        <div class="flex flex-wrap items-center justify-between gap-3 mb-4">
                            <div>
                                <h2 class="text-sm font-semibold q-heading" style="color:var(--q-text);">Portfolio Value</h2>
                                <p class="text-xs mt-0.5" style="color:var(--q-muted);">Total holdings over time</p>
                            </div>
                            {{-- Range switcher tabs --}}
                            <x-ui.tabs :value="'1W'" x-data>
                                <x-ui.tabs-list class="h-7 gap-0.5 p-0.5" style="background:rgba(255,255,255,0.05);border:1px solid var(--q-border);">
                                    @foreach (['1D','1W','1M','1Y'] as $r)
                                        <x-ui.tabs-trigger
                                            value="{{ $r }}"
                                            class="h-6 px-2.5 text-xs"
                                            x-on:click="chartRange = '{{ $r }}'"
                                            style="font-family:var(--q-font-mono);"
                                        >{{ $r }}</x-ui.tabs-trigger>
                                    @endforeach
                                </x-ui.tabs-list>
                            </x-ui.tabs>
                        </div>
                        <x-ui.chart
                            type="area"
                            :config="['portfolio' => ['label' => 'Portfolio', 'color' => '#22d3ee'], 'btc' => ['label' => 'BTC Weight', 'color' => '#7c3aed']]"
                            :series="$portfolioSeries"
                            :colors="['#22d3ee', '#7c3aed']"
                            :options="$portfolioOptions"
                            :height="220"
                            label="Portfolio value chart"
                        />
                    </div>

                    {{-- Allocation (1/3) --}}
                    <div class="q-panel p-5">
                        <h2 class="text-sm font-semibold q-heading mb-4" style="color:var(--q-text);">Allocation</h2>
                        <div class="space-y-3">
                            @foreach ($allocation as [$sym, $name, $pct, $color, $init])
                                <div>
                                    <div class="flex items-center gap-2 mb-1.5">
                                        <span class="q-token text-[10px]" style="background:linear-gradient(135deg,{{ $color }}22,{{ $color }}44);color:{{ $color }};">{{ $init }}</span>
                                        <span class="text-sm font-medium q-heading flex-1" style="color:var(--q-text);">{{ $sym }}</span>
                                        <span class="text-xs q-mono" style="color:{{ $color }};">{{ $pct }}%</span>
                                    </div>
                                    <div class="q-progress-track">
                                        <div class="q-progress-fill" style="width:{{ $pct }}%;background:{{ $color }};box-shadow:0 0 8px {{ $color }}55;"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

                        <div class="q-sep mt-4 mb-3"></div>

                        {{-- Donut via chart --}}
                        <x-ui.chart
                            type="donut"
                            :labels="['ETH', 'BTC', 'SOL', 'ARB', 'MATIC']"
                            :series="[42, 28, 14, 9, 7]"
                            :colors="['#22d3ee', '#f59e0b', '#7c3aed', '#34d399', '#ff2bd6']"
                            :options="$donutOptions"
                            :height="160"
                            label="Asset allocation donut chart"
                        />
                    </div>
                </div>

                {{-- ──────────────────────────────────────
                     SECTION 3 — Markets table
                ─────────────────────────────────────── --}}
                <div class="q-panel overflow-hidden">
                    <div class="flex flex-wrap items-center justify-between gap-3 px-5 py-4">
                        <div>
                            <h2 class="text-sm font-semibold q-heading" style="color:var(--q-text);">Markets</h2>
                            <p class="text-xs mt-0.5" style="color:var(--q-muted);">Live prices · 24h change</p>
                        </div>
                        <div class="flex gap-2">
                            <x-ui.badge tone="info" variant="soft" class="gap-1">
                                <span class="q-live-dot" style="width:5px;height:5px;"></span> Live
                            </x-ui.badge>
                        </div>
                    </div>
                    <div class="q-sep"></div>
                    <x-ui.table>
                        <x-ui.table-header>
                            <x-ui.table-row style="border-color:var(--q-border);">
                                <x-ui.table-head style="color:var(--q-muted);font-family:var(--q-font-head);font-size:11px;text-transform:uppercase;letter-spacing:.06em;">Asset</x-ui.table-head>
                                <x-ui.table-head style="color:var(--q-muted);font-family:var(--q-font-head);font-size:11px;text-transform:uppercase;letter-spacing:.06em;">Price</x-ui.table-head>
                                <x-ui.table-head style="color:var(--q-muted);font-family:var(--q-font-head);font-size:11px;text-transform:uppercase;letter-spacing:.06em;">24h</x-ui.table-head>
                                <x-ui.table-head class="hidden sm:table-cell" style="color:var(--q-muted);font-family:var(--q-font-head);font-size:11px;text-transform:uppercase;letter-spacing:.06em;">Sparkline</x-ui.table-head>
                                <x-ui.table-head style="color:var(--q-muted);font-family:var(--q-font-head);font-size:11px;text-transform:uppercase;letter-spacing:.06em;text-align:right;">Trade</x-ui.table-head>
                            </x-ui.table-row>
                        </x-ui.table-header>
                        <x-ui.table-body>
                            @foreach ($markets as [$sym, $name, $price, $change, $tone, $spark, $init, $color])
                                <x-ui.table-row class="q-tr" style="border-color:var(--q-border);">
                                    <x-ui.table-cell>
                                        <div class="flex items-center gap-2.5">
                                            <span class="q-token text-[10px]" style="background:linear-gradient(135deg,{{ $color }}22,{{ $color }}44);color:{{ $color }};">{{ $init }}</span>
                                            <div>
                                                <div class="text-sm font-semibold q-heading" style="color:var(--q-text);">{{ $sym }}</div>
                                                <div class="text-[11px]" style="color:var(--q-muted);">{{ $name }}</div>
                                            </div>
                                        </div>
                                    </x-ui.table-cell>
                                    <x-ui.table-cell>
                                        <span class="q-mono font-semibold text-sm" style="color:var(--q-text);">{{ $price }}</span>
                                    </x-ui.table-cell>
                                    <x-ui.table-cell>
                                        <x-ui.badge :tone="$tone" variant="soft">{{ $change }}%</x-ui.badge>
                                    </x-ui.table-cell>
                                    <x-ui.table-cell class="hidden sm:table-cell">
                                        <svg viewBox="0 0 98 30" class="q-spark h-7 w-24" fill="none" preserveAspectRatio="none" aria-hidden="true">
                                            <polyline points="{{ $spark }}" stroke="{{ $color }}" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </x-ui.table-cell>
                                    <x-ui.table-cell style="text-align:right;">
                                        <button type="button" class="q-btn-neon text-xs px-3 py-1" @click="fromAsset = '{{ $sym }}'; swapOpen = true">Buy</button>
                                    </x-ui.table-cell>
                                </x-ui.table-row>
                            @endforeach
                        </x-ui.table-body>
                    </x-ui.table>
                </div>

                {{-- ──────────────────────────────────────
                     SECTION 4 — Staking + Activity (2 col)
                ─────────────────────────────────────── --}}
                <div class="grid gap-4 lg:grid-cols-2">

                    {{-- Staking --}}
                    <div class="q-panel p-5 space-y-4">
                        <div class="flex items-center justify-between">
                            <h2 class="text-sm font-semibold q-heading" style="color:var(--q-text);">Staking Positions</h2>
                            <x-ui.badge tone="success" variant="soft">Earning</x-ui.badge>
                        </div>
                        @foreach ($staking as [$pool, $sym, $apy, $filled, $color, $staked, $unlock])
                            <div class="q-panel p-3.5">
                                <div class="flex items-center gap-2.5 mb-3">
                                    <span class="q-token text-[10px]" style="background:linear-gradient(135deg,{{ $color }}22,{{ $color }}44);color:{{ $color }};">{{ $sym[0] }}</span>
                                    <div class="flex-1 min-w-0">
                                        <div class="text-sm font-semibold q-heading" style="color:var(--q-text);">{{ $pool }}</div>
                                        <div class="text-[11px] flex items-center gap-1 mt-0.5" style="color:var(--q-muted);">
                                            <span>Staked: <span style="color:var(--q-text);font-family:var(--q-font-mono);">{{ $staked }}</span></span>
                                            <x-ui.separator orientation="vertical" class="h-3" />
                                            <span>Unlock: <span style="color:var(--q-text);">{{ $unlock }}</span></span>
                                        </div>
                                    </div>
                                    <x-ui.tooltip>
                                        <x-ui.tooltip-trigger>
                                            <x-ui.badge tone="success" variant="solid" class="text-[11px]">{{ $apy }} APY</x-ui.badge>
                                        </x-ui.tooltip-trigger>
                                        <x-ui.tooltip-content>Annual Percentage Yield — compounded daily</x-ui.tooltip-content>
                                    </x-ui.tooltip>
                                </div>
                                <div class="q-progress-track">
                                    <div class="q-progress-fill" style="width:{{ $filled }}%;background:{{ $color }};box-shadow:0 0 8px {{ $color }}55;"></div>
                                </div>
                                <div class="flex justify-between mt-1.5 text-[11px]" style="color:var(--q-muted);">
                                    <span>Lock progress</span>
                                    <span style="color:{{ $color }};font-family:var(--q-font-mono);">{{ $filled }}%</span>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    {{-- Recent Activity --}}
                    <div class="q-panel p-5">
                        <div class="flex items-center justify-between mb-4">
                            <h2 class="text-sm font-semibold q-heading" style="color:var(--q-text);">Recent Activity</h2>
                            <button type="button" class="text-xs hover:underline" style="color:var(--q-cyan);">View all</button>
                        </div>
                        <div class="space-y-0.5">
                            @foreach ($activity as [$label, $type, $amount, $time, $tone, $icon])
                                <x-ui.item size="sm" style="border-color:transparent;">
                                    <x-ui.item-media variant="icon" style="background:rgba(255,255,255,0.05);border-color:var(--q-border);">
                                        <x-dynamic-component :component="'lucide-'.$icon" class="size-4" style="color:var(--q-cyan);" />
                                    </x-ui.item-media>
                                    <x-ui.item-content>
                                        <x-ui.item-title style="color:var(--q-text);font-size:0.8125rem;">{{ $label }}</x-ui.item-title>
                                        <span class="text-[11px]" style="color:var(--q-muted);">{{ $time }}</span>
                                    </x-ui.item-content>
                                    <x-ui.item-actions>
                                        <span class="q-mono text-sm font-semibold" style="color:var(--q-green);">{{ $amount }}</span>
                                        <x-ui.badge :tone="$tone" variant="soft">{{ ucfirst($type) }}</x-ui.badge>
                                    </x-ui.item-actions>
                                </x-ui.item>
                                @if (!$loop->last)
                                    <div class="q-sep my-0.5"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ──────────────────────────────────────
                     SECTION 5 — Onboarding stepper (hero card)
                ─────────────────────────────────────── --}}
                <div class="q-hero-card" role="region" aria-label="Account setup">
                    <div class="q-hero-card-inner">
                        <div class="flex flex-wrap items-start justify-between gap-4">
                            <div class="min-w-0">
                                <div class="flex items-center gap-2 mb-1">
                                    <x-lucide-shield-check class="size-4 shrink-0" style="color:var(--q-cyan);" />
                                    <h2 class="text-sm font-bold q-heading" style="color:var(--q-text);">Complete Your Quantum Setup</h2>
                                </div>
                                <p class="text-xs mb-4" style="color:var(--q-muted);">Unlock the full dashboard — 2 of 4 steps complete.</p>
                                <x-ui.stepper :value="$setupStep" class="w-full">
                                    <x-ui.stepper-nav>
                                        <x-ui.stepper-item :step="1">
                                            <x-ui.stepper-trigger>
                                                <x-ui.stepper-indicator />
                                                <span class="hidden sm:flex flex-col gap-0.5">
                                                    <x-ui.stepper-title>Connect Wallet</x-ui.stepper-title>
                                                    <x-ui.stepper-description>MetaMask linked</x-ui.stepper-description>
                                                </span>
                                            </x-ui.stepper-trigger>
                                            <x-ui.stepper-separator />
                                        </x-ui.stepper-item>
                                        <x-ui.stepper-item :step="2">
                                            <x-ui.stepper-trigger>
                                                <x-ui.stepper-indicator />
                                                <span class="hidden sm:flex flex-col gap-0.5">
                                                    <x-ui.stepper-title>Fund Account</x-ui.stepper-title>
                                                    <x-ui.stepper-description>Deposit assets</x-ui.stepper-description>
                                                </span>
                                            </x-ui.stepper-trigger>
                                            <x-ui.stepper-separator />
                                        </x-ui.stepper-item>
                                        <x-ui.stepper-item :step="3">
                                            <x-ui.stepper-trigger>
                                                <x-ui.stepper-indicator />
                                                <span class="hidden sm:flex flex-col gap-0.5">
                                                    <x-ui.stepper-title>Enable 2FA</x-ui.stepper-title>
                                                    <x-ui.stepper-description>Secure your account</x-ui.stepper-description>
                                                </span>
                                            </x-ui.stepper-trigger>
                                            <x-ui.stepper-separator />
                                        </x-ui.stepper-item>
                                        <x-ui.stepper-item :step="4">
                                            <x-ui.stepper-trigger>
                                                <x-ui.stepper-indicator />
                                                <span class="hidden sm:flex flex-col gap-0.5">
                                                    <x-ui.stepper-title>Set Alerts</x-ui.stepper-title>
                                                    <x-ui.stepper-description>Price & liquidation</x-ui.stepper-description>
                                                </span>
                                            </x-ui.stepper-trigger>
                                        </x-ui.stepper-item>
                                    </x-ui.stepper-nav>
                                </x-ui.stepper>
                            </div>
                            <div class="flex items-center gap-2 shrink-0">
                                <button type="button" class="q-btn-neon flex items-center gap-1.5" x-on:click="$dispatch('toast', { type: 'info', title: 'Setup step', description: 'Enable 2FA to secure your portfolio.' })">
                                    <x-lucide-arrow-right class="size-3.5" />
                                    Continue
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ──────────────────────────────────────
                     SECTION 6 — Bar chart (vol) + Stat row
                ─────────────────────────────────────── --}}
                <div class="grid gap-4 lg:grid-cols-3">
                    {{-- Volume bar chart --}}
                    <div class="q-panel p-5 lg:col-span-2">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h2 class="text-sm font-semibold q-heading" style="color:var(--q-text);">Trading Volume</h2>
                                <p class="text-xs mt-0.5" style="color:var(--q-muted);">Last 7 days · USD</p>
                            </div>
                            <x-ui.badge tone="neutral" variant="outline">Weekly</x-ui.badge>
                        </div>
                        <x-ui.chart
                            type="bar"
                            :series="$volumeSeries"
                            :colors="['#22d3ee', '#ff2bd6']"
                            :options="$volumeOptions"
                            :height="200"
                            label="Weekly trading volume bar chart"
                        />
                    </div>

                    {{-- Quick stats column --}}
                    <div class="q-panel p-5 flex flex-col gap-4">
                        <h2 class="text-sm font-semibold q-heading" style="color:var(--q-text);">Account Stats</h2>
                        @foreach ([
                            ['All-time P/L',    '+$22,418.40', '#34d399'],
                            ['Best trade',      '+$8,102 ETH',  '#22d3ee'],
                            ['Win rate',        '68.4%',        '#7c3aed'],
                            ['Trades this week','14',           '#ff2bd6'],
                            ['Gas spent (30d)', '$214.50',      '#f59e0b'],
                        ] as [$lbl, $val, $c])
                            <div>
                                <div class="text-[11px] mb-0.5" style="color:var(--q-muted);">{{ $lbl }}</div>
                                <div class="q-mono text-lg font-bold" style="color:{{ $c }};text-shadow:0 0 10px {{ $c }}66;">{{ $val }}</div>
                            </div>
                            @if (!$loop->last)<div class="q-sep"></div>@endif
                        @endforeach
                    </div>
                </div>

            </main>
        </div>
    </div>

    {{-- ═══════════════════════════════════════════════
         SWAP DIALOG
    ═══════════════════════════════════════════════ --}}
    <x-ui.dialog :open="false" id="quantum-swap">
        <x-ui.dialog-content style="background:var(--q-panel);border:1px solid rgba(34,211,238,0.3);color:var(--q-text);" x-show="swapOpen" @keydown.escape.window="swapOpen = false" x-trap.noscroll.inert="swapOpen">
            <x-ui.dialog-header>
                <x-ui.dialog-title class="q-heading" style="color:var(--q-cyan);">Swap Assets</x-ui.dialog-title>
                <x-ui.dialog-description style="color:var(--q-muted);">Instantly swap between tokens at best market rates.</x-ui.dialog-description>
            </x-ui.dialog-header>

            <div class="space-y-3">
                {{-- From --}}
                <div class="q-swap-input">
                    <label class="text-[11px] uppercase tracking-wide font-semibold mb-2 block" style="color:var(--q-muted);">From</label>
                    <div class="flex items-center gap-3">
                        <x-ui.select
                            :options="['ETH' => 'ETH', 'BTC' => 'BTC', 'SOL' => 'SOL', 'MATIC' => 'MATIC', 'ARB' => 'ARB']"
                            value="ETH"
                            class="w-28 shrink-0"
                            style="--select-bg:transparent;"
                        />
                        <x-ui.input
                            type="number"
                            placeholder="0.00"
                            x-model="fromAmt"
                            class="flex-1 q-mono text-lg font-bold border-0 bg-transparent p-0 h-auto focus-visible:ring-0"
                            style="color:var(--q-text);"
                        />
                        <button type="button" class="text-[11px] px-2 py-0.5 rounded" style="background:rgba(34,211,238,0.12);color:var(--q-cyan);border:1px solid rgba(34,211,238,0.3);">MAX</button>
                    </div>
                    <div class="text-[11px] mt-2" style="color:var(--q-muted);">Balance: <span style="color:var(--q-text);font-family:var(--q-font-mono);">32.4 ETH</span> · ≈ <span style="color:var(--q-text);">$110,833</span></div>
                </div>

                {{-- Arrow swap --}}
                <div class="flex justify-center">
                    <button type="button" class="q-btn-neon size-9 flex items-center justify-center rounded-full p-0" aria-label="Switch direction">
                        <x-lucide-arrow-up-down class="size-4" />
                    </button>
                </div>

                {{-- To --}}
                <div class="q-swap-input">
                    <label class="text-[11px] uppercase tracking-wide font-semibold mb-2 block" style="color:var(--q-muted);">To</label>
                    <div class="flex items-center gap-3">
                        <x-ui.select
                            :options="['USDC' => 'USDC', 'USDT' => 'USDT', 'DAI' => 'DAI', 'ETH' => 'ETH', 'BTC' => 'BTC']"
                            value="USDC"
                            class="w-28 shrink-0"
                        />
                        <span class="q-mono text-lg font-bold flex-1" style="color:var(--q-cyan);">≈ 0.00</span>
                    </div>
                    <div class="text-[11px] mt-2" style="color:var(--q-muted);">Rate: 1 ETH = 3,421.80 USDC</div>
                </div>

                {{-- Route info --}}
                <div class="rounded-lg p-3 flex items-center justify-between text-xs" style="background:rgba(255,255,255,0.03);border:1px solid var(--q-border);">
                    <span style="color:var(--q-muted);">Route</span>
                    <span style="color:var(--q-text);font-family:var(--q-font-mono);">ETH → Uniswap V3 → USDC</span>
                    <x-ui.badge tone="success" variant="soft">Best</x-ui.badge>
                </div>
            </div>

            <x-ui.dialog-footer>
                <x-ui.button variant="outline" @click="swapOpen = false" style="border-color:var(--q-border);color:var(--q-muted);background:transparent;">Cancel</x-ui.button>
                <button type="button" class="q-btn-neon flex-1 flex items-center justify-center gap-1.5 py-2 text-sm"
                    @click="window.dispatchEvent(new CustomEvent('toast', { detail: { type: 'success', title: 'Swap submitted', description: 'Transaction broadcast to Ethereum Mainnet.' } })); swapOpen = false">
                    <x-lucide-zap class="size-4" />
                    Confirm Swap
                </button>
            </x-ui.dialog-footer>
        </x-ui.dialog-content>
    </x-ui.dialog>

    {{-- ═══════════════════════════════════════════════
         COMMAND DIALOG (⌘K)
    ═══════════════════════════════════════════════ --}}
    <x-ui.command-dialog title="Quantum Command Palette" description="Search assets, navigate or run actions">
        <x-slot:trigger>
            {{-- Triggered programmatically via cmdOpen state --}}
        </x-slot:trigger>
        <template x-teleport="body">
            <div x-show="cmdOpen" x-cloak class="fixed inset-0 z-50" @keydown.escape.window="cmdOpen = false">
                <div x-show="cmdOpen" @click="cmdOpen = false" class="fixed inset-0 bg-black/60" aria-hidden="true"></div>
                <div
                    x-show="cmdOpen"
                    x-trap.noscroll.inert="cmdOpen"
                    class="fixed top-[30%] left-1/2 z-50 w-full max-w-md -translate-x-1/2 -translate-y-1/2 overflow-hidden rounded-xl shadow-2xl"
                    style="background:var(--q-panel);border:1px solid rgba(34,211,238,0.35);box-shadow:0 0 40px rgba(34,211,238,0.15),0 20px 60px rgba(0,0,0,0.5);"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    role="dialog" aria-modal="true" aria-label="Command palette"
                >
                    <x-ui.command>
                        <x-ui.command-input placeholder="Search assets, pages, actions…" />
                        <x-ui.command-list>
                            <x-ui.command-empty>No results found.</x-ui.command-empty>
                            <x-ui.command-group heading="Navigation">
                                <x-ui.command-item value="portfolio" @click="cmdOpen = false">
                                    <x-lucide-pie-chart class="size-4" style="color:var(--q-cyan);" /> Portfolio
                                    <x-ui.command-shortcut style="color:var(--q-muted);">⌘P</x-ui.command-shortcut>
                                </x-ui.command-item>
                                <x-ui.command-item value="markets" @click="cmdOpen = false">
                                    <x-lucide-bar-chart-2 class="size-4" style="color:var(--q-violet);" /> Markets
                                </x-ui.command-item>
                                <x-ui.command-item value="staking" @click="cmdOpen = false">
                                    <x-lucide-layers class="size-4" style="color:var(--q-green);" /> Staking
                                </x-ui.command-item>
                            </x-ui.command-group>
                            <x-ui.command-separator />
                            <x-ui.command-group heading="Actions">
                                <x-ui.command-item value="swap eth usdc" @click="swapOpen = true; cmdOpen = false">
                                    <x-lucide-arrow-left-right class="size-4" style="color:var(--q-magenta);" /> Swap ETH → USDC
                                    <x-ui.command-shortcut style="color:var(--q-muted);">⌘S</x-ui.command-shortcut>
                                </x-ui.command-item>
                                <x-ui.command-item value="price alert" @click="window.dispatchEvent(new CustomEvent('toast', { detail: { type: 'warning', title: 'Alert set', description: 'Price alert for ETH at $3,500 saved.' } })); cmdOpen = false">
                                    <x-lucide-bell class="size-4" style="color:var(--q-cyan);" /> Set Price Alert
                                </x-ui.command-item>
                            </x-ui.command-group>
                            <x-ui.command-separator />
                            <x-ui.command-group heading="Assets">
                                @foreach ([['ETH','E','#22d3ee'],['BTC','B','#f59e0b'],['SOL','S','#7c3aed']] as [$s,$i,$c])
                                    <x-ui.command-item :value="$s" @click="cmdOpen = false">
                                        <span class="q-token text-[9px] size-5" style="background:linear-gradient(135deg,{{ $c }}22,{{ $c }}44);color:{{ $c }};">{{ $i }}</span>
                                        {{ $s }}
                                    </x-ui.command-item>
                                @endforeach
                            </x-ui.command-group>
                        </x-ui.command-list>
                    </x-ui.command>
                </div>
            </div>
        </template>
    </x-ui.command-dialog>

    {{-- global ⌘K listener --}}
    <div x-data style="display:none;" @keydown.meta.k.window.prevent="cmdOpen = !cmdOpen" @keydown.ctrl.k.window.prevent="cmdOpen = !cmdOpen"></div>

</div>
</x-layouts.app>
