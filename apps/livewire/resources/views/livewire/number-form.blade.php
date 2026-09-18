<div>
    <h1 class="text-2xl font-bold">number-input on a Form object</h1>

    <div class="mt-6 flex gap-3">
        <x-ui.button wire:click="tick" data-testid="tick">Re-render</x-ui.button>
        <x-ui.button wire:click="save" variant="outline" data-testid="save">Save</x-ui.button>
    </div>
    <p class="text-muted-foreground mt-2 text-sm">ticks: <span data-testid="ticks">{{ $ticks }}</span> · saved: <span data-testid="saved">{{ $saved ? 'yes' : 'no' }}</span></p>

    <div class="mt-6 space-y-4">
        {{-- Deferred: the cost only needs to reach the server with the save. --}}
        <div data-testid="cost">
            <x-ui.number-input wire:model="variantForm.lastPurchaseCost" :min="0" :step="0.01" :decimals="2" :nullable="false" aria-label="Purchase cost" />
        </div>

        {{-- Live, on a non-nullable float: an empty field must never reach the server. --}}
        <div data-testid="sale">
            <x-ui.number-input wire:model.live="variantForm.salePrice" :min="0" :step="0.1" :decimals="2" :nullable="false" aria-label="Sale price" />
        </div>
        <p class="text-sm">salePrice: <span data-testid="echo-sale">{{ var_export($variantForm->salePrice, true) }}</span></p>

        {{-- Derived in the browser from both bound properties: $wire is reactive, and the deferred
             cost is already in it before any request is made. --}}
        <p class="text-sm" x-data>profit:
            <span data-testid="profit" x-text="(Math.round(((+$wire.variantForm.salePrice || 0) - (+$wire.variantForm.lastPurchaseCost || 0)) * 100) / 100).toFixed(2)"></span>
        </p>

        {{-- Nullable, with `required`: emptying it is a real null and the rule rejects it. --}}
        <x-ui.field data-testid="list">
            <x-ui.label>List price</x-ui.label>
            <x-ui.number-input wire:model="variantForm.listPrice" :min="0" :decimals="2" aria-label="List price" />
            @error('variantForm.listPrice')
                <x-ui.field-error>{{ $message }}</x-ui.field-error>
            @enderror
        </x-ui.field>
        <p class="text-sm">listPrice: <span data-testid="echo-list">{{ var_export($variantForm->listPrice, true) }}</span></p>
    </div>
</div>
