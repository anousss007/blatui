@props(['value' => 0, 'ariaLabel' => 'Progress'])

<div
    data-slot="progress"
    role="progressbar"
    aria-label="{{ $ariaLabel }}"
    aria-valuemin="0"
    aria-valuemax="100"
    aria-valuenow="{{ $value }}"
    aria-valuetext="{{ (int) round((float) $value) }}%"
    {{ $attributes->twMerge('bg-primary/20 relative h-2 w-full overflow-hidden rounded-full') }}
>
    <div
        data-slot="progress-indicator"
        class="bg-primary h-full w-full flex-1 transition-all"
        style="transform: translateX(-{{ 100 - (float) $value }}%)"
    ></div>
</div>
