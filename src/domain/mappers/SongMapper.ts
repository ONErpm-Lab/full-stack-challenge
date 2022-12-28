import { Song } from "../models/Song";

export class SongMapper {
    static toInsert(song: Song){}

    static toResponse(song: any): Song {
        return Song.create({
            "ISRC": "string",
            "name": "string",
            "thumbFile": "string",
            "debutDate": "string",
            "artists": ["Array<String>"],
            "miliseconds": "string",
            "previewFile": "string",
            "spotifyUrl": "string",
            "isAvaibleAtCountry": true
        })
    }
}