import Responses from "../../../shared/core/Responses"
import Errors from "../../../shared/core/ErrorHandler"
import { UseCase } from "../../../shared/core/UseCase"

export default class PostSongsController implements UseCase {

    private useCase: UseCase

    constructor(useCase: UseCase) {
        this.useCase = useCase
    }

    public async execute(req: any) : Promise<{code: number, message: String | Error}> {

        try {
            const ISRC = req.query.isrc

            if (ISRC.length === 12) {

                const result = await this.useCase.execute(ISRC)

                return result

            } else {
                return Errors.badRequest('This ISRC is invalid')
            }

        } catch (err) {
            return Errors.unexpected()
        }
    }

}