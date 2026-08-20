@props([
    'columns' => [],        // [['key'=>'name','label'=>'Name','sortable'=>true,'align'=>'left','class'=>'','width'=>null], ...]
    'rows' => [],           // array | Collection | LengthAwarePaginator — rendered server-side (real @foreach)
    'rowKey' => 'id',       // primary-key path read from each row (data_get: works with arrays and Eloquent models)

    // Sorting — driven by the host (Livewire). The header buttons call wire:click="{sortMethod}('key')".
    'sort' => null,         // current sort key (for aria-sort + active header state)
    'direction' => 'asc',   // 'asc' | 'desc'
    'sortMethod' => 'sortBy',

    // Row actions — declarative. Each action renders a button per row with a native wire:click
    // carrying the real primary key, e.g. wire:click="edit(5)". See the shape in docs-api/server-table.php.
    'actions' => [],
    'actionsView' => null,  // escape hatch: a Blade view included per row with $row in scope (fully custom markup)
    'actionsLabel' => 'Actions',
    'actionsMode' => 'inline', // 'inline' (buttons) | 'dropdown' (overflow menu)
    'stickyActions' => false,  // freeze the actions column to the right edge during horizontal scroll

    // Custom cell rendering: map of column key => Blade view, included with $value and $row in scope.
    'cellViews' => [],

    // Selection — checkboxes bound to a Livewire array property via wire:model.
    'selectable' => false,
    'selectModel' => 'selected',

    // Search — an input above the table bound to a Livewire property.
    'searchable' => false,
    'searchModel' => 'search',
    'searchPlaceholder' => 'Search...',

    // Page size — a select in the toolbar bound to a Livewire property. Reset the paginator in
    // the host when it changes (updatedPerPage() => $this->resetPage()), or page 5 of 10-per-page
    // can land you past the end of the same result set at 50.
    'perPageModel' => 'perPage',
    'perPageOptions' => [],     // e.g. [10, 25, 50] or [10 => '10 per page', ...]. Empty = no select.
    'perPageLabel' => 'Rows per page',

    // Column visibility — a dropdown of checkboxes in the toolbar. Server-side, like everything
    // else here: hidden columns are not rendered at all, so their cells are never built and never
    // cross the wire. Same shape as sort/direction/sortMethod — the host owns the state and the
    // component reports the toggle back to it.
    'toggleableColumns' => false,
    'visibleColumns' => null,   // array of visible column keys; null = every column is visible
    'toggleColumnMethod' => 'toggleColumn',
    'columnsLabel' => 'Columns',

    'caption' => null,          // accessible table caption
    'captionVisible' => false,  // show the caption above the table (default: sr-only)
    'emptyText' => 'No results.',
    'emptyIcon' => 'search-x',
    'responsive' => 'scroll',   // 'scroll' (horizontal scroll) | 'stack' (cards on mobile, table from md:)
    'variant' => 'default',     // 'default' | 'card'
    'paginate' => true,         // when rows is a paginator, render its links below the table
])

@php
    use Illuminate\Contracts\Pagination\Paginator as PaginatorContract;

    $allCols = collect($columns)->map(fn ($c) => [
        'key' => $c['key'] ?? '',
        'label' => $c['label'] ?? \Illuminate\Support\Str::headline($c['key'] ?? ''),
        'sortable' => $c['sortable'] ?? false,
        'align' => $c['align'] ?? 'left',
        'class' => $c['class'] ?? '',
        'width' => $c['width'] ?? null,
        'hideable' => $c['hideable'] ?? true,
    ])->values();

    // null means "not being controlled", which is not the same as "none visible" — an empty array
    // is a legitimate state the host can arrive at by unchecking everything, and it has to survive
    // a round trip rather than snapping back to all-visible.
    $cols = $visibleColumns === null
        ? $allCols
        : $allCols->filter(fn ($c) => ! $c['hideable'] || in_array($c['key'], $visibleColumns, true))->values();

    $isPaginator = $rows instanceof PaginatorContract;
    $items = $isPaginator ? $rows->items() : (is_array($rows) ? $rows : (is_object($rows) && method_exists($rows, 'all') ? $rows->all() : (array) $rows));

    $hasActions = ! empty($actions) || $actionsView !== null;
    $colspan = $cols->count() + ($selectable ? 1 : 0) + ($hasActions ? 1 : 0);

    $alignClass = fn (string $a) => match ($a) {
        'center' => 'text-center',
        'right', 'end' => 'text-end',
        default => 'text-start',
    };

    // Build the wire:click argument list for an action on a given row. Numeric keys stay bare
    // (edit(5)); strings/uuids are quoted (edit('9f3…')). `params` overrides the default [rowKey].
    $actionArgs = function (array $action, $row) use ($rowKey) {
        $params = $action['params'] ?? [data_get($row, $rowKey)];

        return collect($params)->map(function ($p) {
            if (is_bool($p)) return $p ? 'true' : 'false';
            if (is_int($p) || is_float($p) || (is_numeric($p) && ! is_string($p))) return (string) $p;

            return "'".addslashes((string) $p)."'";
        })->implode(', ');
    };

    // Resolve an action href — a plain string ({id} is substituted) or a closure fn ($row) => url.
    $actionHref = function (array $action, $row) use ($rowKey) {
        $h = $action['href'] ?? null;
        if ($h instanceof \Closure) return $h($row);
        if (is_string($h)) return str_replace('{id}', (string) data_get($row, $rowKey), $h);

        return null;
    };

    $stack = $responsive === 'stack';

    // A card wrapper AROUND rows that are themselves cards below md is a card in a card: two
    // borders, two radii, two surfaces. In stack mode the row is the card, so the wrapper stands
    // down until the real table appears at md.
    $wrapperClass = match ($variant) {
        'card' => $stack
            ? 'max-md:border-0 max-md:bg-transparent max-md:shadow-none md:bg-card md:rounded-lg md:border md:shadow-xs'
            : 'bg-card rounded-lg border shadow-xs',
        default => $stack ? 'md:rounded-md md:border' : 'rounded-md border',
    };

    $hasToolbar = $searchable || ! empty($perPageOptions) || $toggleableColumns || filled(trim($toolbar ?? ''));
