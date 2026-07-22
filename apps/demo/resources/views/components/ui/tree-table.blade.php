@props([
    'columns' => [],   // [['key' => 'name', 'label' => 'Name', 'align' => ?'left|center|right'], ...]
    'rows' => [],       // [['name' => '...', 'size' => '...', 'children' => [...]], ...] each child has the same shape
    'copyable' => false, // show a button that copies the tree as a markdown ├──/└──/│ structure
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

    // Render the hierarchy as a markdown tree (├──/└──/│), built from the row data — the
    // first column's key supplies each label. Branches get a trailing slash, folder-style.
    $treeKey = $columns[0]['key'] ?? 'name';
    $buildMarkdown = function (array $rows, string $prefix, callable $self, bool $isRoot = false) use ($treeKey) {
        $rows = array_values($rows);
        $last = count($rows) - 1;
        $out = '';
        foreach ($rows as $i => $row) {
            $isLast = $i === $last;
            $children = $row['children'] ?? [];
            $hasChildren = is_array($children) && count($children) > 0;
            $name = (string) ($row[$treeKey] ?? '');
            if ($hasChildren) {
                $name = rtrim($name, '/').'/';
            }
            if ($isRoot) {
                // Top-level rows are the roots: render flush, no connector.
                $out .= $name."\n";
                if ($hasChildren) {
                    $out .= $self($children, '', $self);
                }
            } else {
                $out .= $prefix.($isLast ? '└── ' : '├── ').$name."\n";
                if ($hasChildren) {
                    $out .= $self($children, $prefix.($isLast ? '    ' : '│   '), $self);
                }
            }
        }
        return $out;
    };
    $markdown = $copyable ? $buildMarkdown($rows, '', $buildMarkdown, true) : '';

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
        markdown: @js($markdown),
        copied: false,
        copyTree() {
            navigator.clipboard.writeText(this.markdown);
            this.copied = true;
            setTimeout(() => this.copied = false, 1500);
        },
    }"
    {{ $attributes->twMerge('w-full overflow-x-auto rounded-lg border') }}
>
    @if ($copyable)
        <div class="flex justify-end border-b px-2 py-1.5">
            <x-ui.button type="button" variant="ghost" size="sm" class="gap-1.5" @click="copyTree()" aria-label="Copy tree as markdown">
                <x-lucide-copy class="size-3.5" x-show="!copied" />
                <x-lucide-check class="size-3.5 text-emerald-500" x-show="copied" x-cloak />
                <span x-text="copied ? 'Copied' : 'Copy tree'"></span>
            </x-ui.button>
        </div>
    @endif

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
