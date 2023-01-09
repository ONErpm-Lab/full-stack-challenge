import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class MockService {

  getAllTracks(): any[] {
    return [
      {
        "id": 1,
        "isrc": "US7VG1846811",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273dec33cb3719a7430f8beee9b",
        "release_date": "2018-08-24 00:00:00",
        "title": "Facada",
        "length": "03:47",
        "spotify_url": "https:\/\/open.spotify.com\/track\/3bJ2MLOtyfpMMLyP5GGjES",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/46a89b86f55a20c0254587f211b6e2f7f3d0bdaf?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "3bJ2MLOtyfpMMLyP5GGjES",
        "created_at": "2023-01-09T05:22:48.000000Z",
        "updated_at": "2023-01-09T05:22:48.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 1,
            "spotify_id": "7N1zM9k3EcfF6RIWF6FPD7",
            "name": "Patricia Mellodi",
            "created_at": "2023-01-09T05:22:48.000000Z",
            "updated_at": "2023-01-09T05:22:48.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 1,
              "artist_id": 1
            }
          },
          {
            "id": 2,
            "spotify_id": "5INFxjFQxXF5QKhDfbWlUL",
            "name": "Clara Mello",
            "created_at": "2023-01-09T05:22:48.000000Z",
            "updated_at": "2023-01-09T05:22:48.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 1,
              "artist_id": 2
            }
          }
        ]
      },
      {
        "id": 2,
        "isrc": "BRC310600002",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b2731932184ef8c5c68f8c550c33",
        "release_date": "2013-06-13 00:00:00",
        "title": "Repente",
        "length": "02:51",
        "spotify_url": "https:\/\/open.spotify.com\/track\/4lwE7ainG51zmxt1xAC7XQ",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/2116d93a1d0745bd4f5dededa3765a616a5f475a?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "4lwE7ainG51zmxt1xAC7XQ",
        "created_at": "2023-01-09T05:23:04.000000Z",
        "updated_at": "2023-01-09T05:23:04.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 3,
            "spotify_id": "68vvXAJFi8LizXAjGHiWtZ",
            "name": "PianOrquestra",
            "created_at": "2023-01-09T05:23:04.000000Z",
            "updated_at": "2023-01-09T05:23:04.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 2,
              "artist_id": 3
            }
          }
        ]
      },
      {
        "id": 3,
        "isrc": "BR1SP1200071",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273e6b52e7684dc9d174df837d6",
        "release_date": "2014-05-12 00:00:00",
        "title": "...\u00c9 pra Voc\u00ea",
        "length": "02:58",
        "spotify_url": "https:\/\/open.spotify.com\/track\/7q7QtMiK9jhob0Md7p715D",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/5691ee37a49e613789aa36f64e12c8c1ffeace32?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "7q7QtMiK9jhob0Md7p715D",
        "created_at": "2023-01-09T05:23:15.000000Z",
        "updated_at": "2023-01-09T05:23:15.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 4,
            "spotify_id": "3IeOkdKc5Z0WTTCLVyMyT5",
            "name": "G\u00f3 G\u00f3 Boys",
            "created_at": "2023-01-09T05:23:15.000000Z",
            "updated_at": "2023-01-09T05:23:15.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 3,
              "artist_id": 4
            }
          }
        ]
      },
      {
        "id": 4,
        "isrc": "BR1SP1200071",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273c72404fea0415266ac3cce57",
        "release_date": "2014-03-25 00:00:00",
        "title": "\u00c9 pra Voc\u00ea",
        "length": "02:58",
        "spotify_url": "https:\/\/open.spotify.com\/track\/4s71Bub5KzXBSMyE8nlH4E",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/5691ee37a49e613789aa36f64e12c8c1ffeace32?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "4s71Bub5KzXBSMyE8nlH4E",
        "created_at": "2023-01-09T05:23:17.000000Z",
        "updated_at": "2023-01-09T05:23:17.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 4,
            "spotify_id": "3IeOkdKc5Z0WTTCLVyMyT5",
            "name": "G\u00f3 G\u00f3 Boys",
            "created_at": "2023-01-09T05:23:15.000000Z",
            "updated_at": "2023-01-09T05:23:15.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 4,
              "artist_id": 4
            }
          }
        ]
      },
      {
        "id": 5,
        "isrc": "BR1SP1200070",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b2737ec238276fe8df80f554e3be",
        "release_date": "2014-07-28 00:00:00",
        "title": "Quem Diria",
        "length": "03:23",
        "spotify_url": "https:\/\/open.spotify.com\/track\/6Ia5DlY0gbdTlw5jV1qNER",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/15d55b30bc5ae46074d4b6d50d1f29df1da7fda0?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "6Ia5DlY0gbdTlw5jV1qNER",
        "created_at": "2023-01-09T05:23:29.000000Z",
        "updated_at": "2023-01-09T05:23:29.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 4,
            "spotify_id": "3IeOkdKc5Z0WTTCLVyMyT5",
            "name": "G\u00f3 G\u00f3 Boys",
            "created_at": "2023-01-09T05:23:15.000000Z",
            "updated_at": "2023-01-09T05:23:15.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 5,
              "artist_id": 4
            }
          }
        ]
      },
      {
        "id": 6,
        "isrc": "BR1SP1200070",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273e6b52e7684dc9d174df837d6",
        "release_date": "2014-05-12 00:00:00",
        "title": "Quem Diria",
        "length": "03:23",
        "spotify_url": "https:\/\/open.spotify.com\/track\/0kkVPWVKs4MCMbQOOxM6nh",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/15d55b30bc5ae46074d4b6d50d1f29df1da7fda0?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "0kkVPWVKs4MCMbQOOxM6nh",
        "created_at": "2023-01-09T05:23:30.000000Z",
        "updated_at": "2023-01-09T05:23:30.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 4,
            "spotify_id": "3IeOkdKc5Z0WTTCLVyMyT5",
            "name": "G\u00f3 G\u00f3 Boys",
            "created_at": "2023-01-09T05:23:15.000000Z",
            "updated_at": "2023-01-09T05:23:15.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 6,
              "artist_id": 4
            }
          }
        ]
      },
      {
        "id": 7,
        "isrc": "BR1SP1500002",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273ae0ab3bffdcf0b830e5998b8",
        "release_date": "2015-08-27 00:00:00",
        "title": "Quase Nua",
        "length": "04:14",
        "spotify_url": "https:\/\/open.spotify.com\/track\/7u8QESpplZWyZZDsoHeIAX",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/ab13ed536e07b02aeebc048b73bc058b66f84ca9?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "7u8QESpplZWyZZDsoHeIAX",
        "created_at": "2023-01-09T05:23:57.000000Z",
        "updated_at": "2023-01-09T05:23:57.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 5,
            "spotify_id": "4tqH8MLYzBqv0BBCNrcO7y",
            "name": "Clarisse Grova",
            "created_at": "2023-01-09T05:23:57.000000Z",
            "updated_at": "2023-01-09T05:23:57.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 7,
              "artist_id": 5
            }
          }
        ]
      },
      {
        "id": 8,
        "isrc": "BXKZM1900338",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b2738662e8e1b80142ff92344518",
        "release_date": "2019-09-27 00:00:00",
        "title": "Sexta Sua Linda",
        "length": "03:34",
        "spotify_url": "https:\/\/open.spotify.com\/track\/4oxx2IYjbvf1a6PGcmzf3O",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/0e44ba2b791d7206eb0b93c2faac73b2eeb9ba5e?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "4oxx2IYjbvf1a6PGcmzf3O",
        "created_at": "2023-01-09T05:24:09.000000Z",
        "updated_at": "2023-01-09T05:24:09.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 6,
            "spotify_id": "3kSqC5qoBoK6HF2bPQtVzx",
            "name": "DJ Maskot",
            "created_at": "2023-01-09T05:24:09.000000Z",
            "updated_at": "2023-01-09T05:24:09.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 8,
              "artist_id": 6
            }
          },
          {
            "id": 7,
            "spotify_id": "35d9HY68hiP3dEPohszJlh",
            "name": "MC Madan",
            "created_at": "2023-01-09T05:24:09.000000Z",
            "updated_at": "2023-01-09T05:24:09.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 8,
              "artist_id": 7
            }
          }
        ]
      },
      {
        "id": 9,
        "isrc": "BXKZM1900345",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b2731cd3135bb70b14104ad5cec6",
        "release_date": "2019-10-05 00:00:00",
        "title": "Louca",
        "length": "02:05",
        "spotify_url": "https:\/\/open.spotify.com\/track\/5w4O21KEy5RBVCiecgmSMo",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/f5be436d7314049700140fce797a797c9793b309?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "5w4O21KEy5RBVCiecgmSMo",
        "created_at": "2023-01-09T05:24:18.000000Z",
        "updated_at": "2023-01-09T05:24:18.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 8,
            "spotify_id": "4L8Oinspwt52TOH9afx80o",
            "name": "DJ Malibu",
            "created_at": "2023-01-09T05:24:18.000000Z",
            "updated_at": "2023-01-09T05:24:18.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 9,
              "artist_id": 8
            }
          },
          {
            "id": 9,
            "spotify_id": "0m4p9bFcCB7xFbOBnSZqDJ",
            "name": "MC Pack",
            "created_at": "2023-01-09T05:24:18.000000Z",
            "updated_at": "2023-01-09T05:24:18.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 9,
              "artist_id": 9
            }
          },
          {
            "id": 10,
            "spotify_id": "1UFLR3TTJAODTIog5FNv3e",
            "name": "MC Gui Andrade",
            "created_at": "2023-01-09T05:24:18.000000Z",
            "updated_at": "2023-01-09T05:24:18.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 9,
              "artist_id": 10
            }
          }
        ]
      },
      {
        "id": 10,
        "isrc": "BXKZM1900345",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b27331a27cbe5ca525fd27e16e5b",
        "release_date": "2019-10-04 00:00:00",
        "title": "Louca",
        "length": "02:05",
        "spotify_url": "https:\/\/open.spotify.com\/track\/1Esxp6lXJWU7TaOQM2JsQn",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/a15e68045b77099d93955c5cf62e5ca0721e8129?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "1Esxp6lXJWU7TaOQM2JsQn",
        "created_at": "2023-01-09T05:24:19.000000Z",
        "updated_at": "2023-01-09T05:24:19.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 8,
            "spotify_id": "4L8Oinspwt52TOH9afx80o",
            "name": "DJ Malibu",
            "created_at": "2023-01-09T05:24:18.000000Z",
            "updated_at": "2023-01-09T05:24:18.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 10,
              "artist_id": 8
            }
          },
          {
            "id": 9,
            "spotify_id": "0m4p9bFcCB7xFbOBnSZqDJ",
            "name": "MC Pack",
            "created_at": "2023-01-09T05:24:18.000000Z",
            "updated_at": "2023-01-09T05:24:18.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 10,
              "artist_id": 9
            }
          },
          {
            "id": 10,
            "spotify_id": "1UFLR3TTJAODTIog5FNv3e",
            "name": "MC Gui Andrade",
            "created_at": "2023-01-09T05:24:18.000000Z",
            "updated_at": "2023-01-09T05:24:18.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 10,
              "artist_id": 10
            }
          }
        ]
      },
      {
        "id": 11,
        "isrc": "QZNJX2081700",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273367f4675c76077f630655f3b",
        "release_date": "2020-12-24 00:00:00",
        "title": "\u041d\u0430\u043c \u043d\u0435 \u043d\u0440\u0430\u0432\u0438\u0442\u0441\u044f",
        "length": "03:50",
        "spotify_url": "https:\/\/open.spotify.com\/track\/2Sg8a9mtv5v6mGEuscIdFx",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/2f9b1823463d8ff64485073f2e912b1d3baed080?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "2Sg8a9mtv5v6mGEuscIdFx",
        "created_at": "2023-01-09T05:24:28.000000Z",
        "updated_at": "2023-01-09T05:24:28.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 11,
            "spotify_id": "18tiQfwxC3Kh0dmGUqx05F",
            "name": "\u041a\u0430\u043f\u0438\u0442\u0430\u043d \u041a\u043e\u0440\u043a\u0438\u043d",
            "created_at": "2023-01-09T05:24:28.000000Z",
            "updated_at": "2023-01-09T05:24:28.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 11,
              "artist_id": 11
            }
          }
        ]
      },
      {
        "id": 12,
        "isrc": "QZNJX2078148",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273cdd07497a2fd6ca6c21e31b3",
        "release_date": "2020-12-11 00:00:00",
        "title": "\u0414\u043e\u0432\u0435\u0440\u044e\u0441\u044c \u0441\u043e\u043b\u043d\u0446\u0443",
        "length": "03:42",
        "spotify_url": "https:\/\/open.spotify.com\/track\/1EIYjzkRSy5rYQOn2VKfZb",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/74ead3f54a12f2b8c8d389e960ad2c0348218dd4?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "1EIYjzkRSy5rYQOn2VKfZb",
        "created_at": "2023-01-09T05:24:36.000000Z",
        "updated_at": "2023-01-09T05:24:36.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 12,
            "spotify_id": "5CP1F3lO9qNaHJPPM0F4FZ",
            "name": "\u041d\u0430\u0434\u044f \u0422\u043e\u0447\u0438\u043b\u043a\u0438\u043d\u0430",
            "created_at": "2023-01-09T05:24:36.000000Z",
            "updated_at": "2023-01-09T05:24:36.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 12,
              "artist_id": 12
            }
          }
        ]
      },
      {
        "id": 13,
        "isrc": "JPU901401919",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b2730735b9b1d06b65bbd8814825",
        "release_date": "2015-02-25 00:00:00",
        "title": "\u5149\u308b\u306a\u3089",
        "length": "04:13",
        "spotify_url": "https:\/\/open.spotify.com\/track\/2BlDX1yfT0ea5wo0vjCKKa",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/64564d6a136e940da435c3cfa873838e712d3ed9?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "2BlDX1yfT0ea5wo0vjCKKa",
        "created_at": "2023-01-09T05:27:19.000000Z",
        "updated_at": "2023-01-09T05:27:19.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 13,
            "spotify_id": "7BzEKSgHp2yrNC6w5NkFhQ",
            "name": "Goose house",
            "created_at": "2023-01-09T05:27:19.000000Z",
            "updated_at": "2023-01-09T05:27:19.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 13,
              "artist_id": 13
            }
          }
        ]
      },
      {
        "id": 14,
        "isrc": "JPU901401919",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273df77f0ec50e27f01dd122d1f",
        "release_date": "2014-11-19 00:00:00",
        "title": "\u5149\u308b\u306a\u3089",
        "length": "04:15",
        "spotify_url": "https:\/\/open.spotify.com\/track\/2cwvwUyyjjFsv55EywX9Zo",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/64564d6a136e940da435c3cfa873838e712d3ed9?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "2cwvwUyyjjFsv55EywX9Zo",
        "created_at": "2023-01-09T05:27:21.000000Z",
        "updated_at": "2023-01-09T05:27:21.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 13,
            "spotify_id": "7BzEKSgHp2yrNC6w5NkFhQ",
            "name": "Goose house",
            "created_at": "2023-01-09T05:27:19.000000Z",
            "updated_at": "2023-01-09T05:27:19.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 14,
              "artist_id": 13
            }
          }
        ]
      },
      {
        "id": 15,
        "isrc": "JPU901901394",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b2733492c68445c4135f4aa27105",
        "release_date": "2020-03-24 00:00:00",
        "title": "Good Morning World!",
        "length": "04:10",
        "spotify_url": "https:\/\/open.spotify.com\/track\/6bfDSsy4wnpn6B0de8Qrbx",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/2e8b96f4b0f0b74a6b289946f39805cbefa462ab?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "6bfDSsy4wnpn6B0de8Qrbx",
        "created_at": "2023-01-09T05:29:23.000000Z",
        "updated_at": "2023-01-09T05:29:23.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 14,
            "spotify_id": "0Oazwl71qoHvXnbSxv0wOT",
            "name": "BURNOUT SYNDROMES",
            "created_at": "2023-01-09T05:29:23.000000Z",
            "updated_at": "2023-01-09T05:29:23.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 15,
              "artist_id": 14
            }
          }
        ]
      },
      {
        "id": 16,
        "isrc": "JPU901602724",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273930a00c3c32190bad09c61c0",
        "release_date": "2016-10-26 00:00:00",
        "title": "\u30d2\u30ab\u30ea\u30a2\u30ec",
        "length": "04:05",
        "spotify_url": "https:\/\/open.spotify.com\/track\/2KP76NyUIH8XNvWa84lRPi",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/130e187f44ba702016751e480aa51c756f083650?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "2KP76NyUIH8XNvWa84lRPi",
        "created_at": "2023-01-09T05:31:00.000000Z",
        "updated_at": "2023-01-09T05:31:00.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 14,
            "spotify_id": "0Oazwl71qoHvXnbSxv0wOT",
            "name": "BURNOUT SYNDROMES",
            "created_at": "2023-01-09T05:29:23.000000Z",
            "updated_at": "2023-01-09T05:29:23.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 16,
              "artist_id": 14
            }
          }
        ]
      },
      {
        "id": 17,
        "isrc": "JPU901602724",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b2733492c68445c4135f4aa27105",
        "release_date": "2020-03-24 00:00:00",
        "title": "\u30d2\u30ab\u30ea\u30a2\u30ec",
        "length": "04:04",
        "spotify_url": "https:\/\/open.spotify.com\/track\/2NX12jtlEpovPz19Q5OYcY",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/3e50c191f7d2386eee260372a5a3a7b75ed76d1d?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "2NX12jtlEpovPz19Q5OYcY",
        "created_at": "2023-01-09T05:31:03.000000Z",
        "updated_at": "2023-01-09T05:31:03.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 14,
            "spotify_id": "0Oazwl71qoHvXnbSxv0wOT",
            "name": "BURNOUT SYNDROMES",
            "created_at": "2023-01-09T05:29:23.000000Z",
            "updated_at": "2023-01-09T05:29:23.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 17,
              "artist_id": 14
            }
          }
        ]
      },
      {
        "id": 18,
        "isrc": "JPP302101986",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273cc4fbd1e1ad650bea96e1fc9",
        "release_date": "2022-02-21 00:00:00",
        "title": "\u88f8\u306e\u52c7\u8005",
        "length": "03:22",
        "spotify_url": "https:\/\/open.spotify.com\/track\/0KmWLURMOpAqYwetgdScXk",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/e03de28372029f2448e658bd23c3b04f46392fd5?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "0KmWLURMOpAqYwetgdScXk",
        "created_at": "2023-01-09T05:32:57.000000Z",
        "updated_at": "2023-01-09T05:32:57.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 15,
            "spotify_id": "2IUl3m1H1EQ7QfNbNWvgru",
            "name": "Vaundy",
            "created_at": "2023-01-09T05:32:57.000000Z",
            "updated_at": "2023-01-09T05:32:57.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 18,
              "artist_id": 15
            }
          }
        ]
      },
      {
        "id": 19,
        "isrc": "JPB602202365",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273a873ce4c458e732a422d342f",
        "release_date": "2022-05-20 00:00:00",
        "title": "\u30c1\u30ad\u30c1\u30ad\u30d0\u30f3\u30d0\u30f3",
        "length": "03:23",
        "spotify_url": "https:\/\/open.spotify.com\/track\/7xm0KJMfeaJQmQdDxAipiY",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/58ebf28cd56c71bbc655fa3f391676e0c4e7e05a?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "7xm0KJMfeaJQmQdDxAipiY",
        "created_at": "2023-01-09T05:33:55.000000Z",
        "updated_at": "2023-01-09T05:33:55.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 16,
            "spotify_id": "6IW91qUpcrhbGuZxubrG70",
            "name": "QUEENDOM",
            "created_at": "2023-01-09T05:33:55.000000Z",
            "updated_at": "2023-01-09T05:33:55.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 19,
              "artist_id": 16
            }
          }
        ]
      },
      {
        "id": 20,
        "isrc": "JPT552200428",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b2735509392397c9a5d06bbf9931",
        "release_date": "2022-05-25 00:00:00",
        "title": "\u6c17\u5206\u4e0a\u3005\u2191\u2191",
        "length": "03:52",
        "spotify_url": "https:\/\/open.spotify.com\/track\/4b55RzNokHkNtw0DhmEbdv",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/10e179faf9272bf2b71e49eece4490427648b1fc?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "4b55RzNokHkNtw0DhmEbdv",
        "created_at": "2023-01-09T05:34:41.000000Z",
        "updated_at": "2023-01-09T05:34:41.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 17,
            "spotify_id": "6Tz3nFnN2k3qvsjgJuCO1p",
            "name": "Kuroneko",
            "created_at": "2023-01-09T05:34:41.000000Z",
            "updated_at": "2023-01-09T05:34:41.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 20,
              "artist_id": 17
            }
          },
          {
            "id": 18,
            "spotify_id": "0NPwoqej9GBiSlvZd89GLa",
            "name": "\u7f6e\u9b8e\u9f8d\u592a\u90ce",
            "created_at": "2023-01-09T05:34:41.000000Z",
            "updated_at": "2023-01-09T05:34:41.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 20,
              "artist_id": 18
            }
          }
        ]
      },
      {
        "id": 21,
        "isrc": "USAT21300959",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273c8a11e48c91a982d086afc69",
        "release_date": "1971-11-08 00:00:00",
        "title": "Stairway to Heaven - Remaster",
        "length": "08:03",
        "spotify_url": "https:\/\/open.spotify.com\/track\/5CQ30WqJwcep0pYcV4AMNc",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/fc80a280376d5142c888475bd8fdcd00b4fc8d7d?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "5CQ30WqJwcep0pYcV4AMNc",
        "created_at": "2023-01-09T05:38:35.000000Z",
        "updated_at": "2023-01-09T05:38:35.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 19,
            "spotify_id": "36QJpDe2go2KgaRleHCDTp",
            "name": "Led Zeppelin",
            "created_at": "2023-01-09T05:38:35.000000Z",
            "updated_at": "2023-01-09T05:38:35.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 21,
              "artist_id": 19
            }
          }
        ]
      },
      {
        "id": 22,
        "isrc": "GBF089601041",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273c5a897378c8caf5cd11935a6",
        "release_date": "1978-10-07 00:00:00",
        "title": "Sultans of Swing",
        "length": "05:51",
        "spotify_url": "https:\/\/open.spotify.com\/track\/6cr6UDpkjEaMQ80OjWqEBQ",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/adaf79aa57a8ce9b906f6f5ff3a99382301022a5?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 0,
        "spotify_id": "6cr6UDpkjEaMQ80OjWqEBQ",
        "created_at": "2023-01-09T05:39:22.000000Z",
        "updated_at": "2023-01-09T05:39:22.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 20,
            "spotify_id": "0WwSkZ7LtFUFjGjMZBMt6T",
            "name": "Dire Straits",
            "created_at": "2023-01-09T05:39:22.000000Z",
            "updated_at": "2023-01-09T05:39:22.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 22,
              "artist_id": 20
            }
          }
        ]
      },
      {
        "id": 23,
        "isrc": "CA21O1200002",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273550133f6d334ed152d75aa56",
        "release_date": "2012-02-21 00:00:00",
        "title": "Genesis",
        "length": "04:16",
        "spotify_url": "https:\/\/open.spotify.com\/track\/3cjvqsvvU80g7WJPMVh8iq",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/4fb4fd1559f0b613d2f1a16f8a3f0a13e099e3aa?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 0,
        "spotify_id": "3cjvqsvvU80g7WJPMVh8iq",
        "created_at": "2023-01-09T05:40:28.000000Z",
        "updated_at": "2023-01-09T05:40:28.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 21,
            "spotify_id": "053q0ukIDRgzwTr4vNSwab",
            "name": "Grimes",
            "created_at": "2023-01-09T05:40:28.000000Z",
            "updated_at": "2023-01-09T05:40:28.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 23,
              "artist_id": 21
            }
          }
        ]
      },
      {
        "id": 24,
        "isrc": "QZG4T1900008",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273fa1323bb50728c7489980672",
        "release_date": "2019-05-10 00:00:00",
        "title": "Heart To Heart",
        "length": "03:32",
        "spotify_url": "https:\/\/open.spotify.com\/track\/7EAMXbLcL0qXmciM5SwMh2",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/1642fc339205f67c96307b44b32ebdc3fe9e7498?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "7EAMXbLcL0qXmciM5SwMh2",
        "created_at": "2023-01-09T05:41:31.000000Z",
        "updated_at": "2023-01-09T05:41:31.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 22,
            "spotify_id": "3Sz7ZnJQBIHsXLUSo0OQtM",
            "name": "Mac DeMarco",
            "created_at": "2023-01-09T05:41:31.000000Z",
            "updated_at": "2023-01-09T05:41:31.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 24,
              "artist_id": 22
            }
          }
        ]
      },
      {
        "id": 25,
        "isrc": "QZHN31928994",
        "thumb_url": "https:\/\/i.scdn.co\/image\/ab67616d0000b273d4b911e5a3773c47653dc3f0",
        "release_date": "2019-08-23 00:00:00",
        "title": "Over the Top - Portuguese Version",
        "length": "05:07",
        "spotify_url": "https:\/\/open.spotify.com\/track\/1igZQKKvxKFpPVY5eRwWCb",
        "preview_url": "https:\/\/p.scdn.co\/mp3-preview\/d996bacf3dcec3568cc391ce5a3353c35675d14c?cid=5028cd9aa20848b5829aad21a7d2c6a4",
        "br_avaiable": 1,
        "spotify_id": "1igZQKKvxKFpPVY5eRwWCb",
        "created_at": "2023-01-09T05:43:02.000000Z",
        "updated_at": "2023-01-09T05:43:02.000000Z",
        "deleted_at": null,
        "artists": [
          {
            "id": 23,
            "spotify_id": "5ZcXM1KFH6hhLoBIdgCnap",
            "name": "Miura Jam",
            "created_at": "2023-01-09T05:43:02.000000Z",
            "updated_at": "2023-01-09T05:43:02.000000Z",
            "deleted_at": null,
            "pivot": {
              "track_id": 25,
              "artist_id": 23
            }
          }
        ]
      }
    ];
  }
}
