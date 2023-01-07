import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";
import { environment } from "src/environments/enviroment";
import { firstValueFrom } from "rxjs";
import { ISpotifyTokenResponse } from "../interfaces/spotify-token-response";

@Injectable({
  providedIn: "root",
})
export class BackendService {
  readonly backendApi = environment.BACKEND_URL;

  constructor(
    private readonly http: HttpClient,
  ) { }

  async getSpotifyToken() {
    const response = await firstValueFrom(
      this.http.get<ISpotifyTokenResponse>(`${this.backendApi}/spotify/token`)
    );

    return response.access_token;
  }

  getAllTracks() { }
  getTrack() { }
  saveTrack() { }
  updateTrack() { }
  deleteTrack() { }

  getAllArtists() { }
  getArtist() { }
  saveArtist() { }
  updateArtist() { }
  deleteArtist() { }
}