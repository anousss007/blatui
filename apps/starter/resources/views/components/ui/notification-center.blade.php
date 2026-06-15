@props([
    'notifications' => [],  // [['title','body'?,'time','read'?,'icon'?,'avatar'?], ...]
    'open' => false,        // demo/initial open state — defaults the panel open so reviewers see it
])

@php
    // Normalise each notification to a stable shape. The list itself is rendered server-side
    // (so a per-item lucide icon / avatar resolves cleanly), while the reactive read-state
    // lives in Alpine keyed by index — clicking an item, the badge count and the unread tint
    // all stay in sync. `read` is the only field Alpine needs to mutate.
    $feed = collect($notifications)->values()->map(fn ($n, $i) => [
        'id' => $i,
        'title' => (string) ($n['title'] ?? ''),
        'body' => isset($n['body']) && $n['body'] !== '' ? (string) $n['body'] : null,
        'time' => (string) ($n['time'] ?? ''),
        'read' => (bool) ($n['read'] ?? false),
        'icon' => isset($n['icon']) && $n['icon'] !== '' ? (string) $n['icon'] : null,
        'avatar' => $n['avatar'] ?? null,
    ])->all();

    // Alpine only tracks read-state; titles/bodies/times/icons are baked into the DOM.
    $readState = collect($feed)->map(fn ($n) => ['read' => $n['read']])->all();
@endphp

<div
    data-slot="notification-center"
    x-data="{
        open: @js((bool) $open),
        items: @js($readState),
        get unread() { return this.items.filter(i => ! i.read).length },
        get isEmpty() { return this.items.length === 0 },
        markRead(i) { if (this.items[i]) this.items[i].read = true },
        markAllRead() { this.items.forEach(i => i.read = true) },
        toggle() { this.open ? this.close(false) : this.openPanel() },
        openPanel() { this.open = true; this.$nextTick(() => this.$refs.panel?.focus()) },
        close(returnFocus = true) {
            if (! this.open) return;
            this.open = false;
            if (returnFocus) this.$nextTick(() => this.$refs.trigger?.focus());
        },
    }"
    x-id="['blat-notification-center', 'blat-notification-title']"
    {{ $attributes->twMerge('relative inline-block') }}
