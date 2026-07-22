@props([
    'items' => [],   // [['label' => string, 'icon' => ?lucideName, 'children' => ?array, 'expanded' => ?bool], ...]
])

{{--
    Collapsible, data-driven hierarchical tree.
    The tree is server-rendered recursively (each node is an <x-ui.tree-node>
    that renders its own children). Expand/collapse is per-node Alpine state
    seeded from item.expanded, toggled via x-show. Roving tabindex + arrow keys
    provide keyboard navigation across visible rows.
--}}
<ul
    data-slot="tree"
    role="tree"
    aria-label="{{ $attributes->get('aria-label', 'Tree') }}"
    x-data="{
        focusables() {
            return [...$el.querySelectorAll('[role=treeitem]')].filter(el => el.offsetParent !== null);
        },
        move(current, dir) {
            const items = this.focusables();
            const i = items.indexOf(current);
            if (i === -1) return;
            const next = items[Math.min(items.length - 1, Math.max(0, i + dir))];
            if (next) { items.forEach(el => el.tabIndex = -1); next.tabIndex = 0; next.focus(); }
        },
    }"
    @keydown.down.prevent="move($event.target, 1)"
    @keydown.up.prevent="move($event.target, -1)"
    {{ $attributes->except('aria-label')->twMerge('text-foreground select-none') }}
>
    @foreach ($items as $loopIndex => $item)
        <x-ui.tree-node :item="$item" :level="1" :first="$loopIndex === array_key_first($items)" />
    @endforeach
</ul>
