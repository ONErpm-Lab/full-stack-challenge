import Spotify from '../../../adapters'
import { Song } from './../../../domain/models/Song'
import { UseCase } from './../../../shared/core/UseCase'
import SongRepo from './../../../domain/repos'

export default class postSongsUseCase implements UseCase {

    public async execute(ISRC: string) : Promise<any> {

        const Song = await Spotify.getSongByISRC(ISRC)

        const result = SongRepo.insertSong(Song)

        console.log(result)

        return result
    }

}