>
    {{-- Trigger: a bell with a live unread-count badge. The count lives in the accessible
         name, so the visible badge is aria-hidden to avoid double-announcing. --}}
    <button
        type="button"
        x-ref="trigger"
        @click="toggle()"
        aria-haspopup="dialog"
        :aria-expanded="open"
        :aria-controls="$id('blat-notification-center')"
        :aria-label="(unread === 0 ? 'Notifications, no unread' : unread === 1 ? 'Notifications, 1 unread' : 'Notifications, ' + unread + ' unread')"
        class="text-foreground hover:bg-accent hover:text-accent-foreground relative inline-flex size-9 items-center justify-center rounded-md outline-none transition-colors focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
    >
        <x-lucide-bell class="size-5" aria-hidden="true" />
        <span
            x-show="unread > 0"
            x-cloak
            x-text="unread > 99 ? '99+' : unread"
            aria-hidden="true"
            class="bg-destructive ring-background absolute -end-1 -top-1 inline-flex h-4 min-w-4 items-center justify-center rounded-full px-1 text-[0.625rem] leading-none font-semibold text-white ring-2 tabular-nums"
        ></span>
    </button>

    {{-- Teleported to <body> so the panel is never clipped by an overflow-hidden ancestor. --}}
    <template x-teleport="body">
    <div
        x-show="open"
        x-cloak
        x-ref="panel"
        x-anchor.bottom-end.offset.8="$refs.trigger"
        @click.outside="close(false)"
        @keydown.escape.prevent.stop="close()"
        x-trap="open"
        :id="$id('blat-notification-center')"
        role="dialog"
        aria-modal="false"
        :aria-labelledby="$id('blat-notification-title')"
        tabindex="-1"
        data-slot="notification-center-panel"
        :data-state="open ? 'open' : 'closed'"
        x-transition:enter="transition ease-out duration-150"
        x-transition:enter-start="opacity-0 scale-95"
        x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="transition ease-in duration-100"
        x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-95"
        class="bg-popover text-popover-foreground fixed z-50 flex max-h-[28rem] w-80 origin-top flex-col overflow-hidden rounded-md border shadow-md outline-hidden sm:w-96"
    >
        {{-- Header --}}
        <div class="flex items-center justify-between gap-2 border-b px-4 py-3">
            <h2 :id="$id('blat-notification-title')" class="text-sm font-semibold">Notifications</h2>
            <button
                type="button"
                @click="markAllRead()"
                :disabled="unread === 0"
                aria-label="Mark all notifications as read"
                class="text-muted-foreground hover:text-foreground inline-flex items-center gap-1 rounded-md text-xs font-medium outline-none transition-colors not-disabled:cursor-pointer focus-visible:ring-ring/50 focus-visible:ring-[3px] disabled:opacity-50 [&_svg]:size-3.5"
            >
                <x-lucide-check-check aria-hidden="true" />
                Mark all read
            </button>
        </div>

        @if (empty($feed))
            {{-- Empty state --}}
            <div class="flex flex-col items-center justify-center gap-3 px-6 py-12 text-center">
                <span class="bg-muted text-muted-foreground flex size-12 items-center justify-center rounded-full">
                    <x-lucide-bell-off class="size-6" aria-hidden="true" />
                </span>
                <div class="space-y-1">
                    <p class="text-foreground text-sm font-medium">You're all caught up</p>
                    <p class="text-muted-foreground text-xs">No notifications right now.</p>
                </div>
            </div>
        @else
            {{-- Notification list (scrollable). Each row's tint + unread markers are driven by
                 the reactive read-state at items[index]; clicking marks it read. --}}
            <ul role="list" class="min-h-0 flex-1 divide-y overflow-y-auto">
                @foreach ($feed as $note)
                    <li
                        @click="markRead({{ $note['id'] }})"
                        :class="items[{{ $note['id'] }}].read ? 'hover:bg-accent/50' : 'bg-muted/60 hover:bg-muted'"
                        class="relative flex cursor-pointer items-start gap-3 px-4 py-3 ps-5 transition-colors"
                    >
                        {{-- Unread accent bar at the inline-start edge (RTL-safe). --}}
                        <span
                            x-show="! items[{{ $note['id'] }}].read"
                            aria-hidden="true"
                            class="bg-primary absolute inset-y-0 start-0 w-1"
                        ></span>

                        {{-- Leading visual: avatar, then a named lucide icon, else a default bell. --}}
                        @if (! empty($note['avatar']))
                            <img src="{{ $note['avatar'] }}" alt="" class="bg-muted size-9 shrink-0 rounded-full object-cover" />
                        @else
                            <span class="bg-muted text-muted-foreground flex size-9 shrink-0 items-center justify-center rounded-full" aria-hidden="true">
                                <x-dynamic-component :component="'lucide-'.($note['icon'] ?? 'bell')" class="size-4" />
                            </span>
                        @endif

                        {{-- Title + body + time --}}
                        <div class="min-w-0 flex-1">
                            <p class="text-foreground text-sm font-medium">{{ $note['title'] }}</p>
                            @if ($note['body'])
                                <p class="text-muted-foreground mt-0.5 text-xs leading-snug">{{ $note['body'] }}</p>
                            @endif
                            <p class="text-muted-foreground mt-1 text-[0.6875rem]">{{ $note['time'] }}</p>
                        </div>

                        {{-- Unread dot (labelled for AT; hidden once read). --}}
                        <span
                            x-show="! items[{{ $note['id'] }}].read"
                            role="img"
                            aria-label="Unread"
                            class="bg-primary mt-1.5 size-2 shrink-0 rounded-full"
                        ></span>
                    </li>
                @endforeach
            </ul>

            {{-- Footer --}}
            <div class="shrink-0 border-t p-2">
                <a
                    href="#"
                    class="text-foreground hover:bg-accent hover:text-accent-foreground flex w-full items-center justify-center rounded-md px-3 py-2 text-sm font-medium outline-none transition-colors focus-visible:ring-ring/50 focus-visible:ring-[3px]"
                >
                    View all notifications
                </a>
            </div>
        @endif
    </div>
    </template>
</div>
