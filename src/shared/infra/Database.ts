import { createPool } from 'mysql2'

interface IDatabase {
    write (stmt: string, params?: any[]): Promise<any>
    read (stmt: string, params?: any[]): Promise<any>
}

export class Database implements IDatabase {

    async Connect () {
        try {
            return createPool({
                host: 'containers-us-west-47.railway.app',
                user: 'root',
                password: '3FbATq8NwYzUedj6FOyw',
                database: 'spotify',
                port: 7144
            })
        } catch (err) {
            console.log('ERRO CONEXÃO DB => ', err)
        }
    }

    async write (stmt: string, params?: any[]) {

        const pool = await this.Connect()

        pool ? pool.getConnection(function(err, connection) {
            if (err) throw err

            connection.query(stmt, params, function (error) {

              connection.release()

              if (error) throw error

            });
        }) : ''
    }

    async read (stmt: string, params?: any[]): Promise<any> {

        const pool = await this.Connect()

        return new Promise((resolve, reject) => {

            if (pool) pool.getConnection(function(err, connection) {

                if (err) reject(err)

                const result = connection.query(stmt, params, function (err, res) {

                    if (err) throw (err)
                    else resolve(res)
                });

                return result

            })
        }
    )}
}

const database = new Database()

export default database