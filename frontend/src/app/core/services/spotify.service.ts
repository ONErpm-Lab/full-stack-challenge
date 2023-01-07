import { Injectable } from "@angular/core";
import { HttpClient } from "@angular/common/http";

import SpotifyWebApi from "spotify-web-api-js";

import { BackendService } from "./backend.service";

@Injectable({
  providedIn: "root",
})
export class SpotifyService {
  private readonly spotifyApi = new SpotifyWebApi();

  constructor(
    private readonly http: HttpClient,
    private readonly backendService: BackendService,
  ) { }

  async login() {
    const token = await this.backendService.getSpotifyToken();

    this.spotifyApi.setAccessToken(token);

    console.log("access token OK!");
  }

  getByISRC(isrc: string) {
    console.log("not implemented");
  }
}