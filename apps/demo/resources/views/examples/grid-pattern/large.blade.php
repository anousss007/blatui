{{-- A wider cell size (:gap="48") for a bolder, more open grid. --}}
<div class="bg-card relative flex h-64 w-full max-w-2xl items-center justify-center overflow-hidden rounded-xl border">
    <x-ui.grid-pattern :gap="48" />

    <div class="relative text-center">
        <h3 class="text-foreground text-2xl font-semibold tracking-tight">48px cells</h3>
        <p class="text-muted-foreground mt-1 text-sm">Larger gaps for a more open pattern.</p>
    </div>
</div>
