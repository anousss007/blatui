# Contributing to BlatUI

> ⚠️ **This repository is the published distribution of the package** (Packagist reads it as
> `anousss007/blatui`; installation is unchanged). Its contents are **published from the
> development monorepo** at **https://github.com/anousss007/blatui-workspace**. **Do not open PRs
> or issues here** — they will be closed. Contribute at the workspace instead.

## Where to work (in the monorepo)

- **Components** are authored in `apps/demo/resources/views/components/ui/` (the demo is the
  only place they render). `packages/blatui/stubs/` is generated from there.
- **The CLI** (service provider, registry, `blatui:*` commands, MCP) lives in `packages/blatui/src/`.
- See the workspace's [`CONTRIBUTING.md`](https://github.com/anousss007/blatui-workspace/blob/main/CONTRIBUTING.md)
  for the full edit-map and the build/test loop.

## Reporting bugs

Open an issue on the **workspace**: https://github.com/anousss007/blatui-workspace/issues — include the
BlatUI version, Laravel/PHP version, the command you ran, and what happened vs. what you expected.

## Code of conduct

Be kind and constructive. We follow the spirit of the
[Contributor Covenant](https://www.contributor-covenant.org/).
