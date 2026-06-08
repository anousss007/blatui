# Changelog

All notable changes to **BlatUI** are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.6.0] - 2026-06-08

### ⚠️ Breaking
- **`card` default is now a simple padded box** (`p-6`, no flex/gap/py). Composed cards
  (header/content/footer) must opt in with `variant="sectioned"`.

### Added
- **Semantic status tones** — `--success`/`--warning`/`--info` tokens + a `tone` axis on
  `badge` and `alert` (`success|warning|danger|info|neutral`, badge `variant=soft|solid|outline`).
- **New components** — `link` (inline prose), `rating` (stars), `icon` (RTL-mirroring Lucide
  wrapper), and a `sonner-flash` server-flash → toast bridge.
- **Dispatchable overlays** — `dialog`/`sheet`/`alert-dialog` open by `id` via `$dispatch`,
  triggers take `for="{id}"` (modals from `@foreach` rows).
- **Forms** — `size` on input/textarea/select, `native` variants on select/checkbox, plus
  `.blat-*` `@apply` utilities; button `before`/`after` slots and `as`.
- **Pickers** — `date-picker` gains `mode="range"`; both pickers gain full-datetime `min`/`max`
  (date + time), `min-nights`/`max-nights`, and hard end ≥ start validation. `datetime-picker`
  range is a two-month view.

### Changed
- `BlatuiRegistry` now detects Lucide used via `<x-dynamic-component>` (dynamic icon deps).

## [1.5.0] - 2026-06-08

### Changed
- **Charts are opt-in.** Split the chart engine out of `blatui-core.js` into a
  separate `blatui-charts.js` (exporting `registerCharts`). Components-only apps
  no longer pull in ApexCharts (~140kb) or break the build without it. The
  published bootstrap `blatui.js` is charts-free; the `chart` component declares
  `apexcharts` as its npm dependency, shipped via a new `blatui-charts` tag.

## [1.4.0] - 2026-06-08

AI-native distribution + a theme editor + new templates.

### Added
- **Registry distribution** (shadcn-compatible): `/registry.json`, per-item
  `/r/{name}.json` and `/r/blocks|charts/{name}.json` with the Blade source
  inlined and absolute `registryDependencies` URLs, so the official shadcn CLI
  (`npx shadcn add <url>`) and the BlatUI CLI can both install components.
- **AI discoverability / agent readiness**: `/llms.txt` + `/llms-full.txt`; a
  hosted MCP server at `POST /mcp` (tools, resources, prompts); `.well-known`
  cards (MCP server card, A2A agent card, agent skills, RFC 9727 API catalogue);
  `/openapi.json`; markdown content negotiation; discovery `Link` headers;
  `robots.txt` AI-bot rules + Content-Signal; SoftwareApplication JSON-LD;
  a WebMCP shim; and a DNS-AID record. Reaches **level 5 "Agent-Native"** on
  isitagentready.com.
- **Theme editor** at `/themes` — live preview, import/export JSON and shareable
  `?t=` theme links, built on the existing customizer.
- **Templates**: a `marketing-01` landing page and a `pricing-01` page.
- **MCP guide** at `/docs/mcp`.

### Fixed
- The registry index now builds in O(n) (memoized `BlatuiRegistry`), so
  `/registry.json` no longer times out under load.

## [1.3.0] - 2026-06-05

Competitive parity pass — every component's example coverage expanded, a real-world
Examples gallery added, and the theme customizer extended to match and exceed
comparable libraries.

### Added
- 100+ new component examples across all 55 components — variants, sizes, states and
  real-world compositions (220 example files total).
- Examples gallery merged into `/blocks` (`#examples`): product, pricing, blog,
  profile, testimonial, payment, share, feedback dialog and more, with real Unsplash
  imagery.
- Theme customizer: 2 base colors (slate, gray → 9 total), an **input-style**
  dimension (outline / fill / inset), and a **heading + body font split** with 14
  webfont families served via Bunny — all surfaced in the Customize panel.
- `button`: `xs` size plus an icon size scale (`icon-xs` / `icon-sm` / `icon-lg`).
- `config('docs.labels')` display-name overrides (e.g. "Input OTP").

### Fixed
- `nav-main` block: Alpine `aria-expanded` / `aria-controls` bindings (`:` → `::`).
- Card team-member / share rows: trailing badge overflow (`min-w-0` + `truncate`).

## [1.2.0] - 2026-06-05

