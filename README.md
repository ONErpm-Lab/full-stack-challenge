# PHP - Spotify API Consumer

## Requirements

- **Composer** ≥ 2.8.3  
- **PHP** ≥ 8.2

## 🚀 Installation and Execution

1 - Access the Spotify Developers dashboard, log in, and create your own app:
    https://developer.spotify.com/dashboard

2 - Copy the example environment file and create your own `.env` file. Update the Spotify constants with your own credentials:
```
cp .env.example .env
```

Install backend dependencies:
```
composer install
```

Generate the application key:
```
php artisan key:generate
```

Run database migrations:
```
php artisan migrate
```

Start the development server:
```
php artisan serve
```

## Run the spotify track migration command

You can run the command either with or without an ISRC parameter:

1 - Run with an ISRC parameter:
```
php artisan app:import-spotify-tracks USUR10301225
```

2 - Run without any parameter (imports the default dataset):
```
php artisan app:import-spotify-tracks
```
