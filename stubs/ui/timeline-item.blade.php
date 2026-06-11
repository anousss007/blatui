@props([
    'icon' => null,     // lucide icon name shown in the dot; omit for a small solid dot
    'time' => null,     // optional timestamp / eyebrow shown above the title
    'title' => null,    // optional title; or compose freely via the slot
    'active' => false,  // highlight the dot in the primary colour
])

<li data-slot="timeline-item" {{ $attributes->twMerge('relative flex gap-4 pb-8 last:pb-0') }}>
    {{-- Marker column: dot + connecting line --}}
    <div class="relative flex flex-col items-center">
        <span
            data-slot="timeline-dot"
            @class([
                'z-10 flex size-8 shrink-0 items-center justify-center rounded-full border',
                'bg-primary text-primary-foreground border-primary' => $active,
                'bg-background text-muted-foreground' => ! $active,
            ])
        >
            @if ($icon)
                <x-dynamic-component :component="'lucide-'.$icon" class="size-4" aria-hidden="true" />
            @else
                <span @class(['size-2 rounded-full', 'bg-primary-foreground' => $active, 'bg-muted-foreground' => ! $active])></span>
            @endif
        </span>
        <span data-slot="timeline-line" class="bg-border mt-1 w-px flex-1" aria-hidden="true"></span>
    </div>

    {{-- Content --}}
    <div class="flex-1 pt-1 pb-1">
        @if ($time)
            <div data-slot="timeline-time" class="text-muted-foreground text-xs font-medium tabular-nums">{{ $time }}</div>
        @endif
        @if ($title)
            <h3 data-slot="timeline-title" class="text-sm font-semibold">{{ $title }}</h3>
        @endif
        @if (trim($slot) !== '')
            <div data-slot="timeline-content" class="text-muted-foreground mt-1 text-sm">{{ $slot }}</div>
        @endif
    </div>
</li>
