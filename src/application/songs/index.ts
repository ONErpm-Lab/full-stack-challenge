import { Router } from 'express'

import GetAllSongsRouter from './routes/GET'
import PostSongsRouter from './routes/POST'
import GetSongByIdRouter from './routes/song/GET'

const router = Router({mergeParams: true})

router.use('/', GetAllSongsRouter)
router.use('/', PostSongsRouter)
router.use('/:songId', GetSongByIdRouter)

export default router
