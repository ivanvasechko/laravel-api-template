FROM dunglas/frankenphp:1.14.0-php8.5.13-alpine@sha256:45b44e677ae199015523e2e4d4a3543cf852d15e9c2aa6dca0f441a959f749dc AS base

ENV SERVER_NAME=:80

RUN install-php-extensions \
    pdo_pgsql pdo_sqlite zip intl mbstring xml

WORKDIR /app

COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

COPY . /app
RUN php -r 'exit(PHP_VERSION === trim(file_get_contents(".php-version")) ? 0 : 1);'
RUN composer install --no-progress --no-interaction

# Development stage
FROM base AS development

RUN install-php-extensions pcov pcntl

# Production stage
FROM base AS production

# Copy app and finalize install
COPY . /app
RUN composer install --no-progress --no-interaction --optimize-autoloader

# Reference: https://laravel.com/docs/12.x/deployment#directory-permissions
RUN mkdir -p /app/storage/framework/views && \
    chown -R www-data:www-data /app/storage /app/bootstrap/cache && \
    chmod -R 775 /app/storage /app/bootstrap/cache
