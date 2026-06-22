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

# Copia apenas arquivos necessários primeiro (cache)
COPY composer.json composer.lock ./

# Instala dependências (sem dev pra ficar mais leve)
RUN composer install --no-dev --optimize-autoloader

# Agora copia o restante do projeto
COPY . .

# Permissões (evita erro em storage)
RUN chmod -R 777 storage bootstrap/cache

# Porta padrão Laravel
EXPOSE 8000

# Start da aplicação
CMD php artisan serve --host=0.0.0.0 --port=8000