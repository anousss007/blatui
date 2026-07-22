{{-- A tighter grid — smaller gap packs the dots closer together. --}}
<div class="bg-card text-card-foreground relative flex h-48 items-center justify-center overflow-hidden rounded-xl border p-8 shadow-sm">
    <x-ui.dot-pattern :gap="10" />

    <p class="text-muted-foreground relative text-sm">
        Dense grid (gap 10)
    </p>
</div>
