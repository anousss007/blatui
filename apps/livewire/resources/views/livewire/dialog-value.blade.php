<div>
    <h1 class="text-2xl font-bold">file-upload :value in a reused dialog</h1>

    <div class="mt-6 flex gap-3">
        <x-ui.button wire:click="edit('a')" data-testid="edit-a">Edit A</x-ui.button>
        <x-ui.button wire:click="edit('b')" variant="outline" data-testid="edit-b">Edit B</x-ui.button>
    </div>
    <p class="text-muted-foreground mt-2 text-sm">record: <span data-testid="echo-record">{{ $recordId ?? 'none' }}</span></p>

    <x-ui.dialog id="record" class="contents">
        <x-ui.dialog-content>
            <x-ui.dialog-header>
                <x-ui.dialog-title>Edit record</x-ui.dialog-title>
            </x-ui.dialog-header>

            <x-ui.field data-testid="logo">
                <x-ui.field-label for="record-logo">Logo</x-ui.field-label>
                <x-ui.file-upload
                    id="record-logo"
                    wire:model="logo"
                    :value="$this->logoUrl() ? ['url' => $this->logoUrl(), 'name' => $this->logoName(), 'image' => true] : null"
                    accept="image/*"
                />
            </x-ui.field>

            {{-- Nothing to do with the logo. In the report, toggling a control like this was the
                 only thing that ever made the preview appear — so a check must not lean on it. --}}
            <div data-testid="unrelated" class="mt-4">
                <x-ui.switch wire:model.live="active" />
            </div>

            <x-ui.dialog-footer>
                <x-ui.dialog-close data-testid="close">Close</x-ui.dialog-close>
            </x-ui.dialog-footer>
        </x-ui.dialog-content>
    </x-ui.dialog>
</div>
