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

**One gotcha when writing a component's doc comment:** the manifest builder infers dependencies
by scanning each family's source for `<x-ui.*>` / `<x-block.*>` — **comments included**, on
purpose, because a container that documents its children (`each <x-ui.dock-item> stretches…`)
genuinely needs them installed alongside. The flip side: naming a component you are steering
people *away* from ("prefer `<x-ui.alert-dialog>` when…") silently makes it a dependency, and
`blatui:add` starts dragging a whole extra family in. Mention those in prose without the tag
syntax. `git diff apps/demo/registry.json` after `build-package.sh` shows what you actually
declared.

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
apps/demo/tests/js/            → engine unit tests (node --test, no deps)
apps/demo/tests/browser/       → Playwright acceptance runs (manual, see below)
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

CI runs the package tests (PHP 8.2–8.4), Pint, the JS engine tests, and a **drift check** that
regenerates the package and fails if `stubs/` differs from the authored source — so a hand-edited
or stale stub is rejected with a pointer back to the demo file.

### JS tests

Components whose behaviour lives in `resources/js/blatui-core.js` have two extra layers:

```bash
cd apps/demo
npm test                      # engine unit tests — zero-dependency `node --test`, run in CI

# browser acceptance — NOT in CI: needs a served demo + a ~115 MB browser download.
# Run it by hand before releasing a change to the calendar or the pickers.
npm i -D playwright && npx playwright install chromium
npm run build && php artisan serve --port=8123
npm run test:browser
npm run test:browser -- https://blatui.remix-it.com   # or against the live site
```

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
