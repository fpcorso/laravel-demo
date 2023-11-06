# Laravel Demo

This repo is for a blog series that I am working on over on my dev blog. Will update here once the first post is published.

## Built With

* [Laravel](https://laravel.com/) - The web framework used
* [Laravel Sail](https://laravel.com/docs/10.x/sail) - Quick Docker environment for Laravel
* [Laravel Telescope](https://laravel.com/docs/10.x/telescope) - Debugging tool
* [PostgreSQL](https://www.postgresql.org/) - Database
* [Redis](https://redis.io/) - Cache and Queue

## Getting Started

**Sail Note:** If you are going to be doing a lot of working in this repo, you may want to set an alias for sail so you don't have to type out the full path each time. You can use this:

```
alias sail='[ -f sail ] && sh sail || sh vendor/bin/sail'
```

To get started, clone the repo and run the following commands to install the composer packages, generate the app key, and run database migrations:

```
composer install
cp .env.example .env
./vendor/bin/sail up -d
./vendor/bin/sail artisan key:generate
./vendor/bin/sail artisan migrate
```