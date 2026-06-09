@php
    $speakers = [
        ['n' => 'Mara Quinn', 'r' => 'CTO, Northwind', 'i' => 'MQ'], ['n' => 'Leo Fontaine', 'r' => 'Principal, Globex', 'i' => 'LF'],
        ['n' => 'Ines Park', 'r' => 'Design Lead, Acme', 'i' => 'IP'], ['n' => 'Theo Vance', 'r' => 'Founder, Forge', 'i' => 'TV'],
        ['n' => 'Sofia Davis', 'r' => 'VP Eng, Umbrella', 'i' => 'SD'], ['n' => 'Marcus Chen', 'r' => 'Staff Eng, Hooli', 'i' => 'MC'],
        ['n' => 'Priya Nair', 'r' => 'CISO, Stark', 'i' => 'PN'], ['n' => 'Ada Lovelace', 'r' => 'Author', 'i' => 'AL'],
    ];

    $schedule = [
        'day1' => [
            ['9:00', 'Registration & coffee', 'Atrium', 'break', 'neutral'],
            ['10:00', 'Opening keynote: The next decade of the web', 'Mara Quinn', 'keynote', 'primary'],
            ['11:00', 'Designing systems that scale', 'Ines Park', 'design', 'info'],
            ['12:30', 'Lunch', 'Hall B', 'break', 'neutral'],
            ['14:00', 'Shipping fast without breaking things', 'Theo Vance', 'eng', 'success'],
            ['15:30', 'Security for the rest of us', 'Priya Nair', 'security', 'warning'],
        ],
        'day2' => [
            ['9:30', 'Morning lightning talks', 'Various', 'talks', 'info'],
            ['10:30', 'Building a design system your team uses', 'Leo Fontaine', 'design', 'info'],
            ['12:00', 'Lunch & networking', 'Hall B', 'break', 'neutral'],
            ['13:30', 'Performance at the edge', 'Marcus Chen', 'eng', 'success'],
            ['15:00', 'Closing keynote & panel', 'All speakers', 'keynote', 'primary'],
        ],
    ];

    $tickets = [
        ['name' => 'Early bird', 'price' => 199, 'tag' => 'Sold out', 'sold' => true, 'feats' => ['2-day pass', 'All talks', 'Lunch included']],
        ['name' => 'Standard', 'price' => 349, 'tag' => 'Popular', 'sold' => false, 'feats' => ['2-day pass', 'All talks & workshops', 'Lunch + after-party', 'Recordings']],
        ['name' => 'VIP', 'price' => 599, 'tag' => null, 'sold' => false, 'feats' => ['Everything in Standard', 'Front-row seating', 'Speaker dinner', 'Swag bag']],
    ];

    $faqs = [
        ['q' => 'Where is the venue?', 'a' => 'The Pier Pavilion, 88 Harbor Way, San Francisco. It\'s a 10-minute walk from the Embarcadero BART station.'],
        ['q' => 'Will talks be recorded?', 'a' => 'Yes — Standard and VIP ticket holders get access to all recordings within two weeks of the event.'],
        ['q' => 'Can I get a refund?', 'a' => 'Tickets are refundable up to 30 days before the event, and transferable any time.'],
    ];
@endphp

