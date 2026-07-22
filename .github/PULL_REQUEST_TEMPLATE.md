<!-- Thanks for contributing to BlatUI! -->

## What does this PR do?

<!-- Brief description. Reference any issue: "Closes #123". -->

## Checklist

- [ ] Component/foundation changes were made in **`apps/demo/`** (the source), not in `stubs/` (generated)
- [ ] Ran `bash scripts/build-package.sh` and committed the regenerated `stubs/**`
- [ ] `vendor/bin/pint` passes (code style)
- [ ] `vendor/bin/phpunit` passes (tests)
- [ ] Added/updated a test when behaviour changed

<!-- CI runs pint, phpunit (PHP 8.2–8.4), and a drift check that fails if stubs/ is out of sync with apps/demo. -->
