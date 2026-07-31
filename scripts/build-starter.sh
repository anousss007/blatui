#!/usr/bin/env bash
#
# Regenerate the starter kit's BlatUI files (apps/starter) from the authored source in
# apps/demo. Components are AUTHORED and rendered in apps/demo; the starter ships a full,
# owned copy so `laravel new --using=…` (or a clone) boots with every component present —
# no `blatui:add` needed before the pre-built pages render.
#
# This is the missing piece that let the starter drift: it was a hand-copied snapshot with
# no regenerator, so it fell behind apps/demo (missing components, stale fixes). CI's
# `starter-drift` job now fails if this output isn't committed.
#
# Only the GENERATED files are touched. The starter's hand-authored shell — layouts/app,
# landing/dashboard/auth views, routes, config, the thin resources/{css/app.css,js/app.js}
# entry points, README — is left alone.
#
# Usage (from anywhere in the repo):
#   bash scripts/build-starter.sh
#
set -euo pipefail

ROOT="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
DEMO="$ROOT/apps/demo"
STARTER="$ROOT/apps/starter"

echo "→ Syncing ui components → starter"
mkdir -p "$STARTER"/resources/views/components/ui
rm -f "$STARTER"/resources/views/components/ui/*.blade.php
cp "$DEMO"/resources/views/components/ui/*.blade.php "$STARTER"/resources/views/components/ui/

echo "→ Syncing block components → starter"
mkdir -p "$STARTER"/resources/views/components/block
rm -f "$STARTER"/resources/views/components/block/*.blade.php
cp "$DEMO"/resources/views/components/block/*.blade.php "$STARTER"/resources/views/components/block/

# Foundations. The starter's resources/css/app.css and resources/js/app.js are thin,
# hand-authored entry points that @import these generated files, so we overwrite the
# generated ones only. blatui.css carries the Tailwind import + theme tokens; its @source
# globs are relative (../views, ../../vendor, …) so they resolve to the starter's own paths.
echo "→ Syncing foundations (tokens css + engine + bootstrap + opt-in charts)"
cp "$DEMO"/resources/css/app.css         "$STARTER"/resources/css/blatui.css
cp "$DEMO"/resources/js/blatui-core.js   "$STARTER"/resources/js/blatui-core.js
cp "$DEMO"/resources/js/blatui.js        "$STARTER"/resources/js/blatui.js
cp "$DEMO"/resources/js/blatui-charts.js "$STARTER"/resources/js/blatui-charts.js

UI_COUNT=$(ls "$STARTER"/resources/views/components/ui/*.blade.php | wc -l | tr -d ' ')
BLOCK_COUNT=$(ls "$STARTER"/resources/views/components/block/*.blade.php | wc -l | tr -d ' ')
echo "✓ Regenerated starter: ${UI_COUNT} ui + ${BLOCK_COUNT} block components + foundations."