<x-layouts.app title="ShipConf 2026 — The conference for builders">
    <header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-40 border-b backdrop-blur-xl">
        <div class="mx-auto flex h-16 max-w-6xl items-center gap-4 px-6">
            <a href="#" class="flex items-center gap-2 font-semibold tracking-tight"><span class="bg-primary text-primary-foreground flex size-8 items-center justify-center rounded-lg"><x-lucide-rocket class="size-5" /></span> ShipConf</a>
            <nav class="ml-4 hidden items-center gap-1 text-sm md:flex">
                @foreach (['Speakers', 'Schedule', 'Tickets', 'Venue'] as $l)<a href="#{{ strtolower($l) }}" class="text-muted-foreground hover:text-foreground hover:bg-accent/60 rounded-md px-3 py-1.5 font-medium transition-colors">{{ $l }}</a>@endforeach
            </nav>
            <div class="ml-auto flex items-center gap-1.5">
                <button type="button" @click="$store.theme && $store.theme.toggle()" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Toggle theme"><x-lucide-sun class="size-4 dark:hidden" /><x-lucide-moon class="hidden size-4 dark:block" /></button>
                <x-ui.button size="sm" href="#tickets">Get tickets</x-ui.button>
            </div>
        </div>
    </header>

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b">
        <div class="pointer-events-none absolute inset-x-0 -top-40 -z-10 flex justify-center"><div class="from-primary/25 h-[28rem] w-[60rem] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div></div>
        <div class="mx-auto max-w-3xl px-6 py-24 text-center lg:py-32">
            <div class="text-muted-foreground mb-5 flex flex-wrap items-center justify-center gap-x-5 gap-y-2 text-sm font-medium">
                <span class="inline-flex items-center gap-1.5"><x-lucide-calendar class="size-4" /> Sep 24–25, 2026</span>
                <span class="inline-flex items-center gap-1.5"><x-lucide-map-pin class="size-4" /> San Francisco</span>
                <span class="inline-flex items-center gap-1.5"><x-lucide-users class="size-4" /> 1,200 builders</span>
            </div>
            <h1 class="text-5xl font-bold tracking-tight text-balance sm:text-6xl lg:text-7xl">ShipConf <span class="text-primary">2026</span></h1>
            <p class="text-muted-foreground mx-auto mt-5 max-w-xl text-lg text-balance">Two days of talks, workshops and hallway conversations for people who build for the web.</p>
            <div class="mt-8 flex flex-wrap justify-center gap-3">
                <x-ui.button size="lg" href="#tickets">Get your ticket <x-lucide-arrow-right class="size-4" /></x-ui.button>
                <x-ui.button size="lg" variant="outline"><x-lucide-play class="size-4" /> Watch 2025 recap</x-ui.button>
            </div>
        </div>
    </section>

    {{-- Speakers --}}
    <section id="speakers" class="scroll-mt-20 py-20">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-10 text-center"><x-ui.badge variant="outline" class="mb-3">Speakers</x-ui.badge><h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Learn from the best</h2></div>
            <div class="grid grid-cols-2 gap-6 sm:grid-cols-4">
                @foreach ($speakers as $s)
                    <div class="text-center">
                        <x-ui.avatar class="mx-auto size-20"><x-ui.avatar-fallback class="text-lg">{{ $s['i'] }}</x-ui.avatar-fallback></x-ui.avatar>
                        <div class="mt-3 font-semibold">{{ $s['n'] }}</div>
                        <div class="text-muted-foreground text-sm">{{ $s['r'] }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Schedule --}}
    <section id="schedule" class="bg-muted/30 scroll-mt-20 border-y py-20">
        <div class="mx-auto max-w-3xl px-6">
            <div class="mb-10 text-center"><x-ui.badge variant="outline" class="mb-3">Schedule</x-ui.badge><h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Two packed days</h2></div>
            <x-ui.tabs value="day1" class="w-full">
                <x-ui.tabs-list class="mx-auto grid w-full max-w-xs grid-cols-2">
                    <x-ui.tabs-trigger value="day1">Day 1 · Sep 24</x-ui.tabs-trigger>
                    <x-ui.tabs-trigger value="day2">Day 2 · Sep 25</x-ui.tabs-trigger>
                </x-ui.tabs-list>
                @foreach ($schedule as $day => $sessions)
                    <x-ui.tabs-content value="{{ $day }}" class="mt-6">
                        <div class="divide-y rounded-xl border bg-card">
                            @foreach ($sessions as [$time, $title, $who, $track, $tone])
                                <div class="flex items-center gap-4 p-4">
                                    <div class="text-muted-foreground w-16 shrink-0 text-sm font-medium tabular-nums">{{ $time }}</div>
                                    <div class="min-w-0 flex-1">
                                        <div class="font-medium">{{ $title }}</div>
                                        <div class="text-muted-foreground text-sm">{{ $who }}</div>
                                    </div>
                                    <x-ui.badge :tone="$tone" variant="soft" class="shrink-0 capitalize">{{ $track }}</x-ui.badge>
                                </div>
                            @endforeach
                        </div>
                    </x-ui.tabs-content>
                @endforeach
            </x-ui.tabs>
        </div>
    </section>

    {{-- Tickets --}}
    <section id="tickets" class="scroll-mt-20 py-20">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mb-10 text-center"><x-ui.badge variant="outline" class="mb-3">Tickets</x-ui.badge><h2 class="text-3xl font-bold tracking-tight sm:text-4xl">Grab your seat</h2></div>
            <div class="grid items-stretch gap-6 lg:grid-cols-3">
                @foreach ($tickets as $t)
                    <x-ui.card @class(['flex flex-col', 'border-primary ring-primary/20 relative shadow-lg ring-1' => ($t['tag'] === 'Popular')])>
                        @if ($t['tag'])<x-ui.badge :tone="$t['sold'] ? 'neutral' : 'primary'" class="absolute -top-3 left-1/2 -translate-x-1/2">{{ $t['tag'] }}</x-ui.badge>@endif
                        <h3 class="font-semibold">{{ $t['name'] }}</h3>
                        <div class="mt-3 flex items-baseline gap-1"><span class="text-4xl font-bold tracking-tight">${{ $t['price'] }}</span></div>
                        <x-ui.button class="mt-5 w-full" :variant="($t['tag'] === 'Popular') ? 'default' : 'outline'" :disabled="$t['sold']">{{ $t['sold'] ? 'Sold out' : 'Buy ticket' }}</x-ui.button>
                        <x-ui.separator class="my-5" />
                        <ul class="space-y-3 text-sm">
                            @foreach ($t['feats'] as $f)<li class="flex items-start gap-2.5"><x-lucide-check class="text-primary mt-0.5 size-4 shrink-0" /> {{ $f }}</li>@endforeach
                        </ul>
                    </x-ui.card>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Sponsors --}}
    <section class="bg-muted/30 border-y py-12">
        <p class="text-muted-foreground mb-6 text-center text-sm">Proudly sponsored by</p>
        <x-ui.marquee fade :duration="'26s'" class="mx-auto max-w-4xl">
            @foreach (['Vercel', 'Stripe', 'Linear', 'Supabase', 'Resend', 'Raycast', 'Fly.io'] as $name)<span class="text-muted-foreground/70 px-3 text-xl font-semibold whitespace-nowrap">{{ $name }}</span>@endforeach
        </x-ui.marquee>
    </section>

    {{-- FAQ --}}
    <section class="py-20">
        <div class="mx-auto max-w-3xl px-6">
            <h2 class="mb-8 text-center text-3xl font-bold tracking-tight sm:text-4xl">Good to know</h2>
            <x-ui.accordion type="single" collapsible class="w-full">
                @foreach ($faqs as $i => $faq)<x-ui.accordion-item value="f-{{ $i }}"><x-ui.accordion-trigger>{{ $faq['q'] }}</x-ui.accordion-trigger><x-ui.accordion-content>{{ $faq['a'] }}</x-ui.accordion-content></x-ui.accordion-item>@endforeach
            </x-ui.accordion>
        </div>
    </section>

    <footer class="border-t py-8">
        <div class="text-muted-foreground mx-auto flex max-w-6xl flex-col items-center justify-between gap-3 px-6 text-sm sm:flex-row">
            <span>© {{ date('Y') }} ShipConf. See you in September.</span>
            <span class="inline-flex items-center gap-1.5"><x-lucide-map-pin class="size-4" /> The Pier Pavilion, San Francisco</span>
        </div>
    </footer>
</x-layouts.app>
