{{-- A button flips the overlay's visibility. An outer Alpine scope holds `loading`;
     `x-effect` on the overlay mirrors it into the overlay's own `show` state. --}}
<div x-data="{ loading: false }" class="flex flex-col items-center gap-4">
    <x-ui.loading-overlay x-effect="show = loading" message="Fetching data…" class="w-full max-w-sm">
        <x-ui.card>
            <h3 class="font-semibold">Account activity</h3>
            <p class="text-muted-foreground mt-1 text-sm">
                You signed in from 3 devices this week. No unusual activity was detected.
            </p>
        </x-ui.card>
    </x-ui.loading-overlay>

    <x-ui.button variant="outline" @click="loading = !loading">
        <span x-text="loading ? 'Stop loading' : 'Start loading'">Start loading</span>
    </x-ui.button>
</div>
