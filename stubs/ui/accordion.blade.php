@props([
    'type' => 'single',
    'collapsible' => false,
    'value' => null,
])

<div
    data-slot="accordion"
    x-data="{
        type: @js($type),
        collapsible: @js((bool) $collapsible),
        open: @js($type === 'multiple' ? (array) ($value ?? []) : $value),
        toggle(v) {
            if (this.type === 'multiple') {
                this.open = this.open.includes(v) ? this.open.filter(x => x !== v) : [...this.open, v];
            } else {
                this.open = this.open === v ? (this.collapsible ? null : this.open) : v;
            }
        },
        isOpen(v) {
            return this.type === 'multiple' ? this.open.includes(v) : this.open === v;
        },
    }"
    {{ $attributes }}
>
    {{ $slot }}
</div>
