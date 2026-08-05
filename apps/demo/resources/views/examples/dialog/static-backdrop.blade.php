{{-- Pass `:close-on-overlay="false"` for a static backdrop: a stray click outside no longer
     discards what the user typed. Escape and the close button still work — a modal must never
     be impossible to leave from the keyboard. Forcing a decision rather than protecting one?
     Use <x-ui.alert-dialog>, which is non-dismissible by design. --}}
<x-ui.dialog>
    <x-ui.dialog-trigger>
        <x-ui.button variant="outline">Edit profile</x-ui.button>
    </x-ui.dialog-trigger>
    <x-ui.dialog-content :close-on-overlay="false">
        <x-ui.dialog-header>
            <x-ui.dialog-title>Edit profile</x-ui.dialog-title>
            <x-ui.dialog-description>
                Click the backdrop — nothing happens. Press <x-ui.kbd>Esc</x-ui.kbd> or Cancel to leave.
            </x-ui.dialog-description>
        </x-ui.dialog-header>

        <div class="space-y-4">
            <div class="grid gap-2">
                <x-ui.label for="sb-name">Name</x-ui.label>
                <x-ui.input id="sb-name" value="Ada Lovelace" />
            </div>
            <div class="grid gap-2">
                <x-ui.label for="sb-bio">Bio</x-ui.label>
                <x-ui.textarea id="sb-bio" rows="3" placeholder="A few words about you…" />
            </div>
        </div>

        <x-ui.dialog-footer>
            <x-ui.button variant="outline" @click="open = false">Cancel</x-ui.button>
            <x-ui.button @click="open = false">Save changes</x-ui.button>
        </x-ui.dialog-footer>
    </x-ui.dialog-content>
</x-ui.dialog>
