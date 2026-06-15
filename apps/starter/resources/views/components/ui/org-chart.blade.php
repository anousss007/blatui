@props([
    'root' => [],     // single root node: ['name', 'title'?, 'avatar'?, 'children'?=>[...]]
    'data' => null,   // alias for `root`
])

@php
    // Accept the tree via `root` (preferred) or `data` (alias). Whichever is non-empty wins.
    $tree = !empty($data) ? $data : $root;
@endphp

{{--
    Top-down organizational chart, server-rendered recursively.

    Each node is a centered card (avatar/initials + name + title); a node's children
    are laid out in a horizontal row beneath it, joined by pure-CSS connector lines.

    Accessibility: the hierarchy is a real tree of nested lists (ul > li > ul ...), so
    screen readers announce the parent/child structure. Connector lines are drawn with
    decorative CSS pseudo-elements (no DOM, nothing announced).

    The connector CSS is scoped to [data-slot="org-chart"] and emitted @once so it never
    duplicates and never touches app.css. It is keyframe-free and uses design tokens only.
--}}
@once
    <style>
        /* ---- BlatUI org-chart connectors (scoped, decorative) ---- */
        [data-slot="org-chart"] ul {
            display: flex;
            justify-content: center;
            padding-block-start: 1.25rem; /* room for the vertical drop into this row */
            position: relative;
        }
        /* Each node sits in its own column; the cell is the positioning context. */
        [data-slot="org-chart"] li {
            display: flex;
            flex-direction: column;
            align-items: center;
            flex: 1 1 auto;
            padding-inline: 0.5rem;
            position: relative;
        }
        /* Vertical line going UP from each child to the horizontal bus above it. */
        [data-slot="org-chart"] li::before {
            content: "";
            position: absolute;
            inset-block-start: 0;
            inset-inline-start: 50%;
            width: 0;
            height: 1.25rem;
            border-inline-start: 1px solid var(--border);
        }
        /* Horizontal bus: a top border across each child cell. The two outermost
           edges are trimmed so the bus spans only between siblings, not past them. */
        [data-slot="org-chart"] li::after {
            content: "";
            position: absolute;
            inset-block-start: 0;
            inset-inline-start: 0;
            width: 100%;
            height: 0;
            border-block-start: 1px solid var(--border);
        }
        [data-slot="org-chart"] li:first-child::after {
            inset-inline-start: 50%;
            width: 50%;
        }
        [data-slot="org-chart"] li:last-child::after {
            width: 50%;
        }
        /* A lone child needs no horizontal bus, only the vertical drop. */
        [data-slot="org-chart"] li:only-child::after {
            display: none;
        }
        /* The top-level row has no parent above it: suppress its inbound connectors. */
        [data-slot="org-chart"] > ul {
            padding-block-start: 0;
        }
        [data-slot="org-chart"] > ul > li::before,
        [data-slot="org-chart"] > ul > li::after {
            display: none;
        }
        /* Vertical line going DOWN from a parent card into its children's bus. */
        [data-slot="org-chart"] li > ul::before {
            content: "";
            position: absolute;
            inset-block-start: 0;
            inset-inline-start: 50%;
            width: 0;
            height: 1.25rem;
            border-inline-start: 1px solid var(--border);
        }
    </style>
@endonce

<div data-slot="org-chart" tabindex="0" role="group" aria-label="Organisation chart" {{ $attributes->twMerge('text-foreground focus-visible:ring-ring/50 w-full overflow-x-auto p-1 outline-none focus-visible:ring-[3px]') }}>
    @if (!empty($tree))
        <ul class="m-0 list-none p-0">
            @include('components.ui.org-chart-node', ['node' => $tree])
        </ul>
    @endif
</div>
