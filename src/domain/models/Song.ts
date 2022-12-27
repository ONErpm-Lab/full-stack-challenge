import { Entity } from '../../shared/domain/Entity'

interface SongProps {
    ISRC: string
    name: string
    thumbFile: string
    debutDate: string
    artists: Array<String>
    seconds: string
    previewFile: string
    spotifyUrl: string
    isAvaibleAtCountry: boolean
}

export class Song extends Entity<SongProps> {

    private constructor(props: SongProps, id?: string) {
        super(props, id)
    }

    static create(props: SongProps): Song {
        const song = new Song(props)

        return song
    }
}
