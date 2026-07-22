@props([
    'to' => null,        // target date/time — anything Carbon can parse, e.g. "2026-12-31 18:00"
    'expired' => 'Expired',
    'labels' => ['days' => 'Days', 'hours' => 'Hrs', 'minutes' => 'Min', 'seconds' => 'Sec'],
])

@php
    // Resolve the target to a millisecond epoch on the server so the countdown is timezone-safe.
    $targetMs = $to ? \Illuminate\Support\Carbon::parse($to)->getTimestampMs() : null;
@endphp

<div
    data-slot="countdown"
    role="timer"
    aria-live="off"
    x-data="{
        target: @js($targetMs),
        now: Date.now(),
        _t: null,
        get diff() { return this.target == null ? 0 : Math.max(0, this.target - this.now) },
        get done() { return this.diff <= 0 },
        get days() { return Math.floor(this.diff / 86400000) },
        get hours() { return Math.floor(this.diff / 3600000) % 24 },
        get minutes() { return Math.floor(this.diff / 60000) % 60 },
        get seconds() { return Math.floor(this.diff / 1000) % 60 },
        pad(n) { return String(n).padStart(2, '0') },
        init() { this._t = setInterval(() => { this.now = Date.now() }, 1000) },
        destroy() { clearInterval(this._t) },
    }"
    {{ $attributes->twMerge('inline-flex items-center gap-2') }}
>
    <span x-show="done" x-cloak data-slot="countdown-expired" class="text-muted-foreground text-sm font-medium">{{ trim($slot) !== '' ? $slot : $expired }}</span>

    <div x-show="!done" class="flex items-center gap-2">
        @foreach (['days', 'hours', 'minutes', 'seconds'] as $unit)
            <div data-slot="countdown-unit" class="bg-card flex min-w-[3.25rem] flex-col items-center rounded-lg border px-2 py-1.5 shadow-xs">
                <span class="text-xl font-bold tabular-nums" x-text="pad({{ $unit }})">00</span>
                <span class="text-muted-foreground text-[10px] font-medium tracking-wide uppercase">{{ $labels[$unit] ?? ucfirst($unit) }}</span>
            </div>
        @endforeach
    </div>
</div>
