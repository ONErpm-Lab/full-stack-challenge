import { Song } from './../../../../domain/models/Song';
import { UseCase } from "../../../../shared/core/UseCase"

export default class GetSongController implements UseCase {

    private useCase: UseCase

    constructor(useCase: UseCase) {
        this.useCase = useCase
    }

    public async execute(req: any) : Promise<any> {

        try{
            const id = req.params.songId

            const song = await this.useCase.execute(id)

            return song

        } catch (err) {
            return err
        }
    }
}