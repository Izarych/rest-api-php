## Проблемы с Laravel - Backpack
Стандартная форма регистрации/логина проходит через email,name,password
Судя по документации нужно оверрайднуть эти формы и вставить свои поля
Довольно долго промучался в итоге так и не вышло. Если делать все по документации возникают следующие проблемы:
1. В документации не указан __invoke() который должен указывать на вьюшку, эта проблема была решена.
2. backpack_view() не работает, он возвращает string вместо view, соответственно нужно прокидывать свою view
3. В документации также сказано, что можно просто сделать copy-paste оригинальной view и подставить своя поля, теперь об этом:
- Все не так просто, под капотом у Backpack прокидывается как минимум $errors который локально не прокидывается
- Убираем $errors, пытаемся прокинуть кастомную (уродливую) вьюшку -> вроде все получается -> получаем 419 ошибку
4. Попытался в конце концов скостылить, накатил password миграцией, регнул пользователя, все равно не входит по нему).

Итог: В гугле есть только пару подобных проблем и все они ведут на документацию. Делая все точь - в - точь по документации сталкиваемся с проблемами выше.

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
php artisan serve
```

Сервер доступен по http://localhost:8000

В случае каких-либо проблем пробуем:
```shell
php artisan config:cache
php artisan optimize
```
