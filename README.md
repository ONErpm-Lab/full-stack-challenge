# TracksONErpm Backend and Frontend

This is a web application that allows you to manage and display track information from Spotify's API. It consists of a backend built with Laravel and a frontend built with Angular.

## Table of Contents

- [Getting Started](#getting-started)
  - [Prerequisites](#prerequisites)
  - [Installation](#installation)
  - [Using Docker](#using-docker)
- [Usage](#usage)
- [Endpoints](#endpoints)
- [Testing](#testing)
- [About Me](#about-me)
- [Skills](#skills)

## Getting Started

### Prerequisites

- Docker

### Installation

1. Clone the repository and define variables:

```bash
    git clone https://github.com/carlosleonardoms/full-stack-challenge.git
    cd full-stack-challenge/tracks-backend
    cp .env.dev .env
```
# Start Infrastructure

1. Build the Docker images:

```bash
    docker compose --project-name=onerpm-tracks build
```

2. Start the containers:

```bash
    docker compose --project-name=onerpm-tracks up -d
```
3. Set dependencies:

```bash
    docker exec -it onerpm-tracks-backend-1 bash
    composer install
    php artisan migrate
```

## Usage
Visit http://localhost to access the frontend.

Use the frontend to add, view, and get track information from Spotify.

API routes are available at http://localhost:8005/api.

## Endpoints
The RESTFull endpoints available under /api/tracks are GET,POST, and DELETE.

The Spotify Integration lives under GET:/api/spotify-tracks. 

## Testing
Backend tests (Laravel): Run the following command inside the backend directory:

```bash
    docker exec -it onerpm-tracks-backend-1 bash
    php artisan test
```

## 🚀 About Me

I am a highly motivated, self-taught developer seeking to grow in my career building web applications and services. Familiar with the development and deployment process for many web-based technologies.


## 🛠 Skills
PHP, Laravel, Javascript, Angular, MySQL, AWS, Docker, HTML, CSS

[![linkedin](https://img.shields.io/badge/linkedin-0A66C2?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/carlosleonardoms/)