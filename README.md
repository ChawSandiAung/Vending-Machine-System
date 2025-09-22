# Vending Machine System — Laravel + Docker (PHP-FPM)

A minimal, developer-friendly Docker setup for a Laravel application using **PHP-FPM** and **MySQL**. This README provides step‑by‑step instructions to get the app running locally, common fixes, and how to push to Git.

---

## Prerequisites

* Docker Engine (and Docker Compose v2 — `docker compose` syntax).
* Optionally: Composer (or use the Composer container to bootstrap Laravel).
* Git (for pushing to remote).

---

## Repo layout

```
├── vending-machine/        # Laravel project (contains artisan, app/, routes/, etc.)
│   ├── Dockerfile
│   └── docker-compose.yml
|   └── README.md
```

---

## Steps to set-up

1. Git clone `git clone https://github.com/ChawSandiAung/Vending-Machine-System.git `

2. Copy environment variables `cp .env.example .env`

3. Minimum DB settings in `laravel-app/.env` (example):

```ini
DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=vending_machine
DB_USERNAME=laravel
DB_PASSWORD=laravelpassword
```

 4. Build and start containers:

```bash
# from repo root
docker compose up -d --build
```

5.  Generate app key & cache config:

```bash
docker compose exec app php artisan key:generate
docker compose exec app php artisan config:cache
```

 If you want DB-backed sessions (default in some setups), create the sessions table and run migrations:

```bash
# create sessions migration
docker compose exec app php artisan session:table
# run all migrations
docker compose exec app php artisan migrate
docker compose exec app php artisan migrate --seed
```

* Restart containers and open `http://localhost:8000`.

---

# Default credentials

## Admin user

Email: admin@gmail.com
Password: Test@123

## Regular user

Email: user@gmail.com
Password: User@123