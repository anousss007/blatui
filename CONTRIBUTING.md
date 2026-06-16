# Contributing to BlatUI

Thanks for your interest in improving BlatUI! 🎉

## Project layout

This repository is the **`anousss007/blatui` Composer package** — the CLI that copies
components into a user's project. It contains:

- `src/` — the service provider, registry and `blatui:*` Artisan commands
- `stubs/ui/` — the component Blade files shipped to consumers (generated from the
  [demo repo](https://github.com/anousss007/blatui-demo); **don't hand-edit here**)
- `stubs/registry.json` — the component manifest (families, dependencies, packages)
  that `src/Registry.php` reads; **generated, never hand-edited**
- `stubs/foundations/` — the theme CSS + Alpine/chart/calendar JS
- `tests/` — Testbench-based tests

> The **components themselves** live in the demo repo and are synced here via a
> build script. Fix component bugs there, not in `stubs/`. The demo generates
> `registry.json` with `php artisan blatui:registry:build`, and
> `scripts/sync-package.sh` (in the demo) copies the stubs + manifest into this
> package in one step — so `stubs/ui/` and `stubs/registry.json` always match.

## Local setup

```bash
composer install
vendor/bin/phpunit      # run the tests
vendor/bin/pint         # auto-format (vendor/bin/pint --test to check only)
```

## Pull requests

1. Fork & branch from `main`.
2. Keep changes focused; add a test when you change behaviour.
3. Run `vendor/bin/pint` and `vendor/bin/phpunit` — CI runs both on PHP 8.2–8.4.
4. Describe the change clearly. Reference any related issue.

## Reporting bugs

Open an issue with: BlatUI version, Laravel/PHP version, the command you ran, and
what happened vs. what you expected.

## Code of conduct

Be kind and constructive. We follow the spirit of the
[Contributor Covenant](https://www.contributor-covenant.org/).
