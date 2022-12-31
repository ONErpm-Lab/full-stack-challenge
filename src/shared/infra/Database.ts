import { createPool } from 'mysql2'

interface IDatabase {
    write (stmt: string, params?: any[]): Promise<any>
    read (stmt: string, params?: any[]): Promise<any>
}

export class Database implements IDatabase {

    async Connect () {
        try {
            return createPool({
                host: process.env['DB_HOST'],
                user: process.env['DB_USER'],
                password: process.env['DB_PASS'],
                database: process.env['DB_SCHEMA'],
                port: Number(process.env['DB_PORT'])
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