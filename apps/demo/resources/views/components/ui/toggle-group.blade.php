@props([
    'type' => 'single',
    'value' => null,
    'variant' => 'default',
    'size' => 'default',
])

<div
    data-slot="toggle-group"
    data-variant="{{ $variant }}"
    data-size="{{ $size }}"
    role="group"
    x-data="{
        type: @js($type),
        value: @js($type === 'multiple' ? (array) ($value ?? []) : $value),
        toggle(v) {
            if (this.type === 'multiple') {
                this.value = this.value.includes(v) ? this.value.filter(x => x !== v) : [...this.value, v];
            } else {
                this.value = this.value === v ? null : v;
            }
        },
        isOn(v) {
            return this.type === 'multiple' ? this.value.includes(v) : this.value === v;
        },
    }"
    {{ $attributes->twMerge('group/toggle-group flex w-fit items-center rounded-md data-[variant=outline]:shadow-xs') }}
>
    {{ $slot }}
</div>
