import { Song } from './../../../../domain/models/Song';
import { UseCase } from "../../../../shared/core/UseCase"

export default class GetSongController implements UseCase {

    private useCase: UseCase

    constructor(useCase: UseCase) {
        this.useCase = useCase
    }

    public async execute(req: any) : Promise<{code: number, message: String, song?:Song}> {

        try{
            const id = req.params.songId

            const song: Song = await this.useCase.execute(id)

            return {code: 200, message: 'Sucesso', song}

        } catch (err) {
            return {code: 500, message: `${err}`}
        }
    }
}