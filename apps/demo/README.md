<div align="center">

# BlatUI

### shadcn/ui for the **BLAT** stack — **B**lade · **L**aravel · **A**lpine · **T**ailwind

Open-source, copy-paste UI components for Laravel. No JS runtime lock-in, no black-box dependency — you own every line.

**55 components · 62 blocks · 70 charts** · fully themeable · light + dark · MIT licensed

</div>

---

## Why BlatUI

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

# 3. Verify your setup (checks packages, theme tokens, Alpine)
php artisan blatui:init

# 4. Add components — copied into resources/views/components/ui
php artisan blatui:add button card dialog

# 5. Browse everything available
php artisan blatui:list
```

Then add the shadcn design tokens to `resources/css/app.css` and bootstrap Alpine in
`resources/js/app.js`. The full step-by-step guide lives at **/docs**.

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
