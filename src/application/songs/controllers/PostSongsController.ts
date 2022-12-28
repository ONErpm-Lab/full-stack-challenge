import { UseCase } from "../../../shared/core/UseCase"

export default class PostSongsController implements UseCase {

    private useCase: UseCase

    constructor(useCase: UseCase) {
        this.useCase = useCase
    }

    public async execute(req: any) : Promise<{code: number, message: String}> {

        try {
            const ISRC = req.query.isrc

            await this.useCase.execute(ISRC)

            return {code: 200, message: 'Sucesso'}

        } catch{

            return {code: 500, message: ''}

        }
    }

}