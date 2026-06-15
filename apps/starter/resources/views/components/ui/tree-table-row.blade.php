@props([
    'row' => [],        // associative row data; may carry 'children' => [...]
    'columns' => [],    // shared column config from the parent table
    'path' => '0',      // dotted path-id, e.g. "0", "0.1", "0.1.2"
    'depth' => 0,       // 0-based nesting depth (drives indent)
])

@php
    $columns = array_values($columns);
    $children = $row['children'] ?? [];
    $hasChildren = is_array($children) && count($children) > 0;
    // Logical indent so it flips automatically under RTL.
    $indent = $depth * 1.25; // rem
    $level = $depth + 1;     // 1-based aria-level

    $alignClass = fn ($align) => match ($align) {
        'right' => 'text-right',
        'center' => 'text-center',
        default => 'text-left',
    };
@endphp

<tr
    data-slot="tree-table-row"
    @if ($depth > 0) x-show="isVisible(@js($path))" x-cloak @endif
    class="hover:bg-muted/50 border-b transition-colors last:border-0"
>
    @foreach ($columns as $colIndex => $col)
        @php
            $key = $col['key'] ?? '';
            $value = $row[$key] ?? '';
            $isTreeCol = $colIndex === 0;
        @endphp
        <td
            @class([
                'px-4 py-2.5 align-middle',
                $alignClass($col['align'] ?? null),
            ])
            @if ($isTreeCol) style="padding-inline-start: {{ 1 + $indent }}rem;" @endif
        >
            @if ($isTreeCol)
                <div class="flex items-center gap-1.5">
                    @if ($hasChildren)
                        <button
                            type="button"
                            @click="toggle(@js($path))"
                            :aria-expanded="isOpen(@js($path)) ? 'true' : 'false'"
                            aria-label="Toggle row"
                            class="text-muted-foreground hover:text-foreground focus-visible:ring-ring/50 -ms-1 flex size-5 shrink-0 cursor-pointer items-center justify-center rounded outline-none focus-visible:ring-[3px] [&[aria-expanded=true]>svg]:rotate-90"
                        >
                            <x-lucide-chevron-right
                                class="size-4 transition-transform duration-150 rtl:-scale-x-100"
                                aria-hidden="true"
                            />
                        </button>
                    @else
                        <span class="size-5 shrink-0" aria-hidden="true"></span>
                    @endif
                    <span class="truncate">{{ $value }}</span>
                </div>
            @else
                {{ $value }}
            @endif
        </td>
    @endforeach
</tr>

@if ($hasChildren)
    @foreach (array_values($children) as $childIndex => $childRow)
        <x-ui.tree-table-row
            :row="$childRow"
            :columns="$columns"
            :path="$path.'.'.$childIndex"
            :depth="$depth + 1"
        />
    @endforeach
@endif
