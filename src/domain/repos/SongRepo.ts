import database from "../../shared/infra/Database"
import { SongMapper } from "../mappers/SongMapper"
import { Song } from "../models/Song"

export interface ISongRepo {
    getAllSongs(): Promise<Array<Song>>
    getSong(id?: string): Promise<Song>
    insertSong(songs: Song): Promise<any>
}

export class SongRepo implements ISongRepo {

    async getAllSongs(): Promise<Array<Song>> {

        const stmt = `
            SELECT * FROM spotify.songs
        `

        const result: Array<any> = await database.read(stmt)

        const songs = result.map(song => {
            return SongMapper.toResponse(song)
        })

        return songs
    }

    async getSong(id: string): Promise<Song> {

        const stmt = `
            SELECT DISTINCT *
            FROM
                spotify.songs
            WHERE
                id = ?
        `

        try {

            const song: Array<any> = await database.read(stmt, [ id ])

            return SongMapper.toResponse(song[0])
        } catch (err) {
            throw new Error(`Não foi possível encontrar a música com este ID`)
        }
    }

    async insertSong(song: Song): Promise<any> {

        const stmt = `
            INSERT INTO
                spotify.songs
            SET
                ?
        `

        const songToInsert = Song.getValue(song)

        try {

            await database.write(stmt, [ songToInsert ])

        } catch (err) {
            throw new Error(`Não foi possível salvar a música: ${err}`)
        }
    }

}