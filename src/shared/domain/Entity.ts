export abstract class Entity<T> {
    protected _id: string
    protected props: T

    get id (): string {
        return this._id
    }

    set id (id: string) {
        this._id = id
    }

    constructor(props: T, id?: string) {
        this._id = id ? id : '0'
        this.props = props
    }
}
