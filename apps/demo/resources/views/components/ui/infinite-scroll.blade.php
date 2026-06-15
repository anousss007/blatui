{{--
    Infinite Scroll — loads more content when a sentinel scrolls into view.

      threshold   px before the sentinel reaches the viewport/scroll edge at which
                  loadMore() fires (default 200). Mapped to the IntersectionObserver
                  rootMargin so loading begins a little ahead of the actual edge.

    The component renders the default slot (your initial items) followed by:
      - a loading indicator (spinner + text, role="status" aria-live="polite"),
      - a "Load more" <button> (keyboard / no-JS fallback that triggers the same path),
      - and an invisible sentinel that the observer watches.

    How it works: a raw IntersectionObserver (created in init, no Alpine plugin) watches
      the sentinel. When the sentinel enters, loadMore() runs: it sets `loading` (so the
      spinner + aria-busy show), then dispatches a cancelable 'load-more' event. Real apps
      listen for that event (Livewire / fetch) and append server rows, then call
      $el.dispatchEvent(new CustomEvent('load-more-done', { detail: { done: bool } }))
      on the root to clear the loading state (and mark the list finished when done=true).

    The observer auto-detects its scroll root: it walks up from the sentinel to the nearest
      vertically-scrollable ancestor, so the SAME component works whether the page scrolls
      (root = viewport) or it lives inside a fixed-height overflow-y-auto box (root = box).

    A11y: visible loading indicator with role="status" aria-live="polite"; the root carries
      aria-busy while loading; a real focusable "Load more" button is always available for
      keyboard and no-JS users; an "end" message appears with role="status" when finished.
--}}
@props([
    'threshold' => 200,
])

@php
    $threshold = max(0, (int) $threshold);
@endphp

<div
    data-slot="infinite-scroll"
    x-data="{
        loading: false,
        finished: false,
        threshold: @js($threshold),
        observer: null,

        init() {
            if (typeof IntersectionObserver === 'undefined') return; // button fallback still works

            const root = this.scrollParent(this.$refs.sentinel);
            this.observer = new IntersectionObserver(
                (entries) => {
                    for (const entry of entries) {
                        if (entry.isIntersecting) this.loadMore();
                    }
                },
                { root, rootMargin: `0px 0px ${this.threshold}px 0px`, threshold: 0 }
            );
            this.observer.observe(this.$refs.sentinel);
        },

        // Nearest vertically-scrollable ancestor, or null (= viewport) if none.
        scrollParent(el) {
            let node = el?.parentElement;
            while (node) {
                const oy = getComputedStyle(node).overflowY;
                if ((oy === 'auto' || oy === 'scroll') && node.scrollHeight > node.clientHeight) {
                    return node;
                }
                node = node.parentElement;
            }
            return null;
        },

        loadMore() {
            if (this.loading || this.finished) return;
            this.loading = true;

            // Real apps: hook this event to append server items, then dispatch
            // 'load-more-done' on this element (detail.done = no more pages).
            this.$el.dispatchEvent(new CustomEvent('load-more', {
                bubbles: true,
                cancelable: true,
                detail: { done: () => this.finish(), loaded: () => this.loaded() },
            }));
        },

        // Clear the loading state after a batch has been appended.
        loaded() { this.loading = false; },

        // Mark the list complete: hides the sentinel + button, shows the end message.
        finish() { this.loading = false; this.finished = true; },

        destroy() {
            if (this.observer) this.observer.disconnect();
        },
    }"
    @load-more-done="$event.detail && $event.detail.done ? finish() : loaded()"
    :aria-busy="loading ? 'true' : 'false'"
    {{ $attributes->twMerge('flex flex-col gap-2') }}
>
    {{ $slot }}

    {{-- Sentinel: the observer watches this; hidden once finished so it can't re-trigger. --}}
    <div x-ref="sentinel" aria-hidden="true" class="h-px w-full" x-show="!finished" x-cloak></div>

    {{-- Loading indicator — visible, announced politely. --}}
    <div
        role="status"
        aria-live="polite"
        x-show="loading"
        x-cloak
        class="flex items-center justify-center gap-2 py-3 text-sm text-muted-foreground"
    >
        <x-ui.spinner class="size-4" aria-hidden="true" />
        <span>Loading more…</span>
    </div>

    {{-- Keyboard / no-JS fallback: a real button that runs the same load path. --}}
    <div x-show="!finished && !loading" class="flex justify-center py-2">
        <x-ui.button
            type="button"
            variant="outline"
            size="sm"
            x-on:click="loadMore()"
            class="focus-visible:ring-ring/50 focus-visible:ring-[3px]"
        >
            Load more
        </x-ui.button>
    </div>

    {{-- End-of-list message. --}}
    <div
        role="status"
        x-show="finished"
        x-cloak
        class="py-3 text-center text-sm text-muted-foreground"
    >
        You’ve reached the end.
    </div>
</div>
