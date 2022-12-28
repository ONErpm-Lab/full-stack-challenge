import { getSongUseCase, getSongsUseCase, postSongsUseCase } from "../usecases"
import GetSongsController from "./GetSongsController"
import GetSongController from "./song/GetSongController"
import PostSongsController from "./PostSongsController"

const postSongsController = new PostSongsController(postSongsUseCase)
const getSongsController = new GetSongsController(getSongsUseCase)
const getSongController = new GetSongController(getSongUseCase)

export {
    getSongsController,
    getSongController,
    postSongsController
}