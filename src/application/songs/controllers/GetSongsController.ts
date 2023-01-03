import { Song } from './../../../domain/models/Song'
import Controller from "../../../shared/core/Controller"
import { UseCase } from "../../../shared/core/UseCase"

export default class GetSongsController extends Controller {

    private useCase: UseCase

    constructor(useCase: UseCase) {
        super()
        this.useCase = useCase
    }

    public async execute() : Promise<any> {

        try {
            const songsList = await this.useCase.execute()

            return songsList

        } catch (err) {

            return err

        }

    }

}

