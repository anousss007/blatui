{{-- A single text field per row — e.g. a list of tags. Submits as tags[0][value], tags[1][value]… --}}
<div class="w-full max-w-sm">
    <x-ui.repeater
        name="tags"
        :fields="[['key' => 'value', 'label' => 'Tags', 'placeholder' => 'e.g. laravel']]"
        :value="[['value' => 'blade'], ['value' => 'alpine']]"
        add-label="Add tag"
    />
</div>
