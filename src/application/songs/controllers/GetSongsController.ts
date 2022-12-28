import { Song } from './../../../domain/models/Song';
import Controller from "../../../shared/core/Controller"
import { UseCase } from "../../../shared/core/UseCase"

export default class GetSongsController extends Controller {

    private useCase: UseCase

    constructor(useCase: UseCase) {
        super()
        this.useCase = useCase
    }

    public async execute() : Promise<{code: number, message: String, songsList?:Array<Song>}> {

        try {
            const songsList: Array<Song> = await this.useCase.execute()

            return {code: 200, message: 'Sucesso', songsList}

        } catch{

            return {code: 500, message: ''}

        }

    }

}

