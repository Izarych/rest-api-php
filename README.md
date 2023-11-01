## Развертывание через Docker

1. Копируем репозиторий командой `git clone https://github.com/Izarych/rest-api-php.git`
2. Переходим в директорию проекта `cd rest-api-php`
3. Копируем файл `.env.example в .env` командой `copy`
4. В `.env` файле устанавливаем переменные для базы данных (как пример):
```yaml
DB_DATABASE=db
DB_USERNAME=postgres
DB_PASSWORD=password
```
5. В `docker-compose.yml` файле устанавливаем в сервисе postgresql переменные из п.4
6. Устанавливаем и запускаем образ командой `docker compose up --build -d`
7. Выполняем команды
```shell
docker-compose exec php-fpm composer install
docker-compose exec php-fpm php artisan:key generate
docker-compose exec php-fpm php artisan migrate
```
8.  Сайт доступен по url - `http://localhost`

## Развертывание локально
Все довольно просто, в .env прописываем свою базу, APP_URL ставим http://localhost:8000
Прописываем команды
```shell
composer install
php artisan:key generate
php artisan migrate
php artisan backpack:install
php artisan serve
```

Сервер доступен по http://localhost:8000
Админка по http://localhost:8000/admin
В случае каких-либо проблем пробуем:
```shell
php artisan config:cache
php artisan optimize
```
