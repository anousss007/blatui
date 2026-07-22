@props([
    'index' => 1,
    'title' => null,
    'url' => null,
    'snippet' => null,
])

@php
    // Derive a clean host (domain) from the URL for display, e.g. "example.com".
    $host = $url ? preg_replace('#^www\.#', '', (string) (parse_url($url, PHP_URL_HOST) ?: $url)) : null;
    $label = trim('Source '.$index.($title ? ': '.$title : ''));
@endphp

<span
    data-slot="citation"
    x-data="{
        open: false,
        t: null,
        show() { clearTimeout(this.t); this.open = true; },
        hide() { clearTimeout(this.t); this.t = setTimeout(() => this.open = false, 120); },
    }"
    x-id="['blat-citation']"
    @mouseenter="show()"
    @mouseleave="hide()"
    @keydown.escape="open = false"
    {{ $attributes->twMerge('relative inline-block align-super text-[0.7em] leading-none') }}
>
    <button
        type="button"
        :id="$id('blat-citation') + '-trigger'"
        aria-label="{{ $label }}"
        :aria-expanded="open"
        :aria-controls="$id('blat-citation')"
        @click="open = !open"
        @focus="show()"
        @blur="hide()"
        class="inline-flex min-w-[1.25em] items-center justify-center rounded-full bg-muted px-[0.4em] py-[0.1em] font-medium text-foreground tabular-nums no-underline outline-none transition-colors hover:bg-muted/70 focus-visible:ring-ring/50 focus-visible:ring-[3px] cursor-pointer"
    >{{ $index }}</button>

    <span
        x-show="open"
        x-cloak
        :id="$id('blat-citation')"
        role="dialog"
        aria-label="{{ $label }}"
        @mouseenter="show()"
        @mouseleave="hide()"
        @click.outside="open = false"
        x-transition.opacity.duration.150ms
        class="absolute start-0 top-full z-50 mt-2 block w-72 max-w-[min(20rem,90vw)] rounded-md border bg-popover p-3 text-start text-popover-foreground shadow-md text-sm leading-normal align-baseline"
    >
        @if ($title)
            <span class="block font-medium text-popover-foreground">{{ $title }}</span>
        @endif

        @if ($url)
            <x-ui.link
                :href="$url"
                :external="true"
                variant="muted"
                class="mt-0.5 inline-flex max-w-full items-center gap-1 text-xs"
            >
                <span class="truncate">{{ $host }}</span>
                <x-lucide-external-link class="size-3 shrink-0" aria-hidden="true" />
            </x-ui.link>
        @endif

        @if ($snippet)
            <span class="mt-2 block text-xs text-muted-foreground">{{ $snippet }}</span>
        @endif

        {{ $slot }}
    </span>
</span>
