FROM php:8.3.6-cli

WORKDIR /app

RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

COPY . .

RUN curl -sS https://getcomposer.org/installer | php
RUN php composer.phar install

CMD php artisan serve --host=0.0.0.0 --port=8000