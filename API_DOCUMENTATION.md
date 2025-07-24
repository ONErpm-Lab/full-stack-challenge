# API Documentation - Tracks

Esta documentação descreve os endpoints da API para gerenciamento de faixas musicais (tracks) do projeto Roger Backend Challenge.

## Base URL

```
http://localhost:8000/api
```

## Endpoints

### 1. Listar Faixas

**GET** `/tracks`

Lista todas as faixas com suporte a filtros, busca, ordenação e paginação.

#### Parâmetros de Query (opcionais)

| Parâmetro | Tipo | Descrição | Valores Aceitos                      | Padrão |
|-----------|------|-----------|--------------------------------------|--------|
| `search` | string | Busca por nome da faixa ou ISRC | Máximo 255 caracteres                | - |
| `available_in_brazil` | boolean | Filtra por disponibilidade no Brasil | `0`, `1`                             | - |
| `artist` | string | Filtra por nome do artista | Máximo 255 caracteres                | - |
| `sort` | string | Campo para ordenação | `name`, `created_at`, `release_date` | `name` |
| `direction` | string | Direção da ordenação | `asc`, `desc`                        | `asc` |
| `per_page` | integer | Itens por página | 1-100                                | 15 |
| `page` | integer | Número da página | Mínimo 1                             | 1 |

#### Exemplo de Requisição

```http
GET /api/tracks?search=love&available_in_brazil=1&sort=name&direction=asc&per_page=10&page=1
```

#### Exemplo de Resposta

```json
{
  "data": [
    {
      "id": 2,
      "isrc": "BR1SP1200071",
      "spotify_id": "4s71Bub5KzXBSMyE8nlH4E",
      "name": "É pra Você",
      "duration": "02:57",
      "duration_ms": 177626,
      "preview_url": null,
      "spotify_url": "https://open.spotify.com/track/4s71Bub5KzXBSMyE8nlH4E",
      "thumb_url": "https://i.scdn.co/image/ab67616d0000b2733efb91ce3d4c540d8bdcb312",
      "available_in_brazil": true,
      "created_at": "2025-07-24T04:04:04.000000Z",
      "updated_at": "2025-07-24T04:04:04.000000Z",
      "album": {
        "id": 2,
        "spotify_id": "2DhdYMG5ecPrLbSsTbznz1",
        "name": "É pra Você",
        "release_date": "25 Mar 2014",
        "thumb_url": "https://i.scdn.co/image/ab67616d0000b2733efb91ce3d4c540d8bdcb312",
        "spotify_url": "https://open.spotify.com/album/2DhdYMG5ecPrLbSsTbznz1",
        "created_at": "2025-07-24T04:04:04.000000Z",
        "updated_at": "2025-07-24T04:04:04.000000Z"
      },
      "artists": [
        {
          "id": 2,
          "spotify_id": "3IeOkdKc5Z0WTTCLVyMyT5",
          "name": "Gó Gó Boys",
          "spotify_url": "https://open.spotify.com/artist/3IeOkdKc5Z0WTTCLVyMyT5",
          "created_at": "2025-07-24T04:04:04.000000Z",
          "updated_at": "2025-07-24T04:04:04.000000Z"
        }
      ]
    }
  ],
  "links": {
    "first": "http://localhost:8000/api/tracks?sort=name&direction=asc&per_page=15&page=1",
    "last": "http://localhost:8000/api/tracks?sort=name&direction=asc&per_page=15&page=1",
    "prev": null,
    "next": null
  },
  "meta": {
    "current_page": 1,
    "from": 1,
    "last_page": 1,
    "links": [
      {
        "url": null,
        "label": "&laquo; Previous",
        "active": false
      },
      {
        "url": "http://localhost:8000/api/tracks?sort=name&direction=asc&per_page=15&page=1",
        "label": "1",
        "active": true
      },
      {
        "url": null,
        "label": "Next &raquo;",
        "active": false
      }
    ],
    "path": "http://localhost:8000/api/tracks",
    "per_page": 15,
    "to": 8,
    "total": 8
  }
}
```

### 2. Obter Faixa Específica

**GET** `/tracks/{id}`

Retorna os detalhes de uma faixa específica.

