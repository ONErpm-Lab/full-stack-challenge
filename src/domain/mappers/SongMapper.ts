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
            "miliseconds": DateTime.millisToMinutesAndSeconds(song.miliseconds),
            "previewFile": song.previewFile,
            "spotifyUrl": song.spotifyUrl,
            "isAvaibleAtCountry": song.isAvaibleAtCountry
        })

        songCreated.id = song.id

        return songCreated
    }
}