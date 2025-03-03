# AI Blog Summarizer API

## Project Setup

### Requirements:
- php 8.4 with composer installed
- pgsql (can be changed in `.env` file)

### Set env variables

```sh
cp .env.example .env
```

You need to configure `.env` file with your own values:

- Configure database credentials: `DB_*` variables
- Configure OpenAI credentials: `OPENAI_*` variables

### Install and Serve for Development

```sh
composer install
php artisan test
php artisan migrate
php artisan serve
```
