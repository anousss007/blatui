@php
    $subjects = [
        ['emoji' => '🔢', 'label' => 'Maths', 'color' => '#3ab7ff', 'shadow' => '#2b2440', 'badge' => 'Ages 4–12', 'desc' => 'Numbers, shapes, puzzles & logic games that build real skills.', 'lessons' => 42],
        ['emoji' => '🔬', 'label' => 'Science', 'color' => '#5ec26a', 'shadow' => '#2b2440', 'badge' => 'Ages 6–14', 'desc' => 'Experiments, animals, space and the world around us.', 'lessons' => 38],
        ['emoji' => '📖', 'label' => 'Reading', 'color' => '#ffd23f', 'shadow' => '#2b2440', 'badge' => 'Ages 3–10', 'desc' => 'Phonics, stories and comprehension for young readers.', 'lessons' => 55],
        ['emoji' => '🌍', 'label' => 'Geography', 'color' => '#ff6b6b', 'shadow' => '#2b2440', 'badge' => 'Ages 7–14', 'desc' => 'Countries, maps, cultures and amazing places on Earth.', 'lessons' => 29],
        ['emoji' => '🎨', 'label' => 'Art & Music', 'color' => '#9b5de5', 'shadow' => '#2b2440', 'badge' => 'Ages 4–16', 'desc' => 'Drawing, painting, rhythm and creative expression.', 'lessons' => 33],
        ['emoji' => '💻', 'label' => 'Coding', 'color' => '#3ab7ff', 'shadow' => '#2b2440', 'badge' => 'Ages 8–16', 'desc' => 'Block coding, logic and introductory programming projects.', 'lessons' => 24],
    ];

    $steps = [
        ['num' => 1, 'title' => 'Pick your subjects', 'desc' => "Choose from 6 core subjects and let Sprout tailor the learning path for your child's age and level.", 'color' => '#3ab7ff'],
        ['num' => 2, 'title' => 'Learn at your pace', 'desc' => 'Short, joyful lessons fit around any schedule — 10 minutes a day is all it takes to keep the streak alive!', 'color' => '#5ec26a'],
        ['num' => 3, 'title' => 'Earn stars & badges', 'desc' => 'Every completed lesson earns stars. Collect enough to unlock badges and level up your learner profile.', 'color' => '#ffd23f'],
        ['num' => 4, 'title' => 'Celebrate progress', 'desc' => 'Parents get a weekly digest. Kids see confetti. Everyone wins when learning becomes a daily joy.', 'color' => '#ff6b6b'],
    ];

    $achievements = [
        ['label' => 'Maths Wizard',    'icon' => '🏅', 'progress' => 72, 'color' => '#3ab7ff', 'earned' => false],
        ['label' => 'Bookworm',        'icon' => '📚', 'progress' => 100, 'color' => '#5ec26a', 'earned' => true],
        ['label' => 'Science Star',    'icon' => '⭐', 'progress' => 45, 'color' => '#ffd23f', 'earned' => false],
        ['label' => '7-Day Streak',    'icon' => '🔥', 'progress' => 100, 'color' => '#ff6b6b', 'earned' => true],
        ['label' => 'Code Explorer',   'icon' => '💻', 'progress' => 20, 'color' => '#9b5de5', 'earned' => false],
        ['label' => 'World Traveller', 'icon' => '🌍', 'progress' => 60, 'color' => '#3ab7ff', 'earned' => false],
    ];

    $courses = [
        'tiny' => [
            'label' => 'Tiny Sprouts',
            'range' => 'Ages 3–5',
            'items' => [
                ['title' => 'First Numbers', 'img' => 'https://picsum.photos/seed/tiny1/400/240', 'subject' => 'Maths', 'lessons' => 8, 'color' => '#3ab7ff'],
                ['title' => 'ABC Adventure', 'img' => 'https://picsum.photos/seed/tiny2/400/240', 'subject' => 'Reading', 'lessons' => 10, 'color' => '#ffd23f'],
                ['title' => 'Colour Magic', 'img' => 'https://picsum.photos/seed/tiny3/400/240', 'subject' => 'Art', 'lessons' => 6, 'color' => '#9b5de5'],
            ],
        ],
        'junior' => [
            'label' => 'Junior Learners',
            'range' => 'Ages 6–9',
            'items' => [
                ['title' => 'Times Tables Quest', 'img' => 'https://picsum.photos/seed/jr1/400/240', 'subject' => 'Maths', 'lessons' => 12, 'color' => '#3ab7ff'],
                ['title' => 'Animal Kingdom', 'img' => 'https://picsum.photos/seed/jr2/400/240', 'subject' => 'Science', 'lessons' => 9, 'color' => '#5ec26a'],
                ['title' => 'Story Builder', 'img' => 'https://picsum.photos/seed/jr3/400/240', 'subject' => 'Reading', 'lessons' => 11, 'color' => '#ffd23f'],
            ],
        ],
        'explorer' => [
            'label' => 'Explorers',
            'range' => 'Ages 10–14',
            'items' => [
                ['title' => 'Space Explorers', 'img' => 'https://picsum.photos/seed/exp1/400/240', 'subject' => 'Science', 'lessons' => 14, 'color' => '#5ec26a'],
                ['title' => 'Geometry Galaxy', 'img' => 'https://picsum.photos/seed/exp2/400/240', 'subject' => 'Maths', 'lessons' => 10, 'color' => '#3ab7ff'],
                ['title' => 'Scratch Coding', 'img' => 'https://picsum.photos/seed/exp3/400/240', 'subject' => 'Coding', 'lessons' => 12, 'color' => '#9b5de5'],
            ],
        ],
    ];

    $schedule = [
        ['day' => 'Mon', 'subject' => 'Maths', 'time' => '4:00 PM', 'color' => '#3ab7ff', 'emoji' => '🔢'],
        ['day' => 'Tue', 'subject' => 'Reading', 'time' => '4:00 PM', 'color' => '#ffd23f', 'emoji' => '📖'],
        ['day' => 'Wed', 'subject' => 'Science', 'time' => '3:30 PM', 'color' => '#5ec26a', 'emoji' => '🔬'],
        ['day' => 'Thu', 'subject' => 'Art', 'time' => '4:00 PM', 'color' => '#9b5de5', 'emoji' => '🎨'],
        ['day' => 'Fri', 'subject' => 'Coding', 'time' => '3:00 PM', 'color' => '#3ab7ff', 'emoji' => '💻'],
        ['day' => 'Sat', 'subject' => 'Geography', 'time' => '10:00 AM', 'color' => '#ff6b6b', 'emoji' => '🌍'],
        ['day' => 'Sun', 'subject' => 'Free Play', 'time' => 'Any time', 'color' => '#ffd23f', 'emoji' => '🎉'],
    ];

    $testimonials = [
        ['q' => 'My 7-year-old asks to do his Sprout lessons before dinner. I never thought I\'d say that! The gamification keeps him going every single day.', 'name' => 'Emily Johnson', 'role' => 'Mum of Theo, 7', 'img' => 'https://picsum.photos/seed/parent1/160/160', 'stars' => 5],
        ['q' => 'We have three kids at different ages and Sprout handles all of them perfectly. The weekly parent report is worth the subscription alone.', 'name' => 'Carlos & Mia Ruiz', 'role' => 'Parents of 3', 'img' => 'https://picsum.photos/seed/parent2/160/160', 'stars' => 5],
        ['q' => 'Finally — an app that my daughter finds genuinely fun AND that actually teaches her something. The reading lessons went from struggle to joy.', 'name' => 'Priya Sharma', 'role' => 'Mum of Ananya, 9', 'img' => 'https://picsum.photos/seed/parent3/160/160', 'stars' => 5],
        ['q' => 'As a teacher I recommend Sprout to parents constantly. The curriculum alignment is solid and the UI makes kids feel safe to fail and try again.', 'name' => 'Mr. David Osei', 'role' => 'Primary School Teacher', 'img' => 'https://picsum.photos/seed/parent4/160/160', 'stars' => 5],
    ];

    $plans = [
        ['name' => 'Seedling', 'monthly' => 0, 'annual' => 0, 'badge' => null, 'highlight' => false, 'cta' => 'Start free',
         'features' => ['1 learner profile', '3 subjects', '20 lessons/month', 'Progress tracking', 'Badges & stars']],
        ['name' => 'Sprout', 'monthly' => 9, 'annual' => 7, 'badge' => 'Most popular', 'highlight' => true, 'cta' => 'Start 14-day trial',
         'features' => ['Up to 3 learner profiles', 'All 6 subjects', 'Unlimited lessons', 'Weekly parent digest', 'Priority support', 'Offline mode']],
        ['name' => 'Family Tree', 'monthly' => 15, 'annual' => 12, 'badge' => 'Best value', 'highlight' => false, 'cta' => 'Get Family Tree',
         'features' => ['Up to 6 learner profiles', 'All subjects + early access', 'Unlimited lessons', 'Advanced analytics', 'Dedicated family coach', 'Ad-free forever']],
    ];

    $faqs = [
        ['q' => 'What age range is Sprout designed for?', 'a' => "Sprout is designed for children aged 3 to 14. Lessons are automatically adapted to your child's age and assessed skill level, so siblings at different stages can all use the same account."],
        ['q' => 'Do lessons align with school curriculums?', 'a' => 'Yes. Our content team maps every lesson to major English-speaking curricula (UK National Curriculum, US Common Core, Australian AC) and we update the library every term.'],
        ['q' => 'Can I try before I subscribe?', 'a' => 'Absolutely — the Seedling plan is free forever. The Sprout plan includes a full 14-day trial with no credit card required.'],
        ['q' => 'How long are the lessons?', 'a' => 'Core lessons are 10–15 minutes. Practice mini-games run 3–5 minutes. Everything is designed to fit school-night schedules.'],
        ['q' => 'Is there a mobile app?', 'a' => 'Yes! Sprout is available on iOS and Android, fully synced with the web. Offline mode (Sprout & Family Tree plans) lets kids learn on car journeys.'],
        ['q' => 'Can I cancel anytime?', 'a' => 'Yes, cancel any time from your account settings — no phone calls, no friction. Annual subscribers receive a prorated refund for unused months.'],
    ];

    $footerLinks = [
        'Learn' => ['Subjects', 'Courses', 'Lesson Library', 'Age Guides', 'For Schools'],
        'Parents' => ['Parent Dashboard', 'Weekly Reports', 'Family Plans', 'Blog', 'Community'],
        'Company' => ['About Us', 'Careers', 'Press Kit', 'Contact'],
        'Legal' => ['Privacy', 'Terms', 'COPPA & GDPR', 'Cookies'],
    ];

    $parentAvatars = [
        'https://picsum.photos/seed/av1/80/80',
        'https://picsum.photos/seed/av2/80/80',
        'https://picsum.photos/seed/av3/80/80',
        'https://picsum.photos/seed/av4/80/80',
        'https://picsum.photos/seed/av5/80/80',
    ];
