#!/usr/bin/env bash
#
# One-time server setup so the DEPLOY user and php-fpm (www-data) can BOTH read/write
# Laravel's writable dirs forever — no more `chmod: Operation not permitted` and no
# php-fpm reload needed after each deploy.
#
# Root cause it fixes: only a file's OWNER (or root) may chmod it. php-fpm writes cache/
# session/view files as www-data; the deploy runs as your login user; neither can chmod the
# other's files. The fix is a SHARED GROUP + setgid dirs + group-writable + a www-data umask
# of 002, so files are group-writable and either side can create/delete them (directory write
# permission — not file ownership — governs create/delete).
#
# Run ONCE, as root, from the app root:
#   sudo bash deploy/server-setup.sh
# Re-run any time it drifts; it's idempotent.
#
set -euo pipefail

APP_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")/.." && pwd)"
DEPLOY_USER="${DEPLOY_USER:-${SUDO_USER:-$(logname 2>/dev/null || echo "$USER")}}"
WEB_GROUP="${WEB_GROUP:-www-data}"
PHP_FPM="${PHP_FPM:-php8.3-fpm}"

if [[ $EUID -ne 0 ]]; then
  echo "✗ Run as root:  sudo bash deploy/server-setup.sh" >&2
  exit 1
fi

echo "→ App:          $APP_DIR"
echo "→ Deploy user:  $DEPLOY_USER"
echo "→ Web group:    $WEB_GROUP"
echo "→ php-fpm:      $PHP_FPM"

echo "→ 1/4 Adding $DEPLOY_USER to the $WEB_GROUP group"
usermod -aG "$WEB_GROUP" "$DEPLOY_USER"

echo "→ 2/4 Shared ownership + setgid (group inherited) + group-writable on writable dirs"
chown -R "$DEPLOY_USER:$WEB_GROUP" "$APP_DIR/storage" "$APP_DIR/bootstrap/cache"
find "$APP_DIR/storage" "$APP_DIR/bootstrap/cache" -type d -exec chmod 2775 {} +
find "$APP_DIR/storage" "$APP_DIR/bootstrap/cache" -type f -exec chmod 0664 {} +

echo "→ 3/4 php-fpm creates group-writable files (umask 002)"
mkdir -p "/etc/systemd/system/${PHP_FPM}.service.d"
cat > "/etc/systemd/system/${PHP_FPM}.service.d/umask.conf" <<'EOF'
[Service]
UMask=0002
EOF
systemctl daemon-reload
systemctl restart "$PHP_FPM"

echo "→ 4/4 opcache picks up changed files every request (no reload needed on deploy)"
PHP_VER="$(echo "$PHP_FPM" | grep -oE '[0-9]+\.[0-9]+' || echo '8.3')"
CONF_DIR="/etc/php/${PHP_VER}/fpm/conf.d"
if [[ -d "$CONF_DIR" ]]; then
  cat > "${CONF_DIR}/99-blatui-opcache.ini" <<'EOF'
; Re-check file mtimes on every request so a deploy is picked up immediately.
opcache.validate_timestamps=1
opcache.revalidate_freq=0
EOF
  systemctl reload "$PHP_FPM"
else
  echo "  (skipped: $CONF_DIR not found — set opcache.revalidate_freq=0 manually)"
fi

echo "✓ Done. Log out/in once (or run 'newgrp $WEB_GROUP') so the group change applies,"
echo "  then run deploy/deploy.sh — no more permission warnings, no manual reload."
