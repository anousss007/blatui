@props([
    'data' => null,        // a PHP array/object OR a JSON string — normalized to an array
    'expanded' => true,    // seed open state for collapsible nodes
    'rootLabel' => null,   // optional label shown before the root node (e.g. "response")
])

@php
    // Normalize $data to a PHP value we can recurse over.
    // Accept: JSON string, array, object, or scalar.
    $jsonValue = $data;
    if (is_string($data)) {
        $decoded = json_decode($data, true);
        $jsonValue = json_last_error() === JSON_ERROR_NONE ? $decoded : $data;
    } elseif (is_object($data)) {
        $jsonValue = json_decode(json_encode($data), true);
    }

    // Pretty JSON for the copy button (unescaped slashes/unicode for readability).
    $prettyJson = json_encode($jsonValue, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
@endphp

<div
    data-slot="json-viewer"
    x-data="{ copied: false, copy() { navigator.clipboard.writeText(this.$refs.json.textContent); this.copied = true; clearTimeout(this._t); this._t = setTimeout(() => this.copied = false, 1600) } }"
    {{ $attributes->twMerge('bg-muted/40 text-foreground overflow-hidden rounded-lg border font-mono text-xs') }}
>
    {{-- Header: optional label + copy button --}}
    <div data-slot="json-viewer-header" class="border-border/60 flex items-center justify-between gap-2 border-b px-3 py-1.5">
        <span data-slot="json-viewer-label" class="text-muted-foreground flex items-center gap-1.5 truncate">
            <x-lucide-braces class="size-3.5 shrink-0" aria-hidden="true" />
            <span class="truncate">{{ $rootLabel ?? 'JSON' }}</span>
        </span>
        <button
            type="button"
            @click="copy()"
            data-slot="json-viewer-copy"
            aria-label="Copy JSON"
            class="text-muted-foreground hover:bg-accent hover:text-foreground focus-visible:ring-ring/50 -me-1 inline-flex shrink-0 items-center rounded-md p-1.5 outline-none transition-colors focus-visible:ring-[3px]"
        >
            <x-lucide-copy class="size-3.5" x-show="!copied" />
            <x-lucide-check class="size-3.5 text-emerald-600 dark:text-emerald-400" x-show="copied" x-cloak />
        </button>
    </div>

    {{-- Hidden source used by the copy button (the pretty JSON). --}}
    <span x-ref="json" class="sr-only">{{ $prettyJson }}</span>

    {{-- Tree (code is LTR; block layout — indentation comes from padding, not whitespace). --}}
    <div dir="ltr" data-slot="json-viewer-tree" class="overflow-x-auto whitespace-nowrap p-3 leading-relaxed">
        @include('components.ui.json-viewer-node', [
            'value' => $jsonValue,
            'depth' => 0,
            'expanded' => (bool) $expanded,
            'keyName' => null,
            'isLast' => true,
        ])
    </div>
</div>
