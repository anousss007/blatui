@php
    $navLinks = [
        'Specialties' => '#specialties',
        'How it works' => '#how-it-works',
        'Doctors'      => '#doctors',
        'Plans'        => '#plans',
        'FAQ'          => '#faq',
    ];

    $trustBadges = [
        ['icon' => 'shield-check',    'label' => 'HIPAA Compliant'],
        ['icon' => 'lock',            'label' => 'End-to-end encrypted'],
        ['icon' => 'award',           'label' => 'Board-certified MDs'],
        ['icon' => 'clock',           'label' => '24 / 7 care'],
    ];

    $heroAvatars = [
        ['seed' => 'doc1', 'alt' => 'Dr. Amara Osei'],
        ['seed' => 'doc2', 'alt' => 'Dr. Lena Park'],
        ['seed' => 'doc3', 'alt' => 'Dr. Carlos Rivera'],
        ['seed' => 'doc4', 'alt' => 'Dr. Sophie Nguyen'],
    ];

    $specialties = [
        ['icon' => 'heart-pulse',     'name' => 'Cardiology',       'desc' => 'Heart health checks, ECG review and chronic condition management.'],
        ['icon' => 'brain',           'name' => 'Mental Health',     'desc' => 'Therapy, counseling and psychiatric consultations — all remote.'],
        ['icon' => 'baby',            'name' => 'Pediatrics',        'desc' => 'Well-child visits, vaccinations and urgent care for little ones.'],
        ['icon' => 'bone',            'name' => 'Orthopedics',       'desc' => 'Sports injuries, joint pain and rehabilitation guidance.'],
        ['icon' => 'stethoscope',     'name' => 'Primary Care',      'desc' => 'Annual exams, sick visits and ongoing chronic disease management.'],
        ['icon' => 'eye',             'name' => 'Ophthalmology',     'desc' => 'Vision screening, eye-strain consults and referrals.'],
        ['icon' => 'pill',            'name' => 'Dermatology',       'desc' => 'Skin conditions, acne treatment and prescription renewals.'],
        ['icon' => 'activity',        'name' => 'Nutrition',         'desc' => 'Personalised diet plans and metabolic health coaching.'],
    ];

    $steps = [
        ['title' => 'Book in 60 seconds', 'desc' => 'Choose a specialty, pick a slot and share your symptoms — no phone calls.', 'icon' => 'calendar-check'],
        ['title' => 'Meet your doctor',   'desc' => 'HD video visit on any device. Secure, private and recorded for your records.', 'icon' => 'video'],
        ['title' => 'Get your care plan', 'desc' => 'Prescriptions, referrals and follow-up notes delivered directly to your app.', 'icon' => 'file-text'],
        ['title' => 'Stay connected',     'desc' => 'Message your care team anytime, track your goals and book the next visit.', 'icon' => 'message-circle'],
    ];

    $specialtyOptions = [
        'cardiology'    => 'Cardiology',
        'mental-health' => 'Mental Health',
        'pediatrics'    => 'Pediatrics',
        'orthopedics'   => 'Orthopedics',
        'primary-care'  => 'Primary Care',
        'dermatology'   => 'Dermatology',
    ];

    $doctors = [
        [
            'name'       => 'Dr. Amara Osei',
            'specialty'  => 'Cardiology',
            'rating'     => 4.9,
            'reviews'    => 214,
            'seed'       => 'doc-amara',
            'bio'        => 'Board-certified cardiologist with 14 years at Johns Hopkins. Sub-specialises in preventive heart health and heart failure management.',
            'languages'  => ['English', 'French'],
            'available'  => 'Today',
        ],
        [
            'name'       => 'Dr. Lena Park',
            'specialty'  => 'Mental Health',
            'rating'     => 5.0,
            'reviews'    => 189,
            'seed'       => 'doc-lena',
            'bio'        => 'Licensed psychiatrist and CBT practitioner. Former faculty at UCSF. Passionate about eliminating stigma and making mental healthcare accessible.',
            'languages'  => ['English', 'Korean'],
            'available'  => 'Tomorrow',
        ],
        [
            'name'       => 'Dr. Carlos Rivera',
            'specialty'  => 'Pediatrics',
            'rating'     => 4.8,
            'reviews'    => 302,
            'seed'       => 'doc-carlos',
            'bio'        => 'Pediatrician with 10 years in community health. Fluent in three languages, specialising in developmental milestones and adolescent medicine.',
            'languages'  => ['English', 'Spanish', 'Portuguese'],
            'available'  => 'Today',
        ],
        [
            'name'       => 'Dr. Sophie Nguyen',
            'specialty'  => 'Dermatology',
            'rating'     => 4.7,
            'reviews'    => 147,
            'seed'       => 'doc-sophie',
            'bio'        => 'Dermatologist specialising in medical and cosmetic skin conditions. Certified in Mohs surgery and telederm consultations.',
            'languages'  => ['English', 'Vietnamese'],
            'available'  => 'In 2 days',
        ],
    ];

    $healthGoals = [
        ['label' => 'Daily steps',       'value' => 78,  'color' => '#2563eb'],
        ['label' => 'Sleep quality',     'value' => 85,  'color' => '#34d399'],
        ['label' => 'Water intake',      'value' => 62,  'color' => '#0ea5e9'],
        ['label' => 'Mindfulness',       'value' => 50,  'color' => '#a78bfa'],
    ];

    $chartSeries = [['name' => 'Heart Rate', 'data' => [72, 75, 71, 78, 74, 70, 73, 76, 72, 69, 74, 71]]];
    $chartOptions = [
        'xaxis'  => ['categories' => ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']],
        'fill'   => ['type' => 'gradient', 'gradient' => ['shadeIntensity' => 1, 'opacityFrom' => 0.35, 'opacityTo' => 0.05, 'stops' => [0, 100]]],
        'stroke' => ['width' => 2, 'curve' => 'smooth'],
        'yaxis'  => ['show' => false, 'min' => 60, 'max' => 90],
        'grid'   => ['show' => false],
        'tooltip'=> ['theme' => 'light'],
    ];

    $testimonials = [
        [
            'q'    => 'I saw a cardiologist within four hours of noticing chest tightness. The care was thorough, the prescription was in my pharmacy by evening. Pulse might have saved my life.',
            'a'    => 'Marcus Holloway',
            'role' => 'Patient — Cardiology',
            'img'  => 'https://picsum.photos/seed/pt-marcus/160/160',
        ],
        [
            'q'    => 'As a mom of three I have zero time. Pulse means my kids get a pediatrician at 10 pm without a waiting-room nightmare. We\'ve used it six times and it\'s perfect every time.',
            'a'    => 'Yvonne Beaumont',
            'role' => 'Patient — Pediatrics',
            'img'  => 'https://picsum.photos/seed/pt-yvonne/160/160',
        ],
        [
            'q'    => 'My therapist on Pulse truly listens. The notes she shares after each session are more thorough than anything I got in years of in-person care.',
            'a'    => 'Dae-Jung Kim',
            'role' => 'Patient — Mental Health',
            'img'  => 'https://picsum.photos/seed/pt-daejung/160/160',
        ],
    ];

    $partners = ['BlueCross', 'Aetna', 'Cigna', 'United', 'Humana', 'Kaiser', 'Anthem', 'Centene'];

    $plans = [
        [
            'name'      => 'Basic',
            'monthly'   => 0,
            'yearly'    => 0,
            'tag'       => 'Always free',
            'cta'       => 'Get started free',
            'highlight' => false,
            'features'  => ['1 visit / month', 'Primary care only', 'Secure messaging', 'Visit notes PDF'],
        ],
        [
            'name'      => 'Care+',
            'monthly'   => 29,
            'yearly'    => 23,
            'tag'       => 'Most popular',
            'cta'       => 'Start 14-day trial',
            'highlight' => true,
            'features'  => ['Unlimited visits', 'All specialties', 'Priority same-day slots', 'Prescription delivery', 'Health dashboard + goals'],
        ],
        [
            'name'      => 'Family',
            'monthly'   => 59,
            'yearly'    => 47,
            'tag'       => 'Up to 5 members',
            'cta'       => 'Start 14-day trial',
            'highlight' => false,
            'features'  => ['Everything in Care+', 'Up to 5 profiles', 'Shared family dashboard', 'Child developmental tracking', 'Dedicated care coordinator'],
        ],
    ];

    $faqs = [
        ['q' => 'Is Pulse real medical care?',           'a' => 'Yes. Every consultation is conducted by a licensed, board-certified physician or credentialed therapist. Visit summaries and prescriptions are legally valid medical documents.'],
        ['q' => 'How quickly can I see a doctor?',       'a' => 'Most appointments on Care+ are available same-day. Our median wait time from booking to consultation is under 90 minutes.'],
        ['q' => 'What if I need in-person care?',        'a' => 'If your doctor determines you need an in-person exam or specialist visit, we provide a warm referral — including a summary note — to a provider near you.'],
        ['q' => 'Is my data private?',                   'a' => 'Pulse is fully HIPAA-compliant. All data is encrypted end-to-end and never shared with third parties for advertising or research without your explicit consent.'],
        ['q' => 'Do you accept insurance?',              'a' => 'We accept most major US insurance plans including BlueCross, Aetna, Cigna, United and Humana. You can verify coverage during sign-up.'],
        ['q' => 'Can I cancel anytime?',                 'a' => 'Absolutely. No long-term commitment. Cancel from your settings with one click; you keep access until the end of your billing period.'],
    ];

    $footerLinks = [
        'Patients'  => ['Find a doctor', 'Book a visit', 'My health records', 'Referrals', 'Insurance'],
        'Providers' => ['Join as a doctor', 'Credentialing', 'Provider portal', 'Billing & payouts', 'Support'],
        'Company'   => ['About Pulse', 'Careers', 'Press', 'Blog', 'Contact'],
        'Legal'     => ['Privacy policy', 'Terms of service', 'HIPAA notice', 'Cookie settings', 'Accessibility'],
    ];
@endphp

<x-layouts.app title="Pulse — Care on your schedule">

<style>
/* ─── Pulse design tokens (scoped) ─────────────────────────── */
@import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap');

#tpl-pulse {
    --pulse-white:   #f7fafc;
    --pulse-ink:     #0f172a;
    --pulse-blue:    #2563eb;
    --pulse-sky:     #0ea5e9;
    --pulse-mint:    #34d399;
    --pulse-soft-bg: #f0f7ff;
    font-family: 'Inter', sans-serif;
    color: var(--pulse-ink);
    background: var(--pulse-white);
}

