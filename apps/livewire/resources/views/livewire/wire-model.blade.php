<div>
    <h1 class="text-2xl font-bold">wire:model, without @verbatim@entangle@endverbatim</h1>

    <div class="mt-6 flex gap-3">
        <x-ui.button wire:click="tick" data-testid="tick">Re-render</x-ui.button>
        <x-ui.button wire:click="seed" variant="outline" data-testid="seed">Set from the server</x-ui.button>
    </div>
    <p class="text-muted-foreground mt-2 text-sm">ticks: <span data-testid="ticks">{{ $ticks }}</span></p>

    {{-- Deferred (the default): the value has to ride along with the NEXT request, so these
         echoes only move after a click on "Re-render". --}}
    <div class="mt-6 space-y-4">
        <div data-testid="amount">
            <x-ui.number-input wire:model="amount" :step="0.1" :value="null" aria-label="Amount" />
        </div>
        <p class="text-sm">amount: <span data-testid="echo-amount">{{ var_export($amount, true) }}</span></p>

        {{-- .live commits on its own, without another action to ride along with. --}}
        <div data-testid="live">
            <x-ui.number-input wire:model.live="live" :step="1" :value="0" aria-label="Live" />
        </div>
        <p class="text-sm">live: <span data-testid="echo-live">{{ var_export($live, true) }}</span></p>

        <div data-testid="agreed">
            <x-ui.checkbox wire:model="agreed" aria-label="Agree" />
        </div>
        <p class="text-sm">agreed: <span data-testid="echo-agreed">{{ var_export($agreed, true) }}</span></p>

        <div data-testid="tags">
            <x-ui.tags-input wire:model="tags" />
        </div>
        <p class="text-sm">tags: <span data-testid="echo-tags">{{ implode(',', $tags) }}</span></p>

        <div data-testid="plan">
            <x-ui.select wire:model="plan" :options="['Free', 'Pro']" placeholder="Pick a plan" />
        </div>
        <p class="text-sm">plan: <span data-testid="echo-plan">{{ $plan }}</span></p>

        <div data-testid="upload">
            <x-ui.file-upload wire:model="upload" />
        </div>
        <p class="text-sm">upload: <span data-testid="echo-upload">{{ $upload ? $upload->getClientOriginalName() : 'null' }}</span></p>
    </div>
</div>
