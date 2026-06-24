<div align="center">

# BlatUI

### shadcn/ui for the **BLAT** stack — **B**lade · **L**aravel · **A**lpine · **T**ailwind

A CLI that copies open-source, copy-paste UI components **you own** straight into your Laravel project.

[![Latest Version](https://img.shields.io/packagist/v/anousss007/blatui.svg)](https://packagist.org/packages/anousss007/blatui)
[![CI](https://github.com/anousss007/blatui/actions/workflows/ci.yml/badge.svg)](https://github.com/anousss007/blatui/actions/workflows/ci.yml)
[![License](https://img.shields.io/packagist/l/anousss007/blatui.svg)](LICENSE)
[![Accessibility: WCAG AA](https://img.shields.io/badge/accessibility-WCAG%20AA-22c55e.svg)](https://blatui.remix-it.com)

**153 components · 614 variants · 64 blocks · 70 charts · accessible (WCAG AA) · fully themeable · light + dark · MIT**

[Live demo & docs → blatui.remix-it.com](https://blatui.remix-it.com)

</div>

---

## Why BlatUI

- **Accessible by default.** WAI-ARIA roles, complete keyboard navigation & focus management, and WCAG AA color contrast — modeled on shadcn/ui's Base UI behavior, verified in a real browser and audited with axe-core. Accessibility isn't an add-on; it ships in every component.
- **You own the code.** Components are *copied* into your project — not hidden in `vendor/`. Edit them however you like; updating the package never overwrites your edits.
- **The BLAT stack.** Pure Blade components, a sprinkle of Alpine.js for interactivity, Tailwind CSS v4 for styling. No React, no build-step lock-in.
- **Faithful to shadcn/ui.** Same design language, component APIs and blocks — ported to the Laravel way.
- **Themeable to the core.** Every token is a CSS variable.

## Requirements

- PHP 8.2+ · Laravel 11, 12 or 13
- Tailwind CSS v4 · Alpine.js 3 · Node 18+

## Installation

```bash
# 1. Install the CLI
composer require anousss007/blatui

# 2. Peer packages used by the components
composer require gehrisandro/tailwind-merge-laravel mallardduck/blade-lucide-icons
npm install -D alpinejs @alpinejs/anchor @alpinejs/collapse @alpinejs/focus

# 3. Publish the foundations (theme tokens + Alpine/chart/calendar engine)
php artisan vendor:publish --tag=blatui-foundations
#   → resources/css/blatui.css      (oklch design tokens, presets, light/dark)
#   → resources/js/blatui.js        (greenfield bootstrap — boots Alpine for you)
#   → resources/js/blatui-core.js   (engine: registerBlatUI, for apps already running Alpine)

# 4. Verify your setup
php artisan blatui:init
```

Point your two Vite entrypoints at the published foundations — **replace** each file's contents:

```css
/* resources/css/app.css */
@import "./blatui.css";
```
```js
// resources/js/app.js
import "./blatui.js";
```

> `blatui.css` brings Tailwind, the design tokens and the `@theme`
> mapping; `blatui.js` boots Alpine + its plugins and lazy-loads ApexCharts. Run
> `blatui:init` to confirm everything (packages, tokens, imports) is wired up.

> The foundations are published once and become *yours* — tweak the tokens, drop
> the chart engine if you don't need charts, etc. `blatui:init` will tell you
> what's still missing.

### Installing into an existing project

Everything is **additive** — you don't replace your files.

- **Tailwind v4 is required.** BlatUI uses v4-only features (`@theme inline`, oklch). On
  Tailwind v3, migrate first with `npx @tailwindcss/upgrade`; `blatui:init` detects the version.
- **CSS:** add `@import "./blatui.css";` to your existing `app.css`, below `@import "tailwindcss";`.
- **JS — already running Alpine?** Don't import `blatui.js` (it would boot a second Alpine).
  Register BlatUI into your own instance instead, before you start it:

```js
import Alpine from 'alpinejs'
import { registerBlatUI } from './blatui-core.js'

registerBlatUI(Alpine)   // plugins + theme store + chart/calendar engines
window.Alpine = Alpine
Alpine.start()
```

## Adding components

```bash
# Add one or more — dependencies are resolved automatically
php artisan blatui:add button card input

# See everything you can add — components, blocks & charts
php artisan blatui:list

# Details for a single component
php artisan blatui:list select

# Everything at once
php artisan blatui:add --all
```

Components land in `resources/views/components/ui/` as Blade tags:

```blade
<x-ui.card class="max-w-sm">
    <x-ui.card-header>
        <x-ui.card-title>Welcome back</x-ui.card-title>
        <x-ui.card-description>Sign in to continue.</x-ui.card-description>
    </x-ui.card-header>
    <x-ui.card-content class="space-y-3">
        <x-ui.input type="email" placeholder="m@example.com" />
        <x-ui.button class="w-full">Sign in</x-ui.button>
    </x-ui.card-content>
</x-ui.card>
```

`blatui:add` prints any extra `composer`/`npm` packages a component needs
(e.g. charts pull in `apexcharts`).

## Blocks & charts

Blocks (dashboards, sidebars, login pages…) and the 70 charts are **copy-paste
from the demo site** — they're full-page compositions, not primitives, so you
grab the exact source you want rather than installing it:

👉 **[Browse blocks & charts on the live demo](https://blatui.remix-it.com/blocks)**

## Commands

| Command | Description |
|---|---|
| `blatui:init` | Doctor — checks packages, Tailwind v4, theme tokens, Alpine/engine wiring |
| `blatui:list [component]` | List all component families, or detail one |
| `blatui:add <components...>` | Copy components (+ deps) into your project |
| `vendor:publish --tag=blatui-foundations` | Publish theme CSS + JS engine |

## Credits

BlatUI is a port of [**shadcn/ui**](https://ui.shadcn.com) to the Laravel/Blade
ecosystem. Thanks to [shadcn](https://twitter.com/shadcn) and contributors.
Icons by [Lucide](https://lucide.dev). Charts by [ApexCharts](https://apexcharts.com).

## License

[MIT](./LICENSE) — free for personal and commercial use.
