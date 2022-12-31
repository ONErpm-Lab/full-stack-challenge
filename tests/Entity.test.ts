import { Song } from '../src/domain/models/Song'

describe('Tests if Entity set id works - Right Scenario', () => {
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
        "milliseconds": "149538"
    }

    const createdSong = Song.create(song)

    createdSong.id = '16'

    test('Tests if Entity set id worked', () => {
        expect(createdSong.id).toBe("16")
    })
})