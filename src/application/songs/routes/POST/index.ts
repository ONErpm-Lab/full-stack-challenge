import { postSongsController } from '../../controllers'
import { Router } from 'express'

const router = Router({ mergeParams: true })

router.post('', async (req, res) => {

    const httpRequest = {
        body: req.body,
        query: req.query,
        params: req.params,
        method: req.method,
        path: req.path,
        headers: req.headers,
        baseUrl: req.baseUrl
    }

    const {code, message} = await postSongsController.execute(httpRequest)

    res.status(code).send([message])

})

export default router