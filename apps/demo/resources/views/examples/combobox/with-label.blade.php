{{-- `id` lands on the trigger button, so <label for> names it and a click on the label
     focuses it — the same as a native <select>. --}}
<div class="grid w-[220px] gap-2">
    <x-ui.label for="category-root">Category</x-ui.label>
    <x-ui.combobox
        id="category-root"
        name="category_root_id"
        width="w-full"
        :options="[
            ['value' => '1', 'label' => 'Clothing'],
            ['value' => '2', 'label' => 'Footwear'],
            ['value' => '3', 'label' => 'Accessories'],
        ]"
        placeholder="Select a category"
    />
</div>
