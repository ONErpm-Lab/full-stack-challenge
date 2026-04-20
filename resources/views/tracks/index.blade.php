<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Faixas por ISRC</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body { font-family: Arial; margin: 20px; }
        .track { border-bottom: 1px solid #ccc; padding: 20px 0; display: flex; flex-direction: column; }
        img { max-width: 100px; }
        @media (min-width: 600px) {
            .track { flex-direction: row; gap: 20px; }
        }
    </style>
</head>
<body>
    <h1>Lista de Faixas</h1>
    @foreach($tracks as $track)
        <div class="track">
            <img src="{{ $track->album_thumb }}" alt="Thumb">
            <div>
                <h2>{{ $track->title }}</h2>
                <p><strong>Artistas:</strong> {{ $track->artists }}</p>
                <p><strong>Lançamento:</strong> {{ $track->release_date }}</p>
                <p><strong>Duração:</strong> {{ $track->duration }}</p>
                <p>
                    @if($track->preview_url)
                        <audio controls>
                            <source src="{{ $track->preview_url }}" type="audio/mpeg">
                            Seu navegador não suporta áudio.
                        </audio>
                    @else
                        Prévia não disponível
                    @endif
                </p>
                <p><a href="{{ $track->spotify_url }}" target="_blank">Ver no Spotify</a></p>
                <p>Disponível no Brasil? <strong>{{ $track->available_in_br ? 'Sim' : 'Não' }}</strong></p>
            </div>
        </div>
    @endforeach
</body>
</html>