Full accessibility overhaul — every component brought to WAI-ARIA / Base-UI parity
(roles, states, keyboard, focus) and audited with axe-core.

### Added
- Reusable a11y engine in `blatui-core.js`: `x-blat-trigger` (mirrors popup ARIA
  onto the real focusable control), `x-blat-labelledby`, `x-blat-field` (auto-wires
  `aria-describedby` / `aria-invalid` / label), the `blatMenu` / `blatMenubar` /
  `blatSelect` / `blatCommand` Alpine components, and the `$blatNav` / `$blatType`
  magics (roving arrow/Home/End focus + typeahead).
- `field-error` accepts a `:messages` array (one → text, several → bulleted list),
  mirroring shadcn's `<FieldError errors>`.
- New examples: card variations (image, header action, stats, notifications, login),
  and field / input hint + error / invalid states.

### Changed
- WAI-ARIA pass across dialogs, all menu types, the listbox family
  (select/combobox/command), disclosure (tabs/accordion/collapsible),
  tooltip/hover-card, every form control, slider, resizable and more: correct
  roles/states, full keyboard support, focus trap + restore, and ARIA placed on the
  real controls (not wrapper spans).
- Calendar is now a full `role="grid"` with per-day labels, roving tabindex and
  arrow / Home / End / PageUp-Down keyboard navigation.
- Theme tuned to meet **WCAG AA contrast** in light and dark across every base color
  (darker `--muted-foreground` and `--destructive`; calendar outside-days no longer
  rely on opacity).

### Fixed
- A range of issues surfaced by an axe-core audit: unlabeled triggers/buttons,
  `aria-orientation` on `role=group`, nested interactive controls inside
  checkbox/switch, disallowed listbox children, and missing accessible names on
  dialog / slider / progressbar / combobox.

## [1.1.0] - 2026-06-05

### Added
- **Composable foundations** — the JS engine is published as `blatui-core.js`
  (exports `registerBlatUI(Alpine)`) alongside the greenfield `blatui.js`
  bootstrap, so apps already running their own Alpine register BlatUI into it
  instead of booting a second instance. CSS installs additively
  (`@import "./blatui.css"` rather than replacing `app.css`).
- `blatui:registry:build` — regenerates `registry.json`, the manifest the CLI
  package consumes; `scripts/sync-package.sh` now ships it (and `blatui-core.js`)
  with the stubs.

### Fixed
- **Install flow** — getting-started and the README now document the complete,
  verified path (publish the foundations, then import `blatui.css` / `blatui.js`),
  list `tw-animate-css` as a required peer, fix the card example to add the
  missing `input` component, and add an "Installing into an existing project"
  guide (Tailwind v4 prerequisite, additive CSS, `registerBlatUI`).
- The customizer's **Copy theme CSS** now exports a complete, self-contained
  stylesheet (Tailwind import + `@theme inline` mapping + every token), so a
  pasted theme renders styled instead of producing no utilities.

### Changed
- Dropped the demo's vestigial `blatui:add` / `blatui:list` / `blatui:init`
  commands — the `blatui/blatui` package is the sole CLI owner.

## [1.0.0] - 2026-05-29

### Added
- **55 components** — faithfully ported from shadcn/ui to Blade + Alpine (button, dialog, dropdown, select, calendar, tabs, sidebar, command, …).
- **62 blocks** — 4 dashboards, 16 sidebars, 32 calendars, 5 login + 5 sign-up pages.
- **70 charts** — area, bar, line, pie, radar, radial, tooltip variants on a themeable ApexCharts engine (lazy-loaded).
- **Theming system** — shadcn oklch design tokens as CSS variables, base-color / accent / radius / font / shadow / spacing / tracking presets, light + dark, persisted, no-flash.
- **Live customizer** with **Copy theme CSS** export (resolved `:root` / `.dark`).
- **Docs site** — components reference (Preview/Code/Copy), blocks & charts galleries with live thumbnails, getting-started guide.
- **Artisan CLI** — `blatui:init` (doctor), `blatui:add` (copy components), `blatui:list`.
- SEO baseline — titles, meta description, Open Graph / Twitter cards, sitemap.xml, robots.txt, favicon, OG image.

[Unreleased]: https://github.com/anousss007/blatui-demo/compare/v1.1.0...HEAD
[1.1.0]: https://github.com/anousss007/blatui-demo/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/anousss007/blatui-demo/releases/tag/v1.0.0
