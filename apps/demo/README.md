<div align="center">

# BlatUI

### shadcn/ui for the **BLAT** stack — **B**lade · **L**aravel · **A**lpine · **T**ailwind

Open-source, copy-paste UI components for Laravel. No JS runtime lock-in, no black-box dependency — you own every line.

**55 components · 62 blocks · 70 charts** · **accessible (WCAG AA)** · fully themeable · light + dark · MIT licensed

### 🌐 [**Live demo & docs → blatui.remix-it.com**](https://blatui.remix-it.com)

Install the CLI: [**`composer require blatui/blatui`**](https://github.com/anousss007/blatui) · [Package repo](https://github.com/anousss007/blatui)

</div>

---

## Why BlatUI

- **Accessible by default.** WAI-ARIA roles, full keyboard navigation & focus management, and WCAG AA contrast — every component modeled on shadcn/ui's Base UI behavior, verified in a real browser and audited with axe-core.
- **You own the code.** Components are copied into your project with one Artisan command — edit them however you like.
- **The BLAT stack.** Pure Blade components, a sprinkle of Alpine.js for interactivity, Tailwind CSS v4 for styling. No React, no build-step lock-in.
- **Faithful to shadcn/ui.** Same design language, component APIs and blocks — ported to the Laravel way.
- **Themeable to the core.** Every token is a CSS variable. Recolor, restyle, and export your theme from the live customizer.

## Requirements

- Laravel 11+ · PHP 8.2+
- Tailwind CSS v4 · Alpine.js 3 · Node 18+

## Installation

```bash
# 1. Install the package
composer require blatui/blatui

# 2. Peer dependencies
composer require gehrisandro/tailwind-merge-laravel mallardduck/blade-lucide-icons
npm install -D alpinejs @alpinejs/anchor @alpinejs/collapse @alpinejs/focus apexcharts

# 3. Publish the foundations (theme CSS + Alpine/chart engine)
php artisan vendor:publish --tag=blatui-foundations

# 4. Verify your setup (checks packages, tokens, Alpine, imports)
php artisan blatui:init

# 5. Add components — copied into resources/views/components/ui
php artisan blatui:add button card input

# 6. Browse everything available
php artisan blatui:list
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

**Existing project?** Everything is additive — requires **Tailwind v4** (`npx @tailwindcss/upgrade`
from v3); **add** `@import "./blatui.css";` to your app.css; and if you already run Alpine, import
`{ registerBlatUI }` from `./blatui-core.js` and call `registerBlatUI(Alpine)` instead of importing
`blatui.js`. The full step-by-step guide lives at **/docs**.

## Usage

Every component is a Blade tag under the `ui` namespace:

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

## What's inside

| | |
|---|---|
| **Components** | 55 — button, dialog, dropdown, select, calendar, tabs, sidebar… |
| **Blocks** | 62 — 4 dashboards, 16 sidebars, 32 calendars, login & sign-up |
| **Charts** | 70 — area, bar, line, pie, radar, radial (ApexCharts, themed) |
| **Theming** | CSS-variable design tokens, live customizer, copy-to-clipboard export |

## Running this site locally

```bash
composer install && npm install
npm run build      # or: npm run dev
php artisan serve
```

## Credits

BlatUI is a port of [**shadcn/ui**](https://ui.shadcn.com) to the Laravel/Blade ecosystem.
Huge thanks to [shadcn](https://twitter.com/shadcn) and contributors for the original design system.
Icons by [Lucide](https://lucide.dev). Charts by [ApexCharts](https://apexcharts.com).

## License

[MIT](./LICENSE) — free for personal and commercial use.
