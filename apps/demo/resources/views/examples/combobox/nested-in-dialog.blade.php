<x-ui.dialog>
    <x-ui.dialog-trigger>
        <x-ui.button variant="outline">Assign branches</x-ui.button>
    </x-ui.dialog-trigger>
    <x-ui.dialog-content class="sm:max-w-[425px]">
        <x-ui.dialog-header>
            <x-ui.dialog-title>Assign branches</x-ui.dialog-title>
            <x-ui.dialog-description>
                The picker teleports out of the dialog, so a long list is never clipped by it.
            </x-ui.dialog-description>
        </x-ui.dialog-header>
        <x-ui.field>
            <x-ui.field-label>Branches</x-ui.field-label>
            <x-ui.combobox
                multiple
                indicator="checkbox"
                width="w-full"
                placeholder="Select branches"
                :options="[
                    ['value' => 'antwerp', 'label' => 'Antwerp'],
                    ['value' => 'brussels', 'label' => 'Brussels'],
                    ['value' => 'charleroi', 'label' => 'Charleroi'],
                    ['value' => 'ghent', 'label' => 'Ghent'],
                    ['value' => 'liege', 'label' => 'Liège'],
                ]"
            />
        </x-ui.field>
        <x-ui.dialog-footer>
            <x-ui.button type="submit">Save</x-ui.button>
        </x-ui.dialog-footer>
    </x-ui.dialog-content>
</x-ui.dialog>
