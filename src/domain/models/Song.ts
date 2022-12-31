import { Entity } from '../../shared/domain/Entity'

interface SongProps {
    name: string
    ISRC: string
    thumbFile: string
    thumbFileIcon: string
    previewFile: string
    spotifyUrl: string
    isAvaibleAtCountry: boolean
    debutDate: string
    artists: string
    miliseconds: string
}

export class Song extends Entity<SongProps> {

    private constructor(props: SongProps, id?: string) {
        super(props, id)
    }

    static create(props: SongProps): Song {
        const song = new Song(props)

        return song
    }

    static getValue(song: Song): SongProps {
        return song.props
    }
}
