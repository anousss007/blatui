@props([
    'amount' => 0,
    'compareAt' => null,
    'currency' => '$',
    'size' => 'default',
    'showDiscount' => true,
])

@php
    $amount = (float) $amount;
    $compareAt = $compareAt === null ? null : (float) $compareAt;
    $onSale = $compareAt !== null && $compareAt > $amount;

    // Literal text-size lookups so the Tailwind scanner generates them.
    $sizes = [
        'sm' => 'text-sm',
        'default' => 'text-base',
        'lg' => 'text-2xl',
    ];
    $current = $sizes[$size] ?? $sizes['default'];

    // The compare-at price sits one step down the scale from the current price.
    $compareSizes = [
        'sm' => 'text-xs',
        'default' => 'text-sm',
        'lg' => 'text-base',
    ];
    $compareCls = $compareSizes[$size] ?? $compareSizes['default'];

    $fmt = fn ($value) => $currency.number_format($value, 2);

    $discount = $onSale && $compareAt > 0
        ? (int) round((($compareAt - $amount) / $compareAt) * 100)
        : 0;
@endphp

<span data-slot="price" {{ $attributes->twMerge('inline-flex items-baseline gap-2 font-medium tabular-nums') }}>
    <span @class([$current, 'text-emerald-700 dark:text-emerald-400' => $onSale, 'text-foreground' => ! $onSale])>{{ $fmt($amount) }}</span>

    @if ($onSale)
        <s @class([$compareCls, 'text-muted-foreground'])>
            <span class="sr-only">was </span>{{ $fmt($compareAt) }}
        </s>

        @if ($showDiscount && $discount > 0)
            <x-ui.badge tone="success" variant="soft" size="sm">
                <span class="sr-only">save </span>-{{ $discount }}%
            </x-ui.badge>
        @endif
    @endif
</span>