#tpl-pulse h1,
#tpl-pulse h2,
#tpl-pulse h3 {
    font-family: 'Plus Jakarta Sans', 'Inter', sans-serif;
}

/* Hero gradient */
#tpl-pulse .pulse-hero-bg {
    background: linear-gradient(135deg, #dbeafe 0%, #e0f2fe 45%, #d1fae5 100%);
}

/* Heartbeat SVG line animation */
@keyframes pulse-draw {
    0%   { stroke-dashoffset: 320; }
    60%  { stroke-dashoffset: 0; }
    100% { stroke-dashoffset: 0; }
}
@keyframes pulse-dot {
    0%, 50% { opacity: 0; transform: scale(0); }
    60%      { opacity: 1; transform: scale(1.2); }
    80%      { transform: scale(1); }
    100%     { opacity: 1; transform: scale(1); }
}
@media (prefers-reduced-motion: no-preference) {
    #tpl-pulse .pulse-ecg-line {
        stroke-dasharray: 320;
        stroke-dashoffset: 320;
        animation: pulse-draw 2.2s cubic-bezier(.4,0,.2,1) 0.4s forwards;
    }
    #tpl-pulse .pulse-ecg-dot {
        opacity: 0;
        transform-origin: center;
        animation: pulse-dot 2.2s cubic-bezier(.4,0,.2,1) 0.4s forwards;
    }
}

/* Gentle fade-in reveals */
@keyframes pulse-rise {
    from { opacity: 0; transform: translateY(18px); }
    to   { opacity: 1; transform: translateY(0); }
}
@media (prefers-reduced-motion: no-preference) {
    #tpl-pulse .pulse-reveal { animation: pulse-rise 0.6s ease both; }
    #tpl-pulse .pulse-reveal-1 { animation-delay: 0.05s; }
    #tpl-pulse .pulse-reveal-2 { animation-delay: 0.15s; }
    #tpl-pulse .pulse-reveal-3 { animation-delay: 0.25s; }
    #tpl-pulse .pulse-reveal-4 { animation-delay: 0.35s; }
    #tpl-pulse .pulse-reveal-5 { animation-delay: 0.45s; }
}

/* Doctor card hover */
#tpl-pulse .pulse-doctor-card {
    transition: box-shadow 0.25s ease, transform 0.25s ease;
}
#tpl-pulse .pulse-doctor-card:hover {
    box-shadow: 0 16px 48px rgba(37, 99, 235, 0.12);
    transform: translateY(-3px);
}

/* Specialty card */
#tpl-pulse .pulse-specialty-card {
    transition: box-shadow 0.2s ease, transform 0.2s ease;
    background: #ffffff;
}
#tpl-pulse .pulse-specialty-card:hover {
    box-shadow: 0 8px 24px rgba(14, 165, 233, 0.1);
    transform: translateY(-2px);
}

