@props([
    'type' => 'single',
    'value' => null,
    'variant' => 'default',
    'size' => 'default',
    'orientation' => 'horizontal',   // horizontal | vertical
])

<div
    data-slot="toggle-group"
    data-variant="{{ $variant }}"
    data-size="{{ $size }}"
    role="group"
    data-orientation="{{ $orientation }}"
    x-data="{
        type: @js($type),
        value: @js($type === 'multiple' ? (array) ($value ?? []) : $value),
        rovingValue: null,
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
    x-init="$nextTick(() => { const f = $el.querySelector('[data-slot=toggle-group-item]:not([disabled])'); rovingValue = f?.getAttribute('data-value') ?? null })"
    @keydown="if (['ArrowLeft','ArrowRight','ArrowUp','ArrowDown','Home','End'].includes($event.key)) { $blatNav($event, { selector: '[data-slot=toggle-group-item]', orientation: 'both' }); }"
    {{ $attributes->twMerge('group/toggle-group flex w-fit items-center rounded-md data-[orientation=vertical]:flex-col data-[orientation=vertical]:items-stretch data-[variant=outline]:shadow-xs') }}
>
    {{ $slot }}
</div>
