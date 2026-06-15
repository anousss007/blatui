@props([
    'step' => 1,            // this item's position (1-based)
    'disabled' => false,
])

{{-- One step. Exposes `itemStep` to its children so the indicator/separator/trigger
     can resolve completed/active/inactive against the stepper's current `step`. --}}
<li
    data-slot="stepper-item"
    x-data="{ itemStep: @js((int) $step), disabled: @js((bool) $disabled) }"
    :data-state="step > itemStep ? 'completed' : (step === itemStep ? 'active' : 'inactive')"
    :data-disabled="disabled ? '' : null"
    :class="orientation === 'vertical' ? 'flex-col' : 'items-center not-last:flex-1'"
    {{ $attributes->twMerge('group/step relative flex') }}
>
    {{ $slot }}
</li>
