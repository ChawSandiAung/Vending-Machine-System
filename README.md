# Vending Machine System — Laravel + Docker (PHP-FPM)

A minimal, developer-friendly Docker setup for a Laravel application using PHP-FPM and MySQL. This README provides step‑by‑step instructions to get the app running locally, common fixes, and how to push to Git.

---

## Prerequisites

- Docker Engine (and Docker Compose v2 — docker compose syntax)
- Optionally: Composer (or use the Composer container to bootstrap Laravel)
- Git (for pushing to remote)

---

## Repo layout (expected)



├── vending-machine/ # Laravel project (contains artisan, app/, routes/, etc.)

│ ├── Dockerfile

│ ├── docker-compose.yml

│ └── README.md


---

## Quick start (recommended)

1. Clone the repository

git clone https://github.com/tahs01/vending-machine-system.git
cd vending-machine

Copy environment variables
cp .env.example .env

# Set minimum DB settings in .env

# Example .env database configuration:

DB_CONNECTION=mysql
DB_HOST=db
DB_PORT=3306
DB_DATABASE=vending-machine
DB_USERNAME=laravel
DB_PASSWORD=laravelpassword

# Build and start containers
docker compose up -d --build

# Generate app key & cache config
docker compose exec app php artisan key:generate
docker compose exec app php artisan config:cache

# (Optional) Create sessions table and run migrations

# If you want DB-backed sessions (default in some setups), run:

docker compose exec app php artisan session:table
docker compose exec app php artisan migrate

# Restart containers and open the app
docker compose down
docker compose up -d


# Open your browser at http://localhost:8000

# Common commands
# Clear caches:
docker compose exec app php artisan config:clear
docker compose exec app php artisan cache:clear
docker compose exec app php artisan route:clear
docker compose exec app php artisan view:clear
---

# Default credentials

## Admin user

Email: admin@example.com
Password: Test@123

Regular user

Email: user@example.com
Password: password