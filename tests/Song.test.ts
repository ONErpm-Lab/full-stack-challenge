import { Song } from '../src/domain/models/Song'

describe('Tests if entity Song works - Right Scenario', () => {
    const song = {
        "name": "Record Player (with AJR)",
        "ISRC": "USHR12141957",
        "thumbFile": "https://i.scdn.co/image/ab67616d0000b2739d9f3957b41020010f223999",
        "thumbFileIcon": "https://i.scdn.co/image/ab67616d000048519d9f3957b41020010f223999",
        "previewFile": "https://p.scdn.co/mp3-preview/c788e2bddd8e12f524200fd2ca43e6b39ac0fc6a?cid=e4d79f3a469a47c199fbd316cb4929bb",
        "spotifyUrl": "https://open.spotify.com/track/4jYt1pQqg2mIZmY4FWCZEM",
        "isAvaibleAtCountry": true,
        "debutDate": "2021-08-31",
        "artists": "Daisy the Great,AJR",
        "miliseconds": "149538"
    }

    const createdSong = Song.create(song)

    test('Tests if Song values is consistent', () => {
        expect((Song.getValue(createdSong)).name).toBe("Record Player (with AJR)")
        expect((Song.getValue(createdSong)).ISRC).toBe("USHR12141957")
        expect((Song.getValue(createdSong)).thumbFile).toBe("https://i.scdn.co/image/ab67616d0000b2739d9f3957b41020010f223999")
        expect((Song.getValue(createdSong)).thumbFileIcon).toBe("https://i.scdn.co/image/ab67616d000048519d9f3957b41020010f223999")
        expect((Song.getValue(createdSong)).previewFile).toBe("https://p.scdn.co/mp3-preview/c788e2bddd8e12f524200fd2ca43e6b39ac0fc6a?cid=e4d79f3a469a47c199fbd316cb4929bb")
        expect((Song.getValue(createdSong)).spotifyUrl).toBe("https://open.spotify.com/track/4jYt1pQqg2mIZmY4FWCZEM")
        expect((Song.getValue(createdSong)).isAvaibleAtCountry).toBe(true)
        expect((Song.getValue(createdSong)).debutDate).toBe("2021-08-31")
        expect((Song.getValue(createdSong)).artists).toEqual("Daisy the Great,AJR")
        expect((Song.getValue(createdSong)).miliseconds).toBe("149538")
    })
})

describe('Tests if entity Song works - Wrong Scenario', () => {})