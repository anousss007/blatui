@props([
    'step' => 1,   // which step this panel belongs to
])

{{-- Per-step content panel. Visible only while its step is active. --}}
<div
    data-slot="stepper-content"
    x-show="step === @js((int) $step)"
    x-cloak
    role="tabpanel"
    {{ $attributes->twMerge('text-sm') }}
>
    {{ $slot }}
</div>
