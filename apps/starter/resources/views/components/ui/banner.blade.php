{{--
    Banner — a full-width announcement bar (top of page / above content).
      tone         default | primary | info | success | warning | danger  (semantic tokens)
      dismissible  show a close button (default true)
      id + persist remember the dismissal in localStorage (so it stays closed on return)
    A11y: role="region" with a label; the close button is labelled.
--}}
@props([
    'tone' => 'default',
    'dismissible' => true,
    'id' => null,
    'persist' => false,
])

@php
    $tones = [
        'default' => 'bg-muted text-foreground border-border',
        'primary' => 'bg-primary text-primary-foreground border-transparent',
        'info' => 'bg-info/10 text-info border-info/25',
        'success' => 'bg-success/10 text-success border-success/25',
        'warning' => 'bg-warning/10 text-warning border-warning/25',
        'danger' => 'bg-destructive/10 text-destructive border-destructive/25',
    ];
    $cls = $tones[$tone] ?? $tones['default'];
    $storeKey = ($persist && $id) ? 'blat-banner-'.$id : null;
    $showInit = $storeKey ? "localStorage.getItem('{$storeKey}') !== '1'" : 'true';
@endphp

<div
    data-slot="banner"
    x-data="{ show: {{ $showInit }}, dismiss() { this.show = false; @if ($storeKey) localStorage.setItem('{{ $storeKey }}', '1'); @endif } }"
    x-show="show"
    x-cloak
    role="region"
    aria-label="Announcement"
    {{ $attributes->twMerge('relative flex w-full items-center gap-3 border-b px-4 py-2.5 text-sm '.$cls) }}
>
    <div class="flex flex-1 flex-wrap items-center justify-center gap-x-3 gap-y-1">
        {{ $slot }}
    </div>
    @if ($dismissible)
        <button
            type="button"
            @click="dismiss()"
            aria-label="Dismiss"
            class="shrink-0 rounded-md p-1 opacity-70 transition-opacity outline-none hover:opacity-100 focus-visible:ring-2 focus-visible:ring-current/40"
        >
            <x-lucide-x class="size-4" aria-hidden="true" />
        </button>
    @endif
</div>
