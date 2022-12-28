import GetSongsUseCase from "./GetSongsUseCase"
import GetSongUseCase from "./song/GetSongUseCase"
import PostSongsUseCase from "./PostSongsUseCase"

const getSongsUseCase = new GetSongsUseCase()
const getSongUseCase = new GetSongUseCase()
const postSongsUseCase = new PostSongsUseCase()

export {
    getSongsUseCase,
    getSongUseCase,
    postSongsUseCase
}