FROM dunglas/frankenphp:1.14.0-php8.5.13-alpine AS base

RUN apk upgrade --no-cache

ENV SERVER_NAME=:80

RUN install-php-extensions \
    pdo_pgsql pdo_sqlite zip intl mbstring xml

WORKDIR /app

COPY --from=composer:2.11.2 /usr/bin/composer /usr/bin/composer

COPY . /app
RUN php -r '$expected = trim(file_get_contents(".php-version")); if (PHP_VERSION !== $expected) { fwrite(STDERR, "Expected PHP $expected, got " . PHP_VERSION . PHP_EOL); exit(1); }'
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
