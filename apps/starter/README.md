<div align="center">

# BlatUI Starter

### A Laravel app pre-wired with [BlatUI](https://blatui.remix-it.com) — shadcn/ui for the BLAT stack.

</div>

---

Spin up a BlatUI-powered app in one command:

```bash
laravel new my-app --using=blatui/starter
```

## What's inside

- **Laravel 13** · **Tailwind CSS v4** · **Alpine.js 3** · Vite.
- The full **BlatUI component set** copied into `resources/views/components/ui/`
  (57 families, 242 files) — you own every line.
- Foundations wired: `resources/css/app.css` → `@import './blatui.css'`,
  `resources/js/app.js` → `import './blatui.js'` (boots Alpine + the BlatUI
  engine: components, charts, calendar).
- Pre-built pages:
  - `/` — marketing landing (`resources/views/landing.blade.php`)
  - `/dashboard` — analytics dashboard with sidebar + charts
  - `/login`, `/register` — auth screens
- Theme tokens are CSS variables — recolor everything from the BlatUI
  [theme editor](https://blatui.remix-it.com/themes) and paste into `app.css`.

## Run it

```bash
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install && npm run build   # or: npm run dev
php artisan serve
```

## Add more components

```bash
php artisan blatui:add <component>     # e.g. command, date-picker, sonner
php artisan blatui:list                # browse everything
```

## Add real auth

The auth screens are UI only. For working authentication, layer Laravel's
auth on top and keep the BlatUI forms:

```bash
composer require laravel/breeze --dev
php artisan breeze:install blade
```

---

> **Maintainer note:** this kit currently resolves `blatui/blatui` from a local
> path repository (see `composer.json`). Before publishing the kit, remove the
> `repositories.blatui` path entry and the `minimum-stability: dev` line so it
> installs the released `blatui/blatui` from Packagist.
