# Changelog

All notable changes to the **BlatUI** package are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.6.0] - 2026-06-08

### ⚠️ Breaking
- **`card` is now a simple padded box by default.** The base `<x-ui.card>` renders
  `bg-card rounded-xl border p-6 shadow-sm` (no flex / gap / py) — the dominant "just a box"
  case is now the cheapest default. **Composed cards** (using `card-header` / `card-content` /
  `card-footer`) must opt into the old layout with `variant="sectioned"`:
  `<x-ui.card variant="sectioned">…</x-ui.card>`. After `php artisan blatui:add card`, add
  `variant="sectioned"` to every card that composes header/content/footer.

### Added
- **Semantic status tones.** New foundation tokens `--success` / `--warning` / `--info`
  (+ `-foreground`) plus a reusable `tone` axis on `badge` and `alert`
  (`tone="success|warning|danger|info|neutral"`; badges add `variant="soft|solid|outline"`).
  `danger` reuses the existing `--destructive`. Status badges are finally first-class.
- **`link`** — an inline, prose text link (`default` / `muted` / `subtle` variants, `external`).
- **`rating`** — a star rating input (hover preview, keyboard, hidden field for forms,
  `readonly`, `sm|default|lg`).
- **`icon`** — a thin Lucide wrapper that auto-mirrors directional arrows/chevrons under RTL,
  plus a `.blat-rtl-flip` utility.
- **Dispatchable overlays.** `dialog` / `sheet` / `alert-dialog` accept an `id` to open/close
  from anywhere via `$dispatch('open-dialog-{id}')` / `$dispatch('close-dialog-{id}')`; their
  triggers accept `for="{id}"`. A single shared modal now works from triggers inside a
  `@foreach` / server-rendered table — no per-row modal markup.
- **Form sizes.** `size="sm|default|lg"` on `input`, `textarea` and `select` (trigger).
- **Native form controls.** A `native` prop on `select` and `checkbox` renders a
  BlatUI-styled *native* `<select>` / `<input type=checkbox>` (submits without JS, name-bound),
  plus `@apply`-able `.blat-input` / `.blat-textarea` / `.blat-select` / `.blat-checkbox` /
  `.blat-radio` / `.blat-label` utilities for hand-rolled controls.
- **Button** — optional `before` / `after` named icon slots and an `as` (element
  polymorphism) prop.
- **`sonner-flash`** — a server-flash → toast bridge mapping
  `session('success'|'error'|'warning'|'info'|'status')` to sonner toasts (incl. a Fortify
  status map). Ships with the `sonner` family.
- **`date-picker` range** — `mode="range"` (was single-only) with `name[from]`/`name[to]`, a
  two-month calendar, and a `defaultMonth` prop.
- **Picker bounds & range limits.** `datetime-picker` accepts a full-datetime `min`/`max`
  (`Y-m-d\TH:i`): the date part bounds the calendar, the time part bounds the edge day
  (validated for the `input` *and* `select` time variants). Both pickers gain
  `min-nights` / `max-nights` (range length) and a hard `end ≥ start` check — invalid
  selections show inline errors, mark `aria-invalid`, and disable confirming / closing.