#### Parâmetros de URL

| Parâmetro | Tipo | Descrição |
|-----------|------|-----------|
| `id` | integer | ID da faixa |

#### Exemplo de Requisição

```http
GET /api/tracks/1
```

#### Exemplo de Resposta

```json
{
  "data": {
    "id": 1,
    "isrc": "BRC310600002",
    "spotify_id": "4lwE7ainG51zmxt1xAC7XQ",
    "name": "Repente",
    "duration": "02:50",
    "duration_ms": 170733,
    "preview_url": null,
    "spotify_url": "https://open.spotify.com/track/4lwE7ainG51zmxt1xAC7XQ",
    "thumb_url": "https://i.scdn.co/image/ab67616d0000b2731932184ef8c5c68f8c550c33",
    "available_in_brazil": true,
    "created_at": "2025-07-24T04:04:04.000000Z",
    "updated_at": "2025-07-24T04:04:04.000000Z",
    "album": {
      "id": 1,
      "spotify_id": "4z5tTNSi1MdrKbKz0Riauf",
      "name": "Dez Mãos e um Piano Preparado",
      "release_date": "13 Jun 2013",
      "thumb_url": "https://i.scdn.co/image/ab67616d0000b2731932184ef8c5c68f8c550c33",
      "spotify_url": "https://open.spotify.com/album/4z5tTNSi1MdrKbKz0Riauf",
      "created_at": "2025-07-24T04:04:04.000000Z",
      "updated_at": "2025-07-24T04:04:04.000000Z"
    },
    "artists": [
      {
        "id": 1,
        "spotify_id": "68vvXAJFi8LizXAjGHiWtZ",
        "name": "PianOrquestra",
        "spotify_url": "https://open.spotify.com/artist/68vvXAJFi8LizXAjGHiWtZ",
        "created_at": "2025-07-24T04:04:04.000000Z",
        "updated_at": "2025-07-24T04:04:04.000000Z"
      }
    ]
  }
}
```

## Códigos de Status HTTP

| Código | Descrição |
|--------|-----------|
| 200 | Sucesso |
| 404 | Faixa não encontrada |
| 422 | Erro de validação nos parâmetros |
| 500 | Erro interno do servidor |

## Exemplos de Uso

### Buscar faixas por nome ou ISRC
```http
GET /api/tracks?search=repente
```

### Filtrar faixas disponíveis no Brasil
```http
GET /api/tracks?available_in_brazil=1
```

### Buscar faixas por artista
```http
GET /api/tracks?artist=pianorquestra
```

### Ordenar por data de criação (mais recentes primeiro)
```http
GET /api/tracks?sort=created_at&direction=desc
```

### Combinar múltiplos filtros
```http
GET /api/tracks?search=rock&available_in_brazil=1&artist=pianorquestra&sort=name&direction=asc&per_page=20
```

## Estrutura dos Dados

### Track (Faixa)
- `id`: ID único da faixa
- `isrc`: Código ISRC da faixa
- `spotify_id`: ID da faixa no Spotify
- `name`: Nome da faixa
- `duration`: Duração formatada (mm:ss)
- `duration_ms`: Duração em milissegundos
- `preview_url`: URL do preview de áudio
- `spotify_url`: URL da faixa no Spotify
- `thumb_url`: URL da imagem/thumbnail
- `available_in_brazil`: Disponibilidade no Brasil
- `created_at`: Data de criação
- `updated_at`: Data de atualização
- `album`: Dados do álbum (objeto Album)
- `artists`: Lista de artistas (array de objetos Artist)

### Album (Álbum)
- `id`: ID único do álbum
- `spotify_id`: ID do álbum no Spotify
- `name`: Nome do álbum
- `release_date`: Data de lançamento
- `thumb_url`: URL da imagem do álbum
- `spotify_url`: URL do álbum no Spotify
- `created_at`: Data de criação
- `updated_at`: Data de atualização

### Artist (Artista)
- `id`: ID único do artista
- `spotify_id`: ID do artista no Spotify
- `name`: Nome do artista
- `spotify_url`: URL do artista no Spotify
- `created_at`: Data de criação
- `updated_at`: Data de atualização
