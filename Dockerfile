FROM php:8.1-fpm-buster

USER root

RUN apt-get update && \
    apt-get install -y libpq-dev postgresql-client zip unzip git && \
    docker-php-ext-install pdo pdo_pgsql


RUN apt-get update && apt-get install -y zip unzip
RUN apt-get update && apt-get install -y git

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

WORKDIR /var/www/html

COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

COPY . .

RUN composer dump-autoload --optimize

RUN chown -R www-data:www-data /var/www/html
RUN chown -R www-data:www-data /var/www/html/storage/app/public

CMD ["php-fpm"]
