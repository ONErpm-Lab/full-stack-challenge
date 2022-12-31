import { Song } from "../models/Song";

export class SongMapper {

    static toResponse(song: any): Song {
        const songCreated = Song.create({
            "ISRC": song.ISRC,
            "name": song.name,
            "thumbFile": song.thumbFile,
            "thumbFileIcon": song.thumbFileIcon,
            "debutDate": song.debutDate,
            "artists": song.artists,
            "miliseconds": song.miliseconds,
            "previewFile": song.previewFile,
            "spotifyUrl": song.spotifyUrl,
            "isAvaibleAtCountry": song.isAvaibleAtCountry
        })

        songCreated.id = song.id

        return songCreated
    }
}