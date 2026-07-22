@php
    $nav = ['Shows' => '#shows', 'Episodes' => '#episodes', 'Categories' => '#categories', 'Creators' => '#creators', 'Pricing' => '#pricing'];

    $listenOn = [
        ['label' => 'Spotify', 'icon' => 'music'],
        ['label' => 'Apple Podcasts', 'icon' => 'headphones'],
        ['label' => 'YouTube', 'icon' => 'youtube'],
        ['label' => 'RSS Feed', 'icon' => 'rss'],
    ];

    $episodes = [
        ['num' => 'EP 142', 'title' => 'The Art of Deep Focus', 'show' => 'Mind & Flow', 'duration' => '58 min', 'date' => 'Jun 10', 'img' => 'https://picsum.photos/seed/ep142/400/400', 'plays' => '84K', 'tag' => 'Mindfulness'],
        ['num' => 'EP 089', 'title' => 'Building Billion-Dollar Brands', 'show' => 'Startup Pulse', 'duration' => '72 min', 'date' => 'Jun 8', 'img' => 'https://picsum.photos/seed/ep089/400/400', 'plays' => '121K', 'tag' => 'Business'],
        ['num' => 'EP 211', 'title' => 'AI Is Eating the World', 'show' => 'Tech Unfiltered', 'duration' => '45 min', 'date' => 'Jun 7', 'img' => 'https://picsum.photos/seed/ep211/400/400', 'plays' => '203K', 'tag' => 'Technology'],
        ['num' => 'EP 037', 'title' => 'Rituals of High Performers', 'show' => 'Elite Edge', 'duration' => '61 min', 'date' => 'Jun 6', 'img' => 'https://picsum.photos/seed/ep037/400/400', 'plays' => '67K', 'tag' => 'Lifestyle'],
        ['num' => 'EP 174', 'title' => 'Money, Risk & Regret', 'show' => 'Wealth Lens', 'duration' => '53 min', 'date' => 'Jun 5', 'img' => 'https://picsum.photos/seed/ep174/400/400', 'plays' => '98K', 'tag' => 'Finance'],
    ];

    $shows = [
        ['title' => 'Mind & Flow', 'host' => 'Dr. Aria Senn', 'category' => 'Mindfulness', 'rating' => 4.9, 'eps' => 142, 'img' => 'https://picsum.photos/seed/show1/600/600', 'bio' => 'Neuroscientist turned meditation guide. Hosts Mind & Flow to bridge science and inner peace.'],
        ['title' => 'Startup Pulse', 'host' => 'Marcus Webb', 'category' => 'Business', 'rating' => 4.8, 'eps' => 89, 'img' => 'https://picsum.photos/seed/show2/600/600', 'bio' => 'Serial founder of three exits. Weekly conversations with the builders rewriting the rules.'],
        ['title' => 'Tech Unfiltered', 'host' => 'Priya Chandra', 'category' => 'Technology', 'rating' => 4.9, 'eps' => 211, 'img' => 'https://picsum.photos/seed/show3/600/600', 'bio' => 'Ex-Google engineer. Unfiltered analysis on AI, dev culture and what big tech won\'t say.'],
        ['title' => 'Wealth Lens', 'host' => 'Leon Farrow', 'category' => 'Finance', 'rating' => 4.7, 'eps' => 174, 'img' => 'https://picsum.photos/seed/show4/600/600', 'bio' => 'Portfolio manager. Breaks down macro economics so anyone can invest with confidence.'],
        ['title' => 'Elite Edge', 'host' => 'Simone Park', 'category' => 'Lifestyle', 'rating' => 4.8, 'eps' => 37, 'img' => 'https://picsum.photos/seed/show5/600/600', 'bio' => 'Olympic coach turned life optimizer. Daily habits, mental toughness and peak output.'],
        ['title' => 'Dark Archives', 'host' => 'James Hollow', 'category' => 'True Crime', 'rating' => 4.6, 'eps' => 58, 'img' => 'https://picsum.photos/seed/show6/600/600', 'bio' => 'Investigative journalist. Cold cases, unsolved mysteries, and the stories that haunt.'],
    ];

    $categories = [
        'trending' => ['label' => 'Trending', 'items' => ['Mind & Flow', 'Tech Unfiltered', 'Startup Pulse', 'Dark Archives', 'Wealth Lens', 'Elite Edge']],
        'technology' => ['label' => 'Technology', 'items' => ['Tech Unfiltered', 'AI Daily', 'Dev Unlocked', 'Future Stack', 'Open Source Now', 'Code & Coffee']],
        'business' => ['label' => 'Business', 'items' => ['Startup Pulse', 'Wealth Lens', 'Scale Fast', 'Founder Mode', 'B2B Decoded', 'Revenue Machine']],
        'wellness' => ['label' => 'Wellness', 'items' => ['Mind & Flow', 'Elite Edge', 'Sleep Science', 'Body Rx', 'Gut Feeling', 'Move With Intent']],
    ];

    $creators = [
        ['name' => 'Dr. Aria Senn', 'show' => 'Mind & Flow', 'img' => 'https://picsum.photos/seed/cr1/200/200', 'followers' => '412K'],
        ['name' => 'Marcus Webb', 'show' => 'Startup Pulse', 'img' => 'https://picsum.photos/seed/cr2/200/200', 'followers' => '387K'],
        ['name' => 'Priya Chandra', 'show' => 'Tech Unfiltered', 'img' => 'https://picsum.photos/seed/cr3/200/200', 'followers' => '614K'],
        ['name' => 'Leon Farrow', 'show' => 'Wealth Lens', 'img' => 'https://picsum.photos/seed/cr4/200/200', 'followers' => '298K'],
        ['name' => 'Simone Park', 'show' => 'Elite Edge', 'img' => 'https://picsum.photos/seed/cr5/200/200', 'followers' => '231K'],
        ['name' => 'James Hollow', 'show' => 'Dark Archives', 'img' => 'https://picsum.photos/seed/cr6/200/200', 'followers' => '509K'],
        ['name' => 'Yuki Tanaka', 'show' => 'Night Frequency', 'img' => 'https://picsum.photos/seed/cr7/200/200', 'followers' => '178K'],
        ['name' => 'Nia Osei', 'show' => 'Culture Shift', 'img' => 'https://picsum.photos/seed/cr8/200/200', 'followers' => '334K'],
    ];

    $plans = [
        ['name' => 'Free', 'desc' => 'Casual listening', 'm' => 0, 'y' => 0, 'cta' => 'Start free', 'highlight' => false, 'features' => ['Ad-supported streaming', '5 downloads/month', 'Standard audio quality', 'Access to all shows']],
        ['name' => 'Lumen+', 'desc' => 'For the devoted listener', 'm' => 9, 'y' => 7, 'cta' => 'Try 30 days free', 'highlight' => true, 'features' => ['Ad-free listening', 'Unlimited downloads', 'High-fidelity audio', 'Early access episodes', 'Exclusive creator Q&As']],
        ['name' => 'Studio', 'desc' => 'For creators', 'm' => 29, 'y' => 24, 'cta' => 'Start creating', 'highlight' => false, 'features' => ['Everything in Lumen+', 'Unlimited uploads', 'Analytics dashboard', 'Monetisation tools', 'Custom RSS & embed']],
    ];

    $testimonials = [
        ['q' => 'Lumen is the only app that gets out of the way and lets me lose myself in a show. The audio quality alone is worth every penny.', 'a' => 'Karan Mehta', 'r' => 'Product Designer', 'img' => 'https://picsum.photos/seed/tm1/160/160'],
        ['q' => 'I launched my podcast here three months ago and hit 50K listeners. The discovery algorithm actually works for indie creators.', 'a' => 'Sofia Ruiz', 'r' => 'Independent Creator', 'img' => 'https://picsum.photos/seed/tm2/160/160'],
        ['q' => 'The waveform player is addictive. I clip and share episodes to social every single day — engagement has never been higher.', 'a' => 'David Chen', 'r' => 'Marketing Lead', 'img' => 'https://picsum.photos/seed/tm3/160/160'],
    ];

    $faqs = [
        ['q' => 'Can I listen offline?', 'a' => 'Yes. Lumen+ and Studio subscribers can download unlimited episodes. Free listeners get 5 downloads per month, perfect for commutes.'],
        ['q' => 'What audio quality does Lumen offer?', 'a' => 'Free tier streams at 128 kbps AAC. Lumen+ delivers up to 320 kbps AAC and lossless FLAC for supported shows — audiophile-grade sound.'],
        ['q' => 'How do I start my own podcast?', 'a' => 'Sign up for a Studio plan, upload your first episode and your RSS feed is live within minutes. Distribute to every major platform automatically.'],
        ['q' => 'Do you support video podcasts?', 'a' => 'Absolutely. Upload video-first episodes and Lumen hosts both the audio and video versions, auto-generating chapter markers and transcripts.'],
        ['q' => 'Can I cancel my subscription anytime?', 'a' => 'Yes, cancel any time from your account settings. Your subscription continues until the end of the billing period — no hidden fees, no calls.'],
    ];

    $marqueeShows = ['Mind & Flow', 'Startup Pulse', 'Tech Unfiltered', 'Dark Archives', 'Wealth Lens', 'Elite Edge', 'Night Frequency', 'Culture Shift', 'Body Rx', 'AI Daily', 'Gut Feeling', 'Code & Coffee'];

    $waveHeights = [30, 55, 42, 70, 35, 88, 60, 45, 75, 50, 90, 38, 65, 80, 42, 58, 72, 35, 95, 48, 62, 85, 40, 68];
