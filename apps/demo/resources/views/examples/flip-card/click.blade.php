<x-ui.flip-card trigger="click" class="max-w-xs">
    <x-slot:front>
        <div class="flex flex-1 flex-col items-center justify-center gap-2 text-center">
            <x-lucide-mouse-pointer-click class="size-8 text-primary" aria-hidden="true" />
            <h3 class="text-lg font-semibold">Tap to reveal</h3>
            <p class="text-muted-foreground text-sm">Click anywhere on the card</p>
        </div>
    </x-slot:front>

    <x-slot:back>
        <div class="flex flex-1 flex-col items-center justify-center gap-2 text-center">
            <x-lucide-gift class="size-8 text-primary" aria-hidden="true" />
            <h3 class="text-lg font-semibold">You found it!</h3>
            <p class="text-muted-foreground text-sm">Click again to flip back</p>
        </div>
    </x-slot:back>
</x-ui.flip-card>
