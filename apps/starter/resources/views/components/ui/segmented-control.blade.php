@props([
    'name' => null,
    'options' => [],
    'value' => null,
    'size' => 'default',
    'disabled' => false,
])

@php
    // Normalise each option to ['value', 'label', 'icon'?].
    // Accepts a plain string ("List") or an associative array (['value' => 'list', 'label' => 'List', 'icon' => 'list']).
    $items = collect($options)->map(function ($option) {
        if (is_array($option)) {
            $val = $option['value'] ?? ($option['label'] ?? null);
            return [
                'value' => (string) $val,
                'label' => (string) ($option['label'] ?? $val),
                'icon' => $option['icon'] ?? null,
            ];
        }
        return ['value' => (string) $option, 'label' => (string) $option, 'icon' => null];
    })->values();

    // A stable name keeps the radios in one native group — that gives roving focus and
    // arrow-key navigation for free, and lets the selection submit with a form.
    $groupName = $name ?? ('segmented-control-' . \Illuminate\Support\Str::random(6));
    // A unique base so every radio/label `for` pairing is collision-free across instances.
    $uid = 'segmented-control-' . \Illuminate\Support\Str::random(8);

    $tracks = [
        'sm' => 'h-8 p-0.5 text-xs',
        'default' => 'h-9 p-1 text-sm',
        'lg' => 'h-11 p-1 text-base',
    ];
    $segments = [
        'sm' => 'gap-1 px-2 [&_svg]:size-3.5',
        'default' => 'gap-1.5 px-2.5 [&_svg]:size-4',
        'lg' => 'gap-2 px-4 [&_svg]:size-5',
    ];

    $track = $tracks[$size] ?? $tracks['default'];
    $segment = $segments[$size] ?? $segments['default'];
@endphp

<div
    data-slot="segmented-control"
    role="radiogroup"
    @if ($name) aria-label="{{ $name }}" @endif
    @if ($disabled) aria-disabled="true" data-disabled @endif
    {{ $attributes->twMerge('inline-flex w-fit items-center justify-center rounded-lg bg-muted text-muted-foreground ' . $track . ($disabled ? ' opacity-50' : '')) }}
>
    @foreach ($items as $i => $item)
        @php
            $checked = $value !== null && (string) $value === $item['value'];
            $inputId = $uid . '-' . $i;
        @endphp
        {{-- Wrapper flexes each segment to equal width and scopes the peer input to its own label. --}}
        <span data-slot="segmented-control-item" data-value="{{ $item['value'] }}" class="relative inline-flex min-w-0 flex-1 shrink-0">
            {{-- Visually-hidden real radio: native group semantics, keyboard, and form submission. --}}
            <input
                type="radio"
                id="{{ $inputId }}"
                name="{{ $groupName }}"
                value="{{ $item['value'] }}"
                class="peer sr-only"
                @checked($checked)
                @disabled($disabled)
            >
            {{-- The styled segment. peer-checked gives the raised/filled active look (more than colour). --}}
            <label
                for="{{ $inputId }}"
                @class([
                    'inline-flex w-full min-w-0 items-center justify-center whitespace-nowrap rounded-md font-medium text-muted-foreground transition-[color,box-shadow] outline-none',
                    'peer-checked:bg-background peer-checked:text-foreground peer-checked:shadow-sm',
                    'peer-focus-visible:ring-[3px] peer-focus-visible:ring-ring/50',
                    '[&_svg]:pointer-events-none [&_svg]:shrink-0',
                    $segment,
                    'cursor-pointer hover:text-foreground' => ! $disabled,
                    'cursor-not-allowed' => $disabled,
                ])
            >
                @if ($item['icon'])
                    <x-dynamic-component :component="'lucide-' . $item['icon']" aria-hidden="true" />
                @endif
                <span>{{ $item['label'] }}</span>
            </label>
        </span>
    @endforeach
</div>
