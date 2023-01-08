import { IArtist } from "./artist.interface";

export interface ITrack {
    isrc?: string,
    thumb_url?: string,
    release_date?: string,
    title?: string,
    length?: string,
    spotify_url?: string,
    preview_url?: string,
    br_avaiable?: boolean,
    artists?: IArtist[],
}