import express from 'express'
import song from './songs'
import dotenv from 'dotenv'
import cors from 'cors'

dotenv.config()

const app = express()

app.use(cors({
    origin: '*',
    methods: 'GET,HEAD,PUT,PATCH,POST,DELETE,OPTIONS',
    preflightContinue: false,
    optionsSuccessStatus: 204,
    credentials: false,
}))

app.use('/songs', song)

app.listen(process.env.PORT || 4000, () => console.log(`Server is listening on ${process.env.PORT || 4000}`))
