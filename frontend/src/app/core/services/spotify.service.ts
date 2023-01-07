import { Injectable } from "@angular/core";
import {HttpClient} from "@angular/common/http";

import SpotifyWebApi from "spotify-web-api-js";

@Injectable({
  providedIn: "root",
})
export class SpotifyService {
  private readonly spotifyApi = new SpotifyWebApi();

  constructor(
    private readonly http: HttpClient,
  ) {
    this.spotifyApi
  }

  getByISRC(isrc: string) {
    console.log("not implemented");
  }
}