@endphp

<x-layouts.app title="Lumen — Listen louder">

<style>
@import url('https://fonts.bunny.net/css?family=sora:400,600,700,800&family=inter:400,500,600');

/* ── Lumen design tokens (scoped) ───────────────────────── */
#tpl-lumen {
    --ink:     #0e0b16;
    --ink2:    #1a1628;
    --coral:   #ff5e5b;
    --amber:   #ffb627;
    --teal:    #00cecb;
    --purple:  #6c5ce7;
    --offwhite:#f0eaff;
    --muted:   #8b7fa8;
    background: var(--ink);
    color: var(--offwhite);
    font-family: 'Inter', system-ui, sans-serif;
    isolation: isolate;
}

#tpl-lumen h1,
#tpl-lumen h2,
#tpl-lumen h3,
#tpl-lumen .font-display {
    font-family: 'Sora', 'Space Grotesk', system-ui, sans-serif;
}

/* ── Waveform bars ──────────────────────────────────────── */
@keyframes lumen-wave {
    0%, 100% { transform: scaleY(1); }
    50%       { transform: scaleY(0.18); }
}
@keyframes lumen-wave-rev {
    0%, 100% { transform: scaleY(0.22); }
    50%       { transform: scaleY(1); }
}
#tpl-lumen .lumen-waveform .bar {
    display: inline-block;
    width: 3px;
    border-radius: 2px;
    transform-origin: bottom;
    animation: lumen-wave 1.1s ease-in-out infinite;
    will-change: transform;
}
#tpl-lumen .lumen-waveform .bar:nth-child(even) { animation-name: lumen-wave-rev; }
#tpl-lumen .lumen-waveform .bar:nth-child(1)  { animation-delay: 0.055s; }
#tpl-lumen .lumen-waveform .bar:nth-child(2)  { animation-delay: 0.110s; }
#tpl-lumen .lumen-waveform .bar:nth-child(3)  { animation-delay: 0.165s; }
#tpl-lumen .lumen-waveform .bar:nth-child(4)  { animation-delay: 0.220s; }
#tpl-lumen .lumen-waveform .bar:nth-child(5)  { animation-delay: 0.275s; }
#tpl-lumen .lumen-waveform .bar:nth-child(6)  { animation-delay: 0.330s; }
#tpl-lumen .lumen-waveform .bar:nth-child(7)  { animation-delay: 0.385s; }
#tpl-lumen .lumen-waveform .bar:nth-child(8)  { animation-delay: 0.440s; }
#tpl-lumen .lumen-waveform .bar:nth-child(9)  { animation-delay: 0.495s; }
#tpl-lumen .lumen-waveform .bar:nth-child(10) { animation-delay: 0.550s; }
#tpl-lumen .lumen-waveform .bar:nth-child(11) { animation-delay: 0.605s; }
#tpl-lumen .lumen-waveform .bar:nth-child(12) { animation-delay: 0.660s; }
#tpl-lumen .lumen-waveform .bar:nth-child(13) { animation-delay: 0.715s; }
#tpl-lumen .lumen-waveform .bar:nth-child(14) { animation-delay: 0.770s; }
#tpl-lumen .lumen-waveform .bar:nth-child(15) { animation-delay: 0.825s; }
#tpl-lumen .lumen-waveform .bar:nth-child(16) { animation-delay: 0.880s; }
#tpl-lumen .lumen-waveform .bar:nth-child(17) { animation-delay: 0.935s; }
#tpl-lumen .lumen-waveform .bar:nth-child(18) { animation-delay: 0.990s; }
#tpl-lumen .lumen-waveform .bar:nth-child(19) { animation-delay: 1.045s; }
#tpl-lumen .lumen-waveform .bar:nth-child(20) { animation-delay: 1.100s; }
#tpl-lumen .lumen-waveform .bar:nth-child(21) { animation-delay: 1.155s; }
#tpl-lumen .lumen-waveform .bar:nth-child(22) { animation-delay: 1.210s; }
#tpl-lumen .lumen-waveform .bar:nth-child(23) { animation-delay: 1.265s; }
#tpl-lumen .lumen-waveform .bar:nth-child(24) { animation-delay: 1.320s; }

/* ── Gradient blobs ─────────────────────────────────────── */
@keyframes lumen-blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    33%       { transform: translate(40px, -30px) scale(1.08); }
    66%       { transform: translate(-25px, 20px) scale(0.95); }
}
#tpl-lumen .lumen-blob {
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.22;
    animation: lumen-blob 14s ease-in-out infinite;
    will-change: transform;
    pointer-events: none;
}
#tpl-lumen .lumen-blob-2 { animation-delay: -5s; }
#tpl-lumen .lumen-blob-3 { animation-delay: -9s; }

