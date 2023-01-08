import { Injectable } from "@angular/core";

import SpotifyWebApi from "spotify-web-api-js";

import { BackendService } from "./backend.service";

@Injectable({
  providedIn: "root",
})
export class SpotifyService {
  private readonly spotifyApi = new SpotifyWebApi();

  constructor(
    private readonly backendService: BackendService,
  ) { }

  async login() {
    const hasToken = this.spotifyApi.getAccessToken();

    if (hasToken) return;

    const token = await this.backendService.getSpotifyToken();

    this.spotifyApi.setAccessToken(token);
  }

  async getTracksByISRC(isrc: string) {
    await this.login();

    const response = await this.spotifyApi.search(`isrc=${isrc}`, ["track"]);

    const tracks = response.tracks;

    return tracks;
  }
}