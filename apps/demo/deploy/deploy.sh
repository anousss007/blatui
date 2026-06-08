#!/usr/bin/env bash
#
# BlatUI demo — zero-frills deploy / update script (run ON the VPS).
# First time:
#   git clone git@github.com:anousss007/blatui-demo.git /var/www/blatui-demo
#   cd /var/www/blatui-demo && cp .env.production.example .env
#   # edit .env (APP_URL, APP_KEY), then:
#   bash deploy/deploy.sh
# Updates afterwards: just `bash deploy/deploy.sh`.
#
set -euo pipefail

cd "$(dirname "${BASH_SOURCE[0]}")/.."
echo "→ Deploying in: $(pwd)"

echo "→ Pulling latest"
git pull --ff-only origin main

echo "→ Composer (prod)"
composer install --no-dev --optimize-autoloader --no-interaction --prefer-dist

echo "→ Frontend build"
npm ci
npm run build

if ! grep -q '^APP_KEY=base64:' .env 2>/dev/null; then
  echo "→ Generating APP_KEY"
  php artisan key:generate --force
fi

echo "→ Caching config/routes/views"
php artisan optimize:clear
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Permissions self-maintain after a one-time `sudo bash deploy/server-setup.sh`
# (shared www-data group + setgid dirs + umask 002). Here we only normalise files WE just
# created — `-user $(id -un)` skips www-data-owned files, so no `Operation not permitted`.
echo "→ Normalising perms on freshly-built files"
find storage bootstrap/cache -user "$(id -un)" -type d -exec chmod 2775 {} + 2>/dev/null || true
find storage bootstrap/cache -user "$(id -un)" -type f -exec chmod 0664 {} + 2>/dev/null || true

# With server-setup.sh applied, opcache revalidates per request → no php-fpm reload needed.
echo "✓ Deployed."
