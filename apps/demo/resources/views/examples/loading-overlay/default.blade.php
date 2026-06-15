{{-- The veil is shown over the content while busy. --}}
<x-ui.loading-overlay :show="true" message="Loading…" class="max-w-sm">
    <x-ui.card>
        <h3 class="font-semibold">Monthly report</h3>
        <p class="text-muted-foreground mt-1 text-sm">
            Revenue is up 12% over the previous period, with new sign-ups leading the gain.
        </p>
    </x-ui.card>
</x-ui.loading-overlay>
