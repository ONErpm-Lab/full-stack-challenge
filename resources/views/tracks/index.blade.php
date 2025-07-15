<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Spotify Tracks</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-light">
<div class="container py-4">
    <h1 class="mb-4">Spotify Tracks</h1>

    @foreach ($tracks as $track)
        <div class="card mb-3 text-dark">
            <div class="row g-0">
                <div class="col-md-2">
                    <img src="{{ $track['thumb_url'] }}" alt="Album cover" class="img-fluid rounded-start">
                </div>
                <div class="col-md-10">
                    <div class="card-body">
                        <h5 class="card-title">{{ $track['title'] }}</h5>
                        <p class="card-text">
                            <strong>Artists: </strong>{{ $track['artists'] }}<br>
                            <strong>Duration: </strong>{{ $track['duration'] }}<br>
                            <strong>Release: </strong>{{ $track['release_date'] }}<br>
                            <strong>Available in BR: </strong>
                            <span class="badge {{ $track['avaliable_in_brazil'] ? 'bg-success' : 'bg-danger' }}">
                                {{ $track['avaliable_in_brazil'] ? 'Yes' : 'No' }}
                            </span>
                        </p>
                        @if ($track['preview_url'])
                            <audio controls src="{{ $track['preview_url'] }}"></audio>
                        @endif
                        <p class="mt-2">
                            <a href="{{ $track['spotify_url'] }}" target="_blank" class="btn btn-sm btn-primary">
                                View on Spotify
                            </a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>
</body>
</html>
