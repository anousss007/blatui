{{--
    Presence — a small round status dot (online / away / busy / offline) with a
    ring-background outline. Usable standalone or pinned to an avatar corner by the
    consumer (wrap in a `relative` element and position this with utilities).

      status      online (default) | away | busy | offline
      size        sm | default | lg  → literal dot size classes
      pulse       when true, render an animate-ping halo (online only by default)
      label       override the visible / sr-only status text
      showLabel   when true, render the label text beside the dot; otherwise sr-only

    A11y: status is never conveyed by colour alone — the label text is always present
    (visible or sr-only) so screen readers announce the state. The coloured dot and
    pulse halo are aria-hidden decoration.
    RTL-safe: spacing uses logical gap; no left/right keywords.
    Reduced-motion: the ping halo is disabled under prefers-reduced-motion.
--}}
@props([
    'status' => 'online',
    'size' => 'default',
    'pulse' => false,
    'label' => null,
    'showLabel' => false,
])

@once('blat-presence')
    <style>
        @media (prefers-reduced-motion: reduce) {
            [data-slot="presence"] .blat-presence-ping { animation: none !important; }
        }
    </style>
@endonce

@php
    $pulse = filter_var($pulse, FILTER_VALIDATE_BOOLEAN);
    $showLabel = filter_var($showLabel, FILTER_VALIDATE_BOOLEAN);

    $status = in_array($status, ['online', 'away', 'busy', 'offline'], true) ? $status : 'online';

    // Fixed, literal status colours (not interpolated) so the Tailwind scanner emits them.
    $colors = [
        'online'  => 'bg-emerald-500',
        'away'    => 'bg-amber-500',
        'busy'    => 'bg-destructive',
        'offline' => 'bg-muted-foreground/40',
    ];
    $dotColor = $colors[$status];

    // Default human label per status (overridable via `label`).
    $labels = [
        'online'  => 'Online',
        'away'    => 'Away',
        'busy'    => 'Busy',
        'offline' => 'Offline',
    ];
    $text = $label ?? $labels[$status];

    // Literal dot sizes for the Tailwind scanner.
    $sizes = ['sm' => 'size-2', 'default' => 'size-2.5', 'lg' => 'size-3.5'];
    $dotSize = $sizes[$size] ?? $sizes['default'];

    // Only ping when explicitly enabled. Default policy: online only, unless a label
    // override implies the consumer wants it elsewhere — keep it simple: pulse + online.
    $showPing = $pulse && $status === 'online';
@endphp

<span
    data-slot="presence"
    data-status="{{ $status }}"
    {{ $attributes->twMerge('relative inline-flex items-center gap-1.5') }}
>
    <span class="relative inline-flex {{ $dotSize }} shrink-0">
        @if ($showPing)
            <span class="blat-presence-ping absolute inline-flex h-full w-full animate-ping rounded-full {{ $dotColor }} opacity-75" aria-hidden="true"></span>
        @endif
        <span @class([
            'ring-background relative inline-flex rounded-full ring-2',
            $dotSize,
            $dotColor,
        ]) aria-hidden="true"></span>
    </span>

    @if ($showLabel)
        <span class="text-sm text-foreground">{{ $text }}</span>
    @else
        <span class="sr-only">{{ $text }}</span>
    @endif
</span>
