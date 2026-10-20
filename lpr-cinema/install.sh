#!/usr/bin/env bash
# Нужны: php >= 8.3, composer, интернет
set -e
composer install
[ -f .env ] || cp .env.example .env
php artisan config:clear
echo "Готово. Впишите свои LAB_* в .env и запустите: php artisan serve --port=8108"
