{{--
    The pattern #59 asks for. The page only dispatches browser events:
      brand-create  opens at once, already clean: the form was reset when the dialog last closed
                    (dialog-closed, which fires after the fade-out, so nothing empties on screen).
      brand-edit    opens at once and loads the record with a direct $wire.edit() call, which is
                    what lets wire:loading target it (a call reached through #[On] is invisible
                    to wire:target). Skeletons stand in for the fields until it answers.
    `editing` is browser state, because the title has to be right in the first frame, before the
    server has said anything.
--}}
<div
    x-data="{ editing: false }"
    x-on:brand-create.window="editing = false; $wire.open = true"
    x-on:brand-edit.window="editing = true; $wire.open = true; $wire.edit($event.detail.id)"
>
    <x-ui.dialog wire:model="open" wire:dialog-closed="resetForm" class="contents">
        <x-ui.dialog-content :close-on-overlay="false" data-testid="brand-dialog">
            <x-ui.dialog-header>
                <x-ui.dialog-title x-text="editing ? 'Edit brand' : 'New brand'" data-testid="title"></x-ui.dialog-title>
                <x-ui.dialog-description>Identifies the products of your catalog.</x-ui.dialog-description>
            </x-ui.dialog-header>

            <div wire:loading.flex wire:target="edit" class="flex-col gap-6" data-testid="skeleton">
                <x-ui.skeleton class="h-9 w-full" />
                <x-ui.skeleton class="h-16 w-full" />
            </div>

            <form id="brand-form" wire:submit="save" wire:loading.remove wire:target="edit" data-testid="fields">
                <x-ui.field-group>
                    <x-ui.field>
                        <x-ui.field-label for="brand-name">Name</x-ui.field-label>
                        <x-ui.input id="brand-name" wire:model="name" data-testid="name" />
                        <x-ui.field-error :messages="$errors->get('name')" />
                    </x-ui.field>
                    <x-ui.field>
                        <x-ui.field-label for="brand-description">Description</x-ui.field-label>
                        <x-ui.textarea id="brand-description" wire:model="description" />
                    </x-ui.field>
                    {{-- wire:show, not @if: it follows $wire.brandId in the browser. --}}
                    <x-ui.field orientation="horizontal" wire:show="brandId !== null" wire:cloak>
                        <x-ui.field-label for="brand-active">Active</x-ui.field-label>
                        <x-ui.switch id="brand-active" wire:model="active" />
                    </x-ui.field>
                </x-ui.field-group>
            </form>

            <x-ui.dialog-footer>
                <x-ui.dialog-close>
                    <x-ui.button variant="outline" class="w-full">Cancel</x-ui.button>
                </x-ui.dialog-close>
                <x-ui.button type="submit" form="brand-form" wire:loading.attr="disabled" wire:target="save,edit" data-testid="submit">
                    <span wire:loading.remove wire:target="save" x-text="editing ? 'Save changes' : 'Create brand'"></span>
                    <span wire:loading wire:target="save" x-text="editing ? 'Saving…' : 'Creating…'"></span>
                </x-ui.button>
            </x-ui.dialog-footer>
        </x-ui.dialog-content>
    </x-ui.dialog>
</div>
