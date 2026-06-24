# Changelog

All notable changes to **BlatUI** are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.14.0] - 2026-06-24

### Changed
- **Component consolidation toward composition ([#3](https://github.com/anousss007/blatui/issues/3)).**
  Near-duplicate components now share one implementation and their breadth is shown as variants of
  a single component rather than separate components. Total breadth is preserved (component + variant
  count did not drop). Public tags keep working — merged components remain as thin deprecated aliases.
  - `add-to-cart` now composes `<x-ui.button>` instead of re-declaring its base/size classes.
  - `mention-input`'s field now composes `<x-ui.textarea>` (inherits sizing/`aria-invalid`).
  - The three menu families (`dropdown-menu`, `context-menu`, `menubar`) now share `menu-*` leaf
    primitives (item/checkbox-item/radio-item/separator/label/shortcut/group); rendered HTML is
    unchanged. ~21 duplicated leaf files collapsed onto 7 shared primitives.
  - `autocomplete` and `combobox` now share one Alpine listbox engine; `combobox` gained a
    `trigger="input"` variant covering the inline-autocomplete use-case.

### Deprecated
- **`autosize-textarea`** → merged into `textarea`. Use `<x-ui.textarea :max-rows="…">`; the tag
  remains as a thin alias. (Textarea gained `rows`/`maxRows` and `autosize`/`sizes`/`with-color` variants.)
- **`autocomplete`** → merged into `combobox`. Use `<x-ui.combobox trigger="input">`; the tag remains
  as a thin alias. (Combobox gained inline-input / multi-select / async variants.)

### Removed
- **`quantity-selector` component removed** — it duplicated `number-input` (same control, just
  integer-only with a `min`/`value` of 1 and a tighter footprint), bloating the API surface and
  the docs ([#3](https://github.com/anousss007/blatui/issues/3)). Build a cart/product stepper
  with `number-input` instead (`<x-ui.number-input :min="1" size="sm" />`); a "Quantity selector"
  usage example now lives on the number-input docs page, linked from the e-commerce section.

## [1.13.2] - 2026-06-16

### Changed
- **Rebrand to the `anousss007/*` Composer vendor**: every install command, doc, badge and the
  footer link now reference `anousss007/blatui`. The product is still BlatUI, and all
  `github.com/anousss007` URLs and the `io.github.anousss007/blatui` MCP namespace are unchanged.

## [1.13.1] - 2026-06-16

### Fixed
- **Mobile responsiveness** (full 156-component audit at 320 / 360 / 390 px): `audio-player`
  no longer overflows narrow screens — the seek bar shrinks (`min-w-0`) and the fine volume
  slider hides below `sm` (the mute button stays). The horizontal `stepper` rail now scrolls
  instead of overflowing. The `scroll-area` and `onboarding-tour` examples and the site header
  fit down to 320 px. Components are clean at 360 px+.

## [1.13.0] - 2026-06-15

### Added
- **Form components**: `number-input` (numeric spinbox with min/max/step), `tags-input`
  (chip entry with form-array submission), `color-picker` (hue slider + validating hex
  field + preset swatches), `password-strength` (live 4-segment meter + requirements
  checklist), `file-upload` (drag-and-drop dropzone with image thumbnails, sizes and
  per-file progress), `autosize-textarea` (grows to fit content) and `editable`
  (click-to-edit inline text).
- **AI components** (new **AI** category): `chat` (composable message thread), `prompt-input`
  (AI composer with ⌘↵), `streaming-text` (token-by-token reveal), `reasoning` (collapsible
  chain-of-thought), `tool-call` (tool invocation card) and `citation` (inline source popover).
- **Data display**: `stat` (KPI card with trend + sparkline), `tree` (keyboard-navigable
  tree-view), `json-viewer` (collapsible syntax-highlighted JSON) and `description-list`.
- **Effects** (new **Effects** category): `gradient-text`, `number-ticker` (count-up on
  scroll), `border-beam`, `spotlight-card`, `tilt-card`, `flip-card`, `confetti`,
  `dot-pattern`, `grid-pattern` and `aurora`. Self-contained (scoped keyframes), motion
  respects `prefers-reduced-motion`.
- **Layout**: `container`, `stack` (flex primitive), `bento-grid` (+ `bento-item`),
  `page-header` and `visually-hidden` (sr-only / skip-link).
- **Navigation**: `scrollspy` (table of contents), `bottom-navigation` (mobile tab bar),
  `dock` (magnifying macOS dock), `speed-dial` (FAB) and `back-to-top`.
- **More data display**: `avatar-group`, `meter`, `heatmap` (contributions grid), `kanban`
  (drag-and-drop board), `tree-table` (expandable nested rows), `comparison-slider`,
  `masonry` and `diff-viewer` (inline/split).
- **E-commerce** (new **E-commerce** category): `product-card`, `price`, `quantity-selector`,
  `variant-selector` (size pills / colour swatches), `add-to-cart` (stateful) and `mini-cart`.
- **Feedback / overlays**: `cookie-consent`, `top-progress` (NProgress-style bar),
  `loading-overlay` and `notification-center` (bell inbox).
- **More form controls**: `rich-text-editor` (dependency-free WYSIWYG), `markdown-editor`
  (live preview), `signature-pad`, `mention-input` (@-mentions), `segmented-control`,
  `knob` (rotary dial) and `repeater` (field-array).
- **Misc**: `presence` (status dot), `onboarding-tour` (spotlight coachmarks) and
  `infinite-scroll`.
- **Media** (new **Media** category): `audio-player`, `image` (skeleton + blur-up + error
  fallback), `qr-code` (dependency-free client-side SVG generator) and `map` (keyless
  OpenStreetMap embed).
- **Charts-style data display**: `gantt` (project timeline), `scheduler` (week/day agenda)
  and `org-chart`.
- **More effects**: `meteors`, `animated-beam` and `parallax`.

  All of the above are WCAG 2 AA (axe 0, light + dark).

## [1.12.2] - 2026-06-14

### Fixed
- **Submenus no longer clipped** (`dropdown-menu`, `context-menu`, `menubar`) — sub-content now
  teleports to `<body>` with `fixed` positioning instead of living inside the parent panel's
  `overflow-y-auto` clip, so the flyout opens to the side rather than being cut off or forced into
  a scrollbar. A short, cancellable close delay lets the pointer travel from the trigger to the
  teleported flyout without it closing. (#2)

## [1.12.1] - 2026-06-11

### Accessibility
A full axe-core (WCAG 2.1 A/AA) audit across every component and variant page —
**0 critical, 0 serious** violations. Fixes that shipped from it:

- **Status tokens darkened for AA contrast** (`app.css` `:root`): `--destructive`, `--success`,
  `--warning` and `--info` were nudged darker so `text-*` clears WCAG AA 4.5:1 both on white and on
  the `/10` soft tint used by alerts/badges. The solid-fill `*-foreground` pairs are unchanged.
- **`alert`** — dropped the `/90` opacity on `alert-description` text across the destructive variant
  and all status tones, so descriptions meet AA against the tinted background.
- **`kbd`** — `aria-label` is invalid on `<kbd>` (it has no naming role); a passed label now renders
  as visually-hidden `sr-only` text instead, so a symbol like ⌘ can still be spelled out for readers.
- **`time-field`** — an author `aria-label` is now forwarded onto the real `<input type="time">`
  rather than landing on the wrapper `<div>`, so the control is actually named.
- **`select`** — the `:options` shorthand trigger now carries an accessible name (the `placeholder`,
  or "Select option"), since a `combobox` role isn't named by its value text.
- **`data-table`** — the select-all and per-row checkbox buttons now have `aria-label`s.
- **`item-group`** — removed the `role="list"` (its children aren't `listitem`s), which had tripped
  the list-structure rule.

## [1.12.0] - 2026-06-11

### Added
- **`comparison-table`** — a data-driven feature-comparison table (`:tiers` × `:rows` with check /
  dash / text values and a `highlight` column). The pattern templates previously hand-rolled in raw
  `<table>`s, now one component.
- **`accent`** — wrap any subtree in `<x-ui.accent color="#7c3aed">` and every BlatUI component
  inside recolours (buttons, badges, checkboxes, switches, focus rings) — no per-component props.
  Renders as `display:contents` so it never affects layout.
- **`color` prop on `input`, `textarea` and `select`** — brands the focus ring + text selection
  locally (overrides the ring/primary tokens), matching the `button` `color` prop. For whole forms
  or sections, reach for `accent` instead.

### Added
- **Five new components**, drawn from patterns the showcase templates kept hand-rolling:
  - **`countdown`** — a live, timezone-safe countdown to a target date (days / hours / minutes /
    seconds) with an expired state.
  - **`timeline`** + **`timeline-item`** — a vertical timeline with dots, connecting lines, icons,
    timestamps and an `active` marker; the connector auto-hides under the last item.
  - **`terminal`** — a terminal / console window (traffic-light controls, mono body) for command
    output and code demos; intentionally dark in both themes.
  - **`sparkline`** — a tiny inline trend line drawn from a data array (server-rendered SVG),
    theme-token coloured, for KPI cards, tables and stats.
- **`progress` circular / ring variant** — `<x-ui.progress circular :value="72" show-value />`,
  with `size` / `thickness`; recolour via a `text-*` class. Linear behaviour is unchanged.
- **`button` `color` prop** — `<x-ui.button color="#16a34a">` recolours a single button by
  overriding the primary token locally (no bespoke styling). The same trick works for any subtree:
  wrap it in `style="--primary: …"` and every BlatUI component inside recolours.
- **`table` comparison example** — a feature-matrix pattern (tiers × features with check / dash).

### Added
- **Showcase templates** — a new, deliberately extravagant tier of full-page templates, each
  art-directed in a distinct bold style and built to push the component library: **Aurora**
  (dark glassmorphism AI-SaaS with animated aurora gradients), **Quantum** (neon-futurist web3
  dashboard with ApexCharts), **Vinyl** (vibrant retro-editorial music festival), **Brut**
  (neo-brutalist creative studio), **Terroir** (editorial-serif fine dining), and **Bloom**
  (claymorphism wellness). They live in a new **Showcase** category at the top of `/templates`.

### Note
- 1.10.0 is the minor that carries the component additions shipped in the 1.9.x line — the
  `combobox` `disabled` prop (1.9.1) and multi-select `:multiple` on `select` / `combobox` /
  `autocomplete` (1.9.2). No breaking changes.

## [1.9.2] - 2026-06-10

### Added
- **Multi-select (`:multiple`) on `select`, `combobox` and `autocomplete`** — opt in with
  `multiple` and the control accepts many values. Selected entries render as removable chips
  (each with an `×`), picking an option toggles it **without closing the list**, and the dropdown
  shows a check on every selected row. `combobox`/`autocomplete` keep filtering while you pick;
  `autocomplete` becomes a tag input (chips inline before the field, `Backspace` on an empty query
  removes the last chip). Submits as `name[]` (one hidden input per value), so it binds straight to
  a Laravel array field. Initial selection via `:value="['a', 'b']"`. New "Multiple" example on each
  of the three component pages.

### Added
- **`combobox` `disabled`** — the combobox now accepts a `disabled` prop (matching `select` and
  `autocomplete`): it renders the `disabled` attribute on the trigger and dims it
  (`disabled:cursor-not-allowed disabled:opacity-50`), so the listbox can no longer be opened. New
  "Disabled" example on the combobox docs page.

## [1.9.0] - 2026-06-10

### Added
- **Seven new components:** `stepper` (horizontal/vertical multi-step flow with completed-step
  checks), `typography` (prose styles — headings, lead, blockquote, list, inline-code, gradient —
  via one `variant` prop), `data-table`, `autocomplete` (type-ahead input), `phone-input`,
  `input-mask`, and `code-block`. Plus `menubar` sub-menus (checkbox/radio items, nested
  sub-content) and an `alert-action` slot.
- **New variants & props across existing components:** `tabs` `variant` (segmented | underline |
  pills); `table` `variant="card"` + zebra striping; `select` `:options="[value => label]"`
  shorthand; `combobox` `:searchable="false"` (panel now sizes to the trigger); `switch` `size`
  (sm/default/lg) + colour overrides; `toggle` rounded/stat variants; `toggle-group` vertical
  orientation **and** group-level `size`/`variant` (now inherited by every item); `spinner`
  `icon` + colours; `textarea` character-count / no-resize / read-only; `slider` range mode;
  `badge` `size`; `dialog-content` 9 `position`s; `input-otp` `alphanumeric`; `progress`
  `indeterminate`; `rating` `icon`/`color`; `accordion-trigger` `icon`/`icon-position`.
- **`tooltip`:** optional, colour-inheriting, side-aware arrow (`:arrow="false"` to hide);
  `max-width` so long tooltips wrap instead of stretching.
- **`sonner`:** `toast.promise()` and `toast.loading()`, plus action buttons on toasts.
- **`calendar`:** `calendar:set-range` event (push a range from app state) and explicit
  `minDays`/`maxDays` props for range-duration bounds.
- **Docs:** bold footgun callouts on the `button`, `dropdown-menu` and `field` pages.

### Fixed
- **`select` showed the wrong label on selection** — every item shared one ref, so picking any
  option displayed the *last* option's label. Each item now reads its own label.
- **`toggle-group` `size`/`variant` never reached items** — a size/variant on the group rendered
  identically on all items; both now inherit from the group.
- **iOS/Safari `<select>` double arrow** — `.blat-select` now sets `-webkit-appearance: none`.
- **`tooltip` resized/repositioned on open** (dropped `text-balance` + the scale transition).
- **`sonner-flash` i18n** — status strings resolve through `__()` and never leak a raw slug.
- **`dropdown-menu-item`** gains a `type` prop so it can submit a form (`type="submit"`).
- **`field`** error spacing tightened (`gap-2`).

## [1.8.0] - 2026-06-09

### Added
- **Seven new components:** `marquee`, `copy-button`, `banner`, `typewriter`, `text-reveal`,
  `gallery` (thumbnail grid → full-screen lightbox), and `video`. All ARIA-complete, token-driven
  and reduced-motion aware.
- **`input` password & icon affordances:** built-in show/hide eye toggle on `type="password"`
  (opt out via `:toggle="false"`), plus `leading` / `trailing` icon slots with RTL-safe padding.
- **`sonner` collapsed stack + `expand`:** toasts collapse and fan out on hover/focus; `expand`
  keeps them always expanded.
- **`dialog` `fullscreen` variant** — edge-to-edge takeover.
- **Carousel swipe** — touch/pen swipe to change slides (`swipe` prop, on by default).
- **`blatui:doctor`** scans compiled views for leaked literal `<x-ui.*>` tags; getting-started
  callout on the `@aware`-slot compile footgun + the `.blat-*` foundations utilities.

### Fixed
- **Vertical carousel** paged by the whole stack height instead of one slide (the vertical track
  now uses `h-full`; vertical carousels need a height on `<x-ui.carousel-content>`).
- **Duplicate toasts** when `<x-ui.sonner>` was mounted more than once on a page.

### Changed
- `sonner` is now a **singleton** per page (first-mounted toaster wins). `window.toast` API unchanged.

## [1.7.0] - 2026-06-08

### Added
- **`out-of-range` mode on `date-picker` / `datetime-picker` / `calendar`** — `disable` (default:
  out-of-range dates are struck-through and unselectable) or `flag` (selectable but shown red, and
  selecting one flags the field invalid). `min`/`max` now act as real date bounds on the calendar
  (previously they were span counts and didn't gate single-date selection). Verified in-browser.

## [1.6.6] - 2026-06-08

### Fixed
- **`date-picker` / `datetime-picker` selection wasn't saved to the input** after the teleport
  (calendar's `calendar-change`/`time-change` bubbled to `<body>`, not the picker root). Moved
  the listeners inside the teleported popover. Verified in-browser.

## [1.6.5] - 2026-06-08

### Fixed
- **Calendar outside-day status was stale after month navigation** (`isOutside(day, m)` used the
  outer-loop `m`, which goes stale in nested per-cell bindings). The panel month is now stamped
  on each day in `weeksFor`. Fixes `show-outside-days="false"` rendering a near-empty grid after
  navigating to another month. Verified in-browser across months.

## [1.6.4] - 2026-06-08

### Fixed
- **`show-outside-days="false"` works correctly** (1.6.3's Alpine-expression version broke the
  grid). Reworked to pure CSS (`data-hide-outside-days` + `:has()`): hides prev/next-month days
  and collapses fully-outside week rows.
- **Disabled days are clearly distinct** — out-of-range days (with `min`/`max`) now render
  struck-through and fainter, vs. just slightly muted before.

### Added
- **`week-start` accepts a day name** (`"monday"`) as well as `0–6` (0 = Sunday).

## [1.6.3] - 2026-06-08

### Added
- **`show-outside-days` (default true)** on `calendar`, `date-picker` and `datetime-picker`.
  `false` hides the prev/next-month filler days and collapses fully-outside week rows.

## [1.6.2] - 2026-06-08

### Fixed
- **Popover clipping.** `date-picker` / `datetime-picker` / `combobox` teleport their popover to
  `<body>` so an `overflow-hidden` ancestor (card, table cell, the docs preview) no longer crops
  them. The docs example `<x-preview>` also no longer clips overflowing popovers.

## [1.6.1] - 2026-06-08

### Fixed
- **`registerBlatUI` no longer auto-applies OS dark.** New `darkMode` option
  (`'class'` default / `'system'` / `false`); the demo opts into `'system'`. Fixes light-only
  apps flipping to an unreadable dark on a dark-OS machine.
- **Deploy: end the storage/cache permission fights.** New `deploy/server-setup.sh` (one-time:
  shared `www-data` group + setgid + `umask 002` + `opcache.revalidate_freq=0`); `deploy.sh`
  no longer `chmod`s `www-data`-owned files — no more `Operation not permitted`, no manual
  php-fpm reload.

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
  commands — the `anousss007/blatui` package is the sole CLI owner.

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
