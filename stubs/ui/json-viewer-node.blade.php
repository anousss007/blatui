{{--
    Recursive JSON tree node. Rendered server-side for no-flash + a11y.
    Vars: $value, $depth (int), $expanded (bool), $keyName (string|int|null), $isLast (bool).
--}}
@php
    $isAssoc = is_array($value) && (array_keys($value) !== range(0, count($value) - 1) || $value === []);
    // Treat associative arrays + empty arrays as objects {}, sequential arrays as [].
    $isObject = is_array($value) && $isAssoc;
    $isArray = is_array($value) && ! $isAssoc;
    $isContainer = $isObject || $isArray;

    $open = $isObject ? '{' : '[';
    $close = $isObject ? '}' : ']';

    // Key prefix (rendered for every node that lives inside a container).
    $hasKey = $keyName !== null;
    $comma = $isLast ? '' : ',';

    // Padding-inline-start per depth (each level indents 1rem).
    $pad = 'padding-inline-start:' . ($depth * 1) . 'rem';
@endphp

@if ($isContainer)
    @php $count = count($value); @endphp
    <div
        data-slot="json-viewer-node"
        x-data="{ open: @js($expanded) }"
        class="text-muted-foreground"
        style="{{ $pad }}"
    >
        {{-- Toggle row --}}
        <button
            type="button"
            @click="open = !open"
            :aria-expanded="open"
            class="hover:bg-accent/60 focus-visible:ring-ring/50 -mx-1 inline-flex max-w-full items-baseline gap-1 rounded px-1 text-start align-baseline outline-none focus-visible:ring-2"
        >
            <x-lucide-chevron-right
                class="text-muted-foreground size-3 shrink-0 self-center transition-transform"
                ::class="open && 'rotate-90'"
                aria-hidden="true"
            />
            @if ($hasKey)
                @if (is_int($keyName))
                    <span class="text-muted-foreground">{{ $keyName }}</span><span class="text-muted-foreground">:</span>
                @else
                    <span class="text-sky-700 dark:text-sky-400">"{{ $keyName }}"</span><span class="text-muted-foreground">:</span>
                @endif
            @endif
            <span class="text-muted-foreground">{{ $open }}</span>
            {{-- Collapsed summary --}}
            <span x-show="!open" x-cloak class="text-muted-foreground">
                …{{ $close }}{{ $comma }}
                <span class="text-muted-foreground italic">{{ $count }} {{ $isObject ? \Illuminate\Support\Str::plural('key', $count) : \Illuminate\Support\Str::plural('item', $count) }}</span>
            </span>
        </button>

        {{-- Children --}}
        <div x-show="open" x-cloak>
            @foreach ($value as $childKey => $childValue)
                @include('components.ui.json-viewer-node', [
                    'value' => $childValue,
                    'depth' => $depth + 1,
                    'expanded' => $expanded,
                    'keyName' => $childKey,
                    'isLast' => $loop->last,
                ])
            @endforeach
            <div class="text-muted-foreground" style="padding-inline-start:{{ $depth * 1 }}rem">{{ $close }}{{ $comma }}</div>
        </div>
    </div>
@else
    {{-- Primitive leaf --}}
    @php
        if (is_string($value)) {
            $token = '"' . $value . '"';
            $tokenClass = 'text-emerald-700 dark:text-emerald-400';
        } elseif (is_bool($value)) {
            $token = $value ? 'true' : 'false';
            $tokenClass = 'text-purple-700 dark:text-purple-400';
        } elseif (is_null($value)) {
            $token = 'null';
            $tokenClass = 'text-purple-700 dark:text-purple-400';
        } else {
            // int / float
            $token = (string) $value;
            $tokenClass = 'text-amber-700 dark:text-amber-400';
        }
    @endphp
    <div data-slot="json-viewer-leaf" class="text-muted-foreground" style="{{ $pad }}">
        @if ($hasKey)
            @if (is_int($keyName))
                <span class="text-muted-foreground">{{ $keyName }}</span><span class="text-muted-foreground">:</span>
            @else
                <span class="text-sky-700 dark:text-sky-400">"{{ $keyName }}"</span><span class="text-muted-foreground">:</span>
            @endif
        @endif
        <span class="{{ $tokenClass }}">{{ $token }}</span><span class="text-muted-foreground">{{ $comma }}</span>
    </div>
@endif
