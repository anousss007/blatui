@props([
    'name' => 'tool',
    'status' => 'success',   // pending | running | success | error
    'args' => null,          // array (pretty-printed JSON) or string
    'result' => null,        // array (pretty-printed JSON) or string
    'open' => false,
    'id' => null,
])

@php
    $status = in_array($status, ['pending', 'running', 'success', 'error'], true) ? $status : 'success';

    // Normalise args/result: arrays become pretty JSON; everything else is cast to string.
    $fmt = function ($v) {
        if ($v === null) {
            return null;
        }
        if (is_array($v) || is_object($v)) {
            return json_encode($v, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        }

        return (string) $v;
    };

    $argsText = $fmt($args);
    $resultText = $fmt($result);

    // Status presentation: icon + human label (never colour alone). Literal class
    // strings so Tailwind's source scanner generates them.
    $statusMeta = [
        'pending' => ['label' => 'Pending', 'text' => 'text-muted-foreground'],
        'running' => ['label' => 'Running', 'text' => 'text-foreground'],
        'success' => ['label' => 'Success', 'text' => 'text-emerald-700 dark:text-emerald-400'],
        'error' => ['label' => 'Error', 'text' => 'text-destructive'],
    ];
    $meta = $statusMeta[$status];
@endphp

<div
    data-slot="tool-call"
    x-data="{ open: @js((bool) $open) }"
    x-id="['blat-tool-call']"
    data-status="{{ $status }}"
    {{ $attributes->twMerge('bg-card text-card-foreground overflow-hidden rounded-lg border text-sm') }}
>
    <button
        type="button"
        data-slot="tool-call-trigger"
        @click="open = !open"
        :id="$id('blat-tool-call', 'trigger')"
        :aria-controls="$id('blat-tool-call', 'body')"
        :aria-expanded="open"
        :data-state="open ? 'open' : 'closed'"
        @if ($id) data-tool-id="{{ $id }}" @endif
        class="focus-visible:ring-ring focus-visible:ring-[3px] focus-visible:ring-offset-0 flex w-full items-center gap-3 px-4 py-3 text-start outline-none transition-colors hover:bg-muted/50"
    >
        <x-lucide-wrench class="text-muted-foreground pointer-events-none size-4 shrink-0" aria-hidden="true" />

        <span data-slot="tool-call-name" class="min-w-0 flex-1 truncate font-mono text-sm font-medium">{{ $name }}</span>

        <span data-slot="tool-call-status" @class(['inline-flex items-center gap-1.5 whitespace-nowrap text-xs font-medium', $meta['text']])>
            @switch($status)
                @case('running')
                    <x-lucide-loader-circle class="size-3.5 shrink-0 animate-spin" aria-hidden="true" />
                    <span class="sr-only">Running</span>
                    @break

                @case('success')
                    <x-lucide-check class="size-3.5 shrink-0" aria-hidden="true" />
                    @break

                @case('error')
                    <x-lucide-x class="size-3.5 shrink-0" aria-hidden="true" />
                    @break

                @default
                    <x-lucide-clock class="size-3.5 shrink-0" aria-hidden="true" />
            @endswitch
            <span data-slot="tool-call-status-label">{{ $meta['label'] }}</span>
        </span>

        <x-lucide-chevron-down
            class="text-muted-foreground pointer-events-none size-4 shrink-0 transition-transform duration-200 [[data-state=open]>&]:rotate-180"
            aria-hidden="true"
        />
    </button>

    <div
        data-slot="tool-call-body"
        role="region"
        :id="$id('blat-tool-call', 'body')"
        :aria-labelledby="$id('blat-tool-call', 'trigger')"
        x-show="open"
        x-collapse
        x-cloak
        :data-state="open ? 'open' : 'closed'"
        class="overflow-hidden border-t"
    >
        <div class="space-y-4 px-4 py-3">
            @if ($argsText !== null)
                <div data-slot="tool-call-arguments">
                    <p class="text-muted-foreground mb-1.5 text-xs font-medium">Arguments</p>
                    <pre tabindex="0" class="bg-muted focus-visible:ring-ring/50 overflow-x-auto rounded-md p-3 font-mono text-xs leading-relaxed text-foreground outline-none focus-visible:ring-[3px]"><code>{{ $argsText }}</code></pre>
                </div>
            @endif

            @if ($resultText !== null)
                <div data-slot="tool-call-result">
                    <p class="text-muted-foreground mb-1.5 text-xs font-medium">Result</p>
                    <pre tabindex="0" @class(['bg-muted focus-visible:ring-ring/50 overflow-x-auto rounded-md p-3 font-mono text-xs leading-relaxed outline-none focus-visible:ring-[3px]', $status === 'error' ? 'text-destructive' : 'text-foreground'])><code>{{ $resultText }}</code></pre>
                </div>
            @endif

            @if ($argsText === null && $resultText === null)
                <p class="text-muted-foreground text-xs">No arguments or result.</p>
            @endif
        </div>
    </div>
</div>
