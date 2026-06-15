@props([
    'name' => null,
    'options' => [],
    'value' => null,
    'type' => 'pill',          // pill | color
    'label' => 'Variant',
    'disabled' => false,
])

@php
    // Normalise options into a uniform shape: ['value', 'label', 'color', 'disabled'].
    $normalized = [];
    foreach ($options as $option) {
        if (is_array($option)) {
            $optValue = $option['value'] ?? ($option['label'] ?? null);
            $optLabel = $option['label'] ?? ($option['value'] ?? '');
            $optColor = $option['color'] ?? null;
            $optDisabled = (bool) ($option['disabled'] ?? false);
        } else {
            $optValue = $option;
            $optLabel = $option;
            $optColor = null;
            $optDisabled = false;
        }

        $normalized[] = [
            'value' => (string) $optValue,
            'label' => (string) $optLabel,
            'color' => $optColor,
            'disabled' => $optDisabled,
        ];
    }

    // A unique group id keeps radio names unique when no form name is supplied,
    // and links the visible label to the radiogroup for assistive tech.
    $groupId = 'variant-selector-' . \Illuminate\Support\Str::random(8);
    $radioName = $name ?? $groupId;
    $labelId = $groupId . '-label';
@endphp

<div
    data-slot="variant-selector"
    {{ $attributes->twMerge('flex flex-col gap-2') }}
>
    @if ($label)
        <span id="{{ $labelId }}" data-slot="variant-selector-label" class="text-sm font-medium text-foreground">
            {{ $label }}
        </span>
    @endif

    <div
        role="radiogroup"
        @if ($label) aria-labelledby="{{ $labelId }}" @endif
        data-slot="variant-selector-options"
        @class([
            'flex flex-wrap gap-2' => $type !== 'color',
            'flex flex-wrap items-center gap-3' => $type === 'color',
        ])
    >
        @foreach ($normalized as $option)
            @php
                $optionDisabled = $disabled || $option['disabled'];
                $isChecked = $value !== null && (string) $value === $option['value'];
                $inputId = $groupId . '-' . $loop->index;
            @endphp

            @if ($type === 'color')
                <span data-slot="variant-selector-item" class="relative inline-flex">
                    <input
                        type="radio"
                        id="{{ $inputId }}"
                        name="{{ $radioName }}"
                        value="{{ $option['value'] }}"
                        @checked($isChecked)
                        @disabled($optionDisabled)
                        class="peer sr-only"
                    >
                    <label
                        for="{{ $inputId }}"
                        title="{{ $option['label'] }}"
                        @class([
                            'relative grid size-9 place-items-center rounded-full border border-border bg-clip-padding shadow-xs transition-[box-shadow,transform] outline-none',
                            'ring-offset-2 ring-offset-background peer-checked:ring-2 peer-checked:ring-ring' => true,
                            'peer-focus-visible:ring-2 peer-focus-visible:ring-ring peer-focus-visible:ring-offset-2 peer-focus-visible:ring-offset-background' => true,
                            'cursor-pointer hover:scale-105' => ! $optionDisabled,
                            'cursor-not-allowed opacity-50' => $optionDisabled,
                        ])
                        style="background-color: {{ $option['color'] ?? 'transparent' }};"
                    >
                        {{-- Checkmark conveys selection beyond colour alone. --}}
                        <x-lucide-check
                            aria-hidden="true"
                            class="size-4 text-white opacity-0 drop-shadow-[0_1px_1px_rgba(0,0,0,0.55)] transition-opacity peer-checked:opacity-100"
                        />
                        {{-- Diagonal line marks a disabled swatch beyond opacity alone. --}}
                        @if ($optionDisabled)
                            <span aria-hidden="true" class="pointer-events-none absolute inset-0 grid place-items-center">
                                <span class="block h-px w-[140%] rotate-45 bg-foreground/60"></span>
                            </span>
                        @endif
                        <span class="sr-only">{{ $option['label'] }}</span>
                    </label>
                </span>
            @else
                <span data-slot="variant-selector-item" class="relative inline-flex">
                    <input
                        type="radio"
                        id="{{ $inputId }}"
                        name="{{ $radioName }}"
                        value="{{ $option['value'] }}"
                        @checked($isChecked)
                        @disabled($optionDisabled)
                        class="peer sr-only"
                    >
                    <label
                        for="{{ $inputId }}"
                        @class([
                            'inline-flex min-w-9 items-center justify-center rounded-md border border-border px-3 py-1.5 text-sm font-medium text-foreground transition-[color,box-shadow,background-color] outline-none select-none',
                            'peer-checked:border-primary peer-checked:bg-primary/5 peer-checked:text-primary peer-checked:ring-2 peer-checked:ring-primary' => true,
                            'peer-focus-visible:ring-2 peer-focus-visible:ring-ring' => true,
                            'cursor-pointer hover:bg-accent hover:text-accent-foreground' => ! $optionDisabled,
                            'cursor-not-allowed text-muted-foreground/50 line-through opacity-60' => $optionDisabled,
                        ])
                    >
                        {{ $option['label'] }}
                    </label>
                </span>
            @endif
        @endforeach
    </div>
</div>
