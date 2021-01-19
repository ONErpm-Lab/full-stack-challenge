# Rafael Vega's Solution to OneRPM Full Stack Challenge

This is a web application that displays song metadata and plays audio previews for a list of songs. The metadata is searched in the Soptify Web API based on the songs ISRC numbers.

![Screenshot](client-side/src/assets/screenshot.png)

The application was implemented as two independent applications that communicate via HTTP in a RESTful fashion.

## Server side application

The server side application exposes a REST api that returns all the relevant meta-data for the songs. An example JSON response is listed below.

When a request is received, the MySQL database is queried to see if we already have the information for that song. If we dont't, we fetch the data from the Spotify Web API and store the information in the database for later use.

This was implemented using the Laravel PHP framework version 8 and a MySQL database. The most relevant files to read are:

* [server-side/tests/Feature/SongTest.php](server-side/tests/Feature/SongTest.php)
* [server-side/app/Models/SpotifySong.php](server-side/app/Models/SpotifySong.php)
* [server-side/database/migrations/2021_01_16_214324_create_songs_table.php](server-side/database/migrations/2021_01_16_214324_create_songs_table.php).
* [server-side/app/Http/Controllers/SongController.php](server-side/app/Http/Controllers/SongController.php)
* [server-side/app/Models/Song.php](server-side/app/Models/Song.php)
* [server-side/app/Models/SpotifySong.php](server-side/app/Models/SpotifySong.php)

### Running in a development environment

This has only been tested in an up-to date Arch Linux machine. cd into the `server-side` directory before running any of the commands below.

1. Install dependencies. `composer install`

1. Create two MySQL databases. One should be called onerpmchallenge and onerpmchallenge_test

1. Make two copies of `.env.example` called `.env` and `.env.testing`. Edit those files and make sure you enter the database credentials correctly.

1. Run the database migrations `php artisan migrate`.

1. Run the server side application `php artisan serve`. You will get a message with the http url where the app will be exposed. Take note of this, you'll need it when setting up the client-side app.

1. Make sure the app is running by opening the url in the last point in a web browser.

1. Run the integration tests `php artisan test`

### API Documentation

Request: 

`GET /`

Response:

```json
[
  {
    "isrc": "US7VG1846811",
    "artists": "Patricia Mellodi, Clara Mello",
    "thumb": "https://i.scdn.co/image/ab67616d0000b273dec33cb3719a7430f8beee9b",
    "release_date": "2018-08-24",
    "title": "Facada",
    "duration": "03:46",
    "audio_preview": "https://p.scdn.co/mp3-preview/50a61e93510760f3d853f55231bbec76d04f274f?cid=2ba67ae1b86847f38c70ca85f90ededf",
    "spotify_link": "https://open.spotify.com/track/3bJ2MLOtyfpMMLyP5GGjES",
    "available_in_br": 1
  },
  {
    "isrc": "US7QQ1846811",
    "artists": "",
    "thumb": "",
    "release_date": "1970-01-01",
    "title": "Track Not Found",
    "duration": "00:00",
    "audio_preview": "",
    "spotify_link": "",
    "available_in_br": 0
  },
  {
    "isrc": "BRC310600002",
    "artists": "PianOrquestra",
    "thumb": "https://i.scdn.co/image/ab67616d0000b2731932184ef8c5c68f8c550c33",
    "release_date": "2013-06-13",
    "title": "Repente",
    "duration": "02:50",
    "audio_preview": "https://p.scdn.co/mp3-preview/e3f05281d972fdbe15d4218d217d7fe06d3e74fb?cid=2ba67ae1b86847f38c70ca85f90ededf",
    "spotify_link": "https://open.spotify.com/track/4lwE7ainG51zmxt1xAC7XQ",
    "available_in_br": 1
  },
  {
    "isrc": "BR1SP1200071",
    "artists": "G\u00f3 G\u00f3 Boys",
    "thumb": "https://i.scdn.co/image/ab67616d0000b273c72404fea0415266ac3cce57",
    "release_date": "2014-03-25",
    "title": "\u00c9 pra Voc\u00ea",
    "duration": "02:57",
    "audio_preview": "https://p.scdn.co/mp3-preview/0de61e71bc274f63b02af24faaa7434f9082a3d7?cid=2ba67ae1b86847f38c70ca85f90ededf",
    "spotify_link": "https://open.spotify.com/track/4s71Bub5KzXBSMyE8nlH4E",
    "available_in_br": 1
  },
  {
    "isrc": "BR1SP1200070",
    "artists": "G\u00f3 G\u00f3 Boys",
    "thumb": "https://i.scdn.co/image/ab67616d0000b273e6b52e7684dc9d174df837d6",
    "release_date": "2014-05-12",
    "title": "Quem Diria",
    "duration": "03:22",
    "audio_preview": "https://p.scdn.co/mp3-preview/d2887c8feeb92fce655e3c25cc6f9cbbe0892cda?cid=2ba67ae1b86847f38c70ca85f90ededf",
    "spotify_link": "https://open.spotify.com/track/0kkVPWVKs4MCMbQOOxM6nh",
    "available_in_br": 1
  },
  {
    "isrc": "BR1SP1500002",
    "artists": "Clarisse Grova",
    "thumb": "https://i.scdn.co/image/ab67616d0000b273ae0ab3bffdcf0b830e5998b8",
    "release_date": "2015-08-27",
    "title": "Quase Nua",
    "duration": "04:13",
    "audio_preview": "https://p.scdn.co/mp3-preview/2032efc5d33c8d3c512009d8bc9fddeed96265ca?cid=2ba67ae1b86847f38c70ca85f90ededf",
    "spotify_link": "https://open.spotify.com/track/7u8QESpplZWyZZDsoHeIAX",
    "available_in_br": 1
  },
  {
    "isrc": "BXKZM1900338",
    "artists": "DJ Maskot, MC Madan",
    "thumb": "https://i.scdn.co/image/ab67616d0000b2738662e8e1b80142ff92344518",
    "release_date": "2019-09-27",
    "title": "Sexta Sua Linda",
    "duration": "03:33",
    "audio_preview": "https://p.scdn.co/mp3-preview/19409e1909b3f2daf98a994959ea1b3e07adc23c?cid=2ba67ae1b86847f38c70ca85f90ededf",
    "spotify_link": "https://open.spotify.com/track/4oxx2IYjbvf1a6PGcmzf3O",
    "available_in_br": 1
  },
  {
    "isrc": "BXKZM1900345",
    "artists": "DJ Malibu, MC Pack, MC Gui Andrade",
    "thumb": "https://i.scdn.co/image/ab67616d0000b2731cd3135bb70b14104ad5cec6",
    "release_date": "2019-10-05",
    "title": "Louca",
    "duration": "02:04",
    "audio_preview": "https://p.scdn.co/mp3-preview/83f4d469ae420e45a2fb0c7fb78ec1038c0de055?cid=2ba67ae1b86847f38c70ca85f90ededf",
    "spotify_link": "https://open.spotify.com/track/5w4O21KEy5RBVCiecgmSMo",
    "available_in_br": 1
  },
  {
    "isrc": "QZNJX2081700",
    "artists": "\u041a\u0430\u043f\u0438\u0442\u0430\u043d \u041a\u043e\u0440\u043a\u0438\u043d",
    "thumb": "https://i.scdn.co/image/ab67616d0000b273367f4675c76077f630655f3b",
    "release_date": "2020-12-24",
    "title": "\u041d\u0430\u043c \u043d\u0435 \u043d\u0440\u0430\u0432\u0438\u0442\u0441\u044f",
    "duration": "03:49",
    "audio_preview": "https://p.scdn.co/mp3-preview/8ba4cd8a7e311caa8bd43c6e5ad767aa2cd50f03?cid=2ba67ae1b86847f38c70ca85f90ededf",
    "spotify_link": "https://open.spotify.com/track/2Sg8a9mtv5v6mGEuscIdFx",
    "available_in_br": 1
  },
  {
    "isrc": "QZNJX2078148",
    "artists": "\u041d\u0430\u0434\u044f \u0422\u043e\u0447\u0438\u043b\u043a\u0438\u043d\u0430",
    "thumb": "https://i.scdn.co/image/ab67616d0000b273cdd07497a2fd6ca6c21e31b3",
    "release_date": "2020-12-11",
    "title": "\u0414\u043e\u0432\u0435\u0440\u044e\u0441\u044c \u0441\u043e\u043b\u043d\u0446\u0443",
    "duration": "03:41",
    "audio_preview": "https://p.scdn.co/mp3-preview/be3f50e77c0dd867ee84727836d5b3f4cd25420d?cid=2ba67ae1b86847f38c70ca85f90ededf",
    "spotify_link": "https://open.spotify.com/track/1EIYjzkRSy5rYQOn2VKfZb",
    "available_in_br": 1
  }
]
```

