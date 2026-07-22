{{-- Pass any CSS colour to `color` to tint the glow. --}}
<div class="grid gap-4 sm:grid-cols-2">
    <x-ui.spotlight-card color="color-mix(in oklab, var(--primary) 35%, transparent)">
        <h3 class="text-base font-semibold">Primary glow</h3>
        <p class="text-muted-foreground mt-2 text-sm">
            Tinted with the theme's primary token, so it stays on-brand in
            light and dark.
        </p>
    </x-ui.spotlight-card>

    <x-ui.spotlight-card color="rgba(168,85,247,0.4)" :size="280">
        <h3 class="text-base font-semibold">Violet glow</h3>
        <p class="text-muted-foreground mt-2 text-sm">
            A tighter, custom-coloured spotlight using an explicit rgba value
            and a smaller radius.
        </p>
    </x-ui.spotlight-card>
</div>
