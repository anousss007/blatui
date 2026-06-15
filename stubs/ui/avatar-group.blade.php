@props([
    'avatars' => [],      // [['src' => ?url, 'name' => ?string], ...]
    'max' => 4,
    'size' => 'default',  // sm | default | lg
])

@php
    // Size maps: avatar box, the negative inline-start overlap, ring width, and text size.
    $sizeMap = [
        'sm'      => ['box' => 'size-6',  'overlap' => '-ms-2',   'ring' => 'ring-1', 'text' => 'text-xs'],
        'default' => ['box' => 'size-8',  'overlap' => '-ms-2.5', 'ring' => 'ring-2', 'text' => 'text-sm'],
        'lg'      => ['box' => 'size-12', 'overlap' => '-ms-3',   'ring' => 'ring-2', 'text' => 'text-base'],
    ];
    $s = $sizeMap[$size] ?? $sizeMap['default'];

    $items = array_values($avatars ?? []);
    $total = count($items);
    $shown = array_slice($items, 0, max(0, (int) $max));
    $remaining = max(0, $total - count($shown));

    // Derive up-to-two-letter initials from a name (e.g. "Ada Lovelace" -> "AL").
    $initials = function (?string $name): string {
        $name = trim((string) $name);
        if ($name === '') {
            return '?';
        }
        $parts = preg_split('/\s+/', $name);
        $first = mb_substr($parts[0], 0, 1);
        $last = count($parts) > 1 ? mb_substr($parts[count($parts) - 1], 0, 1) : '';

        return mb_strtoupper($first . $last);
    };
@endphp

<div
    data-slot="avatar-group"
    role="list"
    {{ $attributes->twMerge('flex items-center') }}
>
    @foreach ($shown as $i => $avatar)
        @php
            $src = $avatar['src'] ?? null;
            $name = $avatar['name'] ?? null;
            $label = trim((string) $name) !== '' ? $name : 'User avatar';
        @endphp
        <x-ui.avatar
            role="listitem"
            :title="$name"
            @class([$s['box'], $s['ring'], 'ring-background', $s['overlap'] => $i > 0])
        >
            @if ($src)
                <x-ui.avatar-image :src="$src" :alt="$label" />
            @endif
            <x-ui.avatar-fallback @class([$s['text']])>{{ $initials($name) }}</x-ui.avatar-fallback>
        </x-ui.avatar>
    @endforeach

    @if ($remaining > 0)
        <span
            role="listitem"
            aria-label="and {{ $remaining }} more"
            @class([
                'relative z-10 flex shrink-0 items-center justify-center rounded-full font-medium',
                'bg-muted text-foreground',
                $s['box'],
                $s['ring'],
                'ring-background',
                $s['text'],
                $s['overlap'] => count($shown) > 0,
            ])
        >
            <span aria-hidden="true">+{{ $remaining }}</span>
        </span>
    @endif
</div>
