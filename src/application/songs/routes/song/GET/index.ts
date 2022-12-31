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

    const {code, message, song} = await getSongController.execute(httpRequest)

    res.status(code).send([message, song])

})

export default router