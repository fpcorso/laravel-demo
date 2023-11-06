# Laravel Demo

This repo is for a blog series that I am working on over on my dev blog. Will update here once the first post is published.

## Built With

* [Laravel](https://laravel.com/) - The web framework used
* [Laravel Sail](https://laravel.com/docs/10.x/sail) - Quick Docker environment for Laravel
* [PostgreSQL](https://www.postgresql.org/) - Database
* [Redis](https://redis.io/) - Cache and Queue

## Getting Started

To get started, clone the repo and run the following commands to install the composer packages, generate the app key, and run database migrations:

```
composer install
cp .env.example .env
./vendor/bin/sail up -d
docker-compose exec laravel.test php artisan key:generate
docker-compose exec laravel.test php artisan migrate
```