@endphp

<x-layouts.app title="Sprout — Learning made joyful">

<style>
    @import url('https://fonts.bunny.net/css?family=fredoka:400,500,600,700|nunito:400,500,600,700');

    /* ── Sprout palette (own colors — immune to theme toggle) ───────────── */
    #tpl-sprout {
        --sp-cream:  #fffdf7;
        --sp-sky:    #3ab7ff;
        --sp-sunny:  #ffd23f;
        --sp-grass:  #5ec26a;
        --sp-coral:  #ff6b6b;
        --sp-grape:  #9b5de5;
        --sp-dark:   #2b2440;

        background-color: var(--sp-cream);
        color: var(--sp-dark);
        font-family: 'Nunito', 'Plus Jakarta Sans', sans-serif;
    }

    #tpl-sprout h1,
    #tpl-sprout h2,
    #tpl-sprout h3,
    #tpl-sprout .sp-heading {
        font-family: 'Fredoka', 'Nunito', sans-serif;
        font-weight: 600;
        letter-spacing: -0.01em;
    }

    /* ── Flat offset-shadow cards ────────────────────────────────────────── */
    #tpl-sprout .sp-card {
        border: 2px solid var(--sp-dark);
        border-radius: 1.25rem;
        background: #fff;
        transition: transform .18s cubic-bezier(.34,1.56,.64,1), box-shadow .18s cubic-bezier(.34,1.56,.64,1);
    }
    #tpl-sprout .sp-card:hover {
        transform: translate(-3px,-3px);
    }
    #tpl-sprout .sp-card-sky    { box-shadow:  8px 8px 0 var(--sp-sky); }
    #tpl-sprout .sp-card-sky:hover    { box-shadow: 11px 11px 0 var(--sp-sky); }
    #tpl-sprout .sp-card-sunny  { box-shadow:  8px 8px 0 var(--sp-sunny); }
    #tpl-sprout .sp-card-sunny:hover  { box-shadow: 11px 11px 0 var(--sp-sunny); }
    #tpl-sprout .sp-card-grass  { box-shadow:  8px 8px 0 var(--sp-grass); }
    #tpl-sprout .sp-card-grass:hover  { box-shadow: 11px 11px 0 var(--sp-grass); }
    #tpl-sprout .sp-card-coral  { box-shadow:  8px 8px 0 var(--sp-coral); }
    #tpl-sprout .sp-card-coral:hover  { box-shadow: 11px 11px 0 var(--sp-coral); }
    #tpl-sprout .sp-card-grape  { box-shadow:  8px 8px 0 var(--sp-grape); }
    #tpl-sprout .sp-card-grape:hover  { box-shadow: 11px 11px 0 var(--sp-grape); }

    /* ── Bouncy button ───────────────────────────────────────────────────── */
    #tpl-sprout .sp-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: .5rem;
        padding: .6rem 1.5rem;
        border-radius: 9999px;
        font-family: 'Fredoka', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        border: 2px solid var(--sp-dark);
        cursor: pointer;
        transition: transform .2s cubic-bezier(.34,1.56,.64,1), box-shadow .2s cubic-bezier(.34,1.56,.64,1);
        text-decoration: none;
        white-space: nowrap;
    }
    #tpl-sprout .sp-btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(43,36,64,.18);
    }
    #tpl-sprout .sp-btn-primary {
        background: var(--sp-dark);
        color: #fff;
        box-shadow: 4px 4px 0 var(--sp-sunny);
    }
    #tpl-sprout .sp-btn-primary:hover {
        box-shadow: 6px 6px 0 var(--sp-sunny);
    }
    #tpl-sprout .sp-btn-outline {
        background: transparent;
        color: var(--sp-dark);
        box-shadow: 4px 4px 0 var(--sp-sky);
    }
    #tpl-sprout .sp-btn-outline:hover {
        background: var(--sp-sky);
        color: #fff;
        box-shadow: 6px 6px 0 var(--sp-dark);
    }
    #tpl-sprout .sp-btn-ghost {
        background: transparent;
        color: var(--sp-dark);
        border-color: transparent;
    }
    #tpl-sprout .sp-btn-ghost:hover {
        background: var(--sp-cream);
        border-color: var(--sp-dark);
    }

    /* ── Sticker badges ──────────────────────────────────────────────────── */
    #tpl-sprout .sp-sticker {
        display: inline-block;
        padding: .2rem .75rem;
        border-radius: 9999px;
        border: 2px solid var(--sp-dark);
        font-family: 'Fredoka', sans-serif;
        font-size: .78rem;
        font-weight: 600;
        line-height: 1.6;
        transform: rotate(-2deg);
        white-space: nowrap;
    }
    #tpl-sprout .sp-sticker-alt {
        transform: rotate(2deg);
    }

    /* ── Blob / shape decorations ────────────────────────────────────────── */
    #tpl-sprout .sp-blob {
        position: absolute;
        border-radius: 60% 40% 70% 30% / 50% 60% 40% 50%;
        pointer-events: none;
    }
    #tpl-sprout .sp-star {
        position: absolute;
        width: 2.2rem;
        height: 2.2rem;
        clip-path: polygon(50% 0%,61% 35%,98% 35%,68% 57%,79% 91%,50% 70%,21% 91%,32% 57%,2% 35%,39% 35%);
        pointer-events: none;
    }
    #tpl-sprout .sp-dot {
        position: absolute;
        border-radius: 50%;
        pointer-events: none;
    }
    #tpl-sprout .sp-squiggle {
        position: absolute;
        width: 5rem;
        height: 5rem;
        border: 4px solid currentColor;
        border-radius: 50% 70% 50% 70%;
        pointer-events: none;
        opacity: .55;
    }
    #tpl-sprout .sp-rotated-square {
        position: absolute;
        border-radius: .35rem;
        transform: rotate(45deg);
        pointer-events: none;
    }

    /* ── Confetti strip ──────────────────────────────────────────────────── */
    #tpl-sprout .sp-confetti-row {
        display: flex;
        gap: .9rem;
        flex-wrap: wrap;
        justify-content: center;
    }
    #tpl-sprout .sp-confetti-dot {
        width: .6rem;
        height: .6rem;
        border-radius: 50%;
    }

    /* ── Progress bar override colors ───────────────────────────────────── */
    #tpl-sprout .sp-progress-wrap .sp-progress-bar {
        height: 10px;
        border-radius: 9999px;
        background: #e8e3ff;
        overflow: hidden;
        border: 1.5px solid var(--sp-dark);
    }
    #tpl-sprout .sp-progress-wrap .sp-progress-fill {
        height: 100%;
        border-radius: 9999px;
        transition: width .6s cubic-bezier(.34,1.56,.64,1);
    }

    /* ── Nav override ────────────────────────────────────────────────────── */
    #tpl-sprout .sp-nav {
        background: var(--sp-cream);
        border-bottom: 2px solid var(--sp-dark);
    }

    /* ── Section helpers ─────────────────────────────────────────────────── */
    #tpl-sprout .sp-section-label {
        display: inline-block;
        font-family: 'Fredoka', sans-serif;
        font-size: .8rem;
        font-weight: 700;
        letter-spacing: .1em;
        text-transform: uppercase;
    }

    /* ── Testimonial card quote ──────────────────────────────────────────── */
    #tpl-sprout .sp-quote::before {
        content: '"';
        font-family: 'Fredoka', serif;
        font-size: 3rem;
        line-height: 1;
        color: var(--sp-sky);
        display: block;
        margin-bottom: .25rem;
    }

    /* ── Reduced motion ──────────────────────────────────────────────────── */
    @media (prefers-reduced-motion: reduce) {
        #tpl-sprout .sp-card,
        #tpl-sprout .sp-btn,
        #tpl-sprout .sp-progress-wrap .sp-progress-fill {
            transition: none !important;
        }
        #tpl-sprout .sp-card:hover {
            transform: none !important;
        }
        #tpl-sprout .sp-btn:hover {
            transform: none !important;
        }
    }

    /* ── Course card image ───────────────────────────────────────────────── */
    #tpl-sprout .sp-course-img {
        aspect-ratio: 16/9;
        object-fit: cover;
        width: 100%;
        border-radius: .75rem .75rem 0 0;
        display: block;
    }

    /* ── Calendar cell override ──────────────────────────────────────────── */
    #tpl-sprout .sp-schedule-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: .75rem;
    }
    @media (max-width: 640px) {
        #tpl-sprout .sp-schedule-grid {
            grid-template-columns: repeat(4, 1fr);
        }
    }
    #tpl-sprout .sp-schedule-cell {
        border: 2px solid var(--sp-dark);
        border-radius: 1rem;
        padding: .75rem .5rem;
        text-align: center;
        background: #fff;
        transition: transform .18s cubic-bezier(.34,1.56,.64,1);
    }
    #tpl-sprout .sp-schedule-cell:hover {
        transform: translateY(-4px);
    }

    /* ── Pricing card ────────────────────────────────────────────────────── */
    #tpl-sprout .sp-pricing-highlight {
        background: var(--sp-dark);
        color: #fff;
        border-color: var(--sp-dark);
    }
    #tpl-sprout .sp-pricing-highlight .sp-btn-outline {
        background: var(--sp-sunny);
        border-color: var(--sp-sunny);
        color: var(--sp-dark);
        box-shadow: 4px 4px 0 rgba(255,255,255,.3);
    }
    #tpl-sprout .sp-pricing-highlight .sp-btn-outline:hover {
        background: #fff;
        color: var(--sp-dark);
    }

    /* ── FAQ accordion override ──────────────────────────────────────────── */
    #tpl-sprout .sp-faq [data-slot="accordion-trigger"] {
        font-family: 'Fredoka', sans-serif;
        font-size: 1.05rem;
        font-weight: 600;
        color: var(--sp-dark);
    }
    #tpl-sprout .sp-faq [data-slot="accordion-content"] > div {
        color: #4a4260;
        font-size: .95rem;
    }

    /* ── Masthead bg for hero ────────────────────────────────────────────── */
    #tpl-sprout .sp-hero-bg {
        background: linear-gradient(160deg, #e8f8ff 0%, #fffdf7 55%, #fff7e6 100%);
    }
