import { GetSongUseCase, GetSongsUseCase, PostSongsUseCase } from "../usecases"
import getSongsController from "./GetSongsController"
import getSongController from "./song/GetSongController"
import postSongsController from "./PostSongsController"

const PostSongsController = new postSongsController(PostSongsUseCase)
const GetSongsController = new getSongsController(GetSongsUseCase)
const GetSongController = new getSongController(GetSongUseCase)

export {
    GetSongsController,
    GetSongController,
    PostSongsController
}