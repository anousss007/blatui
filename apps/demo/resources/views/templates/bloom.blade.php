@php
    $features = [
        ['icon' => 'flame',       'color' => '#ffb4a2', 'bg' => '#fff0ec', 'title' => 'Smart Workouts',      'desc' => 'AI-curated sessions that adapt to your energy, schedule and fitness level every single day.'],
        ['icon' => 'droplets',    'color' => '#7ee0b0', 'bg' => '#edfaf4', 'title' => 'Hydration Tracking',   'desc' => 'Log water intake with a single tap and let Bloom nudge you when you fall behind your goal.'],
        ['icon' => 'moon',        'color' => '#a8d8ff', 'bg' => '#eaf4ff', 'title' => 'Sleep Insights',       'desc' => 'Understand your rest patterns and get personalized tips to wake up genuinely refreshed.'],
        ['icon' => 'brain',       'color' => '#c9b8ff', 'bg' => '#f2eeff', 'title' => 'Mindfulness & Calm',   'desc' => 'Guided meditations, breathing sessions and gentle check-ins to keep stress in check.'],
        ['icon' => 'salad',       'color' => '#ffd97d', 'bg' => '#fffaeb', 'title' => 'Nutrition Log',        'desc' => 'Scan barcodes or search 1M+ foods. Macros and micros tracked without the spreadsheet chaos.'],
        ['icon' => 'heart-pulse', 'color' => '#ffb4a2', 'bg' => '#fff0ec', 'title' => 'Heart-Rate Zones',     'desc' => 'See exactly how hard you worked — and recover smarter with zone-based training guides.'],
    ];

    $workouts = [
        ['label' => 'Yoga Flow',     'tone' => 'Calm',    'mins' => 20, 'color' => '#c9b8ff', 'img' => 'https://picsum.photos/seed/yoga7/320/200'],
        ['label' => 'HIIT Cardio',   'tone' => 'Intense', 'mins' => 30, 'color' => '#ffb4a2', 'img' => 'https://picsum.photos/seed/hiit3/320/200'],
        ['label' => 'Morning Run',   'tone' => 'Steady',  'mins' => 40, 'color' => '#7ee0b0', 'img' => 'https://picsum.photos/seed/run11/320/200'],
        ['label' => 'Core Strength', 'tone' => 'Power',   'mins' => 25, 'color' => '#a8d8ff', 'img' => 'https://picsum.photos/seed/core5/320/200'],
        ['label' => 'Dance Cardio',  'tone' => 'Fun',     'mins' => 35, 'color' => '#ffd97d', 'img' => 'https://picsum.photos/seed/dance9/320/200'],
        ['label' => 'Pilates',       'tone' => 'Balance', 'mins' => 45, 'color' => '#7ee0b0', 'img' => 'https://picsum.photos/seed/pilates2/320/200'],
    ];

    $testimonials = [
        ['q' => 'Bloom turned my chaotic mornings into something I actually look forward to. The habit streaks are weirdly addictive!', 'a' => 'Mia Torres',    'r' => 'Yoga instructor', 'seed' => 'mia22',  'rating' => 5],
        ['q' => 'I dropped 8 kg in 3 months without ever feeling like I was on a diet. The nutrition log is genuinely effortless.',     'a' => 'James Park',    'r' => 'Software dev',    'seed' => 'james4', 'rating' => 5],
        ['q' => 'The sleep insights alone are worth it. I had no idea my 11 PM screen time was wrecking my deep sleep.',                'a' => 'Lena Schmidt',  'r' => 'Nurse, Berlin',   'seed' => 'lena8',  'rating' => 5],
        ['q' => 'My therapist recommended Bloom for the mindfulness section. Two months in and my anxiety scores are actually lower.',   'a' => 'Aarav Mehta',   'r' => 'Student, Mumbai', 'seed' => 'aarav5', 'rating' => 5],
    ];

    $faqs = [
        ['q' => 'Is Bloom free to download?',                   'a' => 'Yes — Bloom is free with all core tracking features. Bloom Premium unlocks AI coaching, advanced insights and unlimited plans.'],
        ['q' => 'Does Bloom sync with Apple Watch or Garmin?',  'a' => 'Absolutely. We sync with Apple Health, Google Fit, Garmin Connect and Fitbit so all your data lives in one place.'],
        ['q' => 'Can I cancel Premium anytime?',                'a' => 'Yes, cancel with one tap from your profile. No calls, no emails — and you keep Premium until the end of your billing period.'],
        ['q' => 'Is my health data private?',                   'a' => 'Your data is encrypted at rest and in transit, stored on HIPAA-compliant infrastructure, and never sold to third parties.'],
        ['q' => 'How does the AI coach personalize my plan?',   'a' => 'It analyzes your past activity, sleep quality, mood logs and goals to build a realistic, progressive plan that adapts each week.'],
    ];

    $plans = [
        ['name' => 'Free',    'price' => 0,  'tag' => 'Get started today',  'cta' => 'Download free',     'highlight' => false, 'color' => '#7ee0b0', 'features' => ['All core habit tracking', 'Workout library (50+)', 'Basic sleep report', 'Community challenges']],
        ['name' => 'Premium', 'price' => 9,  'tag' => 'Most popular',       'cta' => 'Start free trial',  'highlight' => true,  'color' => '#c9b8ff', 'features' => ['Everything in Free', 'AI personal coach', 'Unlimited custom plans', 'Advanced analytics', 'Priority support']],
        ['name' => 'Family',  'price' => 15, 'tag' => 'Up to 6 members',   'cta' => 'Get Family plan',   'highlight' => false, 'color' => '#a8d8ff', 'features' => ['Everything in Premium', 'Shared family dashboard', '6 member accounts', 'Kids\' activity mode']],
    ];

    $habits = [
        ['label' => 'Morning Meditation', 'icon' => 'brain',    'checked' => true,  'color' => '#c9b8ff'],
        ['label' => 'Drink 8 Glasses',    'icon' => 'droplets', 'checked' => true,  'color' => '#7ee0b0'],
        ['label' => 'Evening Walk',        'icon' => 'footprints','checked' => false, 'color' => '#a8d8ff'],
        ['label' => 'No Screens at 10PM', 'icon' => 'moon',     'checked' => false, 'color' => '#ffb4a2'],
    ];

    $steps = [
        ['title' => 'Download & sign up',    'desc' => 'Create your free account in under 60 seconds — no credit card required.',              'icon' => 'smartphone'],
        ['title' => 'Set your goals',         'desc' => 'Tell Bloom what you\'re working toward and it builds a personalized starting plan.',    'icon' => 'target'],
        ['title' => 'Build daily habits',     'desc' => 'Check in every day, track your streaks and earn badges as you hit milestones.',         'icon' => 'calendar-check'],
        ['title' => 'Watch yourself bloom',   'desc' => 'Your weekly review shows exactly how far you\'ve come — and what to focus on next.',   'icon' => 'trending-up'],
    ];
