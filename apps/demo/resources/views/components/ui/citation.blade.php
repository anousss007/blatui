@props([
    'index' => 1,
    'title' => null,
    'url' => null,
    'snippet' => null,
])

@php
    // Derive a clean host (domain) from the URL for display, e.g. "example.com".
    $host = $url ? preg_replace('#^www\.#', '', (string) (parse_url($url, PHP_URL_HOST) ?: $url)) : null;
    $label = trim($title
        ? __('Source :index: :title', ['index' => $index, 'title' => $title])
        : __('Source :index', ['index' => $index]));
@endphp

<span
    data-slot="citation"
    x-data="{
        open: false,
        t: null,
        show() {
            clearTimeout(this.t);
            this.open = true;
        },
        hide() {
            clearTimeout(this.t);
            this.t = setTimeout(() => (this.open = false), 120);
        },
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
        @click="open = ! open"
        @focus="show()"
        @blur="hide()"
        class="bg-muted text-foreground hover:bg-muted/70 focus-visible:ring-ring/50 inline-flex min-w-[1.25em] cursor-pointer items-center justify-center rounded-full px-[0.4em] py-[0.1em] font-medium tabular-nums no-underline transition-colors outline-none focus-visible:ring-[3px]"
    >
        {{ $index }}
    </button>

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
        class="bg-popover text-popover-foreground absolute start-0 top-full z-50 mt-2 block w-72 max-w-[min(20rem,90vw)] rounded-md border p-3 text-start align-baseline text-sm leading-normal shadow-md"
    >
        @if ($title)
            <span class="text-popover-foreground block font-medium">{{ $title }}</span>
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
            <span class="text-muted-foreground mt-2 block text-xs">{{ $snippet }}</span>
        @endif

        {{ $slot }}
    </span>
</span>
