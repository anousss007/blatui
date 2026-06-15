@props([
    'items' => [],          // [['name','variant'?,'price','qty','image'?], ...]
    'currency' => '$',
    'open' => false,        // demo/initial open state — defaults the panel open so reviewers see it
])

@php
    // Normalise each line item to a stable shape. `id` keys the Alpine x-for so removing
    // one row never re-binds another; derived from the seeded index (stable for this render).
    $lineItems = collect($items)->values()->map(fn ($it, $i) => [
        'id' => $i,
        'name' => (string) ($it['name'] ?? ''),
        'variant' => isset($it['variant']) && $it['variant'] !== '' ? (string) $it['variant'] : null,
        'price' => (float) ($it['price'] ?? 0),
        'qty' => max(1, (int) ($it['qty'] ?? 1)),
        'image' => $it['image'] ?? null,
    ])->all();
@endphp

<div
    data-slot="mini-cart"
    x-data="{
        open: @js((bool) $open),
        currency: @js((string) $currency),
        items: @js($lineItems),
        get count() { return this.items.reduce((n, i) => n + i.qty, 0) },
        get subtotal() { return this.items.reduce((s, i) => s + i.price * i.qty, 0) },
        get isEmpty() { return this.items.length === 0 },
        money(n) {
            return this.currency + (Math.round(n * 100) / 100).toFixed(2);
        },
        inc(item) { item.qty++ },
        dec(item) { if (item.qty > 1) item.qty--; else this.remove(item.id) },
        remove(id) {
            const i = this.items.findIndex(it => it.id === id);
            if (i !== -1) this.items.splice(i, 1);
        },
        toggle() { this.open ? this.close(false) : this.openPanel() },
        openPanel() { this.open = true; this.$nextTick(() => this.$refs.panel?.focus()) },
        close(returnFocus = true) {
            if (! this.open) return;
            this.open = false;
            if (returnFocus) this.$nextTick(() => this.$refs.trigger?.focus());
        },
    }"
    x-id="['blat-mini-cart']"
    {{ $attributes->twMerge('relative inline-block') }}
