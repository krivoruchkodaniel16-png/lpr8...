ЛПР 8, вариант 8 (Кинотеатр: Genre -> Movie), N = 8:
V=8, PORT=8108, ITEMS=7, CODE_L=2, CODE_D=2 (коды вида DR-01).

1. Распакуйте архив, откройте терминал в папке lpr-cinema.
2. Выполните install.sh (Windows: install.bat) — установит vendor и сгенерирует APP_KEY.
3. В .env впишите LAB_STUDENT, LAB_SLUG, LAB_GROUP, LAB_CODE.
4. php artisan serve --port=8108
Проверка: php artisan about, php artisan route:list
Включены ⭐: /catalog/stats, /catalog/genre, своя 404.

Если видите "500 SERVER ERROR": 1) нужен файл .env (в архиве уже есть, с APP_KEY и APP_DEBUG=true);
2) выполните composer install; 3) php artisan config:clear; 4) перезапустите php artisan serve;
5) причину смотрите в storage/logs/laravel.log.
