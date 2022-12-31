import { Song } from '../src/domain/models/Song'
import spotify from '../src/adapters'

describe('Tests if Spotify Class works - Right Scenario', () => {

    test('Tests if Spotify API integration complete flow is working and consistent', async () => {

        const song = Song.getValue(await spotify.constructSongListByISRC("USHR12141957"))

        expect(song.ISRC).toBe("USHR12141957")
    })
})