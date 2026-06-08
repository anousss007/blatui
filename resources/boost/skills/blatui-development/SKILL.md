---
name: blatui-development
description: Build UIs with BlatUI — shadcn/ui for the Laravel BLAT stack (Blade, Alpine.js, Tailwind v4). Use when adding or composing UI components, blocks, charts, or theming in a Blade app.
---

# BlatUI Development

## When to use this skill

Use this skill when building or editing UI in a Laravel Blade app that has BlatUI
installed (the `blatui/blatui` package, with components in
`resources/views/components/ui/`). Prefer BlatUI components over hand-written markup.

## Core model

BlatUI is **copy-paste, own-the-code**: components are Blade files copied into
`resources/views/components/ui/` and used under the `x-ui.` namespace. They are styled
with Tailwind v4 tokens and use a little Alpine.js for interactivity. There is no runtime
component package — editing a component file is the supported way to customize it.

## Workflow

1. **Check before adding.** A component is usable only if its file exists in
   `resources/views/components/ui/`. Glob that directory first.
2. **Add missing components** (copies source + prints required composer/npm peers):
   ```shell
   php artisan blatui:add <name> [<name> ...]
   php artisan blatui:list          # all available families
   ```
3. **Use them** in Blade:
   ```blade
   <x-ui.button variant="default">Save</x-ui.button>
   <x-ui.input type="email" placeholder="you@example.com" />
   <x-ui.card>
       <x-ui.card-header>
           <x-ui.card-title>Title</x-ui.card-title>
           <x-ui.card-description>Subtitle</x-ui.card-description>
       </x-ui.card-header>
       <x-ui.card-content>...</x-ui.card-content>
   </x-ui.card>
   ```
4. **Verify wiring** once with `php artisan blatui:init` (theme CSS, Alpine, imports).

## Catalog (55+ component families)

Forms: button, input, textarea, select, combobox, checkbox, radio-group, switch,
slider, toggle, label, field, calendar, date-picker, datetime-picker, time-field,
input-otp. Overlays: dialog, alert-dialog, sheet, drawer, popover, dropdown-menu,
context-menu, menubar, command. Data: table, avatar, badge, carousel, chart, progress,
skeleton, tooltip, hover-card. Layout: card, sidebar, resizable, scroll-area, separator,
tabs, accordion, collapsible, breadcrumb, pagination, navigation-menu. Feedback: alert,
sonner (toasts), empty, spinner.

## Blocks and charts

Full-page **blocks** (dashboards, auth, marketing, pricing, sidebars, calendars) and
**charts** (ApexCharts) are not bundled with the CLI but are installable from the registry:

```shell
# Read a block/chart and write each files[].content to its files[].target:
curl https://blatui.remix-it.com/r/blocks/dashboard-01.json
curl https://blatui.remix-it.com/r/charts/chart-area-default.json
```

Then run `php artisan blatui:add` for the block's `registryDependencies` (the components
it uses).

## Theming

All tokens are CSS variables in `resources/css/blatui.css` (`:root`, `.dark`, and
`[data-base]` / `[data-theme]` / `[data-radius]` …). To restyle: edit tokens, or build a
theme at https://blatui.remix-it.com/themes and paste the exported CSS as
`resources/css/app.css`. Use Tailwind token utilities (`bg-background`, `text-foreground`,
`border-input`, `rounded-lg`) — never hard-code hex colors.

## Discovery for agents

- Registry index: `https://blatui.remix-it.com/registry.json`
- Item with source inlined: `https://blatui.remix-it.com/r/<name>.json`
- Hosted MCP: `POST https://blatui.remix-it.com/mcp` · local MCP: `php artisan blatui:mcp`
  (tools: search_registry, get_component, get_example, install_command).
