@props([
    'name' => null,
    'value' => null,
])

<div
    data-slot="radio-group"
    role="radiogroup"
    x-data="{ value: @js($value), rovingValue: @js($value) }"
    x-init="$nextTick(() => { if (rovingValue === null) { const f = $el.querySelector('[role=radio]:not([disabled])'); rovingValue = f?.getAttribute('data-value') ?? null } })"
    @keydown="if (['ArrowUp','ArrowDown','ArrowLeft','ArrowRight','Home','End'].includes($event.key)) { $blatNav($event, { selector: '[role=radio]', orientation: 'both' }); const v = document.activeElement?.getAttribute('data-value'); if (v != null) { value = v; rovingValue = v; } }"
    {{ $attributes->twMerge('grid gap-3') }}
>
    @if ($name)
        <input type="hidden" name="{{ $name }}" :value="value">
    @endif
    {{ $slot }}
</div>
