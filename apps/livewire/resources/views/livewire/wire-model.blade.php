<div>
    <h1 class="text-2xl font-bold">wire:model, without @verbatim@entangle@endverbatim</h1>

    <div class="mt-6 flex gap-3">
        <x-ui.button wire:click="tick" data-testid="tick">Re-render</x-ui.button>
        <x-ui.button wire:click="seed" variant="outline" data-testid="seed">Set from the server</x-ui.button>
        <x-ui.button wire:click="clearUpload" variant="outline" data-testid="clear-upload">Reset the upload</x-ui.button>
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

        {{-- A range binds as one value in the shape its `value` prop already takes. --}}
        <div data-testid="stay">
            <x-ui.date-picker mode="range" wire:model="stay" :value="$stay" default-month="2026-03-01" />
        </div>
        <p class="text-sm">stay: <span data-testid="echo-stay">{{ json_encode($stay) }}</span></p>

        <div data-testid="price">
            <x-ui.slider range wire:model="price" :value="$price" />
        </div>
        <p class="text-sm">price: <span data-testid="echo-price">{{ json_encode($price) }}</span></p>

        <div data-testid="upload">
            <x-ui.file-upload wire:model="upload" />
        </div>
        <p class="text-sm">upload: <span data-testid="echo-upload">{{ $upload ? $upload->getClientOriginalName() : 'null' }}</span></p>

        {{-- The editor's content is the value, and the morph is not allowed into its subtree —
             so this is the one binding where a re-render must NOT bring the value back. --}}
        <div data-testid="story">
            <x-ui.rich-text-editor wire:model="story" :value="$story" />
        </div>
        <p class="text-sm">story: <span data-testid="echo-story">{{ $story }}</span></p>

        {{-- The same field with an id of its own: a consumer's id is theirs, and still lands on
             the input the label/for of a surrounding form would point at. Issue #27. --}}
        <div data-testid="upload-keyed">
            <x-ui.file-upload id="chosen-upload" />
        </div>

        {{-- A file the record already holds. The data: URI keeps the thumbnail off the network —
             a 404 here would be a console error, and this page asserts there are none. #29 --}}
        <div data-testid="upload-existing" x-data="{ removed: '' }" x-on:file-remove="removed = $event.detail.name">
            <x-ui.file-upload :value="[[
                'url' => 'data:image/svg+xml,%3Csvg xmlns=\'http://www.w3.org/2000/svg\' width=\'8\' height=\'8\'%3E%3C/svg%3E',
                'name' => 'saved-logo.svg',
                'size' => 1240,
                'image' => true,
            ]]" />
            <p class="text-sm">removed: <span data-testid="echo-removed" x-text="removed"></span></p>
        </div>
    </div>
</div>
