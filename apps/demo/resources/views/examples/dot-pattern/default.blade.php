{{-- The dot grid paints behind the card content; place it in a `relative` container. --}}
<div class="bg-card text-card-foreground relative overflow-hidden rounded-xl border p-8 shadow-sm">
    <x-ui.dot-pattern />

    <div class="relative">
        <h3 class="text-base font-semibold">Dot Pattern</h3>
        <p class="text-muted-foreground mt-2 text-sm">
            A subtle dotted grid sits behind this content, adding texture while
            staying readable in both light and dark themes.
        </p>
    </div>
</div>
