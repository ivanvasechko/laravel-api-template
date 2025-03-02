# Laravel API Template
The skeleton for API application with Laravel

# Setup

## Prerequisites

- [Docker](https://docs.docker.com/desktop/)
- [Docker Compose](https://docs.docker.com/compose/)

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
