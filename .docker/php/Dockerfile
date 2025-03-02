FROM php:8.4-apache AS base

# Install dependencies for PHP extensions
RUN apt-get update && apt-get install -y \
    # for PHP zip extension
    libzip-dev \
    zip \
    # for PHP intl extension
    libicu-dev \
    # for PHP pdo_pgsql extension
    libpq-dev \
    # for PHP mbstring extension
    libonig-dev \
    # for PHP xml extension
    libxml2-dev
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install -j$(nproc) pdo pdo_pgsql zip intl mbstring xml

## Configure Apache
RUN a2enmod rewrite
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf
RUN echo "ServerName localhost" >> /etc/apache2/apache2.conf

# Install and configure Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer
ENV COMPOSER_ALLOW_SUPERUSER=1

WORKDIR /var/www/html

# Install composer dependencies
COPY composer.* .
RUN composer install --no-dev --no-scripts --no-autoloader --no-progress --no-interaction

# Development
FROM base AS development
RUN mv "$PHP_INI_DIR/php.ini-development" "$PHP_INI_DIR/php.ini"
COPY . .
RUN chown -R www-data:www-data storage bootstrap/cache
RUN composer install --no-progress --no-interaction

# Production
FROM base
COPY . .
RUN chown -R www-data:www-data storage bootstrap/cache
RUN composer install --no-progress --no-interaction --optimize-autoloader
