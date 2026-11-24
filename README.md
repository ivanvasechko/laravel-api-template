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
and run the project quality checks before merging. Use
`docker compose build --pull --no-cache` to refresh Alpine security packages
even when the upstream image tag has not changed.

CI also audits locked Composer dependencies, including development packages.
Docker uses version tags rather than SHA digests and applies available Alpine
security updates during each uncached build.

PostgreSQL stays on major version 17 and uses 17.12 in both Compose and CI.
Both build `.docker/postgres/Dockerfile` to apply available Alpine security
patches. Dependabot monitors both Dockerfiles for version updates.

### Container audit limits (November 24, 2026)

Trivy reports no Alpine package vulnerabilities after these updates.
It still flags three advisories in FrankenPHP's embedded `go-jose/v3`
(CVE-2026-116585, CVE-2026-116586, CVE-2026-116587), with no fixed v3
version reported. These remain upstream follow-ups; the container scan
is not completely clean. A `govulncheck` binary scan reported no findings,
but that does not establish that every scanner advisory is inapplicable.

Trivy also flags Go module/compiler advisories in PostgreSQL's `gosu` helper.
The identical upstream gosu 1.20 binary reports zero affected symbols with
`govulncheck`. Its [upstream security policy](https://github.com/tianon/gosu/blob/master/SECURITY.md)
explains why unused vulnerable Go interfaces do not warrant rebuilding gosu.

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
