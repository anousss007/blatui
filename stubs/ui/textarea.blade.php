@props(['size' => 'default', 'color' => null])

@php
    $base = 'border-input placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:bg-input/30 flex field-sizing-content w-full rounded-md border bg-transparent shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50';

    $sizes = [
        'sm' => 'min-h-14 px-2.5 py-1.5 text-sm',
        'default' => 'min-h-16 px-3 py-2 text-base md:text-sm',
        'lg' => 'min-h-20 px-4 py-2.5 text-base',
    ];

    $classes = $base.' '.($sizes[$size] ?? $sizes['default']);

    // `color` brands the focus ring + selection locally (overrides the ring/primary tokens).
    $colorStyle = $color ? "--ring: {$color}; --primary: {$color}; --primary-foreground: #ffffff;" : '';
    $userStyle = (string) $attributes->get('style', '');
    $style = trim($colorStyle.($colorStyle && $userStyle ? ' ' : '').$userStyle);
    $attributes = $attributes->except('style');
@endphp

<textarea
    data-slot="textarea"
    data-size="{{ $size }}"
    @if ($style) style="{{ $style }}" @endif
    {{ $attributes->twMerge($classes) }}
>{{ $slot }}</textarea>
