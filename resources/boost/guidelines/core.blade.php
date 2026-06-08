## BlatUI

BlatUI is shadcn/ui for the Laravel BLAT stack (Blade, Alpine.js, Tailwind CSS v4).
Components are copy-paste Blade components the user **owns** — copied into
`resources/views/components/ui/`, not a runtime dependency. Works with or without Livewire.

### Using components

Components live under the `x-ui.` namespace. Use them directly in Blade and prefer
them over hand-rolled markup:

@verbatim
<code-snippet name="BlatUI components in Blade" lang="blade">
<x-ui.button variant="outline" size="sm">Save</x-ui.button>

<x-ui.dialog>
    <x-ui.dialog-trigger>
        <x-ui.button>Open</x-ui.button>
    </x-ui.dialog-trigger>
    <x-ui.dialog-content>
        <x-ui.dialog-header>
            <x-ui.dialog-title>Title</x-ui.dialog-title>
        </x-ui.dialog-header>
    </x-ui.dialog-content>
</x-ui.dialog>
</code-snippet>
@endverbatim

Component APIs mirror shadcn/ui. `button` variants: `default`, `secondary`, `outline`,
`ghost`, `destructive`, `link`; sizes `sm`, `default`, `lg`, `icon`.

### Installing components

A component is only usable if its file exists in `resources/views/components/ui/`.
If it is missing, add it with the CLI — this copies the Blade source and prints the
required composer/npm peer packages. Never re-implement a component by hand if BlatUI
ships it.

@verbatim
<code-snippet name="Add BlatUI components" lang="shell">
php artisan blatui:add button card dialog   # copies files + their dependencies
php artisan blatui:list                      # browse everything available
php artisan blatui:init                      # verify theme tokens, Alpine, imports
</code-snippet>
@endverbatim

### Theming

Every design token is a CSS variable on `:root` / `.dark` / `[data-*]` in
`resources/css/blatui.css`. Recolor by editing tokens, or design a theme visually at
https://blatui.remix-it.com/themes and paste the exported CSS into `resources/css/app.css`.

### Machine-readable registry

To read a component's exact source or discover what exists, use the registry
(shadcn-compatible, every file inlined):

- Index: `https://blatui.remix-it.com/registry.json`
- One item: `https://blatui.remix-it.com/r/<name>.json`
  (blocks: `/r/blocks/<name>.json`, charts: `/r/charts/<name>.json`)
- LLM index: `https://blatui.remix-it.com/llms.txt`

A hosted MCP server is available at `https://blatui.remix-it.com/mcp`, and a local one
via `php artisan blatui:mcp` (tools: search_registry, get_component, get_example,
install_command; resources `blatui://component|block|chart/{name}`).
