# Changelog

All notable changes to the **BlatUI** package are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

## [1.24.4] - 2026-08-13

### Fixed
- **A popover whose trigger is replaced under it never finds its way back** (#18, the half that
  1.24.3 did not fix). Anchoring hands floating-ui's `autoUpdate` a NODE and keeps it forever. A
  framework that morphs the DOM can decide the trigger is not the same element and swap it for a
  fresh one — Livewire's morph does exactly this, which the reporter traced with Livewire's own
  `morph.*` hooks after a `$this->form->reset()` in a dialog's open handler. From then on the
  popover measures a detached node: 0×0, every time, so it parks in the viewport corner and stays
  there for the life of the page, because nothing will ever resize or scroll the node being
  watched.
  `x-blat-anchor` now notices its reference has left the document and re-resolves the expression,
  rebinding `autoUpdate` to the live node. Alpine's `x-ref` registry follows the swap, so the
  expression yields the new element; the popover itself is still observed, which is what gets us
  back into a reposition when it is next shown. No `wire:ignore` needed on the consumer's side —
  and unlike that workaround, server-driven changes to `:options` keep reaching the component.
  This needs no Livewire to reproduce: replacing the trigger node on a plain page did it, which is
  what the new regression check does (before: panel at 8,4 with the trigger at 668,432).
- **The same fragility in every other floating component.** `popover-content`, `tooltip-content`,
  `hover-card-content`, `menubar-content`, `menubar-sub-content`, `context-menu-sub-content`,
  `dropdown-menu-sub-content`, `navigation-menu-content`, `mini-cart` and `notification-center`
  were still on Alpine's `x-anchor`, which resolves its reference once and has no way to recover.
  All ten now use `x-blat-anchor`, so the whole registry survives a morph and positions the same
  way everywhere.

### Added
- **`.absolute` and `.pad N` modifiers on `x-blat-anchor`** — what the two page-level popovers
  needed to migrate without moving a pixel. `mini-cart` and `notification-center` can sit open
  while the page scrolls their trigger off screen, and under the default `fixed` strategy `shift()`
  then pins the panel to the viewport edge, stranded from what it belongs to (the visual suite
  caught exactly this: the notification panel jumped 500px up the page). `.absolute` keeps them in
  document coords, and `.pad 5` keeps the 5px viewport gutter Alpine's `x-anchor` gave them —
  without it the migration would have shifted them 3px, which at a 320px viewport is a visible
  change to a 320px-wide panel for no reason. Verified pixel-identical to 1.24.3 for both, at
  320/375/639.
- **`.no-size` modifier on `x-blat-anchor`** — opt out of the height cap. The cap only helps a
  popover that can scroll once capped: the popover itself (`select-content`,
  `dropdown-menu-content`) or an inner scroller it can shrink (`date-picker`, `combobox`). On a
  tooltip, a hover card or a menu that sizes to its items it would only cut content off, so the
  ten components migrated above opt out and keep `flip`/`shift` — behaviour identical to what
  `x-anchor` gave them, plus the recovery.

## [1.24.3] - 2026-08-13

