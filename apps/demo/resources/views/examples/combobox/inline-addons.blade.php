{{--
    Addons and a card: the `start` and `end` slots put an icon and icon-only buttons inside the
    field, like an input-group. `combobox-select` carries the whole option, so the page can swap
    the field for a card at the moment of the pick, with no round trip. The end buttons pick
    without the list: a walk-in customer, or (in a real page) one created in a dialog.
--}}
<div
    x-data="{ customer: null }"
    class="w-[340px]"
>
    <div x-show="! customer">
        <x-ui.combobox
            trigger="input"
            width="w-full"
            placeholder="Search customer (name or ID)"
            :options="[
                ['value' => '1', 'label' => 'Ana García', 'document' => '45744263'],
                ['value' => '2', 'label' => 'Luis Fernández', 'document' => '20512345678'],
                ['value' => '3', 'label' => 'José Ramírez', 'document' => '70011223'],
            ]"
            x-on:combobox-select="customer = $event.detail.option"
        >
            <x-slot:start>
                <x-lucide-search aria-hidden="true" />
            </x-slot:start>
            <x-slot:end>
                <x-ui.input-group-button size="icon-xs" aria-label="Walk-in customer" title="Walk-in customer" x-on:click="customer = { label: 'Walk-in customer', document: null }">
                    <x-lucide-users aria-hidden="true" />
                </x-ui.input-group-button>
                <x-ui.input-group-button size="icon-xs" aria-label="New customer" title="New customer" x-on:click="customer = { label: 'New customer', document: '00000000' }">
                    <x-lucide-user-plus aria-hidden="true" />
                </x-ui.input-group-button>
            </x-slot:end>
        </x-ui.combobox>
    </div>

    <x-ui.item x-show="customer" x-cloak variant="muted" size="sm">
        <x-ui.item-media variant="icon">
            <x-lucide-user aria-hidden="true" />
        </x-ui.item-media>
        <x-ui.item-content>
            <x-ui.item-title x-text="customer?.label"></x-ui.item-title>
            <x-ui.item-description x-show="customer?.document" x-text="customer?.document"></x-ui.item-description>
        </x-ui.item-content>
        <x-ui.item-actions>
            <x-ui.button type="button" variant="ghost" size="icon-sm" aria-label="Change customer" title="Change customer" x-on:click="customer = null">
                <x-lucide-x aria-hidden="true" />
            </x-ui.button>
        </x-ui.item-actions>
    </x-ui.item>
</div>
