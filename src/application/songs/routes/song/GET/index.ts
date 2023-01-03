import { Router } from 'express'
import { getSongController } from '../../../controllers'

const router = Router({ mergeParams: true })

router.get('', async (req, res) => {

    const httpRequest = {
        body: req.body,
        query: req.query,
        params: req.params,
        method: req.method,
        path: req.path,
        headers: req.headers,
        baseUrl: req.baseUrl
    }

    const result = await getSongController.execute(httpRequest)

    res.status(result.code).send({ "Message": result.message, "Song": result.data })

})

export default router