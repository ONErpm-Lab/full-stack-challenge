import { Injectable } from "@angular/core";
import {HttpClient} from "@angular/common/http";
import { environment } from "src/environments/enviroment";

@Injectable({
  providedIn: "root",
})
export class BackendService {
  readonly backendApi = environment.BACKEND_URL;

  constructor(
    private readonly http: HttpClient,
  ) { }

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