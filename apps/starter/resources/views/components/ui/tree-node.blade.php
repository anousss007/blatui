@props([
    'item' => [],    // ['label' => string, 'icon' => ?lucideName, 'children' => ?array, 'expanded' => ?bool]
    'level' => 1,    // 1-based aria-level / indent depth
    'first' => false, // the very first row of the whole tree gets tabindex=0 (roving entry point)
])

@php
    $label = $item['label'] ?? '';
    $icon = $item['icon'] ?? null;
    $children = $item['children'] ?? [];
    $hasChildren = is_array($children) && count($children) > 0;
    $expanded = (bool) ($item['expanded'] ?? false);
    // Indent is logical (padding-inline-start) so it flips automatically under RTL.
    $indent = $level * 0.75; // rem
@endphp

{{--
    Each node is a single <li role="treeitem"> holding its Alpine `open` state.
    The clickable row and (for parents) the nested role="group" both live inside
    this <li> so the child group can read the parent's `open` via Alpine scope.
--}}
<li
    role="treeitem"
    aria-level="{{ $level }}"
    aria-label="{{ $label }}"
    @if ($hasChildren) :aria-expanded="open ? 'true' : 'false'" @endif
    tabindex="{{ $first ? '0' : '-1' }}"
    x-data="{ open: @js($hasChildren ? $expanded : false) }"
    @keydown.enter.stop.prevent="{{ $hasChildren ? 'open = !open' : '' }}"
    @keydown.space.stop.prevent="{{ $hasChildren ? 'open = !open' : '' }}"
    @keydown.right.stop.prevent="{{ $hasChildren ? 'open = true' : '' }}"
    @keydown.left.stop.prevent="{{ $hasChildren ? 'open = false' : '' }}"
    class="focus-visible:ring-ring rounded outline-none focus-visible:ring-2"
>
    <div
        @class([
            'hover:bg-accent hover:text-accent-foreground flex cursor-pointer items-center gap-1.5 rounded px-2 py-1 text-sm',
        ])
        style="padding-inline-start: {{ $indent }}rem;"
        @if ($hasChildren) @click="open = !open" @endif
    >
        @if ($hasChildren)
            <span class="text-muted-foreground -ms-1 flex size-4 shrink-0 items-center justify-center">
                <x-lucide-chevron-right class="size-3.5 transition-transform duration-150 rtl:-scale-x-100" x-bind:class="open && 'rotate-90'" aria-hidden="true" />
            </span>
        @else
            <span class="size-4 shrink-0"></span>
        @endif

        @if ($hasChildren)
            <x-lucide-folder x-show="!open" class="text-muted-foreground size-4 shrink-0" aria-hidden="true" />
            <x-lucide-folder-open x-show="open" x-cloak class="text-muted-foreground size-4 shrink-0" aria-hidden="true" />
        @elseif ($icon)
            <x-dynamic-component :component="'lucide-'.$icon" class="text-muted-foreground size-4 shrink-0" aria-hidden="true" />
        @endif

        <span class="truncate">{{ $label }}</span>
    </div>

    @if ($hasChildren)
        <ul role="group" x-show="open" x-cloak class="list-none">
            @foreach ($children as $child)
                <x-ui.tree-node :item="$child" :level="$level + 1" />
            @endforeach
        </ul>
    @endif
</li>
