import Errors from "./ErrorHandler"

export default class Responses extends Errors {
    static success (response: { message?: string, data?: any }) {
        return { code: 200, message: response.message, data: response.data }
    }
}