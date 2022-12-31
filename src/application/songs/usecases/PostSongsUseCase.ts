import { Song } from './../../../domain/models/Song';
import spotify from '../../../adapters'
import { UseCase } from './../../../shared/core/UseCase'
import songRepo from './../../../domain/repos'

export default class PostSongsUseCase implements UseCase {

    public async execute(ISRC: string) : Promise<any> {
        try {

            const song: Song = await spotify.constructSongListByISRC(ISRC)

            const result = await songRepo.insertSong(song)

            return result

        } catch (err) {
            throw new Error(`${err}`)
        }
    }
}