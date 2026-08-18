<div>
    <h1 class="text-2xl font-bold">Popover inside a native &lt;dialog&gt;</h1>

    <x-ui.button x-data @click="document.getElementById('native').showModal()" class="mt-6" data-testid="open">
        Open native modal
    </x-ui.button>

    {{-- A real <dialog> + showModal(), the way FluxUI's modal works: its content is painted in
         the browser's top layer, above everything in <body> regardless of z-index, so a popover
         teleported to <body> renders behind it unless something moves it in here. --}}
    <dialog
        id="native"
        class="bg-background text-foreground rounded-lg border p-6 shadow-lg backdrop:bg-black/50"
        data-testid="native-dialog"
    >
        <div class="flex w-80 flex-col gap-4">
            <p class="font-medium">Choose a plan</p>

            <x-ui.select
                wire:model="plan"
                :options="['free' => 'Free', 'pro' => 'Pro', 'team' => 'Team']"
                placeholder="Select a plan"
                data-testid="select"
            />

            <x-ui.button type="button" variant="outline" size="sm" x-data @click="$el.closest('dialog').close()">Close</x-ui.button>
        </div>
    </dialog>
</div>