@endphp

<x-layouts.app title="Bloom — Wellness, daily">

<style>
/* ─── Bloom custom styles (scoped to #tpl-bloom) ─────────────────────────── */
@import url('https://fonts.bunny.net/css?family=fredoka:400,500,600,700&display=swap');

#tpl-bloom,
#tpl-bloom * {
    box-sizing: border-box;
}

#tpl-bloom {
    --bloom-bg:      #fff7f3;
    --bloom-lavender:#f4f0ff;
    --bloom-card:    #fffcfa;
    --bloom-peach:   #ffb4a2;
    --bloom-mint:    #7ee0b0;
    --bloom-blue:    #a8d8ff;
    --bloom-lilac:   #c9b8ff;
    --bloom-sunny:   #ffd97d;
    --bloom-ink:     #3a3340;
    --bloom-muted:   #7c6e8a;

    background: var(--bloom-bg);
    color: var(--bloom-ink);
    font-family: 'Plus Jakarta Sans', 'Manrope', system-ui, sans-serif;
    font-size: 16px;
    line-height: 1.6;
}

/* Headings use Fredoka */
#tpl-bloom h1,
#tpl-bloom h2,
#tpl-bloom h3,
#tpl-bloom h4 {
    font-family: 'Fredoka', 'Plus Jakarta Sans', system-ui, sans-serif;
    font-weight: 600;
    color: var(--bloom-ink);
    line-height: 1.25;
}

/* ── Clay card base ── */
.bloom-clay {
    background: var(--bloom-card);
    border-radius: 28px;
    box-shadow:
        8px 8px 20px rgba(58, 51, 64, 0.08),
        -6px -6px 16px rgba(255, 255, 255, 0.9),
        inset 2px 2px 6px rgba(255, 255, 255, 0.6);
    transition: transform 0.35s cubic-bezier(0.34, 1.56, 0.64, 1),
                box-shadow 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
}
.bloom-clay:hover {
    transform: translateY(-4px) scale(1.015);
    box-shadow:
        12px 14px 28px rgba(58, 51, 64, 0.12),
        -8px -8px 20px rgba(255, 255, 255, 0.95),
        inset 2px 2px 6px rgba(255, 255, 255, 0.7);
}

@media (prefers-reduced-motion: reduce) {
    .bloom-clay,
    .bloom-clay:hover,
    .bloom-pill-btn,
    .bloom-pill-btn:hover,
    .bloom-icon-tile,
    .bloom-icon-tile:hover {
        transition: none !important;
        transform: none !important;
        animation: none !important;
    }
    .bloom-blob { display: none !important; }
    @keyframes bloom-float { from, to { transform: none; } }
    @keyframes bloom-bounce-in { from, to { transform: none; opacity: 1; } }
    @keyframes bloom-spin-slow { from, to { transform: none; } }
}

/* ── Pill button ── */
.bloom-pill-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
    padding: 0.75rem 2rem;
    border-radius: 9999px;
    font-family: 'Fredoka', sans-serif;
    font-size: 1.05rem;
    font-weight: 600;
    cursor: pointer;
    border: none;
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1),
                box-shadow 0.3s ease;
    text-decoration: none;
    white-space: nowrap;
}
.bloom-pill-btn:hover {
    transform: scale(1.06) translateY(-2px);
}
.bloom-pill-btn-primary {
    background: var(--bloom-ink);
    color: #fff;
    box-shadow: 4px 6px 16px rgba(58, 51, 64, 0.25), -2px -2px 8px rgba(255,255,255,.7);
}
.bloom-pill-btn-primary:hover {
    box-shadow: 6px 10px 24px rgba(58, 51, 64, 0.3), -2px -2px 8px rgba(255,255,255,.7);
}
.bloom-pill-btn-outline {
    background: var(--bloom-card);
    color: var(--bloom-ink);
    border: 2px solid rgba(58, 51, 64, 0.14);
    box-shadow: 4px 4px 12px rgba(58,51,64,.06), -3px -3px 10px rgba(255,255,255,.8);
}

/* ── Icon tile ── */
.bloom-icon-tile {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    width: 3rem;
    height: 3rem;
    border-radius: 18px;
    box-shadow: 4px 4px 12px rgba(58,51,64,.1), -3px -3px 8px rgba(255,255,255,.9), inset 1px 1px 4px rgba(255,255,255,.6);
    transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    flex-shrink: 0;
}
.bloom-icon-tile:hover { transform: scale(1.12) rotate(-3deg); }

/* ── Pastel blob decorations ── */
.bloom-blob {
    position: absolute;
    border-radius: 9999px;
    filter: blur(60px);
    pointer-events: none;
    z-index: 0;
}

/* ── Floating animation ── */
@keyframes bloom-float {
    0%, 100% { transform: translateY(0px); }
    50%       { transform: translateY(-12px); }
}
.bloom-float { animation: bloom-float 4s ease-in-out infinite; }
.bloom-float-slow { animation: bloom-float 6s ease-in-out infinite; }