### Fixed
- **`combobox` opened narrower than its trigger inside a dialog** (#18). The panel takes its width
  from the trigger, but it read `$refs.trigger.offsetWidth` once from a Blade `x-bind:style` —
  and nothing in that expression is reactive, so Alpine ran it exactly once, at init. For a
  combobox nested in a dialog that starts closed, that one measurement happens behind
  `display: none`, where the trigger is 0px wide: `min-width` froze at `0px` for the component's
  lifetime and the `w-fit` panel shrank to its content, on every open, forever.
  The panel now anchors with `x-blat-anchor.…​.match-width` — the same house directive as
  `select-content` and `dropdown-menu-content` — which takes the width from floating-ui's measured
  reference rect on every reposition, so a trigger that was 0px wide at init widens the panel the
  moment it is shown. A 0-wide reference is skipped rather than written as `min-width: 0`.
  Two things came with the move off Alpine's `x-anchor`: the panel is now capped to the space
  actually available (it is a column flex box, so the list scrolls and the search field stays put)
  instead of running off a low viewport, and `flip`/`shift` keep it on screen.
  The report also blamed `x-anchor`'s `absolute` strategy for a popover pinned to the viewport
  corner. That part did not reproduce here — the combobox already passed `.fixed`, which
  `@alpinejs/anchor` maps to `strategy: 'fixed'`, and in a BlatUI dialog the panel anchored
  correctly before this change. The `left: 5px; top: 4px` in the report is real, though: it is
  `shift({padding: 5})` plus the 4px offset against a 0×0 reference — the same
  measured-while-hidden position, which floating-ui's `autoUpdate` normally corrects on open.
  Every other floating component was driven inside a dialog while checking this — select,
  popover, tooltip, hover-card, dropdown-menu and its submenu — and all of them anchor correctly.
- **Coverage for the shape, not just the bug**: the overlays suite now opens each dialog on a
  page and measures any popover nested inside it against its trigger — beside it, and no narrower
  than it. It fails on the pre-fix combobox (252px panel under a 375px trigger). A
  *Nested in dialog* example on the combobox page gives it something to drive, and documents the
  pattern.

## [1.24.2] - 2026-08-10

### Added
- **Browser acceptance suite** — every component driven in a real Chromium, at every width in
  the breakpoint matrix, wired into CI. The regressions that reached users (#15, #16) were all invisible
  to the markup and engine tests: a leaked class that computed to `display: none`, a tooltip that
  never opened, a rail that could not scroll. The rule in this layer is to assert on *computed
  state after a real interaction*, never on markup.
  - **pages** — all 156 component pages and 64 blocks at 1280px and 375px: no console error, no
    uncaught exception, no failed same-origin request, no `<x-ui.*>` tag leaked into the HTML, no
    `x-cloak` left behind.
  - **overlays** — every trigger → content pair present on a page: open it, require the panel to
    be visibly on screen, close it, require it gone. Plus the disclosure widgets both ways.
  - **controls** — 23 checks across switch, checkbox, radio, tabs, toggle-group, select, combobox
    (including keyboard selection), command, input, textarea, input-otp, number-input, tags-input,
    slider, calendar, date-picker, carousel, context-menu (right-click), navigation-menu (hover),
    stepper, pagination and sonner.
  - **buttons** — clicks every visible button on every documented page and fails if a handler
    throws.
  - **layout** — baseline-free invariants at every width: no sideways page scroll, no component
    squashed to a zero dimension, nothing stranded off-screen, no text spilling its box. This is
    the one that catches *looks broken* rather than *looks different*.
  - **visual** — a 256-bit perceptual fingerprint of every example block, per component per
    width, against a committed baseline. Sensitive enough to catch a 4px padding change, and
    small enough (~70 bytes an entry) that the baseline is a reviewable JSON file rather than
    thousands of PNGs. Renderings that cannot reproduce themselves are detected and reported as
    uncovered instead of made flaky.
  - **sidebar** — its own suite, asserting the mode each width implies, since it has produced
    four separate escapes on its own.

  **Every suite runs at every width in the matrix**: 320, 375, 639, 640, 767, 768, 900, 1023,
  1024, 1280, 1536. Each Tailwind breakpoint is driven at its value *and one pixel below it*,
  because that is where an off-by-one in a min/max pair shows, and 900px is in the list because
  #17 lived between md and lg — in the gap a "phone and laptop" pair walks straight past.

  Targets come from the site's own `sitemap.xml`, so a new component is covered the moment it is
  published, and the same run works against localhost or production.

### Fixed
- **`sidebar-09` threw `active is not defined` on every load** — found by the new suite within
  minutes of it existing, along with two docs previews that threw on click (`$wire` with no
  Livewire runtime, and a clipboard write the headless browser had not been granted).
  `<x-ui.sidebar>` renders its slot twice (docked panel + teleported mobile drawer) but forwarded
  the consumer's `x-data` to only one of them, so the second copy referenced variables that did
  not exist in its scope. The mobile panel now receives the consumer's attributes too, minus the
  handful that must not appear twice in one document (`id`, and the dialog semantics it declares
  itself).
- **`mini-cart` and `notification-center` could push a 320px page sideways.** Both panels are
  `w-80` — exactly 320px — so on the narrowest phones they were wider than the viewport once
  positioned, and the whole page scrolled horizontally. Capped at `calc(100vw - 1rem)`.
  Found by the new layout suite, not by a user.


## [1.24.1] - 2026-08-10

### Fixed
- **`mobileBreakpoint` did not actually move the breakpoint** (#17). 1.24.0 wired the prop to
  `isMobile`, which decides what the trigger toggles — but the two panels are *painted* by CSS,
  and that was still three static `md:` classes pinned to 768px. Between 768px and a configured
  1023px the JS said "mobile" while the CSS kept the rail docked and the drawer hidden, so the
  trigger flipped `openMobile` and nothing appeared. The prop only ever worked for values it did
  not change.
  The `md:` classes stay as the no-JS default — so the docked rail still paints with the page
  instead of popping in after Alpine boots — and `isMobile` now overrides them when the two
  disagree, which is exactly what a breakpoint other than `md` means. The drawer is gated on
  `isMobile` itself, so dragging a window past the breakpoint while it is open closes it rather
  than leaving it floating over the docked rail.
  Guarded at both levels: a render test for the markup contract, and a browser check that drives
  `isMobile` at a desktop width and requires the rail to hide and the drawer to open (it fails on
  the pre-fix component).


## [1.24.0] - 2026-08-10

### Fixed
- **The mobile sidebar drawer never appeared** (#16). Regression introduced in 1.21.0 by the fix
  for #11: `twMerge()` writes the merged class back into the attribute bag it is called on, and
  `sidebar` renders a desktop root *and* a teleported mobile panel from the same bag — so the
  desktop root's `hidden md:block` leaked onto the mobile panel, which was then `display: none`
  below `md`. Clicking the trigger on a phone dimmed the page and showed nothing. The root
  branches now merge into a copy and leave `$attributes` untouched.
  Reproduced in a real browser before and after; the drawer now slides in, traps focus, and closes
  on Escape. The report suspected an `x-trap` / `x-show` race on the panel — that was a red
  herring, the two directives coexist fine. CONTRIBUTING documents the mutation, and a render test
  fails if desktop classes ever reach the mobile panel again.

### Added
- **`mobileBreakpoint` on `sidebar-provider`** (#16). The off-canvas drawer was hardwired to
  `(max-width: 767px)`, so on tablets the sidebar could only collapse to the icon rail, never hide.
  `<x-ui.sidebar-provider mobile-breakpoint="1023px">` moves that threshold; a bare number is read
  as px, anything else is passed to `matchMedia` as written. Default unchanged.

## [1.23.0] - 2026-08-07

### Added
- **`tooltip` on `sidebar-menu-button`** (#15). Collapsed to the icon rail a menu button shows
  nothing but its icon; `<x-ui.sidebar-menu-button tooltip="Inbox">` labels it on hover and focus,
  and only while the rail is collapsed on desktop — opt-in per button, as in shadcn/ui. The
  shipped `nav-main` / `nav-secondary` blocks now pass it, so `sidebar-07` demonstrates the
  collapsed behaviour it was always meant to.
  Note it is a *visual* affordance: the label `<span>` stays in the DOM when the button shrinks,
  so the accessible name never depended on this.
- **`state` on `tooltip-content`** — the Alpine expression driving visibility, defaulting to the
  `open` that `<x-ui.tooltip>` owns. It exists because a sidebar menu button is routinely nested
  in a `<x-ui.collapsible>` that owns `open` for itself.

### Fixed
- **The sidebar could not be scrolled once collapsed** (#15). `sidebar-content` clipped overflow
  in both axes on the icon rail, so with enough groups the bottom items were unreachable. Only the
  horizontal axis is clipped now. The rail's scrollbar is hidden rather than given room: a classic
  (non-overlay) scrollbar takes ~16px out of a 3rem rail and squeezes the `size-8` buttons against
  its track, and widening the rail for everyone would move layout on the many platforms where
  scrollbars are overlays and nothing was wrong. Wheel, trackpad and Tab all still scroll it.
- **`collapsed` state is safe to read from nested Alpine scopes.** The provider exposes it as a
  plain property synced with `x-effect`, deliberately not a getter: Alpine's `mergeProxies` passes
  the *reading* scope as a getter's receiver, so `!this.open` inside one would resolve against
  whatever tooltip or collapsible read it — inverting the result in our own `sidebar-07` block.
  Diagnosed by @cmdevpe before it shipped.

## [1.22.0] - 2026-08-05

### Added
- **`blatui:update --ignore-whitespace`** (#11). A project that runs Pint or Prettier over
  `resources/views` reformats the components it copied, and a byte comparison then reports every
  one of them as changed — in the first real-world run, 21 of 31 differing files were formatter
  noise, which buried the 10 that had actually drifted. Files whose content matches once
  whitespace is dropped are now counted on their own line (*same content, reformatted*) and, with
  the flag, treated as up to date. The default stays byte-exact — that is the only honest answer
  to "is this the file we ship?" — but it now names the noise instead of leaving you to spot it,
  and points at the flag. It forgives layout only: reordered Tailwind classes, flipped quotes and
  added trailing commas still read as drift, because nothing distinguishes them from a real edit.

### Changed
- **Geometry that was hardcoded in `rem` now tracks `--spacing`** (#14, diffs contributed by
  @cmdevpe): the `switch` track height, the `calendar` day-cell size, and both `sidebar-provider`
  widths (expanded + collapsed rail, which has to keep matching the `size-8` menu button inside
  it). Each factor is chosen so the computed value is identical at Tailwind's default
  `--spacing: .25rem`, so nothing moves unless you change the spacing scale; a test locks that
  arithmetic. The two remaining candidates (`tabs-list`'s `p-[3px]`, the `translate-y-[2px]`
  checkbox nudge in `table-cell`/`table-head`) are deliberately left absolute: they are px, and a
  rem-derived replacement only matches them at a 16px root font size — it would change rendering
  for anyone using a larger root, without touching `--spacing` at all.

## [1.21.0] - 2026-08-05

### Added
- **`closeOnOverlay` on `dialog-content`, `sheet-content` and `drawer-content`** (#12). The
  backdrop click handler was hardcoded, so keeping a modal open on an outside click meant forking
  the component. `<x-ui.dialog-content :close-on-overlay="false">` gives you a static backdrop — a
  long form or a multi-step flow a stray click shouldn't discard. It governs the backdrop and
  nothing else: Escape and the close (X) button stay wired, because a modal you can't leave from
  the keyboard is a trap. All three components got it rather than `dialog` alone — they shared the
  same hardcoded handler, and fixing one would have created the very inconsistency the report was
  about. `alert-dialog` is unchanged: it never closed on an outside click, by design.
- **`blatui:update` — an update path for components you already own** (#11). `blatui:add --force`
  was the only way to re-sync an installed component, and it overwrote the file with no diff, no
  prompt and no backup — the one destructive corner of the copy-not-dependency model. The new
  command compares every installed file against the stub this version ships and, for anything that
  differs, prints the diff and asks before writing:
  ```bash
  php artisan blatui:update --dry-run --diff   # what would change, writes nothing
  php artisan blatui:update                    # confirm file by file
  php artisan blatui:update button --force     # no questions; your copy is kept as .bak
  ```
  It needs no lockfile and writes no state into your app: the package ships the exact stubs, so a
  byte comparison answers the question. What it deliberately does *not* do is guess *why* a file
  differs — a customisation and an outdated copy look identical on disk — so a differing file is
  never overwritten silently, and `--force` still leaves a `.bak` next to it (`--no-backup` opts
  out). Files a family gained in a newer release are added without prompting.
- **`--success` / `--warning` / `--info` (+ their `-foreground`) and `--font-heading` are now part
  of the theme export.** The theme editor's *Copy CSS* is meant to hand you a complete `app.css`;
  it dropped the status palette and the heading font — so a theme whose heading font you had just
  picked in the editor silently reverted to the body font on paste, and `bg-success`/`text-warning`
  utilities stopped existing altogether. The exported scaffold is now generated from `app.css` and
  guarded by a test — it had also fallen behind on the `progress-indeterminate` animation, so an
  indeterminate `<x-ui.progress>` stood still in a pasted theme.

### Fixed
- **`sonner` emitted two `class` attributes.** The toaster root carried a literal `class="…"` next
  to a bare `{{ $attributes }}`, which is invalid HTML — a class passed to `<x-ui.sonner>` was
  dropped by the browser. It now merges through `twMerge`. A test sweeps every shipped component
  for the same shape so the next one fails in CI instead of in your app.
- **`<x-ui.sidebar>` discarded its attribute bag.** In the collapsible (default) branch the bag was
  never rendered, so `class`, `id` and Alpine bindings passed by a consumer vanished. The desktop
  root now forwards the full bag; the teleported mobile panel mirrors the classes only (a second
  `id` would collide).
- **A bundled `block` dependency of a remote item landed in `components/ui`.** `RemoteInstaller`
  hardcoded the `ui` directory instead of resolving each family's own target, so a `<x-block.*>`
  piece pulled in as a dependency was written where Blade would never resolve it.
- **The MCP server reported its version as `dev`.** It read a `version` field out of the package's
  `composer.json`, which Composer's own conventions say should not be there; it now asks Composer's
  installed-packages metadata for the real tag.

## [1.20.0] - 2026-08-04

### Added
- **`calendar` controlled mode.** The root now carries `x-modelable="value"`, so a parent can
  drive *and* observe the whole selection with plain Alpine two-way binding:
  `<x-ui.calendar mode="range" x-model="stay" />`. The parent's value wins on mount and the
  binding stays live in both directions — a popover no longer has to stay mounted just so it can
  be re-seeded on every open. `value` is `'Y-m-d'|null` (single), `['Y-m-d', …]` (multiple) or
  `{ from, to }` (range). See the new **Controlled** calendar example.
- **`calendar` instance handle.** New `calendar-id` prop (defaults to the element `id`). It
  renders as `data-calendar-id`, aims the incoming `calendar:*` hooks at one instance when they
  are broadcast on `window` (`detail.id`), and is echoed on every outgoing `calendar:updated`.
  Pages that run several calendars at once — a range picker in a sticky sidebar plus one in a
  mobile sheet — can finally address them individually instead of hitting all of them.
- **`calendar:updated` event.** Bubbling, `composed`, fired on *every* change with
  `{ id, mode, value, source }` where `source` is `select` (a user pick), `set`, `set-range`,
  `today`, `clear` or `value` (a controlled write). This is the event to listen to when you need
  to mirror programmatic changes; `calendar-change` remains the "the user picked a day" event.
  It is named `updated`, not `change`, on purpose: `calendar:change` would have differed from the
  existing `calendar-change` by one character — indistinguishable in review and inseparable in a
  grep. `calendar:*` is now the structured API (in: `set` / `set-range` / `today` / `goto` /
  `clear`, out: `updated`); `calendar-change` is the historical user-pick event.
- **`calendar:goto` and `calendar:clear` hooks.** `calendar:goto` moves the visible month(s)
  without selecting (`'Y-m'`, `'Y-m-d'`, a `Date` or `{ month, id? }`) and is the one hook that
  works in every mode — it replaces the incidental view-scrolling the selection hooks used to do
  in the wrong mode. `calendar:clear` empties the selection in any mode.
- **Engine tests.** `apps/demo/tests/js/calendar.test.mjs` locks the calendar's event and
  targeting contract. Zero-dependency: `node --test "apps/demo/tests/js/*.test.mjs"`, also run
  in CI.
- Documented **`prevMonthLabel` / `nextMonthLabel`** and added an **Events** table to the API
  reference generator (`docs-api` files may now declare an `events` key).

### Changed
- **BREAKING (behaviour): an incoming `calendar:*` hook no longer emits `calendar-change`.**
  `calendar:set`, `calendar:set-range` and `calendar:today` used to re-emit the very same event a
  day click emits, so any popover that seeded itself on open closed again on the click that
  opened it as soon as the seeded value was complete — and every consumer had to carry a
  `syncing` flag to work around it. Seeding is not a pick: those hooks now emit `calendar:updated`
  (with the source that caused it) and nothing else. If you were relying on the old behaviour,
  listen for `calendar:updated` and check `$event.detail.source`. `date-picker`'s internal
  `_keepOpen` flag is gone as a result.
- **BREAKING (behaviour): incoming hooks test the mode before touching the view.**
  `calendar:set` / `calendar:today` previously moved the visible month in *every* mode and only
  then checked that the calendar was in `single` mode — so a birthday picker seeding `1991`
  dragged an unrelated range calendar 35 years back. They are now a complete no-op outside their
  mode. Use `calendar:goto` when you want to move the view regardless of mode.
- **Seeding no longer re-homes a view the user navigated.** A programmatic selection scrolls the
  grid only when the seeded date isn't already on screen.
- `date-picker` and `datetime-picker` now listen for `calendar:updated`, so their label and hidden
  inputs stay in step when the calendar is driven from outside.

### Fixed
- **`calendar` leaked its `window` listeners.** The three incoming hooks were bound to `window`
  and never unbound, so every Livewire re-render or SPA navigation left another live listener
  behind, and destroyed calendars kept reacting to broadcasts. The component now unbinds on
  `destroy()`.
- **`calendar` arrow keys did not mirror under `dir="rtl"`.** The grid is built from logical
  properties, so RTL renders it mirrored — the next day sits to the *left* of the current one —
  but `ArrowLeft` still moved to the previous day, i.e. visually to the right. Arrow keys are
  visual in the APG grid pattern, so they now follow the rendered direction. `Home` / `End` are
  unchanged: "first/last day of the week" is a logical position and must not flip.
- **`calendar` day `aria-label`s were hardcoded English.** "Today, …" and ", selected" ignored
  the app locale; they are now the localisable `today-label` / `selected-label` props (defaults
  `__('Today, :date')` / `__('selected')`). The month and year dropdown `aria-label`s in
  `caption-layout="dropdown"` go through `__()` as well.

## [1.19.0] - 2026-08-01

### Added
- **Block components are now first-class, installable items** (`nav-user`, `nav-main`,
  `nav-projects`, `nav-secondary`, `team-switcher`, `version-switcher`, `search-form`,
  `file-tree`). These are the `<x-block.*>` pieces the dashboard/sidebar blocks compose. They
  ship with the package (`stubs/block/`), install to `resources/views/components/block/`, and are
  reachable via `php artisan blatui:add nav-user`, the registry index, and `/r/nav-user.json`.
  Fixes [#10](https://github.com/anousss007/blatui/issues/10) — 14 blocks referenced these
  components, but none were shipped or installable, so a copied block threw
  `Unable to locate ... component [block.nav-user]` on render.

### Fixed
- **Block `registryDependencies` were incomplete.** The dependency scanner matched `<x-ui.*>`
  only, silently dropping every `<x-block.*>` reference — so `sidebar-07` advertised
  `breadcrumb, separator, sidebar` but not the four block components it actually needs. It now
  scans both namespaces, in the manifest, the HTTP registry, and the MCP client.
- **MCP `install_command` no longer emits commands it knows will fail** — unknown names are
  reported separately instead of being folded into the `blatui:add` line.

## [1.18.0] - 2026-07-28

### Added
- **Localisable registry labels.** Components that previously hardcoded English UI text now route
  it through `__()` with an override prop (falling back to the translation key). `pagination-previous`
  / `pagination-next` gained `label` + `aria-label`; `sidebar-trigger` gained `label`; `calendar`
  gained `prev-month-label` / `next-month-label`. Existing usage is unchanged (English defaults).

### Changed
- **RTL: registry migrated to logical properties.** ~30 `ui/` components moved from physical
  direction utilities to logical ones (`pl/pr→ps/pe`, `ml/mr→ms/me`, `left-/right-→start-/end-`,
  `border-l/r→border-s/e`, `rounded-l/r→rounded-s/e`, `text-left/right→text-start/end`), with
  `rtl:rotate-180` on directional chevrons. Indentation, check/radio indicators, sub-menu chevrons,
  sidebar affordances and table sticky-action columns now flip correctly under `dir="rtl"`.
  Genuinely physical mechanics (carousel scroll gutter, symmetric slider handle, LTR diff gutter)
  and explicit side/position-prop APIs (sheet/drawer/sidebar `side`, dialog/sonner `position`) are
  intentionally left physical.

### Fixed
- **`calendar` selection not always repainting.** A programmatic `calendar:set` updated state
  reliably, but the day's `data-selected` highlight only appeared after some month navigations —
  the grid's `x-for` used positional keys, so navigated cells were reused and their selection
  bindings went stale. The month/week/day loops are now keyed by date (`fmt(m)` / `fmt(week[0])` /
  `fmt(day)`), so a navigation mounts fresh cells that re-evaluate the selection deterministically.

## [1.17.1] - 2026-07-22

### Fixed
- **`qr-code` scaling.** The SVG bound its `viewBox` via a plain `:viewBox`, which the HTML
  parser lowercases to `viewbox` — silently ignored since SVG's `viewBox` is case-sensitive.
  With no valid viewBox the code rendered at ~1px per module instead of filling `size`. Now
  bound with Alpine's `.camel` modifier (`:view-box.camel="viewBox"`) so it scales to any
  `size`, crisp and scannable.

## [1.17.0] - 2026-07-14

### Added
- **`server-table` component.** New server-driven table for Livewire-backed data — sorting,
  search, and pagination are handled on the server rather than client-side, so it scales past
  the in-memory limits of `data-table`. Pulls in `button`, `dropdown-menu`, and `input`.
- **`data-table` row actions.** New `actions` slot renders a trailing actions column. It sits
  inside the Alpine `x-for`, so the current row is available as `item.r` (row data) and `item.i`
  (index) — wire buttons straight to Livewire, e.g.
  `x-on:click="$wire.edit(item.r.id)"`. Accompanied by three new props: `rowKey` (row-data key
  used for stable `:key`s and passed through to the actions slot, default `id`), `actionsLabel`
  (sr-only header for the actions column, default `Actions`), and `stickyActions` (freeze the
  actions column to the right edge on horizontal scroll).

### Improved
- **`data-table` accessibility.** Header cells now carry `scope="col"`, sortable headers expose
  `aria-sort`, decorative sort/check icons are marked `aria-hidden`, and the select/sort controls
  gain visible `focus-visible` rings. Row keys are now stable via `rowKey` instead of the paged
  index.

## [1.16.0] - 2026-07-03

### Added
- **`date-picker` presets.** New `presets` prop renders a quick-pick panel beside the calendar.
  Pass `true` for sensible defaults per mode, or an array mixing named keys (`today`, `yesterday`,
  `tomorrow`, `thisWeek`, `lastWeek`, `last7Days`, `last14Days`, `last30Days`, `thisMonth`,
  `lastMonth`, `thisYear`, `yearToDate`, `allTime`) with fully custom entries
  (`'My label' => ['from' => 'Y-m-d', 'to' => 'Y-m-d']` or `['date' => 'Y-m-d']`). Dates resolve
  client-side relative to *today*, so a cached view never serves a stale range. Applying a preset
  keeps the popover open so the selection stays visible and adjustable.
- **`select` / `combobox` indicator variants.** New `indicator` prop (`check` | `checkbox` |
  `radio`) controls how a selected option is marked in the list — a trailing check (default,
  unchanged), a checkbox box (pairs with `multiple`), or a radio dot (pairs with single-select).
  On the compositional select API, set `indicator` on `<x-ui.select-content>` and it cascades to
  every `<x-ui.select-item>` via `@aware`.

### Changed
- **Calendar external hooks are now element-scoped as well as global.** `calendar:set` /
  `calendar:set-range` / `calendar:today` bind to both `window` (unchanged, backward-compatible)
  and each calendar's own root element. A non-bubbling dispatch on one calendar targets only that
  instance — so the new date-picker presets work correctly with several pickers on one page.

## [1.15.3] - 2026-06-28

### Fixed
- **`darkMode: false` no longer strips the `dark` class** ([#4](https://github.com/anousss007/blatui/issues/4)).
  The theme store's `apply()` ran `classList.toggle('dark', false)` on every page load even when dark
  mode was disabled, removing a `dark` class set by the host app (e.g. Flux) and causing a dark→light
  flash on full refresh. `darkMode: false` now means *hands off* — BlatUI never touches the `dark`
  class, so it coexists with apps that drive their own dark mode. (`'class'`/`'system'` unchanged.)
- **Theme CSS export no longer emits `@import 'tw-animate-css'`** ([#4](https://github.com/anousss007/blatui/issues/4)).
  `tw-animate-css` was dropped as a dependency (components animate via Alpine, not CSS keyframes), but
  the "Copy theme CSS" scaffold still imported it — so a pasted theme failed to build with a missing
  package. The scaffold now matches the shipped `app.css` (Tailwind import only).

## [1.15.2] - 2026-06-28

### Fixed
- **Popovers were mis-positioned inside a Flux modal** (follow-up to
  [#5](https://github.com/anousss007/blatui/issues/5)). v1.15.1 relocated the popover into the
  modal's native `<dialog>` so it stopped rendering *behind* it — but it then rendered at the
  dialog's top-left, detached from its trigger, and a tall popover (a calendar, a long
  `select`/`dropdown`) overflowed off-screen. Two causes, both fixed:
  - **Wrong positioning strategy.** Alpine's `x-anchor` defaults to `position: absolute`, whose
    `offsetParent` math is wrong for an element in the browser's top layer. Popovers now position
    with `position: fixed` (viewport-relative — correct in a top-layer `<dialog>` and in `<body>`).
  - **No height fitting.** New `x-blat-anchor` directive (floating-ui `flip` + `shift` + `size`)
    used by the tall popovers (`datetime-picker`, `date-picker`, `select`, `dropdown-menu`) caps the
    popover to the height actually available and lets it scroll, so it can never overflow the
    viewport — while never growing past the component's own `max-h`. The remaining popovers gained
    the `fixed` strategy.
  - Requires the **`@floating-ui/dom`** package (already a transitive dependency of
    `@alpinejs/anchor`; now listed explicitly in the install instructions and `blatui:init`).

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

[Unreleased]: https://github.com/anousss007/blatui/compare/v1.24.4...HEAD
[1.24.4]: https://github.com/anousss007/blatui/compare/v1.24.3...v1.24.4
[1.24.3]: https://github.com/anousss007/blatui/compare/v1.24.2...v1.24.3
[1.24.2]: https://github.com/anousss007/blatui/compare/v1.24.1...v1.24.2
[1.24.1]: https://github.com/anousss007/blatui/compare/v1.24.0...v1.24.1
[1.24.0]: https://github.com/anousss007/blatui/compare/v1.23.0...v1.24.0
[1.23.0]: https://github.com/anousss007/blatui/compare/v1.22.0...v1.23.0
[1.22.0]: https://github.com/anousss007/blatui/compare/v1.21.0...v1.22.0
[1.21.0]: https://github.com/anousss007/blatui/compare/v1.20.0...v1.21.0
[1.20.0]: https://github.com/anousss007/blatui/compare/v1.19.0...v1.20.0
[1.19.0]: https://github.com/anousss007/blatui/compare/v1.18.0...v1.19.0
[1.18.0]: https://github.com/anousss007/blatui/compare/v1.17.1...v1.18.0
[1.17.1]: https://github.com/anousss007/blatui/compare/v1.17.0...v1.17.1
[1.17.0]: https://github.com/anousss007/blatui/compare/v1.16.0...v1.17.0
[1.16.0]: https://github.com/anousss007/blatui/compare/v1.15.3...v1.16.0
[1.15.3]: https://github.com/anousss007/blatui/compare/v1.15.2...v1.15.3
[1.15.2]: https://github.com/anousss007/blatui/compare/v1.15.1...v1.15.2
[1.15.1]: https://github.com/anousss007/blatui/compare/v1.14.1...v1.15.1
[1.14.1]: https://github.com/anousss007/blatui/compare/v1.14.0...v1.14.1
[1.14.0]: https://github.com/anousss007/blatui/compare/v1.13.2...v1.14.0
[1.13.2]: https://github.com/anousss007/blatui/compare/v1.13.1...v1.13.2
[1.13.1]: https://github.com/anousss007/blatui/compare/v1.13.0...v1.13.1
[1.13.0]: https://github.com/anousss007/blatui/compare/v1.12.2...v1.13.0
[1.12.2]: https://github.com/anousss007/blatui/compare/v1.12.1...v1.12.2
[1.12.1]: https://github.com/anousss007/blatui/compare/v1.12.0...v1.12.1
[1.12.0]: https://github.com/anousss007/blatui/compare/v1.9.2...v1.12.0
[1.9.2]: https://github.com/anousss007/blatui/compare/v1.9.0...v1.9.2
[1.9.0]: https://github.com/anousss007/blatui/compare/v1.8.0...v1.9.0
[1.8.0]: https://github.com/anousss007/blatui/compare/v1.7.0...v1.8.0
[1.7.0]: https://github.com/anousss007/blatui/compare/v1.6.6...v1.7.0
[1.6.6]: https://github.com/anousss007/blatui/compare/v1.6.5...v1.6.6
[1.6.5]: https://github.com/anousss007/blatui/compare/v1.6.4...v1.6.5
[1.6.4]: https://github.com/anousss007/blatui/compare/v1.6.3...v1.6.4
[1.6.3]: https://github.com/anousss007/blatui/compare/v1.6.2...v1.6.3
[1.6.2]: https://github.com/anousss007/blatui/compare/v1.6.1...v1.6.2
[1.6.1]: https://github.com/anousss007/blatui/compare/v1.6.0...v1.6.1
[1.6.0]: https://github.com/anousss007/blatui/compare/v1.5.0...v1.6.0
[1.5.0]: https://github.com/anousss007/blatui/compare/v1.4.0...v1.5.0
[1.4.0]: https://github.com/anousss007/blatui/compare/v1.3.2...v1.4.0
[1.3.2]: https://github.com/anousss007/blatui/compare/v1.3.1...v1.3.2
[1.3.1]: https://github.com/anousss007/blatui/compare/v1.3.0...v1.3.1
[1.3.0]: https://github.com/anousss007/blatui/compare/v1.2.0...v1.3.0
[1.2.0]: https://github.com/anousss007/blatui/compare/v1.1.0...v1.2.0
[1.1.0]: https://github.com/anousss007/blatui/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/anousss007/blatui/releases/tag/v1.0.0
