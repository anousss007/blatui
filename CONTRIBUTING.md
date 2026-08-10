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

**`twMerge()` mutates the bag it is called on.** `$attributes->twMerge(…)` writes the merged
class back into `$attributes` and returns the same instance. That is invisible in the common case
— one root element, one call — but a component that renders **two** elements from the same bag
(the sidebar renders a desktop root *and* a teleported mobile panel) will merge the first
element's classes into the second. That is how `hidden md:block` reached the mobile drawer and
kept it invisible on phones for three releases. When a bag is used more than once, merge into a
copy (`$attributes->except('class')`, `->only('class')`) and keep the original untouched. Calls in
mutually exclusive `@if`/`@else` branches are fine — only one of them ever runs.

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
apps/demo/tests/browser/       → Playwright acceptance suite (runs in CI, see below)
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

CI runs the package tests (PHP 8.2–8.4), Pint, the JS engine tests, a **drift check** that
regenerates the package and fails if `stubs/` differs from the authored source — so a hand-edited
or stale stub is rejected with a pointer back to the demo file — and the **browser acceptance
suite** below.

### Three test layers, and what each one is for

| Layer | Answers | Where |
|---|---|---|
| Render tests (PHPUnit) | *Does the component emit the right markup?* | `apps/demo/tests/Feature` |
| Engine tests (`node --test`) | *Does the Alpine logic compute the right thing?* | `apps/demo/tests/js` |
| **Browser acceptance (Playwright)** | *Does it actually work when a user clicks it?* | `apps/demo/tests/browser` |

The third layer exists because the first two cannot see the bugs that reached users. A class that
resolves to `display: none` on the mobile drawer, a tooltip that never opens, a rail that cannot
scroll — the markup is correct in every one of those, and only a real browser disagrees. **Assert
on computed state after a real interaction; never on markup.** Markup is layer one's job.

```bash
cd apps/demo
npm test                      # engine unit tests — zero-dependency `node --test`

# Browser acceptance. Playwright is deliberately NOT a devDependency: its postinstall would
# drag a ~115 MB browser download into every `npm install` here. CI installs it in one job.
npm i -D playwright && npx playwright install chromium
npm run build && php artisan serve --port=8123
npm run test:browser                                     # everything, ~5 suites
npm run test:browser -- --suite=sidebar                  # one suite
npm run test:browser -- --suite=overlays --only=dialog   # one component
npm run test:browser -- https://blatui.remix-it.com      # or against the live site
```

What it covers, all discovered from the site's own `sitemap.xml` so a new component is included
the moment it is published:

- **pages** — every component page and every block, at 1280px **and 375px**: no console error, no
  uncaught exception, no failed request, no `<x-ui.*>` tag that leaked into the HTML, no `x-cloak`
  left behind (Alpine never booted that subtree).
- **overlays** — every trigger → content pair present on a page: click it, require the panel to be
  *visibly on screen*, press Escape, require it gone. Plus the disclosure widgets (accordion,
  collapsible, reasoning, tool-call) toggling both ways.
- **controls** — switch, checkbox, radio, tabs, toggle-group, select, combobox, command, input,
  textarea, input-otp, number-input, tags-input, slider, calendar, date-picker, carousel,
  context-menu (right-click), navigation-menu (hover), stepper, pagination, sonner: interact, then
  require the reported state to have moved.
- **buttons** — clicks every visible button on every documented page and fails if the handler
  throws.
- **sidebar** — its own suite at three widths. It has produced three separate escapes and every one
  of them was responsive or interaction state.

When you add a component, the pages/overlays/buttons sweeps pick it up for free. Add a `controls`
entry when its value lives somewhere only that component knows about.

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
