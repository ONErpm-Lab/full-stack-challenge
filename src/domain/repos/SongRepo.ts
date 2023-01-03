import Responses from '../../shared/core/Responses'
import Errors from "../../shared/core/ErrorHandler"
import database from "../../shared/infra/Database"
import { SongMapper } from "../mappers/SongMapper"
import { Song } from "../models/Song"

export interface ISongRepo {
    getAllSongs(): Promise<any>
    getSong(id?: string): Promise<any>
    insertSong(songs: Song): Promise<any>
}

export class SongRepo implements ISongRepo {

    async exists(ISRC: string): Promise<boolean> {

        const stmt = `
            SELECT DISTINCT *
            FROM
                spotify.songs
            WHERE
                ISRC = ?`

        const result: Array<any> = await database.read(stmt, [ISRC])

        return result.length > 0

    }

    async getAllSongs(): Promise<any> {

        const stmt = `
            SELECT * FROM spotify.songs ORDER BY name
        `
        try {

            const result: Array<any> = await database.read(stmt)

            const songsMapped = result.map(song => {
                return SongMapper.toResponse(song)
            })

            return Responses.success({ data: songsMapped })

        } catch (err) {
            throw Errors.serverError('Sorry, we could not get the songs list. Try again later!')
        }
    }

    async getSong(id: string): Promise<any> {

        const stmt = `
            SELECT DISTINCT *
            FROM
                spotify.songs
            WHERE
                id = ?
        `

        try {

            const song: Array<any> = await database.read(stmt, [ id ])

            const songMapped = SongMapper.toResponse(song[0])

            return Responses.success({ data: songMapped })

        } catch (err) {
            throw Errors.badRequest('Sorry, this id is not in the list')
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

        const exists = await this.exists(songToInsert.ISRC)

        if (exists) {
            return Errors.badRequest('This song is already on the list.')
        }

        try {

            await database.write(stmt, [ songToInsert ])

            return Responses.success({ message: 'Song saved!' })

        } catch (err) {
            return Errors.serverError('Sorry, we could not save this song. Try again later!')
        }
    }

}