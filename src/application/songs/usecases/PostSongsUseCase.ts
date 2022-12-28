import spotify from '../../../adapters'
import { UseCase } from './../../../shared/core/UseCase'
import songRepo from './../../../domain/repos'

export default class PostSongsUseCase implements UseCase {

    public async execute(ISRC: string) : Promise<any> {

        const song = await spotify.getSongByISRC(ISRC)

        const result = await songRepo.insertSong(song)

        return result
    }

}