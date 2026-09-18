@props([
    'columns' => [],        // [['key'=>'name','label'=>'Name','sortable'=>true,'align'=>'left','class'=>'','width'=>null], ...]
    'rows' => [],           // nested rows (each with `children`), or flat rows with `parentKey` — array | Collection | paginator
    'rowKey' => 'id',       // primary-key path read from each row (data_get: arrays and Eloquent models alike)
    'childrenKey' => 'children', // where a row's children live when the rows are nested (an array, Collection or loaded relation)
    'parentKey' => null,    // set it (e.g. 'parent_id') to pass FLAT rows; the tree is built from it instead of childrenKey
    'treeColumn' => null,   // column key that carries the indent and the expand button (default: the first column)

    // Expansion — client-side, so opening a branch never costs a request.
    'expanded' => [],       // keys of the rows that start open
    'expandAll' => false,   // show every row regardless of state — e.g. while a search is filtering the tree
    'expandedModel' => null, // Livewire array property to keep the open keys in, when the server should know them

    // Reordering — rows move in the browser, then ONE call on drop: {reorderMethod}($parentId, $orderedIds, $movedId).
    'reorderable' => false,
    'reorderMethod' => null, // implies reorderable
    'reparent' => false,    // allow a row to move under a different parent, not just among its siblings

    // Sorting — driven by the host. The header buttons call wire:click="{sortMethod}('key')".
    'sort' => null,
    'direction' => 'asc',
    'sortMethod' => 'sortBy',

    // Row actions, custom cells — the same shape as server-table.
    'actions' => [],
    'actionsView' => null,
    'actionsLabel' => 'Actions',
    'actionsMode' => 'inline',
    'cellViews' => [],

    // Toolbar — search bound to a Livewire property, a page-size select, and a slot for the rest.
    'searchable' => false,
    'searchModel' => 'search',
    'searchPlaceholder' => 'Search...',
    'perPageModel' => 'perPage',
    'perPageOptions' => [],
    'perPageLabel' => 'Rows per page',

    'caption' => null,
    'captionVisible' => false,
    'emptyText' => 'No results.',
    'emptyIcon' => 'search-x',
    'responsive' => 'scroll', // 'scroll' | 'stack' (cards on mobile, table from md:)
    'variant' => 'default',   // 'default' | 'card'
    'paginate' => true,
])

