import { UseCase } from './../../../shared/core/UseCase'
import songRepo from './../../../domain/repos'

export default class GetSongsUseCase implements UseCase {

    public async execute() : Promise<any> {

        const songsList = await songRepo.getAllSongs()

        return songsList
    }

}