# Symfony Mercure Integration POC 

This project is based on [Symfony Docker](https://github.com/dunglas/symfony-docker). It comes bundled with Caddy, Mercure, PHP 8.3.6 and Symfony 7.0.7.

## Getting Started

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --no-cache` to build fresh images
3. Run `docker compose up --pull always -d --wait` to set up and start a fresh Symfony project
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker compose down --remove-orphans` to stop the Docker containers.

## Features

**Explain how this works**
