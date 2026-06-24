{{--
    DEPRECATED ALIAS — autocomplete has merged into <x-ui.combobox trigger="input">.
    The inline-input filtered listbox is now a variant of combobox, so the engine and
    markup are single-sourced there. This alias keeps the public <x-ui.autocomplete>
    tag (and its prop vocabulary) working unchanged; prefer combobox in new code.

    autocomplete props map 1:1 onto combobox's input-trigger variant:
      name, options, value, placeholder, empty, size, disabled, multiple, icon, width.
--}}
@props([
    'name' => null,
    'options' => [],
    'value' => '',
    'placeholder' => 'Search...',
    'empty' => 'No results found.',
    'size' => 'default',   // sm | default | lg
    'disabled' => false,
    'multiple' => false,   // true → tag input: selected render as removable chips, list stays open
    'icon' => null,        // optional lucide icon name (e.g. "search") for a leading icon
    'width' => 'w-[260px]',
])

<x-ui.combobox
    trigger="input"
    :name="$name"
    :options="$options"
    :value="$value"
    :placeholder="$placeholder"
    :empty="$empty"
    :size="$size"
    :disabled="$disabled"
    :multiple="$multiple"
    :icon="$icon"
    :width="$width"
    {{ $attributes }}
/>
