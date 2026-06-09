@php
    $plans = [
        ['name' => 'Free', 'm' => 0, 'y' => 0, 'tag' => 'For individuals getting started', 'cta' => 'Start free', 'highlight' => false],
        ['name' => 'Team', 'm' => 19, 'y' => 16, 'tag' => 'For small teams shipping fast', 'cta' => 'Start trial', 'highlight' => true],
        ['name' => 'Business', 'm' => 49, 'y' => 41, 'tag' => 'For scaling organizations', 'cta' => 'Start trial', 'highlight' => false],
        ['name' => 'Enterprise', 'm' => null, 'y' => null, 'tag' => 'For custom needs at scale', 'cta' => 'Contact sales', 'highlight' => false],
    ];

    // rows: feature => [Free, Team, Business, Enterprise]  (true | false | text)
    $matrix = [
        'Usage' => [
            'Projects' => ['3', 'Unlimited', 'Unlimited', 'Unlimited'],
            'Team members' => ['1', '10', '50', 'Unlimited'],
            'History retention' => ['7 days', '1 year', '3 years', 'Custom'],
            'API requests / mo' => ['1k', '100k', '1M', 'Custom'],
        ],
        'Features' => [
            'Automations' => [false, true, true, true],
            'Advanced analytics' => [false, true, true, true],
            'Audit logs' => [false, false, true, true],
            'Custom roles' => [false, false, true, true],
        ],
        'Security & support' => [
            'SSO (Google / Microsoft)' => [false, true, true, true],
            'SAML & SCIM' => [false, false, false, true],
            'Priority support' => [false, true, true, true],
            'Dedicated CSM' => [false, false, false, true],
        ],
    ];

    $faqs = [
        ['q' => 'Can I change plans later?', 'a' => 'Yes — upgrade or downgrade anytime from billing. Changes are prorated to the day.'],
        ['q' => 'Do you offer annual billing?', 'a' => 'Yes, save about 15% when you pay yearly. Toggle the switch above to see annual prices.'],
        ['q' => 'Is there a discount for nonprofits?', 'a' => 'We offer 50% off for registered nonprofits and free access for open-source projects. Contact sales.'],
        ['q' => 'What payment methods do you accept?', 'a' => 'All major cards via Stripe. Enterprise customers can pay by invoice and ACH.'],
    ];

    $cell = function ($v) {
        if ($v === true) {
            return '<span class="text-primary inline-flex"><svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M20 6 9 17l-5-5"/></svg><span class="sr-only">Included</span></span>';
        }
        if ($v === false) {
            return '<span class="text-muted-foreground/40 inline-flex"><svg class="size-4" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" aria-hidden="true"><path d="M5 12h14"/></svg><span class="sr-only">Not included</span></span>';
        }
        return '<span class="text-sm">'.$v.'</span>';
    };
@endphp

