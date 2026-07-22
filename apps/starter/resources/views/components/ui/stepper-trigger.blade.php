{{-- Clickable region that activates the step. Jumps the stepper to this item. --}}
<button
    type="button"
    data-slot="stepper-trigger"
    :data-state="step > itemStep ? 'completed' : (step === itemStep ? 'active' : 'inactive')"
    :disabled="disabled"
    @click="!disabled && (step = itemStep)"
    {{ $attributes->twMerge("group/trigger focus-visible:ring-ring/50 inline-flex items-center gap-2.5 rounded-md text-left outline-none transition-colors focus-visible:ring-[3px] disabled:pointer-events-none disabled:opacity-50") }}
>
    {{ $slot }}
</button>
