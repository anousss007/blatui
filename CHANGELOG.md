# Changelog

All notable changes to the **BlatUI** package are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [Unreleased]

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

[Unreleased]: https://github.com/anousss007/blatui/compare/v1.1.0...HEAD
[1.1.0]: https://github.com/anousss007/blatui/compare/v1.0.0...v1.1.0
[1.0.0]: https://github.com/anousss007/blatui/releases/tag/v1.0.0
