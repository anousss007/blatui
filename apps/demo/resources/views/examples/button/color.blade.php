<div class="flex flex-col gap-5">
    {{-- Per-button: the `color` prop recolors a single button. --}}
    <div class="flex flex-wrap items-center gap-3">
        <x-ui.button color="#16a34a">Emerald</x-ui.button>
        <x-ui.button color="#7c3aed">Violet</x-ui.button>
        <x-ui.button color="#ea580c">Orange</x-ui.button>
        <x-ui.button color="#0891b2">Cyan</x-ui.button>
    </div>

    {{-- Subtree: set the theme tokens on a wrapper and every component inside recolors. --}}
    <div style="--primary: #db2777; --primary-foreground: #ffffff; --ring: #db2777;" class="flex flex-wrap items-center gap-3 rounded-lg border p-4">
        <x-ui.button>Primary</x-ui.button>
        <x-ui.button variant="outline">Outline</x-ui.button>
        <x-ui.badge>Badge</x-ui.badge>
        <x-ui.switch :checked="true" />
        <span class="text-muted-foreground text-sm">— one wrapper, one accent.</span>
    </div>
</div>