@php
    use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;

    $cols = collect($columns)->map(fn ($c) => [
        'key' => $c['key'] ?? '',
        'label' => $c['label'] ?? \Illuminate\Support\Str::headline($c['key'] ?? ''),
        'sortable' => $c['sortable'] ?? false,
        'align' => $c['align'] ?? 'left',
        'class' => $c['class'] ?? '',
        'width' => $c['width'] ?? null,
    ])->values();
    $treeCol = $treeColumn ?? ($cols[0]['key'] ?? null);

    $isPaginator = $rows instanceof PaginatorContract;
    $list = fn ($v) => $v instanceof PaginatorContract ? $v->items()
        : (is_array($v) ? array_values($v) : (is_object($v) && method_exists($v, 'all') ? array_values($v->all()) : []));
    $items = $list($rows);

    // Flatten to pre-order — a parent, then its whole subtree — which is the order a table draws
    // it in and the order the browser half reasons about. Each entry carries what the markup
    // needs: depth, parent, whether it has children, and its place among its siblings.
    $flat = [];
    $seen = [];
    $walk = function (array $nodes, $parent, int $depth, callable $childrenOf) use (&$walk, &$flat, &$seen, $rowKey) {
        $count = count($nodes);
        foreach ($nodes as $i => $node) {
            $key = (string) data_get($node, $rowKey);
            // A row listed twice, or its own ancestor, would recurse forever; draw it once.
            if (isset($seen[$key])) continue;
            $seen[$key] = true;
            $children = $childrenOf($node);
            $flat[] = [
                'row' => $node, 'key' => $key, 'parent' => $parent, 'depth' => $depth,
                'hasChildren' => count($children) > 0, 'pos' => $i + 1, 'size' => $count,
            ];
            $walk($children, $key, $depth + 1, $childrenOf);
        }
    };

    if ($parentKey !== null) {
        // Flat rows: a row whose parent is not in the set is a root here — which is what a
        // search result or a page of a paginator looks like.
        $keys = [];
        foreach ($items as $r) $keys[(string) data_get($r, $rowKey)] = true;
        $byParent = [];
        foreach ($items as $r) {
            $p = data_get($r, $parentKey);
            $byParent[($p === null || ! isset($keys[(string) $p])) ? '' : (string) $p][] = $r;
        }
        $walk($byParent[''] ?? [], null, 0, fn ($n) => $byParent[(string) data_get($n, $rowKey)] ?? []);
    } else {
        $walk($items, null, 0, fn ($n) => $list(data_get($n, $childrenKey) ?? []));
    }

    $reorderable = $reorderable || $reorderMethod !== null;
    $hasActions = ! empty($actions) || $actionsView !== null;
    $colspan = $cols->count() + ($hasActions ? 1 : 0);
    $stack = $responsive === 'stack';

    $alignClass = fn (string $a) => match ($a) {
        'center' => 'text-center',
        'right', 'end' => 'text-end',
        default => 'text-start',
    };

    $actionArgs = function (array $action, $row) use ($rowKey) {
        $params = $action['params'] ?? [data_get($row, $rowKey)];

        return collect($params)->map(function ($p) {
            if (is_bool($p)) return $p ? 'true' : 'false';
            if (is_int($p) || is_float($p)) return (string) $p;

            return "'".addslashes((string) $p)."'";
        })->implode(', ');
    };
    $actionHref = function (array $action, $row) use ($rowKey) {
        $h = $action['href'] ?? null;
        if ($h instanceof \Closure) return $h($row);
        if (is_string($h)) return str_replace('{id}', (string) data_get($row, $rowKey), $h);

        return null;
    };

    $wrapperClass = match ($variant) {
        'card' => $stack
            ? 'max-md:border-0 max-md:bg-transparent max-md:shadow-none md:bg-card md:rounded-lg md:border md:shadow-xs'
            : 'bg-card rounded-lg border shadow-xs',
        default => $stack ? 'md:rounded-md md:border' : 'rounded-md border',
    };

    $hasToolbar = $searchable || ! empty($perPageOptions) || filled(trim($toolbar ?? ''));

    $labels = [
        'grabbed' => __(':name grabbed, position :position of :count. Use the arrow keys to move it, Space to drop, Escape to cancel.'),
        'moved' => __(':name, position :position of :count, level :level.'),
        'dropped' => __(':name dropped, position :position of :count.'),
        'cancelled' => __('Move cancelled.'),
    ];

    // Expansion lives in a Livewire property when asked to, through the same bridge as every
    // bound control. Its path rides on the root, so a morph that re-points it is followed.
    $rootAttributes = $attributes->merge(array_filter([
        'data-blat-model' => $expandedModel,
        'data-expand-all' => $expandAll ? '1' : '0',
    ], fn ($v) => $v !== null));
@endphp

