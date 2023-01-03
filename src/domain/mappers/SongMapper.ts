import { Song } from "../models/Song";
import DateTime from "../../shared/converters/DateTime"
export class SongMapper {
    static toResponse(song: any): Song {
        const songCreated = Song.create({
            "ISRC": song.ISRC,
            "name": song.name,
            "thumbFile": song.thumbFile,
            "thumbFileIcon": song.thumbFileIcon,
            "debutDate": DateTime.dateTimeToDate(song.debutDate),
            "artists": song.artists,
            "milliseconds": DateTime.millisToMinutesAndSeconds(song.milliseconds),
            "previewFile": song.previewFile,
            "spotifyUrl": song.spotifyUrl,
            "isAvaibleAtCountry": song.isAvaibleAtCountry
        })

        songCreated.id = song.id

        return songCreated
    }

    static async toFormat(data: any): Promise<any> {

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

    private static async getArtists (artists: Array<{name: string, external_urls: {spotify: string}}>) {

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

    private static async isAvaibleAtCountry (countries: Array<string>) {

        if(countries.includes('BR')) {
            return true
        } else {
            return false
        }
    }
}