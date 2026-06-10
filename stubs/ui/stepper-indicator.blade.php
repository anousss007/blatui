{{-- The numbered circle. Shows a check once the step is completed.
     Slot = the "incomplete" content (defaults to the step number, or pass a custom icon). --}}
<span
    data-slot="stepper-indicator"
    :data-state="step > itemStep ? 'completed' : (step === itemStep ? 'active' : 'inactive')"
    {{ $attributes->twMerge("relative flex size-8 shrink-0 items-center justify-center rounded-full border-2 text-sm font-medium transition-colors data-[state=inactive]:border-border data-[state=inactive]:text-muted-foreground data-[state=active]:border-primary data-[state=active]:bg-primary data-[state=active]:text-primary-foreground data-[state=completed]:border-primary data-[state=completed]:bg-primary data-[state=completed]:text-primary-foreground [&_svg]:size-4 [&_svg]:shrink-0") }}
>
    <span x-show="step <= itemStep">
        @if ($slot->isEmpty())
            <span x-text="itemStep"></span>
        @else
            {{ $slot }}
        @endif
    </span>
    <span x-show="step > itemStep" x-cloak><x-lucide-check aria-hidden="true" /></span>
</span>
