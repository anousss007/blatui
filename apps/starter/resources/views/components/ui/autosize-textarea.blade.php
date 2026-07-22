@props([
    'name' => null,
    'placeholder' => null,
    'minRows' => 2,
    'maxRows' => null,
    'size' => 'default',
    'disabled' => false,
    'id' => null,
    'value' => null,
])

@php
    // Mirror textarea.blade.php so this is visually identical — but drop `field-sizing-content`
    // because Alpine drives the height explicitly via scrollHeight.
    $base = 'border-input placeholder:text-muted-foreground focus-visible:border-ring focus-visible:ring-ring/50 aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive dark:bg-input/30 flex w-full rounded-md border bg-transparent shadow-xs transition-[color,box-shadow] outline-none focus-visible:ring-[3px] disabled:cursor-not-allowed disabled:opacity-50 resize-none overflow-hidden';

    $sizes = [
        'sm' => 'min-h-14 px-2.5 py-1.5 text-sm',
        'default' => 'min-h-16 px-3 py-2 text-base md:text-sm',
        'lg' => 'min-h-20 px-4 py-2.5 text-base',
    ];

    $classes = $base.' '.($sizes[$size] ?? $sizes['default']);

    // Resolve the content: explicit value wins, otherwise fall back to slot text.
    $content = $value !== null ? $value : trim($slot);
@endphp

<textarea
    data-slot="autosize-textarea"
    data-size="{{ $size }}"
    x-data="{
        maxRows: @js($maxRows !== null ? (int) $maxRows : null),
        resize() {
            const el = this.$el;
            // Reset so the element can shrink as well as grow.
            el.style.height = 'auto';
            let target = el.scrollHeight;
            if (this.maxRows !== null) {
                const cs = getComputedStyle(el);
                let lh = parseFloat(cs.lineHeight);
                if (isNaN(lh)) lh = parseFloat(cs.fontSize) * 1.2;
                const pad = parseFloat(cs.paddingTop) + parseFloat(cs.paddingBottom);
                const border = parseFloat(cs.borderTopWidth) + parseFloat(cs.borderBottomWidth);
                const cap = (lh * this.maxRows) + pad + border;
                if (target > cap) {
                    target = cap;
                    el.style.overflowY = 'auto';
                } else {
                    el.style.overflowY = 'hidden';
                }
            }
            el.style.height = target + 'px';
        },
    }"
    x-init="$nextTick(() => resize())"
    @input="resize()"
    rows="{{ (int) $minRows }}"
    @if ($name) name="{{ $name }}" @endif
    @if ($id) id="{{ $id }}" @endif
    @if ($placeholder) placeholder="{{ $placeholder }}" @endif
    @disabled($disabled)
    {{ $attributes->twMerge($classes) }}
>{{ $content }}</textarea>
