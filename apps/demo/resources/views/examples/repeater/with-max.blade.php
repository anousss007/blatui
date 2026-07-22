{{-- Capped at 3 rows: the Add button disables once the ceiling is hit, with a live count. --}}
<div class="w-full max-w-sm">
    <x-ui.repeater
        name="phones"
        :fields="[['key' => 'value', 'label' => 'Phone numbers', 'placeholder' => '+1 555 0100', 'type' => 'tel']]"
        :value="[['value' => '+1 555 0100']]"
        :min="1"
        :max="3"
        add-label="Add number"
    />
</div>
