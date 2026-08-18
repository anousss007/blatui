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

**Wiring you derive from the DOM has to be re-derived, not remembered.** Several directives in
`blatui-core.js` resolve a fact out of the rendered DOM — is there an error slot, which node is
the title, where is the real control — and write ARIA onto it. Doing that once, in a
`queueMicrotask` at init, is correct only on a page that never re-renders. Under Livewire (or
Turbo, or htmx) two things go wrong: the fact changes and nothing re-runs the directive, and the
attributes you wrote get stripped, because they exist only in the browser and a morph syncs
attributes against the server's HTML, which has never heard of them. Issues #5, #18 and #19 were
all this. Route new wiring of that kind through `keepWired()`, and keep its `sync` idempotent —
write via `setAttr()`, which is what stops the observer seeing its own writes and spinning.

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
apps/livewire/                 → morph testbed: the components under a real Livewire re-render
scripts/build-package.sh       → regenerates stubs/ from apps/demo
tests/                         → Testbench-based package tests
apps/demo/tests/js/            → engine unit tests (node --test, no deps)
apps/demo/tests/browser/       → Playwright acceptance suite (runs in CI, see below)
apps/livewire/tests/browser/   → morph acceptance suite (reuses the harness above)
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

### Four test layers, and what each one is for

| Layer | Answers | Where |
|---|---|---|
| Render tests (PHPUnit) | *Does the component emit the right markup?* | `apps/demo/tests/Feature` |
| Engine tests (`node --test`) | *Does the Alpine logic compute the right thing?* | `apps/demo/tests/js` |
| **Browser acceptance (Playwright)** | *Does it actually work when a user clicks it?* | `apps/demo/tests/browser` |
| **Morph acceptance (Playwright)** | *Does it still work after the server re-renders it?* | `apps/livewire/tests/browser` |

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

**Every suite runs at every width in the matrix** (`tests/browser/lib/viewports.mjs`): 320, 375,
639, 640, 767, 768, 900, 1023, 1024, 1280, 1536. Two rules produced that list — bugs cluster at
the *boundary*, so each Tailwind breakpoint is driven at its value and one pixel below it; and
they hide *between* breakpoints, so 900px is there because that is where #17 lived, in the gap a
"phone and laptop" pair never covered. `--viewports=375,1280` narrows a local run, and the header
always prints the widths it actually used. CI shards the matrix across four parallel jobs, so
covering eleven widths costs the wall-clock of one.

What it covers, all discovered from the site's own `sitemap.xml` so a new component is included
the moment it is published:

- **pages** — every component page and every block: no console error, no uncaught exception, no
  failed same-origin request, no `<x-ui.*>` tag that leaked into the HTML, no `x-cloak` left
  behind (Alpine never booted that subtree).
- **overlays** — every trigger → content pair present on a page: open it, require the panel to be
  *visibly on screen*, close it, require it gone. Plus the disclosure widgets (accordion,
  collapsible, reasoning, tool-call) toggling both ways.
- **controls** — switch, checkbox, radio, tabs, toggle-group, select, combobox (keyboard
  selection included), command, input, textarea, input-otp, number-input, tags-input, slider,
  calendar, date-picker, carousel, context-menu (right-click), navigation-menu (hover), stepper,
  pagination, sonner: interact, then require the reported state to have moved.
- **buttons** — clicks every visible button on every documented page and fails if the handler
  throws. Which buttons are on screen changes with the width, which is why it sweeps too.
- **layout** — invariants that need no baseline: the page must not scroll sideways, no component
  may be squashed to a zero dimension, nothing may be stranded off the left edge, no text may
  spill out of its box. This is the suite that catches *looks broken* rather than *looks
  different*. Four components size themselves from their content and still overflow a 320px
  viewport, as upstream shadcn does; they are listed in the suite and printed on every run rather
  than hidden, and enforced normally from 375px up.
- **visual** — a perceptual fingerprint (256-bit dHash) of every example block, per component per
  width, compared against `tests/browser/baseline/visual.json`. Catches a padding that collapsed, a
  colour that inverted, a grid that reflowed. The threshold is measured, not guessed: two runs of
  the same page differ by 0 bits, the noisiest real case (avatars whose remote images resolve in a
  different order) by 5, and a 4px padding change by 14 — so 8 bits sits between the noise and the
  smallest change worth catching. Renderings
  that cannot reproduce themselves are detected by capturing three times and reported as uncovered
  rather than made flaky, and six components whose rendering is a function of time rather than of
  the code (`number-ticker`, `streaming-text`, `typewriter`, `marquee`, `confetti`, `countdown`)
  are excluded by name and printed on every run. Cross-origin requests are
  blocked during capture — the demo's webfonts come from a CDN, and text in a different face would
  move every hash, so a baseline recorded on a laptop would fail wholesale on a CI runner. Update with
  `npm run test:browser -- --suite=visual --update-baseline` and review the diff: an intentional
  restyle changes hashes for exactly the components you touched. Failures write the actual PNG to
  `tests/browser/shots/`.
- **sidebar** — its own suite, asserting the *mode* each width implies: off-canvas drawer below md
  (open, focus trap, Escape, backdrop) and docked icon rail at or above it (collapse, tooltips,
  scrolling, plus a breakpoint configured above md). It has produced four separate escapes and
  every one of them was responsive or interaction state.

When you add a component, the pages/overlays/buttons sweeps pick it up for free, at every width.
Add a `controls` entry when its value lives somewhere only that component knows about.

### The fourth layer: a real Livewire re-render

`apps/demo` has no Livewire — `resources/js/app.js` stubs `$wire` with a no-op proxy so the docs
examples don't throw — so every component renders there in the one mode where a fact read at init
stays true forever. Three user-reported bugs (#5, #18, #19) lived in exactly that gap, and none of
the three layers above could see any of them.

`apps/livewire` closes it. It holds **no copy** of the components: Blade resolves `<x-ui.*>`
straight out of `apps/demo/resources/views/components`, and Vite imports the demo's authored
`blatui-core.js` and `app.css` by relative path — so there is nothing to regenerate and no drift
job to fail.

```bash
cd apps/livewire
composer install && npm ci && npm run build
cp .env.example .env && php artisan key:generate     # no database — file/sync drivers
php artisan serve --port=8124 &
npm run test:browser
```

Same rule as the browser suite, and one more: **a check here has to fail on the pre-fix engine.**
`git stash` the fix, rebuild, and watch it go red before you keep it. Every check currently in the
suite does.

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
