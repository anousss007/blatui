{{--
    Recursive org-chart node partial. Rendered by org-chart.blade.php and by itself.

    $node = ['name' => string, 'title' => ?string, 'avatar' => ?url, 'children' => ?array]

    Each node is a single <li> containing a centered card; if it has children they are
    rendered as a nested <ul> of <li>s (this same partial, @included recursively). The
    raw ul/li nesting is what the scoped connector CSS in org-chart.blade.php hooks into,
    so the recursion intentionally uses @include rather than a wrapping Blade component.
--}}
@php
    $name = $node['name'] ?? '';
    $title = $node['title'] ?? null;
    $avatar = $node['avatar'] ?? null;
    $children = $node['children'] ?? [];
    $hasChildren = is_array($children) && count($children) > 0;

    // Initials fallback when no avatar image is supplied.
    $initials = collect(preg_split('/\s+/', trim((string) $name)))
        ->filter()
        ->take(2)
        ->map(fn ($word) => mb_strtoupper(mb_substr($word, 0, 1)))
        ->implode('');
@endphp

<li>
    <div class="bg-card text-card-foreground node relative z-10 flex w-44 flex-col items-center gap-2 rounded-xl border p-4 text-center shadow-sm">
        <span class="bg-muted relative flex size-12 shrink-0 items-center justify-center overflow-hidden rounded-full">
            @if ($avatar)
                <img src="{{ $avatar }}" alt="" class="size-full object-cover" />
            @else
                <span class="text-muted-foreground text-sm font-medium" aria-hidden="true">{{ $initials }}</span>
            @endif
        </span>

        <span class="text-foreground text-sm leading-tight font-semibold">{{ $name }}</span>

        @if ($title)
            <span class="text-muted-foreground text-xs leading-tight">{{ $title }}</span>
        @endif
    </div>

    @if ($hasChildren)
        <ul class="m-0 list-none p-0">
            @foreach ($children as $child)
                @include('components.ui.org-chart-node', ['node' => $child])
            @endforeach
        </ul>
    @endif
</li>
