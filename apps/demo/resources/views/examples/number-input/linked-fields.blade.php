{{-- Two fields derived from each other: a price without and with an 18% tax. Each one
     derives the OTHER from number-change, which only the user's own edits fire, so a value
     written into a field never comes back and nothing needs a skip flag. Under Livewire bind
     each to its property with wire:model and the same handlers write through to it. --}}
<div
    x-data="{
        rate: 0.18,
        derive(id, v, factor) {
            Alpine.$data(document.getElementById(id)).value = v === null ? null : this.$blatNumber.round(v * factor, 2);
        },
    }"
    class="grid w-full max-w-md gap-4 sm:grid-cols-2"
>
    <div class="grid gap-2">
        <x-ui.label for="price-net">Price (excl. tax)</x-ui.label>
        <x-ui.number-input
            id="price-net"
            name="price_net"
            :value="10"
            :min="0"
            :step="0.01"
            :decimals="2"
            mask
            x-on:number-change="derive('price-gross', $event.detail.value, 1 + rate)"
        />
    </div>
    <div class="grid gap-2">
        <x-ui.label for="price-gross">Price (incl. tax)</x-ui.label>
        <x-ui.number-input
            id="price-gross"
            name="price_gross"
            :value="11.8"
            :min="0"
            :step="0.01"
            :decimals="2"
            mask
            x-on:number-change="derive('price-net', $event.detail.value, 1 / (1 + rate))"
        />
    </div>
</div>