<x-layouts.app title="Pricing — Nimbus">
    {{-- Top bar --}}
    <header class="bg-background/80 supports-[backdrop-filter]:bg-background/60 sticky top-0 z-40 border-b backdrop-blur-xl">
        <div class="mx-auto flex h-16 max-w-6xl items-center px-6">
            <a href="/templates/saas/raw" class="flex items-center gap-2 font-semibold">
                <span class="bg-primary text-primary-foreground flex size-8 items-center justify-center rounded-lg"><x-lucide-cloud class="size-5" /></span> Nimbus
            </a>
            <div class="ml-auto flex items-center gap-2">
                <button type="button" @click="$store.theme && $store.theme.toggle()" class="hover:bg-accent inline-flex size-9 items-center justify-center rounded-md transition-colors" aria-label="Toggle theme"><x-lucide-sun class="size-4 dark:hidden" /><x-lucide-moon class="hidden size-4 dark:block" /></button>
                <x-ui.button href="#" size="sm">Get started</x-ui.button>
            </div>
        </div>
    </header>

    <div x-data="{ yearly: false }">
        {{-- Hero + toggle --}}
        <section class="relative overflow-hidden border-b py-16 text-center lg:py-20">
            <div class="pointer-events-none absolute inset-x-0 -top-32 -z-10 flex justify-center"><div class="from-primary/20 h-72 w-[640px] rounded-full bg-gradient-to-b to-transparent blur-3xl"></div></div>
            <div class="mx-auto max-w-2xl px-6">
                <x-ui.badge variant="outline" class="mb-4">Pricing</x-ui.badge>
                <h1 class="text-4xl font-bold tracking-tight text-balance sm:text-5xl">Plans that scale with you</h1>
                <p class="text-muted-foreground mt-3 text-lg text-balance">Start free. Upgrade when you're ready. Cancel anytime, no questions asked.</p>
                <div class="mt-6 inline-flex items-center gap-1 rounded-lg border p-1 text-sm">
                    <button type="button" @click="yearly = false" :class="!yearly ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:text-foreground'" class="rounded-md px-3 py-1.5 font-medium transition-colors">Monthly</button>
                    <button type="button" @click="yearly = true" :class="yearly ? 'bg-primary text-primary-foreground' : 'text-muted-foreground hover:text-foreground'" class="inline-flex items-center gap-1.5 rounded-md px-3 py-1.5 font-medium transition-colors">Yearly <x-ui.badge tone="success" variant="soft" class="text-[10px]">-15%</x-ui.badge></button>
                </div>
            </div>
        </section>

        {{-- Tier cards --}}
        <section class="py-14">
            <div class="mx-auto grid max-w-6xl items-stretch gap-6 px-6 md:grid-cols-2 lg:grid-cols-4">
                @foreach ($plans as $plan)
                    <x-ui.card @class(['flex flex-col', 'border-primary ring-primary/20 relative shadow-lg ring-1' => $plan['highlight']])>
                        @if ($plan['highlight'])<x-ui.badge tone="primary" class="absolute -top-3 left-1/2 -translate-x-1/2">Most popular</x-ui.badge>@endif
                        <h3 class="font-semibold">{{ $plan['name'] }}</h3>
                        <p class="text-muted-foreground mt-1 text-sm">{{ $plan['tag'] }}</p>
                        <div class="mt-4 flex items-baseline gap-1">
                            @if (is_null($plan['m']))
                                <span class="text-3xl font-bold tracking-tight">Custom</span>
                            @else
                                <span class="text-4xl font-bold tracking-tight">$<span x-text="yearly ? {{ $plan['y'] }} : {{ $plan['m'] }}">{{ $plan['m'] }}</span></span>
                                <span class="text-muted-foreground text-sm">/mo</span>
                            @endif
                        </div>
                        <x-ui.button href="#" class="mt-5 w-full" :variant="$plan['highlight'] ? 'default' : 'outline'">{{ $plan['cta'] }}</x-ui.button>
                    </x-ui.card>
                @endforeach
            </div>
        </section>

        {{-- Comparison table --}}
        <section class="border-y py-16">
            <div class="mx-auto max-w-6xl px-6">
                <h2 class="mb-8 text-center text-2xl font-bold tracking-tight sm:text-3xl">Compare every feature</h2>
                <div class="overflow-x-auto">
                    <x-ui.table class="min-w-[760px]">
                        <x-ui.table-header>
                            <x-ui.table-row>
                                <x-ui.table-head class="w-[34%]">Feature</x-ui.table-head>
                                @foreach ($plans as $plan)
                                    <x-ui.table-head class="text-center">{{ $plan['name'] }}</x-ui.table-head>
                                @endforeach
                            </x-ui.table-row>
                        </x-ui.table-header>
                        <x-ui.table-body>
                            @foreach ($matrix as $group => $rows)
                                <x-ui.table-row class="bg-muted/40">
                                    <x-ui.table-cell colspan="5" class="text-muted-foreground text-xs font-semibold uppercase tracking-wide">{{ $group }}</x-ui.table-cell>
                                </x-ui.table-row>
                                @foreach ($rows as $feature => $vals)
                                    <x-ui.table-row>
                                        <x-ui.table-cell class="font-medium">{{ $feature }}</x-ui.table-cell>
                                        @foreach ($vals as $v)
                                            <x-ui.table-cell class="text-center">{!! $cell($v) !!}</x-ui.table-cell>
                                        @endforeach
                                    </x-ui.table-row>
                                @endforeach
                            @endforeach
                        </x-ui.table-body>
                    </x-ui.table>
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="py-16">
            <div class="mx-auto max-w-3xl px-6">
                <h2 class="mb-8 text-center text-2xl font-bold tracking-tight sm:text-3xl">Pricing FAQ</h2>
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
    </div>

    {{-- CTA --}}
    <section class="border-t py-16">
        <div class="mx-auto max-w-4xl px-6 text-center">
            <h2 class="text-2xl font-bold tracking-tight sm:text-3xl">Still deciding?</h2>
            <p class="text-muted-foreground mt-2">Try Nimbus free for 14 days. No credit card, cancel anytime.</p>
            <div class="mt-6 flex flex-wrap justify-center gap-3">
                <x-ui.button size="lg" href="#">Start free trial <x-lucide-arrow-right class="size-4" /></x-ui.button>
                <x-ui.button size="lg" variant="outline" href="#">Talk to sales</x-ui.button>
            </div>
        </div>
    </section>
</x-layouts.app>
