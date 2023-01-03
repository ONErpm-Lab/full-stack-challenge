import { SongMapper } from './../domain/mappers/SongMapper'
import { Song } from './../domain/models/Song'
import Variables from '../shared/configs/Variables'
import fetch from 'node-fetch'

export class Spotify {

    async constructSongListByISRC (ISRC: string): Promise<Song> {
        try{
            const spotifySearchAPI: string = `${Variables.SPOTIFY_PUBLIC_API}/v1/search`

            const access_token = await this.getAccessToken()

            const requestUrl = `${spotifySearchAPI}?q=isrc%3A${ISRC}&access_token=${access_token}&type=track`

            const response = await fetch(requestUrl, {
                method: 'GET'
            })

            const data = await response.json()

            const songFormatted = await SongMapper.toFormat(data.tracks.items[0])

            const song = Song.create(songFormatted)

            return song
        }catch (err) {
            throw new Error(`Não foi possível encontrar a faixa desse ISRC, verifique se ela é válida e tente novamente!`)
        }
    }

    private async getAccessToken() {
        try {
            const response = await fetch(`${Variables.SPOTIFY_ACCOUNTS_API}/api/token`, {
                method: 'POST',
                headers: {
                    "Content-Type": "application/x-www-form-urlencoded"
                },
                body: process.env['SPOTIFY_CREDENTIALS']
            })

            const data = await response.json()

            return data.access_token

        } catch (error) {
            throw new Error(`Não foi possível buscar os dados desta música, tente novamente mais tarde!`)
        }
    }

}
