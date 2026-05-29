# Deploying the BlatUI demo to a VPS

A standard Laravel deploy: **nginx + php-fpm**, no database (the demo renders
static Blade). Tested target: Ubuntu/Debian with PHP 8.3+, Composer, Node 18+.

## 1. Server prerequisites (once)

```bash
sudo apt update
sudo apt install -y nginx php8.3-fpm php8.3-cli php8.3-mbstring php8.3-xml \
                    php8.3-curl php8.3-zip php8.3-sqlite3 unzip git
# Composer
php -r "copy('https://getcomposer.org/installer','composer-setup.php');"
sudo php composer-setup.php --install-dir=/usr/local/bin --filename=composer
# Node 20
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

## 2. Get the code

```bash
sudo mkdir -p /var/www && sudo chown $USER /var/www
git clone https://github.com/anousss007/blatui-demo.git /var/www/blatui-demo
cd /var/www/blatui-demo
cp .env.production.example .env       # then edit APP_URL to your subdomain
```

## 3. Build & cache

```bash
bash deploy/deploy.sh                 # composer + npm build + key:generate + caches
```

## 4. nginx + TLS

```bash
sudo cp deploy/nginx.conf /etc/nginx/sites-available/blatui-demo
sudo sed -i 's/SERVER_NAME/demo.blatui.dev/' /etc/nginx/sites-available/blatui-demo
sudo ln -sf /etc/nginx/sites-available/blatui-demo /etc/nginx/sites-enabled/
sudo nginx -t && sudo systemctl reload nginx

# Point your subdomain's A/AAAA record at the VPS, then:
sudo apt install -y certbot python3-certbot-nginx
sudo certbot --nginx -d demo.blatui.dev
```

Set the web user (www-data) as owner of writable dirs:

```bash
sudo chown -R www-data:www-data storage bootstrap/cache
```

## Updating later

```bash
cd /var/www/blatui-demo && bash deploy/deploy.sh
```