- **`blatui:doctor`** — scans Blade views for `<x-ui.button>` inside a `<form>` with no `type`
  (renders `type=button`, silently won't submit) and reports each `file:line`.

### Changed
- **`datetime-picker` range** now shows a two-month calendar by default (new `numberOfMonths`
  / `defaultMonth` props) for a proper date-range-with-times UX.

### Fixed
- Components that render Lucide via `<x-dynamic-component :component="'lucide-…'">` (e.g.
  `icon`) now correctly declare the `mallardduck/blade-lucide-icons` dependency in the registry.

## [1.5.0] - 2026-06-08

### Changed
- **Charts are now opt-in.** ApexCharts (~140kb) and the chart engine are no
  longer part of the base foundation, so apps that only use components never
  install or bundle them — and `npm run build` no longer requires `apexcharts`.
  The base `blatui.js` / `blatui-core.js` ship the components engine only. To
  use `<x-ui.chart>`:

  ```
  php artisan blatui:add chart
  npm install -D apexcharts
  php artisan vendor:publish --tag=blatui-charts
  ```

  then register it in `app.js`, before `Alpine.start()`:

  ```js
  import { registerCharts } from './blatui-charts.js';
  registerCharts(Alpine);
  ```

  The `chart` component now declares `apexcharts` as its npm dependency, and a
  new `blatui-charts` publish tag ships the opt-in engine. Existing installs are
  unaffected until you re-publish the foundations.

## [1.4.0] - 2026-06-08

### Added
- **MCP server** — `php artisan blatui:mcp` runs a stdio Model Context Protocol
  server so AI editors (Claude Code, Cursor, VS Code…) can discover and install
  components in conversation. Tools: `search_registry`, `list_components`,
  `get_component`, `get_example`, `install_command`; resources
  (`blatui://component|block|chart/{name}`) and prompts (`use-component`,
  `scaffold-page`). Works offline from the bundled stubs. No new dependencies.
- **Open registry** — `blatui:add` can now install from third-party,
  shadcn-compatible registries by namespace (`@vendor/name`) or full URL,
  resolving `registryDependencies` recursively with a local-stub fallback.
  Configure namespaces in the publishable `config/blatui.php`.
- **Laravel Boost integration** — the package ships
  `resources/boost/guidelines/core.blade.php` and a `blatui-development` agent
  skill, auto-discovered by Boost so AI agents learn BlatUI's conventions.
  `blatui:init` detects Boost and offers to run `boost:update --discover`.

### Removed
- The unused `tw-animate-css` npm dependency. Components animate via Alpine
  `x-transition`, so the published foundation (`blatui.css`) no longer imports
  it; it is dropped from the install docs and the `blatui:init` checks.

## [1.3.2] - 2026-06-07

### Changed
- `blatui:add` now only lists the peer packages (composer / npm) that aren't
  **already installed**, checking `composer.json` / `package.json` the same way
  `blatui:init` does. Following the README's up-front install no longer leaves
  `blatui:add` suggesting `composer require` for packages you already have.

## [1.3.1] - 2026-06-06

Two new Forms & Input components.

### Added
- `datetime-picker`: date and time in one popover, modes **single** and
  **range** — composes `calendar` and `time-field`. Timezone-naive
  `Y-m-d\TH:i` value, hidden inputs (`name`, or `name[from]` / `name[to]`),
  and a locale-aware trigger label honoring `hour-cycle` (auto / 12 / 24).
- `time-field`: a time control with a native `<input type=time>` variant and a
  dropdown (`select`) variant (hour / minute / second + AM-PM), 12/24-hour,
  seconds, and stepped minutes.

### Fixed
- `select-item`: option icons now sit inline with their label instead of
  stacking above the text.

## [1.3.0] - 2026-06-05

Theme-foundation and component enhancements shipped to consumers.

### Added
- `button`: `xs` size and an icon size scale (`icon-xs` / `icon-sm` / `icon-lg`).
- Foundations (`app.css`): 9 base-color presets (added slate + gray), a new
  **input-style** dimension (`[data-input-style]`: outline / fill / inset), a
  **heading font** token (`--font-heading`) decoupled from the body font, and
  additional `[data-font]` webfont families.
- Foundations (`blatui-core.js`): theme store now persists `inputStyle` and
  `fontHeading` and applies the matching `data-*` attributes.

## [1.2.0] - 2026-06-05

Accessibility overhaul of every shipped component (`blatui:add`) and the
foundations — WAI-ARIA / Base-UI parity, full keyboard + focus management, and
WCAG AA color contrast.

### Added
- Reusable a11y engine in the `blatui-core.js` foundation: `x-blat-trigger`,
  `x-blat-labelledby`, `x-blat-field`, the `blatMenu` / `blatMenubar` /
  `blatSelect` / `blatCommand` Alpine components, and `$blatNav` / `$blatType`.
- `field-error` accepts a `:messages` array (single → text, multiple → list).

### Changed
- All component stubs rebuilt to WAI-ARIA / Base-UI accessibility: correct
  roles/states, complete keyboard support (arrows, Home/End, typeahead, Esc),
  focus trap + restore, ARIA on the real controls; calendar is a full
  `role="grid"` with keyboard navigation.
- Foundations CSS tuned to **WCAG AA contrast** (light + dark, all base colors).
- `registry.json` regenerated.

### Fixed
- axe-core findings: unlabeled controls, invalid `aria-orientation`, nested
  interactive elements, listbox child roles, and missing accessible names.

## [1.1.0] - 2026-06-05

### Added
- **Composable foundations** for existing projects. The JS engine is now published
  as `blatui-core.js` (exports `registerBlatUI(Alpine)`) alongside the greenfield
  `blatui.js` bootstrap — apps that already run their own Alpine register BlatUI
  into it instead of booting a second instance. The CSS is additive: add
  `@import "./blatui.css";` to an existing `app.css` rather than replacing it.
- `blatui:init` now detects the **Tailwind major version** (v4 required; v3 →
  `npx @tailwindcss/upgrade`) and, when an app already runs Alpine, points to the
  `registerBlatUI` path instead of `blatui.js`.

### Fixed
- **Install flow** — corrected misleading setup docs that didn't work on a clean
  Laravel install: the README/getting-started now document the complete, verified
  path (publish the foundations, then `@import "./blatui.css"` + `import
  "./blatui.js"`), list `tw-animate-css` as a required peer (the theme CSS imports
  it), and fix the card example to add the missing `input` component.
- `blatui:init` now also checks for `tw-animate-css` and `apexcharts`, and verifies
  the foundations are actually **imported** into `app.css` / `app.js` — publishing
  alone is no longer reported as "present".
- The customizer's **Copy theme CSS** now exports a complete, self-contained
  stylesheet (Tailwind import + `@theme inline` mapping + every token), so a pasted
  theme actually renders styled instead of producing no utilities.

### Changed
- `Registry` now reads the generated `stubs/registry.json` manifest (single source
  of truth synced from the demo) instead of re-deriving families and dependencies.

## [1.0.0] - 2026-05-29

### Added
- `blatui:add <component>` — copies a component family (and its transitive
  component dependencies) into `resources/views/components/ui`.
- `blatui:list` — lists the 55 available component families, or details for one.
- `blatui:init` — doctor that checks Composer packages, npm/Alpine plugins,
  theme tokens and the Alpine bootstrap.
- `vendor:publish --tag=blatui-foundations` — publishes the theme tokens (CSS)
  and the Alpine + chart + calendar engine (JS).
- Laravel auto-discovery of the service provider.

[Unreleased]: https://github.com/anousss007/blatui/compare/v1.3.2...HEAD
[1.3.2]: https://github.com/anousss007/blatui/compare/v1.3.1...v1.3.2
[1.3.1]: https://github.com/anousss007/blatui/compare/v1.3.0...v1.3.1
[1.3.0]: https://github.com/anousss007/blatui/compare/v1.2.0...v1.3.0
[1.2.0]: https://github.com/anousss007/blatui/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/anousss007/blatui/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/anousss007/blatui/releases/tag/v1.0.0
