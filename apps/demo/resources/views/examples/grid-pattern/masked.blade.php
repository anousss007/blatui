{{-- :mask="true" fades the grid out toward the edges with a radial mask. --}}
<div class="bg-card relative flex h-64 w-full max-w-2xl items-center justify-center overflow-hidden rounded-xl border">
    <x-ui.grid-pattern :mask="true" />

    <div class="relative text-center">
        <h3 class="text-foreground text-2xl font-semibold tracking-tight">Soft edges</h3>
        <p class="text-muted-foreground mt-1 text-sm">The grid dissolves toward the borders.</p>
    </div>
</div>
