@props([
    'columns' => [],   // [['key' => 'name', 'label' => 'Name', 'align' => ?'left|center|right'], ...]
    'rows' => [],       // [['name' => '...', 'size' => '...', 'children' => [...]], ...] each child has the same shape
])

@php
    $columns = array_values($columns);

    // Collect the path-ids of every parent branch that should start open.
    // A branch is pre-expanded when its row data carries 'expanded' => true.
    $collectOpen = function (array $rows, string $prefix, callable $self) {
        $ids = [];
        foreach (array_values($rows) as $i => $row) {
            $path = $prefix === '' ? (string) $i : "{$prefix}.{$i}";
            $children = $row['children'] ?? [];
            $hasChildren = is_array($children) && count($children) > 0;
            if ($hasChildren) {
                if (! empty($row['expanded'])) {
                    $ids[] = $path;
                }
                $ids = array_merge($ids, $self($children, $path, $self));
            }
        }
        return $ids;
    };
    $openIds = $collectOpen($rows, '', $collectOpen);

    $alignClass = fn ($align) => match ($align) {
        'right' => 'text-right',
        'center' => 'text-center',
        default => 'text-left',
    };
@endphp

{{--
    One table-level Alpine scope holds an `expanded` map keyed by a row's
    dotted path-id (e.g. "0", "0.1", "0.1.2"). A row is visible only when every
    ancestor path is expanded — computed from the path alone, so no per-row wiring.
    The recursive partial <x-ui.tree-table-row> re-includes itself for children.
--}}
<div
    data-slot="tree-table"
    x-data="{
        expanded: @js(array_fill_keys($openIds, true)),
        toggle(id) { this.expanded[id] = ! this.expanded[id]; },
        isOpen(id) { return !! this.expanded[id]; },
        isVisible(path) {
            const parts = String(path).split('.');
            // Walk every strict ancestor; the row shows only if all are open.
            for (let i = 1; i < parts.length; i++) {
                if (! this.expanded[parts.slice(0, i).join('.')]) return false;
            }
            return true;
        },
    }"
    {{ $attributes->twMerge('w-full overflow-x-auto rounded-lg border') }}
>
    <table class="w-full caption-bottom text-sm">
        <thead>
            <tr class="bg-muted/40 border-b">
                @foreach ($columns as $i => $col)
                    <th
                        scope="col"
                        @class([
                            'text-muted-foreground px-4 py-3 font-medium',
                            $alignClass($col['align'] ?? null),
                        ])
                    >{{ $col['label'] ?? '' }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach (array_values($rows) as $i => $row)
                <x-ui.tree-table-row
                    :row="$row"
                    :columns="$columns"
                    :path="(string) $i"
                    :depth="0"
                />
            @endforeach
        </tbody>
    </table>
</div>
