# BlatUI — one repo (monorepo, package at root)

`anousss007/blatui` is a single repository that is **both** the development monorepo **and** the
published Composer package. It was consolidated from three repos (`blatui`, `blatui-demo`,
`blatui-starter`) on 2026-07-22, preserving each one's full file history (paths rewritten with
`git-filter-repo`, so `git blame`/`log` follow through).

## Why one repo

The old three-repo split (author in `blatui-demo`, generate into `blatui`, plus a stale
`blatui-starter`) misled contributors: a fix sent to the generated copy was reverted on the next
cross-repo sync (PR #9, 2026-07-22). Everything now lives here; generation is in-repo and
CI-enforced, so that whole failure class is gone.

## Layout — the package is the root

```
composer.json  src/  stubs/   → the published package (Packagist reads the ROOT composer.json)
tests/                         → package tests
apps/demo/                     → authors AND renders every component; the live docs site
apps/starter/                  → the Laravel starter kit
scripts/build-package.sh       → regenerates stubs/ from apps/demo
.gitattributes                 → apps/, scripts/, docs/, .github/, tests/ are export-ignore'd
```

Because the package sits at the repo root, **Packagist and Composer are unchanged** — the package
name stays `anousss007/blatui`, `composer require anousss007/blatui` and every `^1.x` constraint
resolve exactly as before, and the git tags (v1.0.0 … v1.17.1) are untouched. The `apps/` and dev
tooling are stripped from the distributed tarball via `.gitattributes export-ignore`, so consumers
receive only the package.

## Source of truth: the demo

Components are authored in `apps/demo/resources/views/components/ui/` — the only place they
render. `stubs/` is generated from there by `scripts/build-package.sh` (the old cross-repo
`sync-package.sh`, now in-repo). `.github/workflows/ci.yml` runs a `build-drift` job that
regenerates and fails on any difference, so `stubs/` can never be hand-edited or go stale.

## Releasing

Cut a SemVer tag on `main` (`git tag -a vX.Y.Z -m vX.Y.Z && git push origin vX.Y.Z`).
`.github/workflows/release.yml` publishes a GitHub Release and Packagist picks up the tag via its
existing webhook — same flow as always. (Bump `CHANGELOG.md` first.)

## History note

The `blatui-demo` and `blatui-starter` GitHub repos are archived; their history now lives under
`apps/demo/` and `apps/starter/` here. The short-lived `blatui-workspace` repo (an intermediate
`packages/`-style layout) was replaced by this root-package layout and deleted.
