# Install and Setup Laravel

How to prepare the environment and install Laravel.

## Prerequisites

- Docker Desktop
- WSL

Verify Docker in WSL:

```sh
docker -v
```
## Setup

Create a new Laravel project:

```sh
curl -s "https://laravel.build/your-project-name" | bash
```

Start Sail:

```sh
./vendor/bin/sail up
```

Run Migrations:

```sh
./vendor/bin/sail php artisan migrate
```

Verify that Laravel runs:

http://localhost



