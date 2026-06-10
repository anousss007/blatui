@props(['value' => 0, 'indeterminate' => false, 'ariaLabel' => 'Progress'])

<div
    data-slot="progress"
    role="progressbar"
    aria-label="{{ $ariaLabel }}"
    aria-valuemin="0"
    aria-valuemax="100"
    @unless ($indeterminate)
        aria-valuenow="{{ $value }}"
        aria-valuetext="{{ (int) round((float) $value) }}%"
    @endunless
    {{ $attributes->twMerge('bg-primary/20 relative h-2 w-full overflow-hidden rounded-full') }}
>
    @if ($indeterminate)
        <div
            data-slot="progress-indicator"
            class="bg-primary animate-progress-indeterminate absolute inset-y-0 w-2/5 rounded-full"
        ></div>
    @else
        <div
            data-slot="progress-indicator"
            class="bg-primary h-full w-full flex-1 transition-all"
            style="transform: translateX(-{{ 100 - (float) $value }}%)"
        ></div>
    @endif
</div>
