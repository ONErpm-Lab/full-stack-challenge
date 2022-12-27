export default abstract class Controller {
    public async execute (req: HttpRequest): Promise<any> {}
}

export interface HttpRequest {
    body: { [key: string]: any }
    query: { [key: string]: any }
    params: { [key: string]: any }
    files: any
    ip: string
    method: string
    path: string
    headers: { [key: string]: any },
    baseUrl: string
}