/* Nav own styles */
#tpl-pulse .pulse-nav {
    background: rgba(247,250,252,0.9);
    backdrop-filter: blur(16px);
    border-bottom: 1px solid rgba(37, 99, 235, 0.08);
}

/* Mint accent line under section labels */
#tpl-pulse .pulse-section-label::after {
    content: '';
    display: block;
    width: 32px;
    height: 3px;
    background: var(--pulse-mint);
    border-radius: 99px;
    margin-top: 8px;
}

/* Progress bar overrides — own palette */
#tpl-pulse .pulse-progress-track {
    background: #e2e8f0;
    border-radius: 99px;
    height: 8px;
    overflow: hidden;
}
#tpl-pulse .pulse-progress-fill {
    height: 100%;
    border-radius: 99px;
    transition: width 1s ease;
}

/* Plan card highlight ring */
#tpl-pulse .pulse-plan-highlight {
    box-shadow: 0 0 0 2px var(--pulse-blue), 0 12px 40px rgba(37,99,235,0.15);
}

/* Form success state */
#tpl-pulse .pulse-booking-success {
    background: linear-gradient(135deg, #ecfdf5, #e0f2fe);
    border: 1px solid #a7f3d0;
    border-radius: 16px;
    padding: 2.5rem;
    text-align: center;
}
</style>

