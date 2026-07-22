@php
    $nav = [
        'Main' => [
            ['Dashboard', 'layout-dashboard', true],
            ['Analytics', 'chart-column', false],
            ['Orders', 'shopping-cart', false],
            ['Customers', 'users', false],
            ['Products', 'package', false],
        ],
        'Workspace' => [
            ['Integrations', 'plug', false],
            ['Settings', 'settings', false],
            ['Help', 'circle-help', false],
        ],
    ];
@endphp

<div class="flex h-16 items-center gap-2 border-b px-5 font-semibold">
    <span class="bg-primary text-primary-foreground flex size-8 items-center justify-center rounded-lg"><x-lucide-command class="size-5" /></span> Acme Inc
</div>
<nav class="flex-1 space-y-6 overflow-y-auto p-4">
    @foreach ($nav as $section => $items)
        <div>
            <p class="text-muted-foreground mb-1.5 px-2 text-xs font-medium">{{ $section }}</p>
            <div class="space-y-0.5">
                @foreach ($items as [$label, $icon, $active])
                    <a href="#" @class(['flex items-center gap-2.5 rounded-md px-2.5 py-2 text-sm font-medium transition-colors', 'bg-accent text-accent-foreground' => $active, 'text-muted-foreground hover:text-foreground hover:bg-accent/60' => ! $active])>
                        <x-dynamic-component :component="'lucide-'.$icon" class="size-4" /> {{ $label }}
                    </a>
                @endforeach
            </div>
        </div>
    @endforeach
</nav>
<div class="border-t p-3">
    <div class="hover:bg-accent flex items-center gap-2.5 rounded-md p-2">
        <x-ui.avatar class="size-8"><x-ui.avatar-fallback>AD</x-ui.avatar-fallback></x-ui.avatar>
        <div class="min-w-0 flex-1 text-sm">
            <div class="truncate font-medium">Ada Lovelace</div>
            <div class="text-muted-foreground truncate text-xs">ada@acme.com</div>
        </div>
        <x-lucide-chevrons-up-down class="text-muted-foreground size-4" />
    </div>
</div>
