# BlatUI starter kit (plan)

Goal: let anyone scaffold a BlatUI-powered app in one command, contesting Flux's
"ships in the default Laravel starter kits" advantage:

```bash
laravel new my-app --using=anousss007/blatui-starter
```

`--using` installs a GitHub repo as the app skeleton, so the kit is a normal
Laravel app repo (`anousss007/blatui-starter`) wired with BlatUI out of the box.

## What the kit ships

Built by composing artifacts that already live in this demo — no new design work:

- **Foundations pre-wired**: `resources/css/blatui.css` + `blatui.js`/`blatui-core.js`
  imported in `app.css`/`app.js`; Tailwind v4, Alpine 3, the peer Composer/npm
  packages already in `composer.json`/`package.json`.
- **App shell**: an authenticated layout using one of the `sidebar-*` blocks
  (e.g. `sidebar-10`) + header.
- **Auth**: register / login / forgot-password screens from the `login-*` and
  `signup-*` blocks, wired to Laravel's auth (Breeze-style controllers/routes).
- **Dashboard**: the `dashboard-01` block as `/dashboard` (charts included).
- **Marketing**: `marketing-01` as the public landing page `/`, `pricing-01` at
  `/pricing`.
- **The `ui/` component set**: the full `resources/views/components/ui` copied in,
  so the user owns every component from line one.
- **Theme editor** at `/themes` (optional, dev-only route).

## Variants

Expose flavors via the kit's prompts (Laravel asks the kit on install):

- `anousss007/blatui-starter` — Blade + Alpine (no Livewire).
- A `--livewire` option that swaps the auth + dashboard for Livewire components
  (neutralizes Flux's only real moat: deep `wire:model` integration).

## Build steps (needs your go-ahead — new public repo + Packagist)

1. Create a fresh app: `laravel new blatui-starter`, add Breeze (blade), then
   replace its views with the BlatUI blocks above and run `php artisan blatui:add --all`.
2. Add the starter-kit manifest so `--using` recognizes it (root `composer.json`
   `"type": "project"` + a `database/`/`.env.example` ready to boot).
3. Push to `github.com/anousss007/blatui-starter`, tag, and submit to Packagist
   as `anousss007/blatui-starter`.
4. Document `laravel new my-app --using=anousss007/blatui-starter` in the demo + README.

Steps 3–4 are outward-facing (new public repo, Packagist) and are intentionally
left for explicit approval — this file is the spec, not the publish.

## Why this matters

Flux wins distribution because it is the default in `laravel new`. A first-class
BlatUI starter kit makes "the free, own-the-code option" equally one command away
— and the `--livewire` variant removes the last reason to reach for Flux.