<div
    data-slot="server-tree-table"
    x-data="blatTreeGrid(@js([
        'expanded' => array_values(array_map('strval', (array) $expanded)),
        'method' => $reorderMethod,
        'reorderable' => $reorderable,
        'reparent' => (bool) $reparent,
        'labels' => $labels,
    ]))"
    {{ $rootAttributes->twMerge('w-full') }}
    {{-- The hint's id comes from Alpine: an id generated per render is a fresh morph key. #27 --}}
    x-id="['tree-hint']"
>
    @if ($hasToolbar)
        <div class="flex flex-wrap items-center gap-2 pb-4">
            @if ($searchable)
                <x-ui.input
                    type="search"
                    wire:model.live.debounce.300ms="{{ $searchModel }}"
                    placeholder="{{ $searchPlaceholder }}"
                    aria-label="{{ $searchPlaceholder }}"
                    class="max-w-xs"
                />
            @endif

            {{ $toolbar ?? '' }}

            @if (! empty($perPageOptions))
                @php
                    $perPage = collect($perPageOptions)->mapWithKeys(fn ($label, $key) => is_int($key) && ! is_array($label)
                        ? [(string) $label => (string) $label]
                        : [(string) $key => (string) $label])->all();
                @endphp
                <div class="ms-auto">
                    <x-ui.select wire:model.live="{{ $perPageModel }}" :options="$perPage" :aria-label="$perPageLabel" size="sm" class="w-auto" />
                </div>
            @endif
        </div>
    @endif

    <div class="{{ $wrapperClass }} {{ $stack ? 'md:overflow-x-auto' : 'relative w-full overflow-x-auto' }}"
        wire:loading.class.delay="opacity-60">
        <table role="treegrid" data-slot="table" class="w-full caption-bottom text-sm {{ $stack ? 'max-md:block' : '' }}"
            @if ($reorderable) :aria-describedby="$id('tree-hint')" @endif>
            @if ($caption)
                <caption class="{{ $captionVisible ? 'text-muted-foreground p-2 text-start text-sm' : 'sr-only' }}">{{ $caption }}</caption>
            @endif

            <thead data-slot="table-header" class="[&_tr]:border-b {{ $stack ? 'max-md:sr-only' : '' }}">
                <tr class="border-b">
                    @foreach ($cols as $col)
                        <th scope="col"
                            @if ($col['sortable']) aria-sort="{{ $sort === $col['key'] ? ($direction === 'asc' ? 'ascending' : 'descending') : 'none' }}" @endif
                            @if ($col['width']) style="width: {{ $col['width'] }}" @endif
                            class="text-foreground h-10 px-2 align-middle font-medium whitespace-nowrap {{ $alignClass($col['align']) }} {{ $col['class'] }}">
                            @if ($col['sortable'])
                                <button type="button" wire:click="{{ $sortMethod }}('{{ $col['key'] }}')"
                                    class="hover:text-foreground focus-visible:border-ring focus-visible:ring-ring/50 -ms-2 inline-flex items-center gap-1 rounded-md px-2 py-1 transition-colors outline-none focus-visible:ring-[3px]">
                                    {{ $col['label'] }}
                                    <span class="text-muted-foreground inline-flex" aria-hidden="true">
                                        @if ($sort === $col['key'])
                                            <x-dynamic-component :component="'lucide-'.($direction === 'asc' ? 'chevron-up' : 'chevron-down')" class="size-3.5" />
                                        @else
                                            <x-lucide-chevrons-up-down class="size-3.5 opacity-50" />
                                        @endif
                                    </span>
                                </button>
                            @else
                                {{ $col['label'] }}
                            @endif
                        </th>
                    @endforeach

                    @if ($hasActions)
                        <th scope="col" class="text-foreground h-10 px-2 text-end align-middle font-medium whitespace-nowrap">
                            <span class="sr-only">{{ $actionsLabel }}</span>
                        </th>
                    @endif
                </tr>
            </thead>

            {{-- Every row is rendered, open or not: expanding is Alpine showing what is already
                 there, so it costs no request and survives any re-render. --}}
            {{-- The drop line is drawn on the cells, because the row's own box-shadow is its focus ring. --}}
            <tbody x-ref="body" data-slot="table-body" @keydown="onKeydown($event)"
                class="{{ $stack ? 'max-md:block md:[&_tr:last-child]:border-0' : '[&_tr:last-child]:border-0' }}">
                @forelse ($flat as $node)
                    @php $row = $node['row']; @endphp
                    <tr
                        wire:key="tree-row-{{ $node['key'] }}"
                        data-slot="server-tree-table-row"
                        data-tree-key="{{ $node['key'] }}"
                        data-tree-parent="{{ $node['parent'] }}"
                        data-tree-depth="{{ $node['depth'] }}"
                        data-tree-children="{{ $node['hasChildren'] ? '1' : '0' }}"
                        style="--depth: {{ $node['depth'] }}"
                        role="row"
                        aria-level="{{ $node['depth'] + 1 }}"
                        aria-posinset="{{ $node['pos'] }}"
                        aria-setsize="{{ $node['size'] }}"
                        :aria-expanded="expandedAttr($el)"
                        :tabindex="tabFor($el)"
                        @focus="focusKey = $el.dataset.treeKey"
                        x-show="shown($el)"
                        @if ($node['depth'] > 0 && ! $expandAll) x-cloak @endif
                        @class([
                            'hover:bg-muted/50 focus-visible:bg-muted/60 outline-none transition-colors',
                            'focus-visible:ring-ring/50 focus-visible:ring-[3px] focus-visible:ring-inset',
                            'data-[dragging]:opacity-50',
                            'data-[drop=before]:[&>td]:shadow-[inset_0_2px_0_0_var(--color-primary)]',
                            'data-[drop=after]:[&>td]:shadow-[inset_0_-2px_0_0_var(--color-primary)]',
                            'data-[drop=inside]:bg-accent data-[drop=inside]:[&>td]:shadow-[inset_0_0_0_1px_var(--color-primary)]',
                            '[&[aria-expanded=true]_[data-slot=server-tree-table-toggle]_svg]:rotate-90 rtl:[&[aria-expanded=true]_[data-slot=server-tree-table-toggle]_svg]:-rotate-90',
                            'max-md:divide-border max-md:mb-3 max-md:ms-[calc(var(--depth)*1rem)] max-md:block max-md:divide-y max-md:rounded-md max-md:border md:border-b' => $stack,
                            'border-b' => ! $stack,
                        ])
                    >
                        @foreach ($cols as $col)
                            @php
                                $value = data_get($row, $col['key']);
                                $isTree = $col['key'] === $treeCol;
                            @endphp
                            <td role="gridcell"
                                @if ($isTree) style="padding-inline-start: calc(0.5rem + var(--depth) * 1.5rem)" @endif
                                @class([
                                    'p-2 align-middle whitespace-nowrap',
                                    $alignClass($col['align']),
                                    $col['class'],
                                    'max-md:flex max-md:items-center max-md:justify-between max-md:gap-4 max-md:whitespace-normal max-md:px-4 max-md:py-2.5 max-md:text-end max-md:ps-4!' => $stack,
                                ])>
                                @if ($stack && ! $isTree)
                                    <span class="text-muted-foreground font-medium md:hidden" aria-hidden="true">{{ $col['label'] }}</span>
                                @endif

                                @if ($isTree)
                                    <div class="flex min-w-0 items-center gap-1">
                                        @if ($reorderable)
                                            <button type="button" tabindex="-1"
                                                data-slot="server-tree-table-handle"
                                                aria-label="{{ __('Drag to reorder') }}"
                                                @pointerdown="onHandleDown($event, @js($node['key']))"
                                                class="text-muted-foreground hover:text-foreground flex size-6 shrink-0 cursor-grab touch-none items-center justify-center rounded active:cursor-grabbing">
                                                <x-lucide-grip-vertical class="size-4" aria-hidden="true" />
                                            </button>
                                        @endif

                                        @if ($node['hasChildren'])
                                            <button type="button" tabindex="-1"
                                                data-slot="server-tree-table-toggle"
                                                @click="toggle(@js($node['key']))"
                                                :aria-label="isOpen(@js($node['key'])) ? @js(__('Collapse')) : @js(__('Expand'))"
                                                class="text-muted-foreground hover:text-foreground flex size-6 shrink-0 cursor-pointer items-center justify-center rounded">
                                                <x-lucide-chevron-right class="size-4 transition-transform duration-150 rtl:-scale-x-100" aria-hidden="true" />
                                            </button>
                                        @else
                                            <span class="size-6 shrink-0" aria-hidden="true"></span>
                                        @endif

                                        <span data-tree-label class="min-w-0 truncate">
                                            @if (isset($cellViews[$col['key']]))
                                                @include($cellViews[$col['key']], ['value' => $value, 'row' => $row, 'depth' => $node['depth']])
                                            @else
                                                {{ $value }}
                                            @endif
                                        </span>
                                    </div>
                                @elseif (isset($cellViews[$col['key']]))
                                    @include($cellViews[$col['key']], ['value' => $value, 'row' => $row, 'depth' => $node['depth']])
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        @endforeach

                        @if ($hasActions)
                            <td role="gridcell" @class([
                                'p-2 align-middle whitespace-nowrap',
                                'max-md:flex max-md:justify-end max-md:px-4 max-md:py-3' => $stack,
                            ])>
                                @if ($actionsView)
                                    @include($actionsView, ['row' => $row, 'depth' => $node['depth']])
                                @elseif ($actionsMode === 'dropdown')
                                    <div class="flex justify-end">
                                        <x-ui.dropdown-menu>
                                            <x-ui.dropdown-menu-trigger>
                                                <x-ui.button variant="ghost" size="icon-xs" aria-label="{{ $actionsLabel }}">
                                                    <x-lucide-ellipsis class="size-4" aria-hidden="true" />
                                                </x-ui.button>
                                            </x-ui.dropdown-menu-trigger>
                                            <x-ui.dropdown-menu-content align="end">
                                                @foreach ($actions as $action)
                                                    @continue (isset($action['visible']) && $action['visible'] instanceof \Closure && ! ($action['visible'])($row))
                                                    @php
                                                        $href = $actionHref($action, $row);
                                                        $variant = in_array($action['variant'] ?? null, ['danger', 'destructive'], true) ? 'destructive' : 'default';
                                                        $wireClick = (! $href && ($action['method'] ?? null)) ? $action['method'].'('.$actionArgs($action, $row).')' : null;
                                                        $wireConfirm = $action['confirm'] ?? null;
                                                    @endphp
                                                    <x-ui.dropdown-menu-item :href="$href" :variant="$variant" :wire:click="$wireClick" :wire:confirm="$wireConfirm">
                                                        @isset($action['icon'])
                                                            <x-dynamic-component :component="'lucide-'.$action['icon']" class="size-4" aria-hidden="true" />
                                                        @endisset
                                                        {{ $action['label'] ?? '' }}
                                                    </x-ui.dropdown-menu-item>
                                                @endforeach
                                            </x-ui.dropdown-menu-content>
                                        </x-ui.dropdown-menu>
                                    </div>
                                @else
                                    <div class="flex items-center justify-end gap-1">
                                        @foreach ($actions as $action)
                                            @continue (isset($action['visible']) && $action['visible'] instanceof \Closure && ! ($action['visible'])($row))
                                            @php
                                                $href = $actionHref($action, $row);
                                                $wireClick = (! $href && ($action['method'] ?? null)) ? $action['method'].'('.$actionArgs($action, $row).')' : null;
                                                $wireConfirm = $action['confirm'] ?? null;
                                            @endphp
                                            <x-ui.button
                                                :href="$href"
                                                :size="$action['size'] ?? 'sm'"
                                                :variant="$action['variant'] ?? 'ghost'"
                                                :color="$action['color'] ?? null"
                                                :class="$action['class'] ?? null"
                                                :wire:click="$wireClick"
                                                :wire:confirm="$wireConfirm"
                                                :aria-label="$action['label'] ?? 'Action'"
                                            >
                                                @isset($action['icon'])
                                                    <x-dynamic-component :component="'lucide-'.$action['icon']" class="size-4" aria-hidden="true" />
                                                @endisset
                                                @unless ($action['iconOnly'] ?? false)
                                                    <span @class(['sr-only sm:not-sr-only' => isset($action['icon'])])>{{ $action['label'] ?? '' }}</span>
                                                @endunless
                                            </x-ui.button>
                                        @endforeach
                                    </div>
                                @endif
                            </td>
                        @endif
                    </tr>
                @empty
                    <tr class="{{ $stack ? 'max-md:block' : '' }}">
                        <td colspan="{{ $colspan }}" class="h-24 text-center align-middle {{ $stack ? 'max-md:block' : '' }}">
                            <div class="text-muted-foreground flex flex-col items-center justify-center gap-2 py-6">
                                <x-dynamic-component :component="'lucide-'.$emptyIcon" class="size-6 opacity-60" aria-hidden="true" />
                                <span>{{ $emptyText }}</span>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if ($reorderable)
        <p class="sr-only" :id="$id('tree-hint')">{{ __('To move a row, focus it and press Space, move it with the arrow keys, then press Space again to drop it or Escape to cancel.') }}</p>
        {{-- What a screen reader hears while a row is moved with the keyboard. --}}
        <p class="sr-only" aria-live="assertive" x-text="announcement"></p>
    @endif

    @if ($isPaginator && $paginate && $rows->hasPages())
        <div class="pt-4">
            {{ $rows->links() }}
        </div>
    @endif
</div>
