<x-layouts.app title="Pricing 01">
    <div class="mx-auto max-w-6xl px-6 py-20 lg:px-8 lg:py-28">
        {{-- Heading --}}
        <div class="mx-auto max-w-2xl text-center">
            <x-ui.badge variant="secondary">Pricing</x-ui.badge>
            <h1 class="mt-4 text-4xl font-bold tracking-tight text-balance sm:text-5xl">Simple, transparent pricing</h1>
            <p class="text-muted-foreground mt-4 text-lg text-pretty">Start free. Upgrade as you grow. No hidden fees, cancel anytime.</p>
        </div>

        {{-- Tiers --}}
        @php
            $tiers = [
                [
                    'name' => 'Hobby',
                    'price' => '$0',
                    'cadence' => '/month',
                    'desc' => 'For side projects and trying things out.',
                    'featured' => false,
                    'cta' => 'Start for free',
                    'variant' => 'outline',
                    'features' => ['1 project', '10k requests / mo', 'Community support', 'Basic analytics'],
                ],
                [
                    'name' => 'Pro',
                    'price' => '$29',
                    'cadence' => '/month',
                    'desc' => 'For growing teams shipping to production.',
                    'featured' => true,
                    'cta' => 'Start free trial',
                    'variant' => 'default',
                    'features' => ['Unlimited projects', '1M requests / mo', 'Priority support', 'Advanced analytics', 'Custom domains', 'Team roles'],
                ],
                [
                    'name' => 'Enterprise',
                    'price' => 'Custom',
                    'cadence' => '',
                    'desc' => 'For organizations with advanced needs.',
                    'featured' => false,
                    'cta' => 'Contact sales',
                    'variant' => 'outline',
                    'features' => ['Everything in Pro', 'SSO &amp; SAML', 'Dedicated support', 'SLA &amp; audit logs', 'On-prem option'],
                ],
            ];
        @endphp
        <div class="mt-14 grid items-start gap-6 lg:grid-cols-3">
            @foreach ($tiers as $tier)
                <x-ui.card @class(['relative h-full', 'border-primary shadow-lg' => $tier['featured']])>
                    @if ($tier['featured'])
                        <x-ui.badge class="absolute -top-3 left-1/2 -translate-x-1/2">Most popular</x-ui.badge>
                    @endif
                    <x-ui.card-header>
                        <x-ui.card-title>{{ $tier['name'] }}</x-ui.card-title>
                        <x-ui.card-description>{{ $tier['desc'] }}</x-ui.card-description>
                        <div class="mt-2 flex items-baseline gap-1">
                            <span class="text-4xl font-bold tracking-tight">{{ $tier['price'] }}</span>
                            <span class="text-muted-foreground text-sm">{{ $tier['cadence'] }}</span>
                        </div>
                    </x-ui.card-header>
                    <x-ui.card-content>
                        <ul class="space-y-3 text-sm">
                            @foreach ($tier['features'] as $feature)
                                <li class="flex items-center gap-2.5">
                                    <span class="bg-primary/10 text-primary flex size-5 shrink-0 items-center justify-center rounded-full">
                                        <x-lucide-check class="size-3" />
                                    </span>
                                    {!! $feature !!}
                                </li>
                            @endforeach
                        </ul>
                    </x-ui.card-content>
                    <x-ui.card-footer>
                        <x-ui.button class="w-full" variant="{{ $tier['variant'] }}" href="#">{{ $tier['cta'] }}</x-ui.button>
                    </x-ui.card-footer>
                </x-ui.card>
            @endforeach
        </div>

        <p class="text-muted-foreground mt-10 text-center text-sm">
            All plans include unlimited team members and a 14-day money-back guarantee.
        </p>
    </div>
</x-layouts.app>
