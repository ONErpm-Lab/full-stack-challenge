# Music API

:rocket: **Laravel Octane + Open Swoole + php 8.4**

> API Documentation http://localhost/docs

### Up

```shell
chmod 775 -R storage
cp .env.example .env
docker compose up -d
```

```shell
docker exec -it music-api bash
composer install
npm install
php artisan key:generate
php artisan migrate --seed
```

### Looking for ISRC on Spotify

set the [Spotify credentials](https://developer.spotify.com/documentation/web-api) in the `.env`

```plain
SPOTIFY_CLIENT_ID=
SPOTIFY_CLIENT_SECRET=
```

Execute

```shell
php artisan app:run-pending-isrc
```

### API credentials

```shell
php artisan app:generate-api-token
```
