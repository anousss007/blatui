{{-- A card that lifts and glows on hover. --}}
<x-ui.card class="group relative w-full max-w-sm cursor-pointer overflow-hidden transition-all duration-300 hover:-translate-y-1 hover:shadow-lg">
    <div class="bg-primary/30 pointer-events-none absolute -top-16 left-1/2 size-40 -translate-x-1/2 rounded-full opacity-0 blur-3xl transition-opacity duration-500 group-hover:opacity-100"></div>
    <div class="relative">
        <div class="bg-primary/10 text-primary mb-3 flex size-10 items-center justify-center rounded-lg">
            <x-lucide-sparkles class="size-5" aria-hidden="true" />
        </div>
        <h3 class="font-semibold tracking-tight">Hover for the glow-up</h3>
        <p class="text-muted-foreground mt-1 text-sm">Move your cursor over this card to see it lift with a soft accent glow.</p>
    </div>
</x-ui.card>
