@php
    $nav = ['Features' => '#features', 'Solutions' => '#spotlight', 'Pricing' => '#pricing', 'FAQ' => '#faq'];

    $logos = ['Acme', 'Globex', 'Initech', 'Umbrella', 'Soylent', 'Hooli', 'Stark', 'Wayne'];

    $features = [
        ['icon' => 'gauge', 'title' => 'Real-time analytics', 'desc' => 'Live dashboards that update the moment your data does — no refresh, no waiting.'],
        ['icon' => 'workflow', 'title' => 'Visual automations', 'desc' => 'Wire up triggers and actions on a canvas. Ship workflows without touching code.'],
        ['icon' => 'users', 'title' => 'Built for teams', 'desc' => 'Roles, comments and shared views so everyone stays on the same page.'],
        ['icon' => 'shield-check', 'title' => 'SOC 2 secure', 'desc' => 'Encryption at rest and in transit, SSO, and audit logs out of the box.'],
        ['icon' => 'zap', 'title' => 'Fast by default', 'desc' => 'A snappy UI on an edge network, anywhere your customers are.'],
        ['icon' => 'layers', 'title' => '80+ integrations', 'desc' => 'Connect the tools you already use — or build your own with the API.'],
    ];

    $spotlight = [
        'dashboards' => ['label' => 'Dashboards', 'icon' => 'chart-column', 'title' => 'See everything at a glance', 'desc' => 'Drag-and-drop widgets, saved views and scheduled reports keep your whole team aligned around the numbers that matter.', 'points' => ['Drag-and-drop layout', 'Saved & shared views', 'Scheduled email reports']],
        'automations' => ['label' => 'Automations', 'icon' => 'workflow', 'title' => 'Put the busywork on autopilot', 'desc' => 'Trigger actions from any event, branch on conditions, and let Nimbus handle the rest — 24/7.', 'points' => ['Event triggers', 'Conditional branching', 'Retries & alerts']],
        'collaboration' => ['label' => 'Collaboration', 'icon' => 'message-circle', 'title' => 'Decide together, faster', 'desc' => 'Comment in context, @mention teammates and resolve threads without leaving the data.', 'points' => ['Inline comments', '@mentions & notifications', 'Read/edit permissions']],
    ];

    $stats = [['v' => '12k+', 'l' => 'Teams onboard'], ['v' => '99.99%', 'l' => 'Uptime SLA'], ['v' => '4.9/5', 'l' => 'Average rating'], ['v' => '180+', 'l' => 'Countries']];

    $testimonials = [
        ['q' => 'We replaced three tools with Nimbus and shipped our first automated report in an afternoon. The team actually enjoys using it.', 'a' => 'Sofia Davis', 'r' => 'VP Operations, Acme', 'img' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?w=160&q=80'],
        ['q' => 'The dashboards are gorgeous and fast. Onboarding our analysts took minutes, not weeks.', 'a' => 'Marcus Chen', 'r' => 'Head of Data, Globex', 'img' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?w=160&q=80'],
        ['q' => 'Security review passed on the first try. SSO, audit logs, SOC 2 — it was all just there.', 'a' => 'Priya Nair', 'r' => 'CISO, Umbrella', 'img' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=160&q=80'],
    ];

    $plans = [
        ['name' => 'Starter', 'm' => 0, 'y' => 0, 'tag' => 'For side projects', 'cta' => 'Start free', 'highlight' => false, 'features' => ['Up to 3 dashboards', '1 automation', 'Community support', '7-day history']],
        ['name' => 'Pro', 'm' => 29, 'y' => 24, 'tag' => 'For growing teams', 'cta' => 'Start free trial', 'highlight' => true, 'features' => ['Unlimited dashboards', '50 automations', 'Priority support', '1-year history', 'SSO & roles']],
        ['name' => 'Enterprise', 'm' => 99, 'y' => 82, 'tag' => 'For organizations', 'cta' => 'Contact sales', 'highlight' => false, 'features' => ['Everything in Pro', 'Unlimited automations', 'SAML & SCIM', 'Audit logs', 'Dedicated CSM']],
    ];

    $faqs = [
        ['q' => 'Is there a free plan?', 'a' => 'Yes — the Starter plan is free forever and includes up to 3 dashboards and 1 automation. No credit card required.'],
        ['q' => 'Can I cancel anytime?', 'a' => 'Absolutely. Plans are month-to-month (or save ~17% annually). Cancel from settings with one click — no calls, no emails.'],
        ['q' => 'Do you support SSO?', 'a' => 'SSO via Google and Microsoft is available on Pro; SAML and SCIM provisioning ship with Enterprise.'],
        ['q' => 'How does pricing scale?', 'a' => 'Pricing is per workspace, not per seat, so adding teammates never increases your bill.'],
        ['q' => 'Where is my data hosted?', 'a' => 'On an SOC 2 Type II compliant edge network with encryption at rest and in transit. Choose your data region on Enterprise.'],
    ];

    $footer = [
        'Product' => ['Features', 'Integrations', 'Pricing', 'Changelog', 'Roadmap'],
        'Company' => ['About', 'Careers', 'Blog', 'Customers', 'Contact'],
        'Resources' => ['Documentation', 'Guides', 'API reference', 'Status', 'Community'],
        'Legal' => ['Privacy', 'Terms', 'Security', 'DPA', 'Cookies'],
    ];
@endphp

<x-layouts.app title="Nimbus — Analytics for modern teams">
    {{-- Announcement --}}
    <x-ui.banner tone="primary" id="nimbus-launch" persist>
        <span class="inline-flex items-center gap-2"><x-lucide-sparkles class="size-4" /> Nimbus 2.0 is here — automations, faster dashboards & SSO.</span>
        <a href="#pricing" class="font-semibold underline underline-offset-2">See what's new</a>
    </x-ui.banner>

    {{-- Nav --}}
    <header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-40 border-b backdrop-blur-xl">
        <div class="mx-auto flex h-16 max-w-6xl items-center gap-4 px-6">
            <a href="#" class="flex items-center gap-2 font-semibold tracking-tight">
                <span class="bg-primary text-primary-foreground flex size-8 items-center justify-center rounded-lg"><x-lucide-cloud class="size-5" /></span>
                Nimbus
            </a>
            <nav class="ml-4 hidden items-center gap-1 text-sm md:flex">
                @foreach ($nav as $label => $href)
                    <a href="{{ $href }}" class="text-muted-foreground hover:text-foreground hover:bg-accent/60 rounded-md px-3 py-1.5 font-medium transition-colors">{{ $label }}</a>
                @endforeach
            </nav>
            <div class="ml-auto flex items-center gap-1.5">
                <button type="button" @click="$store.theme && $store.theme.toggle()" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Toggle theme">
                    <x-lucide-sun class="size-4 dark:hidden" /><x-lucide-moon class="hidden size-4 dark:block" />
                </button>
                <x-ui.button href="#" variant="ghost" size="sm" class="hidden sm:inline-flex">Sign in</x-ui.button>
                <x-ui.button href="#pricing" size="sm" class="hidden sm:inline-flex">Get started <x-lucide-arrow-right class="size-4" /></x-ui.button>
                {{-- Mobile menu --}}
                <x-ui.sheet>
                    <x-ui.sheet-trigger class="md:hidden">
                        <x-ui.button variant="outline" size="icon" aria-label="Open menu"><x-lucide-menu class="size-4" /></x-ui.button>
                    </x-ui.sheet-trigger>
                    <x-ui.sheet-content side="right">
                        <x-ui.sheet-header>
                            <x-ui.sheet-title>Nimbus</x-ui.sheet-title>
                        </x-ui.sheet-header>
                        <nav class="grid gap-1 px-4 text-sm">
                            @foreach ($nav as $label => $href)
                                <a href="{{ $href }}" @click="open = false" class="hover:bg-accent rounded-md px-3 py-2 font-medium">{{ $label }}</a>
                            @endforeach
                        </nav>
                        <x-ui.sheet-footer>
                            <x-ui.button href="#pricing" class="w-full">Get started</x-ui.button>
                            <x-ui.button href="#" variant="outline" class="w-full">Sign in</x-ui.button>
                        </x-ui.sheet-footer>
                    </x-ui.sheet-content>
                </x-ui.sheet>
            </div>
        </div>
    </header>

    {{-- Hero --}}
    <section class="relative overflow-hidden border-b">
        <div class="pointer-events-none absolute inset-x-0 -top-40 -z-10 flex justify-center">
            <div class="from-primary/25 h-[28rem] w-[60rem] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div>
        </div>
        <div class="mx-auto grid max-w-6xl items-center gap-12 px-6 py-20 lg:grid-cols-2 lg:py-28">
            <div>
                <x-ui.badge tone="primary" variant="soft" class="mb-5 gap-1.5"><x-lucide-rocket class="size-3.5" /> New · Automations &amp; SSO</x-ui.badge>
                <h1 class="text-4xl font-bold tracking-tight text-balance sm:text-5xl lg:text-6xl">
                    Ship
                    <x-ui.typewriter :words="['faster', 'smarter', 'together']" class="text-primary" />
                    <br class="hidden sm:block" />with one source of truth.
                </h1>
                <p class="text-muted-foreground mt-5 max-w-lg text-lg text-balance">
                    Nimbus turns your scattered data into live dashboards and hands-off automations — so your
                    whole team makes faster decisions, together.
                </p>
                <div class="mt-7 flex flex-wrap items-center gap-3">
                    <x-ui.button href="#pricing" size="lg">Start free <x-lucide-arrow-right class="size-4" /></x-ui.button>
                    <x-ui.button href="#spotlight" size="lg" variant="outline"><x-lucide-play class="size-4" /> Watch demo</x-ui.button>
                </div>
                <div class="mt-8 flex items-center gap-4">
                    <div class="flex -space-x-2">
                        @foreach (['1494790108377-be9c29b29330', '1500648767791-00dcc994a43e', '1438761681033-6461ffad8d80', '1472099645785-5658abf4ff4e'] as $id)
                            <x-ui.avatar class="ring-background size-9 ring-2">
                                <x-ui.avatar-image src="https://images.unsplash.com/photo-{{ $id }}?w=80&q=80" alt="" />
                                <x-ui.avatar-fallback>N</x-ui.avatar-fallback>
                            </x-ui.avatar>
                        @endforeach
                    </div>
                    <div class="text-sm">
                        <div class="flex text-amber-500">@for ($i = 0; $i < 5; $i++)<x-lucide-star class="size-4 fill-current" />@endfor</div>
                        <span class="text-muted-foreground">Loved by <span class="text-foreground font-medium">12,000+</span> teams</span>
                    </div>
                </div>
            </div>

            {{-- Product mock --}}
            <div class="relative">
                <div class="bg-card rounded-xl border shadow-2xl">
                    <div class="flex items-center gap-1.5 border-b px-4 py-3">
                        <span class="size-3 rounded-full bg-red-400"></span><span class="size-3 rounded-full bg-amber-400"></span><span class="size-3 rounded-full bg-emerald-400"></span>
                        <div class="bg-muted text-muted-foreground ml-3 flex-1 truncate rounded px-2 py-1 text-xs">app.nimbus.io/dashboard</div>
                    </div>
                    <div class="space-y-4 p-5">
                        <div class="grid grid-cols-3 gap-3">
                            @foreach ([['Revenue', '$84.2k', '+12.5%'], ['Active', '5,210', '+4.1%'], ['Churn', '1.8%', '-0.6%']] as [$l, $v, $d])
                                <div class="bg-muted/40 rounded-lg border p-3">
                                    <div class="text-muted-foreground text-xs">{{ $l }}</div>
                                    <div class="mt-1 text-lg font-semibold">{{ $v }}</div>
                                    <div class="text-primary text-xs font-medium">{{ $d }}</div>
                                </div>
                            @endforeach
                        </div>
                        <div class="bg-muted/40 rounded-lg border p-4">
                            <div class="mb-3 flex items-center justify-between">
                                <span class="text-sm font-medium">Visitors</span>
                                <x-ui.badge tone="success" variant="soft" class="text-xs">Live</x-ui.badge>
                            </div>
                            <div class="flex h-28 items-end gap-1.5">
                                @foreach ([40, 55, 48, 70, 62, 85, 78, 95, 88, 100, 92, 76] as $h)
                                    <div class="bg-primary/80 hover:bg-primary flex-1 rounded-t transition-colors" style="height: {{ $h }}%"></div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Logo wall --}}
    <section class="border-b py-10">
        <p class="text-muted-foreground mb-6 text-center text-sm">Trusted by fast-moving teams worldwide</p>
        <x-ui.marquee fade :duration="'32s'" class="mx-auto max-w-5xl">
            @foreach ($logos as $name)
                <span class="text-muted-foreground/70 px-2 text-xl font-semibold whitespace-nowrap">{{ $name }}</span>
            @endforeach
        </x-ui.marquee>
    </section>

    {{-- Features --}}
    <section id="features" class="scroll-mt-20 py-20 lg:py-28">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mx-auto max-w-2xl text-center">
                <x-ui.badge variant="outline" class="mb-4">Features</x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight text-balance sm:text-4xl">Everything you need to move faster</h2>
                <p class="text-muted-foreground mt-3 text-lg text-balance">One platform for analytics, automation and collaboration — so your team stops switching tabs and starts shipping.</p>
            </div>
            <div class="mt-14 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($features as $f)
                    <x-ui.card class="transition-shadow hover:shadow-md">
                        <div class="bg-primary/10 text-primary mb-4 inline-flex size-11 items-center justify-center rounded-lg">
                            <x-dynamic-component :component="'lucide-'.$f['icon']" class="size-5" />
                        </div>
                        <h3 class="font-semibold">{{ $f['title'] }}</h3>
                        <p class="text-muted-foreground mt-1.5 text-sm">{{ $f['desc'] }}</p>
                    </x-ui.card>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Spotlight (tabs) --}}
    <section id="spotlight" class="bg-muted/30 scroll-mt-20 border-y py-20 lg:py-28">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mx-auto mb-12 max-w-2xl text-center">
                <x-ui.badge variant="outline" class="mb-4">How it works</x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight text-balance sm:text-4xl">A closer look</h2>
            </div>
            <x-ui.tabs value="dashboards" class="mx-auto w-full max-w-4xl">
                <x-ui.tabs-list class="mx-auto grid w-full max-w-md grid-cols-3">
                    @foreach ($spotlight as $key => $s)
                        <x-ui.tabs-trigger value="{{ $key }}">{{ $s['label'] }}</x-ui.tabs-trigger>
                    @endforeach
                </x-ui.tabs-list>
                @foreach ($spotlight as $key => $s)
                    <x-ui.tabs-content value="{{ $key }}" class="mt-8">
                        <div class="grid items-center gap-8 lg:grid-cols-2">
                            <div>
                                <div class="bg-primary/10 text-primary mb-4 inline-flex size-11 items-center justify-center rounded-lg"><x-dynamic-component :component="'lucide-'.$s['icon']" class="size-5" /></div>
                                <h3 class="text-2xl font-semibold tracking-tight">{{ $s['title'] }}</h3>
                                <p class="text-muted-foreground mt-3">{{ $s['desc'] }}</p>
                                <ul class="mt-5 space-y-2.5 text-sm">
                                    @foreach ($s['points'] as $p)
                                        <li class="flex items-center gap-2.5"><span class="bg-primary/10 text-primary inline-flex size-5 items-center justify-center rounded-full"><x-lucide-check class="size-3.5" /></span> {{ $p }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="bg-card aspect-[4/3] overflow-hidden rounded-xl border shadow-sm">
                                <img src="https://images.unsplash.com/photo-1551288049-bebda4e38f71?w=900&q=80" alt="{{ $s['title'] }}" loading="lazy" class="size-full object-cover" />
                            </div>
                        </div>
                    </x-ui.tabs-content>
                @endforeach
            </x-ui.tabs>
        </div>
    </section>

    {{-- Stats --}}
    <section class="py-16">
        <div class="mx-auto grid max-w-5xl grid-cols-2 gap-8 px-6 text-center lg:grid-cols-4">
            @foreach ($stats as $s)
                <div>
                    <div class="text-4xl font-bold tracking-tight">{{ $s['v'] }}</div>
                    <div class="text-muted-foreground mt-1 text-sm">{{ $s['l'] }}</div>
                </div>
            @endforeach
        </div>
    </section>

    {{-- Testimonials --}}
    <section class="bg-muted/30 border-y py-20 lg:py-28">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mx-auto mb-12 max-w-2xl text-center">
                <x-ui.badge variant="outline" class="mb-4">Testimonials</x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight text-balance sm:text-4xl">Teams ship more with Nimbus</h2>
            </div>
            <div class="grid gap-6 lg:grid-cols-3">
                @foreach ($testimonials as $t)
                    <x-ui.card class="flex flex-col">
                        <x-ui.quote author="{{ $t['a'] }}" role="{{ $t['r'] }}" avatar="{{ $t['img'] }}" class="max-w-none [&_blockquote]:text-base [&_blockquote]:font-normal">{{ $t['q'] }}</x-ui.quote>
                    </x-ui.card>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Pricing --}}
    <section id="pricing" class="scroll-mt-20 py-20 lg:py-28" x-data="{ yearly: false }">
        <div class="mx-auto max-w-6xl px-6">
            <div class="mx-auto mb-10 max-w-2xl text-center">
                <x-ui.badge variant="outline" class="mb-4">Pricing</x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight text-balance sm:text-4xl">Simple, per-workspace pricing</h2>
                <p class="text-muted-foreground mt-3 text-lg">Start free. Upgrade when you're ready. Adding teammates never costs more.</p>
                <div class="mt-6 inline-flex items-center gap-1 rounded-lg border p-1 text-sm">
                    <button type="button" @click="yearly = false" :class="!yearly ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:text-foreground'" class="rounded-md px-3 py-1.5 font-medium transition-colors">Monthly</button>
                    <button type="button" @click="yearly = true" :class="yearly ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:text-foreground'" class="inline-flex items-center gap-1.5 rounded-md px-3 py-1.5 font-medium transition-colors">Yearly <x-ui.badge tone="success" variant="soft" class="text-[10px]">-17%</x-ui.badge></button>
                </div>
            </div>
            <div class="grid items-stretch gap-6 lg:grid-cols-3">
                @foreach ($plans as $plan)
                    <x-ui.card @class(['flex flex-col', 'border-primary ring-primary/20 relative shadow-lg ring-1' => $plan['highlight']])>
                        @if ($plan['highlight'])
                            <x-ui.badge tone="primary" class="absolute -top-3 left-1/2 -translate-x-1/2">Most popular</x-ui.badge>
                        @endif
                        <h3 class="text-lg font-semibold">{{ $plan['name'] }}</h3>
                        <p class="text-muted-foreground text-sm">{{ $plan['tag'] }}</p>
                        <div class="mt-4 flex items-baseline gap-1">
                            <span class="text-4xl font-bold tracking-tight">$<span x-text="yearly ? {{ $plan['y'] }} : {{ $plan['m'] }}">{{ $plan['m'] }}</span></span>
                            <span class="text-muted-foreground text-sm">/mo</span>
                        </div>
                        <x-ui.button href="#" class="mt-5 w-full" :variant="$plan['highlight'] ? 'default' : 'outline'">{{ $plan['cta'] }}</x-ui.button>
                        <x-ui.separator class="my-5" />
                        <ul class="space-y-3 text-sm">
                            @foreach ($plan['features'] as $feat)
                                <li class="flex items-start gap-2.5"><x-lucide-check class="text-primary mt-0.5 size-4 shrink-0" /> {{ $feat }}</li>
                            @endforeach
                        </ul>
                    </x-ui.card>
                @endforeach
            </div>
        </div>
    </section>

    {{-- FAQ --}}
    <section id="faq" class="bg-muted/30 scroll-mt-20 border-y py-20 lg:py-28">
        <div class="mx-auto max-w-3xl px-6">
            <div class="mb-10 text-center">
                <x-ui.badge variant="outline" class="mb-4">FAQ</x-ui.badge>
                <h2 class="text-3xl font-bold tracking-tight text-balance sm:text-4xl">Questions, answered</h2>
            </div>
            <x-ui.accordion type="single" collapsible class="w-full">
                @foreach ($faqs as $i => $faq)
                    <x-ui.accordion-item value="faq-{{ $i }}">
                        <x-ui.accordion-trigger>{{ $faq['q'] }}</x-ui.accordion-trigger>
                        <x-ui.accordion-content>{{ $faq['a'] }}</x-ui.accordion-content>
                    </x-ui.accordion-item>
                @endforeach
            </x-ui.accordion>
        </div>
    </section>

    {{-- CTA --}}
    <section class="py-20 lg:py-28">
        <div class="mx-auto max-w-5xl px-6">
            <div class="from-primary to-primary/80 text-primary-foreground relative overflow-hidden rounded-3xl bg-gradient-to-br p-10 text-center shadow-xl lg:p-16">
                <h2 class="text-3xl font-bold tracking-tight text-balance sm:text-4xl">Start shipping with Nimbus today</h2>
                <p class="text-primary-foreground/80 mx-auto mt-3 max-w-xl text-balance">Free for side projects. A 14-day trial on Pro — no credit card required.</p>
                <div class="mx-auto mt-6 flex max-w-sm items-center gap-2 rounded-lg bg-black/15 p-1.5 font-mono text-sm">
                    <span class="text-primary-foreground/60 pl-2">$</span>
                    <span class="flex-1 truncate text-left">npx create-nimbus@latest</span>
                    <x-ui.copy-button value="npx create-nimbus@latest" class="text-primary-foreground hover:bg-white/15" />
                </div>
                <div class="mt-6 flex flex-wrap justify-center gap-3">
                    <x-ui.button href="#" size="lg" variant="secondary">Get started free <x-lucide-arrow-right class="size-4" /></x-ui.button>
                    <x-ui.button href="#" size="lg" class="border-primary-foreground/30 text-primary-foreground hover:bg-white/10 border bg-transparent">Talk to sales</x-ui.button>
                </div>
            </div>
        </div>
    </section>

    {{-- Footer --}}
    <footer class="border-t">
        <div class="mx-auto max-w-6xl px-6 py-14">
            <div class="grid gap-10 sm:grid-cols-2 lg:grid-cols-6">
                <div class="lg:col-span-2">
                    <a href="#" class="flex items-center gap-2 font-semibold">
                        <span class="bg-primary text-primary-foreground flex size-8 items-center justify-center rounded-lg"><x-lucide-cloud class="size-5" /></span> Nimbus
                    </a>
                    <p class="text-muted-foreground mt-3 max-w-xs text-sm">Analytics, automation and collaboration for modern teams.</p>
                    <div class="mt-5 flex gap-2">
                        @foreach (['github', 'twitter', 'linkedin', 'youtube'] as $s)
                            <a href="#" aria-label="{{ $s }}" class="text-muted-foreground hover:text-foreground hover:bg-accent inline-flex size-9 items-center justify-center rounded-md border transition-colors"><x-dynamic-component :component="'lucide-'.$s" class="size-4" /></a>
                        @endforeach
                    </div>
                </div>
                @foreach ($footer as $heading => $links)
                    <div>
                        <h3 class="text-sm font-semibold">{{ $heading }}</h3>
                        <ul class="mt-3 space-y-2 text-sm">
                            @foreach ($links as $link)
                                <li><a href="#" class="text-muted-foreground hover:text-foreground transition-colors">{{ $link }}</a></li>
                            @endforeach
                        </ul>
                    </div>
                @endforeach
            </div>
            <x-ui.separator class="my-8" />
            <div class="text-muted-foreground flex flex-col items-center justify-between gap-3 text-sm sm:flex-row">
                <span>© {{ date('Y') }} Nimbus, Inc. All rights reserved.</span>
                <span class="flex items-center gap-1.5"><x-lucide-shield-check class="size-4" /> SOC 2 Type II · GDPR ready</span>
            </div>
        </div>
    </footer>
</x-layouts.app>
