<div class="flex flex-col gap-5">
    {{-- Per-button: the `color` prop recolors a single button (use a shade dark enough for white text). --}}
    <div class="flex flex-wrap items-center gap-3">
        <x-ui.button color="#047857">Emerald</x-ui.button>
        <x-ui.button color="#6d28d9">Violet</x-ui.button>
        <x-ui.button color="#c2410c">Orange</x-ui.button>
        <x-ui.button color="#0e7490">Cyan</x-ui.button>
    </div>

    {{-- Subtree: set the theme tokens on a wrapper and every component inside recolors. --}}
    <div style="--primary: #be185d; --primary-foreground: #ffffff; --ring: #be185d;" class="flex flex-wrap items-center gap-3 rounded-lg border p-4">
        <x-ui.button>Primary</x-ui.button>
        <x-ui.button variant="outline">Outline</x-ui.button>
        <x-ui.badge>Badge</x-ui.badge>
        <x-ui.switch :checked="true" aria-label="Notifications" />
        <span class="text-muted-foreground text-sm">— one wrapper, one accent.</span>
    </div>
</div>
