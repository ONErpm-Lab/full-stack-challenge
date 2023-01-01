import express from 'express'
import song from './songs'
import dotenv from 'dotenv'

dotenv.config()

const app = express()

app.use('/songs', song)

app.listen(process.env.PORT || 4000, () => console.log(`Server is listening on ${process.env.PORT || 4000}`))
