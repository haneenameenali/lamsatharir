FROM php:8.2-cli
WORKDIR /app

\ RUN apt-get update && apt-get install -y \
 unzip zip curl git libzip-dev
 docker-php-ext-install zip &&

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . .

RUN composer install

RUN cp .env.example .env || true

RUN php artisan key:generate || true

EXPOSE 10000

CMD php artisan serve --host=0.0.0.0 --port=10000
