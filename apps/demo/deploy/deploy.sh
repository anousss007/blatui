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

echo "→ Fixing permissions (storage + cache)"
chmod -R ug+rw storage bootstrap/cache || true

echo "✓ Deployed. Reload php-fpm if needed:  sudo systemctl reload php8.3-fpm"
