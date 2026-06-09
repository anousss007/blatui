{{-- Dispatchable mode (id="..."). The "Remove" trigger lives inside a @foreach, but there
     is ONE shared dialog defined once below — no per-row modal markup, no scope coupling.
     The trigger opens it from anywhere with $dispatch('open-dialog-{id}'); pass row context
     in the event detail and capture it on dialog-content. Close from anywhere with
     $dispatch('close-dialog-{id}'). --}}
<div class="w-full max-w-sm space-y-2">
    @foreach (['Alice Martin', 'Bob Dupont', 'Carol Nguyen'] as $member)
        <div class="flex items-center justify-between rounded-md border px-3 py-2 text-sm">
            <span>{{ $member }}</span>
            <x-ui.button
                variant="outline"
                size="sm"
                x-data
                data-name="{{ $member }}"
                x-on:click="$dispatch('open-dialog-member', { name: $el.dataset.name })"
            >Remove</x-ui.button>
        </div>
    @endforeach

    {{-- Defined once — shared by every row above. --}}
    <x-ui.dialog id="member">
        <x-ui.dialog-content x-data="{ name: '' }" @open-dialog-member.window="name = $event.detail?.name || ''">
            <x-ui.dialog-header>
                <x-ui.dialog-title>Remove member</x-ui.dialog-title>
                <x-ui.dialog-description>
                    Remove <span class="text-foreground font-medium" x-text="name"></span> from the team? This can't be undone.
                </x-ui.dialog-description>
            </x-ui.dialog-header>
            <x-ui.dialog-footer>
                <x-ui.button variant="outline" x-on:click="$dispatch('close-dialog-member')">Cancel</x-ui.button>
                <x-ui.button variant="destructive" x-on:click="$dispatch('close-dialog-member')">Remove</x-ui.button>
            </x-ui.dialog-footer>
        </x-ui.dialog-content>
    </x-ui.dialog>
</div>
