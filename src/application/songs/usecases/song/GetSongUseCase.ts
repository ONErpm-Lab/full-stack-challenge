import { UseCase } from './../../../../shared/core/UseCase'
import songRepo from './../../../../domain/repos'
import { Song } from './../../../../domain/models/Song'

export default class GetSongUseCase implements UseCase {

    public async execute(id: string ) : Promise<Song> {
        try{
            const song = songRepo.getSong(id)

            return song

        } catch(err) {
            throw new Error(`${err}`)
        }
    }
}