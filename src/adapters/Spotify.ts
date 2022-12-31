import { Song } from './../domain/models/Song'
import fetch from 'node-fetch'

export class Spotify {

    async constructSongListByISRC (ISRC: string): Promise<Song> {
        try{
            const spotifySearchAPI: string = `https://api.spotify.com/v1/search`

            const access_token = await this.getAccessToken()

            const requestUrl = `${spotifySearchAPI}?q=isrc%3A${ISRC}&access_token=${access_token}&type=track`

            const response = await fetch(requestUrl, {
                method: 'GET'
            })

            const data = await response.json()

            const songFormatted = await this.formatSongFromSpotify(data.tracks.items[0])

            const song = Song.create(songFormatted)

            return song
        }catch (err) {
            throw new Error(`Não foi possível encontrar a faixa desse ISRC, verifique se ela é válida e tente novamente!`)
        }
    }

    private async getAccessToken() {
        try {
            const response = await fetch('https://accounts.spotify.com/api/token', {
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

    private async formatSongFromSpotify (data: any): Promise<any> {
        return {
            "ISRC": data.external_ids.isrc,
            "name": data.name,
            "thumbFile": data.album.images[0].url,
            "thumbFileIcon": data.album.images[2].url,
            "debutDate": data.album.release_date,
            "artists": await this.getArtists(data.artists),
            "milliseconds": data.duration_ms,
            "previewFile": data.preview_url,
            "spotifyUrl": data.external_urls.spotify,
            "isAvaibleAtCountry": await this.isAvaibleAtCountry(data.available_markets),
        }

    }

    private async getArtists (artists: Array<{name: string, external_urls: {spotify: string}}>) {

        const artistsList: Array<{}> = []

        artists.forEach(artist => {
            artistsList.push(artist.name)
        })

        const artistsListString: Array<String> = []

        artistsList.forEach((artistJson) => {
            artistsListString.push(String(artistJson))
        })

        return artistsListString.toString()
    }

    private async isAvaibleAtCountry (countries: Array<string>) {

        if(countries.includes('BR')) {
            return true
        } else {
            return false
        }
    }
}
