FROM php:8.4-cli

WORKDIR /app

# Dependências do sistema
RUN apt-get update && apt-get install -y \
    libpq-dev \
    unzip \
    git \
    curl \
    && docker-php-ext-install pdo pdo_pgsql

# Instala Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# 🔥 COPIA TUDO PRIMEIRO (ESSENCIAL PRO LARAVEL)
COPY . .

# Instala dependências
RUN composer install
RUN apt-get install -y netcat-openbsd
ARG APP_ENV=production

RUN if [ "$APP_ENV" = "testing" ]; then \
      composer install; \
    else \
      composer install --no-dev --optimize-autoloader; \
    fi  

# Permissões
RUN chmod -R 777 storage bootstrap/cache

# Porta
EXPOSE 8000

# Start
CMD php artisan serve --host=0.0.0.0 --port=8000