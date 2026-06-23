{{--
    docs/api-table — a Prop/Type/Default/Description table. Used for both the top-level
    props list and each nested shape's fields. `rows` is a list of prop descriptors;
    `shapes` is passed through only to resolve a row's `shape` cross-reference link.
--}}
@props(['rows' => [], 'shapes' => []])

<div class="overflow-x-auto rounded-lg border">
    <table class="w-full min-w-[36rem] text-left text-sm">
        <thead class="bg-muted/50 text-muted-foreground">
            <tr class="[&>th]:px-4 [&>th]:py-2.5 [&>th]:font-medium">
                <th class="w-40">Prop</th>
                <th class="w-32">Type</th>
                <th class="w-28">Default</th>
                <th>Description</th>
            </tr>
        </thead>
        <tbody class="[&>tr]:border-t [&>tr>td]:px-4 [&>tr>td]:py-3 [&>tr>td]:align-top">
            @foreach ($rows as $row)
                <tr>
                    <td class="whitespace-nowrap">
                        <code class="text-foreground font-mono text-xs font-medium">{{ $row['name'] ?? '' }}</code>@if ($row['required'] ?? false)<span class="text-destructive" title="Required">*</span>@endif
                    </td>
                    <td>
                        <code class="text-muted-foreground font-mono text-xs">{{ $row['type'] ?? 'mixed' }}</code>
                    </td>
                    <td>
                        @if (array_key_exists('default', $row) && $row['default'] !== null)
                            <code class="text-muted-foreground font-mono text-xs">{{ $row['default'] }}</code>
                        @else
                            <span class="text-muted-foreground/60">&mdash;</span>
                        @endif
                    </td>
                    <td class="text-muted-foreground max-w-prose">
                        @if (! empty($row['description']))
                            <span>{{ $row['description'] }}</span>
                        @endif

                        @if (! empty($row['options']))
                            <div class="mt-1.5 flex flex-wrap gap-1">
                                @foreach ($row['options'] as $opt)
                                    <code class="bg-muted text-foreground/80 rounded px-1.5 py-0.5 font-mono text-[0.7rem]">{{ $opt }}</code>
                                @endforeach
                            </div>
                        @endif

                        @if (! empty($row['shape']) && isset($shapes[$row['shape']]))
                            <span class="mt-1.5 block text-xs">
                                See <a href="#shape-{{ $row['shape'] }}" class="text-foreground underline underline-offset-2">{{ $shapes[$row['shape']]['label'] ?? \Illuminate\Support\Str::headline($row['shape']) }}</a> below.
                            </span>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
