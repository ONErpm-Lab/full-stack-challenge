import { IArtist } from "./artist.interface";

export interface ITrack {
    id: number,
    isrc: string,
    thumb_url: string,
    release_date: string,
    title: string,
    length: string,
    spotify_url: string,
    preview_url: string,
    br_avaiable: boolean,
    spotify_id: string,
    artists: IArtist[],
}