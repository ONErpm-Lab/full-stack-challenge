import express from 'express'
import song from './songs'
import dotenv from 'dotenv'
import cors from 'cors'
import swaggerUI from 'swagger-ui-express'
import swaggerDocument from '../../swagger.json'

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
app.use('', swaggerUI.serve, swaggerUI.setup(swaggerDocument))


app.listen(process.env.PORT || 4000, () => console.log(`Server is listening on ${process.env.PORT || 4000}`))
