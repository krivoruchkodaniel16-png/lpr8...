@echo off
call composer install
if not exist .env copy .env.example .env
php artisan config:clear
echo Готово. Впишите свои LAB_* в .env и запустите: php artisan serve --port=8108
