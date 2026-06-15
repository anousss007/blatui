@php
    $steps = [
        [
            'target' => '#tour-search',
            'title' => 'Search anything',
            'body' => 'Jump to any project, file, or teammate from one box. Try ⌘K from anywhere.',
            'placement' => 'bottom',
        ],
        [
            'target' => '#tour-create',
            'title' => 'Create in one click',
            'body' => 'Spin up a new project, doc, or board here. We pre-fill sensible defaults.',
            'placement' => 'bottom',
        ],
        [
            'target' => '#tour-profile',
            'title' => 'Your workspace',
            'body' => 'Settings, billing, and theme live behind your avatar. That is the whole tour!',
            'placement' => 'left',
        ],
    ];
@endphp

<div class="w-full max-w-xl">
    {{-- A tiny faux app bar with three spotlight targets. --}}
    <div class="bg-card text-card-foreground flex items-center gap-3 rounded-lg border p-3">
        <input
            id="tour-search"
            type="text"
            placeholder="Search…"
            class="border-input bg-background placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 h-9 flex-1 rounded-md border px-3 text-sm shadow-xs outline-none focus-visible:ring-[3px]"
        />

        <x-ui.button id="tour-create" variant="default" size="sm">
            <x-lucide-plus />
            New
        </x-ui.button>

        <button
            id="tour-profile"
            type="button"
            class="bg-primary text-primary-foreground focus-visible:ring-ring/50 inline-flex size-9 shrink-0 items-center justify-center rounded-full text-sm font-medium outline-none focus-visible:ring-[3px]"
            aria-label="Open your workspace menu"
        >AB</button>
    </div>

    {{-- The tour itself. The Start button lives in the slot so it shares the tour's Alpine
         scope and can flip `active` on — no external wiring needed. --}}
    <x-ui.onboarding-tour :steps="$steps" class="mt-6 block">
        <x-ui.button variant="outline" @click="start()">
            <x-lucide-sparkles />
            Start tour
        </x-ui.button>
    </x-ui.onboarding-tour>
</div>
