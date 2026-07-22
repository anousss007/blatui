<x-ui.card variant="sectioned" class="w-full max-w-sm">
    <x-ui.card-header>
        <x-ui.card-title>Premium</x-ui.card-title>
        <x-ui.card-description>For growing teams that need more power.</x-ui.card-description>
        <x-ui.card-action><x-ui.badge>Popular</x-ui.badge></x-ui.card-action>
    </x-ui.card-header>
    <x-ui.card-content class="flex flex-col gap-5">
        <div class="flex items-baseline gap-1">
            <span class="text-4xl font-bold tracking-tight">$29</span>
            <span class="text-muted-foreground">/month</span>
        </div>
        <ul class="flex flex-col gap-2.5 text-sm">
            @foreach (['Unlimited projects', 'Advanced analytics', 'Priority support', '50 GB storage'] as $feat)
                <li class="flex items-center gap-2"><x-lucide-circle-check class="text-primary size-4 shrink-0" aria-hidden="true" /> {{ $feat }}</li>
            @endforeach
        </ul>
    </x-ui.card-content>
    <x-ui.card-footer>
        <x-ui.button class="w-full">Get started</x-ui.button>
    </x-ui.card-footer>
</x-ui.card>
