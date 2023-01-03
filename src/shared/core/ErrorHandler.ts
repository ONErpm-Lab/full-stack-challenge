export default class Errors {
    static badRequest (message: string): {code: number, message: string} {
        return { code: 400, message: message }
    }

    static failedDependency (message: string): {code: number, message: string} {
        return { code: 424, message: message }
    }

    static serverError (message: string): {code: number, message: string} {
        return { code: 500, message: message }
    }

    static unexpected (): {code: number, message: string} {
        return { code: 500, message: 'We got an unexpected error, please try again later!' }
    }
}