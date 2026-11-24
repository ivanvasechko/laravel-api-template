# Laravel API Template
The skeleton for API application with Laravel

# Setup

## Prerequisites

- [Docker](https://docs.docker.com/desktop/)
- [Docker Compose](https://docs.docker.com/compose/)

## PHP security updates

Docker and all CI workflows use PHP 8.5.13, the latest PHP 8.5 security
release as of November 19, 2026. CI reads `.php-version`; the Docker build
checks that its runtime matches that file. When updating PHP, update
`.php-version` and the FrankenPHP image tag in
`.docker/php/Dockerfile` together. Rebuild with `docker compose build --pull`
and run the project quality checks before merging.

CI also audits locked Composer dependencies, including development packages.
Docker uses version tags rather than SHA digests and applies available Alpine
security updates during each uncached build.

## Running the application

To run the application, follow the steps below:

1. Copy the `compose.override.yml.example` file to `compose.override.yml`. Modify the file as needed.
2. Build and start up the containers in the stack using this command
    ```bash
    docker-compose up --build
    ```
3. Run the Laravel migrations
    ```bash
    docker-compose exec app php artisan migrate
    ```
