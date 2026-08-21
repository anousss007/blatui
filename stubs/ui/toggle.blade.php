@props([
    'variant' => 'default',
    'size' => 'default',
    'pressed' => false,
    'disabled' => false,
])

@php
    // Livewire bridge — bind Alpine state to a consumer's wire:model when present. The property
    // path travels as a data attribute rather than baked into x-data (which Alpine evaluates once),
    // so a morph that re-points or re-mounts the component is followed. $blatModel reads and writes
    // the Livewire property directly; without Livewire it just holds the value locally, so the
    // component still works in plain Blade/Alpine. See the bridge in blatui-core.js.
    $wireModel = \Illuminate\View\ComponentAttributeBag::hasMacro('wire') ? $attributes->wire('model') : null;
    $hasWire = $wireModel && is_string($wireModel->value()) && $wireModel->value() !== '';
    if ($hasWire) {
        $attributes = $attributes->whereDoesntStartWith('wire:model')->merge(array_filter([
            'data-blat-model' => $wireModel->value(),
            'data-blat-model-live' => $wireModel->hasModifier('live') ? '1' : null,
        ]));
    }
@endphp

@php
    $base = "inline-flex items-center justify-center gap-2 rounded-md text-sm font-medium hover:bg-muted hover:text-muted-foreground disabled:pointer-events-none disabled:opacity-50 data-[state=on]:bg-accent data-[state=on]:text-accent-foreground [&_svg]:pointer-events-none [&_svg:not([class*='size-'])]:size-4 [&_svg]:shrink-0 focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px] outline-none transition-[color,box-shadow] aria-invalid:ring-destructive/20 dark:aria-invalid:ring-destructive/40 aria-invalid:border-destructive whitespace-nowrap";

    $variants = [
        'default' => 'bg-transparent',
        'outline' => 'border border-input bg-transparent shadow-xs hover:bg-accent hover:text-accent-foreground',
    ];

    $sizes = [
        'default' => 'h-9 px-2 min-w-9',
        'sm' => 'h-8 px-1.5 min-w-8',
        'lg' => 'h-10 px-2.5 min-w-10',
    ];

    $classes = $base.' '.($variants[$variant] ?? $variants['default']).' '.($sizes[$size] ?? $sizes['default']);
@endphp

<button
    type="button"
    x-data="{ _model: $blatModel(@js((bool) $pressed)), get pressed() { return this._model.value; }, set pressed(v) { this._model.value = v; }, }"
    @click="pressed = !pressed"
    :data-state="pressed ? 'on' : 'off'"
    :aria-pressed="pressed"
    @if ($disabled) disabled @endif
    data-slot="toggle"
    {{ $attributes->twMerge($classes) }}
>
    {{ $slot }}
</button>
