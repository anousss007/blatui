<x-ui.accent color="#7c3aed" class="flex max-w-sm flex-col gap-4 rounded-xl border p-5">
    <div class="flex flex-wrap items-center gap-2">
        <x-ui.button>Subscribe</x-ui.button>
        <x-ui.button variant="outline">Maybe later</x-ui.button>
        <x-ui.badge>Pro</x-ui.badge>
    </div>
    <div class="flex items-center gap-3">
        <x-ui.checkbox id="acc-terms" :checked="true" />
        <x-ui.label for="acc-terms">Email me product updates</x-ui.label>
        <x-ui.switch :checked="true" class="ml-auto" />
    </div>
    <x-ui.input placeholder="you@example.com" />
    <p class="text-muted-foreground text-xs">
        Every control recolours from one <code>color</code> on the wrapper — buttons, badges,
        checkboxes, switches and focus rings.
    </p>
</x-ui.accent>
