# Changelog

All notable changes to the **BlatUI** package are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.15.1] - 2026-06-27

### Fixed
- **Teleported popovers inside modals** ([#5](https://github.com/anousss007/blatui/issues/5)). Two
  bugs hit any teleported overlay (`datetime-picker`, `date-picker`, `combobox`, `select`,
  `dropdown-menu`, `context-menu`, `menubar`, `popover`, `hover-card`, `tooltip`) when used inside a
  modal:
  - **Rendered *behind* a Flux modal.** Flux `<flux:modal>` is a native `<dialog>` opened with
    `showModal()`, which lives in the browser's **top layer** — it paints above everything in
    `<body>` regardless of `z-index`, so a popover teleported to `<body>` was hidden behind it (and
    inert). New shared `x-blat-dialog-layer` directive relocates the popover into the nearest
    ancestor native `<dialog>` when there is one (top layer + interactive); otherwise it stays in
    `<body>` as before, still escaping overflow-clipping ancestors.
  - **Picker died after a Livewire validation re-render.** Livewire's morph detached the teleported
    popover from its Alpine scope, after which its expressions (`open`/`errors`/`invalid`) resolved
    against `window` — throwing `'open' called on … Window` and `… is not defined`, killing the
    widget until a full page refresh. `wire:ignore` on the teleport template keeps morph from
    touching the popover; Alpine reactivity and `wire:model`/`@entangle` keep working.

### Added
- **Livewire support — `wire:model` on every form control, with full two-way binding.** Components are
  Blade + Alpine, so they already render inside Livewire; this wires `wire:model` through to their value:
  - Native fields (`input`, `textarea`, native `select`/`checkbox`) bind directly.
  - Alpine-driven widgets entangle their state via `@entangle($attributes->wire('model'))` — `select`,
    `combobox`, `autocomplete`, `switch`, `toggle`, `toggle-group`, `radio-group`, `checkbox`, `slider`,
    `rating`, `knob`, `number-input`, `color-picker`, `date-picker`, `datetime-picker`, `time-field`,
    `input-otp`, `tags-input`, `editable`, `markdown-editor`.
  - Composites forward `wire:model` to their real input — `file-upload` (upload target), `phone-input`,
    `segmented-control`, `mention-input`, `rich-text-editor`, `signature-pad`.
  - Respects `.live` / `.blur` / `.debounce` modifiers. The bridge is **fully inert (and stripped)
    when Livewire isn't installed**, so plain Blade/Alpine projects are unaffected.
- **`brand`** — your app's logo/wordmark, optionally linked (parity with Flux's `<flux:brand>`).
- **`profile`** — an avatar paired with a name/description, for account buttons and dropdown triggers
  (parity with Flux's `<flux:profile>`).

### Notes
- `slider`, `date-picker` and `datetime-picker` bind a single value with `wire:model` in their default
  mode; their range modes submit via standard `name[...]` form fields.

## [1.14.1] - 2026-06-24

### Fixed
- **`context-menu`** closes on window scroll/resize instead of staying pinned to stale fixed
  coordinates. Scrolling inside the menu keeps it open.
- **`accordion`** trigger shows `cursor-pointer` again (Tailwind v4 dropped the default cursor).

### Added
- **`tree-table`** `copyable` prop — copies the hierarchy as a markdown tree (`├──/└──/│`).
- **`confetti`** `direction`/`spreadArc` (aimed bursts) and `fullscreen` (top-edge rain).

## [1.14.0] - 2026-06-24

### Changed
- **Component consolidation toward composition ([#3](https://github.com/anousss007/blatui/issues/3)).**
  Near-duplicate components now share one implementation; breadth is expressed as variants of a single
  component instead of separate components, with the total component + variant count preserved.
  - `add-to-cart` composes `<x-ui.button>`; `mention-input` composes `<x-ui.textarea>`.
  - `dropdown-menu` / `context-menu` / `menubar` share new `menu-*` leaf primitives (identical output).
  - `autocomplete` + `combobox` share one Alpine listbox engine; `combobox` gained `trigger="input"`.

### Deprecated
- **`autosize-textarea`** → use `<x-ui.textarea :max-rows="…">` (textarea gained `rows`/`maxRows`).
  Ships as a thin alias; existing installs are unaffected.
- **`autocomplete`** → use `<x-ui.combobox trigger="input">`. Ships as a thin alias.

### Removed
- **`quantity-selector` removed** — it was the same control as `number-input` with different
  defaults (integer-only, `min`/`value` of 1, a tighter footprint), which duplicated the API
  surface and the underlying code ([#3](https://github.com/anousss007/blatui/issues/3)). Build a
  cart/product stepper with `number-input` instead: `<x-ui.number-input :min="1" size="sm" />`.
  A "Quantity selector" usage example now lives on the number-input docs page. Projects that
  already ran `blatui:add quantity-selector` keep their copied component — only the registry
  entry is gone.

## [1.13.2] - 2026-06-16

### Changed
- **Package renamed `blatui/blatui` → `anousss007/blatui`** — the Composer vendor now matches
  the GitHub owner. The product (BlatUI), the `BlatUI\` namespace and the component prefix are
  unchanged. This release declares `replace: { "blatui/blatui": "self.version" }`, and the old
  package is marked abandoned on Packagist pointing here, so existing `composer require
  blatui/blatui` installs keep resolving their pinned versions and only see a one-time rename
  notice. Switch your `composer.json` to `anousss007/blatui` to receive new releases.

## [1.13.1] - 2026-06-16

### Fixed
- **Mobile responsiveness**: `audio-player` no longer overflows narrow screens — the seek bar
  shrinks and the fine volume slider hides below `sm` (the mute button stays). The horizontal
  `stepper` rail now scrolls instead of overflowing. Verified across the component set at 320–390 px.

## [1.13.0] - 2026-06-15

### Added
- **75 new components** taking the set from 81 to **156**, including four new categories:
  - **AI** — `chat`, `prompt-input`, `streaming-text`, `reasoning`, `tool-call`, `citation`.
  - **Effects** — `gradient-text`, `number-ticker`, `border-beam`, `spotlight-card`,
    `tilt-card`, `flip-card`, `confetti`, `meteors`, `animated-beam`, `parallax`,
    `dot-pattern`, `grid-pattern`, `aurora`.
  - **E-commerce** — `product-card`, `price`, `quantity-selector`, `variant-selector`,
    `add-to-cart`, `mini-cart`.
  - **Media** — `audio-player`, `image`, `qr-code` (dependency-free SVG), `map` (keyless OSM).
- Major additions across existing groups: **Forms** (`file-upload`, `color-picker`,
  `password-strength`, `autosize-textarea`, `editable`, `rich-text-editor`, `markdown-editor`,
  `signature-pad`, `mention-input`, `segmented-control`, `knob`, `repeater`), **Data display**
  (`stat`, `tree`, `json-viewer`, `description-list`, `avatar-group`, `meter`, `heatmap`,
  `comparison-slider`, `masonry`, `diff-viewer`, `kanban`, `tree-table`, `gantt`, `scheduler`,
  `org-chart`, `presence`), **Navigation** (`scrollspy`, `bottom-navigation`, `dock`,
  `speed-dial`, `back-to-top`, `infinite-scroll`), **Layout** (`container`, `stack`,
  `bento-grid`, `page-header`, `visually-hidden`) and **Feedback/Overlays**
  (`cookie-consent`, `top-progress`, `loading-overlay`, `notification-center`,
  `onboarding-tour`).
- Every new component is self-contained (Blade + Alpine + Tailwind design tokens), themeable
  (light + dark) and **WCAG 2 AA** (axe-core: 0 critical / 0 serious). Install any with
  `php artisan blatui:add <name>`.

## [1.12.2] - 2026-06-14

### Fixed
- **Submenus no longer clipped** (`dropdown-menu`, `context-menu`, `menubar`) — the sub-content
  flyout lived inside the parent menu panel, which is `fixed max-h-96 overflow-y-auto`; `x-anchor`
  positioned the flyout but the parent's clip/scroll swallowed it, so it was cut off or pushed
  into a scrollbar instead of opening to the side. The flyout now teleports to `<body>` with
  `fixed` positioning — mirroring how the top-level panel already escapes its container — so it
  flies out cleanly. A short, cancellable close delay (`closeSoon` / `cancelClose` on the menu
  engine) lets the pointer cross the gap from the trigger to the teleported flyout without it
  snapping shut. (#2)

  Re-run `blatui:add dropdown-menu context-menu menubar` and re-copy `foundations/blatui-core.js`
  to pick up the fix.

## [1.12.1] - 2026-06-11

### Accessibility
Synced from a full axe-core (WCAG 2.1 A/AA) audit of the demo — **0 critical, 0 serious** violations
across every component and variant.

- **Status tokens darkened for AA contrast** (`foundations/app.css` `:root`): `--destructive`,
  `--success`, `--warning` and `--info` nudged darker so `text-*` clears WCAG AA 4.5:1 on white and on
  the `/10` soft tint. Solid-fill `*-foreground` pairs unchanged. **Re-copy `foundations/app.css`** (or
  re-apply the token block) to pick up the contrast fix.
- **`alert`** — dropped the `/90` opacity on `alert-description` so it meets AA on the tinted background.
- **`kbd`** — a passed `aria-label` (invalid on `<kbd>`) now renders as visually-hidden `sr-only` text.
- **`time-field`** — an author `aria-label` is forwarded onto the real `<input type="time">`.
- **`select`** — the `:options` shorthand trigger now carries an accessible name (`placeholder` or
  "Select option") for its `combobox` role.
- **`data-table`** — select-all and per-row checkbox buttons now have `aria-label`s.
- **`item-group`** — removed `role="list"` (children aren't `listitem`s).

Re-run `blatui:add` for any of these components to pull the fixes.

## [1.12.0] - 2026-06-11

### Added
- **`comparison-table`** — a data-driven feature-comparison table (`:tiers` × `:rows`, check / dash /
  text values, `highlight` column). `blatui:add comparison-table`.
- **`accent`** — `<x-ui.accent color="#7c3aed">…</x-ui.accent>` recolours every BlatUI component in
  its subtree from one token override (display:contents, no layout impact). `blatui:add accent`.
- **`color` prop on `input`, `textarea` and `select`** — brands the focus ring + selection locally,
  matching the `button` `color` prop; use `accent` to recolour a whole form or section at once.

### Added
- **Five new installable components** — `blatui:add countdown timeline terminal sparkline`:
  - **`countdown`** — a live, timezone-safe countdown to a target date with an expired state.
  - **`timeline`** (+ `timeline-item`) — a vertical timeline with dots, connectors, icons and timestamps.
  - **`terminal`** — a terminal / console window for command output and code demos (dark in both themes).
  - **`sparkline`** — a server-rendered inline trend line from a data array, theme-token coloured.
- **`progress` circular / ring variant** (`circular` + `size` / `thickness` / `show-value`) — linear behaviour unchanged.
- **`button` `color` prop** — recolours a button by overriding the primary token locally; the same
  `style="--primary: …"` wrapper trick recolours any subtree of BlatUI components.

### Changed
- **Promoted to a 1.10.0 minor.** This consolidates the additive component features shipped across
  the 1.9.x line into a proper minor milestone: the `combobox` `disabled` prop (1.9.1) and
  multi-select `:multiple` on `select` / `combobox` / `autocomplete` (1.9.2, with the updated
  `blatui-core.js` `blatSelect` engine). No new component code since 1.9.2 and no breaking changes —
  installing `anousss007/blatui:^1.10` gives you exactly the 1.9.2 component set under a minor version.

## [1.9.2] - 2026-06-10

### Added
- **Multi-select (`:multiple`) on `select`, `combobox` and `autocomplete`** (synced from the demo) —
  opt in with `multiple`: selected entries render as removable chips, picking toggles without closing
  the list, and it submits as `name[]` (binds to a Laravel array field). Pre-select via
  `:value="['a', 'b']"`. `autocomplete` becomes a tag input.
- The bundled **`blatui-core.js` engine** gains multi-value support in `blatSelect` (chips, toggle,
  `isSelected`/`remove`). The `select` multi-select needs this updated engine — after bumping, run
  `blatui:init` so the foundation-skew check flags an out-of-date installed `blatui-core.js`.
  `combobox`/`autocomplete` multi-select are self-contained Blade (Alpine inline), no engine bump
  required.

### Added
- **`combobox` `disabled`** (synced from the demo) — the installable `combobox` stub now accepts a
  `disabled` prop, matching `select`/`autocomplete`: it renders the `disabled` attribute on the
  trigger and dims it, so the listbox can no longer be opened.

## [1.9.0] - 2026-06-10

### Added
- **Seven new installable components:** `stepper` (multi-step flow, horizontal/vertical, with
  completed-step checks), `typography` (prose styles via one `variant` prop), `data-table`,
  `autocomplete` (type-ahead input), `phone-input`, `input-mask`, and `code-block` — plus
  `menubar` sub-menus and an `alert-action` slot. `blatui:add <name>` ships them all.
- **New variants/props on existing components** (synced from the demo): `tabs` `variant`
  (segmented | underline | pills), `table` `variant="card"` + striping, `select` `:options`
  shorthand, `combobox` `:searchable="false"`, `switch` `size`, `toggle-group` vertical + group
  `size`/`variant`, `textarea` character-count/no-resize/read-only, `tooltip` optional arrow,
  `calendar` `calendar:set-range` + `minDays`/`maxDays`, and more.
- **`blatui:init` foundation-skew check** — after a package bump, `blatui:add` copies Blade stubs
  but not the JS engine. `blatui:init` now compares the helpers your installed `blatui-core.js`
  registers against the bundled engine and warns about any it is missing (so "the prop exists but
  does nothing" skew is caught). Robust to intentional customisation (compares by capability).

### Fixed
- **`blatui:doctor` false positives** — `<x-ui.*>` mentioned only inside a comment (Blade, HTML or
  PHP) is no longer flagged. Comment bodies are masked before scanning (line numbers preserved).
- **Foundation fixes shipped via the stubs:** `.blat-select` sets `-webkit-appearance: none`
  (iOS/Safari double-arrow); `sonner-flash` resolves status strings through `__()` (no leaked
  slug); `select` items read their own label; `toggle-group` items inherit the group's
  `size`/`variant`. See the demo changelog for the full component-level list.

## [1.8.0] - 2026-06-09

### Added
- **Seven new components:** `marquee` (seamless infinite scroll), `copy-button` (clipboard copy
  with a copied state + live announcement), `banner` (dismissible announcement bar with semantic
  tones), `typewriter` (cycling typed words with a caret), `text-reveal` (scroll-linked word-by-word
  reveal), `gallery` (thumbnail grid → full-screen lightbox with keyboard nav + focus trap), and
  `video` (styled HTML5 player with poster + custom play overlay). All ARIA-complete, token-driven
  and reduced-motion aware.
- **`input` password & icon affordances:** `type="password"` gains a built-in show/hide eye toggle
  (opt out with `:toggle="false"`); new `leading` / `trailing` slots for prefix/suffix icons, with
  RTL-safe padding (`ps`/`pe`).
- **`sonner` collapsed stack + `expand`:** toasts collapse into a stack and fan out on hover/focus
  (Sonner-style); the new `expand` prop keeps them always expanded.
- **`dialog` `fullscreen` variant:** an edge-to-edge takeover instead of the centered box.
- **Carousel swipe:** touch/pen swipe to change slides (`swipe` prop, on by default; mouse unaffected).
- **`blatui:doctor`** now also scans compiled views for literal `<x-ui.*>` tags that leaked into the
  HTML (a tag that failed to compile — e.g. nested as the slot content of an `@aware` component) and
  points at the foundations utilities as the fix.
- **Foundations utilities** (`.blat-input` / `.blat-textarea` / `.blat-select` / `.blat-checkbox` /
  `.blat-radio`) documented as the recommended primitive for server-rendered DX layers that re-wrap a
  slot, with a getting-started callout on the `@aware`-slot compile footgun.

### Fixed
- **Vertical carousel** paged by the whole stack height instead of one item — the first "next"
  scrolled every slide out of view, and slides collapsed instead of filling the frame. The vertical
  track now uses `h-full` (vertical carousels need a height on `<x-ui.carousel-content>`).
- **Duplicate toasts** when `<x-ui.sonner>` was mounted more than once on a page.

### Changed
- `sonner` is now a **singleton** per page (the first-mounted toaster stays active; extras go inert),
  so mounting it twice no longer renders duplicate overlapping toasts. The `window.toast` API is
  unchanged.
- Re-publish foundations (`php artisan vendor:publish --tag=blatui-foundations`) to pick up the
  `marquee` keyframes added to `app.css`.

## [1.7.0] - 2026-06-08

### Added
- **`out-of-range` mode on `date-picker` / `datetime-picker` / `calendar`** — `disable` (default:
  out-of-range dates are struck-through and unselectable) or `flag` (selectable but shown red, and
  selecting one flags the field invalid via `aria-invalid` + an error). `min` / `max` now act as
  real **date bounds** on the calendar — previously they were interpreted as range *span counts*
  and didn't gate single-date selection. (Requires re-publishing foundations: the gating logic is
  in `blatui-core.js`.) Verified in-browser.

## [1.6.6] - 2026-06-08

### Fixed
- **`date-picker` / `datetime-picker` selection wasn't saved** after the 1.6.2 teleport. The
  calendar now lives in a `<body>` portal, so its `calendar-change` (and the time-field's
  `time-change`) bubbled to `<body>`, never reaching the `@calendar-change` listener on the
  picker root — the hidden input and trigger label stayed empty. Moved the listeners inside the
  teleported popover (which contains the calendar and shares the picker's scope). Verified
  in-browser: clicking a day now updates the input and label. Affects single and range.

## [1.6.5] - 2026-06-08

### Fixed
- **Calendar: outside-day status was stale after month navigation.** `data-outside` was bound
  to `isOutside(day, m)`, but the outer-loop `m` goes stale in the nested per-cell bindings
  after a prev/next navigation, so prev/next-month days were mislabeled. The panel month is now
  stamped onto each day in `weeksFor` and read directly. Latent for the muted-day styling; it
  made `show-outside-days="false"` render a near-empty grid after navigating. Verified across
  months in-browser. (Requires re-publishing foundations: the fix is in `blatui-core.js`.)

## [1.6.4] - 2026-06-08

### Fixed
- **`show-outside-days="false"` now actually works.** The 1.6.3 implementation relied on a
  runtime Alpine expression that broke the grid (only the first week rendered). Reworked to a
  pure-CSS approach (a `data-hide-outside-days` flag + `:has()` rules) that hides prev/next-month
  filler days and collapses fully-outside week rows — no runtime expression to fail.
- **Disabled (out-of-range) days are now clearly distinct.** With `min`/`max` set, disabled days
  were only slightly muted; they now render struck-through and fainter so valid vs unavailable
  dates read at a glance.

### Added
- **`week-start` accepts a day name** (`week-start="monday"`) in addition to `0–6` (0 = Sunday),
  on `calendar` / `date-picker` / `datetime-picker`.

## [1.6.3] - 2026-06-08

### Added
- **`show-outside-days` on `calendar` / `date-picker` / `datetime-picker`** (default `true`).
  Set `false` to hide the greyed-out days from the previous/next month — outside days render as
  empty, non-interactive cells and any week row that is entirely outside the month collapses.

## [1.6.2] - 2026-06-08

### Fixed
- **Anchored popovers are no longer clipped by an `overflow-hidden` ancestor.** `date-picker`,
  `datetime-picker` and `combobox` now teleport their popover/listbox to `<body>` (like
  `popover` / `select` / `dropdown-menu` already do), so placing one inside a card, table cell,
  or any clipping container shows the full popover. `x-anchor` still positions it at the trigger.
  (`navigation-menu` is intentionally left inline — it opens on hover and is not used inside
  clipping containers.)

## [1.6.1] - 2026-06-08

### Fixed
- **Dark mode no longer auto-applies the OS preference (footgun).** `registerBlatUI` defaulted
  the theme store to `mode: 'system'`, so on a dark-OS machine it added `.dark` to `<html>` at
  boot — silently flipping light-only apps to an unreadable dark (invisible in dev/CI; only on
  a real dark-OS machine). The default is now light-until-toggled.

### Added
- **`registerBlatUI(Alpine, { darkMode })`** — `'class'` (default: light until an explicit
  toggle, never auto-OS-dark), `'system'` (follow `prefers-color-scheme`), or `false` (hard
  light-only). **To keep the previous OS-following behavior, pass `{ darkMode: 'system' }`.**

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
