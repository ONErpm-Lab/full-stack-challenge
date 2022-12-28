import { getSongsController } from '../../controllers'
import { Router } from 'express'

const router = Router({ mergeParams: true })

router.get('', async (req, res) => {

    const {code, message, songsList} = await getSongsController.execute()

    res.status(code).send([message, songsList])

})

export default router