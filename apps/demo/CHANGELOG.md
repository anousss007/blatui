# Changelog

All notable changes to **BlatUI** are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

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
