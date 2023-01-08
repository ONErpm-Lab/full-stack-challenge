import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { environment } from "src/environments/enviroment";
import { firstValueFrom } from "rxjs";
import { ISpotifyTokenResponse } from "../interfaces/spotify-token-response";
import { ITrack } from "../interfaces/track.interface";
import { IArtist } from "../interfaces/artist.interface";
import { UtilsService } from "./utils.service";

@Injectable({
  providedIn: "root",
})
export class BackendService {
  readonly backendUrl = environment.BACKEND_URL;

  constructor(
    private readonly http: HttpClient,
    private readonly utilsService: UtilsService,
  ) { }

  async getSpotifyToken() {
    const response = await firstValueFrom(
      this.http.get<ISpotifyTokenResponse>(`${this.backendUrl}/spotify/token`)
    );

    return response.access_token;
  }

  async getAllTracks() {
    const tracks = await firstValueFrom(this.http.get<ITrack[]>(`${this.backendUrl}/tracks`));

    return tracks;
  }

  getTrack() { }

  async saveTrack(spotifyTrack: SpotifyApi.TrackObjectFull | any) {
    const track: Partial<ITrack> = { 
      isrc: spotifyTrack.external_ids.isrc,
      thumb_url: spotifyTrack.album.images[0].url,
      release_date: spotifyTrack.album.release_date,
      title: spotifyTrack.name,
      spotify_url: spotifyTrack.external_urls.spotify,
      preview_url: spotifyTrack.preview_url,
      br_avaiable: this.utilsService.isAvaiable("BR", spotifyTrack),
      length: this.utilsService.millisecondsTommssFormat(spotifyTrack.duration_ms),
    };

    track.artists = spotifyTrack.artists.map((spotifyArtist: any) => {
      const artist: IArtist = {
        spotify_id: spotifyArtist.id,
        name: spotifyArtist.name,
      };

      return artist;
    });

    await firstValueFrom(this.http.post(`${this.backendUrl}/tracks`, track));
  }

  updateTrack() { }

  async deleteTrack(id: number) {
    await firstValueFrom(this.http.delete(`${this.backendUrl}/tracks/${id}`));
  }

  getAllArtists() { }
  getArtist() { }
  saveArtist() { }
  updateArtist() { }
  deleteArtist() { }
}