# Component Consolidation Plan

> **Goal.** Reduce near-duplicate components by merging similar ones into a single
> primitive that exposes its richness through **variants and props**, not through
> N separate components. Express the library's breadth as *"1 component, many
> variations"* instead of *"many components that secretly do the same thing"*.
>
> Triggered by [issue #3](https://github.com/anousss007/blatui/issues/3). This is a
> **planning document** — no component code is changed by this commit. Work lands in
> phased PRs off `refactor/component-consolidation`.

---

## 0. Principles (the contract every component must follow)

These become the acceptance criteria for the refactor *and* for all future components.

1. **Never re-declare a primitive.** If a component needs a button, an input, a
   textarea, a badge, a calendar — it **composes** `<x-ui.button>` etc. It does **not**
   copy that primitive's class string, size map, or variant logic. Copy-pasting a
   primitive's styling is a bug, not a feature.
2. **One source of truth per concept.** The base field class, the menu-item class, the
   overlay teleport/anchor/transition scaffold each live in exactly **one** place.
3. **Shared API vocabulary.** Across every component, the same concept uses the same
   prop name, type and default:
   - `size` → `sm | default | lg` (and `xs`, `icon*` where relevant)
   - `color` → local-token brand override
   - `disabled` → `bool`, default `false`
   - `name`, `id`, `placeholder`, `value` → consistent passthrough vs declared-prop policy
   - `rows` / `maxRows` → the textarea sizing contract
   No more `minRows` vs `rows`, no more `disabled` working on one twin and silently
   ignored on another.
4. **Breadth = variants, not components.** When two components are the same control with
   different defaults/skins, collapse them into one and surface the difference as a
   documented **example/variant** (the docs already render `examples/<slug>/*.blade.php`
   as variant sections — see `resources/views/docs/component.blade.php`). Consolidation
   *reduces* the component count while *growing* the variant count — a better story for
   the "608 variants" headline.
5. **Copy-paste stays intact.** This is a shadcn-style library — users own the files they
   `blatui:add`. Composition is safe because the **registry already models dependencies**
   (`BlatuiRegistry::dependenciesFor()` parses `<x-ui.X>` usage), so `blatui:add product-card`
   already pulls `badge button price rating`. Composing on real primitives *improves* the
   copy-paste model; it does not break it.
6. **Don't over-merge.** A shared visual idiom is **not** a reason to merge when the
   semantics differ. `meter` (`role="meter"`) and `progress` (`role="progressbar"`) stay
   separate — see §6.

### Baseline metric (today)
- **170** component families. **20 (11%)** compose another component. **150 (88%)** are
  fully standalone. Target after the refactor: raise composition materially and cut the
  duplicated-class-string count to ~zero, *without* dropping real capability.

---

## 1. Audit summary (what we're acting on)

Evidence gathered from the component source under
`resources/views/components/ui/`. Each cited example from issue #3 was verified:

| Cluster | Verdict | Action |
|---|---|---|
| `textarea` / `autosize-textarea` / `mention-input` | **Confirmed** — base class copied 3×, already drifting (mention lost `aria-invalid`); incompatible APIs (`minRows` vs `rows`, `disabled` ignored on mention, `size`/`color` partial) | **Merge + compose** (§2) |
| `add-to-cart` vs `button` | **Confirmed** — ~30–40% copied (`$base`, `$sizes`, default variant); drift (`opacity-50`→`opacity-90`, dropped `aria-invalid`, missing sizes) | **Compose** (§3) |
| Menu families `dropdown-menu` / `context-menu` / `menubar` | **Confirmed, worst by volume** — ~40+ leaf files identical but for `data-slot` | **Shared menu core** (§4) |
| Overlay scaffold (popover/hover-card/tooltip/select/menus/nav) | **Confirmed** — teleport + `x-anchor` + transition copy-pasted everywhere | **Extract `popper` partial** (§5) |
| `autocomplete` vs `combobox` | **Confirmed** — same listbox engine, two prop vocabularies | **Merge into one** (§7) |
| Modal family `dialog` / `sheet` / `drawer` / `alert-dialog` | **Confirmed** — overlay/trap/close/trigger shell duplicated | **Shared modal core** (§8) |
| Input cluster (`input-mask`/`phone-input`/`tags-input`/`command-input`/`sidebar-input`) | **Confirmed** — base field class re-declared 5–6× | **Compose `input` / share base** (§9) |
| `date-picker` vs `datetime-picker` | **Confirmed** — 2nd reimplements 1st's popover shell | **Share date-popover** (§10) |
| `meter` vs `progress` | **False positive** — legitimate WAI-ARIA split | **Keep separate** (§6) |

---

## 2. Cluster A — Textareas → one primitive + variants  *(Phase 1, high ROI)*

**Current:** three files re-declare the base `<textarea>` class string
(`textarea.blade.php:4`, `autosize-textarea.blade.php:15`, `mention-input.blade.php:120`)
with divergent APIs.

**Target:**
- `x-ui.textarea` is **the** styled primitive. It owns the class string, the `$sizes`
  map, `size`, `color`, and a unified sizing contract: `rows` (initial) + `maxRows`
  (optional cap). Native auto-grow stays on by default via `field-sizing-content`; when
  `maxRows` is set, the small Alpine cap snippet (lifted from `autosize-textarea`) kicks in.
- `autosize-textarea` → **removed as a distinct component**; `<x-ui.textarea :max-rows="6">`
  replaces it. Ship a **deprecated thin alias** `autosize-textarea.blade.php` that renders
  `<x-ui.textarea :max-rows="$maxRows" ...>` for one minor version, with a `@deprecated`
  doc note, then delete.
- `mention-input` → **stays a separate component** (the `@`-trigger combobox is a real,
  distinct concern) but its inner field becomes `<x-ui.textarea>` so it inherits styling,
  `size`, `color`, and the `aria-invalid` rules it currently lacks. Only the wrapper +
  suggestion popup + Alpine combobox remain unique.

**Docs / variant story:** the `textarea` page gains variant sections: *Default*, *Autosize
(maxRows)*, *Sizes*, *With color*, *Invalid state*. One component, five variations.

**Breaking-change handling:** `minRows`→`rows` rename on the alias is mapped; existing
`blatui:add autosize-textarea` users keep their copied file untouched.

**Validation:** visual diff of the three at sm/default/lg; verify `aria-invalid`,
`disabled`, and `maxRows` cap; `php artisan blatui:registry:build --check`; package tests.

---

## 3. Cluster B — `add-to-cart` composes `button`  *(Phase 1, high ROI)*

**Target:** `add-to-cart` wraps `<x-ui.button>`, deleting the copied `$base` and `$sizes`
(add-to-cart.blade.php:10–21) and the inline default-variant classes (`:64`). Pass through:
the Alpine `idle→adding→added` state, `:disabled`/`:aria-busy`, and the success color via
button's existing `color` token override. The three icon/label state spans go in the slot;
the `aria-live` region stays. **Keep** add-to-cart as a component — its state machine is
genuine e-commerce value — it just stops re-implementing button.

**Result:** ~30–40% less code, automatic inheritance of all 8 sizes + `aria-invalid`
focus styles, no future drift.

**Validation:** confirm idle/adding/added states render; sizes match button 1:1; live
region announces.

---

## 4. Cluster C — Menu families → shared menu core  *(Phase 3, highest volume, higher risk)*

**Current:** `dropdown-menu-*`, `context-menu-*`, `menubar-*` triplicate ~14 leaf files each
(`*-item`, `*-checkbox-item`, `*-radio-item`, `*-separator`, `*-label`, `*-shortcut`,
`*-group`, `*-content`, `*-sub*`). Item class strings and `closeMenu()` merge logic are
byte-identical; the shared Alpine factory (`blatMenu()`) is *already* extracted — only the
Blade is not.

**Target:** one shared set of menu leaf primitives (`menu-item`, `menu-checkbox-item`,
`menu-radio-item`, `menu-separator`, `menu-label`, `menu-shortcut`, `menu-group`,
`menu-content`) parameterized by `data-slot`/family. The three roots (`dropdown-menu`,
`context-menu`, `menubar`) become thin **trigger-strategy** wrappers (click vs
`@contextmenu="openAt()"` vs `active===id`) composing the shared leaves. ~42 files → ~12.

**Variant story:** "Menu" documented once, with *Dropdown*, *Context*, *Menubar* trigger
variations.

**Risk:** high blast radius (used across templates/blocks). Do it after the scaffold
extraction (§5) so content panels already share a base. Phase carefully, one family at a
time, regression-testing every consumer page.

---

## 5. Cluster D — Overlay scaffold → `popper` partial  *(Phase 2, enables 4/8/10)*

**Current:** popover/hover-card/tooltip/select/menu/nav `*-content` repeat the same
`$placement`/`$anchorAttr` PHP block + `<template x-teleport="body">` + `x-show`/`x-cloak`
+ the 6-line `x-transition` + the `bg-popover … rounded-md border shadow-md` panel.

**Target:** extract `<x-ui.popper>` (anonymous component / partial) taking
`side`, `align`, `sideOffset`, `anchorRef`, and a slot for the panel body; it renders the
teleport + anchor + transition + base panel once. All overlay `*-content` compose it.
Component-specific extras (`tooltip` arrow, `popover` label, dropdown's sidebar-aware
`anchorRef`, context-menu's fixed `x,y`) become props/slots on `popper`.

**Why first:** it's the shared dependency under menus (§4), modals share a sibling shell
(§8), and pickers (§10) reuse it — extracting it de-risks those.

---

## 6. Cluster E — `meter` vs `progress` → KEEP SEPARATE *(no merge)*

Verified **legitimate**: `role="meter"` (static gauge, arbitrary `min`/`max`, ~40 lines of
`low/high/optimum` threshold coloring, `unit`/`aria-valuetext`) vs `role="progressbar"`
(task completion, indeterminate mode, circular SVG variant, `translateX` fill). Only the
~1-line track shell is shared.

**Action:** do **not** merge. Optionally extract the track-shell utility classes
(`relative h-2 w-full overflow-hidden rounded-full`) into a shared constant, and add a doc
note that `showValue` has intentionally different defaults/meanings across the two. This is
the example to cite back to Pedro that we audited rather than rubber-stamped.

---

## 7. Cluster F — `autocomplete` + `combobox` → one component  *(Phase 2)*

**Current:** ~190 lines each, near-identical Alpine listbox engine (`isSelected`,
`matches`, `visible`, `move`, `selectActive`, `select`, `remove`) and identical option/chip
markup; divergent APIs (free-typing input vs button trigger; `placeholder='Search...'`
hardcoded vs i18n `__()`; different widths).

**Target:** one `combobox` with a `trigger` variant (`input | button`) over a shared
listbox engine (extract `blatListbox()` Alpine factory + an option-row + chip partial).
`autocomplete` becomes a **deprecated alias** → `<x-ui.combobox trigger="input">`.
Standardize i18n and width props.

**Variant story:** "Combobox" with *Inline input*, *Button trigger*, *Multi-select*,
*Async* variations.

---

## 8. Cluster G — Modal family → shared modal core  *(Phase 3, higher risk)*

**Current:** `dialog`/`sheet`/`drawer`/`alert-dialog` `*-content` duplicate the
overlay + `x-trap.noscroll.inert` + escape handling + `x-blat-labelledby` + close button;
roots differ only by dispatch event name; triggers are identical but for the slug.

**Target:** one `modal` core (overlay + trap + close + teleport, built on `popper`'s
sibling shell) with positioning/behavior variants: `dialog` = centered, `sheet` = side,
`drawer` = bottom, `alert-dialog` = `role="alertdialog"` + no overlay-dismiss. Surface as
`<x-ui.dialog variant="sheet" side="right">` **or** keep the four names as
variant-preset aliases for back-compat.

**Risk:** high — heavily used. Schedule last among structural merges.

---

## 9. Cluster H — Input cluster → compose `input` / share base field  *(Phase 2)*

**Current:** `input-mask` (comment literally says *"Mirror x-ui.input's styling"*),
`phone-input`, `tags-input`, `command-input`, `sidebar-input`, `input-group-input`
re-declare the `border-input dark:bg-input/30 … focus-visible:ring-[3px]` field styling.
`tags-input` also re-implements autocomplete's multi-select chip code.

**Target:** the base field class lives once (a `@php` partial or an `x-ui.input` the others
compose). Each specialized input composes `<x-ui.input>` or shares the base class. Unify
`tags-input` chips with the combobox multi-select chip partial (§7).

---

## 10. Cluster I — `date-picker` ⊂ `datetime-picker`  *(Phase 3)*

**Current:** `datetime-picker` = `date-picker` + time-field but reimplements the trigger
button, teleported popover and `errors`/`invalid` machinery (good leaf composition of
`calendar`/`time-field`, bad shell duplication).

**Target:** share a `date-popover` partial (trigger + `popper` + error list); `date-picker`
becomes `datetime-picker` with the time section disabled, or both consume the shared shell.

---

## Phasing, sequencing & ROI

| Phase | Scope | ROI | Risk | Why this order |
|---|---|---|---|---|
| **0** | Land principles (§0) + API-vocabulary doc + lint/checklist | — | none | Sets the contract before code moves |
| **1** | Textareas (§2), add-to-cart (§3) | High | Low | Self-contained, immediate proof, validates the variant-docs story |
| **2** | `popper` extraction (§5), input base (§9), autocomplete⇒combobox (§7) | High | Med | Shared scaffolds that later phases depend on |
| **3** | Menus (§4), modals (§8), date pickers (§10) | High volume | High | Big blast radius; do once scaffolds exist |
| **4** | Sweep for the remaining "many more" (editors §, badge/chip, alert/banner) + final metric | Med | Med | Close the long tail; re-measure composition % |

Each phase = its own PR off this branch, each independently shippable.

## Cross-cutting mechanics (every phase)

- **Source of truth:** edit `resources/views/components/ui/*` in `blatui-demo`, then
  `php artisan blatui:registry:build`, then `scripts/sync-package.sh` to the package.
- **Deprecation policy (copy-paste safe):** a merged-away component ships as a thin
  **alias wrapper** for one minor version with a `@deprecated` note in its docs page and a
  CHANGELOG `Deprecated` entry, then is removed in the following minor. Users who already
  `blatui:add`-ed it keep their local file regardless.
- **Registry/docs:** update `config/docs.php` (category lists, descriptions, notes) and add
  the new variant examples under `resources/views/examples/<slug>/`.
- **Validation per phase:** `blatui:registry:build --check`; package `phpunit`; demo
  `php artisan test`; visual check of every consumer block/template; axe-core where a11y
  attributes move (esp. menus/modals).
- **Definition of done for a cluster:** zero re-declared primitive class strings; one
  shared API vocabulary; the breadth preserved as documented variants; all consumers green.

## Success metrics
- Duplicated base-class-string occurrences: **→ 0** for input/textarea/menu-item/overlay-panel.
- Component-family count: **down**; documented variant count: **up or flat**.
- Composition ratio (families that compose a primitive): **up from 11%** substantially.
- No capability regressions; no a11y regressions (roles/labels preserved).
