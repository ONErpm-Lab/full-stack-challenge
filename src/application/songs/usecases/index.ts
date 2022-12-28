import getSongsUseCase from "./GetSongsUseCase"
import getSongUseCase from "./song/GetSongUseCase"
import postSongsUseCase from "./PostSongsUseCase"

const GetSongsUseCase = new getSongsUseCase()
const GetSongUseCase = new getSongUseCase()
const PostSongsUseCase = new postSongsUseCase()

export {
    GetSongsUseCase,
    GetSongUseCase,
    PostSongsUseCase
}