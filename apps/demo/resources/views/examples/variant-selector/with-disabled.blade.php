<x-ui.variant-selector
    name="size"
    label="Size"
    value="M"
    :options="[
        ['value' => 'XS', 'label' => 'XS'],
        ['value' => 'S', 'label' => 'S'],
        ['value' => 'M', 'label' => 'M'],
        ['value' => 'L', 'label' => 'L', 'disabled' => true],
        ['value' => 'XL', 'label' => 'XL'],
    ]"
/>
