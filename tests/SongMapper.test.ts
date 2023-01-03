import { Song } from './../src/domain/models/Song';
import { SongMapper } from './../src/domain/mappers/SongMapper'

describe('Tests if Spotify Mapper to Response Works - Right Scenario', () => {

    test('Tests if Spotify Mapper to Response is working and consistent', async () => {

        const data = {
            "name": "Record Player (with AJR)",
            "ISRC": "USHR12141957",
            "thumbFile": "https://i.scdn.co/image/ab67616d0000b2739d9f3957b41020010f223999",
            "thumbFileIcon": "https://i.scdn.co/image/ab67616d000048519d9f3957b41020010f223999",
            "previewFile": "https://p.scdn.co/mp3-preview/c788e2bddd8e12f524200fd2ca43e6b39ac0fc6a?cid=e4d79f3a469a47c199fbd316cb4929bb",
            "spotifyUrl": "https://open.spotify.com/track/4jYt1pQqg2mIZmY4FWCZEM",
            "isAvaibleAtCountry": true,
            "debutDate": new Date("2021-8-31"),
            "artists": "Daisy the Great,AJR",
            "milliseconds": "149538"
        }

        const responseSong = SongMapper.toResponse(data)

        expect((Song.getValue(responseSong)).name).toBe("Record Player (with AJR)")
        expect((Song.getValue(responseSong)).ISRC).toBe("USHR12141957")
        expect((Song.getValue(responseSong)).thumbFile).toBe("https://i.scdn.co/image/ab67616d0000b2739d9f3957b41020010f223999")
        expect((Song.getValue(responseSong)).thumbFileIcon).toBe("https://i.scdn.co/image/ab67616d000048519d9f3957b41020010f223999")
        expect((Song.getValue(responseSong)).previewFile).toBe("https://p.scdn.co/mp3-preview/c788e2bddd8e12f524200fd2ca43e6b39ac0fc6a?cid=e4d79f3a469a47c199fbd316cb4929bb")
        expect((Song.getValue(responseSong)).spotifyUrl).toBe("https://open.spotify.com/track/4jYt1pQqg2mIZmY4FWCZEM")
        expect((Song.getValue(responseSong)).isAvaibleAtCountry).toBe(true)
        expect((Song.getValue(responseSong)).debutDate).toBe("31/08/2021")
        expect((Song.getValue(responseSong)).artists).toEqual("Daisy the Great,AJR")
        expect((Song.getValue(responseSong)).milliseconds).toBe("2:30")


    })
})