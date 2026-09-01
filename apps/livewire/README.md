# BlatUI morph testbed

A Laravel + Livewire 4 app whose only job is to re-render the DOM out from under BlatUI's
components and check that their wiring survives it.

## Why it exists

`apps/demo` is the source of truth for every component, and it has no Livewire. It never did —
`resources/js/app.js` even stubs `$wire` with a no-op proxy so the docs examples don't throw. So
every component renders there in the one mode where a fact read out of the DOM at init time
stays true forever: a static page where nothing ever morphs.

That gap has a track record. Five reports came in from Livewire users against wiring that is
derived from the rendered DOM once and then either never re-derived, actively stripped by the
next re-render, or — in #27 — carried on an element the re-render replaced outright:

| Issue | What broke |
| ----- | ---------- |
| #5    | date-time picker inside a modal stopped working after a validation error |
| #18   | combobox popover froze at `min-width: 0`, then lost its trigger to a morph |
| #19   | `x-blat-field` never applied `data-invalid` to an error that arrived after mount |
| #27   | a `file-upload` with no `id` never left "uploading" — the morph swapped the input |

Every one of them was found by a user, because nothing in the repo could reproduce them. This
app can.

## How it renders BlatUI

It does **not** carry a copy of the components. `AppServiceProvider` registers
`apps/demo/resources/views/components` as an anonymous component path, and the Vite entry points
import the demo's authored `blatui-core.js` and `app.css` by relative path. `<x-ui.field>` here
compiles the same file the demo renders, so there is nothing to regenerate and no drift job to
fail — which matters more here than anywhere else, since the point is to catch bugs in exactly
those files.

Livewire 4 bundles Alpine and starts it, so `resources/js/app.js` registers BlatUI on Livewire's
Alpine at `alpine:init` rather than importing its own.

## Running it

```bash
composer install && npm ci && npm run build
cp .env.example .env && php artisan key:generate
php artisan serve --port=8124
```

No database: sessions, cache and queue are all file/sync drivers, so there is nothing to migrate.

Then, with the server up:

```bash
npm run test:browser                      # against http://127.0.0.1:8124
npm run test:browser -- http://host:port
```

The suite reuses `apps/demo/tests/browser/lib/harness.mjs`, so Playwright is resolved from the
demo's install — `cd ../demo && npm i --no-save playwright@$(node -p "require('./package.json').blatui.playwright")`
if you don't have it.

## The routes

| Route | What it puts under a re-render |
| ----- | ------------------------------ |
| `/field` | a validation error morphing in, and back out again |
| `/dialog-field` | the same, inside `<x-ui.dialog>` — issue #19 as reported |
| `/label-wiring` | a re-render that never touches the field, which strips the `id`/`for` we generated |
| `/dialog-popover` | a morph that replaces a popover's trigger while the dialog is hidden |
| `/native-dialog` | a popover inside a real `<dialog>`, which must share the browser's top layer |
| `/generated-ids` | components that named their own elements, and lost them to the morph key |

Every check asserts computed state after a real server round-trip. The suite fails on the
pre-fix engine — that is the bar for adding one here.