In the back-end, there is a  ` j


* Server side. Create database for devel and for test, create .env and .env.testing from .env.example    php artisan serve and php artisan test



# Original OneRPM README:

## Início

Bem vindo ao mundo da música!

Atualmente temos a necessidade de consumir os dados de faixas musicais através do código ISRC, que é uma das coisas mais importantes na indústria fonográfica.

Segundo [Abramus](https://www.abramus.org.br/musica/isrc/), ISRC (International Standard Recording Code ou Código de Gravação Padrão Internacional) é um padrão internacional de código para identificar de forma única as gravações (faixas).

Ele funciona como um código de barras da faixa.


## Problema

Durante o fechamento de contrato com um produtor, foram informados 10 ISRC's que não constam em nossas bases de dados, que seguem abaixo:

* US7VG1846811
* US7QQ1846811
* BRC310600002
* BR1SP1200071
* BR1SP1200070
* BR1SP1500002
* BXKZM1900338
* BXKZM1900345
* QZNJX2081700
* QZNJX2078148

Precisamos obter e exibir os seguintes dados:

* Thumb do álbum
* Data de lançamento
* Título da faixa
* Lista dos artistas da faixa
* Duração da faixa em minutos e segundos (mm:ss)
* Player com prévia do áudio
* Link para a página da faixa no Spotify
* Sinalização dizendo se a faixa está ou não disponível no Brasil (BR)

Por decisão técnica, temos a necessidade de guardar estas informações em um banco de dados. Para isso, fique livre para criar a estrutura necessária para guardar as informações que achar pertinente das faixas.

Uma vez armazenados os dados, precisamos exibí-los através de uma webpage pública, ordenados por título da faixa de forma alfabética.


## Requisitos

* Faça um fork deste repositório e abra um PR quando estiver finalizado.
* O backend deve ser feito no framework Laravel 7.0 ou superior.
* O banco de dados deve ser MySQL.
* A página deve ser responsiva para atender todos os tipos de dispositivos.
* Use a API do Spotify: [https://developer.spotify.com/](https://developer.spotify.com/) para coletar os dados das faixas.


## Diferencial

* Desenvolver o frontend no Angular 8 ou superior.
* Desenvolver testes unitários e de integração.


## O que será avaliado

* Fidelidade às instruções.
* Padrões de projeto.
* Clean Code e boas práticas.
* Boas práticas de versionamento.


## Perfil que buscamos

* Comunicativo
* Autodidata
* Automotivado
* Curioso
* Gostar de trabalhar em equipe
* Compromissado
