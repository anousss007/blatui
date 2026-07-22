@props([
    'orientation' => 'horizontal',
    'decorative' => true,
])

<div
    data-slot="separator"
    role="{{ $decorative ? 'none' : 'separator' }}"
    @unless ($decorative) aria-orientation="{{ $orientation }}" @endunless
    data-orientation="{{ $orientation }}"
    {{ $attributes->twMerge('bg-border shrink-0 data-[orientation=horizontal]:h-px data-[orientation=horizontal]:w-full data-[orientation=vertical]:h-full data-[orientation=vertical]:w-px') }}
></div>