/* ── Bounce-in on scroll ── */
@keyframes bloom-bounce-in {
    0%   { opacity: 0; transform: translateY(20px) scale(0.96); }
    60%  { opacity: 1; transform: translateY(-4px) scale(1.01); }
    100% { transform: translateY(0) scale(1); }
}
.bloom-appear { animation: bloom-bounce-in 0.55s cubic-bezier(0.34, 1.56, 0.64, 1) both; }

/* ── Progress ring (SVG circles used inline) ── */
.bloom-ring-track  { fill: none; stroke: rgba(58,51,64,.08); }
.bloom-ring-fill   { fill: none; stroke-linecap: round; transition: stroke-dashoffset 0.8s ease; }

/* ── Section backgrounds ── */
.bloom-section-lavender { background: var(--bloom-lavender); }
.bloom-section-peach    { background: #fff3f0; }

/* ── Stat pill ── */
.bloom-stat {
    background: var(--bloom-card);
    border-radius: 24px;
    padding: 1.25rem 1.5rem;
    text-align: center;
    box-shadow: 6px 6px 18px rgba(58,51,64,.07), -4px -4px 12px rgba(255,255,255,.9);
}

/* ── Nav pill ── */
.bloom-nav {
    background: rgba(255,252,250,.88);
    backdrop-filter: blur(18px);
    -webkit-backdrop-filter: blur(18px);
    border-radius: 9999px;
    box-shadow: 0 4px 24px rgba(58,51,64,.1), 0 1px 0 rgba(255,255,255,.8) inset;
}

/* ── Override BlatUI card inside bloom to clay style ── */
#tpl-bloom [data-slot="card"] {
    background: var(--bloom-card) !important;
    border-color: rgba(58,51,64,.06) !important;
    border-radius: 28px !important;
    box-shadow: 8px 8px 20px rgba(58,51,64,.07), -6px -6px 16px rgba(255,255,255,.9) !important;
}

/* ── Override progress bar color inside bloom ── */
#tpl-bloom [data-slot="progress"] {
    background: rgba(58,51,64,.08) !important;
}

/* ── Habit switch tint ── */
#tpl-bloom [data-slot="switch"][data-state="checked"] { background: var(--bloom-lilac) !important; }

/* ── Calendar override ── */
#tpl-bloom [data-slot="calendar"] {
    background: var(--bloom-card) !important;
    border-color: rgba(58,51,64,.06) !important;
    border-radius: 24px !important;
}

/* ── Accordion override ── */
#tpl-bloom [data-slot="accordion-item"] {
    border-color: rgba(58,51,64,.08) !important;
}

/* ── Pricing highlight ring ── */
.bloom-plan-highlight {
    background: linear-gradient(145deg, #f2eeff, #ede6ff) !important;
    box-shadow: 8px 8px 20px rgba(201,184,255,.3), -6px -6px 16px rgba(255,255,255,.95), 0 0 0 2px rgba(201,184,255,.6) !important;
}

/* ── Tabs in bloom ── */
#tpl-bloom [data-slot="tabs-list"] {
    background: rgba(58,51,64,.06) !important;
    border-radius: 9999px !important;
}
#tpl-bloom [data-slot="tabs-trigger"][data-state="active"] {
    background: var(--bloom-card) !important;
    box-shadow: 4px 4px 10px rgba(58,51,64,.08), -2px -2px 6px rgba(255,255,255,.9) !important;
    border-radius: 9999px !important;
}
</style>