>
    {{-- Trigger: cart icon + a live count badge. Labelled for screen readers; the visible
         badge is aria-hidden because the count is already in the accessible name. --}}
    <button
        type="button"
        x-ref="trigger"
        @click="toggle()"
        aria-haspopup="dialog"
        :aria-expanded="open"
        :aria-controls="$id('blat-mini-cart')"
        :aria-label="(count === 1 ? '1 item in cart' : count + ' items in cart') + ', open cart'"
        class="text-foreground hover:bg-accent hover:text-accent-foreground relative inline-flex size-9 items-center justify-center rounded-md outline-none transition-colors focus-visible:border-ring focus-visible:ring-ring/50 focus-visible:ring-[3px]"
    >
        <x-lucide-shopping-cart class="size-5" aria-hidden="true" />
        <span
            x-show="count > 0"
            x-cloak
            x-text="count > 99 ? '99+' : count"
            aria-hidden="true"
            class="bg-primary text-primary-foreground absolute -end-1 -top-1 inline-flex h-5 min-w-5 items-center justify-center rounded-full px-1 text-[0.625rem] leading-none font-semibold tabular-nums"
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
        :id="$id('blat-mini-cart')"
        role="dialog"
        aria-modal="false"
        :aria-label="(count === 1 ? 'Cart, 1 item' : 'Cart, ' + count + ' items')"
        tabindex="-1"
        data-slot="mini-cart-panel"
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
            <h2 class="text-sm font-semibold" x-text="'Cart (' + count + ')'"></h2>
            <button
                type="button"
                @click="close()"
                aria-label="Close cart"
                class="text-muted-foreground hover:bg-accent hover:text-accent-foreground -me-1 inline-flex size-7 items-center justify-center rounded-md outline-none transition-colors focus-visible:ring-ring/50 focus-visible:ring-[3px]"
            >
                <x-lucide-x class="size-4" aria-hidden="true" />
            </button>
        </div>

        {{-- Empty state --}}
        <div x-show="isEmpty" class="flex flex-col items-center justify-center gap-3 px-6 py-12 text-center">
            <span class="bg-muted text-muted-foreground flex size-12 items-center justify-center rounded-full">
                <x-lucide-shopping-cart class="size-6" aria-hidden="true" />
            </span>
            <div class="space-y-1">
                <p class="text-foreground text-sm font-medium">Your cart is empty</p>
                <p class="text-muted-foreground text-xs">Add items to get started.</p>
            </div>
        </div>

        {{-- Line items (scrollable) --}}
        <ul x-show="! isEmpty" role="list" class="min-h-0 flex-1 divide-y overflow-y-auto">
            <template x-for="item in items" :key="item.id">
                <li class="flex items-start gap-3 px-4 py-3">
                    {{-- Thumbnail --}}
                    <template x-if="item.image">
                        <img :src="item.image" alt="" class="bg-muted size-14 shrink-0 rounded-md border object-cover" />
                    </template>
                    <template x-if="! item.image">
                        <span class="bg-muted text-muted-foreground flex size-14 shrink-0 items-center justify-center rounded-md border" aria-hidden="true">
                            <x-lucide-image class="size-5" />
                        </span>
                    </template>

                    {{-- Name + variant + stepper --}}
                    <div class="min-w-0 flex-1">
                        <p class="text-foreground truncate text-sm font-medium" x-text="item.name"></p>
                        <p x-show="item.variant" class="text-muted-foreground truncate text-xs" x-text="item.variant"></p>
                        <p class="text-muted-foreground mt-0.5 text-xs tabular-nums" x-text="money(item.price) + ' each'"></p>

                        {{-- Quantity stepper --}}
                        <div class="mt-2 inline-flex items-center" role="group" :aria-label="'Quantity for ' + item.name">
                            <button
                                type="button"
                                @click="dec(item)"
                                :aria-label="'Decrease quantity of ' + item.name"
                                class="border-input text-muted-foreground hover:bg-accent hover:text-accent-foreground flex size-6 items-center justify-center rounded-s-md border outline-none transition-colors focus-visible:ring-ring/50 focus-visible:ring-[3px] [&_svg]:size-3"
                            >
                                <x-lucide-minus aria-hidden="true" />
                            </button>
                            <span
                                class="border-input flex h-6 min-w-8 items-center justify-center border-y px-2 text-xs font-medium tabular-nums"
                                aria-live="polite"
                                :aria-label="item.qty + ' in cart'"
                                x-text="item.qty"
                            ></span>
                            <button
                                type="button"
                                @click="inc(item)"
                                :aria-label="'Increase quantity of ' + item.name"
                                class="border-input text-muted-foreground hover:bg-accent hover:text-accent-foreground flex size-6 items-center justify-center rounded-e-md border outline-none transition-colors focus-visible:ring-ring/50 focus-visible:ring-[3px] [&_svg]:size-3"
                            >
                                <x-lucide-plus aria-hidden="true" />
                            </button>
                        </div>
                    </div>

                    {{-- Line total + remove --}}
                    <div class="flex shrink-0 flex-col items-end gap-2">
                        <span class="text-foreground text-sm font-semibold tabular-nums" x-text="money(item.price * item.qty)"></span>
                        <button
                            type="button"
                            @click="remove(item.id)"
                            :aria-label="'Remove ' + item.name"
                            class="text-muted-foreground hover:bg-accent hover:text-destructive inline-flex size-6 items-center justify-center rounded-md outline-none transition-colors focus-visible:ring-ring/50 focus-visible:ring-[3px] [&_svg]:size-3.5"
                        >
                            <x-lucide-x aria-hidden="true" />
                        </button>
                    </div>
                </li>
            </template>
        </ul>

        {{-- Footer: subtotal + actions (hidden when empty) --}}
        <div x-show="! isEmpty" class="shrink-0 border-t">
            <div class="flex items-center justify-between px-4 pt-3 text-sm">
                <span class="text-muted-foreground">Subtotal</span>
                <span class="text-foreground font-semibold tabular-nums" x-text="money(subtotal)"></span>
            </div>
            <p class="text-muted-foreground px-4 pt-1 text-xs">Shipping &amp; taxes calculated at checkout.</p>
            <div class="flex flex-col gap-2 p-4">
                <x-ui.button class="w-full">Checkout</x-ui.button>
                <x-ui.button href="#" variant="outline" class="w-full">View cart</x-ui.button>
            </div>
        </div>
    </div>
    </template>
</div>