<div id="tpl-pulse">

    {{-- ─── NAV ─────────────────────────────────────────────── --}}
    <header class="pulse-nav sticky top-0 z-40">
        <div class="mx-auto flex h-16 max-w-6xl items-center gap-4 px-6">

            {{-- Logo --}}
            <a href="#" class="flex items-center gap-2 font-bold text-[var(--pulse-ink)]">
                <span class="flex size-8 items-center justify-center rounded-full" style="background: linear-gradient(135deg, var(--pulse-blue), var(--pulse-sky))">
                    <x-lucide-heart-pulse class="size-4 text-white" />
                </span>
                <span style="font-family:'Plus Jakarta Sans',sans-serif; font-weight:700; color:var(--pulse-ink)">Pulse</span>
            </a>

            {{-- Desktop nav --}}
            <nav class="ml-6 hidden items-center gap-1 text-sm md:flex">
                @foreach ($navLinks as $label => $href)
                    <a href="{{ $href }}" class="rounded-md px-3 py-1.5 font-medium transition-colors"
                       style="color:#475569"
                       onmouseover="this.style.color='var(--pulse-blue)';this.style.background='#eff6ff'"
                       onmouseout="this.style.color='#475569';this.style.background='transparent'">{{ $label }}</a>
                @endforeach
            </nav>

            <div class="ml-auto flex items-center gap-2">
                <x-ui.button href="#" variant="ghost" size="sm"
                    class="hidden sm:inline-flex"
                    style="color:var(--pulse-ink)">Sign in</x-ui.button>
                <x-ui.button href="#booking" size="sm"
                    class="hidden sm:inline-flex"
                    style="background:var(--pulse-blue); color:#fff; border:none">
                    Book a visit <x-lucide-arrow-right class="size-4" />
                </x-ui.button>
                {{-- Mobile sheet --}}
                <x-ui.sheet>
                    <x-ui.sheet-trigger class="md:hidden">
                        <x-ui.button variant="outline" size="icon" aria-label="Open menu">
                            <x-lucide-menu class="size-4" />
                        </x-ui.button>
                    </x-ui.sheet-trigger>
                    <x-ui.sheet-content side="right">
                        <x-ui.sheet-header>
                            <x-ui.sheet-title>Pulse</x-ui.sheet-title>
                        </x-ui.sheet-header>
                        <nav class="grid gap-1 px-4 text-sm">
                            @foreach ($navLinks as $label => $href)
                                <a href="{{ $href }}" @click="open = false"
                                   class="rounded-md px-3 py-2 font-medium hover:bg-blue-50">{{ $label }}</a>
                            @endforeach
                        </nav>
                        <x-ui.sheet-footer>
                            <x-ui.button href="#booking" class="w-full">Book a visit</x-ui.button>
                            <x-ui.button href="#" variant="outline" class="w-full">Sign in</x-ui.button>
                        </x-ui.sheet-footer>
                    </x-ui.sheet-content>
                </x-ui.sheet>
            </div>
        </div>
    </header>

    {{-- ─── HERO ────────────────────────────────────────────── --}}
    <section class="pulse-hero-bg relative overflow-hidden border-b">

        {{-- Decorative circle blobs --}}
        <div class="pointer-events-none absolute -top-32 -right-32 size-96 rounded-full opacity-30 blur-3xl"
             style="background: radial-gradient(circle, #93c5fd, transparent 70%)"></div>
        <div class="pointer-events-none absolute bottom-0 -left-24 size-72 rounded-full opacity-20 blur-2xl"
             style="background: radial-gradient(circle, #6ee7b7, transparent 70%)"></div>

        <div class="mx-auto grid max-w-6xl items-center gap-12 px-6 py-20 lg:grid-cols-2 lg:py-28">

            {{-- Left: headline + CTAs --}}
            <div>
                <div class="pulse-reveal pulse-reveal-1 mb-5 flex flex-wrap gap-2">
                    <x-ui.badge tone="info" variant="soft" class="gap-1.5">
                        <x-lucide-shield-check class="size-3" /> HIPAA Compliant
                    </x-ui.badge>
                    <x-ui.badge tone="success" variant="soft" class="gap-1.5">
                        <x-lucide-clock class="size-3" /> 24 / 7 care
                    </x-ui.badge>
                    <x-ui.badge tone="neutral" variant="soft" class="gap-1.5">
                        <x-lucide-award class="size-3" /> Board-certified MDs
                    </x-ui.badge>
                </div>

                <h1 class="pulse-reveal pulse-reveal-2 text-4xl font-extrabold tracking-tight text-balance sm:text-5xl lg:text-6xl"
                    style="color:var(--pulse-ink); font-family:'Plus Jakarta Sans',sans-serif; line-height:1.1">
                    Care,<br>
                    <span style="background: linear-gradient(90deg, var(--pulse-blue), var(--pulse-sky)); -webkit-background-clip:text; -webkit-text-fill-color:transparent; background-clip:text">on your schedule.</span>
                </h1>

                <p class="pulse-reveal pulse-reveal-3 mt-5 max-w-lg text-lg text-balance" style="color:#475569">
                    See a board-certified doctor by video in minutes — from your phone, tablet or laptop.
                    No waiting rooms. No referral letters. Just great care.
                </p>

                <div class="pulse-reveal pulse-reveal-4 mt-8 flex flex-wrap items-center gap-3">
                    <x-ui.button href="#booking" size="lg"
                        style="background:var(--pulse-blue); color:#fff; border:none; box-shadow: 0 4px 20px rgba(37,99,235,0.3)">
                        Book a visit <x-lucide-calendar-check class="size-4" />
                    </x-ui.button>
                    <x-ui.button href="#how-it-works" size="lg" variant="outline"
                        style="border-color:#93c5fd; color:var(--pulse-blue)">
                        <x-lucide-play class="size-4" /> How it works
                    </x-ui.button>
                </div>

                {{-- Social proof avatars --}}
                <div class="pulse-reveal pulse-reveal-5 mt-8 flex items-center gap-4">
                    <div class="flex -space-x-3">
                        @foreach ($heroAvatars as $av)
                            <x-ui.avatar class="size-10 ring-2 ring-white">
                                <x-ui.avatar-image src="https://picsum.photos/seed/{{ $av['seed'] }}/80/80" alt="{{ $av['alt'] }}" />
                                <x-ui.avatar-fallback>{{ strtoupper(substr($av['alt'], 4, 1)) }}</x-ui.avatar-fallback>
                            </x-ui.avatar>
                        @endforeach
                    </div>
                    <div class="text-sm">
                        <div class="flex items-center gap-0.5 text-amber-500">
                            @for ($i = 0; $i < 5; $i++)
                                <x-lucide-star class="size-3.5 fill-current" />
                            @endfor
                        </div>
                        <span style="color:#64748b">Trusted by <strong style="color:var(--pulse-ink)">50,000+</strong> patients</span>
                    </div>
                </div>
            </div>

            {{-- Right: vitals card + heartbeat graphic --}}
            <div class="pulse-reveal pulse-reveal-3 relative">

                {{-- Heartbeat / ECG graphic --}}
                <div class="mb-6 overflow-hidden rounded-2xl border bg-white p-5"
                     style="box-shadow: 0 8px 32px rgba(37,99,235,0.10)">
                    <div class="mb-3 flex items-center justify-between">
                        <span class="text-sm font-semibold" style="color:var(--pulse-ink)">Live vitals</span>
                        <x-ui.badge tone="danger" variant="soft" class="gap-1 animate-pulse">
                            <span class="size-1.5 rounded-full bg-red-500 inline-block"></span> Live
                        </x-ui.badge>
                    </div>

                    {{-- ECG SVG --}}
                    <div class="relative flex items-center justify-center py-4">
                        <svg viewBox="0 0 320 60" class="w-full" aria-hidden="true" aria-label="Animated heartbeat / ECG line">
                            <path
                                d="M0,30 L40,30 L50,30 L55,8 L62,52 L68,8 L75,30 L82,30 L88,30 L93,22 L98,38 L103,30 L108,30 L130,30 L138,30 L143,8 L150,52 L156,8 L163,30 L170,30 L176,30 L181,22 L186,38 L191,30 L196,30 L220,30 L228,30 L233,8 L240,52 L246,8 L253,30 L260,30 L266,30 L271,22 L276,38 L281,30 L320,30"
                                class="pulse-ecg-line"
                                fill="none"
                                stroke="#2563eb"
                                stroke-width="2.2"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />
                            <circle cx="281" cy="30" r="4" class="pulse-ecg-dot" fill="#2563eb" />
                        </svg>
                    </div>

                    {{-- Vitals stats row --}}
                    <div class="grid grid-cols-3 gap-3 pt-2">
                        @foreach ([['Heart Rate', '72 bpm', 'heart-pulse', '#ef4444'], ['SpO2', '98%', 'activity', '#34d399'], ['BP', '118/76', 'thermometer', '#0ea5e9']] as [$vl, $vv, $vi, $vc])
                            <div class="rounded-xl p-3 text-center" style="background: var(--pulse-soft-bg)">
                                <x-dynamic-component :component="'lucide-'.$vi" class="mx-auto mb-1 size-4" style="color:{{ $vc }}" />
                                <div class="text-xs font-semibold" style="color:var(--pulse-ink)">{{ $vv }}</div>
                                <div class="text-[10px]" style="color:#94a3b8">{{ $vl }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Floating booking cue card --}}
                <div class="absolute -right-4 -bottom-6 hidden rounded-2xl border bg-white px-4 py-3 shadow-lg lg:block"
                     style="box-shadow: 0 8px 24px rgba(52,211,153,0.18)">
                    <div class="flex items-center gap-3">
                        <span class="flex size-9 items-center justify-center rounded-full"
                              style="background: #d1fae5">
                            <x-lucide-calendar-check class="size-4" style="color:#059669" />
                        </span>
                        <div class="text-xs">
                            <div class="font-semibold" style="color:var(--pulse-ink)">Next available</div>
                            <div style="color:#059669; font-weight:600">Today · 3:00 PM</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── SPECIALTIES ─────────────────────────────────────── --}}
    <section id="specialties" class="scroll-mt-20 py-20 lg:py-28" style="background: #ffffff">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mx-auto mb-14 max-w-2xl text-center">
                <p class="pulse-section-label inline-block text-sm font-semibold uppercase tracking-widest"
                   style="color:var(--pulse-blue)">Specialties</p>
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-balance sm:text-4xl"
                    style="color:var(--pulse-ink)">Expert care across every discipline</h2>
                <p class="mt-3 text-lg text-balance" style="color:#64748b">
                    Our network of 800+ credentialed specialists covers every stage of life — all reachable within minutes.
                </p>
            </div>

            <div class="grid gap-5 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($specialties as $sp)
                    <div class="pulse-specialty-card group rounded-2xl border p-5" style="box-shadow: 0 2px 12px rgba(15,23,42,0.06)">
                        <div class="mb-4 inline-flex size-12 items-center justify-center rounded-xl"
                             style="background: linear-gradient(135deg, #dbeafe, #e0f2fe)">
                            <x-dynamic-component :component="'lucide-'.$sp['icon']" class="size-5" style="color:var(--pulse-blue)" />
                        </div>
                        <h3 class="font-semibold" style="color:var(--pulse-ink)">{{ $sp['name'] }}</h3>
                        <p class="mt-1.5 text-sm" style="color:#64748b">{{ $sp['desc'] }}</p>
                        <div class="mt-4 inline-flex items-center gap-1 text-xs font-medium" style="color:var(--pulse-blue)">
                            Book now <x-lucide-arrow-right class="size-3" />
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── HOW IT WORKS (Stepper) ──────────────────────────── --}}
    <section id="how-it-works" class="scroll-mt-20 border-y py-20 lg:py-28" style="background: var(--pulse-soft-bg)">
        <div class="mx-auto max-w-5xl px-6">
            <div class="mx-auto mb-14 max-w-2xl text-center">
                <p class="pulse-section-label inline-block text-sm font-semibold uppercase tracking-widest"
                   style="color:var(--pulse-blue)">How it works</p>
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-balance sm:text-4xl"
                    style="color:var(--pulse-ink)">From booking to better health in 4 steps</h2>
            </div>

            <x-ui.stepper :value="4" class="w-full">
                <x-ui.stepper-nav>
                    @foreach ($steps as $idx => $step)
                        <x-ui.stepper-item :step="$idx + 1">
                            <x-ui.stepper-trigger>
                                <x-ui.stepper-indicator>
                                    <x-dynamic-component :component="'lucide-'.$step['icon']" class="size-4" />
                                </x-ui.stepper-indicator>
                            </x-ui.stepper-trigger>
                            @if ($idx < count($steps) - 1)
                                <x-ui.stepper-separator />
                            @endif
                        </x-ui.stepper-item>
                    @endforeach
                </x-ui.stepper-nav>

                <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                    @foreach ($steps as $idx => $step)
                        <div class="rounded-2xl border bg-white p-5" style="box-shadow: 0 2px 12px rgba(15,23,42,0.05)">
                            <div class="mb-3 flex size-9 items-center justify-center rounded-full text-sm font-bold text-white"
                                 style="background: linear-gradient(135deg, var(--pulse-blue), var(--pulse-sky))">
                                {{ $idx + 1 }}
                            </div>
                            <h3 class="font-semibold" style="color:var(--pulse-ink)">{{ $step['title'] }}</h3>
                            <p class="mt-1.5 text-sm" style="color:#64748b">{{ $step['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </x-ui.stepper>
        </div>
    </section>

    {{-- ─── APPOINTMENT BOOKING ─────────────────────────────── --}}
    <section id="booking" class="scroll-mt-20 py-20 lg:py-28" style="background: #ffffff">
        <div class="mx-auto max-w-5xl px-6">
            <div class="mx-auto mb-14 max-w-2xl text-center">
                <p class="pulse-section-label inline-block text-sm font-semibold uppercase tracking-widest"
                   style="color:var(--pulse-blue)">Book a visit</p>
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-balance sm:text-4xl"
                    style="color:var(--pulse-ink)">Schedule your appointment</h2>
                <p class="mt-3 text-lg text-balance" style="color:#64748b">Fill in the form below — we'll confirm your slot within 5 minutes.</p>
            </div>

            <div class="rounded-3xl border bg-white p-8 lg:p-12"
                 style="box-shadow: 0 16px 48px rgba(37,99,235,0.08)"
                 x-data="{ submitted: false, step: 1 }">

                {{-- Success state --}}
                <div x-show="submitted" x-cloak class="pulse-booking-success">
                    <div class="mx-auto mb-4 flex size-16 items-center justify-center rounded-full"
                         style="background: #d1fae5">
                        <x-lucide-check-circle-2 class="size-8" style="color:#059669" />
                    </div>
                    <h3 class="text-xl font-bold" style="color:var(--pulse-ink); font-family:'Plus Jakarta Sans',sans-serif">Appointment requested!</h3>
                    <p class="mt-2 text-sm" style="color:#64748b">
                        We'll confirm your slot by email within 5 minutes.<br>Check your inbox for next steps.
                    </p>
                    <x-ui.button class="mt-6" @click="submitted = false"
                        style="background:var(--pulse-blue); color:#fff; border:none">
                        Book another visit
                    </x-ui.button>
                </div>

                {{-- Booking form --}}
                <form x-show="!submitted" @submit.prevent="submitted = true" novalidate>
                    <div class="grid gap-6 sm:grid-cols-2">

                        {{-- Full name --}}
                        <x-ui.field>
                            <x-ui.field-label for="pulse-name">Full name</x-ui.field-label>
                            <x-ui.field-content>
                                <x-ui.input id="pulse-name" name="name" type="text"
                                    placeholder="Jane Smith" required />
                            </x-ui.field-content>
                        </x-ui.field>

                        {{-- Email --}}
                        <x-ui.field>
                            <x-ui.field-label for="pulse-email">Email address</x-ui.field-label>
                            <x-ui.field-content>
                                <x-ui.input id="pulse-email" name="email" type="email"
                                    placeholder="jane@example.com" required />
                            </x-ui.field-content>
                        </x-ui.field>

                        {{-- Specialty --}}
                        <x-ui.field>
                            <x-ui.field-label>Specialty</x-ui.field-label>
                            <x-ui.field-content>
                                <x-ui.select name="specialty" :options="$specialtyOptions" placeholder="Choose a specialty" />
                            </x-ui.field-content>
                        </x-ui.field>

                        {{-- Date picker --}}
                        <x-ui.field>
                            <x-ui.field-label>Preferred date</x-ui.field-label>
                            <x-ui.field-content>
                                <x-ui.date-picker name="appointment_date" class="w-full" />
                            </x-ui.field-content>
                        </x-ui.field>

                        {{-- Time field --}}
                        <x-ui.field>
                            <x-ui.field-label>Preferred time</x-ui.field-label>
                            <x-ui.field-content>
                                <x-ui.time-field name="appointment_time" variant="select" :minute-step="15" />
                            </x-ui.field-content>
                        </x-ui.field>

                        {{-- Reason (full width) --}}
                        <x-ui.field class="sm:col-span-2">
                            <x-ui.field-label for="pulse-reason">Reason for visit</x-ui.field-label>
                            <x-ui.field-content>
                                <textarea
                                    id="pulse-reason"
                                    name="reason"
                                    rows="3"
                                    placeholder="Briefly describe your symptoms or concern…"
                                    class="w-full resize-none rounded-md border px-3 py-2 text-sm shadow-xs outline-none transition focus-visible:ring-2"
                                    style="border-color:#cbd5e1; color:var(--pulse-ink); background:#fff;
                                           focus-visible:border-color:var(--pulse-blue)"
                                ></textarea>
                            </x-ui.field-content>
                        </x-ui.field>
                    </div>

                    <div class="mt-6 flex flex-col items-start gap-4 sm:flex-row sm:items-center sm:justify-between">
                        <div class="flex items-center gap-2 text-xs" style="color:#64748b">
                            <x-lucide-shield-check class="size-4 shrink-0" style="color:var(--pulse-mint)" />
                            Your information is encrypted and HIPAA-protected.
                        </div>
                        <x-ui.button type="submit" size="lg"
                            style="background:var(--pulse-blue); color:#fff; border:none; box-shadow: 0 4px 16px rgba(37,99,235,0.25)">
                            Request appointment <x-lucide-calendar-check class="size-4" />
                        </x-ui.button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    {{-- ─── DOCTORS DIRECTORY ────────────────────────────────── --}}
    <section id="doctors" class="scroll-mt-20 border-t py-20 lg:py-28" style="background: var(--pulse-soft-bg)">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mx-auto mb-14 max-w-2xl text-center">
                <p class="pulse-section-label inline-block text-sm font-semibold uppercase tracking-widest"
                   style="color:var(--pulse-blue)">Our doctors</p>
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-balance sm:text-4xl"
                    style="color:var(--pulse-ink)">Meet some of your care team</h2>
                <p class="mt-3 text-lg text-balance" style="color:#64748b">
                    Every Pulse physician is board-certified, credentialed and rated by verified patients.
                </p>
            </div>

            <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                @foreach ($doctors as $doc)
                    <x-ui.hover-card>
                        <x-ui.hover-card-trigger>
                            <div class="pulse-doctor-card cursor-pointer rounded-2xl border bg-white p-5"
                                 style="box-shadow: 0 2px 12px rgba(15,23,42,0.06)">
                                <x-ui.avatar class="mx-auto mb-4 size-20 ring-2"
                                    style="--tw-ring-color: #bfdbfe">
                                    <x-ui.avatar-image
                                        src="https://picsum.photos/seed/{{ $doc['seed'] }}/160/160"
                                        alt="{{ $doc['name'] }}" />
                                    <x-ui.avatar-fallback>{{ strtoupper(substr($doc['name'], 3, 1)) }}</x-ui.avatar-fallback>
                                </x-ui.avatar>
                                <h3 class="text-center text-sm font-semibold" style="color:var(--pulse-ink)">{{ $doc['name'] }}</h3>
                                <p class="mt-0.5 text-center text-xs" style="color:#64748b">{{ $doc['specialty'] }}</p>

                                <div class="mt-3 flex items-center justify-center gap-1.5">
                                    <x-ui.rating :value="$doc['rating']" :max="5" :readonly="true" size="sm" />
                                    <span class="text-xs font-medium" style="color:var(--pulse-ink)">{{ $doc['rating'] }}</span>
                                    <span class="text-xs" style="color:#94a3b8">({{ $doc['reviews'] }})</span>
                                </div>

                                <div class="mt-3 flex items-center justify-center gap-1">
                                    <x-ui.badge tone="{{ $doc['available'] === 'Today' ? 'success' : 'neutral' }}" variant="soft" class="text-[10px]">
                                        <x-lucide-clock class="size-2.5" />
                                        {{ $doc['available'] }}
                                    </x-ui.badge>
                                </div>

                                <x-ui.button class="mt-4 w-full" size="sm" variant="outline"
                                    style="border-color:var(--pulse-blue); color:var(--pulse-blue)">
                                    View profile
                                </x-ui.button>
                            </div>
                        </x-ui.hover-card-trigger>

                        <x-ui.hover-card-content side="top" class="w-72" style="background:#fff; border-color:#e2e8f0">
                            <div class="flex items-start gap-3">
                                <img src="https://picsum.photos/seed/{{ $doc['seed'] }}/56/56"
                                     alt="{{ $doc['name'] }}"
                                     class="size-12 shrink-0 rounded-full object-cover ring-2"
                                     style="--tw-ring-color:#bfdbfe" />
                                <div>
                                    <p class="text-sm font-semibold" style="color:var(--pulse-ink)">{{ $doc['name'] }}</p>
                                    <p class="text-xs" style="color:var(--pulse-blue)">{{ $doc['specialty'] }}</p>
                                </div>
                            </div>
                            <p class="mt-3 text-xs leading-relaxed" style="color:#475569">{{ $doc['bio'] }}</p>
                            <div class="mt-3 flex flex-wrap gap-1">
                                @foreach ($doc['languages'] as $lang)
                                    <x-ui.badge variant="outline" class="text-[10px]">{{ $lang }}</x-ui.badge>
                                @endforeach
                            </div>
                        </x-ui.hover-card-content>
                    </x-ui.hover-card>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── HEALTH DASHBOARD PREVIEW ─────────────────────────── --}}
    <section class="border-y py-20 lg:py-28" style="background: #ffffff">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mx-auto mb-14 max-w-2xl text-center">
                <p class="pulse-section-label inline-block text-sm font-semibold uppercase tracking-widest"
                   style="color:var(--pulse-blue)">Your health dashboard</p>
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-balance sm:text-4xl"
                    style="color:var(--pulse-ink)">Track your wellbeing, every day</h2>
                <p class="mt-3 text-lg text-balance" style="color:#64748b">
                    Your personalised dashboard ties your goals, vitals and visit history into one calm, clear view.
                </p>
            </div>

            <div class="grid gap-8 lg:grid-cols-2">

                {{-- Health goals --}}
                <div class="rounded-2xl border bg-white p-6" style="box-shadow: 0 4px 20px rgba(15,23,42,0.06)">
                    <div class="mb-5 flex items-center justify-between">
                        <h3 class="font-semibold" style="color:var(--pulse-ink); font-family:'Plus Jakarta Sans',sans-serif">Weekly goals</h3>
                        <x-ui.badge tone="success" variant="soft" class="gap-1">
                            <x-lucide-trending-up class="size-3" /> On track
                        </x-ui.badge>
                    </div>
                    <div class="space-y-5">
                        @foreach ($healthGoals as $goal)
                            <div>
                                <div class="mb-1.5 flex items-center justify-between text-sm">
                                    <span class="font-medium" style="color:var(--pulse-ink)">{{ $goal['label'] }}</span>
                                    <span class="font-semibold" style="color:{{ $goal['color'] }}">{{ $goal['value'] }}%</span>
                                </div>
                                <div class="pulse-progress-track">
                                    <div class="pulse-progress-fill"
                                         style="width: {{ $goal['value'] }}%; background: {{ $goal['color'] }}"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <x-ui.separator class="my-5" />

                    <div class="grid grid-cols-3 gap-3">
                        @foreach ([['Visits this month', '3', 'calendar'], ['Prescriptions', '2', 'pill'], ['Messages', '8', 'message-circle']] as [$sl, $sv, $si])
                            <div class="rounded-xl p-3 text-center" style="background: var(--pulse-soft-bg)">
                                <x-dynamic-component :component="'lucide-'.$si" class="mx-auto mb-1 size-4" style="color:var(--pulse-blue)" />
                                <div class="text-lg font-bold" style="color:var(--pulse-ink)">{{ $sv }}</div>
                                <div class="text-[10px]" style="color:#94a3b8">{{ $sl }}</div>
                            </div>
                        @endforeach
                    </div>
                </div>

                {{-- Heart rate chart --}}
                <div class="rounded-2xl border bg-white p-6" style="box-shadow: 0 4px 20px rgba(15,23,42,0.06)">
                    <div class="mb-5 flex items-center justify-between">
                        <h3 class="font-semibold" style="color:var(--pulse-ink); font-family:'Plus Jakarta Sans',sans-serif">Resting heart rate</h3>
                        <div class="flex items-center gap-2">
                            <x-ui.tooltip>
                                <x-ui.tooltip-trigger>
                                    <x-ui.badge tone="info" variant="soft" class="cursor-default gap-1">
                                        <x-lucide-info class="size-3" /> Normal range
                                    </x-ui.badge>
                                </x-ui.tooltip-trigger>
                                <x-ui.tooltip-content side="top">
                                    60–100 bpm is the normal resting range for adults.
                                </x-ui.tooltip-content>
                            </x-ui.tooltip>
                        </div>
                    </div>
                    <x-ui.chart
                        type="area"
                        :series="$chartSeries"
                        :options="$chartOptions"
                        :colors="['#2563eb']"
                        label="Heart rate over 12 months (bpm)"
                        class="h-[220px] w-full"
                        :height="220"
                    />
                    <div class="mt-4 flex items-center gap-4 text-xs" style="color:#64748b">
                        <span class="flex items-center gap-1.5">
                            <span class="inline-block size-2 rounded-full" style="background:#2563eb"></span>
                            Avg: 73 bpm
                        </span>
                        <span class="flex items-center gap-1.5">
                            <x-lucide-trending-down class="size-3" style="color:var(--pulse-mint)" />
                            Improved 3% vs last quarter
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- ─── TESTIMONIALS ─────────────────────────────────────── --}}
    <section class="border-y py-20 lg:py-28" style="background: var(--pulse-soft-bg)">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mx-auto mb-14 max-w-2xl text-center">
                <p class="pulse-section-label inline-block text-sm font-semibold uppercase tracking-widest"
                   style="color:var(--pulse-blue)">Patient stories</p>
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-balance sm:text-4xl"
                    style="color:var(--pulse-ink)">Real patients, real outcomes</h2>
            </div>

            <x-ui.carousel class="w-full">
                <x-ui.carousel-content>
                    @foreach ($testimonials as $t)
                        <x-ui.carousel-item class="pl-4 md:basis-1/2 lg:basis-1/3">
                            <div class="h-full rounded-2xl border bg-white p-6"
                                 style="box-shadow: 0 4px 20px rgba(15,23,42,0.06)">
                                <x-ui.quote
                                    author="{{ $t['a'] }}"
                                    role="{{ $t['role'] }}"
                                    avatar="{{ $t['img'] }}"
                                    class="max-w-none [&_blockquote]:text-sm [&_blockquote]:font-normal [&_blockquote]:leading-relaxed"
                                >{{ $t['q'] }}</x-ui.quote>
                            </div>
                        </x-ui.carousel-item>
                    @endforeach
                </x-ui.carousel-content>
                <x-ui.carousel-previous
                    class="border-blue-200"
                    style="color:var(--pulse-blue)" />
                <x-ui.carousel-next
                    class="border-blue-200"
                    style="color:var(--pulse-blue)" />
            </x-ui.carousel>
        </div>
    </section>

    {{-- ─── INSURANCE / PARTNERS MARQUEE ───────────────────── --}}
    <section class="border-y py-12" style="background: #ffffff">
        <p class="mb-6 text-center text-sm font-medium" style="color:#94a3b8">
            Accepted by major insurance plans
        </p>
        <x-ui.marquee fade :duration="'28s'" class="mx-auto max-w-5xl">
            @foreach ($partners as $partner)
                <div class="mx-8 inline-flex items-center gap-2">
                    <x-lucide-shield-check class="size-4" style="color:var(--pulse-blue)" />
                    <span class="text-lg font-bold" style="color:#cbd5e1">{{ $partner }}</span>
                </div>
            @endforeach
        </x-ui.marquee>
    </section>

    {{-- ─── PLANS ────────────────────────────────────────────── --}}
    <section id="plans" class="scroll-mt-20 py-20 lg:py-28" style="background: var(--pulse-soft-bg)">
        <div class="mx-auto max-w-6xl px-6" x-data="{ yearly: false }">
            <div class="mx-auto mb-12 max-w-2xl text-center">
                <p class="pulse-section-label inline-block text-sm font-semibold uppercase tracking-widest"
                   style="color:var(--pulse-blue)">Plans</p>
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-balance sm:text-4xl"
                    style="color:var(--pulse-ink)">Transparent, predictable pricing</h2>
                <p class="mt-3 text-lg text-balance" style="color:#64748b">Start free — upgrade when you need more. No hidden fees.</p>

                {{-- Monthly / yearly toggle --}}
                <div class="mt-6 inline-flex items-center gap-2">
                    <span class="text-sm" :class="!yearly ? 'font-semibold' : ''" style="color:var(--pulse-ink)">Monthly</span>
                    <x-ui.switch @click="yearly = !yearly" :checked="false" />
                    <span class="text-sm" :class="yearly ? 'font-semibold' : ''" style="color:var(--pulse-ink)">Yearly</span>
                    <x-ui.badge tone="success" variant="soft" class="text-[10px]">Save 20%</x-ui.badge>
                </div>
            </div>

            <div class="grid items-stretch gap-6 lg:grid-cols-3">
                @foreach ($plans as $plan)
                    <div @class([
                        'relative flex flex-col rounded-2xl border bg-white p-7',
                        'pulse-plan-highlight' => $plan['highlight'],
                    ]) style="box-shadow: 0 4px 20px rgba(15,23,42,0.06)">

                        @if ($plan['highlight'])
                            <x-ui.badge class="absolute -top-3 left-1/2 -translate-x-1/2"
                                style="background:var(--pulse-blue); color:#fff; border:none">
                                Most popular
                            </x-ui.badge>
                        @endif

                        <h3 class="text-lg font-bold" style="color:var(--pulse-ink); font-family:'Plus Jakarta Sans',sans-serif">{{ $plan['name'] }}</h3>
                        <p class="mt-0.5 text-sm" style="color:#94a3b8">{{ $plan['tag'] }}</p>

                        <div class="mt-5 flex items-baseline gap-1">
                            <span class="text-4xl font-extrabold tracking-tight" style="color:var(--pulse-ink)">
                                $<span x-text="yearly ? {{ $plan['yearly'] }} : {{ $plan['monthly'] }}">{{ $plan['monthly'] }}</span>
                            </span>
                            <span class="text-sm" style="color:#94a3b8">/mo</span>
                        </div>

                        <x-ui.button href="#booking" class="mt-5 w-full"
                            style="{{ $plan['highlight'] ? 'background:var(--pulse-blue); color:#fff; border:none' : 'border-color:var(--pulse-blue); color:var(--pulse-blue)' }}"
                            :variant="$plan['highlight'] ? 'default' : 'outline'">
                            {{ $plan['cta'] }}
                        </x-ui.button>

                        <x-ui.separator class="my-5" />

                        <ul class="space-y-3 text-sm">
                            @foreach ($plan['features'] as $feat)
                                <li class="flex items-center gap-2.5">
                                    <x-lucide-check class="size-4 shrink-0" style="color:var(--pulse-mint)" />
                                    <span style="color:#475569">{{ $feat }}</span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- ─── FAQ ─────────────────────────────────────────────── --}}
    <section id="faq" class="scroll-mt-20 border-y py-20 lg:py-28" style="background: #ffffff">
        <div class="mx-auto max-w-3xl px-6">
            <div class="mb-12 text-center">
                <p class="pulse-section-label inline-block text-sm font-semibold uppercase tracking-widest"
                   style="color:var(--pulse-blue)">FAQ</p>
                <h2 class="mt-4 text-3xl font-bold tracking-tight text-balance sm:text-4xl"
                    style="color:var(--pulse-ink)">Common questions</h2>
            </div>

            <x-ui.accordion type="single" collapsible class="w-full">
                @foreach ($faqs as $i => $faq)
                    <x-ui.accordion-item value="pfaq-{{ $i }}">
                        <x-ui.accordion-trigger
                            class="text-left font-medium"
                            style="color:var(--pulse-ink)">
                            {{ $faq['q'] }}
                        </x-ui.accordion-trigger>
                        <x-ui.accordion-content style="color:#475569">
                            {{ $faq['a'] }}
                        </x-ui.accordion-content>
                    </x-ui.accordion-item>
                @endforeach
            </x-ui.accordion>
        </div>
    </section>

    {{-- ─── CTA BANNER ──────────────────────────────────────── --}}
    <section class="py-20 lg:py-24" style="background: var(--pulse-soft-bg)">
        <div class="mx-auto max-w-5xl px-6">
            <div class="relative overflow-hidden rounded-3xl p-10 text-center lg:p-16"
                 style="background: linear-gradient(135deg, #1d4ed8 0%, #0284c7 60%, #059669 100%); box-shadow: 0 20px 60px rgba(37,99,235,0.3)">

                {{-- Decorative circles --}}
                <div class="pointer-events-none absolute -top-16 -right-16 size-64 rounded-full opacity-20"
                     style="background: radial-gradient(circle, #93c5fd, transparent 70%)"></div>
                <div class="pointer-events-none absolute -bottom-12 -left-12 size-48 rounded-full opacity-20"
                     style="background: radial-gradient(circle, #6ee7b7, transparent 70%)"></div>

                <x-ui.badge variant="secondary" class="mb-5 inline-flex gap-1.5">
                    <x-lucide-heart-pulse class="size-3.5" /> No credit card required
                </x-ui.badge>

                <h2 class="text-3xl font-extrabold tracking-tight text-balance text-white sm:text-4xl"
                    style="font-family:'Plus Jakarta Sans',sans-serif">
                    Your first visit is on us.
                </h2>
                <p class="mt-3 max-w-xl mx-auto text-balance text-white/80 text-lg">
                    Create your free account today and book a consultation with a board-certified physician in under two minutes.
                </p>
                <div class="mt-8 flex flex-wrap justify-center gap-4">
                    <x-ui.button href="#booking" size="lg"
                        style="background:#ffffff; color:var(--pulse-blue); border:none; font-weight:700">
                        Book a free visit <x-lucide-arrow-right class="size-4" />
                    </x-ui.button>
                    <x-ui.button href="#doctors" size="lg"
                        style="background:transparent; color:#ffffff; border: 1px solid rgba(255,255,255,0.4)">
                        Meet our doctors
                    </x-ui.button>
                </div>

                <div class="mt-8 flex flex-wrap justify-center gap-6 text-white/70 text-sm">
                    @foreach ($trustBadges as $tb)
                        <span class="flex items-center gap-1.5">
                            <x-dynamic-component :component="'lucide-'.$tb['icon']" class="size-4 text-white/60" />
                            {{ $tb['label'] }}
                        </span>
                    @endforeach
                </div>
            </div>
        </div>
    </section>

    {{-- ─── FOOTER ──────────────────────────────────────────── --}}
    <footer class="border-t" style="background: var(--pulse-ink)">
        <div class="mx-auto max-w-6xl px-6 py-14">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-6">

                {{-- Brand --}}
                <div class="lg:col-span-2">
                    <a href="#" class="flex items-center gap-2">
                        <span class="flex size-8 items-center justify-center rounded-full"
                              style="background: linear-gradient(135deg, var(--pulse-blue), var(--pulse-sky))">
                            <x-lucide-heart-pulse class="size-4 text-white" />
                        </span>
                        <span class="text-lg font-bold text-white" style="font-family:'Plus Jakarta Sans',sans-serif">Pulse</span>
                    </a>
                    <p class="mt-3 max-w-xs text-sm" style="color:#94a3b8">
                        Expert medical care, delivered to you — whenever, wherever you need it.
                    </p>
                    <div class="mt-5 flex gap-2">
                        @foreach (['twitter', 'instagram', 'linkedin', 'youtube'] as $soc)
                            <a href="#" aria-label="{{ $soc }}"
                               class="inline-flex size-9 items-center justify-center rounded-md border transition-colors"
                               style="border-color:#334155; color:#94a3b8"
                               onmouseover="this.style.borderColor='var(--pulse-blue)';this.style.color='#fff'"
                               onmouseout="this.style.borderColor='#334155';this.style.color='#94a3b8'">
                                <x-dynamic-component :component="'lucide-'.$soc" class="size-4" />
                            </a>
                        @endforeach
                    </div>
                </div>

                {{-- Link groups --}}
                @foreach ($footerLinks as $heading => $links)
                    <div>
                        <h3 class="text-sm font-semibold text-white">{{ $heading }}</h3>
                        <ul class="mt-3 space-y-2 text-sm">
                            @foreach ($links as $link)
                                <li>
                                    <a href="#"
                                       class="transition-colors"
                                       style="color:#94a3b8"
                                       onmouseover="this.style.color='#fff'"
                                       onmouseout="this.style.color='#94a3b8'">{{ $link }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>

            <x-ui.separator class="my-8" style="background: #1e293b" />

            <div class="flex flex-col items-center justify-between gap-3 text-sm sm:flex-row"
                 style="color:#64748b">
                <span>© {{ date('Y') }} Pulse Health, Inc. All rights reserved.</span>
                <span class="flex items-center gap-2">
                    <x-lucide-shield-check class="size-4" style="color:var(--pulse-mint)" />
                    HIPAA Compliant · SOC 2 Type II · GDPR Ready
                </span>
            </div>
        </div>
    </footer>

</div>
</x-layouts.app>
