import { GetSongsController } from '../../controllers'
import { Router } from 'express'
import Spotify from '../../../../adapters'

const router = Router({ mergeParams: true })

router.get('', async (req, res) => {

    const {code, message, songsList} = await GetSongsController.execute()

    res.status(code).send([message, songsList])

})

export default router