#!/usr/bin/env bash
#
# Regenerate the package's shipped files (stubs/ at the repo ROOT — the package IS the repo
# root) from the authored source in apps/demo. The demo is where components are authored AND
# rendered; stubs/ is a GENERATED copy that `blatui:add` ships to consumers.
#
# One repo: this runs in-repo, there is no cross-repo sync. CI fails the build if stubs/ is
# stale or hand-edited (see .github/workflows/ci.yml).
#
# Usage (from anywhere in the repo):
#   bash scripts/build-package.sh
#
# Prereq: apps/demo must have its Composer deps installed (the registry builder is a demo
# Artisan command): (cd apps/demo && composer install).
#
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
DEMO="$ROOT/apps/demo"

echo "→ Rebuilding registry.json from the authored components"
( cd "$DEMO" && php artisan blatui:registry:build )

echo "→ Syncing components → stubs/ui"
rm -f "$ROOT"/stubs/ui/*.blade.php
cp "$DEMO"/resources/views/components/ui/*.blade.php "$ROOT"/stubs/ui/

# The published bootstrap is the charts-free blatui.js (NOT the demo's app.js, which also
# registers charts). Charts ship as the opt-in blatui-charts.js.
echo "→ Syncing foundations (CSS + bootstrap + engine + opt-in charts)"
cp "$DEMO"/resources/css/app.css         "$ROOT"/stubs/foundations/app.css
cp "$DEMO"/resources/js/blatui.js        "$ROOT"/stubs/foundations/app.js
cp "$DEMO"/resources/js/blatui-core.js   "$ROOT"/stubs/foundations/blatui-core.js
cp "$DEMO"/resources/js/blatui-charts.js "$ROOT"/stubs/foundations/blatui-charts.js

echo "→ Syncing registry manifest → stubs/registry.json"
cp "$DEMO"/registry.json "$ROOT"/stubs/registry.json

UI_COUNT=$(ls "$ROOT"/stubs/ui/*.blade.php | wc -l | tr -d ' ')
echo "✓ Regenerated ${UI_COUNT} component files + foundations + registry.json."
