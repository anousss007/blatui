@props([
    'actions' => [],            // array of ['icon' => lucideName, 'label' => string, 'href' => ?]
    'direction' => 'up',        // 'up' | 'down' — which way the actions stack from the FAB
    'open' => false,            // start expanded (handy for previews / always-open dials)
    'icon' => 'plus',           // lucide icon for the main FAB (rotates ~45deg when open)
    'label' => 'Open actions',  // accessible label for the main FAB
])

@php
    // Stack actions above (up) or below (down) the FAB. `flex-col-reverse` keeps the
    // first action nearest the FAB when going up; the label pill sits inline-start of
    // each action (justify-end), which is RTL-safe via logical `end`/`start` utilities.
    $isUp = $direction !== 'down';
    $stackClasses = $isUp
        ? 'bottom-full mb-3 flex-col-reverse'
        : 'top-full mt-3 flex-col';

    // Reverse the stagger order so the action closest to the FAB animates first.
    $items = array_values($actions);
@endphp

{{-- A floating action button that expands to reveal a stack of action buttons.
     Self-contained Alpine: toggles `open`, closes on Escape / click-outside, and
     staggers each action in/out. Transitions are suppressed under
     prefers-reduced-motion (the menu just appears). For real use, wrap in a
     `fixed bottom-6 end-6 z-40` container; here it is positioned `relative`. --}}
<div
    data-slot="speed-dial"
    x-data="{
        open: @js((bool) $open),
        count: @js(count($items)),
        toggle() { this.open = !this.open; },
        close() { this.open = false; },
    }"
    @keydown.escape.window="open && (close(), $refs.fab.focus())"
    @click.outside="close()"
    {{ $attributes->twMerge('relative inline-flex flex-col items-center motion-reduce:transition-none') }}
>
    {{-- Action stack: absolutely positioned so toggling does not shift the FAB. --}}
    <div
        class="absolute {{ $stackClasses }} flex items-center gap-3"
        :class="open ? '' : 'pointer-events-none'"
    >
        @foreach ($items as $i => $action)
            @php
                // Stagger: the action nearest the FAB leads. For `up` the DOM order is
                // reversed by flex-col-reverse, so invert the delay index to match.
                $delayIndex = $isUp ? (count($items) - 1 - $i) : $i;
                $delayMs = $delayIndex * 40;
                $tag = ! empty($action['href']) ? 'a' : 'button';
            @endphp
            <{{ $tag }}
                @if ($tag === 'a')
                    href="{{ $action['href'] }}"
                @else
                    type="button"
                @endif
                aria-label="{{ $action['label'] ?? 'Action '.($i + 1) }}"
                :tabindex="open ? 0 : -1"
                @click="close()"
                x-show="open"
                x-transition:enter="transition ease-out duration-200 motion-reduce:transition-none"
                x-transition:enter-start="opacity-0 scale-75 {{ $isUp ? 'translate-y-2' : '-translate-y-2' }}"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-150 motion-reduce:transition-none"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-75 {{ $isUp ? 'translate-y-2' : '-translate-y-2' }}"
                style="transition-delay: {{ $delayMs }}ms"
                class="group/action inline-flex items-center justify-end gap-2 outline-none"
            >
                {{-- Visible label pill sits inline-start of the round button (RTL-safe). --}}
                @if (! empty($action['label']))
                    <span class="bg-popover text-popover-foreground pointer-events-none rounded-md border px-2.5 py-1 text-xs font-medium whitespace-nowrap shadow-sm">
                        {{ $action['label'] }}
                    </span>
                @endif
                <span class="bg-card text-foreground inline-flex size-10 shrink-0 items-center justify-center rounded-full border shadow-sm transition-colors group-hover/action:bg-accent group-hover/action:text-accent-foreground group-focus-visible/action:ring-ring/50 group-focus-visible/action:ring-[3px]">
                    @if (! empty($action['icon']))
                        <x-dynamic-component :component="'lucide-'.$action['icon']" class="size-5" aria-hidden="true" />
                    @endif
                </span>
            </{{ $tag }}>
        @endforeach
    </div>

    {{-- Main FAB: circular, primary-coloured; its icon rotates ~45deg when open. --}}
    <button
        x-ref="fab"
        type="button"
        aria-label="{{ $label }}"
        aria-haspopup="menu"
        :aria-expanded="open ? 'true' : 'false'"
        @click="toggle()"
        class="bg-primary text-primary-foreground inline-flex size-14 shrink-0 cursor-pointer items-center justify-center rounded-full shadow-lg transition-colors outline-none hover:bg-primary/90 focus-visible:ring-ring/50 focus-visible:ring-[3px]"
    >
        <x-dynamic-component
            :component="'lucide-'.$icon"
            class="size-6 transition-transform duration-200 ease-out motion-reduce:transition-none"
            ::class="open ? 'rotate-45' : 'rotate-0'"
            aria-hidden="true"
        />
    </button>
</div>
