import express from 'express'
import song from './songs'
import dotenv from 'dotenv'

dotenv.config()

const app = express()
const PORT = process.env['APP_PORT']

app.use('/songs', song)

app.listen(process.env.PORT, () => console.log(`Server is listening on ${PORT}`))
