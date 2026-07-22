# Contributing to BlatUI

Thanks for your interest in improving BlatUI! 🎉 This is a **monorepo** — one repo, one PR, one
CI. Here is the map so your change lands in the right place.

## Where to edit — the one thing to know

| You want to change… | Edit here | Do **not** edit |
|---|---|---|
| A component's markup/behaviour | `apps/demo/resources/views/components/ui/<name>.blade.php` | `stubs/ui/*` (generated) |
| Foundations (theme CSS, Alpine/chart JS) | `apps/demo/resources/{css,js}/*` | `stubs/foundations/*` (generated) |
| The component manifest | (regenerated) `php artisan blatui:registry:build` in `apps/demo` | `stubs/registry.json` (generated) |
| The CLI itself (commands, registry, MCP) | `src/*` | — |
| Docs pages / examples / API tables | `apps/demo/resources/views/examples/*`, `apps/demo/resources/docs-api/*` | — |

**Why:** components are authored in the demo because that is the only place they *render*. The
package's `stubs/` is a generated copy that `blatui:add` ships to users. Editing the generated
copy directly is the mistake to avoid — CI catches it.

## Repo layout

The Composer package is the repo **root** (`composer.json` + `src/` + `stubs/`), so Packagist
reads it directly and `composer require anousss007/blatui` is unchanged. The `apps/` and dev
tooling are excluded from the published tarball via `.gitattributes` (`export-ignore`).

```
composer.json  src/  stubs/   → the published package
apps/demo/                     → authors + renders components; the live docs site
apps/starter/                  → the Laravel starter kit
scripts/build-package.sh       → regenerates stubs/ from apps/demo
tests/                         → Testbench-based package tests
```

## The loop

```bash
# 1. edit a component in apps/demo/resources/views/components/ui/
# 2. see it live
(cd apps/demo && composer install && npm install && npm run dev)
# 3. regenerate the package from your change
bash scripts/build-package.sh
# 4. commit BOTH the demo edit and the regenerated stubs/ in one PR
# 5. run the package tests + style check (from the repo root)
composer install && vendor/bin/pint && vendor/bin/phpunit
```

CI runs the package tests (PHP 8.2–8.4), Pint, and a **drift check** that regenerates the package
and fails if `stubs/` differs from the authored source — so a hand-edited or stale stub is
rejected with a pointer back to the demo file.

## Pull requests

1. Fork & branch from `main`.
2. Keep changes focused; add a test in `tests/` when you change CLI behaviour.
3. Run `bash scripts/build-package.sh`, then `vendor/bin/pint` and `vendor/bin/phpunit`.
4. Describe the change clearly and reference any related issue.

## Reporting bugs

Open an issue with: BlatUI version, Laravel/PHP version, the command you ran, and what happened
vs. what you expected.

## Code of conduct

Be kind and constructive. We follow the spirit of the
[Contributor Covenant](https://www.contributor-covenant.org/).
