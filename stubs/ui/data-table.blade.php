@props([
    'columns' => [],      // [['key'=>'name','label'=>'Name','sortable'=>true,'class'=>''], ...]
    'rows' => [],         // [['name'=>'…','email'=>'…'], ...]
    'searchable' => true,
    'searchKey' => null,  // column key to search; defaults to all column keys
    'searchPlaceholder' => 'Search...',
    'selectable' => true,
    'pageSize' => 5,
])

@php
    $cols = collect($columns)->map(fn ($c) => [
        'key' => $c['key'] ?? '',
        'label' => $c['label'] ?? ucfirst($c['key'] ?? ''),
        'sortable' => $c['sortable'] ?? true,
        'class' => $c['class'] ?? '',
    ])->values();
    $searchKeys = $searchKey ? [$searchKey] : $cols->pluck('key')->all();
@endphp

<div
    data-slot="data-table"
    x-data="{
        q: '',
        sortKey: null,
        sortDir: 'asc',
        page: 1,
        pageSize: @js((int) $pageSize),
        rows: @js(array_values($rows)),
        searchKeys: @js($searchKeys),
        selected: [],
        get filtered() {
            const rows = this.rows.map((r, i) => ({ r, i }));
            if (!this.q) return rows;
            const q = this.q.toLowerCase();
            return rows.filter(({ r }) => this.searchKeys.some(k => String(r[k] ?? '').toLowerCase().includes(q)));
        },
        get sorted() {
            const arr = [...this.filtered];
            if (this.sortKey) {
                arr.sort((a, b) => {
                    let x = a.r[this.sortKey] ?? '', y = b.r[this.sortKey] ?? '';
                    const num = x !== '' && y !== '' && !isNaN(parseFloat(x)) && !isNaN(parseFloat(y));
                    const c = num ? parseFloat(x) - parseFloat(y) : String(x).localeCompare(String(y));
                    return this.sortDir === 'asc' ? c : -c;
                });
            }
            return arr;
        },
        get pageCount() { return Math.max(1, Math.ceil(this.sorted.length / this.pageSize)) },
        get paged() { const s = (this.page - 1) * this.pageSize; return this.sorted.slice(s, s + this.pageSize) },
        get pageIndices() { return this.paged.map(p => p.i) },
        get allPageSelected() { const idx = this.pageIndices; return idx.length > 0 && idx.every(i => this.selected.includes(i)) },
        toggleSort(key) { this.sortKey === key ? (this.sortDir = this.sortDir === 'asc' ? 'desc' : 'asc') : (this.sortKey = key, this.sortDir = 'asc'); this.page = 1 },
        toggleRow(i) { this.selected.includes(i) ? this.selected = this.selected.filter(x => x !== i) : this.selected.push(i) },
        toggleAll() { const idx = this.pageIndices; this.allPageSelected ? this.selected = this.selected.filter(i => !idx.includes(i)) : idx.forEach(i => this.selected.includes(i) || this.selected.push(i)) },
        next() { if (this.page < this.pageCount) this.page++ },
        prev() { if (this.page > 1) this.page-- },
    }"
    x-init="$watch('q', () => page = 1)"
    {{ $attributes->twMerge('w-full') }}
>
    @if ($searchable)
        <div class="flex items-center gap-2 pb-4">
            <x-ui.input type="text" x-model="q" placeholder="{{ $searchPlaceholder }}" class="max-w-xs" />
        </div>
    @endif

    <div class="relative w-full overflow-x-auto rounded-md border">
        <table data-slot="table" class="w-full caption-bottom text-sm">
            <thead data-slot="table-header" class="[&_tr]:border-b">
                <tr class="hover:bg-muted/50 border-b transition-colors">
                    @if ($selectable)
                        <th class="h-10 w-10 px-2 text-left align-middle">
                            <span class="sr-only">Select</span>
                            <button type="button" role="checkbox" aria-label="Select all rows" @click="toggleAll()" :aria-checked="allPageSelected" :data-state="allPageSelected ? 'checked' : 'unchecked'"
                                class="border-input data-[state=checked]:bg-primary data-[state=checked]:border-primary data-[state=checked]:text-primary-foreground flex size-4 items-center justify-center rounded-[4px] border shadow-xs outline-none">
                                <x-lucide-check class="size-3.5" x-show="allPageSelected" x-cloak />
                            </button>
                        </th>
                    @endif
                    @foreach ($cols as $col)
                        <th class="text-foreground h-10 px-2 text-left align-middle font-medium whitespace-nowrap {{ $col['class'] }}">
                            @if ($col['sortable'])
                                <button type="button" @click="toggleSort('{{ $col['key'] }}')" class="hover:text-foreground -ml-2 inline-flex items-center gap-1 rounded-md px-2 py-1 transition-colors">
                                    {{ $col['label'] }}
                                    <span class="text-muted-foreground inline-flex">
                                        <span x-show="sortKey === '{{ $col['key'] }}' && sortDir === 'asc'" x-cloak><x-lucide-chevron-up class="size-3.5" /></span>
                                        <span x-show="sortKey === '{{ $col['key'] }}' && sortDir === 'desc'" x-cloak><x-lucide-chevron-down class="size-3.5" /></span>
                                        <span x-show="sortKey !== '{{ $col['key'] }}'"><x-lucide-chevrons-up-down class="size-3.5 opacity-50" /></span>
                                    </span>
                                </button>
                            @else
                                {{ $col['label'] }}
                            @endif
                        </th>
                    @endforeach
                </tr>
            </thead>
            <tbody data-slot="table-body" class="[&_tr:last-child]:border-0">
                <template x-for="item in paged" :key="item.i">
                    <tr class="hover:bg-muted/50 data-[state=selected]:bg-muted border-b transition-colors" :data-state="selected.includes(item.i) ? 'selected' : null">
                        @if ($selectable)
                            <td class="w-10 px-2 align-middle">
                                <button type="button" role="checkbox" aria-label="Select row" @click="toggleRow(item.i)" :aria-checked="selected.includes(item.i)" :data-state="selected.includes(item.i) ? 'checked' : 'unchecked'"
                                    class="border-input data-[state=checked]:bg-primary data-[state=checked]:border-primary data-[state=checked]:text-primary-foreground flex size-4 items-center justify-center rounded-[4px] border shadow-xs outline-none">
                                    <x-lucide-check class="size-3.5" x-show="selected.includes(item.i)" x-cloak />
                                </button>
                            </td>
                        @endif
                        @foreach ($cols as $col)
                            <td class="p-2 align-middle whitespace-nowrap {{ $col['class'] }}" x-text="item.r['{{ $col['key'] }}']"></td>
                        @endforeach
                    </tr>
                </template>
                <tr x-show="paged.length === 0">
                    <td colspan="{{ $cols->count() + ($selectable ? 1 : 0) }}" class="text-muted-foreground h-24 text-center align-middle">No results.</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="flex items-center justify-between gap-4 pt-4">
        <p class="text-muted-foreground text-sm">
            @if ($selectable)
                <span x-text="selected.length"></span> of <span x-text="rows.length"></span> row(s) selected.
            @else
                <span x-text="sorted.length"></span> result(s).
            @endif
        </p>
        <div class="flex items-center gap-2">
            <span class="text-sm font-medium">Page <span x-text="page"></span> of <span x-text="pageCount"></span></span>
            <x-ui.button variant="outline" size="sm" x-bind:disabled="page === 1" @click="prev()">Previous</x-ui.button>
            <x-ui.button variant="outline" size="sm" x-bind:disabled="page === pageCount" @click="next()">Next</x-ui.button>
        </div>
    </div>
</div>
