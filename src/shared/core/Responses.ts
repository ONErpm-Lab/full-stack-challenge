import Errors from "./ErrorHandler"

export default class Responses extends Errors {
    static success (message: string, data?: any) {
        return { code: 200, message: message, data: data ? data : '' }
    }
}