@endphp

<div
    data-slot="server-table"
    @if ($selectable)
        x-data="{
            toggleAll(checked) {
                this.$root.querySelectorAll('tbody input[type=checkbox][data-row-select]').forEach(c => {
                    if (c.checked !== checked) { c.checked = checked; c.dispatchEvent(new Event('change', { bubbles: true })); }
                });
            },
        }"
    @endif
    {{ $attributes->twMerge('w-full') }}
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

            {{-- Whatever the host needs that no prop will ever cover: a status filter, a date
                 range, a bulk-action button. Sits after the search box and before the built-ins,
                 and is the reason per-page/columns are conveniences rather than the only way in. --}}
            {{ $toolbar ?? '' }}

            @if (! empty($perPageOptions) || $toggleableColumns)
                <div class="ms-auto flex items-center gap-2">
                    @if (! empty($perPageOptions))
                        @php
                            // [10, 25, 50] and [10 => '10 per page'] both work: a list gets its
                            // labels from its values, a map keeps the ones it was given.
                            $perPage = collect($perPageOptions)->mapWithKeys(fn ($label, $key) => is_int($key) && ! is_array($label)
                                ? [(string) $label => (string) $label]
                                : [(string) $key => (string) $label])->all();
                        @endphp
                        <x-ui.select
                            wire:model.live="{{ $perPageModel }}"
                            :options="$perPage"
                            :aria-label="$perPageLabel"
                            size="sm"
                            class="w-auto"
                        />
                    @endif

                    @if ($toggleableColumns)
                        <x-ui.dropdown-menu>
                            <x-ui.dropdown-menu-trigger>
                                <x-ui.button variant="outline" size="sm">
                                    <x-lucide-columns-3 class="size-4" aria-hidden="true" />
                                    <span class="max-sm:sr-only">{{ $columnsLabel }}</span>
                                    <x-lucide-chevron-down class="size-4 opacity-50" aria-hidden="true" />
                                </x-ui.button>
                            </x-ui.dropdown-menu-trigger>
                            <x-ui.dropdown-menu-content align="end" class="w-56">
                                @foreach ($allCols as $col)
                                    @continue (! $col['hideable'])
                                    @php $isVisible = $visibleColumns === null || in_array($col['key'], $visibleColumns, true); @endphp
                                    {{-- The check mark is Alpine state seeded once from the server. Livewire's
                                         morph would leave that state behind on a node it decides to keep, so the
                                         key carries the value and the item is replaced when it changes. --}}
                                    <x-ui.dropdown-menu-checkbox-item
                                        wire:key="col-{{ $col['key'] }}-{{ $isVisible ? 1 : 0 }}"
                                        :checked="$isVisible"
                                        wire:click="{{ $toggleColumnMethod }}('{{ $col['key'] }}')"
                                    >{{ $col['label'] }}</x-ui.dropdown-menu-checkbox-item>
                                @endforeach
                            </x-ui.dropdown-menu-content>
                        </x-ui.dropdown-menu>
                    @endif
                </div>
            @endif
        </div>
    @endif

    <div class="{{ $wrapperClass }} {{ $stack ? 'md:overflow-x-auto' : 'relative w-full overflow-x-auto' }}"
        wire:loading.class.delay="opacity-60">
        <table data-slot="table" class="w-full caption-bottom text-sm {{ $stack ? 'max-md:block' : '' }}">
            @if ($caption)
                <caption class="{{ $captionVisible ? 'text-muted-foreground p-2 text-start text-sm' : 'sr-only' }}">{{ $caption }}</caption>
            @endif

            <thead data-slot="table-header" class="[&_tr]:border-b {{ $stack ? 'max-md:sr-only' : '' }}">
                <tr class="hover:bg-muted/50 border-b transition-colors">
                    @if ($selectable)
                        <th scope="col" class="h-10 w-10 px-2 text-start align-middle">
                            <span class="sr-only">Select</span>
                            <input type="checkbox" aria-label="Select all rows on this page"
                                @change="toggleAll($event.target.checked)"
                                class="border-input text-primary focus-visible:ring-ring/50 size-4 rounded-[4px] border shadow-xs outline-none focus-visible:ring-[3px]" />
                        </th>
                    @endif

                    @foreach ($cols as $col)
                        <th scope="col"
                            @if ($col['sortable']) aria-sort="{{ $sort === $col['key'] ? ($direction === 'asc' ? 'ascending' : 'descending') : 'none' }}" @endif
                            @if ($col['width']) style="width: {{ $col['width'] }}" @endif
                            class="text-foreground h-10 px-2 align-middle font-medium whitespace-nowrap {{ $alignClass($col['align']) }} {{ $col['class'] }}">
                            @if ($col['sortable'])
                                <button type="button" wire:click="{{ $sortMethod }}('{{ $col['key'] }}')"
                                    class="hover:text-foreground focus-visible:border-ring focus-visible:ring-ring/50 -ms-2 inline-flex items-center gap-1 rounded-md px-2 py-1 transition-colors outline-none focus-visible:ring-[3px] {{ $col['align'] === 'right' ? 'flex-row-reverse' : '' }}">
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
                        <th scope="col" @class([
                            'text-foreground bg-background h-10 px-2 text-end align-middle font-medium whitespace-nowrap',
                            'sticky end-0 border-s' => $stickyActions,
                        ])>
                            <span class="sr-only">{{ $actionsLabel }}</span>
                        </th>
                    @endif
                </tr>
            </thead>

            {{-- Dropping the last row's border is a real-table nicety; below md every row is a
                 separate card and the last one needs its border like the others. --}}
            <tbody data-slot="table-body" class="{{ $stack ? 'max-md:block md:[&_tr:last-child]:border-0' : '[&_tr:last-child]:border-0' }}">
                @forelse ($items as $row)
                    <tr wire:key="row-{{ data_get($row, $rowKey) }}"
                        class="hover:bg-muted/50 data-[state=selected]:bg-muted transition-colors {{ $stack ? 'max-md:divide-border max-md:mb-3 max-md:block max-md:divide-y max-md:rounded-md max-md:border md:border-b' : 'border-b' }}">
                        @if ($selectable)
                            <td class="w-10 px-2 align-middle {{ $stack ? 'max-md:flex max-md:justify-end max-md:p-2' : '' }}">
                                <input type="checkbox" data-row-select
                                    wire:model.live="{{ $selectModel }}"
                                    value="{{ data_get($row, $rowKey) }}"
                                    aria-label="Select row"
                                    class="border-input text-primary focus-visible:ring-ring/50 size-4 rounded-[4px] border shadow-xs outline-none focus-visible:ring-[3px]" />
                            </td>
                        @endif

                        @foreach ($cols as $col)
                            @php $value = data_get($row, $col['key']); @endphp
                            <td @class([
                                'p-2 align-middle whitespace-nowrap',
                                $alignClass($col['align']),
                                $col['class'],
                                'max-md:flex max-md:items-center max-md:justify-between max-md:gap-4 max-md:whitespace-normal max-md:px-4 max-md:py-2.5 max-md:text-end' => $stack,
                            ])>
                                @if ($stack)
                                    <span class="text-muted-foreground font-medium md:hidden" aria-hidden="true">{{ $col['label'] }}</span>
                                @endif
                                @if (isset($cellViews[$col['key']]))
                                    @include($cellViews[$col['key']], ['value' => $value, 'row' => $row])
                                @else
                                    {{ $value }}
                                @endif
                            </td>
                        @endforeach

                        @if ($hasActions)
                            <td @class([
                                'bg-background p-2 align-middle whitespace-nowrap',
                                'sticky end-0 border-s' => $stickyActions,
                                'max-md:flex max-md:justify-end max-md:px-4 max-md:py-3' => $stack,
                            ])>
                                @if ($actionsView)
                                    @include($actionsView, ['row' => $row])
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
                                                        $variant = (($action['variant'] ?? null) === 'danger' || ($action['variant'] ?? null) === 'destructive') ? 'destructive' : 'default';
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

    @if ($isPaginator && $paginate && $rows->hasPages())
        <div class="pt-4">
            {{ $rows->links() }}
        </div>
    @endif
</div>
