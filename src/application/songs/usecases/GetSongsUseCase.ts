import { UseCase } from './../../../shared/core/UseCase'
import SongRepo from './../../../domain/repos'

export default class getSongsUseCase implements UseCase {

    public async execute() : Promise<any> {

        const songsList = await SongRepo.getAllSongs()

        return songsList
    }

}