/* ── Neon glow on play buttons ──────────────────────────── */
#tpl-lumen .lumen-play-btn {
    box-shadow: 0 0 18px 4px rgba(255, 94, 91, 0.45);
    transition: box-shadow 0.25s ease, transform 0.15s ease;
}
#tpl-lumen .lumen-play-btn:hover {
    box-shadow: 0 0 32px 8px rgba(255, 94, 91, 0.7);
    transform: scale(1.06);
}

/* ── Duotone episode artwork overlay ───────────────────── */
#tpl-lumen .lumen-duotone {
    position: relative;
    overflow: hidden;
}
#tpl-lumen .lumen-duotone::after {
    content: '';
    position: absolute;
    inset: 0;
    mix-blend-mode: color;
    transition: opacity 0.25s ease;
}
#tpl-lumen .lumen-duotone-coral::after  { background: var(--coral);  opacity: 0.5; }
#tpl-lumen .lumen-duotone-amber::after  { background: var(--amber);  opacity: 0.45; }
#tpl-lumen .lumen-duotone-teal::after   { background: var(--teal);   opacity: 0.45; }
#tpl-lumen .lumen-duotone-purple::after { background: var(--purple); opacity: 0.45; }
#tpl-lumen .lumen-duotone:hover::after  { opacity: 0.2; }

/* ── Mini-player sticky bar ─────────────────────────────── */
#tpl-lumen .lumen-mini-player {
    background: rgba(14, 11, 22, 0.92);
    backdrop-filter: blur(20px);
    -webkit-backdrop-filter: blur(20px);
    border-top: 1px solid rgba(108, 92, 231, 0.3);
}

/* ── Teal glow on active tabs / badges ──────────────────── */
#tpl-lumen .lumen-glow-teal {
    box-shadow: 0 0 16px 3px rgba(0, 206, 203, 0.35);
}

/* ── Card hover lift ─────────────────────────────────────── */
#tpl-lumen .lumen-card {
    background: var(--ink2);
    border: 1px solid rgba(255,255,255,0.07);
    transition: transform 0.2s ease, border-color 0.2s ease;
}
#tpl-lumen .lumen-card:hover {
    transform: translateY(-3px);
    border-color: rgba(108, 92, 231, 0.35);
}

/* ── Section dividers ───────────────────────────────────── */
#tpl-lumen .lumen-sep {
    background: linear-gradient(90deg, transparent, rgba(108, 92, 231, 0.4), transparent);
    height: 1px;
    border: none;
}

/* ── Scrollbar tint ─────────────────────────────────────── */
#tpl-lumen ::-webkit-scrollbar { width: 6px; }
#tpl-lumen ::-webkit-scrollbar-track { background: var(--ink2); }
#tpl-lumen ::-webkit-scrollbar-thumb { background: var(--purple); border-radius: 3px; }

/* ── Reduced-motion overrides ───────────────────────────── */
@media (prefers-reduced-motion: reduce) {
    #tpl-lumen .lumen-waveform .bar,
    #tpl-lumen .lumen-blob,
    #tpl-lumen .lumen-blob-2,
    #tpl-lumen .lumen-blob-3 {
        animation: none !important;
    }
    #tpl-lumen .lumen-play-btn:hover { transform: none; }
}
</style>

