import express from 'express'
import song from './songs'

const app = express()
const PORT = 3000

app.use('/songs', song)

app.listen(PORT, () => console.log(`Server is listening on ${PORT}`))