</style>

<div id="tpl-sprout">

    {{-- ════════════════════════════════════════════════════════════════════
         NAV
         ════════════════════════════════════════════════════════════════════ --}}
    <header class="sp-nav sticky top-0 z-40">
        <div class="mx-auto flex h-16 max-w-6xl items-center gap-4 px-5">
            {{-- Logo --}}
            <a href="#" class="flex items-center gap-2 sp-heading text-xl" style="color:var(--sp-dark)">
                <span class="flex h-9 w-9 items-center justify-center rounded-full border-2 text-lg" style="background:var(--sp-grass);border-color:var(--sp-dark);">🌱</span>
                Sprout
            </a>

            {{-- Desktop links --}}
            <nav class="ml-6 hidden items-center gap-1 text-sm md:flex">
                @foreach (['Subjects' => '#subjects', 'Courses' => '#courses', 'Pricing' => '#pricing', 'FAQ' => '#faq'] as $label => $href)
                    <a href="{{ $href }}" class="sp-btn sp-btn-ghost text-sm px-3 py-1.5" style="font-size:.875rem;padding:.35rem .9rem">{{ $label }}</a>
                @endforeach
            </nav>

            <div class="ml-auto flex items-center gap-2">
                <x-ui.tooltip>
                    <x-ui.tooltip-trigger>
                        <a href="#pricing" class="sp-btn sp-btn-outline text-sm hidden sm:inline-flex" style="padding:.4rem 1.1rem;font-size:.875rem">Log in</a>
                    </x-ui.tooltip-trigger>
                    <x-ui.tooltip-content>Access your family dashboard</x-ui.tooltip-content>
                </x-ui.tooltip>
                <a href="#pricing" class="sp-btn sp-btn-primary text-sm hidden sm:inline-flex" style="padding:.4rem 1.1rem;font-size:.875rem">Start free 🚀</a>
            </div>
        </div>
    </header>

    {{-- ════════════════════════════════════════════════════════════════════
         HERO
         ════════════════════════════════════════════════════════════════════ --}}
    <section class="sp-hero-bg relative overflow-hidden py-16 lg:py-24">
        {{-- Blob decorations --}}
        <div class="sp-blob" style="width:28rem;height:22rem;background:var(--sp-sky);opacity:.12;top:-4rem;left:-6rem;"></div>
        <div class="sp-blob" style="width:18rem;height:14rem;background:var(--sp-sunny);opacity:.18;bottom:-2rem;right:-3rem;"></div>
        <div class="sp-star" style="background:var(--sp-sunny);top:3rem;right:18%;opacity:.7;"></div>
        <div class="sp-star" style="background:var(--sp-coral);bottom:5rem;left:10%;opacity:.55;width:1.6rem;height:1.6rem;"></div>
        <div class="sp-dot" style="width:1.2rem;height:1.2rem;background:var(--sp-grape);top:6rem;left:22%;opacity:.5;"></div>
        <div class="sp-dot" style="width:.8rem;height:.8rem;background:var(--sp-grass);bottom:8rem;right:30%;opacity:.6;"></div>
        <div class="sp-rotated-square" style="width:2.5rem;height:2.5rem;background:var(--sp-grass);opacity:.18;top:8rem;right:12%;"></div>
        <div class="sp-squiggle" style="color:var(--sp-coral);bottom:4rem;left:5%;"></div>

        <div class="mx-auto grid max-w-6xl items-center gap-12 px-5 lg:grid-cols-2">
            {{-- Text side --}}
            <div class="relative z-10">
                <div class="mb-4 flex items-center gap-2">
                    <span class="sp-sticker" style="background:var(--sp-sunny);color:var(--sp-dark)">✨ New — Coding for Kids!</span>
                </div>

                <h1 class="sp-heading text-4xl sm:text-5xl lg:text-6xl leading-tight" style="color:var(--sp-dark)">
                    Learning that
                    <span class="relative inline-block" style="color:var(--sp-coral)">
                        feels like play
                        <svg class="absolute -bottom-1 left-0 w-full" viewBox="0 0 200 8" fill="none" aria-hidden="true" preserveAspectRatio="none" style="height:6px">
                            <path d="M2 5 Q50 1 100 5 Q150 9 198 5" stroke="currentColor" stroke-width="3" stroke-linecap="round" fill="none"/>
                        </svg>
                    </span>
                    <br>for every child. 🌟
                </h1>

                <p class="mt-5 max-w-lg text-lg" style="color:#4a4260">
                    Sprout turns screen time into superpower time — joyful lessons, real curriculum, badges galore. Trusted by <strong style="color:var(--sp-dark)">50,000+</strong> families worldwide.
                </p>

                <div class="mt-7 flex flex-wrap gap-3">
                    <a href="#pricing" class="sp-btn sp-btn-primary text-base">Start learning free 🌱</a>
                    <a href="#courses" class="sp-btn sp-btn-outline text-base">Browse courses</a>
                </div>

                {{-- Social proof --}}
                <div class="mt-8 flex items-center gap-4">
                    <div class="flex -space-x-2.5">
                        @foreach ($parentAvatars as $img)
                            <x-ui.avatar class="ring-2 size-10" style="ring-color:#fff">
                                <x-ui.avatar-image src="{{ $img }}" alt="Happy parent" />
                                <x-ui.avatar-fallback>P</x-ui.avatar-fallback>
                            </x-ui.avatar>
                        @endforeach
                    </div>
                    <div>
                        <x-ui.rating :value="5" :readonly="true" color="text-amber-400" size="sm" />
                        <p class="text-sm mt-0.5" style="color:#4a4260">Loved by <strong style="color:var(--sp-dark)">50,000+ families</strong></p>
                    </div>
                </div>
            </div>

            {{-- Mascot / illustration side --}}
            <div class="relative flex items-center justify-center">
                {{-- Main blob mascot --}}
                <div class="relative flex h-72 w-72 lg:h-80 lg:w-80 items-center justify-center rounded-full border-4" style="background:var(--sp-sky);border-color:var(--sp-dark);box-shadow:10px 10px 0 var(--sp-sunny)">
                    <span style="font-size:7rem;line-height:1;" aria-label="Sprout mascot — a happy seedling">🌱</span>
                </div>
                {{-- Floating subject bubbles --}}
                <div class="sp-card sp-card-sunny absolute -top-4 -right-4 flex h-16 w-16 items-center justify-center rounded-full text-3xl border-2" style="border-color:var(--sp-dark);box-shadow:4px 4px 0 var(--sp-sunny)" aria-label="Maths">🔢</div>
                <div class="sp-card sp-card-grass absolute bottom-2 -left-6 flex h-14 w-14 items-center justify-center rounded-full text-2xl border-2" style="border-color:var(--sp-dark);box-shadow:4px 4px 0 var(--sp-grass)" aria-label="Science">🔬</div>
                <div class="sp-card sp-card-coral absolute top-1/4 -left-8 flex h-12 w-12 items-center justify-center rounded-full text-2xl border-2" style="border-color:var(--sp-dark);box-shadow:3px 3px 0 var(--sp-coral)" aria-label="Reading">📖</div>
                <div class="sp-card sp-card-grape absolute bottom-8 -right-6 flex h-12 w-12 items-center justify-center rounded-full text-2xl border-2" style="border-color:var(--sp-dark);box-shadow:3px 3px 0 var(--sp-grape)" aria-label="Art">🎨</div>
                {{-- Stars --}}
                <div class="sp-star" style="background:var(--sp-coral);top:-1.5rem;left:1rem;opacity:.7;"></div>
                <div class="sp-star" style="background:var(--sp-grape);bottom:-1rem;right:1rem;opacity:.6;width:1.5rem;height:1.5rem;"></div>
            </div>
        </div>

        {{-- Confetti row --}}
        <div class="sp-confetti-row mt-12 px-5" aria-hidden="true">
            @foreach (['var(--sp-sky)','var(--sp-sunny)','var(--sp-grass)','var(--sp-coral)','var(--sp-grape)','var(--sp-sky)','var(--sp-sunny)','var(--sp-grass)','var(--sp-coral)','var(--sp-grape)','var(--sp-sky)','var(--sp-sunny)','var(--sp-grass)','var(--sp-coral)','var(--sp-grape)','var(--sp-sky)','var(--sp-sunny)','var(--sp-grass)','var(--sp-coral)','var(--sp-grape)'] as $c)
                <span class="sp-confetti-dot" style="background:{{ $c }};opacity:.55"></span>
            @endforeach
        </div>
    </section>

    <x-ui.separator />

    {{-- ════════════════════════════════════════════════════════════════════
         SUBJECTS GRID
         ════════════════════════════════════════════════════════════════════ --}}
    <section id="subjects" class="scroll-mt-20 py-20" style="background:var(--sp-cream)">
        <div class="mx-auto max-w-6xl px-5">
            <div class="mb-12 text-center">
                <span class="sp-section-label sp-sticker" style="background:var(--sp-grass);color:#fff;margin-bottom:.75rem;display:inline-block">Subjects</span>
                <h2 class="mt-3 text-3xl sm:text-4xl" style="color:var(--sp-dark)">Six subjects, infinite curiosity</h2>
                <p class="mt-2 text-base" style="color:#4a4260">Every subject is packed with bite-sized lessons, quizzes and mini-games your child will actually want to finish.</p>
            </div>

            <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
                @php $shadowClasses = ['sp-card-sky','sp-card-sunny','sp-card-grass','sp-card-coral','sp-card-grape','sp-card-sky']; @endphp
                @foreach ($subjects as $i => $subj)
                    <div class="sp-card {{ $shadowClasses[$i] }} p-6 flex flex-col gap-3">
                        <div class="flex items-start justify-between">
                            <div class="flex h-14 w-14 items-center justify-center rounded-2xl border-2 text-3xl" style="background:{{ $subj['color'] }}20;border-color:{{ $subj['color'] }}" aria-hidden="true">{{ $subj['emoji'] }}</div>
                            <x-ui.badge class="sp-sticker-alt" style="background:{{ $subj['color'] }};color:var(--sp-dark);border:2px solid var(--sp-dark);border-radius:9999px;font-family:'Fredoka',sans-serif;font-weight:600">{{ $subj['badge'] }}</x-ui.badge>
                        </div>
                        <h3 class="text-xl" style="color:var(--sp-dark)">{{ $subj['label'] }}</h3>
                        <p class="text-sm flex-1" style="color:#4a4260">{{ $subj['desc'] }}</p>
                        <div class="flex items-center justify-between pt-1">
                            <span class="text-xs font-semibold" style="color:#4a4260">{{ $subj['lessons'] }} lessons</span>
                            <a href="#courses" class="sp-btn sp-btn-ghost text-sm" style="padding:.2rem .75rem;font-size:.82rem;border-color:{{ $subj['color'] }};color:var(--sp-dark)">Explore →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-ui.separator />

    {{-- ════════════════════════════════════════════════════════════════════
         HOW IT WORKS — STEPPER
         ════════════════════════════════════════════════════════════════════ --}}
    <section id="how" class="scroll-mt-20 py-20" style="background:#f0faf2">
        <div class="mx-auto max-w-4xl px-5">
            <div class="mb-12 text-center">
                <span class="sp-section-label sp-sticker" style="background:var(--sp-sky);color:#fff;display:inline-block;margin-bottom:.75rem">How it works</span>
                <h2 class="mt-3 text-3xl sm:text-4xl" style="color:var(--sp-dark)">From zero to hero in 4 easy steps</h2>
            </div>

            <x-ui.stepper :value="4" class="w-full" style="--tw-ring-color:var(--sp-grass)">
                <x-ui.stepper-nav>
                    @foreach ($steps as $s)
                        <x-ui.stepper-item :step="$s['num']">
                            <x-ui.stepper-trigger>
                                <x-ui.stepper-indicator style="background:{{ $s['color'] }};border-color:var(--sp-dark);color:var(--sp-dark);font-family:'Fredoka',sans-serif;font-weight:700" />
                            </x-ui.stepper-trigger>
                            @if (!$loop->last)
                                <x-ui.stepper-separator style="background:var(--sp-dark);opacity:.25" />
                            @endif
                        </x-ui.stepper-item>
                    @endforeach
                </x-ui.stepper-nav>

                <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($steps as $s)
                        <div class="sp-card p-5 text-center flex flex-col items-center gap-3" style="box-shadow:6px 6px 0 {{ $s['color'] }}">
                            <div class="flex h-12 w-12 items-center justify-center rounded-full border-2 text-xl font-bold sp-heading" style="background:{{ $s['color'] }};border-color:var(--sp-dark);color:var(--sp-dark)">{{ $s['num'] }}</div>
                            <h3 class="text-base" style="color:var(--sp-dark)">{{ $s['title'] }}</h3>
                            <p class="text-xs" style="color:#4a4260">{{ $s['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </x-ui.stepper>
        </div>
    </section>

    <x-ui.separator />

    {{-- ════════════════════════════════════════════════════════════════════
         GAMIFICATION PANEL
         ════════════════════════════════════════════════════════════════════ --}}
    <section id="gamification" class="scroll-mt-20 py-20" style="background:var(--sp-cream)">
        <div class="mx-auto max-w-5xl px-5">
            <div class="mb-12 text-center">
                <span class="sp-section-label sp-sticker" style="background:var(--sp-coral);color:#fff;display:inline-block;margin-bottom:.75rem">Achievements</span>
                <h2 class="mt-3 text-3xl sm:text-4xl" style="color:var(--sp-dark)">Earn badges, build confidence</h2>
                <p class="mt-2 text-base" style="color:#4a4260">Every lesson earns stars. Every milestone unlocks a new badge. Kids see real progress — and love it.</p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($achievements as $ach)
                    <div class="sp-card p-5" style="box-shadow:6px 6px 0 {{ $ach['earned'] ? $ach['color'] : '#ccc' }}">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center gap-2.5">
                                <span class="text-2xl" aria-hidden="true">{{ $ach['icon'] }}</span>
                                <span class="font-semibold sp-heading text-base" style="color:var(--sp-dark)">{{ $ach['label'] }}</span>
                            </div>
                            @if ($ach['earned'])
                                <x-ui.badge class="sp-sticker" style="background:var(--sp-grass);color:#fff;border:2px solid var(--sp-dark);font-family:'Fredoka',sans-serif">Earned!</x-ui.badge>
                            @else
                                <span class="text-xs font-semibold" style="color:#4a4260">{{ $ach['progress'] }}%</span>
                            @endif
                        </div>
                        <div class="sp-progress-wrap">
                            <div class="sp-progress-bar">
                                <div class="sp-progress-fill" style="width:{{ $ach['progress'] }}%;background:{{ $ach['color'] }}"></div>
                            </div>
                        </div>
                        <p class="mt-2 text-xs" style="color:#6b5c8a">
                            @if ($ach['earned'])
                                Congratulations! Keep exploring to unlock more.
                            @else
                                {{ 100 - $ach['progress'] }}% more to unlock this badge.
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>

            {{-- XP / streak row --}}
            <div class="mt-10 grid gap-5 sm:grid-cols-3 text-center">
                @foreach ([['🔥','14-day streak','You\'re on fire!','var(--sp-coral)'],['⭐','320 stars earned','Keep collecting!','var(--sp-sunny)'],['🏆','3 badges unlocked','2 more to discover','var(--sp-grape)']] as [$ico,$val,$sub,$col])
                    <div class="sp-card p-6" style="box-shadow:6px 6px 0 {{ $col }}">
                        <div class="text-4xl mb-1" aria-hidden="true">{{ $ico }}</div>
                        <div class="sp-heading text-lg" style="color:var(--sp-dark)">{{ $val }}</div>
                        <div class="text-xs mt-1" style="color:#4a4260">{{ $sub }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-ui.separator />

    {{-- ════════════════════════════════════════════════════════════════════
         COURSES BY AGE — TABS
         ════════════════════════════════════════════════════════════════════ --}}
    <section id="courses" class="scroll-mt-20 py-20" style="background:#fef9ff">
        <div class="mx-auto max-w-6xl px-5">
            <div class="mb-10 text-center">
                <span class="sp-section-label sp-sticker" style="background:var(--sp-grape);color:#fff;display:inline-block;margin-bottom:.75rem">Courses</span>
                <h2 class="mt-3 text-3xl sm:text-4xl" style="color:var(--sp-dark)">Every age, a whole new adventure</h2>
                <p class="mt-2 text-base" style="color:#4a4260">Pick your learner's age band and browse curated course paths — content adapts automatically as they level up.</p>
            </div>

            <x-ui.tabs value="tiny" class="w-full">
                <x-ui.tabs-list variant="pills" class="mx-auto mb-8 flex justify-center gap-2 flex-wrap">
                    @foreach ($courses as $key => $group)
                        <x-ui.tabs-trigger value="{{ $key }}" style="font-family:'Fredoka',sans-serif;font-size:1rem">
                            {{ $group['label'] }}
                            <x-ui.badge class="ml-1" style="background:var(--sp-sky);color:#fff;border:none;font-family:'Fredoka',sans-serif">{{ $group['range'] }}</x-ui.badge>
                        </x-ui.tabs-trigger>
                    @endforeach
                </x-ui.tabs-list>

                @foreach ($courses as $key => $group)
                    <x-ui.tabs-content value="{{ $key }}">
                        <div class="grid gap-7 sm:grid-cols-2 lg:grid-cols-3">
                            @php $cShadows = ['sp-card-sky','sp-card-sunny','sp-card-grape']; @endphp
                            @foreach ($group['items'] as $ci => $course)
                                <div class="sp-card {{ $cShadows[$ci] }} overflow-hidden flex flex-col">
                                    <img src="{{ $course['img'] }}" alt="{{ $course['title'] }}" class="sp-course-img" loading="lazy" />
                                    <div class="p-5 flex flex-col flex-1 gap-3">
                                        <div class="flex items-center justify-between">
                                            <x-ui.badge style="background:{{ $course['color'] }};color:var(--sp-dark);border:2px solid var(--sp-dark);font-family:'Fredoka',sans-serif;border-radius:9999px">{{ $course['subject'] }}</x-ui.badge>
                                            <span class="text-xs font-semibold" style="color:#4a4260">{{ $course['lessons'] }} lessons</span>
                                        </div>
                                        <h3 class="text-lg" style="color:var(--sp-dark)">{{ $course['title'] }}</h3>
                                        <div class="mt-auto pt-2">
                                            <a href="#pricing" class="sp-btn sp-btn-primary w-full text-sm justify-center" style="padding:.45rem .9rem;font-size:.875rem">Start course →</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </x-ui.tabs-content>
                @endforeach
            </x-ui.tabs>
        </div>
    </section>

    <x-ui.separator />

    {{-- ════════════════════════════════════════════════════════════════════
         WEEKLY SCHEDULE
         ════════════════════════════════════════════════════════════════════ --}}
    <section id="schedule" class="scroll-mt-20 py-20" style="background:var(--sp-cream)">
        <div class="mx-auto max-w-5xl px-5">
            <div class="mb-10 text-center">
                <span class="sp-section-label sp-sticker" style="background:var(--sp-sunny);color:var(--sp-dark);display:inline-block;margin-bottom:.75rem">Schedule</span>
                <h2 class="mt-3 text-3xl sm:text-4xl" style="color:var(--sp-dark)">A joyful learning week</h2>
                <p class="mt-2 text-base" style="color:#4a4260">Set a weekly rhythm and Sprout sends gentle reminders so the streak never breaks.</p>
            </div>

            <div class="sp-schedule-grid">
                @foreach ($schedule as $day)
                    <x-ui.tooltip>
                        <x-ui.tooltip-trigger>
                            <div class="sp-schedule-cell" style="box-shadow:5px 5px 0 {{ $day['color'] }}">
                                <div class="sp-heading text-sm mb-1" style="color:#4a4260">{{ $day['day'] }}</div>
                                <div class="text-3xl my-1" aria-hidden="true">{{ $day['emoji'] }}</div>
                                <div class="sp-heading text-xs font-bold" style="color:var(--sp-dark)">{{ $day['subject'] }}</div>
                                <div class="text-xs mt-1" style="color:#4a4260">{{ $day['time'] }}</div>
                            </div>
                        </x-ui.tooltip-trigger>
                        <x-ui.tooltip-content side="top" style="background:var(--sp-dark);color:#fff;font-family:'Fredoka',sans-serif">
                            {{ $day['subject'] }} at {{ $day['time'] }}
                        </x-ui.tooltip-content>
                    </x-ui.tooltip>
                @endforeach
            </div>

            <p class="mt-8 text-center text-sm" style="color:#4a4260">
                <x-lucide-calendar class="inline-block size-4 mr-1 align-text-top" style="color:var(--sp-sky)" />
                You can personalise every day's subject and time from your parent dashboard.
            </p>
        </div>
    </section>

    <x-ui.separator />

    {{-- ════════════════════════════════════════════════════════════════════
         TESTIMONIALS — CAROUSEL
         ════════════════════════════════════════════════════════════════════ --}}
    <section id="testimonials" class="scroll-mt-20 py-20" style="background:#f0faf2">
        <div class="mx-auto max-w-5xl px-5">
            <div class="mb-10 text-center">
                <span class="sp-section-label sp-sticker" style="background:var(--sp-coral);color:#fff;display:inline-block;margin-bottom:.75rem">Parents love it</span>
                <h2 class="mt-3 text-3xl sm:text-4xl" style="color:var(--sp-dark)">Real words from real families</h2>
            </div>

            <x-ui.carousel class="w-full max-w-3xl mx-auto">
                <x-ui.carousel-content>
                    @foreach ($testimonials as $t)
                        <x-ui.carousel-item>
                            <div class="sp-card sp-card-sky p-8 flex flex-col gap-5">
                                <x-ui.rating :value="$t['stars']" :readonly="true" color="text-amber-400" />
                                <p class="sp-quote text-base leading-relaxed" style="color:#2b2440">"{{ $t['q'] }}"</p>
                                <div class="flex items-center gap-3 mt-auto pt-2">
                                    <x-ui.avatar class="size-12 border-2" style="border-color:var(--sp-dark)">
                                        <x-ui.avatar-image src="{{ $t['img'] }}" alt="{{ $t['name'] }}" />
                                        <x-ui.avatar-fallback style="background:var(--sp-sky);color:#fff">{{ substr($t['name'],0,1) }}</x-ui.avatar-fallback>
                                    </x-ui.avatar>
                                    <div>
                                        <div class="font-bold sp-heading text-sm" style="color:var(--sp-dark)">{{ $t['name'] }}</div>
                                        <div class="text-xs" style="color:#4a4260">{{ $t['role'] }}</div>
                                    </div>
                                </div>
                            </div>
                        </x-ui.carousel-item>
                    @endforeach
                </x-ui.carousel-content>
                <div class="mt-6 flex justify-center gap-3">
                    <x-ui.carousel-previous class="static translate-y-0 border-2" style="border-color:var(--sp-dark);background:var(--sp-sunny);color:var(--sp-dark)" />
                    <x-ui.carousel-next class="static translate-y-0 border-2" style="border-color:var(--sp-dark);background:var(--sp-sky);color:#fff" />
                </div>
            </x-ui.carousel>
        </div>
    </section>

    <x-ui.separator />

    {{-- ════════════════════════════════════════════════════════════════════
         PRICING
         ════════════════════════════════════════════════════════════════════ --}}
    <section id="pricing" class="scroll-mt-20 py-20" style="background:var(--sp-cream)" x-data="{ yearly: false }">
        <div class="mx-auto max-w-6xl px-5">
            <div class="mb-10 text-center">
                <span class="sp-section-label sp-sticker" style="background:var(--sp-grape);color:#fff;display:inline-block;margin-bottom:.75rem">Pricing</span>
                <h2 class="mt-3 text-3xl sm:text-4xl" style="color:var(--sp-dark)">Grow together, for less</h2>
                <p class="mt-2 text-base" style="color:#4a4260">All plans include a free 14-day trial. No credit card needed for Seedling.</p>

                {{-- Billing toggle --}}
                <div class="mt-6 inline-flex items-center gap-3">
                    <span class="text-sm font-semibold" style="color:var(--sp-dark)">Monthly</span>
                    <x-ui.switch :checked="false" x-model="yearly" @click="yearly = !yearly" />
                    <span class="text-sm font-semibold" style="color:var(--sp-dark)">Annual
                        <x-ui.badge class="ml-1 sp-sticker" style="background:var(--sp-grass);color:#fff;border:2px solid var(--sp-dark);font-family:'Fredoka',sans-serif">Save 20%</x-ui.badge>
                    </span>
                </div>
            </div>

            <div class="grid gap-8 items-stretch lg:grid-cols-3">
                @php $pShadows = ['sp-card-sky','sp-card-sunny','sp-card-grape']; @endphp
                @foreach ($plans as $pi => $plan)
                    <div class="sp-card {{ $pShadows[$pi] }} p-7 flex flex-col gap-5 {{ $plan['highlight'] ? 'sp-pricing-highlight' : '' }}">
                        @if ($plan['badge'])
                            <div class="-mt-10 mb-1 flex justify-center">
                                <span class="sp-sticker" style="background:var(--sp-coral);color:#fff;border:2px solid var(--sp-dark);font-family:'Fredoka',sans-serif">{{ $plan['badge'] }}</span>
                            </div>
                        @endif
                        <h3 class="sp-heading text-2xl" style="{{ $plan['highlight'] ? 'color:#fff' : 'color:var(--sp-dark)' }}">{{ $plan['name'] }}</h3>
                        <div class="flex items-baseline gap-1">
                            <span class="sp-heading text-4xl" style="{{ $plan['highlight'] ? 'color:#fff' : 'color:var(--sp-dark)' }}">
                                $<span x-text="yearly ? {{ $plan['annual'] }} : {{ $plan['monthly'] }}">{{ $plan['monthly'] }}</span>
                            </span>
                            <span class="text-sm" style="{{ $plan['highlight'] ? 'color:rgba(255,255,255,.7)' : 'color:#4a4260' }}">/mo</span>
                        </div>
                        <a href="#" class="sp-btn sp-btn-outline w-full justify-center text-sm" style="padding:.5rem .9rem">{{ $plan['cta'] }}</a>
                        <x-ui.separator style="{{ $plan['highlight'] ? 'background:rgba(255,255,255,.2)' : '' }}" />
                        <ul class="space-y-2.5 text-sm flex-1">
                            @foreach ($plan['features'] as $feat)
                                <li class="flex items-center gap-2">
                                    <span class="text-base" aria-hidden="true">✅</span>
                                    <span style="{{ $plan['highlight'] ? 'color:rgba(255,255,255,.9)' : 'color:#2b2440' }}">{{ $feat }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <x-ui.separator />

    {{-- ════════════════════════════════════════════════════════════════════
         FAQ — ACCORDION
         ════════════════════════════════════════════════════════════════════ --}}
    <section id="faq" class="scroll-mt-20 py-20" style="background:#fef9ff">
        <div class="mx-auto max-w-3xl px-5">
            <div class="mb-10 text-center">
                <span class="sp-section-label sp-sticker" style="background:var(--sp-sky);color:#fff;display:inline-block;margin-bottom:.75rem">FAQ</span>
                <h2 class="mt-3 text-3xl sm:text-4xl" style="color:var(--sp-dark)">Questions from curious parents 🤔</h2>
            </div>

            <div class="sp-faq">
                <x-ui.accordion type="single" collapsible class="w-full" style="--tw-ring-color:var(--sp-sky)">
                    @foreach ($faqs as $i => $faq)
                        <x-ui.accordion-item value="sfaq-{{ $i }}" style="border-color:rgba(43,36,64,.15)">
                            <x-ui.accordion-trigger>{{ $faq['q'] }}</x-ui.accordion-trigger>
                            <x-ui.accordion-content>{{ $faq['a'] }}</x-ui.accordion-content>
                        </x-ui.accordion-item>
                    @endforeach
                </x-ui.accordion>
            </div>
        </div>
    </section>

    <x-ui.separator />

    {{-- ════════════════════════════════════════════════════════════════════
         CTA BANNER
         ════════════════════════════════════════════════════════════════════ --}}
    <section class="py-20" style="background:var(--sp-cream)">
        <div class="mx-auto max-w-5xl px-5">
            <div class="sp-card p-10 lg:p-16 text-center relative overflow-hidden" style="background:var(--sp-dark);border-color:var(--sp-dark);box-shadow:10px 10px 0 var(--sp-sunny)">
                {{-- Decorations inside CTA --}}
                <div class="sp-star" style="background:var(--sp-sunny);top:1.5rem;left:2rem;opacity:.8;"></div>
                <div class="sp-star" style="background:var(--sp-sky);bottom:2rem;right:3rem;opacity:.65;width:1.8rem;height:1.8rem;"></div>
                <div class="sp-dot" style="width:1rem;height:1rem;background:var(--sp-coral);top:3rem;right:8%;opacity:.6;"></div>
                <div class="sp-blob" style="width:14rem;height:10rem;background:var(--sp-sky);opacity:.07;top:-3rem;right:-2rem;"></div>

                <div class="relative z-10">
                    <div class="text-5xl mb-4" aria-hidden="true">🌟</div>
                    <h2 class="sp-heading text-3xl sm:text-4xl mb-4" style="color:#fff">Your child's learning adventure starts today</h2>
                    <p class="text-base mb-8 max-w-xl mx-auto" style="color:rgba(255,255,255,.75)">Join 50,000+ families who have made screen time something they're proud of. Free to start — no credit card, no stress.</p>
                    <div class="flex flex-wrap gap-4 justify-center">
                        <a href="#pricing" class="sp-btn" style="background:var(--sp-sunny);color:var(--sp-dark);border-color:var(--sp-sunny);box-shadow:5px 5px 0 rgba(255,255,255,.25);font-size:1rem;padding:.65rem 1.75rem">Start for free 🌱</a>
                        <a href="#subjects" class="sp-btn" style="background:transparent;color:#fff;border-color:rgba(255,255,255,.4);font-size:1rem;padding:.65rem 1.75rem">Browse subjects</a>
                    </div>
                    <p class="mt-5 text-xs" style="color:rgba(255,255,255,.45)">No commitment. Cancel anytime. COPPA &amp; GDPR compliant.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- ════════════════════════════════════════════════════════════════════
         FOOTER
         ════════════════════════════════════════════════════════════════════ --}}
    <footer style="background:var(--sp-dark);color:rgba(255,255,255,.75)">
        <div class="mx-auto max-w-6xl px-5 py-14">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-6">
                <div class="lg:col-span-2">
                    <a href="#" class="flex items-center gap-2 sp-heading text-xl" style="color:#fff">
                        <span class="flex h-9 w-9 items-center justify-center rounded-full border-2 text-lg" style="background:var(--sp-grass);border-color:rgba(255,255,255,.3)">🌱</span>
                        Sprout
                    </a>
                    <p class="mt-3 text-sm max-w-xs" style="color:rgba(255,255,255,.55)">Joyful learning for every child aged 3–14. Trusted by families in 60+ countries.</p>
                    <div class="mt-4 flex gap-2">
                        @foreach (['twitter','instagram','youtube','facebook'] as $net)
                            <a href="#" aria-label="{{ $net }}" class="inline-flex h-9 w-9 items-center justify-center rounded-full border text-sm transition-colors hover:border-white" style="border-color:rgba(255,255,255,.25);color:rgba(255,255,255,.65)">
                                <x-dynamic-component :component="'lucide-'.$net" class="size-4" />
                            </a>
                        @endforeach
                    </div>
                </div>

                @foreach ($footerLinks as $heading => $links)
                    <div>
                        <h3 class="sp-heading text-sm mb-3" style="color:#fff">{{ $heading }}</h3>
                        <ul class="space-y-2 text-sm">
                            @foreach ($links as $link)
                                <li><a href="#" class="transition-colors hover:text-white" style="color:rgba(255,255,255,.55)">{{ $link }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <x-ui.separator class="my-8" style="background:rgba(255,255,255,.12)" />

            <div class="flex flex-col items-center justify-between gap-3 text-sm sm:flex-row" style="color:rgba(255,255,255,.4)">
                <span>© {{ date('Y') }} Sprout Learning Ltd. All rights reserved.</span>
                <span class="flex items-center gap-1.5">
                    <x-lucide-shield-check class="size-4" style="color:var(--sp-grass)" />
                    COPPA compliant · GDPR ready · Ad-free for kids
                </span>
            </div>
        </div>
    </footer>

</div>
</x-layouts.app>