<div id="tpl-lumen" class="relative min-h-screen pb-24">

    {{-- ░░ STICKY NAV ░░ ─────────────────────────────────────── --}}
    <header class="sticky top-0 z-40" style="background: rgba(14,11,22,0.88); backdrop-filter: blur(18px); border-bottom: 1px solid rgba(255,255,255,0.06);">
        <div class="mx-auto flex h-16 max-w-7xl items-center gap-4 px-6">
            {{-- Logo --}}
            <a href="#" class="flex items-center gap-2.5 font-display font-bold text-lg tracking-tight" style="color: var(--offwhite);">
                <span class="flex size-8 items-center justify-center rounded-lg" style="background: var(--coral);">
                    <x-lucide-radio class="size-4" style="color: #fff;" />
                </span>
                Lumen
            </a>

            <nav class="ml-6 hidden items-center gap-1 text-sm md:flex">
                @foreach ($nav as $label => $href)
                    <a href="{{ $href }}" class="rounded-md px-3 py-1.5 font-medium transition-colors hover:text-white" style="color: var(--muted);">{{ $label }}</a>
                @endforeach
            </nav>

            <div class="ml-auto flex items-center gap-2">
                <x-ui.button href="#" variant="ghost" size="sm" class="hidden sm:inline-flex" style="color: var(--muted);">Sign in</x-ui.button>
                <x-ui.button href="#pricing" size="sm" class="hidden sm:inline-flex lumen-play-btn" style="background: var(--coral); color: #fff; border: none;">
                    Start free <x-lucide-arrow-right class="size-4" />
                </x-ui.button>
            </div>
        </div>
    </header>

    {{-- ░░ HERO ░░ ──────────────────────────────────────────────── --}}
    <section class="relative overflow-hidden py-24 lg:py-32">
        {{-- Blobs --}}
        <div class="lumen-blob absolute top-[-6rem] left-[-8rem] w-[32rem] h-[32rem]" style="background: var(--purple);"></div>
        <div class="lumen-blob lumen-blob-2 absolute top-[4rem] right-[-6rem] w-[28rem] h-[28rem]" style="background: var(--coral);"></div>
        <div class="lumen-blob lumen-blob-3 absolute bottom-[-4rem] left-[35%] w-[24rem] h-[24rem]" style="background: var(--teal);"></div>

        <div class="relative mx-auto max-w-7xl px-6">
            <div class="mx-auto max-w-4xl text-center">
                {{-- Eyebrow --}}
                <div class="mb-6 inline-flex items-center gap-2 rounded-full px-4 py-1.5 text-xs font-semibold" style="background: rgba(108,92,231,0.18); border: 1px solid rgba(108,92,231,0.4); color: var(--teal);">
                    <x-lucide-zap class="size-3.5" />
                    82 shows · 10,000+ episodes · Hi-fi audio
                </div>

                <h1 class="font-display text-5xl font-extrabold tracking-tight text-balance sm:text-6xl lg:text-7xl" style="color: var(--offwhite);">
                    Listen
                    <span style="background: linear-gradient(135deg, var(--coral), var(--amber)); -webkit-background-clip: text; -webkit-text-fill-color: transparent; background-clip: text;">louder.</span>
                    <br />Feel everything.
                </h1>

                <p class="mt-6 mx-auto max-w-2xl text-lg text-balance leading-relaxed" style="color: var(--muted);">
                    Lumen is where the world's sharpest podcasters meet the most devoted listeners — in stunning hi-fi audio, ad-free.
                </p>

                {{-- CTA row --}}
                <div class="mt-10 flex flex-wrap items-center justify-center gap-4">
                    <button type="button" class="lumen-play-btn inline-flex items-center gap-3 rounded-full px-8 py-4 text-base font-bold" style="background: var(--coral); color: #fff;">
                        <span class="flex size-8 items-center justify-center rounded-full" style="background: rgba(255,255,255,0.2);">
                            <x-lucide-play class="size-4 fill-current" />
                        </span>
                        Play featured show
                    </button>
                    <x-ui.button href="#pricing" size="lg" variant="outline" style="border-color: rgba(255,255,255,0.15); color: var(--offwhite); background: rgba(255,255,255,0.04);">
                        Explore plans
                    </x-ui.button>
                </div>

                {{-- Listen-on badges --}}
                <div class="mt-8 flex flex-wrap items-center justify-center gap-3">
                    <span class="text-xs font-medium" style="color: var(--muted);">Also on</span>
                    @foreach ($listenOn as $p)
                        <x-ui.tooltip>
                            <x-ui.tooltip-trigger>
                                <span class="inline-flex items-center gap-1.5 rounded-full px-3 py-1 text-xs font-medium cursor-default transition-colors hover:text-white"
                                      style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); color: var(--muted);">
                                    <x-dynamic-component :component="'lucide-'.$p['icon']" class="size-3" />
                                    {{ $p['label'] }}
                                </span>
                            </x-ui.tooltip-trigger>
                            <x-ui.tooltip-content>Listen on {{ $p['label'] }}</x-ui.tooltip-content>
                        </x-ui.tooltip>
                    @endforeach
                </div>

                {{-- Animated waveform hero motif --}}
                <div class="mt-14 flex items-end justify-center gap-[3px] h-20" aria-hidden="true">
                    @php $colors = ['var(--coral)', 'var(--amber)', 'var(--teal)', 'var(--purple)']; @endphp
                    <div class="lumen-waveform flex items-end gap-[3px]">
                        @foreach ($waveHeights as $idx => $h)
                            <span class="bar" style="height: {{ $h }}px; background: {{ $colors[$idx % 4] }};"></span>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ░░ MARQUEE — Show titles ░░ ──────────────────────────────── --}}
    <div class="py-3 lumen-sep mb-0"></div>
    <div class="py-4" style="background: var(--ink2);">
        <x-ui.marquee fade :duration="'35s'" class="mx-auto max-w-full">
            @foreach ($marqueeShows as $show)
                <span class="mx-6 text-sm font-semibold whitespace-nowrap flex items-center gap-2" style="color: var(--muted);">
                    <x-lucide-mic class="size-3.5" style="color: var(--coral);" />
                    {{ $show }}
                </span>
            @endforeach
        </x-ui.marquee>
    </div>
    <div class="lumen-sep"></div>

    {{-- ░░ FEATURED EPISODES CAROUSEL ░░ ─────────────────────────── --}}
    <section id="episodes" class="scroll-mt-20 py-20">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-10 flex items-end justify-between">
                <div>
                    <div class="mb-2 inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold" style="background: rgba(255,94,91,0.15); color: var(--coral); border: 1px solid rgba(255,94,91,0.3);">
                        <x-lucide-flame class="size-3.5" /> Featured
                    </div>
                    <h2 class="font-display text-3xl font-bold sm:text-4xl" style="color: var(--offwhite);">This week's best</h2>
                </div>
                <a href="#" class="hidden text-sm font-medium sm:inline-flex items-center gap-1 transition-colors hover:text-white" style="color: var(--teal);">
                    Browse all <x-lucide-arrow-right class="size-4" />
                </a>
            </div>

            <x-ui.carousel class="w-full">
                <x-ui.carousel-content>
                    @foreach ($episodes as $idx => $ep)
                        @php $duotones = ['lumen-duotone-coral','lumen-duotone-amber','lumen-duotone-teal','lumen-duotone-purple','lumen-duotone-coral']; @endphp
                        <x-ui.carousel-item class="basis-full sm:basis-1/2 lg:basis-1/3">
                            <div class="lumen-card rounded-2xl overflow-hidden h-full">
                                {{-- Artwork --}}
                                <div class="lumen-duotone {{ $duotones[$idx] }} h-48 relative">
                                    <img src="{{ $ep['img'] }}" alt="{{ $ep['title'] }}" loading="lazy" class="w-full h-full object-cover" />
                                    <div class="absolute top-3 left-3">
                                        <span class="rounded-full px-2.5 py-0.5 text-[11px] font-bold" style="background: rgba(14,11,22,0.75); color: var(--offwhite);">{{ $ep['num'] }}</span>
                                    </div>
                                    <div class="absolute top-3 right-3">
                                        <x-ui.badge tone="neutral" variant="soft" class="text-[11px]">{{ $ep['tag'] }}</x-ui.badge>
                                    </div>
                                </div>
                                {{-- Info --}}
                                <div class="p-5">
                                    <p class="text-xs font-semibold uppercase tracking-widest mb-1" style="color: var(--teal);">{{ $ep['show'] }}</p>
                                    <h3 class="font-display font-bold text-base leading-snug mb-3 line-clamp-2" style="color: var(--offwhite);">{{ $ep['title'] }}</h3>
                                    <div class="flex items-center justify-between">
                                        <div class="flex items-center gap-3 text-xs" style="color: var(--muted);">
                                            <span class="flex items-center gap-1"><x-lucide-clock class="size-3" /> {{ $ep['duration'] }}</span>
                                            <span class="flex items-center gap-1"><x-lucide-headphones class="size-3" /> {{ $ep['plays'] }}</span>
                                            <span>{{ $ep['date'] }}</span>
                                        </div>
                                        <button type="button" aria-label="Play {{ $ep['title'] }}"
                                                class="lumen-play-btn flex size-9 items-center justify-center rounded-full shrink-0"
                                                style="background: var(--coral); color: #fff;">
                                            <x-lucide-play class="size-4 fill-current" />
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </x-ui.carousel-item>
                    @endforeach
                </x-ui.carousel-content>
                <x-ui.carousel-previous style="background: var(--ink2); border-color: rgba(255,255,255,0.12); color: var(--offwhite);" />
                <x-ui.carousel-next style="background: var(--ink2); border-color: rgba(255,255,255,0.12); color: var(--offwhite);" />
            </x-ui.carousel>
        </div>
    </section>

    <div class="lumen-sep mx-6"></div>

    {{-- ░░ PLAYER WIDGET ░░ ───────────────────────────────────────── --}}
    @php $playerProgress = 38; @endphp
    <section class="py-20" x-data="{ playing: false, speed: 1, progress: {{ $playerProgress }} }">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-10 text-center">
                <div class="mb-2 inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold" style="background: rgba(0,206,203,0.12); color: var(--teal); border: 1px solid rgba(0,206,203,0.3);">
                    <x-lucide-play-circle class="size-3.5" /> Now Playing
                </div>
                <h2 class="font-display text-3xl font-bold sm:text-4xl" style="color: var(--offwhite);">The Lumen Player</h2>
            </div>

            <div class="mx-auto max-w-3xl rounded-2xl p-6 sm:p-8" style="background: var(--ink2); border: 1px solid rgba(108,92,231,0.25);">
                {{-- Episode row --}}
                <div class="flex items-center gap-5 mb-6">
                    <div class="lumen-duotone lumen-duotone-purple size-20 rounded-xl shrink-0 overflow-hidden">
                        <img src="https://picsum.photos/seed/player1/200/200" alt="The Art of Deep Focus" class="size-full object-cover" />
                    </div>
                    <div class="min-w-0">
                        <p class="text-xs font-semibold uppercase tracking-widest mb-0.5" style="color: var(--purple);">Mind & Flow</p>
                        <h3 class="font-display font-bold text-lg truncate" style="color: var(--offwhite);">The Art of Deep Focus</h3>
                        <div class="flex items-center gap-3 mt-1">
                            {{-- Host avatars --}}
                            <div class="flex -space-x-2">
                                @foreach (['cr1', 'cr2'] as $s)
                                    <x-ui.avatar class="ring-2 size-6" style="--tw-ring-color: var(--ink2);">
                                        <x-ui.avatar-image src="https://picsum.photos/seed/{{ $s }}/60/60" alt="Host" />
                                        <x-ui.avatar-fallback style="background: var(--purple); color: #fff; font-size: 10px;">H</x-ui.avatar-fallback>
                                    </x-ui.avatar>
                                @endforeach
                            </div>
                            <span class="text-xs" style="color: var(--muted);">Dr. Aria Senn · 58 min</span>
                        </div>
                    </div>
                    <div class="ml-auto flex items-center gap-2">
                        <x-ui.tooltip>
                            <x-ui.tooltip-trigger>
                                <button type="button" aria-label="Add to queue" class="flex size-8 items-center justify-center rounded-full transition-colors hover:text-white" style="color: var(--muted);">
                                    <x-lucide-list-plus class="size-4" />
                                </button>
                            </x-ui.tooltip-trigger>
                            <x-ui.tooltip-content>Add to queue</x-ui.tooltip-content>
                        </x-ui.tooltip>
                        <x-ui.tooltip>
                            <x-ui.tooltip-trigger>
                                <button type="button" aria-label="Share episode" class="flex size-8 items-center justify-center rounded-full transition-colors hover:text-white" style="color: var(--muted);">
                                    <x-lucide-share-2 class="size-4" />
                                </button>
                            </x-ui.tooltip-trigger>
                            <x-ui.tooltip-content>Share episode</x-ui.tooltip-content>
                        </x-ui.tooltip>
                    </div>
                </div>

                {{-- Waveform seek visual --}}
                <div class="flex items-end gap-[2px] h-10 mb-3 cursor-pointer" aria-hidden="true">
                    @foreach ($waveHeights as $idx => $h)
                        @php $played = ($idx / count($waveHeights)) * 100 < $playerProgress; @endphp
                        <div class="flex-1 rounded-sm transition-all duration-300"
                             style="height: {{ max(4, $h * 0.42) }}px; background: {{ $played ? 'var(--coral)' : 'rgba(255,255,255,0.12)' }};"></div>
                    @endforeach
                </div>

                {{-- Seek slider --}}
                <x-ui.slider :value="38" :min="0" :max="100" aria-label="Playback position" class="mb-2" style="--tw-ring-color: var(--coral);" />
                <div class="flex justify-between text-xs mb-5" style="color: var(--muted);">
                    <span>22:14</span>
                    <span>58:02</span>
                </div>

                {{-- Controls --}}
                <div class="flex items-center justify-center gap-3 mb-5">
                    <x-ui.tooltip>
                        <x-ui.tooltip-trigger>
                            <button type="button" aria-label="Shuffle" class="flex size-9 items-center justify-center rounded-full transition-colors hover:text-white" style="color: var(--muted);">
                                <x-lucide-shuffle class="size-4" />
                            </button>
                        </x-ui.tooltip-trigger>
                        <x-ui.tooltip-content>Shuffle</x-ui.tooltip-content>
                    </x-ui.tooltip>

                    <button type="button" aria-label="Skip back 15s" class="flex size-9 items-center justify-center rounded-full transition-colors hover:text-white" style="color: var(--muted);">
                        <x-lucide-skip-back class="size-5" />
                    </button>

                    <button type="button" aria-label="Play / Pause"
                            class="lumen-play-btn flex size-14 items-center justify-center rounded-full"
                            style="background: var(--coral); color: #fff;"
                            @click="playing = !playing">
                        <x-lucide-play class="size-6 fill-current" x-show="!playing" />
                        <x-lucide-pause class="size-6 fill-current" x-show="playing" x-cloak />
                    </button>

                    <button type="button" aria-label="Skip forward 15s" class="flex size-9 items-center justify-center rounded-full transition-colors hover:text-white" style="color: var(--muted);">
                        <x-lucide-skip-forward class="size-5" />
                    </button>

                    {{-- Speed badge toggle --}}
                    <x-ui.tooltip>
                        <x-ui.tooltip-trigger>
                            <button type="button"
                                    aria-label="Playback speed"
                                    @click="speed = speed >= 2 ? 0.5 : speed + 0.5"
                                    class="inline-flex items-center rounded-full px-2.5 py-1 text-xs font-bold transition-colors"
                                    style="background: rgba(255,182,39,0.15); color: var(--amber); border: 1px solid rgba(255,182,39,0.3);">
                                <span x-text="speed + 'x'">1x</span>
                            </button>
                        </x-ui.tooltip-trigger>
                        <x-ui.tooltip-content>Playback speed</x-ui.tooltip-content>
                    </x-ui.tooltip>
                </div>

                {{-- Progress bar --}}
                <x-ui.progress :value="38" aria-label="Episode progress" class="h-1" style="background: rgba(255,94,91,0.15);" />
            </div>
        </div>
    </section>

    <div class="lumen-sep mx-6"></div>

    {{-- ░░ TOP SHOWS GRID ░░ ─────────────────────────────────────── --}}
    <section id="shows" class="scroll-mt-20 py-20">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-10 text-center">
                <div class="mb-2 inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold" style="background: rgba(108,92,231,0.15); color: var(--purple); border: 1px solid rgba(108,92,231,0.3);">
                    <x-lucide-star class="size-3.5" /> Top Shows
                </div>
                <h2 class="font-display text-3xl font-bold sm:text-4xl" style="color: var(--offwhite);">Handpicked for you</h2>
                <p class="mt-2 text-base max-w-xl mx-auto" style="color: var(--muted);">Every show is vetted, every creator audited for quality. No filler, no fluff.</p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($shows as $idx => $show)
                    @php $duotones2 = ['lumen-duotone-coral','lumen-duotone-purple','lumen-duotone-teal','lumen-duotone-amber','lumen-duotone-coral','lumen-duotone-purple']; @endphp
                    <x-ui.hover-card>
                        <x-ui.hover-card-trigger>
                            <div class="lumen-card rounded-2xl overflow-hidden cursor-pointer">
                                <div class="lumen-duotone {{ $duotones2[$idx] }} h-40 relative">
                                    <img src="{{ $show['img'] }}" alt="{{ $show['title'] }}" loading="lazy" class="w-full h-full object-cover" />
                                    <div class="absolute inset-0 flex items-end p-4"
                                         style="background: linear-gradient(to top, rgba(14,11,22,0.85), transparent);">
                                        <div>
                                            <h3 class="font-display font-bold text-base" style="color: var(--offwhite);">{{ $show['title'] }}</h3>
                                            <p class="text-xs" style="color: var(--muted);">{{ $show['host'] }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="p-4 flex items-center justify-between">
                                    <div class="flex items-center gap-2">
                                        <x-ui.rating :value="$show['rating']" :max="5" :readonly="true" size="sm" color="text-amber-400" />
                                        <span class="text-xs font-semibold" style="color: var(--amber);">{{ $show['rating'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-2 text-xs" style="color: var(--muted);">
                                        <x-lucide-mic class="size-3" />
                                        <span>{{ $show['eps'] }} episodes</span>
                                        <x-ui.badge tone="neutral" variant="soft" class="text-[10px]">{{ $show['category'] }}</x-ui.badge>
                                    </div>
                                </div>
                            </div>
                        </x-ui.hover-card-trigger>
                        <x-ui.hover-card-content side="top" class="w-72" style="background: var(--ink2); border-color: rgba(108,92,231,0.3); color: var(--offwhite);">
                            <div class="flex items-start gap-3">
                                <x-ui.avatar class="size-12 shrink-0">
                                    <x-ui.avatar-image src="{{ $show['img'] }}" alt="{{ $show['host'] }}" />
                                    <x-ui.avatar-fallback style="background: var(--purple); color: #fff;">{{ substr($show['host'], 0, 1) }}</x-ui.avatar-fallback>
                                </x-ui.avatar>
                                <div>
                                    <p class="font-display font-semibold text-sm" style="color: var(--offwhite);">{{ $show['host'] }}</p>
                                    <p class="text-xs leading-relaxed mt-1" style="color: var(--muted);">{{ $show['bio'] }}</p>
                                </div>
                            </div>
                        </x-ui.hover-card-content>
                    </x-ui.hover-card>
                @endforeach
            </div>
        </div>
    </section>

    <div class="lumen-sep mx-6"></div>

    {{-- ░░ CATEGORIES TABS ░░ ──────────────────────────────────────── --}}
    <section id="categories" class="scroll-mt-20 py-20">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-10 text-center">
                <div class="mb-2 inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold" style="background: rgba(0,206,203,0.12); color: var(--teal); border: 1px solid rgba(0,206,203,0.3);">
                    <x-lucide-grid-3x3 class="size-3.5" /> Explore
                </div>
                <h2 class="font-display text-3xl font-bold sm:text-4xl" style="color: var(--offwhite);">Browse categories</h2>
            </div>

            <x-ui.tabs value="trending" class="w-full">
                <x-ui.tabs-list variant="pills" class="mb-8 flex-wrap justify-center" style="background: transparent;">
                    @foreach ($categories as $key => $cat)
                        <x-ui.tabs-trigger value="{{ $key }}"
                            style="border-radius: 9999px;"
                            class="data-[state=active]:!text-black data-[state=active]:font-bold data-[state=inactive]:text-[color:var(--muted)]">
                            {{ $cat['label'] }}
                        </x-ui.tabs-trigger>
                    @endforeach
                </x-ui.tabs-list>

                @foreach ($categories as $key => $cat)
                    <x-ui.tabs-content value="{{ $key }}">
                        <div class="grid grid-cols-2 gap-3 sm:grid-cols-3 lg:grid-cols-6">
                            @foreach ($cat['items'] as $idx => $title)
                                @php $catColors = ['var(--coral)', 'var(--teal)', 'var(--amber)', 'var(--purple)', 'var(--coral)', 'var(--teal)']; @endphp
                                <div class="lumen-card rounded-xl p-4 flex flex-col items-center gap-2 text-center cursor-pointer">
                                    <span class="flex size-10 items-center justify-center rounded-full" style="background: {{ $catColors[$idx % 6] }}22;">
                                        <x-lucide-mic class="size-5" style="color: {{ $catColors[$idx % 6] }};" />
                                    </span>
                                    <span class="text-sm font-semibold leading-tight" style="color: var(--offwhite);">{{ $title }}</span>
                                </div>
                            @endforeach
                        </div>
                    </x-ui.tabs-content>
                @endforeach
            </x-ui.tabs>
        </div>
    </section>

    <div class="lumen-sep mx-6"></div>

    {{-- ░░ CREATORS ░░ ──────────────────────────────────────────────── --}}
    <section id="creators" class="scroll-mt-20 py-20">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-10 text-center">
                <div class="mb-2 inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold" style="background: rgba(255,182,39,0.12); color: var(--amber); border: 1px solid rgba(255,182,39,0.3);">
                    <x-lucide-users class="size-3.5" /> Creators
                </div>
                <h2 class="font-display text-3xl font-bold sm:text-4xl" style="color: var(--offwhite);">Meet the voices</h2>
                <p class="mt-2 text-base max-w-xl mx-auto" style="color: var(--muted);">Follow your favourites and never miss an episode.</p>
            </div>

            <div class="grid grid-cols-2 gap-5 sm:grid-cols-4 lg:grid-cols-8">
                @foreach ($creators as $idx => $cr)
                    @php $ringColors = ['var(--coral)', 'var(--teal)', 'var(--amber)', 'var(--purple)', 'var(--coral)', 'var(--teal)', 'var(--amber)', 'var(--purple)']; @endphp
                    <div class="flex flex-col items-center gap-2 text-center group">
                        <x-ui.avatar class="size-16 ring-2 ring-offset-2 transition-transform group-hover:scale-105"
                                     style="--tw-ring-color: {{ $ringColors[$idx] }}; --tw-ring-offset-color: var(--ink);">
                            <x-ui.avatar-image src="{{ $cr['img'] }}" alt="{{ $cr['name'] }}" />
                            <x-ui.avatar-fallback style="background: var(--purple); color: #fff;">{{ substr($cr['name'], 0, 1) }}</x-ui.avatar-fallback>
                        </x-ui.avatar>
                        <div>
                            <p class="text-xs font-semibold leading-tight" style="color: var(--offwhite);">{{ $cr['name'] }}</p>
                            <p class="text-[10px]" style="color: var(--muted);">{{ $cr['followers'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="lumen-sep mx-6"></div>

    {{-- ░░ SUBSCRIBE TIERS ░░ ──────────────────────────────────────── --}}
    <section id="pricing" class="scroll-mt-20 py-20" x-data="{ yearly: false }">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-10 text-center">
                <div class="mb-2 inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold" style="background: rgba(108,92,231,0.15); color: var(--purple); border: 1px solid rgba(108,92,231,0.3);">
                    <x-lucide-sparkles class="size-3.5" /> Pricing
                </div>
                <h2 class="font-display text-3xl font-bold sm:text-4xl" style="color: var(--offwhite);">Listen your way</h2>
                <p class="mt-2 text-base" style="color: var(--muted);">Start free. Upgrade when your ears demand more.</p>

                {{-- Monthly / Annual toggle --}}
                <div class="mt-6 inline-flex items-center gap-2 rounded-full p-1 text-sm" style="background: var(--ink2); border: 1px solid rgba(255,255,255,0.1);">
                    <button type="button" @click="yearly = false"
                            :class="!yearly ? 'text-white' : ''"
                            class="rounded-full px-4 py-1.5 font-medium transition-all"
                            :style="!yearly ? 'background: var(--coral);' : 'color: var(--muted);'">
                        Monthly
                    </button>
                    <button type="button" @click="yearly = true"
                            class="inline-flex items-center gap-1.5 rounded-full px-4 py-1.5 font-medium transition-all"
                            :style="yearly ? 'background: var(--coral); color: #fff;' : 'color: var(--muted);'">
                        Annual
                        <x-ui.badge tone="success" variant="soft" class="text-[10px]">Save 22%</x-ui.badge>
                    </button>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-3 items-stretch">
                @foreach ($plans as $plan)
                    <div class="lumen-card rounded-2xl p-6 flex flex-col relative overflow-hidden"
                         @if ($plan['highlight']) style="background: var(--ink2); border-color: var(--purple); box-shadow: 0 0 32px rgba(108,92,231,0.2);" @endif>
                        @if ($plan['highlight'])
                            <div class="absolute top-0 inset-x-0 h-0.5 rounded-t-2xl" style="background: linear-gradient(90deg, var(--coral), var(--purple), var(--teal));"></div>
                            <div class="absolute -top-3 left-1/2 -translate-x-1/2">
                                <span class="rounded-full px-3 py-0.5 text-xs font-bold" style="background: var(--purple); color: #fff;">Most popular</span>
                            </div>
                        @endif

                        <h3 class="font-display font-bold text-xl mb-0.5" style="color: var(--offwhite);">{{ $plan['name'] }}</h3>
                        <p class="text-sm mb-4" style="color: var(--muted);">{{ $plan['desc'] }}</p>

                        <div class="flex items-baseline gap-1 mb-6">
                            <span class="font-display text-4xl font-extrabold" style="color: var(--offwhite);">
                                $<span x-text="yearly ? {{ $plan['y'] }} : {{ $plan['m'] }}">{{ $plan['m'] }}</span>
                            </span>
                            <span class="text-sm" style="color: var(--muted);">/mo</span>
                        </div>

                        <button type="button" class="w-full mb-6 rounded-xl py-2.5 text-sm font-bold transition-all"
                                style="{{ $plan['highlight'] ? 'background: var(--coral); color: #fff;' : 'background: rgba(255,255,255,0.06); color: var(--offwhite); border: 1px solid rgba(255,255,255,0.12);' }}">
                            {{ $plan['cta'] }}
                        </button>

                        <x-ui.separator class="mb-5" style="background: rgba(255,255,255,0.07);" />

                        <ul class="space-y-3 text-sm mt-auto">
                            @foreach ($plan['features'] as $feat)
                                <li class="flex items-start gap-2.5" style="color: var(--offwhite);">
                                    <x-lucide-check class="size-4 shrink-0 mt-0.5" style="color: var(--teal);" />
                                    {{ $feat }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="lumen-sep mx-6"></div>

    {{-- ░░ TESTIMONIALS ░░ ─────────────────────────────────────────── --}}
    <section class="py-20">
        <div class="mx-auto max-w-7xl px-6">
            <div class="mb-10 text-center">
                <h2 class="font-display text-3xl font-bold sm:text-4xl" style="color: var(--offwhite);">Listeners love Lumen</h2>
            </div>
            <div class="grid gap-5 lg:grid-cols-3">
                @foreach ($testimonials as $idx => $t)
                    @php $tColors = ['var(--coral)', 'var(--teal)', 'var(--amber)']; @endphp
                    <div class="lumen-card rounded-2xl p-6 flex flex-col gap-4">
                        <div class="flex">
                            @for ($i = 0; $i < 5; $i++)
                                <x-lucide-star class="size-4 fill-current" style="color: var(--amber);" />
                            @endfor
                        </div>
                        <p class="text-sm leading-relaxed" style="color: var(--offwhite);">"{{ $t['q'] }}"</p>
                        <div class="flex items-center gap-3 mt-auto pt-3" style="border-top: 1px solid rgba(255,255,255,0.07);">
                            <x-ui.avatar class="size-10 ring-2" style="--tw-ring-color: {{ $tColors[$idx] }};">
                                <x-ui.avatar-image src="{{ $t['img'] }}" alt="{{ $t['a'] }}" />
                                <x-ui.avatar-fallback style="background: var(--purple); color: #fff;">{{ substr($t['a'], 0, 1) }}</x-ui.avatar-fallback>
                            </x-ui.avatar>
                            <div>
                                <p class="text-sm font-semibold" style="color: var(--offwhite);">{{ $t['a'] }}</p>
                                <p class="text-xs" style="color: var(--muted);">{{ $t['r'] }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <div class="lumen-sep mx-6"></div>

    {{-- ░░ FAQ ACCORDION ░░ ────────────────────────────────────────── --}}
    <section class="py-20">
        <div class="mx-auto max-w-3xl px-6">
            <div class="mb-10 text-center">
                <div class="mb-2 inline-flex items-center gap-2 rounded-full px-3 py-1 text-xs font-semibold" style="background: rgba(255,94,91,0.12); color: var(--coral); border: 1px solid rgba(255,94,91,0.3);">
                    <x-lucide-help-circle class="size-3.5" /> FAQ
                </div>
                <h2 class="font-display text-3xl font-bold sm:text-4xl" style="color: var(--offwhite);">Your questions, answered</h2>
            </div>

            <x-ui.accordion type="single" collapsible class="w-full" style="border-color: rgba(255,255,255,0.07);">
                @foreach ($faqs as $i => $faq)
                    <x-ui.accordion-item value="faq-{{ $i }}" style="border-color: rgba(255,255,255,0.07);">
                        <x-ui.accordion-trigger class="hover:no-underline" style="color: var(--offwhite);">{{ $faq['q'] }}</x-ui.accordion-trigger>
                        <x-ui.accordion-content style="color: var(--muted);">{{ $faq['a'] }}</x-ui.accordion-content>
                    </x-ui.accordion-item>
                @endforeach
            </x-ui.accordion>
        </div>
    </section>

    <div class="lumen-sep mx-6"></div>

    {{-- ░░ NEWSLETTER ░░ ───────────────────────────────────────────── --}}
    <section class="py-20">
        <div class="mx-auto max-w-7xl px-6">
            <div class="relative rounded-3xl overflow-hidden px-8 py-14 text-center" style="background: linear-gradient(135deg, rgba(108,92,231,0.35) 0%, rgba(255,94,91,0.2) 50%, rgba(0,206,203,0.2) 100%); border: 1px solid rgba(108,92,231,0.3);">
                {{-- Background blob --}}
                <div class="lumen-blob absolute top-[-4rem] right-[-4rem] w-64 h-64" style="background: var(--coral); opacity: 0.3;"></div>
                <div class="lumen-blob lumen-blob-2 absolute bottom-[-3rem] left-[-3rem] w-56 h-56" style="background: var(--teal); opacity: 0.25;"></div>

                <div class="relative">
                    <h2 class="font-display text-3xl font-bold sm:text-4xl mb-3" style="color: var(--offwhite);">Never miss a great episode</h2>
                    <p class="text-base mb-8 max-w-md mx-auto" style="color: var(--muted);">Weekly curator picks, new show launches, and exclusive creator interviews — straight to your inbox.</p>

                    <form class="flex flex-col sm:flex-row gap-3 max-w-md mx-auto" @submit.prevent>
                        <x-ui.input type="email" placeholder="your@email.com" aria-label="Email address" class="flex-1"
                                    style="background: rgba(14,11,22,0.6); border-color: rgba(255,255,255,0.15); color: var(--offwhite);" />
                        <button type="submit" class="lumen-play-btn rounded-xl px-6 py-2.5 text-sm font-bold whitespace-nowrap" style="background: var(--coral); color: #fff;">
                            Subscribe free
                        </button>
                    </form>
                    <p class="mt-3 text-xs" style="color: var(--muted);">No spam. Unsubscribe anytime.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ░░ FOOTER ░░ ───────────────────────────────────────────────── --}}
    <footer class="py-14" style="border-top: 1px solid rgba(255,255,255,0.07);">
        <div class="mx-auto max-w-7xl px-6">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-5 mb-10">
                <div class="lg:col-span-2">
                    <a href="#" class="flex items-center gap-2.5 font-display font-bold text-lg mb-3" style="color: var(--offwhite);">
                        <span class="flex size-8 items-center justify-center rounded-lg" style="background: var(--coral);">
                            <x-lucide-radio class="size-4" style="color: #fff;" />
                        </span>
                        Lumen
                    </a>
                    <p class="text-sm leading-relaxed max-w-xs mb-5" style="color: var(--muted);">The home for bold voices and devoted listeners. Hi-fi audio, zero ads, endless discovery.</p>
                    <div class="flex gap-2">
                        @foreach (['twitter', 'instagram', 'youtube', 'rss'] as $s)
                            <a href="#" aria-label="{{ $s }}" class="flex size-9 items-center justify-center rounded-lg transition-colors hover:text-white"
                               style="background: rgba(255,255,255,0.06); border: 1px solid rgba(255,255,255,0.1); color: var(--muted);">
                                <x-dynamic-component :component="'lucide-'.$s" class="size-4" />
                            </a>
                        @endforeach
                    </div>
                </div>
                @foreach ([
                    'Platform' => ['Browse Shows', 'Top Episodes', 'Categories', 'New Releases', 'Live Events'],
                    'Creators' => ['Start Podcasting', 'Analytics', 'Monetise', 'Distribution', 'Creator Docs'],
                    'Company'  => ['About', 'Careers', 'Blog', 'Press', 'Contact'],
                ] as $heading => $links)
                    <div>
                        <h3 class="text-sm font-semibold mb-3" style="color: var(--offwhite);">{{ $heading }}</h3>
                        <ul class="space-y-2 text-sm">
                            @foreach ($links as $link)
                                <li><a href="#" class="transition-colors hover:text-white" style="color: var(--muted);">{{ $link }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <x-ui.separator style="background: rgba(255,255,255,0.07);" />
            <div class="mt-6 flex flex-col items-center justify-between gap-3 text-xs sm:flex-row" style="color: var(--muted);">
                <span>© {{ date('Y') }} Lumen Audio, Inc. All rights reserved.</span>
                <span class="flex items-center gap-3">
                    <a href="#" class="hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms</a>
                    <a href="#" class="hover:text-white transition-colors">Cookies</a>
                </span>
            </div>
        </div>
    </footer>

    {{-- ░░ STICKY MINI-PLAYER ░░ ───────────────────────────────────── --}}
    <div class="lumen-mini-player fixed bottom-0 inset-x-0 z-50 px-4 py-3"
         x-data="{ playing: false, progress: 38 }">
        <div class="mx-auto max-w-7xl flex items-center gap-4">
            {{-- Artwork --}}
            <div class="lumen-duotone lumen-duotone-purple size-10 rounded-lg shrink-0 overflow-hidden">
                <img src="https://picsum.photos/seed/player1/80/80" alt="Now playing" class="size-full object-cover" />
            </div>

            {{-- Episode info --}}
            <div class="min-w-0 flex-1 hidden sm:block">
                <p class="text-xs font-semibold truncate" style="color: var(--offwhite);">The Art of Deep Focus</p>
                <p class="text-[10px] truncate" style="color: var(--muted);">Mind & Flow · EP 142</p>
            </div>

            {{-- Mini waveform --}}
            <div class="hidden md:flex items-end gap-[2px] h-6 mx-2" aria-hidden="true">
                @foreach ([30, 55, 42, 70, 35, 88, 60, 45, 75, 50] as $h)
                    <div class="w-0.5 rounded-sm" style="height: {{ max(3, $h * 0.25) }}px; background: {{ $h > 50 ? 'var(--coral)' : 'rgba(255,255,255,0.2)' }};"></div>
                @endforeach
            </div>

            {{-- Seek --}}
            <div class="flex-1 max-w-xs hidden lg:block">
                <x-ui.slider :value="38" :min="0" :max="100" aria-label="Mini player position" class="h-1" />
                <div class="flex justify-between text-[10px] mt-0.5" style="color: var(--muted);">
                    <span>22:14</span><span>58:02</span>
                </div>
            </div>

            {{-- Controls --}}
            <div class="flex items-center gap-2 shrink-0">
                <button type="button" aria-label="Previous" class="flex size-7 items-center justify-center rounded-full transition-colors hover:text-white" style="color: var(--muted);">
                    <x-lucide-skip-back class="size-3.5" />
                </button>

                <button type="button" aria-label="Play / Pause"
                        class="lumen-play-btn flex size-9 items-center justify-center rounded-full"
                        style="background: var(--coral); color: #fff;"
                        @click="playing = !playing">
                    <x-lucide-play class="size-4 fill-current" x-show="!playing" />
                    <x-lucide-pause class="size-4 fill-current" x-show="playing" x-cloak />
                </button>

                <button type="button" aria-label="Next" class="flex size-7 items-center justify-center rounded-full transition-colors hover:text-white" style="color: var(--muted);">
                    <x-lucide-skip-forward class="size-3.5" />
                </button>
            </div>

            {{-- Volume --}}
            <div class="hidden xl:flex items-center gap-2 shrink-0">
                <x-lucide-volume-2 class="size-4 shrink-0" style="color: var(--muted);" />
                <div class="w-20">
                    <x-ui.slider :value="80" :min="0" :max="100" aria-label="Volume" />
                </div>
            </div>
        </div>
    </div>

</div>{{-- /#tpl-lumen --}}

</x-layouts.app>
