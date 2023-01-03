import { getSongsController } from '../../controllers'
import { Router } from 'express'

const router = Router({ mergeParams: true })

router.get('', async (req, res) => {

    const result = await getSongsController.execute()

    res.status(result.code).send({ "Message": result.message, "Songs": result.data })

})

export default router