<div id="tpl-bloom">

    {{-- ═══════════════════════════════════════════════════
         NAV
    ═══════════════════════════════════════════════════ --}}
    <header class="sticky top-0 z-40 flex justify-center px-4 py-3">
        <div class="bloom-nav flex w-full max-w-4xl items-center gap-3 px-5 py-2.5">
            {{-- Logo --}}
            <a href="#" class="flex items-center gap-2 font-semibold" style="color:var(--bloom-ink)">
                <span class="bloom-icon-tile" style="background:var(--bloom-lilac)">
                    <x-lucide-flower-2 class="size-5" style="color:var(--bloom-ink)" aria-hidden="true" />
                </span>
                <span style="font-family:'Fredoka',sans-serif;font-size:1.25rem;font-weight:700">Bloom</span>
            </a>
            {{-- Nav links --}}
            <nav class="ml-4 hidden items-center gap-0.5 text-sm md:flex" aria-label="Main navigation">
                @foreach (['Features' => '#features', 'Workouts' => '#workouts', 'Habits' => '#habits', 'Pricing' => '#pricing'] as $label => $href)
                    <a href="{{ $href }}" class="rounded-full px-3.5 py-1.5 font-medium transition-colors hover:bg-black/5" style="color:var(--bloom-muted)">{{ $label }}</a>
                @endforeach
            </nav>
            {{-- CTA --}}
            <div class="ml-auto flex items-center gap-2">
                <a href="#pricing" class="bloom-pill-btn bloom-pill-btn-primary" style="padding:.55rem 1.4rem;font-size:.9rem">
                    Get Bloom free
                </a>
            </div>
        </div>
    </header>

    {{-- ═══════════════════════════════════════════════════
         HERO
    ═══════════════════════════════════════════════════ --}}
    <section class="relative overflow-hidden px-4 pb-16 pt-10">
        {{-- Blobs --}}
        <div class="bloom-blob" style="width:420px;height:420px;background:#c9b8ff;opacity:.35;top:-80px;left:-120px"></div>
        <div class="bloom-blob" style="width:360px;height:360px;background:#ffb4a2;opacity:.3;top:40px;right:-100px"></div>
        <div class="bloom-blob" style="width:260px;height:260px;background:#7ee0b0;opacity:.3;bottom:-40px;left:30%"></div>

        <div class="relative mx-auto flex max-w-6xl flex-col items-center gap-12 lg:flex-row lg:items-center" style="z-index:1">
            {{-- Copy --}}
            <div class="flex-1 text-center lg:text-left bloom-appear">
                <x-ui.badge class="mb-5 rounded-full" style="background:rgba(201,184,255,.2);color:var(--bloom-ink);border-color:rgba(201,184,255,.4)">
                    <x-lucide-sparkles class="size-3" aria-hidden="true" /> New · AI Coach is live
                </x-ui.badge>

                <h1 style="font-size:clamp(2.6rem,6vw,4.2rem);font-weight:700;color:var(--bloom-ink);line-height:1.1">
                    Your happiest,<br>
                    <span style="background:linear-gradient(135deg,#c9b8ff,#a8d8ff);-webkit-background-clip:text;-webkit-text-fill-color:transparent;background-clip:text">healthiest self</span><br>
                    starts today.
                </h1>

                <p style="color:var(--bloom-muted);font-size:1.125rem;margin-top:1rem;max-width:34rem">
                    Bloom is your friendly daily wellness companion — workouts, sleep, nutrition, mindfulness and habits, all in one beautifully simple app.
                </p>

                {{-- Store buttons --}}
                <div class="mt-7 flex flex-wrap items-center justify-center gap-3 lg:justify-start">
                    <a href="#" class="bloom-pill-btn bloom-pill-btn-primary" aria-label="Download on the App Store">
                        <x-lucide-apple class="size-5" aria-hidden="true" /> App Store
                    </a>
                    <a href="#" class="bloom-pill-btn bloom-pill-btn-outline" aria-label="Get it on Google Play">
                        <x-lucide-play class="size-5" aria-hidden="true" /> Google Play
                    </a>
                </div>

                {{-- Social proof row --}}
                <div class="mt-8 flex flex-wrap items-center justify-center gap-5 lg:justify-start">
                    <div class="flex -space-x-2.5">
                        @foreach (['seed/av1/64/64','seed/av2/64/64','seed/av3/64/64','seed/av4/64/64','seed/av5/64/64'] as $s)
                            <x-ui.avatar class="size-10" style="box-shadow:0 0 0 3px var(--bloom-bg)">
                                <x-ui.avatar-image src="https://picsum.photos/{{ $s }}" alt="" />
                                <x-ui.avatar-fallback>B</x-ui.avatar-fallback>
                            </x-ui.avatar>
                        @endforeach
                    </div>
                    <div>
                        <x-ui.rating :value="5" :readonly="true" size="sm" color="text-amber-400" />
                        <p style="font-size:.875rem;color:var(--bloom-muted);margin-top:.15rem">
                            Loved by <strong style="color:var(--bloom-ink)">12k+</strong> members
                        </p>
                    </div>
                </div>
            </div>

            {{-- Phone mockup clay card --}}
            <div class="relative flex-shrink-0 bloom-float" style="width:min(320px,88vw)">
                <div class="bloom-clay overflow-hidden" style="padding:0;border-radius:36px">
                    <img src="https://picsum.photos/seed/bloom-phone/320/560" alt="Bloom app screenshot showing today's activity summary" width="320" height="560" class="block w-full" style="border-radius:36px;display:block" />
                </div>

                {{-- Steps ring badge --}}
                <div class="bloom-clay bloom-appear absolute -bottom-4 -left-8 flex items-center gap-3 p-3.5" style="border-radius:24px;min-width:170px">
                    <div style="position:relative;width:52px;height:52px;flex-shrink:0">
                        <svg width="52" height="52" viewBox="0 0 52 52" aria-hidden="true">
                            <circle class="bloom-ring-track" cx="26" cy="26" r="22" stroke-width="5"/>
                            <circle class="bloom-ring-fill" cx="26" cy="26" r="22" stroke-width="5" stroke="#7ee0b0" stroke-dasharray="{{ 2*3.14159*22 }}" stroke-dashoffset="{{ 2*3.14159*22*0.28 }}" transform="rotate(-90 26 26)"/>
                        </svg>
                        <span style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:700;color:var(--bloom-ink)">72%</span>
                    </div>
                    <div>
                        <p style="font-weight:700;font-size:.95rem;color:var(--bloom-ink);line-height:1.2">7,240 steps</p>
                        <p style="font-size:.75rem;color:var(--bloom-muted)">Daily goal</p>
                    </div>
                </div>

                {{-- Mood badge --}}
                <div class="bloom-clay absolute -right-6 top-12 flex items-center gap-2 px-4 py-2.5 bloom-float-slow" style="border-radius:20px">
                    <x-lucide-smile class="size-5" style="color:#ffd97d" aria-hidden="true" />
                    <span style="font-weight:600;font-size:.85rem;color:var(--bloom-ink)">Feeling great!</span>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         STATS
    ═══════════════════════════════════════════════════ --}}
    <section class="px-4 py-10">
        <div class="mx-auto grid max-w-4xl grid-cols-2 gap-4 sm:grid-cols-4">
            @foreach ([['12k+','Active members'],['4.9★','App Store rating'],['50+','Workout types'],['87%','Hit their goal']] as [$v,$l])
                <div class="bloom-stat">
                    <div style="font-family:'Fredoka',sans-serif;font-size:2rem;font-weight:700;color:var(--bloom-ink)">{{ $v }}</div>
                    <div style="font-size:.8rem;color:var(--bloom-muted);margin-top:.2rem">{{ $l }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         FEATURES
    ═══════════════════════════════════════════════════ --}}
    <section id="features" class="scroll-mt-24 px-4 py-16">
        <div class="mx-auto max-w-5xl">
            <div class="mb-12 text-center">
                <x-ui.badge class="mb-3 rounded-full" style="background:rgba(126,224,176,.2);color:var(--bloom-ink);border-color:rgba(126,224,176,.4)">Everything you need</x-ui.badge>
                <h2 style="font-size:clamp(1.8rem,4vw,2.6rem)">All the tools. Zero overwhelm.</h2>
                <p style="color:var(--bloom-muted);margin-top:.5rem;max-width:36rem;margin-left:auto;margin-right:auto">Bloom brings together every pillar of wellness in one friendly, beautiful place.</p>
            </div>
            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($features as $f)
                    <div class="bloom-clay flex gap-4 p-6">
                        <div class="bloom-icon-tile" style="background:{{ $f['bg'] }}">
                            <x-dynamic-component :component="'lucide-'.$f['icon']" class="size-5" style="color:{{ $f['color'] }}" aria-hidden="true" />
                        </div>
                        <div>
                            <h3 style="font-size:1rem;font-weight:600;margin-bottom:.35rem">{{ $f['title'] }}</h3>
                            <p style="font-size:.875rem;color:var(--bloom-muted);line-height:1.5">{{ $f['desc'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         YOUR DAY — stats + sliders
    ═══════════════════════════════════════════════════ --}}
    <section class="bloom-section-lavender px-4 py-16" x-data="{ goal: 8000 }">
        <div class="mx-auto max-w-5xl">
            <div class="mb-10 text-center">
                <x-ui.badge class="mb-3 rounded-full" style="background:rgba(168,216,255,.3);color:var(--bloom-ink);border-color:rgba(168,216,255,.5)">Today's snapshot</x-ui.badge>
                <h2 style="font-size:clamp(1.8rem,4vw,2.5rem)">Your Day at a Glance</h2>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                {{-- Progress bars panel --}}
                <div class="bloom-clay p-7 space-y-6">
                    <h3 style="font-size:1.05rem;margin-bottom:0">Today's Activity</h3>

                    @foreach ([
                        ['Steps',  '#7ee0b0', 72],
                        ['Water',  '#a8d8ff', 55],
                        ['Sleep',  '#c9b8ff', 88],
                        ['Calories','#ffd97d', 63],
                    ] as [$label, $color, $val])
                        <div>
                            <div class="flex justify-between mb-1.5" style="font-size:.875rem">
                                <span style="font-weight:600;color:var(--bloom-ink)">{{ $label }}</span>
                                <span style="color:var(--bloom-muted)">{{ $val }}%</span>
                            </div>
                            <x-ui.progress :value="$val" :aria-label="$label.' progress'" class="h-3" style="--tw-bg-opacity:1;background:rgba(58,51,64,.08)" />
                        </div>
                    @endforeach

                    {{-- Ring summary row --}}
                    <div class="flex justify-around pt-2">
                        @foreach ([['Steps','#7ee0b0',72],['Water','#a8d8ff',55],['Sleep','#c9b8ff',88]] as [$lbl,$col,$pct])
                            <div class="flex flex-col items-center gap-1">
                                <div style="position:relative;width:56px;height:56px">
                                    <svg width="56" height="56" viewBox="0 0 56 56" aria-hidden="true">
                                        <circle class="bloom-ring-track" cx="28" cy="28" r="23" stroke-width="5"/>
                                        <circle class="bloom-ring-fill" cx="28" cy="28" r="23" stroke-width="5" stroke="{{ $col }}" stroke-dasharray="{{ round(2*3.14159*23,1) }}" stroke-dashoffset="{{ round(2*3.14159*23*(1-$pct/100),1) }}" transform="rotate(-90 28 28)" />
                                    </svg>
                                    <span style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:.7rem;font-weight:700;color:var(--bloom-ink)">{{ $pct }}%</span>
                                </div>
                                <span style="font-size:.72rem;color:var(--bloom-muted)">{{ $lbl }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Goal slider panel --}}
                <div class="bloom-clay p-7 flex flex-col gap-6">
                    <h3 style="font-size:1.05rem">Daily Step Goal</h3>
                    <div class="flex items-baseline gap-2">
                        <span style="font-family:'Fredoka',sans-serif;font-size:2.5rem;font-weight:700;color:var(--bloom-ink)" x-text="goal.toLocaleString()">8,000</span>
                        <span style="color:var(--bloom-muted)">steps / day</span>
                    </div>

                    <x-ui.slider
                        :min="2000" :max="20000" :step="500" :value="8000"
                        aria-label="Daily step goal"
                        x-model="goal"
                        class="w-full"
                        style="--tw-bg-opacity:1"
                    />

                    <div class="flex justify-between" style="font-size:.8rem;color:var(--bloom-muted)">
                        <span>2 k</span><span>10 k</span><span>20 k</span>
                    </div>

                    <div class="flex items-center gap-3 rounded-2xl p-4" style="background:rgba(126,224,176,.15)">
                        <x-lucide-zap class="size-5" style="color:#7ee0b0;flex-shrink:0" aria-hidden="true" />
                        <p style="font-size:.85rem;color:var(--bloom-ink)">
                            <strong>Pro tip:</strong> Walking 8k steps burns roughly <strong>320 kcal</strong> — about 90 min of gentle movement!
                        </p>
                    </div>

                    <a href="#pricing" class="bloom-pill-btn bloom-pill-btn-primary w-full" style="justify-content:center">
                        <x-lucide-target class="size-4" aria-hidden="true" /> Set my goal
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         WORKOUTS
    ═══════════════════════════════════════════════════ --}}
    <section id="workouts" class="scroll-mt-24 px-4 py-16">
        <div class="mx-auto max-w-5xl">
            <div class="mb-10 flex flex-col items-start justify-between gap-4 sm:flex-row sm:items-end">
                <div>
                    <x-ui.badge class="mb-3 rounded-full" style="background:rgba(255,180,162,.2);color:var(--bloom-ink);border-color:rgba(255,180,162,.4)">Move your body</x-ui.badge>
                    <h2 style="font-size:clamp(1.8rem,4vw,2.5rem)">Find your perfect workout</h2>
                </div>
                <x-ui.tabs value="all">
                    <x-ui.tabs-list variant="segmented" class="!rounded-full">
                        <x-ui.tabs-trigger value="all">All</x-ui.tabs-trigger>
                        <x-ui.tabs-trigger value="cardio">Cardio</x-ui.tabs-trigger>
                        <x-ui.tabs-trigger value="strength">Strength</x-ui.tabs-trigger>
                    </x-ui.tabs-list>
                </x-ui.tabs>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($workouts as $w)
                    <div class="bloom-clay overflow-hidden p-0">
                        <div class="relative overflow-hidden" style="border-radius:28px 28px 0 0;height:160px">
                            <img src="{{ $w['img'] }}" alt="{{ $w['label'] }} workout" width="320" height="200" loading="lazy" class="size-full object-cover" />
                            <div style="position:absolute;inset:0;background:linear-gradient(to top,rgba(58,51,64,.45),transparent)"></div>
                            <x-ui.badge class="absolute right-3 top-3 rounded-full" style="background:{{ $w['color'] }};color:var(--bloom-ink);border:none;font-weight:600">{{ $w['tone'] }}</x-ui.badge>
                        </div>
                        <div class="flex items-center justify-between p-4">
                            <div>
                                <h3 style="font-size:.95rem;font-weight:600">{{ $w['label'] }}</h3>
                                <p style="font-size:.8rem;color:var(--bloom-muted)">{{ $w['mins'] }} min</p>
                            </div>
                            <x-ui.tooltip>
                                <x-ui.tooltip-trigger>
                                    <button type="button" class="bloom-icon-tile" style="background:{{ $w['color'] }}25;width:2.5rem;height:2.5rem;border-radius:14px" aria-label="Start {{ $w['label'] }}">
                                        <x-lucide-play class="size-4" style="color:var(--bloom-ink)" aria-hidden="true" />
                                    </button>
                                </x-ui.tooltip-trigger>
                                <x-ui.tooltip-content side="top">Start {{ $w['label'] }}</x-ui.tooltip-content>
                            </x-ui.tooltip>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         HABIT TRACKER — calendar + switches
    ═══════════════════════════════════════════════════ --}}
    <section id="habits" class="bloom-section-peach scroll-mt-24 px-4 py-16">
        <div class="mx-auto max-w-5xl">
            <div class="mb-10 text-center">
                <x-ui.badge class="mb-3 rounded-full" style="background:rgba(201,184,255,.2);color:var(--bloom-ink);border-color:rgba(201,184,255,.4)">Stay consistent</x-ui.badge>
                <h2 style="font-size:clamp(1.8rem,4vw,2.5rem)">Build habits that actually stick</h2>
                <p style="color:var(--bloom-muted);max-width:36rem;margin:.5rem auto 0">Check in daily, visualise your streak and never break the chain.</p>
            </div>

            <div class="grid gap-6 md:grid-cols-2 items-start">
                {{-- Calendar --}}
                <div class="bloom-clay p-2 flex justify-center">
                    <x-ui.calendar mode="single" :value="now()->format('Y-m-d')" caption-layout="label" />
                </div>

                {{-- Habit switches --}}
                <div class="bloom-clay p-7 flex flex-col gap-5">
                    <h3 style="font-size:1.05rem">Today's Habits</h3>

                    @foreach ($habits as $h)
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="bloom-icon-tile" style="background:{{ $h['color'] }}25;width:2.4rem;height:2.4rem;border-radius:14px">
                                    <x-dynamic-component :component="'lucide-'.$h['icon']" class="size-4" style="color:{{ $h['color'] }}" aria-hidden="true" />
                                </div>
                                <span style="font-size:.9rem;font-weight:500;color:var(--bloom-ink)">{{ $h['label'] }}</span>
                            </div>
                            <x-ui.switch :checked="$h['checked']" :aria-label="$h['label']" />
                        </div>
                    @endforeach

                    <x-ui.separator />

                    <div class="flex items-center justify-between rounded-2xl p-4" style="background:rgba(201,184,255,.18)">
                        <div>
                            <p style="font-weight:700;font-size:1.05rem;color:var(--bloom-ink)">🔥 14-day streak!</p>
                            <p style="font-size:.8rem;color:var(--bloom-muted)">Keep it up — you're on fire!</p>
                        </div>
                        <x-ui.badge class="rounded-full" style="background:var(--bloom-lilac);color:var(--bloom-ink);border:none;font-weight:700;font-size:.9rem;padding:.35rem .9rem">+2 badges</x-ui.badge>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         TESTIMONIALS carousel
    ═══════════════════════════════════════════════════ --}}
    <section class="px-4 py-16">
        <div class="mx-auto max-w-5xl">
            <div class="mb-10 text-center">
                <x-ui.badge class="mb-3 rounded-full" style="background:rgba(255,217,125,.2);color:var(--bloom-ink);border-color:rgba(255,217,125,.5)">Real stories</x-ui.badge>
                <h2 style="font-size:clamp(1.8rem,4vw,2.5rem)">People are blooming</h2>
            </div>

            <x-ui.carousel class="w-full">
                <x-ui.carousel-content>
                    @foreach ($testimonials as $t)
                        <x-ui.carousel-item class="md:basis-1/2">
                            <div class="bloom-clay p-7 flex flex-col gap-4 h-full">
                                <x-ui.rating :value="$t['rating']" :readonly="true" size="sm" color="text-amber-400" />
                                <p style="font-size:.95rem;color:var(--bloom-ink);line-height:1.65;flex:1">"{{ $t['q'] }}"</p>
                                <div class="flex items-center gap-3">
                                    <x-ui.avatar class="size-10">
                                        <x-ui.avatar-image src="https://picsum.photos/seed/{{ $t['seed'] }}/64/64" alt="Photo of {{ $t['a'] }}" />
                                        <x-ui.avatar-fallback>{{ substr($t['a'],0,1) }}</x-ui.avatar-fallback>
                                    </x-ui.avatar>
                                    <div>
                                        <p style="font-weight:600;font-size:.875rem;color:var(--bloom-ink)">{{ $t['a'] }}</p>
                                        <p style="font-size:.75rem;color:var(--bloom-muted)">{{ $t['r'] }}</p>
                                    </div>
                                </div>
                            </div>
                        </x-ui.carousel-item>
                    @endforeach
                </x-ui.carousel-content>
                <x-ui.carousel-previous style="left:-16px;background:var(--bloom-card);border-color:rgba(58,51,64,.08)" />
                <x-ui.carousel-next style="right:-16px;background:var(--bloom-card);border-color:rgba(58,51,64,.08)" />
            </x-ui.carousel>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         HOW IT WORKS — stepper
    ═══════════════════════════════════════════════════ --}}
    <section class="bloom-section-lavender px-4 py-16">
        <div class="mx-auto max-w-4xl">
            <div class="mb-12 text-center">
                <x-ui.badge class="mb-3 rounded-full" style="background:rgba(168,216,255,.3);color:var(--bloom-ink);border-color:rgba(168,216,255,.5)">Simple as 1-2-3-4</x-ui.badge>
                <h2 style="font-size:clamp(1.8rem,4vw,2.5rem)">How Bloom works</h2>
            </div>

            <x-ui.stepper :value="2" orientation="horizontal">
                <ol class="flex w-full items-start gap-2">
                    @foreach ($steps as $i => $s)
                        <x-ui.stepper-item :step="$i+1" class="flex-1">
                            <x-ui.stepper-trigger class="flex w-full flex-col items-center gap-3 text-center">
                                <x-ui.stepper-indicator style="background:{{ $i < 1 ? 'var(--bloom-lilac)' : ($i === 1 ? 'var(--bloom-ink)' : 'rgba(58,51,64,.1)') }};border-color:{{ $i <= 1 ? 'transparent' : 'rgba(58,51,64,.15)' }}" />
                                <div>
                                    <p style="font-weight:600;font-size:.875rem;color:var(--bloom-ink);line-height:1.2">{{ $s['title'] }}</p>
                                    <p style="font-size:.75rem;color:var(--bloom-muted);margin-top:.2rem;max-width:130px;margin-left:auto;margin-right:auto">{{ $s['desc'] }}</p>
                                </div>
                            </x-ui.stepper-trigger>
                            @if (!$loop->last)
                                <x-ui.stepper-separator />
                            @endif
                        </x-ui.stepper-item>
                    @endforeach
                </ol>
            </x-ui.stepper>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         PRICING
    ═══════════════════════════════════════════════════ --}}
    <section id="pricing" class="scroll-mt-24 px-4 py-16" x-data="{ yearly: false }">
        <div class="mx-auto max-w-5xl">
            <div class="mb-10 text-center">
                <x-ui.badge class="mb-3 rounded-full" style="background:rgba(126,224,176,.2);color:var(--bloom-ink);border-color:rgba(126,224,176,.4)">Simple pricing</x-ui.badge>
                <h2 style="font-size:clamp(1.8rem,4vw,2.5rem)">Invest in yourself</h2>
                <p style="color:var(--bloom-muted);margin:.5rem auto 0;max-width:30rem">Start free. Upgrade when you're ready. Cancel anytime.</p>

                {{-- Billing toggle --}}
                <div class="mt-6 inline-flex items-center gap-3">
                    <span style="font-size:.9rem;color:var(--bloom-muted)">Monthly</span>
                    <x-ui.switch :checked="false" x-model="yearly" aria-label="Toggle annual billing" />
                    <span style="font-size:.9rem;color:var(--bloom-ink);font-weight:500">
                        Annual
                        <x-ui.badge class="ml-1 rounded-full" style="background:rgba(126,224,176,.25);color:var(--bloom-ink);border-color:rgba(126,224,176,.4)">-25%</x-ui.badge>
                    </span>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-3 items-stretch">
                @foreach ($plans as $plan)
                    <div @class(['bloom-clay p-7 flex flex-col gap-4', 'bloom-plan-highlight' => $plan['highlight']])>
                        @if ($plan['highlight'])
                            <x-ui.badge class="self-start rounded-full" style="background:var(--bloom-lilac);color:var(--bloom-ink);border:none;font-weight:600">Most popular</x-ui.badge>
                        @endif

                        <div>
                            <h3 style="font-size:1.2rem;font-weight:700">{{ $plan['name'] }}</h3>
                            <p style="font-size:.82rem;color:var(--bloom-muted)">{{ $plan['tag'] }}</p>
                        </div>

                        <div class="flex items-baseline gap-1">
                            <span style="font-family:'Fredoka',sans-serif;font-size:2.8rem;font-weight:700;color:var(--bloom-ink)">
                                @if ($plan['price'] === 0)
                                    Free
                                @else
                                    $<span x-text="yearly ? Math.round({{ $plan['price'] }} * 0.75) : {{ $plan['price'] }}">{{ $plan['price'] }}</span>
                                @endif
                            </span>
                            @if ($plan['price'] > 0)
                                <span style="color:var(--bloom-muted);font-size:.85rem">/mo</span>
                            @endif
                        </div>

                        <a href="#" class="bloom-pill-btn {{ $plan['highlight'] ? 'bloom-pill-btn-primary' : 'bloom-pill-btn-outline' }} w-full" style="justify-content:center">
                            {{ $plan['cta'] }}
                        </a>

                        <x-ui.separator />

                        <ul class="flex flex-col gap-2.5 flex-1">
                            @foreach ($plan['features'] as $feat)
                                <li class="flex items-start gap-2.5" style="font-size:.875rem;color:var(--bloom-ink)">
                                    <div class="bloom-icon-tile mt-0.5" style="background:{{ $plan['color'] }}25;width:1.4rem;height:1.4rem;border-radius:8px;min-width:1.4rem">
                                        <x-lucide-check class="size-3" style="color:{{ $plan['color'] }}" aria-hidden="true" />
                                    </div>
                                    {{ $feat }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         FAQ — accordion
    ═══════════════════════════════════════════════════ --}}
    <section class="bloom-section-peach px-4 py-16">
        <div class="mx-auto max-w-3xl">
            <div class="mb-10 text-center">
                <x-ui.badge class="mb-3 rounded-full" style="background:rgba(255,180,162,.2);color:var(--bloom-ink);border-color:rgba(255,180,162,.4)">FAQ</x-ui.badge>
                <h2 style="font-size:clamp(1.8rem,4vw,2.5rem)">Got questions?</h2>
            </div>

            <div class="bloom-clay p-6">
                <x-ui.accordion type="single" collapsible>
                    @foreach ($faqs as $i => $faq)
                        <x-ui.accordion-item value="faq-{{ $i }}">
                            <x-ui.accordion-trigger style="font-size:.95rem;font-weight:600;color:var(--bloom-ink)">{{ $faq['q'] }}</x-ui.accordion-trigger>
                            <x-ui.accordion-content style="color:var(--bloom-muted)">{{ $faq['a'] }}</x-ui.accordion-content>
                        </x-ui.accordion-item>
                    @endforeach
                </x-ui.accordion>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         CTA
    ═══════════════════════════════════════════════════ --}}
    <section class="relative overflow-hidden px-4 py-20">
        <div class="bloom-blob" style="width:400px;height:400px;background:#c9b8ff;opacity:.35;top:-80px;right:-80px"></div>
        <div class="bloom-blob" style="width:320px;height:320px;background:#7ee0b0;opacity:.3;bottom:-60px;left:-60px"></div>

        <div class="relative mx-auto max-w-2xl text-center" style="z-index:1">
            <div class="bloom-clay mx-auto p-10 md:p-14" style="background:linear-gradient(145deg,#f2eeff,#e8f8f1)">
                <span style="font-size:3rem;line-height:1" role="img" aria-label="Flower">🌸</span>
                <h2 style="font-size:clamp(2rem,5vw,3rem);margin-top:.5rem">
                    Ready to bloom?
                </h2>
                <p style="color:var(--bloom-muted);font-size:1.05rem;margin:.75rem auto 0;max-width:26rem">
                    Join 12,000+ people building healthier, happier lives — one habit at a time.
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-3">
                    <a href="#" class="bloom-pill-btn bloom-pill-btn-primary" aria-label="Download Bloom on the App Store">
                        <x-lucide-apple class="size-5" aria-hidden="true" /> App Store
                    </a>
                    <a href="#" class="bloom-pill-btn bloom-pill-btn-outline" aria-label="Get Bloom on Google Play">
                        <x-lucide-play class="size-5" aria-hidden="true" /> Google Play
                    </a>
                </div>
                <p style="font-size:.8rem;color:var(--bloom-muted);margin-top:1rem">Free forever. Premium from $9/mo. No credit card required.</p>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════════════════
         FOOTER
    ═══════════════════════════════════════════════════ --}}
    <footer style="background:var(--bloom-ink);color:rgba(255,255,255,.85)" class="px-4 py-14">
        <div class="mx-auto max-w-5xl">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-4">
                <div class="lg:col-span-1">
                    <div class="flex items-center gap-2 mb-4">
                        <div class="bloom-icon-tile" style="background:rgba(201,184,255,.2);border-radius:14px;width:2.25rem;height:2.25rem">
                            <x-lucide-flower-2 class="size-4" style="color:var(--bloom-lilac)" aria-hidden="true" />
                        </div>
                        <span style="font-family:'Fredoka',sans-serif;font-size:1.2rem;font-weight:700;color:#fff">Bloom</span>
                    </div>
                    <p style="font-size:.84rem;color:rgba(255,255,255,.55);line-height:1.6;max-width:200px">Your friendly daily wellness companion for a happier, healthier you.</p>
                    <div class="mt-5 flex gap-2">
                        @foreach (['instagram','twitter','youtube','github'] as $s)
                            <a href="#" aria-label="{{ ucfirst($s) }}" class="flex size-9 items-center justify-center rounded-full transition-colors" style="background:rgba(255,255,255,.08)" onmouseover="this.style.background='rgba(201,184,255,.25)'" onmouseout="this.style.background='rgba(255,255,255,.08)'">
                                <x-dynamic-component :component="'lucide-'.$s" class="size-4" style="color:rgba(255,255,255,.7)" />
                            </a>
                        @endforeach
                    </div>
                </div>
                @foreach (['Product' => ['Features','Workouts','Nutrition','Sleep','Premium'],'Company' => ['About','Blog','Careers','Press','Contact'],'Support' => ['Help Center','Privacy','Terms','Status','API']] as $heading => $links)
                    <div>
                        <h4 style="font-size:.8rem;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:rgba(255,255,255,.4);margin-bottom:.75rem">{{ $heading }}</h4>
                        <ul class="space-y-2">
                            @foreach ($links as $link)
                                <li><a href="#" style="font-size:.875rem;color:rgba(255,255,255,.65)" onmouseover="this.style.color='#fff'" onmouseout="this.style.color='rgba(255,255,255,.65)'">{{ $link }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <div style="height:1px;background:rgba(255,255,255,.1);margin:2.5rem 0"></div>

            <div class="flex flex-col items-center justify-between gap-3 sm:flex-row" style="font-size:.8rem;color:rgba(255,255,255,.4)">
                <span>© {{ date('Y') }} Bloom Health, Inc. All rights reserved.</span>
                <div class="flex items-center gap-2">
                    <x-lucide-shield-check class="size-4" style="color:var(--bloom-mint)" aria-hidden="true" />
                    <span>HIPAA compliant · GDPR ready · SOC 2</span>
                </div>
            </div>
        </div>
    </footer>

</div>
</x-layouts.app>
