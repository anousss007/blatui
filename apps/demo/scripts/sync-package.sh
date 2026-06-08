#!/usr/bin/env bash
#
# Sync the demo's components + foundations into the BlatUI CLI package.
# The demo repo is the single source of truth; the package bundles a copy of
# the component stubs that `blatui:add` ships to consumers.
#
# Usage:
#   bash scripts/sync-package.sh [path-to-package-repo]
#
# Then, in the package repo: review the diff, bump CHANGELOG, and tag a release:
#   git add -A && git commit -m "sync components from demo"
#   git tag -a v1.x.y -m "v1.x.y" && git push origin main --tags
#
set -euo pipefail

DEMO_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
PKG_DIR="${1:-$DEMO_DIR/../blatui-package}"

if [[ ! -d "$PKG_DIR/stubs" ]]; then
  echo "✗ Package not found at: $PKG_DIR" >&2
  echo "  Pass the path explicitly: bash scripts/sync-package.sh /path/to/blatui-package" >&2
  exit 1
fi

echo "→ Rebuilding registry.json from the authored components"
( cd "$DEMO_DIR" && php artisan blatui:registry:build )

echo "→ Syncing components → $PKG_DIR/stubs/ui"
rm -f "$PKG_DIR"/stubs/ui/*.blade.php
cp "$DEMO_DIR"/resources/views/components/ui/*.blade.php "$PKG_DIR"/stubs/ui/

# The published bootstrap is the charts-free blatui.js (NOT the demo's app.js,
# which also registers charts). Charts ship as the opt-in blatui-charts.js.
echo "→ Syncing foundations (CSS + bootstrap + engine + opt-in charts)"
cp "$DEMO_DIR"/resources/css/app.css         "$PKG_DIR"/stubs/foundations/app.css
cp "$DEMO_DIR"/resources/js/blatui.js        "$PKG_DIR"/stubs/foundations/app.js
cp "$DEMO_DIR"/resources/js/blatui-core.js   "$PKG_DIR"/stubs/foundations/blatui-core.js
cp "$DEMO_DIR"/resources/js/blatui-charts.js "$PKG_DIR"/stubs/foundations/blatui-charts.js

echo "→ Syncing registry manifest → $PKG_DIR/stubs/registry.json"
cp "$DEMO_DIR"/registry.json "$PKG_DIR"/stubs/registry.json

UI_COUNT=$(ls "$PKG_DIR"/stubs/ui/*.blade.php | wc -l | tr -d ' ')
echo "✓ Synced ${UI_COUNT} component files + foundations + registry.json."
echo "  Next: cd $PKG_DIR && git status"
